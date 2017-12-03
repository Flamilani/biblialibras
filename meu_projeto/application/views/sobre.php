<!-- About Section -->
<section class="success" id="about">
    <div class="container">
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
        <?php else: ?>           
             <div class="boxVideo">
                <?php echo $sobre[0]->video; ?>
            </div>
        <?php endif; ?>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-6">
                <p class="sobre">
               <?php echo $sobre[0]->conteudo; ?>
                </p>
            </div>
        </div>
    </div>
</section>