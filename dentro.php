<meta charset="UTF-8">
<?php
session_start();

$host="localhost";
$user="root";
$pass="";
$banco="cad";
$conexao=mysqli_connect($host,$user,$pass) or die(mysql_error());
mysqli_select_db($conexao,$banco) or die(mysql_error()); 

if(isset($_SESSION['adm'])){
    echo"Bem-vindo ".$_SESSION['adm'].' - ADMINISTRADOR';
    
    // cria a instrução SQL que vai selecionar os dados
$query = sprintf("SELECT nome, email, cpf, endereco, cidade, estado, senha FROM usuarios");
// executa a query
$dados = mysqli_query($conexao,$query) or die(mysql_error());
// transforma os dados em um array
$linha = mysqli_fetch_assoc($dados);
// calcula quantos dados retornaram
$total = mysqli_num_rows($dados);
?>
<html>
    <head>
    <title>dentro</title>
</head>
<body>
   <tr>
 <th>Nome</th>
 <th>Email</th>
 <th>CPF</th>
 </tr>
</body>
<?php
    // se o número de resultados for maior que zero, mostra os dados
    if($total > 0) {
        // inicia o loop que vai mostrar todos os dados
        do {
?>
<!-- <p><?=$linha['nome']?> | <?=$linha['email']?> | <?=$linha['cpf']?> | <?=$linha['endereco']?> | <?=$linha['cidade']?> | <?=$linha['estado']?></p> -->
    
    <!-- Apenas design da tabela - fora do php -->
    <table border="1" style='width:50%'>
 
 <?php 
    echo"<td>".$linha['nome']."</td>";  
    echo"<td>".$linha['email']."</td>";
    echo "<td>".$linha['cpf']."</td>";
    echo "<td>".$linha['endereco']."</td>";
    ?>
<?php
        // finaliza o loop que vai mostrar os dados
        }while($linha = mysqli_fetch_assoc($dados));
    // fim do if 
    }
?>
</body>
</html>
<?php
// tira o resultado da busca da memória
mysqli_free_result($dados);
?>



<?php
    }
else if(isset($_SESSION['nor'])){
    echo"Bem-Vindo ".$_SESSION['nor'].'';
    
    $q = sprintf("select titulo, datas, resumo from noticias");
    
    $d = mysqli_query($conexao,$q) or die(mysql_error());
    $l = mysqli_fetch_array($d);
    $t = mysqli_num_rows($d);
    
    if($t > 0) {
        // inicia o loop que vai mostrar todos os dados
        do {
            echo"<br><br><td>".$l['titulo']."</td>";  
    echo"<br><td>".$l['datas']."</td>";
    echo "<br><td>".$l['resumo']."</td>";
        
     }while($l = mysqli_fetch_assoc($d));
    // fim do if 
    }
    }
else{
    echo'<script type="text/javascript">window.location= "login.html"</script>';
}

?>

<a href="logout.php">Sair</a>

