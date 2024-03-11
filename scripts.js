const button = document.querySelector('#download-excel')

function exportToExcel() {
  var nome_tabela = prompt('Insira um nome pra tabela');
  // https://stackoverflow.com/questions/22317951/export-html-table-data-to-excel-using-javascript-jquery-is-not-working-properl/38761185#38761185
  const uri = 'data:application/vnd.ms-excel;base64,';
  const template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>';

  const base64 = (s) => window.btoa(unescape(encodeURIComponent(s)));

  const format = function (template, context) {
    return template.replace(/{(\w+)}/g, (m, p) => context[p])
  };

  const html = document.getElementById('tabela-final-dados').innerHTML;
  const ctx = {
    worksheet: 'Worksheet',
    table: html,
  };

  const link = document.createElement("a");
    link.download = nome_tabela + ".xls";
    link.href = uri + base64(format(template, ctx));
    link.click();
}

button.addEventListener('click', e => {
  exportToExcel() 
})