<form action="?controller=<?php echo $this->folderName ?>&action=edita" method="post" >
    <fieldset>
        <legend>Editar Jogo</legend>

        <input type="hidden" name="id" value="<?php echo $data[0]['JogCodigo'] ?>" />

        <label>Nome</label>
        <input type="text" name="nome" value="<?php echo $data[0]['JogNome'] ?>"/>

        <label>Faixa Etaria</label>
        <input type="text" name="faixa" value="<?php echo $data[0]['JogFaixaEtaria'] ?>"/>

        <label>Classificação</label>
        <select name="classificacao">
            <?php
            if ($classificacoes)
                foreach ($classificacoes as $classificacao):
                    echo "<option value=\"{$classificacao['ClaCodigo']}\" ";
                    echo ($classificacao['ClaCodigo'] == $data[0]['ClaCodigo']) ? "selected" : "";
                    echo ">{$classificacao['ClaNome']}</option>";
                endforeach;
            ?>
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