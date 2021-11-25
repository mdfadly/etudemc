<main class="page-content">
    <div class="container-fluid">
        <h2>Edit Data Student</h2>
        <hr>
        <div class="row">
            <?php if ($this->session->flashdata('warning') != null) : ?>
                <div class="col-lg-12">
                    <div class="alert alert-danger" role="alert">
                        <?= $this->session->flashdata('warning') ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-lg-12">
                <a href="<?= site_url() ?>portal/data_student/detail/<?= $student[0]['id_parent'] ?>" class="btn btn-primary">
                    <i class="fa fa-angle-left"></i> Back
                </a>
            </div>
            <div class="col-lg-12 col-12 mt-4">
                <form action="<?= site_url('portal/C_Admin/edit_data_student') ?>" method="POST">
                    <input type="hidden" class="form-control" id="id_parent" required value="<?= $student[0]['id_student'] ?>" name="id_student">
                    <input type="hidden" class="form-control" id="id_parent" required value="<?= $student[0]['id_parent'] ?>" name="id_parent">
                    <div class="form-group">
                        <label for="parent_student">Parent Name</label>
                        <input type="text" class="form-control" id="parent_student" required value="<?= $student[0]['parent_student'] ?>" name="parent_student">
                    </div>
                    <div class="form-group">
                        <label for="name_student">Student Name</label>
                        <input type="text" class="form-control" id="name_student" required value="<?= $student[0]['name_student'] ?>" name="name_student">
                    </div>
                    <div class="form-group">
                        <label for="instrument">Instrument</label>
                        <input type="text" class="form-control" id="instrument" required value="<?= $student[0]['instrument'] ?>" name="instrument">
                    </div>
                    <div class="form-group">
                        <label for="dob_student">DOB</label>
                        <input type="text" class="form-control" id="dob_student" required value="<?= $student[0]['dob_student'] ?>" name="dob_student">
                        <small id="emailHelp" class="form-text text-muted">(Ex: Jakarta, 20 Maret 1990)</small>
                    </div>
                    <div class="form-group">
                        <label for="school_student">School</label>
                        <input type="text" class="form-control" id="school_student" required value="<?= $student[0]['school_student'] ?>" name="school_student">
                    </div>
                    <div class="form-group">
                        <label for="address_student">Address</label>
                        <textarea class="form-control regist-form" rows="4" required name="address_student" id="address_student"><?= $student[0]['address_student'] ?></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="inputCity">Sub District</label>
                            <input type="text" name="kelurahan" required value="<?= $student[0]['kelurahan'] ?>" class="form-control regist-form">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="inputCity">District</label>
                            <input type="text" name="kecamatan" required value="<?= $student[0]['kecamatan'] ?>" class="form-control regist-form">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="inputCity">City</label>
                            <input type="text" name="kota" required value="<?= $student[0]['kota'] ?>" class="form-control regist-form">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="inputCity">Province</label>
                            <input type="text" name="provinsi" required value="<?= $student[0]['provinsi'] ?>" class="form-control regist-form">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="inputZip">Postal Code</label>
                            <input type="text" name="zip" required value="<?= $student[0]['zip'] ?>" class="form-control regist-form">
                        </div>
                        <div id="check_country" class="form-group col-lg-6">
                            <label for="inputCity">Country</label>
                            <input id="country" type="text" name="country" value="<?= $student[0]['country'] ?>" required class="form-control regist-form">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone_student_1">Phone 1</label>
                        <input type="text" class="form-control" id="phone_student_1" required value="<?= $student[0]['phone_student_1'] ?>" name="phone_student_1">
                    </div>
                    <div class="form-group">
                        <label for="phone_student_2">Phone 2</label>
                        <input type="text" class="form-control" id="phone_student_2" value="<?= $student[0]['phone_student_2'] ?>" name="phone_student_2">
                        <small id="emailHelp" class="form-text text-muted">If more than one</small>
                    </div>

                    <div class="form-group">
                        <label for="">Select currency:</label>
                        <select class="form-control" style="width:100%;" name="currency" id="currency">
                            <?php if ($student[0]['currency'] == 1) : ?>
                                <option value="1">Rupiah</option>
                                <option value="2">Dollar</option>
                                <option value="3">Euro</option>
                            <?php elseif ($student[0]['currency'] == 2) : ?>
                                <option value="2">Dollar</option>
                                <option value="1">Rupiah</option>
                                <option value="3">Euro</option>
                            <?php else : ?>
                                <option value="3">Euro</option>
                                <option value="1">Rupiah</option>
                                <option value="2">Dollar</option>
                            <?php endif; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</main>
<script src="<?= base_url('assets/js/jquery-3.4.0.min.js'); ?>"></script>
<script>
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
        if (<?= $student[0]['kat'] ?> === 1) {
            document.getElementById("status_country").checked = true;
            document.getElementById("status_country").value = "1";
        } else {
            document.getElementById("status_country").checked = false;
            document.getElementById("status_country").value = "0";
        }
    });
</script>