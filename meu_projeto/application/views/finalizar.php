   <form action="<?php echo base_url('home/finalizar_compra'); ?>" method="post">
     <div class="container headTop">
      <div class="row">
                <div class="col-lg-12 front">
                    <h3 class="text-center">Finalizar Compra</h3><br><br>                 
					 <div class="col-lg-6 col-md-6 text-center">
					 	<div class="table-responsive">
					 <table class="table table-bordered text-center">		  
					 		
					 		
					 			   <?php if (!empty($this->cart->contents())): ?>           
					 			<?php $c = 1; ?>
					 			<tr>
					 			<td class="bg-info"><b>Livro</b></td>
					 			<td class="bg-info"><b>Valor</b></td>
					 		</tr>
									
                                 <?php foreach($this->cart->contents() as $item): ?>
                                 <?php echo form_hidden($c . '[rowid]', $item['rowid']); ?>
                                 	<tr>
					 			<td><?php echo $item['name']; ?></td>
					 			<td><?php echo reais($item['price']); ?></td>
					 			</tr>
					 			<?php $c++; ?>
                                             <?php endforeach; ?>
                                             	
                                                       <?php else: ?><br>
                                <div class="alert alert-info" role="alert">Seu carrinho está vazio! 
                                </div>
                                        <?php endif; ?>
					 	
					 	</table>
					 </div>
					 <h5>Total de Livros:  <?php echo $this->cart->total_items(); ?></h5>
				<h4>Valor Total a Pagar: <?php echo reais($this->cart->total()); ?></h4>
				<br>
					 </div>
					 <div class="col-lg-6 col-md-6 text-center">
         <!--    <div class="form-group text-left">
              <label for="forma_pago">Forma de Pagamento</label>
              <select class="form-control" name="forma_pago" id="forma_pago">
                <option value="deposito">Depósito</option>
                <option value="pagseguro">PagSeguro</option>
              </select>
            </div> -->
            <input name="tipo_pagamento" id="tipo_pagamento" type="hidden" value="deposito" />
         <input name="id_user" id="id_user" type="hidden" value="<?php echo $this->session->userdata('user')->id; ?>" />
      <!--      <div class="deposito">
				<div class="panel panel-primary">
			  <div class="panel-heading"><b>Depósito / Transferência Bancária</b>  </div>
			  		  
			  	<table class="table">		  		
	
    				<tr>
    					<td><b>Favorecido</b></td>
    					<td> <?php /*echo $dados[0]->banco_favorecido; */?></td>
    				</tr>
    					<td><b>Banco</b></td>
    					<td><?php /*echo $dados[0]->banco_nome; */?></td>
    				<tr>
    					<td><b>Agência</b></td>
    					<td><?php /*echo $dados[0]->banco_agencia; */?></td>
    				</tr>
    				<tr>
    					<td><b>Conta Corrente</b></td>
    					<td><?php /*echo $dados[0]->banco_conta; */?>
    			<?php /*if(isset($dados[0]->banco_digito) && empty($dados[0]->banco_digito) == false): */?>
 					- <?php /*echo $dados[0]->banco_digito; */?>
    							<?php /*else: */?>
							- 0
    							<?php /*endif; */?></td>
    				</tr>    			
  			    </table>
		
			 
				</div>
        </div>-->
					 </div>
                                    </div>
         
            </div>
            <div class="row">
            	<div class="col-lg-12 text-center">
            		<button type="submit" class="btn btn-success btn-lg">Realizar Pagamento</button>
            	</div>
            </div>
            </div>
            </form>

            <script type="text/javascript">
$(document).ready(function(){
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