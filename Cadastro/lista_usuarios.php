<?php
    require_once "conexao.php";
    $usuarios = get_usuarios();
?>
<div class="container">
    <h1>Lista de Usuários</h1>
    <table style="border=1px;">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
        </tr>
        <?php foreach ($usuarios as $usuario): ?>
        <tr>
            <td><?php echo htmlspecialchars($usuario['id']); ?></td>
            <td><?php echo htmlspecialchars($usuario['nome']); ?></td>
            <td><?php echo htmlspecialchars($usuario['email']); ?></td>
            <td><a href="editar_usuario.php?id=<?php echo urldecode($usuario['id'])?>">Editar</a></td>
        </tr>
        <?php endforeach ?>
    </table>
</div>