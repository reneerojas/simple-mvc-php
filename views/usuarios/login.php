<h1>Efetue seu login</h1>
<form action="?controller=<?php echo $this->folderName?>&action=login" method="post" >
    <input type="text" name="login" /><br />
    <input type="text" name="senha" /><br />
    <input type="submit" name="enviar" /><br />
    <input type="reset" name="limpar" /><br />
</form>
<?
if (isset($error)){
    echo "<h2>$error</h2>";
}
?>