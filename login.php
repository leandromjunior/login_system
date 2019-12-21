<?php

$host="localhost";
$user="root";
$pass="";
$banco="cad";


$conexao=mysqli_connect('localhost','root','') or die(mysql_error());
mysqli_select_db($conexao,$banco) or die(mysql_error()); 

 //comando isset -  Informa se a variável foi iniciada
if(isset($_POST['email']) && isset($_POST['senha'])) {
    $email=$_POST['email'];
    $senha=$_POST['senha'];
    $senha = md5($senha); //criptografia das senhas
    
    //Seleciona através do select o email correspondido
    $sql=mysqli_query($conexao,"select * from usuarios where email='$email' and senha='$senha'");
    //retorna o numero de linhas
    $num = mysqli_num_rows($sql);
    
    //echo $num;
}
    
    if($num == 1){
        while($percorrer = mysqli_fetch_array($sql)){
            $adm = $percorrer['adm'];
            $nome = $percorrer['nome'];
            session_start();
            
            if($adm == 1){
                $_SESSION['adm'] = $nome;
            }
            else{
                $_SESSION['nor'] = $nome;
            }
            echo'<script type="text/javascript">window.location= "dentro.php"</script>';
        }
         //header("Location: dentro.php"); //tirar
         
        }
    else{
        echo"Email ou senha inválidos.";
    }
    
    //if (!isset($_SESSION)) session_start();
    
 


?>
<!--<a href="login.html"></a> -->
