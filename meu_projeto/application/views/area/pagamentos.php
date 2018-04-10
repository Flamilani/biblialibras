<div class="container ladosTela">
    <div class="front">
        <h3 class="tituloCima"><a href="<?php echo base_url('area'); ?>">Área do Usuário</a> > Pagamentos</h3>
    </div>


    <div class="panel panel-success">
    <div class="panel-heading">
        <h4>Pagamentos</h4>
    </div>
    <div class="panel-body">  <?php if (!empty($pagos)): ?>
            <table width="100%" class="tabela1 table table-striped table-bordered table-hover" id="tabela1">
                <thead>
                <tr>
                    <!-- <th>ID</th> -->
                    <th>ID</th>
                    <th>Código</th>
                    <th>Forma Pag.</th>
                    <th>Plano</th>
                    <th>Valor</th>
                    <th>Data Pago</th>
                    <th>Status Pago</th>
                    <th>Comprovante</th>
                    <!--    <th>Ações</th> -->
                </tr>
                </thead>

                <tbody>
                <?php foreach ($pagos as $pg): ?>

                    <tr class="odd gradeX">
                        <td class="text-center"><?php echo $pg->id_pago; ?></td>
                        <td class="text-center">#<?php echo $pg->codigo; ?></td>
                        <td class="text-center">
                            <?php echo tipo_pagam($pg->id_forma_pago); ?>
                        </td>
                        <td class="text-center"><?php echo $pg->nome_plano; ?><br> (<?php echo $pg->duracao; ?> <?php echo FormPeriodo($pg->periodo); ?>)</td>
                        <td class="text-center"><?php echo reais($pg->valor); ?></td>
                        <td class="text-center">
                            <?php echo isset($pg->data_ultimo) && $pg->data_ultimo != '' ? FormData($pg->data_ultimo) : '<span style="font-size: 15px;" class="label label-warning">Sem Data</span>' ?>
                        <td class="text-center">
                        <?php if(isset($pg->status_pago) && $pg->status_pago == 3): ?>
                            <span style="font-size: 15px;" class="label label-danger">Cancelado</span>
                        <?php elseif(isset($pg->status_pago) && $pg->status_pago == 2): ?>
                            <span style="font-size: 15px;" class="label label-success">Pago</span>
                        <?php elseif(isset($pg->status_pago) && $pg->status_pago == 1): ?>
                            <span style="font-size: 15px;" class="label label-warning">Enviado</span>
                        <?php else: ?>
                            <span style="font-size: 15px;" class="label label-primary">Aguardando</span>
                        <?php endif; ?>
                        <td class="text-center">
                            <?php if(isset($pg->comprovante) && $pg->comprovante != null): ?>
                                <a href="<?php echo base_url('assets/comprovantes/' . $pg->comprovante); ?>" rel="shadowbox[<?php echo $pg->id_pago; ?>]" title="Clique aqui para ampliar comprovante">
                                    <img class="exibeImg" src="<?php echo base_url('assets/comprovantes/' . $pg->comprovante); ?>" id="img_upload" alt="" />
                                </a>
                                <a href="<?php echo base_url('area/comprovante/' . $pg->id_plano); ?>" title="Editar" class="btn btn-sm btn-success">Alterar Comprovante</a>
                            <?php else: ?>

                                <a href="<?php echo base_url('area/comprovante/' . $pg->id_plano); ?>" title="Inserir" class="btn btn-sm btn-primary">Inserir Comprovante</a>
                            <?php endif; ?>
                        </td>

                        <!--  <td class="text-center">
            <a href="<?php echo base_url('admin/assinaturas/alterar_assina/' . $ass->id_assinatura); ?>" title="Editar" class="btn btn-sm btn-primary"><b><i class="fa fa-edit"></i></b></a>

  <a href="<?php echo base_url('admin/assinaturas/deletar/' . $ass->id_assinatura); ?>" onclick="return confirmarExclusao(<?php echo $ass->id_assinatura; ?>)" title="Deletar" class="btn btn-sm btn-danger"><b><i class="fa fa-trash-o"></i></b></a>
                                      </td> -->
                    </tr>
                <?php endforeach; ?>

                </tbody>

            </table>
        <?php else: ?>
            <div class="alert alert-info text-center" role="alert"><h3>Não há pagamentos. <br> <a href="<?php echo base_url("home/pagamento"); ?>">Confere aqui.</a></h3></div>
        <?php endif; ?>
    </div>
</div>
</div>