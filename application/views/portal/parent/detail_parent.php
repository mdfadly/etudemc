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
        <div class="col-lg-12">
            <div style="text-align:left;">
                <span style="font-family:mReguler; font-size:20px;" class="font-weight-bold">
                    <a href="<?= site_url() ?>portal/profile-parent/<?= $student[0]['username_parent'] ?>" class="btn btn-primary">
                        <i class="fa fa-angle-left"></i> Back
                    </a>
                </span>
                <span style="float:right;">
                    <a href="<?= site_url() ?>portal/profile-parent/edit/<?= $this->session->userdata('id') ?>" class="btn btn-primary">
                        <i class="fa fa-edit icon-white"></i> Edit
                    </a>
                </span>
            </div>
        </div>
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
        <hr>
        <h5 style="font-weight:bold">Person in Charge (Parent) Information</h5>
        <div class="row pr-lg-3 pl-lg-3 justify-content-center">
            <div class="col-lg-12">
                <div class="form-group row">
                    <label for="parent_student" class="col-4 col-lg-3">Name</label>
                    <div class="col-8 col-lg-8">
                        <?= $student[0]['parent_student'] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status_parent_1" class="col-4 col-lg-3">Status</label>
                    <div class="col-8 col-lg-8">
                        <?= $student[0]['status_parent_1'] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email_parent_1" class="col-4 col-lg-3">Email</label>
                    <div class="col-8 col-lg-8">
                        <?= $student[0]['email_parent_1'] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="ig_parent_1" class="col-4 col-lg-3">Instagram</label>
                    <div class="col-8 col-lg-8">
                        <?= $student[0]['ig_parent_1'] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone_parent_1" class="col-4 col-lg-3">Phone No.</label>
                    <div class="col-8 col-lg-8">
                        <?= $student[0]['phone_parent_1'] ?>
                    </div>
                </div>
                <?php if ($student[0]['parent_student_2'] != "" && $student[0]['parent_student_2'] != "-" && $student[0]['parent_student_2'] != null) : ?>
                    <h5 style="font-weight:bold">Person in Charge (Parents) Alternatives</h5>
                    <div class="form-group row">
                        <label for="parent_student_2" class="col-4 col-lg-3">Name</label>
                        <div class="col-8 col-lg-8">
                            <?= $student[0]['parent_student_2'] ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status_parent_2" class="col-4 col-lg-3">Status</label>
                        <div class="col-8 col-lg-8">
                            <?= $student[0]['status_parent_2'] ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone_parent_1" class="col-4 col-lg-3">Phone No.</label>
                        <div class="col-8 col-lg-8">
                            <?= $student[0]['phone_parent_2'] ?>
                        </div>
                    </div>
                <?php endif; ?>
                <hr />
                <h5 style="font-weight:bold">Address</h5>
                <div class="form-group row">
                    <label for="address" class="col-4 col-lg-3">Street</label>
                    <div class="col-8 col-lg-8">
                        <?= $student[0]['address_parent'] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kelurahan_parent" class="col-4 col-lg-3">Sub district (Kelurahan)</label>
                    <div class="col-8 col-lg-8">
                        <?= $student[0]['kelurahan_parent'] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kecamatan_parent" class="col-4 col-lg-3">District (Kecamatan)</label>
                    <div class="col-8 col-lg-8">
                        <?= $student[0]['kecamatan_parent'] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Kota_parent" class="col-4 col-lg-3">City</label>
                    <div class="col-8 col-lg-8">
                        <?= $student[0]['kota_parent'] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Postal Code" class="col-4 col-lg-3">Postal Code</label>
                    <div class="col-8 col-lg-8">
                        <?= $student[0]['zip_parent'] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Provinsi_parent" class="col-4 col-lg-3">Province</label>
                    <div class="col-8 col-lg-8">
                        <?= $student[0]['provinsi_parent'] ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Negara" class="col-4 col-lg-3">Country</label>
                    <div class="col-8 col-lg-8">
                        <?= $student[0]['country_parent'] ?>
                    </div>
                </div>
                <hr />
                <h5>Account Etude</h5>
                <div class="form-group row">
                    <label for="address" class="col-4 col-lg-3">Username</label>
                    <div class="col-8 col-lg-8">
                        <?= $student[0]['username_parent'] ?>
                    </div>
                </div>
                <!-- <div class="form-group row">
                    <label for="address" class="col-4 col-lg-3">Password</label>
                    <div class="col-8 col-lg-8">
                        <?= $student[0]['password_parent'] ?>
                    </div>
                </div> -->
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