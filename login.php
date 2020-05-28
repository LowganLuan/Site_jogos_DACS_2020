<?php session_start(); ?>
<?php
    
     include 'not_error.php';

    

 
    //verificar se os dados vieram de um POST
    if ($_POST) {
        //conectar no banco de dados - incluir o arquivo do banco
        
        //recuperar a variaveis vindas do formulario
        $login = trim($_POST["login"]);
        $senha = trim($_POST["senha"]);
        //caso o usuario deixe espaços em branco, o trim retira espaços em branco
        
        
        // para validar os campos em branco. "A tal da criação de condições!"
        if (empty($login)) {
            //se o login estiver em branco exibe esta mensagem: "preencha o login"
            echo "<script>alert('Preencha o Login');history.back();</script>";
            return;
        }
        else if (empty($senha)) {
            //se a senha estiver em branco  exibe esta mensagem: "Preencha o campo senha"
            echo "<script>alert('Preencha o campo senha');history.back();</script>";
        
            return;
        }
        else {
            //se os campos estiverem preenchidos corretamente - valida usuario
           
      
      
           
            include 'dbconnect.php';
            //$con = mysqli_connect("localhost","bob","bob","univille");
            $select = "select * from usuarios where login = ?";
            $stmt = mysqli_prepare($conn, $select);
            mysqli_stmt_bind_param($stmt, "s", $login);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $result);
            $result = mysqli_stmt_get_result($stmt);

            $row = $result->fetch_assoc();
      
            $login2 = $row["login"];
            $senha2 = md5($row["senha"]);
            //criptografar senha
            $senha = md5($senha);
            //verificar se o usuario existe
            if (empty($login2)) {
                echo "<script>alert('Usuario nao existe');history.back();</script>";
                return;
            } else if ($senha != $senha2) {
                //se a senha digitada for diferente da senha do banco
                echo "<script>alert('Senha inválida');history.back();</script>";
                return;
            } else {
                //se existir gravar os dados na sessao e enviar
                //para a proxima pagina - home.php
                $_SESSION["usuario"] = array("id"=>$row["ID"],
                                                    "login"=>$row["login"]);
                //redirecionar para o arquivo home.php
                header("Location: lista_de_jogos.php");
 
            }
 
        }
        // se tiver com o login e a senha erradas exibe esta mensagem: Requisicao invalida!
    } else {
       echo "Requisicao invalida!";
       return;
        exit;
    }
?>