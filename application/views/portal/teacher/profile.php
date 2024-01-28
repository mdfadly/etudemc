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

    .regist-form {
        border: 0;
        background-color: white;
    }
</style>
<main class="page-content">
    <div class="container-fluid">
        <div class="row pt-lg-3 pt-4">
            <div class="col-lg-12">
                <?php if ($this->session->flashdata('success') != null) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= $this->session->flashdata('success') ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php if (substr($this->session->userdata('id'), 0, 1) == 3) { ?>
            <div style="text-align:left;">
                <span style="font-family:mReguler; font-size:20px;" class="font-weight-bold">
                    <a href="<?= site_url() ?>portal/data_teacher" class="btn btn-primary">
                        <i class="fa fa-angle-left"></i> Back
                    </a>
                </span>
                <span style="float:right;">
                    <a href="<?= site_url() ?>portal/C_Admin/delete_data_teacher/<?= $teacher[0]['id_teacher'] ?>" class="btn btn-danger" title="Hapus Data Ini" onclick='return confirm("this data will be deleted. are you sure?")'>
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
        <div class="row pr-lg-3 pl-lg-3 mt-5 justify-content-center">
            <div class="col-lg-12">
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    ACCOUNT
                                </button>
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-12 col-lg-2 col-form-label">Username</label>
                                    <div class="col-12 col-lg-9 pt-lg-2">
                                        <?= $teacher[0]['username'] ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-12 col-lg-2 pt-lg-2 col-form-label">Password</label>
                                    <div class="col-10 col-lg-7">
                                        <input type="password" autocomplete="off" minlength="8" maxlength="20" class="form-control regist-form pwd" readonly value="<?= $teacher[0]['password'] ?>" name="password" id="inputPassword">
                                    </div>
                                    <div class="col-lg-2 col-2">
                                        <button id="btn-eye" onclick="openPass()" class="btn btn-default reveal" type="button">
                                            <i class="iconEye fa fa-eye-slash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    PROFILE
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-12 col-lg-2 col-form-label">ID</label>
                                    <div class="col-12 col-lg-9 pt-lg-2">
                                        <?= $teacher[0]['id_teacher'] ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-lg-2 col-form-label">Name</label>
                                    <div class="col-12 col-lg-9 pt-lg-2">
                                        <?= $teacher[0]['name_teacher'] ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-lg-2 col-form-label">Email</label>
                                    <div class="col-12 col-lg-9 pt-lg-2">
                                        <?= $teacher[0]['email_teacher'] ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-lg-2 col-form-label">Instrument</label>
                                    <div class="col-12 col-lg-9 pt-lg-2">
                                        <?= $teacher[0]['instrument'] ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-lg-2 col-form-label">Linkedin</label>
                                    <div class="col-12 col-lg-9 pt-lg-2">
                                        <a href='<?= $teacher[0]['linkedin'] ?>' target="_blank"><?= $teacher[0]['linkedin'] ?></a>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-lg-2 col-form-label">Phone No.</label>
                                    <div class="col-12 col-lg-9 pt-lg-2">
                                        <?= $teacher[0]['phone_teacher'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                                <button class="btn collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    ADDRESS
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body">
                                <?php $temp_address = explode("~", $teacher[0]['address_teacher']) ?>
                                <div class="form-group row">
                                    <label class="col-12 col-lg-2 col-form-label">Street</label>
                                    <div class="col-12 col-lg-9 pt-lg-2">
                                        <?= $temp_address[0] ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-lg-2 col-form-label">Sub District</label>
                                    <div class="col-12 col-lg-9 pt-lg-2">
                                        <?= $temp_address[1] ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-lg-2 col-form-label">District</label>
                                    <div class="col-12 col-lg-9 pt-lg-2">
                                        <?= $temp_address[2] ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-lg-2 col-form-label">City</label>
                                    <div class="col-12 col-lg-9 pt-lg-2">
                                        <?= $temp_address[3] ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-lg-2 col-form-label">Postal Code</label>
                                    <div class="col-12 col-lg-9 pt-lg-2">
                                        <?= $temp_address[5] ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-lg-2 col-form-label">Province</label>
                                    <div class="col-12 col-lg-9 pt-lg-2">
                                        <?= $temp_address[4] ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-lg-2 col-form-label">Country</label>
                                    <div class="col-12 col-lg-9 pt-lg-2">
                                        <?= $temp_address[6] ?>
                                    </div>
                                </div>
                                <!-- <p>Street : <?= $temp_address[0] ?></p>
                                <p>Sub District : <?= $temp_address[1] ?></p>
                                <p>District : <?= $temp_address[2] ?></p>
                                <p>City : <?= $temp_address[3] ?></p>
                                <p>Postal Code : <?= $temp_address[5] ?></p>
                                <p>Province : <?= $temp_address[4] ?></p>
                                <p>Country : <?= $temp_address[6] ?></p> -->
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFour">
                            <h5 class="mb-0">
                                <button class="btn collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    BANK ACCOUNT
                                </button>
                            </h5>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                            <div class="card-body">
                                <?php for ($i = 0; $i < count($bank_account_teacher); $i++) : ?>
                                    <div class="form-group row">
                                        <label class="col-12 col-lg-2 col-form-label">Bank</label>
                                        <div class="col-12 col-lg-9 pt-lg-2">
                                            <?= $bank_account_teacher[$i]['bank_name'] ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-lg-2 col-form-label">Account Name</label>
                                        <div class="col-12 col-lg-9 pt-lg-2">
                                            <?= $bank_account_teacher[$i]['bank_account_name'] ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-lg-2 col-form-label">Account No</label>
                                        <div class="col-12 col-lg-9 pt-lg-2">
                                            <?= $bank_account_teacher[$i]['bank_account_no'] ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-lg-2 col-form-label">IBAN</label>
                                        <div class="col-12 col-lg-9 pt-lg-2">
                                            <?= $bank_account_teacher[$i]['iban'] ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-lg-2 col-form-label">SWIFT</label>
                                        <div class="col-12 col-lg-9 pt-lg-2">
                                            <?= $bank_account_teacher[$i]['swift'] ?>
                                        </div>
                                    </div>
                                    <!-- <p>Bank : <?= $bank_account_teacher[$i]['bank_name'] ?></p>
                                    <p>Account Name : <?= $bank_account_teacher[$i]['bank_account_name'] ?></p>
                                    <p>Account No : <?= $bank_account_teacher[$i]['bank_account_no'] ?></p>
                                    <p>IBAN : <?= $bank_account_teacher[$i]['iban'] ?></p>
                                    <p>SWIFT : <?= $bank_account_teacher[$i]['swift'] ?></p> -->
                                    <hr />
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">PROFILE</h5>
                        <hr />
                        <p>ID : <?= $teacher[0]['id_teacher'] ?></p>
                        <p>Name : <?= $teacher[0]['name_teacher'] ?></p>
                        <p>Email : <?= $teacher[0]['email_teacher'] ?></p>
                        <p>Instrument : <?= $teacher[0]['instrument'] ?></p>
                        <p>Phone No. : <?= $teacher[0]['phone_teacher'] ?></p>
                        <p>Username : <?= $teacher[0]['username'] ?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">ADDRESS</h5>
                        <hr />
                        <?php $temp_address = explode("~", $teacher[0]['address_teacher']) ?>
                        <p>Street : <?= $temp_address[0] ?></p>
                        <p>Sub District : <?= $temp_address[1] ?></p>
                        <p>District : <?= $temp_address[2] ?></p>
                        <p>City : <?= $temp_address[3] ?></p>
                        <p>Postal Code : <?= $temp_address[5] ?></p>
                        <p>Province : <?= $temp_address[4] ?></p>
                        <p>Country : <?= $temp_address[6] ?></p>
                    </div>
                </div>
            </div> -->
        </div>
        <!-- <div class="row pr-lg-3 pl-lg-3 justify-content-center">
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
        </div> -->
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