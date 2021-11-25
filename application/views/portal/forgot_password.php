<div class="container-fluid">
    <div class="row pt-4 pl-lg-5">
        <div class="col-lg-12 col-12" style="font-family:mReguler;">
            <h4 class="head-login">
                Welcome to
                <img width="200px" src="<?= base_url() ?>assets/img/logo.png" alt="logo-etude">
            </h4>
        </div>
    </div>
    <div class="row pt-lg-5 pt-4">
        <div class="col-lg-12">
            <h5 class="text-center" style="font-family:mReguler;">
                Change Password
            </h5>
        </div>
    </div>
    <div class="row pt-lg-5 pt-4 pr-4 pl-4 justify-content-center">
        <div class="col-lg-5 col-12">
            <?php if ($this->session->flashdata('warning') != null) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $this->session->flashdata('warning') ?>
                </div>
            <?php endif; ?>
            <form action="<?= site_url('portal/C_Portal/update_password'); ?>" method="POST">
                <div class="form-group row">
                    <label for="email" class="col-lg-2 col-12 pt-lg-3 col-form-label">email</label>
                    <div class="col-lg-9 col-10">
                        <input type="email" class="form-control login-form" required name="email" id="email">
                    </div>
                </div>
                <div class="form-group row ">
                    <label for="inputPassword" class="col-lg-2 col-12 col-form-label">New Password</label>
                    <div class="col-lg-9 col-10">
                        <input type="password" class="form-control login-form pwd" required name="password" id="inputPassword">
                    </div>
                    <div class="col-lg-1 col-1">
                        <span class="input-group-btn text-left">
                            <button id="btn-eye" onclick="openPass()" class="btn btn-default reveal" type="button">
                                <i class="iconEye fa fa-eye-slash"></i>
                            </button>
                        </span>
                    </div>
                </div>
                <div class="mt-4 pt-4" style="text-align:center">
                    <button type="submit" class="btn pr-4 pl-4 text-white" style="background-color:#1B75BB">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/jquery-3.4.0.min.js'); ?>"></script>
<!-- Optional JavaScript -->
<script>
    function openPass() {
        $('.iconEye').removeClass('fa-eye-slash');
        $('.iconEye').addClass('fa-eye');
        $(".pwd").replaceWith($('.pwd').clone().attr('type', 'text'));
        $('#btn-eye').removeAttr("onclick");
        $('#btn-eye').attr("onclick", 'closePass()');
    }

    function closePass() {
        $('.iconEye').removeClass('fa-eye');
        $('.iconEye').addClass('fa-eye-slash');
        $(".pwd").replaceWith($('.pwd').clone().attr('type', 'password'));
        $('#btn-eye').removeAttr("onclick");
        $('#btn-eye').attr("onclick", 'openPass()');
    }

    $(document).ready(function() {
        var x = window.matchMedia("(max-width: 990px)");
        myFunction(x); // Call listener function at run time
        x.addListener(myFunction); // Attach listener function on state changes

        function myFunction(x) {
            if (x.matches) { // If media query matches
                $('.head-login').addClass('text-center');
            } else {
                $('.head-login').removeClass('text-center');
            }
        };
    });
</script>