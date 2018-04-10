    <?php if(isset($manutencao[0]->status) && $manutencao[0]->status == 1): ?>
    	<?php redirect(base_url('home')); ?>
          <div class="alert alert-info text-center" role="alert">
            <h2><?php echo $manutencao[0]->titulo; ?></h2>
  <h3><?php echo $manutencao[0]->conteudo; ?></h3>
</div> 
<?php else: ?>
	<?php redirect(base_url('home')); ?>
<?php endif; ?>