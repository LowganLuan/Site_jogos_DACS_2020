 <?php

    include 'not_error.php';
    include 'dbconnect.php';
    $id = $_GET['id'];
    $iduser = $_GET['iduser'];
  //  $con = mysqli_connect("localhost","bob","bob","univille");
    
  
    
    $delete = "delete from lista_de_jogos where idjogo = ? and idusuario=?";
    $stmt = mysqli_prepare($conn, $delete);
    mysqli_stmt_bind_param($stmt, "ss", $id, $iduser);
    mysqli_stmt_execute($stmt);
  
    header('Location: '. 'lista_de_jogos.php');
?>

