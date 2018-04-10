
<?php if(isset($termos[0]->status) && $termos[0]->status == 1): ?>
    <!-- About Section -->
    <section id="termos">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center front">
                    <h2><?php echo $termos[0]->titulo; ?></h2>
                    <br />
                    <!-- <hr class="star-light">-->
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-12 col-lg-12">
                    <?php echo $termos[0]->conteudo; ?>
                </div>
            </div>
        </div>
    </section>
<?php else: ?>

<?php endif; ?>
<?php if($this->uri->segment(2) == 'termos') { ?>
    <script>
        $(document).ready(function() {
            $('#termos').addClass("cima");
        });
    </script>

<?php } ?>
