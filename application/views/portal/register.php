<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?= $title ?></title>

    <meta name="title" property="title" data-react-helmet="true" content="<?= $title ?>">
    <meta data-react-helmet="true" content="<?= $title ?>" name="og:title" property="og:title">
    <meta data-react-helmet="true" content="<?= $description ?>" name="description" property="description">
    <meta data-react-helmet="true" content="<?= $description ?>" name="og:description" property="og:description">

    <meta content="<?= base_url() ?>assets/img/logo-1.png" name="og:image" property="og:image">
    <meta content="Etude" name="og:site_name" property="og:site_name">
    <meta content="website" name="og:type" property="og:type">

    <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url(); ?>assets/img/icon-etude.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url(); ?>assets/img/icon-etude.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url(); ?>assets/img/icon-etude.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>assets/img/icon-etude.png">

    <link rel="stylesheet" href="<?= base_url() ?>assets/css/login.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    <link rel="stylesheet" href="<?= base_url() ?>assets/css/datepicker.css">
</head>

<body>
    <style>
        .avatar {
            border-radius: 50%;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .cover {
            text-align: center;
        }

        .cover-img {
            width: 150px;
            height: 150px;
            display: block;
            margin: 0 auto;
        }

        .hiden {
            display: none;
        }

        .hide {
            display: none;
        }

        .btn-primary {
            background-color: #1B75BB;
            color: white;
        }
    </style>
    <div class="head-regis" style="margin-top:30px">
        <img width="200px" src="<?= base_url() ?>assets/img/logo.png" alt="logo-etude">
        <div class="signup-link">
            Have an account? <a href="<?= site_url() ?>portal">Login now</a>
        </div>
    </div>
    <div class="wrapper" style="width:100%">
        <div class="title-text">
            <div class="title">
                Sign Up
            </div>
        </div>
        <div class="form-container">
            <?php if ($this->session->flashdata('warning') != null) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $this->session->flashdata('warning') ?>
                </div>
            <?php endif; ?>
            <div class="slide-controls">
                <input type="radio" name="slide" id="login" checked>
                <input type="radio" name="slide" id="signup">
                <label for="login" class="slide login">Teacher</label>
                <label for="signup" class="slide signup">Parent/Student's</label>
                <div class="slider-tab"></div>
            </div>
            <div class="form-inner">
                <form id="form-login" enctype="multipart/form-data" action="<?= site_url('portal/C_Portal/addDataRegister'); ?>" method="POST" class="login">
                    <br />
                    <h5 style="font-weight:bold">ETUDE ACCOUNT</h5>
                    <div class="form-group row">
                        <label for="username" class="col-12 col-lg-4 pt-lg-2 col-form-label">Username <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-8">
                            <input type="text" autocomplete="off" minlength="4" maxlength="15" class="form-control regist-form" required name="username" id="username">
                            <small id="check-username" class="form-text">min 4 and max 15 characters</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-12 col-lg-4 pt-lg-2 col-form-label">Password <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-10 col-lg-6">
                            <input type="password" autocomplete="off" minlength="8" maxlength="20" class="form-control regist-form pwd-teacher" required name="password" id="inputPassword">
                            <small class="form-text">min 8 and max 20 characters</small>
                        </div>
                        <div class="col-lg-2 col-2">
                            <button type="button" class="btn btn-default" id="btn-eye-teacher" onclick="openPassTeacher()">
                                <i class="iconEyeTeacher fa fa-eye-slash"></i>
                            </button>
                        </div>
                    </div>
                    <hr />
                    <div class="form-group text-center">
                        <div class="cover-img" id="divImgTeacher">
                            <img src="<?= site_url() ?>assets/img/avatar.png" class="avatar avatartempTeacher rounded-circle img-thumbnail" alt="avatar">
                        </div>
                        <p>Upload your profile picture <span style="color:red;font-weight:bold;">*</span></p>
                    </div>
                    <div class="form-group row">
                        <label for="pict_teacher" class="col-3 col-form-label"></label>
                        <div class="col-6 col-lg-8">
                            <input type="file" id="pict_teacher" name="pict" class="form-control-file center-block file-upload-teacher" style="text-align: center; margin: auto; font-size:12px" accept=".png,.jpg,.jpeg" required>
                            <small id="check-file-photo" class="form-text" style="font-size:9px">png,jpg,jpeg (max size file 2MB)</small>
                        </div>
                    </div>
                    <div class="form-group row pt-3">
                        <label for="name" class="col-12 col-lg-4 pt-lg-2 col-form-label">Name <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-8">
                            <input type="text" autocomplete="off" class="form-control regist-form" required name="name" id="name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tempat_dob_teacher" class="col-12 col-lg-4 pt-lg-2 col-form-label">Place of Birth <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-8">
                            <input type="text" autocomplete="off" class="form-control regist-form" required name="tempat_dob_teacher" id="tempat_dob_teacher">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_dob_teacher" class="col-12 col-lg-4 pt-lg-2 col-form-label">Date of Birth <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-8">
                            <input type="text" autocomplete="off" class="form-control regist-form datepicker" required name="tanggal_dob_teacher" id="tanggal_dob_teacher">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="instrument" class="col-12 col-lg-4 pt-lg-2 col-form-label">Instrument <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-8">
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
                    </div>
                    <div class="form-group row">
                        <label for="credentials" class="col-12 col-lg-4 pt-lg-2 col-form-label">Credentials <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-8">
                            <input type="text" autocomplete="off" class="form-control regist-form" required name="credentials" id="credentials">
                            <small class="form-text">(Tittle : S.Sn, Magister, Dr., Prof)</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-12 col-lg-4 pt-lg-2 col-form-label">Phone No. <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-8">
                            <input type="text" autocomplete="off" class="form-control regist-form" required name="phone" id="phone">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-12 col-lg-4 pt-lg-2 col-form-label">Email <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-8">
                            <input type="email" class="form-control regist-form" required name="email" id="email_teacher">
                            <small id="check-email" class="form-text"></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="linkedin" class="col-12 col-lg-4 pt-lg-2 col-form-label">LinkedIn (Url) <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-8">
                            <input type="linkedin" class="form-control regist-form" required name="linkedin" id="linkedin">
                            <small class="form-text">(www.linkedin.com/in/your-linkedin-account)</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ktp" class="col-12 col-lg-4 pt-lg-2 col-form-label">Identity Card <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-8">
                            <input type="file" class="form-control-file regist-form" required name="ktp" id="ktp" accept=".png,.jpg,.jpeg">
                            <small id="check-file-ktp" class="form-text" style="font-size:9px">png,jpg,jpeg (max size file 2MB)</small>
                        </div>
                    </div>

                    <hr />
                    <h5 style="font-weight:bold">ADDRESS</h5>
                    <div class="form-group form-check">
                        <input type="checkbox" name="status_country" value="1" checked class="form-check-input" id="status_country">
                        <label class="form-check-label" for="status_country">From Indonesia <span style="color:red;font-weight:bold;">*</span></label>
                        <input type="hidden" id="kat" name="kat" value="1">
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-12 col-lg-4 pt-lg-2 col-form-label">Street <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-8">
                            <textarea class="form-control regist-form" rows="4" required name="address" id="address"></textarea>
                            <!-- <input type="text" autocomplete="off" class="form-control regist-form" required name="address" id="address"> -->
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="inputCity">District (Kecamatan) <span style="color:red;font-weight:bold;">*</span></label>
                            <input type="text" autocomplete="off" name="kecamatan" required class="form-control regist-form">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="inputCity">Sub District (Kelurahan) <span style="color:red;font-weight:bold;">*</span></label>
                            <input type="text" autocomplete="off" name="kelurahan" required class="form-control regist-form">
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="inputCity">City <span style="color:red;font-weight:bold;">*</span></label>
                            <input type="text" autocomplete="off" name="kota" required class="form-control regist-form">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="inputCity">Province <span style="color:red;font-weight:bold;">*</span></label>
                            <input type="text" autocomplete="off" name="provinsi" required class="form-control regist-form">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="inputZip">Postal Code <span style="color:red;font-weight:bold;">*</span></label>
                            <input type="text" autocomplete="off" name="zip" required class="form-control regist-form">
                        </div>
                        <div id="check_country" class="form-group col-lg-6 hiden">
                            <label for="inputCity">Country <span style="color:red;font-weight:bold;">*</span></label>
                            <input id="negara" type="text" autocomplete="off" name="negara" value="Indonesia" required class="form-control regist-form">
                        </div>
                    </div>
                    <hr />
                    <h5 style="font-weight:bold">BANK ACCOUNT</h5>
                    <div class="form-group row">
                        <label for="bank" class="col-12 col-lg-5 pt-lg-2 col-form-label">Bank <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-7">
                            <input type="text" autocomplete="off" class="form-control regist-form" required name="bank1" id="bank1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name_rek_teacher" class="col-12 col-lg-5 pt-lg-2 col-form-label">Account Name <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-7">
                            <input type="text" autocomplete="off" class="form-control regist-form" required name="name_rek_teacher1" id="name_rek_teacher1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="norek" class="col-12 col-lg-5 pt-lg-2 col-form-label">Account No. <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-7">
                            <input type="text" autocomplete="off" class="form-control regist-form" required name="norek1" id="norek1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="iban_rek_teacher" class="col-12 col-lg-5 pt-lg-2 col-form-label">IBAN</label>
                        <div class="col-12 col-lg-7">
                            <input type="text" autocomplete="off" class="form-control regist-form" name="iban_rek_teacher1" id="iban_rek_teacher1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="swift_rek_teacher" class="col-12 col-lg-5 pt-lg-2 col-form-label">SWIFT</label>
                        <div class="col-12 col-lg-7">
                            <input type="text" autocomplete="off" class="form-control regist-form" name="swift_rek_teacher1" id="swift_rek_teacher1">
                        </div>
                    </div>
                    <input type="hidden" value="1" name="total_bank_account" id="total_bank_account">
                    <div id="new_bank_account">

                    </div>
                    <div class="form-group row">
                        <div class="btn-group col-lg-4">
                            <button type="button" class="add_bank_account btn btn-primary btn-sm mr-2"><i class="fa fa-plus"></i></button>
                            <button type="button" class="remove_bank_account btn btn-primary btn-sm"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>
                    <hr>

                    <div class="form-group row">
                        <div class="col-12 col-lg-12">
                            <button id="submit" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
                <form id="form-signup" enctype="multipart/form-data" action="<?= site_url('portal/C_Admin/add_data_student2'); ?>" method="POST" class="signup hiden">
                    <input type="hidden" class="form-control regist-form" required value="register_signup" name="from_form" id="from_form">
                    <br />
                    <h5 style="font-weight:bold">ETUDE ACCOUNT</h5>
                    <div class="form-group row">
                        <label for="username_parent" class="col-12 col-lg-4 pt-lg-2 col-form-label">Username <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-8">
                            <input type="text" minlength="4" maxlength="15" class="form-control regist-form" autocomplete="off" required name="username_parent" id="username_parent">
                            <small id="check-username-parent" class="form-text">min 4 and max 15 characters</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword_parent" class="col-12 col-lg-4 pt-lg-2 col-form-label">Password <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-10 col-lg-6">
                            <input type="password" minlength="8" maxlength="20" class="form-control regist-form pwd-parent" autocomplete="off" required name="password_parent" id="inputPassword_parent">
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
                        <label for="parent_student" class="col-12 col-lg-4 pt-lg-2 col-form-label">Name <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" autocomplete="off" required name="parent_student" id="parent_student">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status_parent_1" class="col-12 col-lg-4 col-form-label">Status <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-8">
                            <select class="form-control regist-form" style="width:100%;" name="status_parent_1" id="status_parent_1" required>
                                <option value="">--- Choose Status ---</option>
                                <option value="Dad">Dad</option>
                                <option value="Mom">Mom</option>
                                <option value="Caregiver">Caregiver</option>
                                <option value="Relatives">Relatives</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email_parent_1" class="col-12 col-lg-4 pt-lg-2 col-form-label">Email <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-8">
                            <input type="email" class="form-control regist-form" autocomplete="off" required name="email_parent_1" id="email_parent_1">
                            <small id="check-email-parent" class="form-text"></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ig_parent_1" class="col-12 col-lg-4 pt-lg-2 col-form-label">Instagram <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" autocomplete="off" required name="ig_parent_1" id="ig_parent_1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone_parent_1" class="col-12 col-lg-4 pt-lg-2 col-form-label">Phone No. <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" autocomplete="off" required name="phone_parent_1" id="phone_parent_1">
                        </div>
                    </div>
                    <h5 style="font-weight:bold">Person in Charge (Parents) Alternatives</h5>
                    <div class="form-group row">
                        <label for="parent_student_2" class="col-12 col-lg-4 col-form-label">Name</label>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" autocomplete="off" name="parent_student_2" id="parent_student_2">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status_parent_2" class="col-12 col-lg-4 col-form-label">Status</label>
                        <div class="col-12 col-lg-8">
                            <select class="form-control regist-form" style="width:100%;" name="status_parent_2" id="status_parent_2">
                                <option value="">--- Choose Status ---</option>
                                <option value="Dad">Dad</option>
                                <option value="Mom">Mom</option>
                                <option value="Caregiver">Caregiver</option>
                                <option value="Relatives">Relatives</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone_parent_2" class="col-12 col-lg-4 col-form-label">Phone No.</label>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" autocomplete="off" name="phone_parent_2" id="phone_parent_2">
                        </div>
                    </div>
                    <hr>
                    <h5 style="font-weight:bold">Address <span style="color:red;font-weight:bold;">*</span></h5>
                    <div class="form-group">
                        <label for="address_parent"></label>
                        <textarea class="form-control regist-form" rows="4" autocomplete="off" required name="address_parent" id="address_parent"></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="kelurahan_parent">Sub district (Kelurahan) <span style="color:red;font-weight:bold;">*</span></label>
                            <input type="text" id="kelurahan_parent" name="kelurahan_parent" required autocomplete="off" class="form-control regist-form">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="kecamatan_parent">District (Kecamatan) <span style="color:red;font-weight:bold;">*</span></label>
                            <input type="text" name="kecamatan_parent" id="kecamatan_parent" required autocomplete="off" class="form-control regist-form">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="kota_parent">City <span style="color:red;font-weight:bold;">*</span></label>
                            <input type="text" name="kota_parent" id="kota_parent" required autocomplete="off" class="form-control regist-form">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="provinsi_parent">Province <span style="color:red;font-weight:bold;">*</span></label>
                            <input type="text" name="provinsi_parent" id="provinsi_parent" required autocomplete="off" class="form-control regist-form">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="zip_parent">Postal Code <span style="color:red;font-weight:bold;">*</span></label>
                            <input type="text" name="zip_parent" id="zip_parent" required autocomplete="off" class="form-control regist-form">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="country_parent">Country <span style="color:red;font-weight:bold;">*</span></label>
                            <input type="text" name="country_parent" id="country_parent" required autocomplete="off" class="form-control regist-form">
                        </div>
                    </div>
                    <hr />
                    <h5 style="font-weight:bold">Student's Information</h5>
                    <div class="form-group text-center">
                        <div class="cover-img" id="divImg_student">
                            <img src="<?= site_url() ?>assets/img/avatar.png" class="avatar avatartemp rounded-circle img-thumbnail" alt="avatar">
                        </div>
                        <p>Upload Student's picture <span style="color:red;font-weight:bold;">*</span></p>
                    </div>
                    <div class="form-group row">
                        <label for="pict_student1" class="col-3 col-form-label"></label>
                        <div class="col-6 col-lg-8">
                            <input type="hidden" value="tidak" name="ubah-pict1" class="ubah-pict1" id="ubah-pict1">
                            <input type="file" id="pict_student1" name="pict_student1" class="form-control-file center-block file-upload" style="text-align: center; margin: auto; font-size:12px" accept=".png,.jpg,.jpeg">
                            <small id="check-file-photo-parent" class="form-text" style="font-size:9px">png,jpg,jpeg (max size file 2MB)</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name_student">Student's Full Name <span style="color:red;font-weight:bold;">*</span></label>
                        <input type="text" class="form-control" id="name_student" required autocomplete="off" name="name_student1">
                    </div>
                    <div class="form-group">
                        <label for="nickname_student">Student's Nick Name <span style="color:red;font-weight:bold;">*</span></label>
                        <input type="text" class="form-control" id="nickname_student" required autocomplete="off" name="nickname_student1">
                    </div>
                    <div class="form-group">
                        <label for="gender_student">Student's Gender <span style="color:red;font-weight:bold;">*</span></label>
                        <select class="form-control select-form" style="width:100%;" id="gender_student1" name="gender_student1" required autocomplete="off">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tempat_dob">Student's Place of Birth <span style="color:red;font-weight:bold;">*</span></label>
                        <input type="text" class="form-control" id="tempat_dob" required autocomplete="off" name="tempat_dob1">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_dob">Student's Date of Birth <span style="color:red;font-weight:bold;">*</span></label>
                        <input type="text" class="form-control datepicker" id="tanggal_dob" required autocomplete="off" name="tanggal_dob1">
                    </div>

                    <input type="hidden" value="1" name="total_student" id="total_student">

                    <div id="new_student">

                    </div>
                    <hr>
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
                        <div class="btn-group col-lg-4">
                            <button type="button" class="add btn btn-primary btn-sm mr-2"><i class="fa fa-plus"></i></button>
                            <button type="button" class="remove btn btn-primary btn-sm"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12 col-lg-12">
                            <button id="submit-parent" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="<?= base_url('assets/js/popper.js'); ?>" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/jquery-3.4.0.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap-datepicker.js') ?>"></script>
    <!-- Optional JavaScript -->
    <script>
        function instrumentFunc(e) {
            var temp_val = e.target.value;
            console.log(temp_val);
            if (temp_val === 'Others') {
                var new_input = `<input type="text" class="form-control" placeholder="input other instrument" id="others" required name="others">`;
                $('#inputOthers').append(new_input);
            } else {
                $('#others').remove();
            }
        }

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

        function openPassTeacher() {
            $('.iconEyeTeacher').removeClass('fa-eye-slash');
            $('.iconEyeTeacher').addClass('fa-eye');
            $(".pwd-teacher").replaceWith($('.pwd-teacher').clone().attr('type', 'text'));
            $('#btn-eye-teacher').removeAttr("onclick");
            $('#btn-eye-teacher').attr("onclick", 'closePassTeacher()');
        }

        function closePassTeacher() {
            $('.iconEyeTeacher').removeClass('fa-eye');
            $('.iconEyeTeacher').addClass('fa-eye-slash');
            $(".pwd-teacher").replaceWith($('.pwd-teacher').clone().attr('type', 'password'));
            $('#btn-eye-teacher').removeAttr("onclick");
            $('#btn-eye-teacher').attr("onclick", 'openPassTeacher()');
        }

        var email_parent_1 = document.getElementById('email_parent_1');
        email_parent_1.addEventListener('keyup', function(e) {
            let val = e.target.value;
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
        })

        var email_teacher = document.getElementById('email_teacher');
        email_teacher.addEventListener('keyup', function(e) {
            let val = e.target.value;
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
        })
        var username = document.getElementById('username');
        username.addEventListener('keyup', function(e) {
            let val = e.target.value;
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
        })
        var username_parent = document.getElementById('username_parent');
        username_parent.addEventListener('keyup', function(e) {
            let val = e.target.value;
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
        })
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
    <script>
        $("#status_country").on('click', function() {
            var value = $(this).val();
            if (value == 0) {
                document.getElementById("status_country").value = "1";
                document.getElementById("check_country").classList.add("hiden");
                document.getElementById("negara").value = "Indonesia";
                document.getElementById("kat").value = "1";
            } else {
                document.getElementById("check_country").classList.remove("hiden");
                document.getElementById("negara").value = " ";
                document.getElementById("kat").value = "2";
                document.getElementById("status_country").value = "0";
            }

        });
        $(function() {
            $(".datepicker").datepicker({
                weekStart: 1,
                format: 'dd MM yyyy',
                autoclose: true,
                todayHighlight: true,
            });
        });
        $(document).ready(function() {
            $(".next").html('<i class="fa fa-arrow-right"></i>');
            $(".prev").html('<i class="fa fa-arrow-left"></i>');

            var uploadKtpTeacher = document.getElementById("ktp");
            uploadKtpTeacher.onchange = function() {
                let cekTipe = this.files[0].type.split("/");
                if (this.files[0].size > 2097152) {
                    $("#check-file-ktp").html("<span style='color:red; font-weight:bold'>Size more than 2MB</span>");
                    this.value = "";
                } else {
                    if (cekTipe[1] !== "jpeg" && cekTipe[1] !== "png" && cekTipe[1] !== "jpg") {
                        $("#check-file-ktp").html("<span style='color:red; font-weight:bold'>Filetype not allowed</span>");
                        this.value = "";
                    } else {
                        $("#check-file-ktp").html("");
                    }
                }
            };

            var uploadFieldFotoTeacher = document.getElementById("pict_teacher");
            uploadFieldFotoTeacher.onchange = function() {
                let cekTipe = this.files[0].type.split("/");
                if (this.files[0].size > 2097152) {
                    $("#divImgTeacher").html("");
                    $("#divImgTeacher").html(`<img src="<?= site_url() ?>assets/img/avatar.png" class="avatar avatartempTeacher rounded-circle img-thumbnail" alt="avatar">`);
                    $("#check-file-photo").html("<span style='color:red; font-weight:bold'>Size more than 2MB</span>");
                    this.value = "";
                } else {
                    if (cekTipe[1] !== "jpeg" && cekTipe[1] !== "png" && cekTipe[1] !== "jpg") {
                        $("#divImgTeacher").html("");
                        $("#divImgTeacher").html(`<img src="<?= site_url() ?>assets/img/avatar.png" class="avatar avatartempTeacher rounded-circle img-thumbnail" alt="avatar">`);
                        $("#check-file-photo").html("<span style='color:red; font-weight:bold'>Filetype not allowed</span>");
                        this.value = "";
                    } else {
                        $("#check-file-photo").html("");
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('.avatartempTeacher').attr('src', e.target.result);
                        }
                        reader.readAsDataURL(this.files[0]);
                    }
                }
            };
            // var readURLTeacher = function(input) {
            //     if (input.files && input.files[0]) {
            //         var reader = new FileReader();
            //         reader.onload = function(e) {
            //             $('.avatartempTeacher').attr('src', e.target.result);
            //         }
            //         reader.readAsDataURL(input.files[0]);
            //     }
            // }

            // $(".file-upload-teacher").on('change', function() {
            //     let cekTipe = this.files[0].type.split("/");
            //     if (this.files[0].size > (1000 * 2000)) {
            //         $("#divImgTeacher").html("");
            //         $("#divImgTeacher").html(`<img src="<?= site_url() ?>assets/img/avatar.png" class="avatar avatartempTeacher rounded-circle img-thumbnail" alt="avatar">`);
            //         $("#check-file-photo").html("<span style='color:red; font-weight:bold'>Size more than 2MB</span>");
            //         $('#submit').prop('disabled', true);
            //         $('#pict_teacher').val("");
            //     } else {
            //         if (cekTipe[0] !== "image") {
            //             $("#divImgTeacher").html("");
            //             $("#divImgTeacher").html(`<img src="<?= site_url() ?>assets/img/avatarNotAllowed.jpg" class="avatar avatartempTeacher rounded-circle img-thumbnail" alt="avatar">`);
            //             $("#check-file-photo").html("<span style='color:red; font-weight:bold'>Filetype not allowed</span>");
            //             $('#submit').prop('disabled', true);
            //             $('#pict_teacher').val("");
            //         } else {
            //             $("#check-file-photo").html("");
            //             $('#submit').prop('disabled', false);
            //             readURLTeacher(this);
            //         }
            //     }
            // });

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
                    <p>Student's ` + new_student_no + `</p>
                    <div class="form-group text-center">
                        <div class="cover-img" id="divImg_student` + new_student_no + `">
                            <img src="<?= site_url() ?>assets/img/avatar.png" class="avatar avatartemp` + new_student_no + ` rounded-circle img-thumbnail" alt="avatar">
                        </div>
                        <p>Upload Student's picture</p>
                    </div>
                    <div class="form-group row">
                        <label for="pict_student` + new_student_no + `" class="col-3 col-form-label"></label>
                        <div class="col-6 col-lg-8">
                            <input type="hidden" value="tidak" name="ubah-pict` + new_student_no + `" class="ubah-pict` + new_student_no + `" id="ubah-pict` + new_student_no + `">
                            <input type="file" id="pict_student` + new_student_no + `"  name="pict_student` + new_student_no + `" class="form-control-file center-block file-upload` + new_student_no + `" style="text-align: center; margin: auto; font-size:12px" accept=".png,.jpg,.jpeg">
                            <small id="check-file-photo-parent` + new_student_no + `" class="form-text" style="font-size:9px">png,jpg,jpeg (max size file 2MB)</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name_student">Student's Full Name <span style="color:red;font-weight:bold;">*</span></label>
                        <input type="text" class="form-control" id="name_student" required autocomplete="off" name="name_student` + new_student_no + `">
                    </div>
                    <div class="form-group">
                        <label for="nickname_student">Student's Nick Name <span style="color:red;font-weight:bold;">*</span></label>
                        <input type="text" class="form-control" id="nickname_student" required autocomplete="off" name="nickname_student` + new_student_no + `">
                    </div>
                    <div class="form-group">
                        <label for="gender_student">Student's Gender <span style="color:red;font-weight:bold;">*</span></label>
                        <select class="form-control select-form" style="width:100%;" id="gender_student` + new_student_no + `" name="gender_student` + new_student_no + `" required>
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

            $('.add_bank_account').on('click', add_bank_account);
            $('.remove_bank_account').on('click', remove_bank_account);

            function add_bank_account() {
                var new_bank_account_no = parseInt($('#total_bank_account').val()) + 1;
                var new_input = `<div id='new_bank_account_` + new_bank_account_no + `'>
                    <hr/>
                    <p>Bank's ` + new_bank_account_no + `</p>
                    <div class="form-group row">
                        <label for="bank" class="col-12 col-lg-5 pt-lg-2 col-form-label">Bank <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-7">
                            <input type="text" autocomplete="off" class="form-control regist-form" required name="bank` + new_bank_account_no + `" id="bank` + new_bank_account_no + `">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name_rek_teacher` + new_bank_account_no + `" class="col-12 col-lg-5 pt-lg-2 col-form-label">Account Name <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-7">
                            <input type="text" autocomplete="off" class="form-control regist-form" required name="name_rek_teacher` + new_bank_account_no + `" id="name_rek_teacher` + new_bank_account_no + `">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="norek` + new_bank_account_no + `" class="col-12 col-lg-5 pt-lg-2 col-form-label">Account No. <span style="color:red;font-weight:bold;">*</span></label>
                        <div class="col-12 col-lg-7">
                            <input type="text" autocomplete="off" class="form-control regist-form" required name="norek` + new_bank_account_no + `" id="norek` + new_bank_account_no + `">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="iban_rek_teacher` + new_bank_account_no + `" class="col-12 col-lg-5 pt-lg-2 col-form-label">IBAN</label>
                        <div class="col-12 col-lg-7">
                            <input type="text" autocomplete="off" class="form-control regist-form" name="iban_rek_teacher` + new_bank_account_no + `" id="iban_rek_teacher` + new_bank_account_no + `">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="swift_rek_teacher` + new_bank_account_no + `" class="col-12 col-lg-5 pt-lg-2 col-form-label">SWIFT</label>
                        <div class="col-12 col-lg-7">
                            <input type="text" autocomplete="off" class="form-control regist-form" name="swift_rek_teacher` + new_bank_account_no + `" id="swift_rek_teacher` + new_bank_account_no + `">
                        </div>
                    </div>
                </div>`;
                $('#new_bank_account').append(new_input);
                $('#total_bank_account').val(new_bank_account_no);
            }

            function remove_bank_account() {
                var last_bank_account_no = $('#total_bank_account').val();
                if (last_bank_account_no > 1) {
                    $('#new_bank_account_' + last_bank_account_no).remove();
                    $('#total_bank_account').val(last_bank_account_no - 1);
                }
            }
        });
    </script>
    <script>
        const loginForm = document.querySelector("form.login");
        const loginBtn = document.querySelector("label.login");
        const signupBtn = document.querySelector("label.signup");
        const signUpForm = document.querySelector("form.signup");

        var formLogin = document.getElementById("form-login");
        var formSignup = document.getElementById("form-signup");

        signupBtn.onclick = (() => {
            loginForm.style.marginLeft = "-50%";
            formLogin.classList.add("hiden");
            formSignup.classList.remove("hiden");
            $("#username").val("");
            $("#check-username").html("min 4 and max 15 characters");
            $('#submit').prop('disabled', false);
        });
        loginBtn.onclick = (() => {
            loginForm.style.marginLeft = "0%";
            formLogin.classList.remove("hiden");
            formSignup.classList.add("hiden");
            $("#username_parent").val("");
            $("#check-username-parent").html("min 4 and max 15 characters");
            $('#submit-parent').prop('disabled', false);
        });
    </script>
</body>

</html>