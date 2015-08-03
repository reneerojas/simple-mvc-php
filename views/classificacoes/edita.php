<h1>Editar Usuário</h1>
<form name="dados" action="?controller=<?php echo $this->folderName?>&action=edita" method="post" >
    <input type="hidden" name="id" value="<?php echo $data[0]['ClaCodigo']?>" /><br />
    <input type="text" name="nome" value="<?php echo $data[0]['ClaNome']?>" /><br />
    <input type="submit" name="enviar" /><br />
    <input type="reset" name="limpar" /><br />
</form>