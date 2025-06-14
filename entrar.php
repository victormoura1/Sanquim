<<?php 
include 'conexao.php';

$user=$_REQUEST['usuario'];
$pass=$_REQUEST['senha'];
$consulta="SELECT * FROM usuarios WHERE usuario='$user' AND senha='$pass'";

$resultado=mysqli_query($link,$consulta)or die("Erro na consulta");
if(mysqli_num_rows($resultado)>0)
    header("location:./Aluno/phpA/pagina1.php");
else{
    header("location:Login/login.html");
}
mysqli_close($link); //fecha o banco de dados 
?>