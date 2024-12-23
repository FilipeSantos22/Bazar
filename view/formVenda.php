<head>
    <script src="https:/https://bazarirc.comirc.com/view/assets/js/scripts.js"></script>
</head>

</head>
<body>

  <div class="container">
    <!-- <div class="border-primary"> -->
    <div class="left-side" id="borda-foto"></div><!--  Lado da foto -->

        <div class="right-side borda-form" id="borda-form"><!--  Lado do FORMULÁRIO -->
          
          <h2 class="text-center mb-5 text-light "><?=TITLE?></h2>
          
          <form action="" method="post">
              <div class="form-group">
                <label class="text-light" for="name">Nome:</label>
                <input type="text" class="form-control" id="name" name="nome" placeholder="Digite seu nome" required value="<?= $obProduto->getNome()?>">
              </div>

              <div class="form-group">
                <label class="text-light" for="cpf">Preço:</label>
                <input type="text" class="form-control" id="preco" name="preco" placeholder="0,00" onkeypress="return(mascaraValorReal(this,'.',',',event))" required maxlength="6" value="<?=$obProduto->getPreco()?>">
              </div>

              <div class="form-group">
                <label class="text-light" for="quantidade">Quantidade:</label>
                <input type="text" class="form-control" id="quantidade" name="quantidade" onkeypress="mascara(this)" placeholder="Qual a quantidade?" required maxlength="3"   value="<?=$obProduto->getQuantidade()?>">  
              </div>

              <!-- <div class="form-group">
                <label class="text-light" for="name">Categoria:</label>
                <input type="text" class="form-control" id="categoria" name="categoria" placeholder="Qual a categoria?" required value="">
              </div> -->

              <input  type="submit" id="enviarBtn" onclick="messageSuccess(event)" class="btn btn-primary mr-3">    
              <a href="https://bazarirc.com/index.php">
                <div class="btn btn-primary m3-3 ">Ver cadastros</div>
              </a>   
              <br>
              <br>
              <a href="https://bazarirc.com/index.php">
                <div class="btn btn-success m3-3 ">Nova Venda</div>
              </a> 
              <div id="successMessage" class="success-message">Form submitted successfully!</div>
          </form>
        </div>
      </div>
  </div>
</body>