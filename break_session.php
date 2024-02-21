<?
session_start();
$_SESSION['logged']['cod_us']="";
session_destroy();

if($pos)
{
	$_POST['url'] = "index.php";
}

?>
<script> location.href="<?=$_POST['url']?>"; </script>