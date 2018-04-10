<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Pagamento</title>
    </head>
    <body>
        <h2>A Bíblia em Libras</h2>
        <h3>Seu pagamento foi enviado com sucesso.</h3>
        <p>
            Olá, <?php echo $nome; ?> <br />
            Muito obrigado por ser assinante no nosso site A Bíblia em Libras.
        </p>
        <hr />
        <p>
           Agora pode acessar na área do Usuário, clique no link abaixo.
        </p>
        <p>
            <a style="padding: 5px; background-color: #007bb6; color: #fff;" href="<?php echo base_url("home/login"); ?>"> Clique aqui para logar</a>
        </p>
        <h4>Seja bem-vindo ao site A Bíblia em Libras e e tenha a Palavra de Deus em Libras!</h4>
    </body>
</html>
