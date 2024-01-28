<style>
    h5 {
        font-weight: bold;
    }

    .add,
    .remove {
        background-color: #263850;
        color: white;
        font-size: 12px;
    }

    .add:hover,
    .remove:hover {
        background-color: #0676BD;
        color: white;
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
        <div style="text-align:left;">
            <span style="font-family:mReguler; font-size:20px;" class="font-weight-bold">
                <a href="<?= site_url() ?>portal/data_student/detail/<?= $student[0]['id_student'] ?>" class="btn btn-primary">
                    <i class="fa fa-angle-left"></i> Back
                </a>
            </span>
            <span style="float:right;">

            </span>
        </div>

        <hr>
        <h2 style="font-weight: bold">Edit Data</h2>
        <div class="row">
            <?php if ($this->session->flashdata('warning') != null) : ?>
                <div class="col-lg-12">
                    <div class="alert alert-danger" role="alert">
                        <?= $this->session->flashdata('warning') ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-lg-12 col-12 mt-4">
                <form action="<?= site_url('portal/C_Admin/edit_data_student2') ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" id="id_student" required value="<?= $student[0]['id_student'] ?>" name="id_student">
                    <input type="hidden" class="form-control" id="id_parent" required value="<?= $student[0]['id_parent'] ?>" name="id_parent">
                    <input type="hidden" name="pict_lama" value="<?= $student[0]['pict_student'] ?>">
                    <h5>Student's Information</h5>
                    <div class="form-group text-center">
                        <div class="cover-img" id="divImg_student">
                            <img src="<?= site_url() ?>assets/img/pict_student/<?= $student[0]['pict_student'] ?>" class="avatar avatartemp rounded-circle img-thumbnail" alt="avatar">
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
                        <input type="file" id="foto" name="pict" class="file-upload" style="text-align: center; margin: auto; font-size:12px" accept="image/*">
                    </div>
                    <div class="row text-center mt-2 mb-3 hiden" id="checkText">
                        <div class="col-lg-12">
                            <span id="check-file-photo-parent">png,jpg,jpeg (max size file 2MB)</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name_student">Student's Full Name <span style="color:red;font-weight:bold;">*</span></label>
                        <input type="text" class="form-control" id="name_student" autocomplete="off" required value="<?= $student[0]['name_student'] ?>" name="name_student">
                    </div>
                    <div class="form-group">
                        <label for="nickname_student">Student's Nick Name <span style="color:red;font-weight:bold;">*</span></label>
                        <input type="text" class="form-control" id="nickname_student" autocomplete="off" required value="<?= $student[0]['nickname_student'] ?>" name="nickname_student">
                    </div>

                    <div class="form-group">
                        <label for="gender_student">Student's Gender <span style="color:red;font-weight:bold;">*</span></label>
                        <select class="form-control" style="width:100%;" id="gender_student" name="gender_student" autocomplete="off" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <?php $temp_dob = explode(",", $student[0]['dob_student']) ?>
                    <div class="form-group">
                        <label for="tempat_dob">Student's Place of Birth <span style="color:red;font-weight:bold;">*</span></label>
                        <input type="text" class="form-control" id="tempat_dob" required value="<?= $temp_dob[0] ?>" autocomplete="off" name="tempat_dob">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_dob">Student's Date of Birth <span style="color:red;font-weight:bold;">*</span></label>
                        <input type="text" class="form-control datepicker" id="tanggal_dob" required value="<?= $temp_dob[1] ?>" autocomplete="off" name="tanggal_dob">
                    </div>
                    <hr>
                    <h5>ADDRESS <span style="color:red;font-weight:bold;">*</span></h5>
                    <div class="form-group">
                        <textarea class="form-control regist-form" rows="4" required name="address_student" id="address_student"><?= $student[0]['address_student'] ?></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="inputCity">Sub district (Kelurahan) <span style="color:red;font-weight:bold;">*</span></label>
                            <input type="text" name="kelurahan" autocomplete="off" required value="<?= $student[0]['kelurahan'] ?>" class="form-control regist-form">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="inputCity">District (Kecamatan) <span style="color:red;font-weight:bold;">*</span></label>
                            <input type="text" name="kecamatan" autocomplete="off" required value="<?= $student[0]['kecamatan'] ?>" class="form-control regist-form">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="inputCity">City <span style="color:red;font-weight:bold;">*</span></label>
                            <input type="text" name="kota" autocomplete="off" required value="<?= $student[0]['kota'] ?>" class="form-control regist-form">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="inputCity">Province <span style="color:red;font-weight:bold;">*</span></label>
                            <input type="text" name="provinsi" autocomplete="off" required value="<?= $student[0]['provinsi'] ?>" class="form-control regist-form">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="inputZip">Postal Code <span style="color:red;font-weight:bold;">*</span></label>
                            <input type="text" name="zip" autocomplete="off" required value="<?= $student[0]['zip'] ?>" class="form-control regist-form">
                        </div>
                        <div id="check_country" class="form-group col-lg-6">
                            <label for="inputCity">Country <span style="color:red;font-weight:bold;">*</span></label>
                            <input id="country" type="text" name="country" value="<?= $student[0]['country'] ?>" autocomplete="off" required class="form-control regist-form">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Select currency <span style="color:red;font-weight:bold;">*</span></label>
                        <select class="form-control" style="width:100%;" name="currency" id="currency" required>
                            <option value="1">Rupiah</option>
                            <option value="2">Dollar</option>
                            <option value="3">Euro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="teacher_percentage">Teacher Fee Percentage <span style="color:red;font-weight:bold;">*</span></label>
                        <input type="text" name="teacher_percentage" id="teacher_percentage" class="form-control regist-form" value="<?= $student[0]['teacher_percentage'] ?>" autocomplete="off" required>
                    </div>
                    <hr>
                    <h5>MUSIC LESSON</h5>
                    <div class="form-group">
                        <label for="instrument">Instrument <span style="color:red;font-weight:bold;">*</span></label>
                        <select class="form-control" style="width:100%;" name="instrument" id="instrument" required onchange="instrumentFunc(event)">
                            <option value="">--- Choose Instrument ---</option>
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
                    <div class="form-group">
                        <label for="paket">Package <span style="color:red;font-weight:bold;">*</span></label>
                        <select class="form-control multiple-select" required multiple style="width:100%;" name="paket[]" id="paket">
                            <?php foreach ($paket as $t) : ?>
                                <option value="<?= $t['id'] ?>"><?= $t['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="link_repository">Link Repository</label>
                        <input type="text" name="link_repository" id="link_repository" class="form-control regist-form" value="<?= $student[0]['link_repository'] ?>" autocomplete="off">
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
        document.getElementById("gender_student").value = '<?= $student[0]['gender_student'] ?>';
        let tempPaketArr = [];
        <?php foreach ($student_package as $t) : ?>
            tempPaketArr.push('<?= $t['id_paket'] ?>');
        <?php endforeach; ?>
        $("#paket").select2().val(tempPaketArr).trigger('change.select2');

        instrument_temp = '<?= $student[0]['instrument'] ?>';
        console.log(instrument_temp.split('|')[0]);
        if (instrument_temp.split('|')[0] === 'Others') {
            document.getElementById("instrument").value = 'Others';
            var new_input = `<input type="text" class="form-control" placeholder="input other instrument" id="others" required name="others" value="` + instrument_temp.split('|')[1] + `">`;
            $('#inputOthers').append(new_input);
        } else {
            document.getElementById("instrument").value = '<?= $student[0]['instrument'] ?>';
        }
        document.getElementById("currency").value = '<?= $student[0]['currency'] ?>';
        $('.select-form').select2();
        $('.multiple-select').select2();

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
                $('#foto').val("");
                document.getElementById('ubah-pict').value = "tidak";
            } else {
                if (cekTipe[0] !== "image") {
                    $("#divImg_student").html("");
                    $("#divImg_student").html(`<img src="<?= site_url() ?>assets/img/avatarNotAllowed.jpg" class="avatar avatartemp rounded-circle img-thumbnail" alt="avatar">`);
                    $("#check-file-photo-parent").html("<span style='color:red; font-weight:bold'>Filetype not allowed</span>");
                    $('#foto').val("");
                    document.getElementById('ubah-pict').value = "tidak";
                } else {
                    $("#check-file-photo-parent").html("png,jpg,jpeg (max size file 2MB)");
                    readURL(this);
                    document.getElementById('ubah-pict').value = "ya";
                }
            }
        });
    })

    function instrumentFunc(e) {
        var temp_val = e.target.value;
        if (temp_val === 'Others') {
            var new_input = `<input type="text" class="form-control" placeholder="input other instrument" id="others" required name="others">`;
            $('#inputOthers').append(new_input);
        } else {
            $('#others').remove();
        }
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
        $("#divImg_student").html(`<img src="<?= site_url() ?>assets/img/pict_student/<?= $student[0]['pict_student'] ?>" class="avatar avatartemp rounded-circle img-thumbnail" alt="avatar">`);
        $('#foto').val("");
        document.getElementById('ubah-pict').value = "tidak";
    }
</script>