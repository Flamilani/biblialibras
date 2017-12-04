<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Pagamento</title>
    </head>
    <body>
        <h2>Raízes Surdos Brasil</h2>
        <h3>Seu pagamento foi enviado com sucesso.</h3>
        <p>
            Olá, <?php echo $user_nome; ?> <br />
            Muito obrigado por ser cliente no nosso site RSB.
        </p>
        <hr />
        <p>
            Para concluir seu pagamento e tem que enviar seu comprovante de pagamento na sua área do cliente para liberar o investimento, clique no link abaixo.
        </p>
        <p>
            <a style="padding: 5px; background-color: #007bb6; color: #fff;" href="<?php echo base_url("investimento/comprovante/" . md5($user_email)); ?>">Confere seu pagamento na área do cliente.</a>
        </p>
        <h4>Seja bem-vindo ao site RSB e faça bom investimento!</h4>
    </body>
</html>
