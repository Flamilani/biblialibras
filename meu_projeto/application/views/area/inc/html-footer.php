
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap-notify.min.js') ?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap-select.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/validator.min.js') ?>"></script>
<script src="<?php echo base_url('assets/shadowbox/shadowbox.js') ?>"></script>
<script src="<?php echo base_url('assets/jquery/jquery.mask.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.mCustomScrollbar.concat.min.js') ?>"></script>
<!-- Plugin JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<!-- Contact Form JavaScript -->
<script src="<?php echo base_url('assets/js/jqBootstrapValidation.js') ?>"></script>
<script src="<?php echo base_url('assets/js/contact_me.js') ?>"></script>
<script src="<?php echo base_url('assets/js/scripts.js') ?>"></script>
<!-- Theme JavaScript -->
<script src="<?php echo base_url('assets/js/freelancer.min.js') ?>"></script>
   <?php if($this->session->flashdata('concluido')) { ?>
     <script type="text/javascript">
                 $(document).ready(function(){
           $.notify(
            {
                icon: 'glyphicon glyphicon-success-sign',
                title: '<b>Parabéns!</b>',
                message: 'Marcou como concluído com sucesso!',
                url: 'https://github.com/mouse0270/bootstrap-notify',
                target: '_blank'            
            },
            {
                type: 'success'
            }
        );
    });
            </script>
<?php } ?>
</body>
</html>