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
        <div style="text-align:left;">
            <span style="font-family:mReguler; font-size:20px;" class="font-weight-bold">
                <a href="<?= site_url() ?>portal/data_student" class="btn btn-primary">
                    <i class="fa fa-angle-left"></i> Back
                </a>
            </span>
            <span style="float:right;">
                <a href="<?= site_url() ?>portal/C_Admin/edit_student_2/<?= $student[0]['id_student'] ?>" class="btn btn-primary">
                    <i class="fa fa-edit icon-white"></i>
                </a>
                <a href="<?= site_url() ?>portal/C_Admin/delete_data_student/<?= $student[0]['id_student'] ?>" class="btn btn-danger" title="Hapus Data Ini" onclick='return confirm("this data will be deleted. are you sure?")'>
                    <i class="fa fa-trash icon-white"></i>
                </a>
            </span>
        </div>

        <hr>
        <div class="row">
            <div class="col-lg-12">
                <?php if ($this->session->flashdata('success') != null) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= $this->session->flashdata('success') ?>
                    </div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('warning') != null) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $this->session->flashdata('warning') ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="row pr-lg-3 pl-lg-3 justify-content-center">
            <div class="col-lg-12">
                <h5>Student's Information</h5>
                <?php foreach ($student as $s) : ?>
                    <div class="form-group text-center">
                        <div class="cover-img" id="divImg_student">
                            <img src="<?= site_url() ?>assets/img/pict_student/<?= $s['pict_student'] ?>" class="avatar rounded-circle img-thumbnail" alt="avatar">
                        </div>
                    </div>
                    <div class="form-group row pt-3">
                        <label for="name" class="col-4 col-lg-3">Full Name</label>
                        <div class="col-8 col-lg-8">
                            <?= $s['name_student'] ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-4 col-lg-3">Nick Name</label>
                        <div class="col-8 col-lg-8">
                            <?= $s['nickname_student'] == null ? '-' : $s['nickname_student'] ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="text" class="col-4 col-lg-3">Gender</label>
                        <div class="col-8 col-lg-8">
                            <?= $s['gender_student'] ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dob" class="col-4 col-lg-3">Date of Birth</label>
                        <div class="col-8 col-lg-8">
                            <?= $s['dob_student'] ?>
                        </div>
                    </div>
                    <hr />
                    <h5 style="font-weight:bold">ADDRESS</h5>
                    <div class="form-group row">
                        <label for="address" class="col-4 col-lg-3">Street</label>
                        <div class="col-8 col-lg-8">
                            <?= $student[0]['address_student'] ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kecamatan" class="col-4 col-lg-3">District (Kecamatan)</label>
                        <div class="col-8 col-lg-8">
                            <?= $student[0]['kecamatan'] ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kelurahan" class="col-4 col-lg-3">Sub District (Kelurahan)</label>
                        <div class="col-8 col-lg-8">
                            <?= $student[0]['kelurahan'] ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Kota" class="col-4 col-lg-3">City</label>
                        <div class="col-8 col-lg-8">
                            <?= $student[0]['kota'] ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Postal Code" class="col-4 col-lg-3">Postal Code</label>
                        <div class="col-8 col-lg-8">
                            <?= $student[0]['zip'] ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Provinsi" class="col-4 col-lg-3">Province</label>
                        <div class="col-8 col-lg-8">
                            <?= $student[0]['provinsi'] ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Negara" class="col-4 col-lg-3">Country</label>
                        <div class="col-8 col-lg-8">
                            <?= $student[0]['country'] ?>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="form-group row">
                    <label for="currency" class="col-4 col-lg-3">Currency</label>
                    <div class="col-8 col-lg-8">
                        <?php
                        switch ($student[0]['currency']) {
                            case '1':
                                echo "Rupiah";
                                break;
                            case '2':
                                echo "Dollar";
                                break;
                            case '3':
                                echo "Euro";
                                break;
                        }
                        ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Negara" class="col-4 col-lg-3">Teacher Fee Percentage</label>
                    <div class="col-8 col-lg-8">
                        <?= $student[0]['teacher_percentage'] ?>%
                    </div>
                </div>
                <hr />
                <h5>MUSIC LESSON</h5>
                <div class="form-group row">
                    <label for="instrument" class="col-4 col-lg-3">Instrument</label>
                    <div class="col-8 col-lg-8">
                        <?php if (substr($student[0]['instrument'], 0, 6) == "Others") : ?>
                            <?php $temp_ins = explode('|', $student[0]['instrument']) ?>
                            <?= $temp_ins[1] ?>
                        <?php else : ?>
                            <?= $student[0]['instrument'] ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="paket" class="col-4 col-lg-3">Package</label>
                    <div class="col-8 col-lg-8">
                        <?php foreach ($student_package as $sp) : ?>
                            <span class="badge badge-info"><?= $sp['name_paket'] ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="link_repository" class="col-4 col-lg-3">Link Repository</label>
                    <div class="col-8 col-lg-8">
                         <a target="_blank" href="<?= $s['link_repository'] ?>" class="btn btn-info">
                            <?= $student[0]['link_repository'] ?>
                        </a>
                    </div>
                </div>
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