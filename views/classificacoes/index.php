<?php if (!empty($data)) { ?>
<h1>Listagem de Usuários</h1>
    <table class="table table-striped table-hover">
        <tr>
            <th>Codigo</th>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
        <?php
        foreach ($data as $reg):
            ?>
            <tr>
                <td><?php echo $reg['ClaCodigo'] ?></td>
                <td><?php echo $reg['ClaNome'] ?></td>
                <td>
                    <a class="btn btn-small" href="?controller=<?php echo $this->folderName ?>&action=detalhe&id=<?php echo $reg[$this->idField] ?>" >Ver</a> 
                    <a class="btn btn-small" href="?controller=<?php echo $this->folderName ?>&action=edita&id=<?php echo $reg[$this->idField] ?>">Editar</a> 
                    <a class="btn btn-small btn-danger" href="?controller=<?php echo $this->folderName ?>&action=remove&id=<?php echo $reg[$this->idField] ?>">Excluir</a>
                </td>
            </tr>
            <?php
        endforeach;
        ?>
    </table>
    <?php
}
else
    echo "nenhum usuario foi encontrado";
?>