<style>
    .heading-dashboard {
        font-family: dashboardFont;
    }
</style>
<main class="page-content">
    <div class="container-fluid">
        <div class="row  text-center justify-content-center">

            <div class="col-lg-12">
                <h3>under construction</h3>
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