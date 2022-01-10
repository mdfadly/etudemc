<style>
    /*label {*/
    /*    font-weight: bold;*/
    /*}*/

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

    .hide {
        display: none;
    }
</style>
<main class="page-content">
    <div class="container-fluid">
        <div class="row pt-lg-3 pt-4">
            <div class="col-lg-12">
                <?php if ($this->session->flashdata('warning') != null) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $this->session->flashdata('warning') ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <a href="<?= site_url() ?>portal/profile/<?= $this->session->userdata('username') ?>" class="btn btn-primary">
                    <i class="fa fa-angle-left"></i> Back
                </a>
            </div>
        </div>
        <hr>
        <h2 style="font-weight:bold">Edit Profile</h2>


        <div class="row pr-lg-3 pl-lg-3 justify-content-center">
            <div class="col-lg-10">
                <form enctype="multipart/form-data" action="<?= site_url('portal/C_Teacher/data_edit_profile'); ?>" method="POST">
                    <div class="form-group text-center">
                        <div class="cover-img" id="divImg">
                            <img src="<?= base_url(); ?>assets/img/pict_guru/<?= $teacher[0]['pict_teacher'] ?>" class="avatar rounded-circle img-thumbnail img-preview" alt="avatar">
                        </div>
                        <br><br>
                        <div id="btn-change">
                            <button type="button" onclick="openPict()" class="btn btn-sm btn-success btn-change-pict">
                                Change Profile Picture
                            </button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-3 col-form-label"></label>
                        <div class="col-12 col-lg-8">
                            <input type="hidden" id="foto" onchange="previewImg()" value="<?= $teacher[0]['pict_teacher'] ?>" required name="pict" class="form-control-file center-block file-upload picture" style="text-align: center; margin: auto;">
                            <input type="hidden" value="tidak" name="ubah-pict" class="ubah-pict" id="ubah-pict">
                            <label class="hide custom-file-label text-center" for="foto">Choose file (select a JPG or PNG file)</label>
                        </div>
                    </div>
                    <div class="form-group row pt-3">
                        <label for="name" class="col-4 col-lg-3 pt-lg-2 col-form-label">Name</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" required value="<?= $teacher[0]['name_teacher'] ?>" name="name" id="name">
                            <input type="hidden" class="form-control regist-form" required value="<?= $teacher[0]['id_teacher'] ?>" name="id" id="id">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dob" class="col-4 col-lg-3 pt-lg-2 col-form-label">Place - DOB</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" required value="<?= $teacher[0]['dob_teacher'] ?>" name="dob" id="dob">
                            <small id="emailHelp" class="form-text text-muted">(Ex: Jakarta - 20 Maret 1990)</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-7 col-lg-3 pt-lg-2 col-form-label">Phone Number/WA</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" required value="<?= $teacher[0]['phone_teacher'] ?>" name="phone" id="phone">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-4 col-lg-3 pt-lg-2 col-form-label">Email</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" required value="<?= $teacher[0]['email_teacher'] ?>" name="email" id="email">
                        </div>
                    </div>
                    <hr />
                    <h5 style="font-weight:bold">ADDRESS</h5>
                    <div class="form-group form-check">
                        <input type="checkbox" name="status_country" value="1" class="form-check-input" id="status_country">
                        <label class="form-check-label" for="status_country">From Indonesia</label>
                        <input type="hidden" id="kat" name="kat" value="<?= $teacher[0]['kat'] ?>">
                    </div>
                    <?php $temp_address = explode("~", $teacher[0]['address_teacher']) ?>
                    <div class="form-group row">
                        <label for="address" class="col-4 col-lg-3 pt-lg-2 col-form-label">Street</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <textarea class="form-control regist-form" rows="4" required name="address" id="address"><?= $temp_address[0] ?></textarea>
                            <!-- <input type="text" class="form-control regist-form" required value="" name="address" id="address"> -->
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="inputCity">Sub District</label>
                            <input type="text" name="kelurahan" required value="<?= $temp_address[1] ?>" class="form-control regist-form">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="inputCity">District</label>
                            <input type="text" name="kecamatan" required value="<?= $temp_address[2] ?>" class="form-control regist-form">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="inputCity">City</label>
                            <input type="text" name="kota" required value="<?= $temp_address[3] ?>" class="form-control regist-form">
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="inputZip">Postal Code</label>
                            <input type="text" name="zip" required value="<?= $temp_address[5] ?>" class="form-control regist-form">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="inputCity">Province</label>
                            <input type="text" name="provinsi" required value="<?= $temp_address[4] ?>" class="form-control regist-form">
                        </div>
                        <div id="check_country" class="form-group col-lg-6">
                            <label for="inputCity">Country</label>
                            <input id="negara" type="text" name="negara" value="<?= $temp_address[6] ?>" required class="form-control regist-form">
                        </div>
                        <!-- <div class="form-group col-lg-6">
                            <label for="inputCity">Country</label>
                            <input type="text" name="negara" required value="<?= $temp_address[6] ?>" class="form-control regist-form">
                            <small>if you change to Indonesia, input: Indonesia</small>
                        </div> -->
                    </div>
                    <hr />
                    <h5 style="font-weight:bold">BANK ACCOUNT</h5>
                    <div class="form-group row">
                        <label for="bank" class="col-4 col-lg-3 pt-lg-2 col-form-label">Bank</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" required value="<?= $teacher[0]['bank_teacher'] ?>" name="bank" id="bank">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name_rek_teacher" class="col-3 col-lg-3 pt-lg-2 col-form-label">Name Bank Account</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" required value="<?= $teacher[0]['name_rek_teacher'] ?>" name="name_rek_teacher" id="name_rek_teacher">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="norek" class="col-7 col-lg-3 pt-lg-2 col-form-label">Account No.</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" required value="<?= $teacher[0]['norek_teacher'] ?>" name="norek" id="norek">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="iban_rek_teacher" class="col-3 col-lg-3 pt-lg-2 col-form-label">IBAN</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" required value="<?= $teacher[0]['iban_rek_teacher'] ?>" name="iban_rek_teacher" id="iban_rek_teacher">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="swift_rek_teacher" class="col-3 col-lg-3 pt-lg-2 col-form-label">SWIFT</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" required value="<?= $teacher[0]['swift_rek_teacher'] ?>" name="swift_rek_teacher" id="swift_rek_teacher">
                        </div>
                    </div>
                    <hr />
                    <h5 style="font-weight:bold">ETUDE ACCOUNT</h5>
                    <div class="form-group row">
                        <label for="instrument" class="col-4 col-lg-3 pt-lg-2 col-form-label">Instrument</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <input type="text" maxlength="30" class="form-control regist-form" required value="<?= $teacher[0]['instrument'] ?>" name="instrument" id="instrument">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="credentials" class="col-4 col-lg-3 pt-lg-2 col-form-label">Credentials</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" required value="<?= $teacher[0]['credentials_teacher'] ?>" name="credentials" id="credentials">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="username" class="col-4 col-lg-3 pt-lg-2 col-form-label">Username</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <input type="text" minlength="3" maxlength="15" class="form-control regist-form" required value="<?= $teacher[0]['username'] ?>" name="username" id="username">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-4 col-lg-3 pt-lg-2 col-form-label">Password</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-10 col-lg-5">
                            <input type="password" minlength="8" maxlength="12" class="form-control regist-form pwd" required value="<?= $teacher[0]['password'] ?>" name="password" id="inputPassword">
                        </div>
                        <div class="col-1 col-lg-2">
                            <span class="input-group-btn">
                                <button id="btn-eye" onclick="openPass()" class="btn btn-default reveal" type="button">
                                    <i class="iconEye fa fa-eye-slash"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label for="ktp" class="col-3 col-lg-3 pt-lg-2 col-form-label">KTP</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-7 col-lg-8">
                            <input type="file" class="form-control-file regist-form" required name="ktp" id="ktp">
                        </div>
                    </div> -->
                    <div class="mt-4" style="text-align:center">
                        <button type="submit" class="btn pr-4 pl-4 btn-primary">Submit</button>
                    </div>
                </form>
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

    function openPict() {
        $('.btn-change-pict').remove();
        $('.custom-file-label').removeClass('hide');
        $('#btn-change').append(`
            <a href="#" onclick="closePict()" class="btn btn-sm btn-danger btn-change-pict">
                Cancel change profile picture
            </a>
        `);
        document.getElementById('ubah-pict').value = "ya";
        $(".picture").replaceWith($('.picture').clone().attr('type', 'file'));
    }

    function closePict() {
        $('.btn-change-pict').remove();
        $('.custom-file-label').addClass('hide');
        $('#btn-change').append(`
            <a href="#" onclick="openPict()" class="btn btn-sm btn-success btn-change-pict">
                Change Profile Picture
            </a>
        `);
        document.getElementById('ubah-pict').value = "tidak";
        $(".picture").replaceWith($('.picture').clone().attr('type', 'hidden'));
        var imgPreview = document.querySelector(".img-preview");
        imgPreview.src = "<?= base_url(); ?>assets/img/pict_guru/<?= $teacher[0]['pict_teacher'] ?>";
        var sampulLabel = document.querySelector(".custom-file-label");
        sampulLabel.textContent = "Choose file";
    }

    function previewImg() {
        var sampul = document.querySelector("#foto"); //input type file
        var sampulLabel = document.querySelector(".custom-file-label");
        var imgPreview = document.querySelector(".img-preview");

        sampulLabel.textContent = sampul.files[0].name;

        var fileSampul = new FileReader();
        fileSampul.readAsDataURL(sampul.files[0]);

        fileSampul.onload = function(e) {
            imgPreview.src = e.target.result;
        };
    }

    $("#status_country").on('click', function() {
        var value = $(this).val();
        if (value == 0) {
            document.getElementById("status_country").value = "1";
            document.getElementById("check_country").classList.add("hide");
            document.getElementById("negara").value = "Indonesia";
            document.getElementById("kat").value = "1";
        } else {
            document.getElementById("check_country").classList.remove("hide");
            document.getElementById("negara").value = " ";
            document.getElementById("kat").value = "2";
            document.getElementById("status_country").value = "0";
        }

    });
    $(document).ready(function() {
        if (<?= $teacher[0]['kat'] ?> === 1) {
            document.getElementById("status_country").checked = true;
            document.getElementById("status_country").value = "1";
            document.getElementById("check_country").classList.add("hide");
            document.getElementById("negara").value = "Indonesia";
        } else {
            document.getElementById("status_country").checked = false;
            document.getElementById("status_country").value = "0";
            document.getElementById("check_country").classList.remove("hide");
            document.getElementById("negara").value = "<?= $temp_address[6] ?>";
        }
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