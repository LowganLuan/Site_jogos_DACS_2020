<?php
      include 'not_error.php';
      include 'dbconnect.php';
   
      session_start();
  
   
    //verificar se os dados vieram de um POST
    if ($_POST) {
        //conectar no banco de dados - incluir o arquivo do banco
        
         //recuperar a variaveis vindas do formulario
         $login   = trim($_POST["login"]);
         $senha   = trim($_POST["senha"]);
         $resenha = trim($_POST["resenha"]);
         //caso o usuario deixe espaços em branco, o trim retira espaços em branco
         //$conn = mysqli_connect("localhost","bob","bob","univille");
         
         $select = "select * from usuarios where login = ?;";
         $stmts = mysqli_prepare($conn, $select);
         mysqli_stmt_bind_param($stmts, "s", $login);
         mysqli_stmt_execute($stmts);
         mysqli_stmt_bind_result($stmt, $results);
         $results = mysqli_stmt_get_result($stmts);
         $roww = $results->fetch_assoc();
      
         $login1 = $roww["login"];
        
        // para validar os campos em branco. "A tal da criação de condições!"
        if (empty($login)) {
            //se o login estiver em branco exibe esta mensagem: "preencha o login"
            echo "<script>alert('Preencha o campo nome');history.back();</script>";
        }
        else if (empty($senha) or empty($resenha)) {
            //se a senha estiver em branco  exibe esta mensagem: "Preencha o campo senha"
            echo "<script>alert('Preencha os dois campos de senhas');history.back();</script>";
        }
        else if ($senha != $resenha){
            echo "<script>alert('As senhas estão diferentes, preencha novamente!');history.back();</script>";
        }else if ($login1 == $login) {
            echo "<script>alert('Usuário ja existe');history.back();</script>";
        }
        else {
            //se os campos estiverem preenchidos corretamente - valida usuario
            
        //    $con = mysqli_connect("localhost","bob","bob","univille");
            $insert = "insert into usuarios(login,senha) values(?,?)";
            $stmt = mysqli_prepare($conn, $insert);
            mysqli_stmt_bind_param($stmt, "ss", $login, $resenha);
            mysqli_stmt_execute($stmt);
            
            header('Location: '. 'confirmacadastro.html');
            //redirecionar para o arquivo home.php
 
        }
        // se tiver com o login e a senha erradas exibe esta mensagem: Requisicao invalida!
    } else {
       echo "Requisicao invalida!";
        exit;
    }
?>