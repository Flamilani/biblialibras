<!-- About Section -->
<?php if(isset($sobre[0]->status) && $sobre[0]->status == 1): ?>
<section class="success" id="about">
    <div class="container headPage">
        <div class="row">
            <div class="col-lg-12 text-center front">
                <h2><?php echo $sobre[0]->titulo; ?></h2>                
                <br />
                <!-- <hr class="star-light">-->
            </div>
        </div>
        <div class="row">            
            <div class="col-xs-12 col-md-6 col-lg-6">
                <?php if(isset($sobre[0]->midia) && $sobre[0]->midia == 'imagem'): ?>
               <img class="" src="<?php echo $sobre[0]->imagem; ?>" alt="">
      <?php elseif(isset($sobre[0]->midia) && $sobre[0]->midia == 'video'): ?>     
             <div class="boxVideo">
                <?php echo $sobre[0]->video; ?>
            </div>
        <?php else: ?>
        <?php endif; ?>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="sobre">
               <?php echo $sobre[0]->conteudo; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php else: ?>

    <?php endif; ?>