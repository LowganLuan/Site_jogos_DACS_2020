<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Lista de jogos</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/heroic-features.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a href="login.html" class="nav-link" href="#">Sair
              <span class="sr-only">(current)</span>
            </a>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">
    
    <?php
        include 'not_error.php';
        session_start();
        $sessao = $_SESSION['usuario'];
        $idlogin = $sessao['id'];
        //$con = mysqli_connect("localhost","bob","bob","univille");
        include 'dbconnect.php';
        $sql = "select * from lista_de_jogos where idusuario = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $idlogin);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $result);
        $result = mysqli_stmt_get_result($stmt);

      
    ?>
    
    <!-- Jumbotron Header -->
    <header class="jumbotron my-4">
    
      <div align="center">
        <h2>Lista de Jogos</h2>      
        <img src="jogos.gif"></img>
      </div>
      <a href="cadastrojogo.php?idlogin=<?=$idlogin?>" class="btn btn-success">Incluir</a>
    
      <p class="lead">
        <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Nome</th>
      <th scope="col">Data de inserção</th>
      <th scope="col">Ação</th>
    </tr>
  </thead>
  <tbody>
    <?php
    
       while($row = $result->fetch_assoc()){

    ?>
    <tr>
      <th scope="row"><?=$row['idjogo']?></th>
      <td><?=$row['nomejogo']?></td>
      <td><?=$row['data_insercao']?></td>
      <td><a href="cadastrojogo.php?idlogin=<?=$idlogin?>&id=<?=$row['idjogo']?>" class="btn btn-outline-warning">Alterar</a>
          <a href="confirmaremovejogo.php?idlogin=<?=$idlogin?>&id=<?=$row['idjogo']?>" class= "btn btn-outline-danger">Remover</a>
      </td>
      
    </tr>
  <?php
       }
  ?>
  </tbody>
</table>
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
