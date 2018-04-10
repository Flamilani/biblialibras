<?php $plano_id = $this->uri->segment(3); ?>
<?php $rowsPlanos = $this->db->query("SELECT * FROM planos WHERE status = 1"); ?>
<?php $countPls = $rowsPlanos->result(); ?>
<?php $rowsPlano = $this->db->query("SELECT * FROM plano p INNER JOIN planos ps ON p.id_planos = ps.id_planos WHERE p.id_plano = {$plano_id} AND p.status = 1"); ?>
<?php $countPl = $rowsPlano->result(); ?>
<?php $rowsPlanoLivro = $this->db->query("SELECT * FROM plano_livro WHERE id_planos = {$countPl[0]->id_planos}"); ?>
<?php $countPLivro = $rowsPlanoLivro->result(); ?>
<?php $user = $this->session->userdata('user')->id; ?>
<?php $rowAssinatura = $this->db->query("SELECT * FROM assinaturas WHERE id_plano = {$plano_id} AND id_user = {$user}"); ?>
<?php $pAssinatura = $rowAssinatura->num_rows(); ?>
<?php if($pAssinatura == 0): ?>
<form action="<?php echo base_url('home/finalizar_plano'); ?>" method="post">
     <div class="container headTop">
      <br>  
      <?php if(isset($suspensao[0]->status) && $suspensao[0]->status == 1 && $suspensao[0]->data_final >= date('Y-m-d')): ?>
          <div class="alert alert-info text-center" role="alert">
            <h2><?php echo $suspensao[0]->titulo; ?></h2>
  <h3><?php echo $suspensao[0]->conteudo; ?></h3>
</div>    
  <?php endif; ?>    
                    <h2 class="text-center"><a href="<?php echo base_url('home'); ?>">Planos</a> > Finalizar Compra</h2><br><br>
         <?php if(isset($dados[0]->banco_status) && $dados[0]->banco_status == 1): ?>
         <div class="col-lg-6 col-md-6 text-center">
         <?php else: ?>
					 	 <div class="col-lg-12 col-md-12 text-center">
                             <?php endif; ?>
            <div style="font-size: 18px;" class="panel panel-success">
      <div class="panel-heading"><b>Plano Escolhido</b>  </div>


               
                                        
          <table class="table table-bordered text-center">          
  
            <tr>
              <td><b>Plano</b></td>
              <td> <?php echo $countPl[0]->nome_plano; ?></td>
            </tr>
            <tr>
            <td><b>Qtd.</b></td>
            <td><?php echo count(explode(',', $countPLivro[0]->params)); ?> <?php plural(count(explode(',', $countPLivro[0]->params)), 'Livro', 'Livros') ?></td>
            </tr>
            <tr>
            <td><b>Período</b></td>
            <td><?php echo $countPl[0]->duracao; ?> <?php echo FormPeriodo($countPl[0]->periodo); ?></td>
            </tr>
            <tr>
              <td><b>Valor</b></td>
              <td><?php echo reais($countPl[0]->valor); ?></td>
            </tr>
            
            </table>

					 </div>
				</div>
         <!--    <div class="form-group text-left">
              <label for="forma_pago">Forma de Pagamento</label>
              <select class="form-control" name="forma_pago" id="forma_pago">
                <option value="deposito">Depósito</option>
                <option value="pagseguro">PagSeguro</option>
              </select>
            </div> -->
        <?php if(isset($dados[0]->banco_status) && $dados[0]->banco_status == 1): ?>
        <div class="col-lg-6 col-md-6 text-center">    
				<div style="font-size: 18px;" class="panel panel-primary">
			  <div class="panel-heading"><b>Depósito / Transferência Bancária</b>  </div>
						  
			  	<table class="table table-bordered text-center">		  		
	
    				<tr>
    					<td><b>Favorecido</b></td>
    					<td> <?php echo $dados[0]->banco_favorecido; ?></td>
    				</tr>
    					<td><b>Banco</b></td>
    					<td><?php echo $dados[0]->banco_nome; ?></td>
    				<tr>
    					<td><b>Agência</b></td>
    					<td><?php echo $dados[0]->banco_agencia; ?></td>
    				</tr>
    				<tr>
    					<td><b>Conta <?php echo tipo_conta($dados[0]->banco_conta_tipo); ?></b></td>
    					<td><?php echo $dados[0]->banco_conta; ?>
    			<?php if(isset($dados[0]->banco_digito) && empty($dados[0]->banco_digito) == false): ?>  
 					- <?php echo $dados[0]->banco_digito; ?>			
    							<?php else: ?>
							- 0
    							<?php endif; ?></td>
    				</tr>    			
  			    </table>
		
				</div>
  </div>
         <?php endif; ?>
					 </div>
             
   <input name="favorecido" id="favorecido" type="hidden" value="<?php echo $dados[0]->banco_favorecido; ?>" />
   <input name="nome_banco" id="nome_banco" type="hidden" value="<?php echo $dados[0]->banco_nome; ?>" />
   <input name="agencia" id="agencia" type="hidden" value="<?php echo $dados[0]->banco_agencia; ?>" />
   <input name="tipo_conta" id="tipo_conta" type="hidden" value="<?php echo $dados[0]->banco_conta_tipo; ?>" />
   <input name="conta" id="conta" type="hidden" value="<?php echo $dados[0]->banco_conta; ?>" />
   <input name="digito" id="digito" type="hidden" value="<?php echo $dados[0]->banco_digito; ?>" />
   <input name="plano" id="plano" type="hidden" value="<?php echo $countPl[0]->nome_plano; ?>" />
   <input name="duracao" id="duracao" type="hidden" value="<?php echo $countPl[0]->duracao; ?>" />
   <input name="periodo" id="periodo" type="hidden" value="<?php echo FormPeriodo($countPl[0]->periodo); ?>" />
   <input name="nome" id="nome" type="hidden" value="<?php echo $this->session->userdata('user')->nome; ?>" />
   <input name="sobrenome" id="sobrenome" type="hidden" value="<?php echo $this->session->userdata('user')->sobrenome; ?>" />
   <input name="email" id="email" type="hidden" value="<?php echo $this->session->userdata('user')->email; ?>" />
   <input name="valor" id="valor" type="hidden" value="<?php echo reais($countPl[0]->valor); ?>" />
   <input name="id_forma_pago" id="id_forma_pago" type="hidden" value="1" />
  <input name="id_user" id="id_user" type="hidden" value="<?php echo $this->session->userdata('user')->id; ?>" />
      <input name="id_plano" id="id_plano" type="hidden" value="<?php echo $plano_id; ?>" />
       <?php if(isset($suspensao[0]->status) && $suspensao[0]->status == 1 && $suspensao[0]->data_final >= date('Y-m-d')): ?>
                         <div class="row">
              <div class="col-lg-12 text-center">
              <button id="btn_suspensao" class="btn btn-success btn-lg" disabled="disabled">Assinar</button>
            </div>
          </div>
          <?php else: ?>
          <div class="row">
              <div class="col-lg-12 text-center">
                <button id="btn_realizar" type="submit" class="btn btn-success btn-lg">Pagar</button>
                <button id="btn_carregar" class="btn btn-info btn-lg" disabled="disabled">Carregando...</button>
              </div>
            </div>
           <?php endif; ?>
            </form>
  <br><br>

<?php else: ?>
    <?php
    $this->session->set_flashdata("erro_assinatura", "Erro");
    redirect(base_url('home')); ?>
<?php endif; ?>

            <script type="text/javascript">
$(document).ready(function(){

    $('#btn_carregar').hide();

    $("#btn_realizar").mouseup(function (){
        $('#btn_realizar').hide();
        $('#btn_carregar').show();
    });


    $("select").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            if(optionValue){
                $(".box").not("." + optionValue).hide();
                $("." + optionValue).show();
            } else{
                $(".box").hide();
            }
        });
    }).change();
});
</script>