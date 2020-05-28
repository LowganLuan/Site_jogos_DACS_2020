<?php
    $id       = $_POST['txtIdjogo'];
    $nome     = $_POST['txtNome'];
    $idlogin  = $_POST['txtIduser'];
    $today = date("Y"."."."n"."."."j");
    include 'not_error.php';

    include 'dbconnect.php';
    //$con = mysqli_connect("localhost","bob","bob","univille");
    if($id == "0"){
        $insert = "insert into lista_de_jogos(idusuario, nomejogo, data_insercao) values(?, ?, ?);";
        $stmt = mysqli_prepare($conn, $insert);
        mysqli_stmt_bind_param($stmt, "sss", $idlogin, $nome, $today);
        mysqli_stmt_execute($stmt);
        
    }else{
        $update = "update lista_de_jogos set nomejogo=? where idjogo=? and idusuario=?";
        $stmt = mysqli_prepare($conn, $update);
        mysqli_stmt_bind_param($stmt, "sss", $nome, $id, $idlogin);
        mysqli_stmt_execute($stmt);
    }
   
   
    header('Location: '. 'lista_de_jogos.php');
?>
