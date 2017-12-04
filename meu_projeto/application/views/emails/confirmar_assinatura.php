<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Assinatura</title>
    </head>
    <body>
        <h2>Bíblia em Libras</h2>
        <h3>Confirmação de Assinatura</h3>
        <p>
            Olá, <?php echo $nome; ?> <br />
            Muito obrigado por se assinar no nosso site Bíblia em Libras.
        </p>
        <hr />
        <p>
            Para concluir sua assinatura e liberar sua conta para acessar na área do cliente, clique no link abaixo.
        </p>
        <p>
            <a style="border: 1px solid #ccc; background-color: #007bb6; color: #fff;" href="<?php echo base_url("registro/confirmar/" . md5($user_email)); ?>">Confirmar assinatura no site.</a>
        </p>
        <h4>Seja bem-vindo ao site Bíblia em Libras e tenha a Palavra de Deus em Libras!</h4>
    </body>
</html>
