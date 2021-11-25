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
        <!-- <div class="col-lg-2 col-2">
            <h5 style="font-family:mReguler" class="font-weight-bold">PROFILE</h5>
        </div> -->
        <div class="row pt-lg-3 pt-4">
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
        <div style="text-align:left;">
            <!-- <h5 style="font-family:mReguler" class="font-weight-bold">Profile</h5> -->
            <span style="font-family:mReguler; font-size:20px;" class="font-weight-bold">
                <a href="<?= site_url() ?>portal/data_student" class="btn btn-primary">
                    <i class="fa fa-angle-left"></i> Back
                </a>
            </span>
            <span style="float:right;">
                <!-- <a href="<?= site_url() ?>portal/data_student/edit/<?= $student[0]['id_student'] ?>" class="btn btn-primary">
                    <i class="fa fa-edit icon-white"></i>
                </a> -->
                <a href="<?= site_url() ?>portal/C_Admin/edit_student_2/<?= $student[0]['id_student'] ?>" class="btn btn-primary">
                    <i class="fa fa-edit icon-white"></i>
                </a>
                <a href="<?= site_url() ?>portal/C_Admin/delete_data_student/<?= $student[0]['id_student'] ?>" class="btn btn-danger" title="Hapus Data Ini" onclick='return confirm("are you sure want to delete this data?")'>
                    <i class="fa fa-trash icon-white"></i>
                </a>
            </span>
        </div>

        <hr>
        <div class="row pr-3">
            <div class="col-lg-2 col-2">
                <!-- <a href="<?= site_url() ?>portal/data_student" class="btn btn-primary">
                    BACK
                </a> -->
                <span style="font-family:mReguler; font-size:20px;" class="font-weight-bold">
                    PROFILE
                </span>
            </div>
        </div>
        
        <div class="row pr-lg-3 pl-lg-3 justify-content-center">
            <div class="col-lg-12">
                <div class="form-group text-center">
                </div>
                <!-- <div class="form-group row pt-3">
                    <label for="name" class="col-4 col-lg-3 pt-lg-2 col-form-label">Parent Name</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $student[0]['parent_student'] ?>
                    </div>
                </div> -->
                <!-- <hr /> -->
                <h5>STUDENT</h5>
                <?php foreach ($student as $s) : ?>
                    <div class="form-group row pt-3">
                        <label for="name" class="col-4 col-lg-3 pt-lg-2 col-form-label">Full Name</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <?= $s['name_student'] ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-4 col-lg-3 pt-lg-2 col-form-label">Nick Name</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <?= $s['nickname_student'] == null ? '-' : $s['nickname_student'] ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dob" class="col-4 col-lg-3 pt-lg-2 col-form-label">Place - DOB</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <?= $s['dob_student'] ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-4 col-lg-3 pt-lg-2 col-form-label">School</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <?= $s['school_student'] ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="credentials" class="col-4 col-lg-3 pt-lg-2 col-form-label">Phone Number/WA</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <?= $student[0]['phone_student'] ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ig_student" class="col-4 col-lg-3 pt-lg-2 col-form-label">Instagram</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <?= $student[0]['ig_student'] ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email_student" class="col-4 col-lg-3 pt-lg-2 col-form-label">Email</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <?= $student[0]['email_student'] ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-4 col-lg-3 pt-lg-2 col-form-label">Street</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <?= $student[0]['address_student'] ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kelurahan" class="col-4 col-lg-3 pt-lg-2 col-form-label">Sub District</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <?= $student[0]['kelurahan'] ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kecamatan" class="col-4 col-lg-3 pt-lg-2 col-form-label">District</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <?= $student[0]['kecamatan'] ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Kota" class="col-4 col-lg-3 pt-lg-2 col-form-label">City</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <?= $student[0]['kota'] ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Postal Code" class="col-4 col-lg-3 pt-lg-2 col-form-label">Postal Code</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <?= $student[0]['zip'] ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Provinsi" class="col-4 col-lg-3 pt-lg-2 col-form-label">Province</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <?= $student[0]['provinsi'] ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Negara" class="col-4 col-lg-3 pt-lg-2 col-form-label">Country</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <?= $student[0]['country'] ?>
                        </div>
                    </div>
                <?php endforeach; ?>

                <hr />
                <h5>PERSON in CHARGE (1)</h5>
                <div class="form-group row">
                    <label for="parent_student" class="col-4 col-lg-3 pt-lg-2 col-form-label">Name</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $student[0]['parent_student'] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status_parent_1" class="col-4 col-lg-3 pt-lg-2 col-form-label">Status</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $student[0]['status_parent_1'] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone_parent_1" class="col-4 col-lg-3 pt-lg-2 col-form-label">Phone Number/WA</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $student[0]['phone_parent_1'] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email_parent_1" class="col-4 col-lg-3 pt-lg-2 col-form-label">Email</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $student[0]['email_parent_1'] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="ig_parent_1" class="col-4 col-lg-3 pt-lg-2 col-form-label">Instagram</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $student[0]['ig_parent_1'] ?>
                    </div>
                </div>

                <hr />
                <h5>PERSON in CHARGE (2)</h5>
                <div class="form-group row">
                    <label for="parent_student_2" class="col-4 col-lg-3 pt-lg-2 col-form-label">Name</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $student[0]['parent_student_2'] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status_parent_2" class="col-4 col-lg-3 pt-lg-2 col-form-label">Status</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $student[0]['status_parent_2'] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone_parent_2" class="col-4 col-lg-3 pt-lg-2 col-form-label">Phone Number/WA</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $student[0]['phone_parent_2'] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email_parent_2" class="col-4 col-lg-3 pt-lg-2 col-form-label">Email</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $student[0]['email_parent_2'] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="ig_parent_2" class="col-4 col-lg-3 pt-lg-2 col-form-label">Instagram</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $student[0]['ig_parent_2'] ?>
                    </div>
                </div>
                <hr />
                <h5>Person in Charge Address</h5>
                <div class="form-group row">
                    <label for="address" class="col-4 col-lg-3 pt-lg-2 col-form-label">Street</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $student[0]['address_parent'] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kelurahan_parent" class="col-4 col-lg-3 pt-lg-2 col-form-label">Sub District</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $student[0]['kelurahan_parent'] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kecamatan_parent" class="col-4 col-lg-3 pt-lg-2 col-form-label">District</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $student[0]['kecamatan_parent'] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Kota_parent" class="col-4 col-lg-3 pt-lg-2 col-form-label">City</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $student[0]['kota_parent'] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Postal Code" class="col-4 col-lg-3 pt-lg-2 col-form-label">Postal Code</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $student[0]['zip_parent'] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Provinsi_parent" class="col-4 col-lg-3 pt-lg-2 col-form-label">Province</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $student[0]['provinsi_parent'] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Negara" class="col-4 col-lg-3 pt-lg-2 col-form-label">Country</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $student[0]['country_parent'] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="currency" class="col-4 col-lg-3 pt-lg-2 col-form-label">Currency</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
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
                    <label for="Negara" class="col-4 col-lg-3 pt-lg-2 col-form-label">Teacher Fee Percentage</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $student[0]['teacher_percentage'] ?>%
                    </div>
                </div>
                <hr />
                <h5>MUSIC LESSON</h5>
                <div class="form-group row">
                    <label for="instrument" class="col-4 col-lg-3 pt-lg-2 col-form-label">Instrument</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?php if (substr($student[0]['instrument'], 0, 6) == "Others") : ?>
                            <?php $temp_ins = explode('|', $student[0]['instrument']) ?>
                            <?= $temp_ins[1] ?>
                        <?php else : ?>
                            <?= $student[0]['instrument'] ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="paket" class="col-4 col-lg-3 pt-lg-2 col-form-label">Package</label>
                    <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                    <div class="col-12 col-lg-8">
                        <?= $student[0]['paket'] ?>
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