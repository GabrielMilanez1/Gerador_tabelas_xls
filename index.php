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
</style>

<link rel="stylesheet" href="style.css">

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
    
<script src="scripts.js"></script>