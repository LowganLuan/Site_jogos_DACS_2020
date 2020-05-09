<!DOCTYPE html>
<html lang="en">
  
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Cadastro jogo</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/heroic-features.css" rel="stylesheet">

</head>
<body>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="lista_de_jogos.php">Inicio</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a href="login.html"class="nav-link" href="#">Sair
              <span class="sr-only">(current)</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <?php
    $id=0;
    $nome="";
    $endereco="";
    $iduser = $_GET['idlogin'];
  
    if(isset($_GET['id'])){
      $con = mysqli_connect("localhost","bob","bob","univille");
      $select = "select * from lista_de_jogos where idjogo = ? and idusuario = ?";
      $stmt = mysqli_prepare($con, $select);
      mysqli_stmt_bind_param($stmt, "ii", $_GET['id'],$_GET['idlogin']);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_bind_result($stmt, $result);
      $result = mysqli_stmt_get_result($stmt);
      $row = $result->fetch_assoc();
      $id = $row['idjogo'];
      $nome = $row['nomejogo'];
 
      }
  ?>
  <!-- Page Content -->
  <div class="container">

    <!-- Jumbotron Header -->
    <header class="jumbotron my-4">
      <p class="lead">
        <h3>Jogo</h3>
        <form method="post" action="salvajogo.php">
          
          <input type="hidden" name="txtIdjogo" value="<?=$id?>">
          <input type="hidden" name="txtIduser" value="<?=$iduser?>">
          
          <div class="form-group">
            <label for="txtNome">Nome do Jogo</label>
            <input type="text" class="form-control" id="txtNome" name="txtNome" value="<?=$nome?>">
          </div>
         
           <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
      </p>
    </header>
 
  </div>
  <!-- /.container -->


  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>