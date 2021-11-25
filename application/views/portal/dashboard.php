<style>
    .heading-dashboard {
        font-family: dashboardFont;
    }
</style>
<main class="page-content">
    <div class="container-fluid">
        <div class="row  text-center justify-content-center">

            <div class="col-lg-12">
                <h3>Hi <?= $this->session->userdata('name'); ?>!</h3>
            </div>
            <div class="col-lg-12 pt-5 pt-lg-4 mt-lg-1 mt-5">
                <h1 id="head-dashboard" class="heading-dashboard" style="font-size:70px;">
                    Welcome To
                </h1>
                <div class="">
                    <img src="<?= base_url(); ?>assets/img/logo.png" class="img-dashboard-logo" alt="avatar">
                </div>
            </div>
            <div class="col-lg-12 pt-lg-4 mt-lg-1 mt-5 icon">
                <img src="<?= base_url() ?>assets/img/Flag_of_Indonesia.svg" id="flag" class="shadow mb-3 icon-flag" style="width:100px" alt="" srcset="">
                <br><br>
                <img src="<?= base_url(); ?>assets/img/icon-dashboard2.png" class="icon-img" alt="avatar">
            </div>
        </div>
    </div>
</main>
<script src="<?= base_url('assets/js/jquery-3.4.0.min.js'); ?>"></script>
<!-- Optional JavaScript -->
<script>
    $(document).ready(function() {
        var x = window.matchMedia("(max-width: 990px)");
        myFunction(x); // Call listener function at run time
        x.addListener(myFunction); // Attach listener function on state changes

        function myFunction(x) {
            if (x.matches) { // If media query matches
                $('.img-dashboard-logo').addClass('w-75');
                $('.icon').addClass('cover-dashboard-icon');
                $('.icon-img').addClass('w-100');
                $('.icon-flag').addClass('w-25');
                document.getElementById('flag').removeAttribute('style');
                document.getElementById('head-dashboard').removeAttribute('style');
            } else {
                $('.img-dashboard-logo').removeClass('w-75');
                $('.icon').removeClass('cover-dashboard-icon');
                $('.icon-img').removeClass('w-100');
                document.getElementById('flag').style.width = '100px';
                $('.icon-flag').removeClass('w-25');
                document.getElementById('head-dashboard').style.fontSize = '70px';
            }
        };
    });
</script>