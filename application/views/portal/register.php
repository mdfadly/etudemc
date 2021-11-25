<style>
    .avatar {
        border-radius: 50%;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .cover-img {
        width: 150px;
        height: 150px;
        display: block;
        margin: 0 auto;
    }

    .hiden {
        display: none;
    }
</style>
<div class="container-fluid">
    <div class="row  pt-4  pl-lg-5">
        <div class="col-lg-4">
            <a href="<?= site_url() ?>portal" class="btn btn-primary">
                <i class="fa fa-angle-left"></i> Back
            </a>
        </div>
    </div>
    <div class="row pt-4 pl-lg-5">
        <div class="col-lg-12 col-12" style="font-family:mReguler;">
            <span class="head-login">
                <h5 style="font-weight:bold">Hi Teacher!</h5>
                <h4>
                    Welcome to
                    <img width="200px" src="<?= base_url() ?>assets/img/logo.png" alt="logo-etude">
                </h4>
            </span>
        </div>
    </div>

    <div class="row pt-lg-5 pt-4 mb-5 pb-5 pl-4 pr-lg-4 justify-content-center">
        <div class="col-lg-7 col-12">
            <?php if ($this->session->flashdata('warning') != null) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $this->session->flashdata('warning') ?>
                </div>
            <?php endif; ?>
            <form enctype="multipart/form-data" action="<?= site_url('portal/C_Portal/addDataRegister'); ?>" method="POST">
                <div class="form-group text-center">
                    <div class="cover-img" id="divImg">
                        <img src="<?= site_url() ?>assets/img/avatar.png" class="avatar rounded-circle img-thumbnail" alt="avatar">
                    </div>
                    <p>Upload your profile picture</p>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-3 col-form-label"></label>
                    <div class="col-6 col-lg-8">
                        <input type="file" required name="pict" class="form-control-file center-block file-upload" style="text-align: center; margin: auto; font-size:12px">
                    </div>
                </div>
                <div class="form-group row pt-3">
                    <label for="name" class="col-3 col-lg-3 pt-lg-2 col-form-label">Name</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <input type="text" class="form-control regist-form" required name="name" id="name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="dob" class="col-3 col-lg-3 pt-lg-2 col-form-label">DOB</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <input type="text" class="form-control regist-form" required name="dob" id="dob">
                        <small id="emailHelp" class="form-text text-muted">(Ex: Jakarta, 20 Maret 1990)</small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="instrument" class="col-3 col-lg-3 pt-lg-2 col-form-label">Instrument</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <input type="text" maxlength="30" class="form-control regist-form" required name="instrument" id="instrument">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="credentials" class="col-3 col-lg-3 pt-lg-2 col-form-label">Credentials</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <input type="text" class="form-control regist-form" required name="credentials" id="credentials">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-6 col-lg-3 pt-lg-2 col-form-label">Phone No.</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <input type="text" class="form-control regist-form" required name="phone" id="phone">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-3 col-lg-3 pt-lg-2 col-form-label">Email</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <input type="email" class="form-control regist-form" required name="email" id="email">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="ktp" class="col-3 col-lg-3 pt-lg-2 col-form-label">Identity Card</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <input type="file" class="form-control-file regist-form" required name="ktp" id="ktp">
                    </div>
                </div>

                <hr />
                <h5 style="font-weight:bold">ADDRESS</h5>
                <div class="form-group form-check">
                    <input type="checkbox" name="status_country" value="1" checked class="form-check-input" id="status_country">
                    <label class="form-check-label" for="status_country">From Indonesia</label>
                    <input type="hidden" id="kat" name="kat" value="1">
                </div>
                <div class="form-group row">
                    <label for="address" class="col-3 col-lg-3 pt-lg-2 col-form-label">Street</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <textarea class="form-control regist-form" rows="4" required name="address" id="address"></textarea>
                        <!-- <input type="text" class="form-control regist-form" required name="address" id="address"> -->
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label for="inputCity">Sub District</label>
                        <input type="text" name="kelurahan" required class="form-control regist-form">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="inputCity">District</label>
                        <input type="text" name="kecamatan" required class="form-control regist-form">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label for="inputCity">City</label>
                        <input type="text" name="kota" required class="form-control regist-form">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="inputCity">Province</label>
                        <input type="text" name="provinsi" required class="form-control regist-form">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label for="inputZip">Postal Code</label>
                        <input type="text" name="zip" required class="form-control regist-form">
                    </div>
                    <div id="check_country" class="form-group col-lg-6 hiden">
                        <label for="inputCity">Country</label>
                        <input id="negara" type="text" name="negara" value="Indonesia" required class="form-control regist-form">
                    </div>
                </div>
                <hr />
                <h5 style="font-weight:bold">BANK ACCOUNT</h5>
                <div class="form-group row">
                    <label for="bank" class="col-3 col-lg-3 pt-lg-2 col-form-label">Bank</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <input type="text" class="form-control regist-form" required name="bank" id="bank">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name_rek_teacher" class="col-3 col-lg-3 pt-lg-2 col-form-label">Name Bank Account</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <input type="text" class="form-control regist-form" required name="name_rek_teacher" id="name_rek_teacher">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="norek" class="col-6 col-lg-3 pt-lg-2 col-form-label">Account No.</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <input type="text" class="form-control regist-form" required name="norek" id="norek">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="iban_rek_teacher" class="col-3 col-lg-3 pt-lg-2 col-form-label">IBAN</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <input type="text" class="form-control regist-form" required name="iban_rek_teacher" id="iban_rek_teacher">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="swift_rek_teacher" class="col-3 col-lg-3 pt-lg-2 col-form-label">SWIFT</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <input type="text" class="form-control regist-form" required name="swift_rek_teacher" id="swift_rek_teacher">
                    </div>
                </div>
                <hr />
                <h5 style="font-weight:bold">ETUDE ACCOUNT</h5>
                <div class="form-group row">
                    <label for="username" class="col-3 col-lg-3 pt-lg-2 col-form-label">Username</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <input type="text" minlength="3" maxlength="15" class="form-control regist-form" required name="username" id="username">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-3 col-lg-3 pt-lg-2 col-form-label">Password</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <input type="password" minlength="8" maxlength="12" class="form-control regist-form pwd" required name="password" id="inputPassword">
                    </div>
                </div>
                <div class="mt-4 row" style="text-align:center">
                    <button type="submit" class="btn col-lg-12 pr-4 pl-4 btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/jquery-3.4.0.min.js'); ?>"></script>
<!-- Optional JavaScript -->
<script>
    $("#status_country").on('click', function() {
        var value = $(this).val();
        if (value == 0) {
            document.getElementById("status_country").value = "1";
            document.getElementById("check_country").classList.add("hiden");
            document.getElementById("negara").value = "Indonesia";
            document.getElementById("kat").value = "1";
        } else {
            document.getElementById("check_country").classList.remove("hiden");
            document.getElementById("negara").value = " ";
            document.getElementById("kat").value = "2";
            document.getElementById("status_country").value = "0";
        }

    });
    $(document).ready(function() {


        var readURL = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.avatar').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }


        $(".file-upload").on('change', function() {
            readURL(this);
        });
    });
    $("#btn-eye").mousedown(function() {
            $('.iconEye').removeClass('fa-eye-slash');
            $('.iconEye').addClass('fa-eye');
            $(".pwd").replaceWith($('.pwd').clone().attr('type', 'text'));
        })
        .mouseup(function() {
            $('.iconEye').removeClass('fa-eye');
            $('.iconEye').addClass('fa-eye-slash');
            $(".pwd").replaceWith($('.pwd').clone().attr('type', 'password'));
        })
        .mouseout(function() {
            $('.iconEye').removeClass('fa-eye');
            $('.iconEye').addClass('fa-eye-slash');
            $(".pwd").replaceWith($('.pwd').clone().attr('type', 'password'));
        });

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