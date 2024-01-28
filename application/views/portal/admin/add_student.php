<style>
    h5 {
        font-weight: bold;
    }

    .hiden {
        display: none;
    }
</style>
<main class="page-content">
    <div class="container-fluid">
        <div style="text-align:left;">
            <span style="font-family:mReguler; font-size:20px;" class="font-weight-bold">
                <a href="<?= site_url() ?>portal/data_student" class="btn btn-primary">
                    <i class="fa fa-angle-left"></i> Back
                </a>
            </span>
            <span style="float:right;">

            </span>
        </div>

        <hr>
        <h2 style="font-weight:bold">Add Data</h2>

        <div class="row">
            <?php if ($this->session->flashdata('warning') != null) : ?>
                <div class="col-lg-12">
                    <div class="alert alert-danger" role="alert">
                        <?= $this->session->flashdata('warning') ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="col-lg-12 col-12 mt-4">
                <form action="<?= site_url('portal/C_Admin/add_data_student') ?>" method="POST" enctype="multipart/form-data">
                    <?php if ($data['choose'] == "student") : ?>
                        <div class="form-group">
                            <label for="parent_student">Parent Name</label><br>
                            <select class="form-control select-form" style="width:100%;" name="id_parent">
                                <option>Choose Parent</option>
                                <?php $id_parent = [];
                                    $parent_student = []; ?>
                                <?php foreach ($student as $s) : ?>
                                    <?php $id_parent[] = $s['id_parent'] . "-" . $s['parent_student']; ?>
                                <?php endforeach; ?>
                                <?php $id_parent = array_unique($id_parent); ?>
                                <?php $id_parent_im = implode(".", $id_parent); ?>
                                <?php $id_parent_ex = explode(".", $id_parent_im); ?>

                                <?php for ($i = 0; $i < count($id_parent_ex); $i++) : ?>
                                    <option value="<?= substr($id_parent_ex[$i], 0, 6); ?>">
                                        <?= substr($id_parent_ex[$i], 7); ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <input type="hidden" class="form-control regist-form" required value="add_student_admin" name="from_form" id="from_form">
                    <?php endif; ?>
                    <hr />
                    <h5>Student's Information</h5>
                    <div class="form-group text-center">
                        <div class="cover-img" id="divImg_student">
                            <img src="<?= site_url() ?>assets/img/avatar.png" class="avatar avatartemp rounded-circle img-thumbnail" alt="avatar">
                        </div>
                        <p class="mt-2">Upload Student's picture</p>
                    </div>
                    <div class="form-group ml-5" style="width: 100%;height: 100%;margin: auto;text-align: center;">
                        <input type="hidden" value="tidak" name="ubah-pict1" class="ubah-pict1" id="ubah-pict1">
                        <input type="file" id="pict_student1" name="pict_student1" class="file-upload" style="text-align: center; margin: auto; font-size:12px" accept="image/*">
                    </div>
                    <div class="row text-center mt-2 mb-3">
                        <div class="col-lg-12">
                            <span id="check-file-photo-parent">png,jpg,jpeg (max size file 2MB)</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name_student">Student's Full Name <span style="color:red;font-weight:bold;">*</span></label>
                        <input type="text" class="form-control" id="name_student" required name="name_student1">
                    </div>
                    <div class="form-group">
                        <label for="nickname_student">Student's Nick Name <span style="color:red;font-weight:bold;">*</span></label>
                        <input type="text" class="form-control" id="nickname_student" required name="nickname_student1">
                    </div>
                    <div class="form-group">
                        <label for="gender_student">Student's Gender <span style="color:red;font-weight:bold;">*</span></label>
                        <select class="form-control" style="width:100%;" id="gender_student1" name="gender_student1" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tempat_dob1">Student's Place of Birth <span style="color:red;font-weight:bold;">*</span></label>
                        <input type="text" class="form-control" id="tempat_dob1" required autocomplete="off" name="tempat_dob1">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_dob1">Student's Date of Birth <span style="color:red;font-weight:bold;">*</span></label>
                        <input type="text" class="form-control datepicker" id="tanggal_dob1" required autocomplete="off" name="tanggal_dob1">
                    </div>

                    <input type="hidden" value="1" name="total_student" id="total_student">
                    <div id="new_student">

                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" name="check_address" value="1" checked class="form-check-input" id="check_address">
                        <label class="form-check-label" for="check_address">
                            The address same as parent</label>
                        <span class="checkmark"></span>
                    </div>
                    <div id="address_parent_same" class="hiden">
                        <div class="form-group">
                            <label for="address_student">Address</label>
                            <textarea class="form-control regist-form" rows="4" name="address_student" id="address_student"></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="kelurahan">Sub District</label>
                                <input type="text" id="kelurahan" name="kelurahan" class="form-control regist-form">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="kecamatan">District</label>
                                <input type="text" name="kecamatan" id="kecamatan" class="form-control regist-form">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="kota">City</label>
                                <input type="text" name="kota" id="kota" class="form-control regist-form">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="provinsi">Province</label>
                                <input type="text" name="provinsi" id="provinsi" class="form-control regist-form">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="inputZip">Postal Code</label>
                                <input type="text" name="zip" id="zip" class="form-control regist-form">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="country">Country</label>
                                <input type="text" name="country" id="country" class="form-control regist-form">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6 col-lg-6">
                            <button type="button" class="add btn btn-primary"><i class="fa fa-plus"></i></button>
                            <button type="button" class="remove btn btn-primary"><i class="fa fa-minus"></i></button>
                        </div>
                        <div class="col-6 col-lg-6">
                        </div>
                    </div>
                    <?php if ($data['choose'] == "parent") : ?>
                        <h5>Etude Account</h5>
                        <div class="form-group row">
                            <label for="username_parent" class="col-3 col-lg-3 pt-lg-2 col-form-label">Username</label>
                            <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                            <div class="col-12 col-lg-8">
                                <input type="text" minlength="3" maxlength="15" class="form-control regist-form" required name="username_parent" id="username_parent">
                                <small id="check-username-parent" class="form-text"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword_parent" class="col-3 col-lg-3 pt-lg-2 col-form-label">Password</label>
                            <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                            <div class="col-10 col-lg-6">
                                <input type="password" minlength="8" maxlength="20" class="form-control regist-form pwd-parent" required name="password_parent" id="inputPassword_parent">
                                <small class="form-text">min 8 and max 20 characters</small>
                            </div>
                            <div class="col-lg-2 col-2">
                                <button type="button" class="btn btn-default" id="btn-eye-parent" onclick="openPassParent()">
                                    <i class="iconEyeParent fa fa-eye-slash"></i>
                                </button>
                            </div>
                        </div>
                        <hr />
                        <h5 style="font-weight:bold">Parent / Person in Charge Information</h5>
                        <div class="form-group row pt-3">
                            <label for="parent_student" class="col-3 col-lg-3 pt-lg-2 col-form-label">Name</label>
                            <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                            <div class="col-12 col-lg-8">
                                <input type="text" class="form-control regist-form" required name="parent_student" id="parent_student">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email_parent_1" class="col-3 col-lg-3 pt-lg-2 col-form-label">Email</label>
                            <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                            <div class="col-12 col-lg-8">
                                <input type="email" class="form-control regist-form" required name="email_parent_1" id="email_parent_1">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ig_parent_1" class="col-3 col-lg-3 pt-lg-2 col-form-label">Instagram</label>
                            <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                            <div class="col-12 col-lg-8">
                                <input type="text" class="form-control regist-form" required name="ig_parent_1" id="ig_parent_1">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone_parent_1" class="col-3 col-lg-3 pt-lg-2 col-form-label">Phone No.</label>
                            <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                            <div class="col-12 col-lg-8">
                                <input type="text" class="form-control regist-form" required name="phone_parent_1" id="phone_parent_1">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone_parent_2" class="col-3 col-lg-3 col-form-label">Alternative Phone No.</label>
                            <span class="col-1 col-lg-1"> : </span>
                            <div class="col-12 col-lg-8">
                                <input type="text" class="form-control regist-form" required name="phone_parent_2" id="phone_parent_2">
                                <small class="form-text text-muted">(Ex: housemate/babysitter/etc)</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address_parent">Address</label>
                            <textarea class="form-control regist-form" rows="4" required name="address_parent" id="address_parent"></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="kelurahan_parent">Sub District</label>
                                <input type="text" id="kelurahan_parent" name="kelurahan_parent" required class="form-control regist-form">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="kecamatan_parent">District</label>
                                <input type="text" name="kecamatan_parent" id="kecamatan_parent" required class="form-control regist-form">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="kota_parent">City</label>
                                <input type="text" name="kota_parent" id="kota_parent" required class="form-control regist-form">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="provinsi_parent">Province</label>
                                <input type="text" name="provinsi_parent" id="provinsi_parent" required class="form-control regist-form">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="zip_parent">Postal Code</label>
                                <input type="text" name="zip_parent" id="zip_parent" required class="form-control regist-form">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="country_parent">Country</label>
                                <input type="text" name="country_parent" id="country_parent" required class="form-control regist-form">
                            </div>
                        </div>
                    <?php endif; ?>
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
<script src="<?= base_url('assets/js/bootstrap-datepicker.js') ?>"></script>
<script>
    $(".datepicker").datepicker({
        weekStart: 1,
        format: 'dd MM yyyy',
        autoclose: true,
        todayHighlight: true,
    });
    $(document).ready(function() {
        $(".next").html('<i class="fa fa-arrow-right"></i>');
        $(".prev").html('<i class="fa fa-arrow-left"></i>');
        $('.select-form').select2();
        var counter_total_student = parseInt($('#total_student').val());

        var readURL = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.avatartemp').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(".file-upload").on('change', function() {
            let cekTipe = this.files[0].type.split("/");
            if (this.files[0].size > (1000 * 2000)) {
                $("#divImg_student").html("");
                $("#divImg_student").html(`<img src="<?= site_url() ?>assets/img/avatar.png" class="avatar avatartemp rounded-circle img-thumbnail" alt="avatar">`);
                $("#check-file-photo-parent").html("<span style='color:red; font-weight:bold'>Size more than 2MB</span>");
                $('#pict_student1').val("");
                document.getElementById('ubah-pict1').value = "tidak";
            } else {
                if (cekTipe[0] !== "image") {
                    $("#divImg_student").html("");
                    $("#divImg_student").html(`<img src="<?= site_url() ?>assets/img/avatarNotAllowed.jpg" class="avatar avatartemp rounded-circle img-thumbnail" alt="avatar">`);
                    $("#check-file-photo-parent").html("<span style='color:red; font-weight:bold'>Filetype not allowed</span>");
                    $('#pict_student1').val("");
                    document.getElementById('ubah-pict1').value = "tidak";
                } else {
                    $("#check-file-photo-parent").html("");
                    readURL(this);
                    document.getElementById('ubah-pict1').value = "ya";
                }
            }
        });

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

        $('.add').on('click', add);
        $('.remove').on('click', remove);

        function add() {
            var new_student_no = parseInt($('#total_student').val()) + 1;
            var new_input = `<div id='new_` + new_student_no + `'>
                    <p>Student ` + new_student_no + `</p>
                    <div class="form-group text-center">
                        <div class="cover-img" id="divImg_student` + new_student_no + `">
                            <img src="<?= site_url() ?>assets/img/avatar.png" class="avatar avatartemp` + new_student_no + ` rounded-circle img-thumbnail" alt="avatar">
                        </div>
                        <p class="mt-2">Upload Student's picture</p>
                    </div>
                    <div class="form-group ml-5" style="width: 100%;height: 100%;margin: auto;text-align: center;">
                        <input type="hidden" value="tidak" name="ubah-pict` + new_student_no + `" class="ubah-pict` + new_student_no + `" id="ubah-pict` + new_student_no + `">
                        <input type="file" id="pict_student` + new_student_no + `" name="pict_student` + new_student_no + `" class="file-upload` + new_student_no + `" style="text-align: center; margin: auto; font-size:12px" accept="image/*">
                    </div>
                    <div class="row text-center mt-2 mb-3">
                        <div class="col-lg-12">
                            <span id="check-file-photo-parent` + new_student_no + `">png,jpg,jpeg (max size file 2MB)</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name_student` + new_student_no + `">Student's Full Name <span style="color:red;font-weight:bold;">*</span></label>
                        <input type="text" class="form-control" id="name_student` + new_student_no + `" required autocomplete="off" name="name_student` + new_student_no + `">
                    </div>
                    <div class="form-group">
                        <label for="nickname_student` + new_student_no + `">Student's Nick Name <span style="color:red;font-weight:bold;">*</span></label>
                        <input type="text" class="form-control" id="nickname_student` + new_student_no + `" required autocomplete="off" name="nickname_student` + new_student_no + `">
                    </div>
                    <div class="form-group">
                        <label for="gender_student">Student Gender <span style="color:red;font-weight:bold;">*</span></label>
                        <select class="form-control" style="width:100%;" id="gender_student` + new_student_no + `" name="gender_student` + new_student_no + `" required autocomplete="off">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tempat_dob` + new_student_no + `">Student's Place of Birth <span style="color:red;font-weight:bold;">*</span></label>
                        <input type="text" class="form-control" id="tempat_dob` + new_student_no + `" required autocomplete="off" name="tempat_dob` + new_student_no + `">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_dob` + new_student_no + `">Student's Date of Birth <span style="color:red;font-weight:bold;">*</span></label>
                        <input type="text" class="form-control datepicker2" id="tanggal_dob` + new_student_no + `" required autocomplete="off" name="tanggal_dob` + new_student_no + `">
                    </div>
                </div>`;
            $('#new_student').append(new_input);
            $('#total_student').val(new_student_no);
            counter_total_student += 1;
            console.log(counter_total_student);
            for (let i = 2; i <= counter_total_student; i++) {
                $('.file-upload' + i).on('change', function() {
                    let cekTipe = this.files[0].type.split("/");
                    if (this.files[0].size > (1000 * 2000)) {
                        $("#divImg_student" + i).html("");
                        $("#divImg_student" + i).html(`<img src="<?= site_url() ?>assets/img/avatar.png" class="avatar avatartemp` + new_student_no + ` rounded-circle img-thumbnail" alt="avatar">`);
                        $("#check-file-photo-parent" + i).html("<span style='color:red; font-weight:bold'>Size more than 2MB</span>");
                        $('#pict_student' + i).val("");
                        document.getElementById('ubah-pict' + i).value = "tidak";
                    } else {
                        if (cekTipe[0] !== "image") {
                            $("#divImg_student" + i).html("");
                            $("#divImg_student" + i).html(`<img src="<?= site_url() ?>assets/img/avatarNotAllowed.jpg" class="avatar avatartemp` + new_student_no + ` rounded-circle img-thumbnail" alt="avatar">`);
                            $("#check-file-photo-parent" + i).html("<span style='color:red; font-weight:bold'>Filetype not allowed</span>");
                            $('#pict_student' + i).val("");
                            document.getElementById('ubah-pict' + i).value = "tidak";
                        } else {
                            $("#check-file-photo-parent" + i).html("");
                            if (this.files && this.files[0]) {
                                document.getElementById('ubah-pict' + i).value = "ya";
                                let reader = new FileReader();
                                reader.onload = function(e) {
                                    $('.avatartemp' + i).attr('src', e.target.result);
                                }
                                reader.readAsDataURL(this.files[0]);
                            }
                        }
                    }
                });
            }
            $(".datepicker2").datepicker({
                weekStart: 1,
                format: 'dd MM yyyy',
                autoclose: true,
                todayHighlight: true,
            });
            $(".next").html('<i class="fa fa-arrow-right"></i>');
            $(".prev").html('<i class="fa fa-arrow-left"></i>');
        }

        function remove() {
            var last_student_no = $('#total_student').val();
            if (last_student_no > 1) {
                $('#new_' + last_student_no).remove();
                $('#total_student').val(last_student_no - 1);
                counter_total_student -= 1;
            }
        }
    });

    $("#status_country").on('click', function() {
        var value = $(this).val();
        if (value == 0) {
            document.getElementById("status_country").value = "1";
            document.getElementById("kat").value = "1";
        } else {
            document.getElementById("status_country").value = "0";
            document.getElementById("kat").value = "2";
        }
    });
    $("#check_address").on('click', function() {
        var value = $(this).val();
        if (value == 0) {
            document.getElementById("check_address").value = "1";
            document.getElementById("address_parent_same").classList.add("hiden");
        } else {
            document.getElementById("check_address").value = "0";
            document.getElementById("address_parent_same").classList.remove("hiden");

        }
    });
</script>