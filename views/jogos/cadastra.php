<form action="?controller=<?php echo $this->folderName ?>&action=cadastra" method="post" >
    <fieldset>
        <legend>Cadastrar Jogo</legend>

        <label>Nome</label>
        <input type="text" name="nome" />

        <label>Faixa Etaria</label>
        <input type="text" name="faixa" />

        <label>Classificação</label>
        <select name="classificacao">
            <?php
            if ($classificacoes)
                foreach ($classificacoes as $classificacao):
                    echo "<option value=\"{$classificacao['ClaCod']}\">{$classificacao['ClaNome']}</option>";
                endforeach;
            ?>
        </select>

        <div class="control-group">
            <div class="controls">
                <input type="reset" name="limpar" class="btn"/>
                <input type="submit" name="enviar" class="btn btn-info"/>
            </div>
        </div>
    </fieldset>
</form>