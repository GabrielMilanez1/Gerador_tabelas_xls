<?php

  $contador = 0;

  $limite_colunas = 5;
    
  if(isset($_GET['linhas'])) {
    $linhas = $_GET['linhas'];
  } else {
    $linhas = '';
  }
  
  if(isset($_GET['colunas']) and $_GET['colunas'] != '') {
    $colunas = $_GET['colunas'];
  } else {
    $colunas = '';
  }

  if(isset($_GET['gerar_tabela'])) {
    
    $classe_esconde = 'esconder-class';
    $classe_aparece = 'aparecer-class';
    $centraliza_body = 'justify-content: center; display: flex; align-items: center;';
  } else {
    
    $classe_esconde = 'aparecer-class';
    $classe_aparece = 'esconder-class';
    $centraliza_body = '';
  }

if(isset($_GET['colunas']) and $_GET['colunas'] > 5){
  $_GET['colunas'] = 5;
}

?>

<style>
  body {
    margin: 0;
    padding: 0;
    <?php echo $centraliza_body; ?>
  }

  .linhas-colunas-div {
    margin-top: 1em;
    display: flex;
    flex-direction: column;
    gap: 0.5em;
    width: 25%;
  }

  .form-linhas-colunas-div {
    display: flex;
    justify-content: center;
  }

  .input-organizar {
    display: flex;
    flex-direction: column;
    gap: 0.2em;
  }
  
  .table-organizar {
    display: flex;
    flex-direction: column;
    gap: 0.2em;
  }

  .esconder-class {
    display: none !important;
  }

  .table>tbody {
    border: solid 1px #000;
    margin-top: 1em;
  }

  .table>tbody>tr>td {
    border: solid 1px #000;
    font-size: 20px;
    font-weight: 700;
    text-align: center;
    font-family: 'Montserrat';
  }

  .titulo-cabecalho {
    border: solid 1px #000;
    font-size: 30px;
    font-weight: 800;
    text-align: center;
  }

  .botoes-div {
    display: flex;
    justify-content: center;
    gap: 1em;
  }
  
  .botoes-div button a {
    color: #fff;
    text-decoration: none;
    font-weight: 700;
  }
  
  .botoes-div button {
    color: #fff;
    text-decoration: none;
    font-weight: 700;
  }

</style>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <!-- Jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  
</head>

<div class="form-linhas-colunas-div <?php echo $classe_esconde ?>">
  <form class="linhas-colunas-div" method="get">
    <input class="form-group" type="number" min="0" max="<?php echo $limite_colunas ?>" name="colunas" value="<?php echo $colunas ?>" placeholder="Digite um número de colunas (MAX <?php echo $limite_colunas ?>)">
    <input class="form-group" type="number" min="0" name="linhas" value="<?php echo $linhas ?>" placeholder="Digite um número de linhas">
    <input class="form-group" type="submit" value="Gerar">
  </form>
</div>

<div class="form-conteudo-div <?php echo $classe_esconde ?>" style="justify-content: center; display: flex;">
  <form class="colunas" method="get">

    <?php if(isset($_GET['colunas']) and isset($_GET['linhas']) and $_GET['linhas'] != '' and $_GET['colunas'] != ''): ?>
      <?php for ($c = 0; $c < $_GET['colunas']; $c++): ?>
        <input class="form-group" type="text" name="cabecalho[]" placeholder="Cabeçalho da coluna">
      <?php endfor; ?>
    <?php endif; ?>

</div>
  
<div class="form-conteudo-div">
  
    
    <?php if(isset($_GET['colunas']) and isset($_GET['linhas']) and $_GET['linhas'] != '' and $_GET['colunas'] != ''): ?>
      <div class="<?php echo $classe_esconde ?>" style="display: flex; justify-content: center;">
        <div class="input-organizar">
          
          <?php for ($l = 0; $l < $_GET['linhas']; $l++): ?>
    
            <div class="colunas">
              <?php for ($c = 0; $c < $_GET['colunas']; $c++): ?>
                <input class="form-group" type="text" name="coluna_text[]" placeholder="Conteúdo da coluna">
              <?php endfor; ?>
            </div>
          
          <?php endfor; ?>

          <input type="hidden" name="linhas" value="<?php echo $_GET['linhas']?>">
          <input type="hidden" name="colunas" value="<?php echo $_GET['colunas']?>">
          <input class="form-group" type="submit" name="gerar_tabela" value="Gerar tabela">
        </div>
      </div>
    <?php endif; ?>
  </form>

    <div class="tabela-final-group">
      <table id="tabela-final-dados" class="table-striped table-condensed table <?php echo $classe_aparece ?>" style="display: flex; justify-content: center;">
        
          <div class="table-organizar">
            <?php if(isset($_GET['colunas']) and isset($_GET['linhas']) and $_GET['linhas'] != '' and $_GET['colunas'] != ''): ?>
  
              <?php for($a = 0; $a < $_GET['colunas']; $a++): ?>
                <th class="titulo-cabecalho">
                  <?php echo $_GET['cabecalho'][$a]?>
                </th>
              <?php endfor; ?>
    
              <?php for($l = 0; $l < $_GET['linhas']; $l++): ?>
      
                <tr>
                <?php for($g = 0; $g < $_GET['colunas']; $g++): ?>
      
                    <td>
                      <?php
                        echo $_GET['coluna_text'][$contador];
                        $contador++;
                      ?>
                    </td>
    
                <?php endfor; ?>
                </tr>
      
              <?php endfor; ?>
            <?php endif; ?>
            
          </div>
  
      </table>
    <div class="botoes-div <?php echo $classe_aparece ?>">
      <button class="btn btn-primary"><a href="/">Gerar outra tabela</a></button>
      <button class="btn btn-danger" id="download-excel">Baixar em excel (.xls)</button>
    </div>
  </div>

  
</div>
  
</html>
    
<script>

  $('#download-excel').click(function() {
    exportToExcel();
  })
  
  function exportToExcel() {
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
      link.download = "export.xls";
      link.href = uri + base64(format(template, ctx));
      link.click();
  }
  
</script>