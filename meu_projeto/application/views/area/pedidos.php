<div class="container ladosTela">
   <div class="front">
  <h2>Meus Pedidos (<?php echo $count_pedidos; ?>)</h2>
</div>
    <div class="row display-flex">
<?php 
	foreach ($pedidos as $pedido): ?>
		<div class="row-fluid">
			<div class="col-lg-4 col-md-6 col-sm-4">
				<h2>Pedido: <?php echo zerofill($pedido->id_pedido); ?></h2>
			</div>
		</div>
	<?php endforeach; ?>
    </div>

</div>