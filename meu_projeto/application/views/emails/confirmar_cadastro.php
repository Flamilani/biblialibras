<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Confirmação de Cadastro</title>
    </head>
    <body>
        <h2>Bíblia em Libras</h2>
        <h3>Confirmação de Cadastro</h3>
        <p>
            Olá, <?php echo $nome; ?> <br />
            Muito obrigado por se cadastrar no nosso site Bíblia em Libras.
        </p>
        <hr />
        <p>
            Para concluir seu cadastro e liberar sua conta para acessar na área do cliente, clique no link abaixo.
        </p>
        <p>
            <a style="padding: 5px; text-decoration: none; border: 1px solid #ccc; background-color: #007bb6; color: #fff;" href="<?php echo base_url("users/confirmar/" . md5($email)); ?>">Confirmar cadastro no site.</a>
        </p>
        <h4>Seja bem-vindo ao site A Bíblia em Libras e tenha a Palavra de Deus em Libras!</h4>
    </body>
</html>
