     <div class="container headTop">
      <div class="row">
                <div class="col-lg-12 front">
                    <h3 class="text-center">Meu Carrinho</h3><br><br>
                     <?php if(null != $this->session->userdata('logado')): ?>
                    <?php if($this->cart->total_items() < 3): ?>
                     <h4><div class="alert alert-info text-center" role="alert">Você precisa comprar pelo menos 3 livros. <a href="<?php echo base_url('home/livros'); ?>">Compre mais livros aqui.</a>
                                </div></h4>
                    <?php else: ?>
                         <h4><div class="alert alert-success text-center" role="alert">Você já tem 3 livros e pode finalizar sua compra ou <a href="<?php echo base_url('home/livros'); ?>">continua comprando mais livros</a>
                                </div></h4>
                    <?php endif; ?>
                  <?php endif; ?>
                    <div class="panel panel-primary">
                        <div class="panel-heading">        
                           
                             <?php if (!empty($this->cart->contents())): ?>       
                                <?php echo $this->cart->total_items(); ?>
                            <?php plural($this->cart->total_items(), 'Livro Escolhido', 'Livros Escolhidos'); ?>
                                <?php else: ?>
                                Nenhum Livro Escolhido
                                        <?php endif; ?>
                           
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive text-center">
                                <table class="table table-striped table-bordered table-hover text-center">
                                  <!--   <thead>
                                        <tr>
                                            <th>Livro</th>
                                            <th>Descrição</th>
                                            <th>Valor</th>
                                            <th>Ações</th> 
                                        </tr>
                                    </thead> -->
                                    <tbody>  
                                         <?php if (!empty($this->cart->contents())): ?>           
                                            <?php echo form_open(base_url("home/atualizar")); 
                                            $c = 1;
                                            foreach($this->cart->contents() as $item): ?>
                                              <?php echo form_hidden($c . '[rowid]', $item['rowid']); ?>
                                    <tr class="spanCart">
                                    <td><?php echo img(array("src" => $item['foto'], "class" => "img-responsive", "style" => "height: auto; max-height:100px; width: auto;")); ?>
                                    </td>
                                    <td><?php echo anchor($item['url'], $item['name']); ?>
                                    </td>
                                    <td><?php echo form_input(array('name' => $c.'[qty]', 'value' => $item['qty'], 'maxlength' => '3', 'size' => '5')); ?></td>     
                                    <td><?php echo reais($item['price']); ?></td>     
                                    <td><a class="btn btn-danger" href="<?php echo base_url('home/remover_carrinho/' . $item['rowid']); ?>"><span class="glyphicon glyphicon-trash"></span></a></td>  
                                    </tr>   
                                            <?php $c++; ?>
                                             <?php endforeach; ?>
                                             <tfoot>
                                                 <tr>
                                                    <td></td>                                                    
                                                    <td>
                                                <?php if($this->cart->total_items() < 3): ?>
                                            <a class="btn btn-success btn-block" data-html="true" data-toggle="tooltip" data-placement="top" title="<h5>Tem que comprar <br /> acima de 3 livros.</h5>" disabled="disabled">Finalizar Compra</a>
                                        <?php else: ?>
                                             <a class="btn btn-success btn-block" href="<?php echo base_url('home/finalizar'); ?>">Finalizar Compra</a>
                                        <?php endif; ?>
                                        </td>
                                                    <td><h4>Total:</h4></td>
                                                  <td><h4><?php echo reais($this->cart->total()); ?></h4></td>
                                                <td></td>
                                                 </tr>
                                             </tfoot>
                                        <div class="text-left"><a href="<?php echo base_url('home/limpar_carrinho'); ?>">Limpar tudo</a></div>
                                            <?php form_close(); ?>                                    
                                        <?php else: ?><br>
                                <div class="alert alert-info" role="alert">Seu carrinho está vazio! <br><br>
                                    <a href="<?php echo base_url('home/livros'); ?>">Compre livros aqui</a>
                                </div>
                                        <?php endif; ?>
                                   </tbody>
                                </table>
                                
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
         
            </div>
            </div>