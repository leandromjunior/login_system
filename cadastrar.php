<?php
function validaCPF($cpf = null) {

	// Verifica se um número foi informado
	if(empty($cpf)) {
		$cpf = 'NULL';
	}

	// Elimina possivel mascara
	$cpf = preg_replace("/[^0-9]/", "", $cpf);
	$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
	
	// Verifica se o numero de digitos informados é igual a 11 
	if (strlen($cpf) != 11) {
		$cpf = 'NULL';
	}
	// Verifica se nenhuma das sequências invalidas abaixo 
	// foi digitada. Caso afirmativo, retorna falso
	else if ($cpf == '00000000000' || 
		$cpf == '11111111111' || 
		$cpf == '22222222222' || 
		$cpf == '33333333333' || 
		$cpf == '44444444444' || 
		$cpf == '55555555555' || 
		$cpf == '66666666666' || 
		$cpf == '77777777777' || 
		$cpf == '88888888888' || 
		$cpf == '99999999999') {
		$cpf = 'NULL';
	 // Calcula os digitos verificadores para verificar se o
	 // CPF é válido
	 } else {   
		
		for ($t = 9; $t < 11; $t++) {
			
			for ($d = 0, $c = 0; $c < $t; $c++) {
				$d += $cpf{$c} * (($t + 1) - $c);
			}
			$d = ((10 * $d) % 11) % 10;
			if ($cpf{$c} != $d) {
				$cpf = 'NULL';
			}
		}

		return true;
	}
}
  
$host="localhost";
$user="root";
$pass="";
$banco="cad";
$conexao=mysqli_connect($host,$user,$pass) or die(mysql_error());
mysqli_select_db($conexao,$banco) or die(mysql_error());

$nome=$_POST['nome'];
$email=$_POST['email'];
$cpf=$_POST['cpf'];
$end=$_POST['endereco'];
$cidade=$_POST['cidade'];
$estado=$_POST['estado'];
$senha=$_POST['senha'];

/*if($_POST['button']=="Enviar"){
    $sql="insert into usuarios(nome,email,cpf,end,cidade,estado,senha) values ('$nome','$email','$cpf','$end','$cidade','$estado','$senha')";
    echo"<center>Cadastro realizado!</center>";
    
     mysqli_close($conexao);
}*/
$senha = md5($senha);

/*$sql=mysqli_query($conexao, "insert into usuarios(nome,email,cpf,endereco,cidade,estado,senha) values ('$nome','$email','$cpf','$end','$cidade','$estado','$senha')");
echo"<center>Cadastro realizado!</center>"; */

if($_POST['button']=="Enviar"){
   $sql="insert into usuarios(nome,email,cpf,endereco,cidade,estado,senha) values ('$nome','$email','$cpf','$end','$cidade','$estado','$senha')";
    
   
if((strlen($cpf == 11))  ){
       echo"cpf ok";
   }else{
       $sql="insert into usuarios(nome,email,cpf,endereco,cidade,estado,senha) values ('$nome','$email','','$end','$cidade','$estado','$senha')";
   }
   //verifica se o formato do email é valido
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
echo 'E-mail válido!';
} else {
echo 'E-mail inválido!';
$sql="insert into usuarios(nome,email,cpf,endereco,cidade,estado,senha) values ('$nome','','$cpf','$end','$cidade','$estado','$senha')";
} 
    
if(mysqli_query($conexao,$sql)){
echo"<center><h1>cadastrado com sucesso!</center></h1>";
} 

}


if($_POST['button']=="Atualizar"){
    $sql="update usuarios set nome='$nome',email='$email',cpf='$cpf',endereco='$end',cidade='$cidade',estado='$estado', where cpf='$cpf'";
  /* $sql="update usuarios set nome='$nome' where email='$email'";
   $sql="update usuarios set email='$email' where cpf='$cpf'";
    $sql="update usuarios set cidade='$cidade' where email='$email'"; */
    if(mysqli_query($conexao,$sql)){
        echo"<h1><center>Cadastro atualizado com sucesso!</center></h1>";
    }
    else{
        echo"<h1><center>Sem sucesso</center></h1>";
    }
}
mysqli_close($conexao);


?>
<html>
    <head>
        <title>Cadastro</title>
    </head>
    <a href="login.html">Login</a>
</html>


