<form name="dados" action="?controller=<?php echo $this->folderName ?>&action=edita" method="post" >
    <fieldset>
        <legend>Editar Usuário</legend>

        <input type="hidden" name="id" value="<?php echo $usuario[0]['UsuCodigo']?>" />
        
        <label>Nome</label>
        <input type="text" name="nome" value="<?php echo $usuario[0]['UsuNome']?>"/>

        <label>Login</label>
        <input type="text" name="login" value="<?php echo $usuario[0]['UsuLogin']?>"/>

        <label>Senha</label>
        <input type="text" name="senha" value="<?php echo $usuario[0]['UsuSenha']?>"/>
        <div class="control-group">
            <div class="controls">
                <input type="reset" name="limpar" class="btn"/>
                <input type="submit" name="enviar" class="btn btn-info"/>
            </div>
        </div>
    </fieldset>
</form>