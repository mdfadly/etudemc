<main class="page-content">
    <div class="container-fluid">
        <div class="col-lg-12">
            <a href="<?= site_url() ?>portal/profile-parent/detail/<?= $student[0]['id_parent'] ?>" class="btn btn-primary">
                <i class="fa fa-angle-left"></i> Back
            </a>
        </div>
        <hr>
        <h2 style="font-weight:bold">Edit Person in Charge (Parent) Information</h2>
        <div class="row">
            <?php if ($this->session->flashdata('warning') != null) : ?>
                <div class="col-lg-12">
                    <div class="alert alert-danger" role="alert">
                        <?= $this->session->flashdata('warning') ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="col-lg-12 col-12 mt-4">
                <form action="<?= site_url('portal/C_Parent/edit_data_parent') ?>" method="POST">
                    <input type="hidden" class="form-control" id="id_parent" required value="<?= $student[0]['id_student'] ?>" name="id_student">
                    <input type="hidden" class="form-control" id="id_parent" required value="<?= $student[0]['id_parent'] ?>" name="id_parent">
                    <h5 style="font-weight:bold">ETUDE ACCOUNT</h5>
                    <div class="form-group row">
                        <label for="username_parent" class="col-12 col-lg-3 pt-lg-2 col-form-label">Username account <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-9">
                            <input type="hidden" class="form-control regist-form" required name="username_parent_before" id="username_parent_before" value="<?= $student[0]['username_parent'] ?>">
                            <input type="text" minlength="4" maxlength="15" class="form-control regist-form" required autocomplete="off" name="username_parent" id="username_parent" value="<?= $student[0]['username_parent'] ?>">
                            <small id="check-username-parent" class="form-text">min 4 and max 15 characters</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword_parent" class="col-12 col-lg-3 pt-lg-2 col-form-label">Password account <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-10 col-lg-7">
                            <input type="hidden" class="form-control regist-form" required name="password_parent_before" id="password_parent_before" value="<?= $student[0]['password_parent'] ?>">
                            <input type="password" minlength="8" maxlength="20" class="form-control regist-form pwd-parent" required autocomplete="off" name="password_parent" id="inputPassword_parent" value="<?= $student[0]['password_parent'] ?>">
                            <small class="form-text">min 8 and max 20 characters</small>
                        </div>
                        <div class="col-lg-2 col-2">
                            <button type="button" class="btn btn-default" id="btn-eye-parent" onclick="openPassParent()">
                                <i class="iconEyeParent fa fa-eye-slash"></i>
                            </button>
                        </div>
                    </div>
                    <h5 style="font-weight:bold">Person in Charge Information (Parent)</h5>
                    <div class="form-group row pt-3">
                        <label for="parent_student" class="col-12 col-lg-3 pt-lg-2 col-form-label">Name <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-9">
                            <input type="text" class="form-control regist-form" autocomplete="off" required value="<?= $student[0]['parent_student'] ?>" name="parent_student" id="parent_student">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status_parent_1" class="col-12 col-lg-3 col-form-label">Status <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-9">
                            <select class="form-control regist-form" style="width:100%;" name="status_parent_1" id="status_parent_1" autocomplete="off" required>
                                <option value="">--- Choose Status ---</option>
                                <option value="Dad">Dad</option>
                                <option value="Mom">Mom</option>
                                <option value="Caregiver">Caregiver</option>
                                <option value="Relatives">Relatives</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email_parent_1" class="col-12 col-lg-3 pt-lg-2 col-form-label">Email <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-9">
                            <input type="hidden" class="form-control regist-form" autocomplete="off" required value="<?= $student[0]['email_parent_1'] ?>" name="email_parent_1_before" id="email_parent_1_before">
                            <input type="email" class="form-control regist-form" autocomplete="off" required value="<?= $student[0]['email_parent_1'] ?>" name="email_parent_1" id="email_parent_1">
                            <small id="check-email-parent" class="form-text"></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ig_parent_1" class="col-12 col-lg-3 pt-lg-2 col-form-label">Instagram <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-9">
                            <input type="text" class="form-control regist-form" autocomplete="off" required value="<?= $student[0]['ig_parent_1'] ?>" name="ig_parent_1" id="ig_parent_1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone_parent_1" class="col-12 col-lg-3 pt-lg-2 col-form-label">Phone No. <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-9">
                            <input type="text" class="form-control regist-form" autocomplete="off" required value="<?= $student[0]['phone_parent_1'] ?>" name="phone_parent_1" id="phone_parent_1">
                        </div>
                    </div>
                    <h5 style="font-weight:bold">Person in Charge (Parents) Alternatives</h5>
                    <div class="form-group row">
                        <label for="parent_student_2" class="col-12 col-lg-3 col-form-label">Name <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-9">
                            <input type="text" class="form-control regist-form" autocomplete="off" required value="<?= $student[0]['parent_student_2'] ?>" name="parent_student_2" id="parent_student_2">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status_parent_2" class="col-12 col-lg-3 col-form-label">Status <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-9">
                            <select class="form-control regist-form" style="width:100%;" name="status_parent_2" id="status_parent_2" autocomplete="off" required>
                                <option value="">--- Choose Status ---</option>
                                <option value="Dad">Dad</option>
                                <option value="Mom">Mom</option>
                                <option value="Caregiver">Caregiver</option>
                                <option value="Relatives">Relatives</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone_parent_2" class="col-12 col-lg-3 col-form-label">Phone No. <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-9">
                            <input type="text" class="form-control regist-form" autocomplete="off" required value="<?= $student[0]['phone_parent_2'] ?>" name="phone_parent_2" id="phone_parent_2">
                        </div>
                    </div>
                    <hr>
                    <h5 style="font-weight:bold">Address</h5>
                    <div class="form-group">
                        <textarea class="form-control regist-form" rows="4" autocomplete="off" required name="address_parent" id="address_parent"><?= $student[0]['address_parent'] ?></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="inputCity">Sub district (Kelurahan) <span style="color:red;font-weight:bold;">*</span></label>
                            <input type="text" name="kelurahan_parent" autocomplete="off" required value="<?= $student[0]['kelurahan_parent'] ?>" class="form-control regist-form">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="inputCity">District (Kecamatan) <span style="color:red;font-weight:bold;">*</span></label>
                            <input type="text" name="kecamatan_parent" autocomplete="off" required value="<?= $student[0]['kecamatan_parent'] ?>" class="form-control regist-form">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="inputCity">City <span style="color:red;font-weight:bold;">*</span></label>
                            <input type="text" name="kota_parent" autocomplete="off" required value="<?= $student[0]['kota_parent'] ?>" class="form-control regist-form">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="inputCity">Province <span style="color:red;font-weight:bold;">*</span></label>
                            <input type="text" name="provinsi_parent" autocomplete="off" required value="<?= $student[0]['provinsi_parent'] ?>" class="form-control regist-form">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="inputZip">Postal Code <span style="color:red;font-weight:bold;">*</span></label>
                            <input type="text" name="zip_parent" autocomplete="off" required value="<?= $student[0]['zip_parent'] ?>" class="form-control regist-form">
                        </div>
                        <div id="check_country" class="form-group col-lg-6">
                            <label for="inputCity">Country <span style="color:red;font-weight:bold;">*</span></label>
                            <input id="country" type="text" name="country_parent" value="<?= $student[0]['country_parent'] ?>" autocomplete="off" required class="form-control regist-form">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12 col-lg-12">
                            <button id="submit-parent" type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<script src="<?= base_url('assets/js/jquery-3.4.0.min.js'); ?>"></script>
<script>
    var username_parent = document.getElementById('username_parent');
    username_parent.addEventListener('keyup', function(e) {
        let val = e.target.value;
        if (val === document.getElementById("username_parent_before").value) {
            $("#check-username-parent").html("<span style='color:green; font-weight:bold'></span>")
            $('#submit-parent').prop('disabled', false)
        } else {
            $.ajax({
                url: "<?= base_url('portal/C_Portal/checkUsername') ?>",
                type: "POST",
                data: {
                    'username': val,
                    'from': 'parent'
                },
                success: function(data) {
                    if (data === "" || data === null) {
                        data = "min 4 and max 15 characters";
                    }
                    $("#check-username-parent").html(data)
                }
            });
        }
    })
    var email_parent_1 = document.getElementById('email_parent_1');
    email_parent_1.addEventListener('keyup', function(e) {
        let val = e.target.value;
        if (val === document.getElementById("email_parent_1_before").value) {
            $("#check-email-parent").html("<span style='color:green; font-weight:bold'></span>")
            $('#submit-parent').prop('disabled', false)
        } else {
            $.ajax({
                url: "<?= base_url('portal/C_Portal/checkEmail') ?>",
                type: "POST",
                data: {
                    'email': val,
                    'from': 'parent'
                },
                success: function(data) {
                    $("#check-email-parent").html(data)
                }
            });
        }
    })
    $("#status_country").on('click', function() {
        var value = $(this).val();
        if (value == 0) {
            document.getElementById("status_country").checked = true;
            document.getElementById("status_country").value = "1";
            document.getElementById("kat").value = "1";
        } else {
            document.getElementById("status_country").checked = false;
            document.getElementById("status_country").value = "0";
            document.getElementById("kat").value = "2";
        }

    });
    $(document).ready(function() {
        document.getElementById("status_parent_1").value = '<?= $student[0]['status_parent_1'] ?>';
        document.getElementById("status_parent_2").value = '<?= $student[0]['status_parent_2'] ?>';
        if (<?= $student[0]['kat'] ?> === 1) {
            document.getElementById("status_country").checked = true;
            document.getElementById("status_country").value = "1";
        } else {
            document.getElementById("status_country").checked = false;
            document.getElementById("status_country").value = "0";
        }
    });

    function openPassParent() {
        $('.iconEyeParent').removeClass('fa-eye-slash');
        $('.iconEyeParent').addClass('fa-eye');
        $(".pwd-parent").replaceWith($('.pwd-parent').clone().attr('type', 'text'));
        $('#btn-eye-parent').removeAttr("onclick");
        $('#btn-eye-parent').attr("onclick", 'closePassParent()');
    }

    function closePassParent() {
        $('.iconEyeParent').removeClass('fa-eye');
        $('.iconEyeParent').addClass('fa-eye-slash');
        $(".pwd-parent").replaceWith($('.pwd-parent').clone().attr('type', 'password'));
        $('#btn-eye-parent').removeAttr("onclick");
        $('#btn-eye-parent').attr("onclick", 'openPassParent()');
    }
</script>