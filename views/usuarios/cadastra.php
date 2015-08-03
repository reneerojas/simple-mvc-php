<form action="?controller=<?php echo $this->folderName ?>&action=cadastra" method="post" >
    <fieldset>
        <legend>Cadastrar Usuário</legend>

        <label>Nome</label>
        <input type="text" name="nome" />

        <label>Login</label>
        <input type="text" name="login" />

        <label>Senha</label>
        <input type="text" name="senha" />
        <div class="control-group">
            <div class="controls">
                <input type="reset" name="limpar" class="btn"/>
                <input type="submit" name="enviar" class="btn btn-i"/>
            </div>
        </div>
    </fieldset>
</form>