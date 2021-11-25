<style>
    label {
        font-weight: normal !important;
    }

    h5 {
        font-weight: bold;
    }

    .login-form {
        font-weight: bold;
        border: 0;
        height: 40px;
        border-radius: 0;
        background-color: white;
    }

    .login-form:focus {
        box-shadow: none;
        outline: 0;
        background-color: white;
    }
</style>
<main class="page-content">
    <div class="container-fluid">
        <?php if (substr($this->session->userdata('id'), 0, 1) == 3) { ?>
            <!-- <div style="text-align:left;">
                <span style="font-family:mReguler; font-size:20px;" class="font-weight-bold">Profile</span>
                <span style="float:right;">
                    <a href="<?= site_url() ?>portal/C_Admin/delete_data_teacher/<?= $teacher[0]['id_teacher'] ?>" class="btn btn-danger" title="Hapus Data Ini" onclick='return confirm("are you sure want to delete this data?")'>
                        <i class="fa fa-trash icon-white"></i>
                    </a>
                </span>
            </div> -->
            <div style="text-align:left;">
                <span style="font-family:mReguler; font-size:20px;" class="font-weight-bold">
                    <a href="<?= site_url() ?>portal/data_teacher" class="btn btn-primary">
                        <i class="fa fa-angle-left"></i> Back
                    </a>
                </span>
                <span style="float:right;">
                    <a href="<?= site_url() ?>portal/C_Admin/delete_data_teacher/<?= $teacher[0]['id_teacher'] ?>" class="btn btn-danger" title="Hapus Data Ini" onclick='return confirm("are you sure want to delete this data?")'>
                        <i class="fa fa-trash icon-white"></i>
                    </a>
                </span>
            </div>

            <hr>
            <div class="row pr-3">
                <div class="col-lg-2 col-2">
                    <h5 style="font-family:mReguler" class="font-weight-bold">Profile</h5>
                </div>
                <div class="col-lg-8 col-8" id="divImg">
                    <div class="cover-img">
                        <img src="<?= base_url(); ?>assets/img/pict_guru/<?= $teacher[0]['pict_teacher'] ?>" class="avatar" alt="avatar">
                    </div>
                </div>
                <div class="col-lg-2 col-2">

                </div>

            </div>
            <div class="row pr-3">


            </div>
        <?php } else { ?>
            <div class="row pr-3">
                <div class="col-lg-2 col-2">
                    <h5 style="font-family:mReguler" class="font-weight-bold">Profile</h5>
                </div>
                <div class="col-lg-8 col-8" id="divImg">
                    <div class="cover-img">
                        <img src="<?= base_url(); ?>assets/img/pict_guru/<?= $teacher[0]['pict_teacher'] ?>" class="avatar" alt="avatar">
                    </div>
                </div>
                <div class="col-lg-2 col-2">
                    <a href="<?= site_url() ?>portal/profile/edit/<?= $this->session->userdata('username') ?>" class="btn btn-primary">
                        Edit
                    </a>
                </div>

            </div>
        <?php } ?>
        <div class="row pt-lg-3 pt-4">
            <div class="col-lg-12">
                <?php if ($this->session->flashdata('success') != null) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= $this->session->flashdata('success') ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row pr-lg-3 pl-lg-3 justify-content-center">
            <div class="col-lg-12">
                <div class="form-group text-center">
                </div>
                <div class="form-group row pt-3">
                    <label for="name" class="col-4 col-lg-3 pt-lg-2 col-form-label">Name</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $teacher[0]['name_teacher'] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="dob" class="col-4 col-lg-3 pt-lg-2 col-form-label">Place - DOB</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $teacher[0]['dob_teacher'] ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="phone" class="col-7 col-lg-3 pt-lg-2 col-form-label">Phone Number/WA</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $teacher[0]['phone_teacher'] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-4 col-lg-3 pt-lg-2 col-form-label">Email</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $teacher[0]['email_teacher'] ?>
                    </div>
                </div>
                <hr />
                <h5>ADDRESS</h5>
                <div class="form-group row">
                    <label for="address" class="col-4 col-lg-3 pt-lg-2 col-form-label">Street</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?php $temp_address = explode("~", $teacher[0]['address_teacher']) ?>
                        <?= $temp_address[0] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kelurahan" class="col-4 col-lg-3 pt-lg-2 col-form-label">Sub District</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $temp_address[1] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kecamatan" class="col-4 col-lg-3 pt-lg-2 col-form-label">District</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $temp_address[2] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Kota" class="col-4 col-lg-3 pt-lg-2 col-form-label">City</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $temp_address[3] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Postal Code" class="col-4 col-lg-3 pt-lg-2 col-form-label">Postal Code</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $temp_address[5] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Provinsi" class="col-4 col-lg-3 pt-lg-2 col-form-label">Province</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $temp_address[4] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Negara" class="col-4 col-lg-3 pt-lg-2 col-form-label">Country</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $temp_address[6] ?>
                    </div>
                </div>
                <hr />
                <h5>BANK ACCOUNT</h5>
                <div class="form-group row">
                    <label for="bank" class="col-4 col-lg-3 pt-lg-2 col-form-label">Bank</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $teacher[0]['bank_teacher'] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="bank" class="col-4 col-lg-3 pt-lg-2 col-form-label">Name</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $teacher[0]['name_rek_teacher'] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="norek" class="col-7 col-lg-3 pt-lg-2 col-form-label">Account No.</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $teacher[0]['norek_teacher'] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="norek" class="col-7 col-lg-3 pt-lg-2 col-form-label">IBAN</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $teacher[0]['iban_rek_teacher'] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="norek" class="col-7 col-lg-3 pt-lg-2 col-form-label">SWIFT</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $teacher[0]['swift_rek_teacher'] ?>
                    </div>
                </div>


                <!-- <div class="form-group row">
                    <label for="instrument" class="col-4 col-lg-3 pt-lg-2 col-form-label">Instrument</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $teacher[0]['instrument'] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="credentials" class="col-4 col-lg-3 pt-lg-2 col-form-label">Credentials</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $teacher[0]['credentials_teacher'] ?>
                    </div>
                </div> -->
                <hr />
                <h5>ETUDE ACCOUNT</h5>
                <div class="form-group row">
                    <label for="username" class="col-4 col-lg-3 pt-lg-2 col-form-label">Username</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $teacher[0]['username'] ?>
                    </div>
                </div>
                <?php if (substr($this->session->userdata('id'), 0, 1) == 1) { ?>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-4 col-lg-3 pt-lg-2 col-form-label">Password</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-9 col-lg-4">
                            <input type="password" class="form-control login-form pwd bg-white" readonly required name="password" id="inputPassword" value="<?= $teacher[0]['password'] ?>">
                        </div>
                        <div class="col-1 col-lg-1">
                            <span class="input-group-btn">
                                <button id="btn-eye" onclick="openPass()" class="btn btn-default reveal" type="button">
                                    <i class="iconEye fa fa-eye-slash"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</main>
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
                // document.getElementById("divImg").removeAttribute("style");
                // document.getElementById("divImg").style.paddingLeft = "50px";
            } else {
                $('.head-login').removeClass('text-center');
                // document.getElementById("divImg").removeAttribute("style");
                // document.getElementById("divImg").style.paddingLeft = "200px";
            }
        };
    });
</script>