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

    .hiden {
        display: none;
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


        <div class="row justify-content-center">
            <div class="col-lg-12 col-12">
                <form enctype="multipart/form-data" action="<?= site_url('portal/C_Teacher/data_edit_profile'); ?>" method="POST">
                    <input type="hidden" name="pict_lama" value="<?= $teacher[0]['pict_teacher'] ?>">
                    <div class="form-group text-center">
                        <div class="cover-img" id="divImg_student">
                            <img src="<?= base_url() ?>assets/img/pict_guru/<?= $teacher[0]['pict_teacher'] ?>" class="avatar avatartemp rounded-circle img-thumbnail" alt="avatar">
                        </div>
                        <br><br>
                        <div id="btn-change">
                            <button type="button" onclick="openPict()" class="btn btn-sm btn-success btn-change-pict">
                                Change Profile Picture
                            </button>
                        </div>
                    </div>
                    <div id="checkForm" class="form-group ml-5 hiden" style="width: 100%;height: 100%;margin: auto;text-align: center;">
                        <input type="hidden" value="tidak" name="ubah-pict" class="ubah-pict" id="ubah-pict">
                        <input type="file" id="foto" name="pict" class="file-upload" style="text-align: center; margin: auto; font-size:12px" accept=".png,.jpg,.jpeg">
                    </div>
                    <div class="row text-center mt-2 mb-3 hiden" id="checkText">
                        <div class="col-lg-12">
                            <span id="check-file-photo-parent">png,jpg,jpeg (max size file 2MB)</span>
                        </div>
                    </div>
                    <h5 style="font-weight:bold">ETUDE ACCOUNT</h5>
                    <div class="form-group row">
                        <label for="username" class="col-12 col-lg-3 pt-lg-2 col-form-label">Username <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-9">
                            <input type="hidden" class="form-control regist-form" required name="username_before" id="username_before" value="<?= $teacher[0]['username'] ?>">

                            <input type="text" autocomplete="off" minlength="4" maxlength="15" class="form-control regist-form" required name="username" id="username" value="<?= $teacher[0]['username'] ?>">
                            <small id="check-username" class="form-text">min 4 and max 15 characters</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-12 col-lg-3 pt-lg-2 col-form-label">Password <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-10 col-lg-7">
                            <input type="password" autocomplete="off" minlength="8" maxlength="20" class="form-control regist-form pwd" required value="<?= $teacher[0]['password'] ?>" name="password" id="inputPassword">
                            <small class="form-text">min 8 and max 20 characters</small>
                        </div>
                        <div class="col-lg-2 col-2">
                            <button id="btn-eye" onclick="openPass()" class="btn btn-default reveal" type="button">
                                <i class="iconEye fa fa-eye-slash"></i>
                            </button>
                        </div>
                    </div>
                    <hr />
                    <h5 style="font-weight:bold">Profile</h5>

                    <div class="form-group row pt-3">
                        <label for="name" class="col-12 col-lg-3 pt-lg-2 col-form-label">Name <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" required value="<?= $teacher[0]['name_teacher'] ?>" name="name" id="name">
                            <input type="hidden" class="form-control regist-form" required value="<?= $teacher[0]['id_teacher'] ?>" name="id" id="id">
                        </div>
                    </div>
                    <?php $temp_dob = explode(",", $teacher[0]['dob_teacher']) ?>
                    <div class="form-group row">
                        <label for="tempat_dob_teacher" class="col-12 col-lg-3 pt-lg-2 col-form-label">Place of Birth <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" required value="<?= $temp_dob[0] ?>" name="tempat_dob_teacher" id="tempat_dob_teacher">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_dob_teacher" class="col-12 col-lg-3 pt-lg-2 col-form-label">Date of Birth <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form datepicker" required value="<?= $temp_dob[1] ?>" name="tanggal_dob_teacher" id="tanggal_dob_teacher">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="instrument" class="col-12 col-lg-3 pt-lg-2 col-form-label">Instrument <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-8">
                            <select class="form-control" style="width:100%;" name="instrument" id="instrument" onchange="instrumentFunc(event)">
                                <option>--- Choose Instrument ---</option>
                                <option value="Piano">Piano</option>
                                <option value="Violin">Violin</option>
                                <option value="Cello">Cello</option>
                                <option value="Bass">Bass</option>
                                <option value="Vocal">Vocal</option>
                                <option value="Guitar">Guitar</option>
                                <option value="Others">Others</option>
                            </select>
                            <div id="inputOthers">

                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="credentials" class="col-12 col-lg-3 pt-lg-2 col-form-label">Credentials <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" required value="<?= $teacher[0]['credentials_teacher'] ?>" name="credentials" id="credentials">
                            <small class="form-text">(Tittle : S.Sn, Magister, Dr., Prof)</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-7 col-lg-3 pt-lg-2 col-form-label">Phone No. <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" required value="<?= $teacher[0]['phone_teacher'] ?>" name="phone" id="phone">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-12 col-lg-3 pt-lg-2 col-form-label">Email <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-8">
                            <input type="hidden" class="form-control regist-form" autocomplete="off" required value="<?= $teacher[0]['email_teacher'] ?>" name="email_teacher_before" id="email_teacher_before">
                            <input type="text" class="form-control regist-form" required value="<?= $teacher[0]['email_teacher'] ?>" name="email" id="email_teacher">
                            <small id="check-email" class="form-text"></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="linkedin" class="col-7 col-lg-3 pt-lg-2 col-form-label">Linkedin (Url) <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" required value="<?= $teacher[0]['linkedin'] ?>" name="linkedin" id="linkedin">
                            <small class="form-text">(www.linkedin.com/in/your-linkedin-account)</small>
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
                        <label for="address" class="col-12 col-lg-3 pt-lg-2 col-form-label">Street <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-8">
                            <textarea class="form-control regist-form" rows="4" required name="address" id="address"><?= $temp_address[0] ?></textarea>
                            <!-- <input type="text" class="form-control regist-form" required value="" name="address" id="address"> -->
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="inputCity">District (Kecamatan) <span style="color:red;font-weight:bold;">*</span></label>
                            <input type="text" name="kecamatan" required value="<?= $temp_address[2] ?>" class="form-control regist-form">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="inputCity">Sub District (Kelurahan) <span style="color:red;font-weight:bold;">*</span></label>
                            <input type="text" name="kelurahan" required value="<?= $temp_address[1] ?>" class="form-control regist-form">
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="inputCity">City <span style="color:red;font-weight:bold;">*</span></label>
                            <input type="text" name="kota" required value="<?= $temp_address[3] ?>" class="form-control regist-form">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="inputCity">Province <span style="color:red;font-weight:bold;">*</span></label>
                            <input type="text" name="provinsi" required value="<?= $temp_address[4] ?>" class="form-control regist-form">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="inputZip">Postal Code <span style="color:red;font-weight:bold;">*</span></label>
                            <input type="text" name="zip" required value="<?= $temp_address[5] ?>" class="form-control regist-form">
                        </div>
                        <div id="check_country" class="form-group col-lg-6">
                            <label for="inputCity">Country <span style="color:red;font-weight:bold;">*</span></label>
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
                        <label for="bank" class="col-12 col-lg-3 pt-lg-2 col-form-label">Bank <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" required value="<?= $teacher[0]['bank_teacher'] ?>" name="bank" id="bank">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name_rek_teacher" class="col-12 col-lg-3 pt-lg-2 col-form-label">Account Name <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" required value="<?= $teacher[0]['name_rek_teacher'] ?>" name="name_rek_teacher" id="name_rek_teacher">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="norek" class="col-12 col-lg-3 pt-lg-2 col-form-label">Account No. <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" required value="<?= $teacher[0]['norek_teacher'] ?>" name="norek" id="norek">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="iban_rek_teacher" class="col-12 col-lg-3 pt-lg-2 col-form-label">IBAN</label>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" required value="<?= $teacher[0]['iban_rek_teacher'] ?>" name="iban_rek_teacher" id="iban_rek_teacher">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="swift_rek_teacher" class="col-12 col-lg-3 pt-lg-2 col-form-label">SWIFT</label>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" required value="<?= $teacher[0]['swift_rek_teacher'] ?>" name="swift_rek_teacher" id="swift_rek_teacher">
                        </div>
                    </div>
                    <hr />
                    <!-- <div class="form-group row">
                        <label for="ktp" class="col-3 col-lg-3 pt-lg-2 col-form-label">KTP</label>
                        <div class="col-7 col-lg-8">
                            <input type="file" class="form-control-file regist-form" required name="ktp" id="ktp">
                        </div>
                    </div> -->
                    <div class="mt-4" style="text-align:center">
                        <button id="submit" type="submit" class="btn pr-4 pl-4 btn-primary btn-block">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<script src="<?= base_url('assets/js/jquery-3.4.0.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/bootstrap-datepicker.js') ?>"></script>
<!-- Optional JavaScript -->
<script>
    $(function() {
        $(".datepicker").datepicker({
            weekStart: 1,
            format: 'dd MM yyyy',
            autoclose: true,
            todayHighlight: true,
        });
    });

    var username = document.getElementById('username');
    username.addEventListener('keyup', function(e) {
        let val = e.target.value;
        if (val === document.getElementById("username_before").value) {
            $("#check-username").html("<span style='color:green; font-weight:bold'></span>")
            $('#submit').prop('disabled', false)
        } else {
            $.ajax({
                url: "<?= base_url('portal/C_Portal/checkUsername') ?>",
                type: "POST",
                data: {
                    'username': val,
                    'from': 'teacher'
                },
                success: function(data) {
                    if (data === "" || data === null) {
                        data = "min 4 and max 15 characters";
                    }
                    $("#check-username").html(data)
                }
            });
        }
    })

    var email_teacher = document.getElementById('email_teacher');
    email_teacher.addEventListener('keyup', function(e) {
        let val = e.target.value;
        if (val === document.getElementById("email_teacher_before").value) {
            $("#check-email").html("<span style='color:green; font-weight:bold'></span>")
            $('#submit').prop('disabled', false)
        } else {
            $.ajax({
                url: "<?= base_url('portal/C_Portal/checkEmail') ?>",
                type: "POST",
                data: {
                    'email': val,
                    'from': 'teacher'
                },
                success: function(data) {
                    $("#check-email").html(data)
                }
            });
        }

    })

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
        $('#checkForm').removeClass('hiden');
        $('#checkText').removeClass('hiden');
        $('#btn-change').append(`
            <a href="#" onclick="closePict()" class="btn btn-sm btn-danger btn-change-pict">
                Cancel change profile picture
            </a>
        `);
        $("#check-file-photo-parent").html("png,jpg,jpeg (max size file 2MB)");
        document.getElementById('ubah-pict').value = "ya";
    }

    function closePict() {
        $('.btn-change-pict').remove();
        $('#checkForm').addClass('hiden');
        $('#checkText').addClass('hiden');
        $('#btn-change').append(`
            <a href="#" onclick="openPict()" class="btn btn-sm btn-success btn-change-pict">
                Change Profile Picture
            </a>
        `);
        $("#divImg_student").html("");
        $("#divImg_student").html(`<img src="<?= base_url(); ?>assets/img/pict_guru/<?= $teacher[0]['pict_teacher'] ?>" class="avatar avatartemp rounded-circle img-thumbnail" alt="avatar">`);
        $('#foto').val("");
        document.getElementById('ubah-pict').value = "tidak";
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
        instrument_temp = '<?= $teacher[0]['instrument'] ?>';
        console.log(instrument_temp.split('|')[0]);
        if (instrument_temp.split('|')[0] === 'Others') {
            document.getElementById("instrument").value = 'Others';
            var new_input = `<input type="text" class="form-control" placeholder="input other instrument" id="others" required name="others" value="` + instrument_temp.split('|')[1] + `">`;
            $('#inputOthers').append(new_input);
        } else {
            document.getElementById("instrument").value = '<?= $teacher[0]['instrument'] ?>';
        }
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

        var uploadFieldFotoTeacher = document.getElementById("foto");
        uploadFieldFotoTeacher.onchange = function() {
            let cekTipe = this.files[0].type.split("/");
            if (this.files[0].size > 2097152) {
                $("#divImg_student").html("");
                $("#divImg_student").html(`<img src="<?= base_url() ?>assets/img/avatar.png" class="avatar avatartemp rounded-circle img-thumbnail" alt="avatar">`);
                $("#check-file-photo-parent").html("<span style='color:red; font-weight:bold'>Size more than 2MB</span>");
                this.value = "";
                document.getElementById('ubah-pict').value = "tidak";
            } else {
                if (cekTipe[1] !== "jpeg" && cekTipe[1] !== "png" && cekTipe[1] !== "jpg") {
                    $("#divImg_student").html("");
                    $("#divImg_student").html(`<img src="<?= base_url() ?>assets/img/avatar.png" class="avatar avatartemp rounded-circle img-thumbnail" alt="avatar">`);
                    $("#check-file-photo-parent").html("<span style='color:red; font-weight:bold'>Size more than 2MB</span>");
                    this.value = "";
                    document.getElementById('ubah-pict').value = "tidak";
                } else {
                    $("#check-file-photo-parent").html("png,jpg,jpeg (max size file 2MB)");
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('.avatartemp').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                    document.getElementById('ubah-pict').value = "ya";
                }
            }
        };

        // var readURL = function(input) {
        //     if (input.files && input.files[0]) {
        //         var reader = new FileReader();
        //         reader.onload = function(e) {
        //             $('.avatartemp').attr('src', e.target.result);
        //         }
        //         reader.readAsDataURL(input.files[0]);
        //     }
        // }

        // $(".file-upload").on('change', function() {
        //     let cekTipe = this.files[0].type.split("/");
        //     if (this.files[0].size > (1000 * 2000)) {
        //         $("#divImg_student").html("");
        //         $("#divImg_student").html(`<img src="<?= base_url() ?>assets/img/avatar.png" class="avatar avatartemp rounded-circle img-thumbnail" alt="avatar">`);
        //         $("#check-file-photo-parent").html("<span style='color:red; font-weight:bold'>Size more than 2MB</span>");
        //         $('#foto').val("");
        //         document.getElementById('ubah-pict').value = "tidak";
        //     } else {
        //         if (cekTipe[0] !== "image") {
        //             $("#divImg_student").html("");
        //             $("#divImg_student").html(`<img src="<?= base_url() ?>assets/img/avatarNotAllowed.jpg" class="avatar avatartemp rounded-circle img-thumbnail" alt="avatar">`);
        //             $("#check-file-photo-parent").html("<span style='color:red; font-weight:bold'>Filetype not allowed</span>");
        //             $('#foto').val("");
        //             document.getElementById('ubah-pict').value = "tidak";
        //         } else {
        //             $("#check-file-photo-parent").html("png,jpg,jpeg (max size file 2MB)");
        //             readURL(this);
        //             document.getElementById('ubah-pict').value = "ya";
        //         }
        //     }
        // });
    });
</script>