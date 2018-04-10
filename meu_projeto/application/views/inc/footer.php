
<!-- Footer -->
<footer class="text-center">
    <div class="footer-above">
        <div class="container">
            <div class="row">
              <!--   <div class="footer-col col-md-4">
                    <h3>Location</h3>
                    <p>3481 Melrose Place
                        <br>Beverly Hills, CA 90210</p>
                </div> -->
                <div class="footer-col">
                    <ul class="list-inline">
                        <li style="margin-left: 10px; float: left;"> <a href="<?php echo base_url('home/privacidade'); ?>">Política de Privacidade</a> </li>
                       <li style="float: left;"> | </li>
                        <li style="float: left;"> <a href="<?php echo base_url('home/termos'); ?>"> Termos de Uso </a></li>
                                  <?php if (!empty($sociais)): ?>                    
                            <?php foreach ($sociais as $social): ?>
                                 <li style="float: right;">
                            <a href="<?php echo $social->link; ?>" target="_blank" class="social"><img src="<?php echo base_url('assets/uploads/' . $social->icone); ?>"></a>
                        </li>                   
                            <?php endforeach; ?>
                                      <?php endif; ?>     
                           </ul>
                </div>
               <!--  <div class="footer-col col-md-4">
                    <h3>About Freelancer</h3>
                    <p>Freelance is a free to use, open source Bootstrap theme created by <a href="http://startbootstrap.com">Start Bootstrap</a>.</p>
                </div> -->
            </div>
        </div>
    </div>
    <div class="footer-below">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    Todos os direitos autoriais &copy; A Bíblia em Libras - <?php echo date('Y'); ?> - Desenvolvido por Flavio Milani
                </div>
            </div>
        </div>
    </div>
</footer>

<script type="text/javascript">
    var app = angular.module('meuApp', []);
    app.controller('meuCtrl', function($scope){

    $scope.filtro = "";   
});
</script>