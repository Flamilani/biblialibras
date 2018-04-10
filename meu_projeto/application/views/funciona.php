<!-- About Section -->
<?php if(isset($funciona[0]->status) && $funciona[0]->status == 1): ?>
<section class="funciona" id="funciona">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center front">
                <h2><?php echo $funciona[0]->titulo; ?></h2>                
                <br />
                <!-- <hr class="star-light">-->
            </div>
        </div>
        <div class="row">            
            <div class="col-xs-12 col-md-6 col-lg-6">
                <?php if(isset($funciona[0]->midia) && $funciona[0]->midia == 'imagem'): ?>
               <img class="" src="<?php echo $funciona[0]->imagem; ?>" alt="">
      <?php elseif(isset($funciona[0]->midia) && $funciona[0]->midia == 'video'): ?>            
             <div class="boxVideo">
                <?php echo $funciona[0]->video; ?>
            </div>
        <?php else: ?>
        <?php endif; ?>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="sobre">
               <?php echo $funciona[0]->conteudo; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php else: ?>
<?php endif; ?>

<?php if($this->uri->segment(2) == 'funciona') { ?>
<script>
     $(document).ready(function() {       
        $('.funciona').addClass("cima");
     });
</script>     

<?php } ?>