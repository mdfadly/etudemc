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
        <h2 style="font-weight: bold">Edit Data Student</h2>
        <!--<hr>-->
        <div class="row">
            <?php if ($this->session->flashdata('warning') != null) : ?>
                <div class="col-lg-12">
                    <div class="alert alert-danger" role="alert">
                        <?= $this->session->flashdata('warning') ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-lg-12">

            </div>

            <div class="col-lg-12 col-12 mt-4">
                <form action="<?= site_url('portal/C_Admin/edit_data_student2') ?>" method="POST">
                    <input type="hidden" class="form-control" id="id_parent" required value="<?= $student[0]['id_student'] ?>" name="id_student">
                    <input type="hidden" class="form-control" id="id_parent" required value="<?= $student[0]['id_parent'] ?>" name="id_parent">
                    <h5>STUDENT</h5>
                    <div class="form-group">
                        <label for="name_student">Full Name</label>
                        <input type="text" class="form-control" id="name_student" required name="name_student" value="<?= $student[0]['name_student'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="nickname_student">Nick Name</label>
                        <input type="text" class="form-control" id="nickname_student" required name="nickname_student" value="<?= $student[0]['nickname_student'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="dob_student">Place - DOB</label>
                        <input type="text" class="form-control" id="dob_student" required name="dob_student" value="<?= $student[0]['dob_student'] ?>">
                        <small id="emailHelp" class="form-text text-muted">(Ex: Jakarta - 20 Maret 1990)</small>
                    </div>
                    <div class="form-group">
                        <label for="school_student">School</label>
                        <input type="text" class="form-control" id="school_student" required name="school_student" value="<?= $student[0]['school_student'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="phone_student">Phone Number/WA</label>
                        <input type="text" class="form-control" id="phone_student" required name="phone_student" value="<?= $student[0]['phone_student'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="email_student">Email</label>
                        <input type="text" class="form-control" id="email_student" required name="email_student" value="<?= $student[0]['email_student'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="ig_student">Instagram</label>
                        <input type="text" class="form-control" id="ig_student" required name="ig_student" value="<?= $student[0]['ig_student'] ?>">
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

                    <!-- <div id="new_student">

                    </div> -->
                    <!-- <input type="hidden" value="1" name="total_student" id="total_student">
                    <div class="pt-2">
                        <button type="button" class="add btn btn-primary">Add</button>
                        <button type="button" class="remove btn btn-primary">remove</button>
                    </div> -->
                    <hr>
                    <h5>PERSON IN CHARGE (1)</h5>
                    <!-- <div class="form-group form-check">
                        <input type="checkbox" name="status_parent_check" value="1" checked class="form-check-input" id="status_parent_check">
                        <label class="form-check-label" for="status_parent_check">Add new parent</label>
                        <input type="hidden" id="cek_pack" value="1">
                    </div> -->
                    <!-- <div id="pack_old_parent" class="hiden">
                        <div class="form-group">
                            <label for="parent_student">Name</label><br>
                            <?php $id_parent = [];
                            $parent_student = []; ?>
                            <?php foreach ($student as $s) : ?>
                                <?php $id_parent[] = $s['id_parent'] . "<" . $s['parent_student'] . "<" . $s['parent_student_2'] . "<" . $s['status_parent_1'] . "<" . $s['status_parent_2'] . "<" . $s['phone_parent_1'] . "<" . $s['phone_parent_2'] . "<" . $s['email_parent_1'] . "<" . $s['email_parent_2'] . "<" . $s['ig_parent_1'] . "<" . $s['ig_parent_2'] . "<" . $s['address_student'] . "<" . $s['kelurahan'] . "<" . $s['kecamatan'] . "<" . $s['kota'] . "<" . $s['provinsi'] . "<" . $s['zip'] . "<" . $s['country'] . "<" . $s['currency'] ?>
                            <?php endforeach; ?>
                            <?php $id_parent = array_unique($id_parent); ?>
                            <?php sort($id_parent) ?>
                            <select class="form-control select-form" onchange="myFunction(event)" style=" width:100%;">
                                <option>Choose Parent</option>
                                <?php for ($i = 0; $i < count($id_parent); $i++) : ?>
                                    <?php $id_parent_ex[$i] = explode("<", $id_parent[$i]) ?>
                                    <option value="<?= $id_parent[$i] ?>">
                                        <?= $id_parent_ex[$i][1] ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_parent">ID</label>
                            <input type="text" readonly class="form-control" id="id_parent" required name="id_parent">
                        </div>
                    </div> -->

                    <div id="pack_new_parent" class="">
                        <div class="form-group">
                            <label for="parent_student">Name</label>
                            <input type="text" class="form-control" id="parent_student" required name="parent_student" value="<?= $student[0]['parent_student'] ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status_parent_1">Status</label>
                        <input type="text" class="form-control" id="status_parent_1" required name="status_parent_1" value="<?= $student[0]['status_parent_1'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="phone_parent_1">Phone Number/WA</label>
                        <input type="number" class="form-control" id="phone_parent_1" required name="phone_parent_1" value="<?= $student[0]['phone_parent_1'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="email_parent_1">Email</label>
                        <input type="text" class="form-control" id="email_parent_1" required name="email_parent_1" value="<?= $student[0]['email_parent_1'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="ig_parent_1">Instagram</label>
                        <input type="text" class="form-control" id="ig_parent_1" required name="ig_parent_1" value="<?= $student[0]['ig_parent_1'] ?>">
                    </div>
                    <h5>PERSON IN CHARGE (2)</h5>
                    <div id="pack_new_parent" class="">
                        <div class="form-group">
                            <label for="parent_student_2">Name</label>
                            <input type="text" class="form-control" id="parent_student_2" name="parent_student_2" value="<?= $student[0]['parent_student_2'] ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status_parent_2">Status</label>
                        <input type="text" class="form-control" id="status_parent_2" name="status_parent_2" value="<?= $student[0]['status_parent_2'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="phone_parent_2">Phone Number/WA</label>
                        <input type="number" class="form-control" id="phone_parent_2" name="phone_parent_2" value="<?= $student[0]['phone_parent_2'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="email_parent_2">Email</label>
                        <input type="text" class="form-control" id="email_parent_2" name="email_parent_2" value="<?= $student[0]['email_parent_2'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="ig_parent_2">Instagram</label>
                        <input type="text" class="form-control" id="ig_parent_2" name="ig_parent_2" value="<?= $student[0]['ig_parent_2'] ?>">
                    </div>
                    <hr>
                    <h5>Address Parent</h5>
                    <div class="form-group form-check">
                        <input type="checkbox" name="check_address" value="0" class="form-check-input" id="check_address">
                        <label class="form-check-label" for="check_address">The address same as student</label>
                    </div>
                    <div id="address_parent_same" class="">
                        <div class="form-group">
                            <label for="address_parent">Street</label>
                            <textarea class="form-control regist-form" rows="4" name="address_parent" id="address_parent"><?= $student[0]['address_parent'] ?></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="inputCity">Sub District</label>
                                <input type="text" name="kelurahan_parent" value="<?= $student[0]['kelurahan_parent'] ?>" class="form-control regist-form">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="inputCity">District</label>
                                <input type="text" name="kecamatan_parent" value="<?= $student[0]['kecamatan_parent'] ?>" class="form-control regist-form">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="inputCity">City</label>
                                <input type="text" name="kota_parent" value="<?= $student[0]['kota_parent'] ?>" class="form-control regist-form">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="inputCity">Province</label>
                                <input type="text" name="provinsi_parent" value="<?= $student[0]['provinsi_parent'] ?>" class="form-control regist-form">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="inputZip">Postal Code</label>
                                <input type="text" name="zip_parent" value="<?= $student[0]['zip_parent'] ?>" class="form-control regist-form">
                            </div>
                            <div id="check_country" class="form-group col-lg-6">
                                <label for="inputCity">Country</label>
                                <input id="country" type="text" name="country_parent" value="<?= $student[0]['country_parent'] ?>" class="form-control regist-form">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Select currency:</label>
                        <select class="form-control" style="width:100%;" name="currency" id="currency">
                            <option value="1">Rupiah</option>
                            <option value="2">Dollar</option>
                            <option value="3">Euro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="teacher_percentage">Teacher Fee Percentage</label>
                        <input type="text" name="teacher_percentage" id="teacher_percentage" class="form-control regist-form" value="<?= $student[0]['teacher_percentage'] ?>">
                    </div>
                    <hr>
                    <h5>MUSIC LESSON</h5>
                    <div class="form-group">
                        <label for="instrument">Instrument</label>
                        <!-- <input type="text" class="form-control" id="instrument" required name="instrument"> -->
                        <select class="form-control" style="width:100%;" name="instrument" id="instrument" onchange="instrumentFunc(event)">
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
                        <label for="paket">Package</label>
                        <select class="form-control" style="width:100%;" name="paket" id="paket">
                            <?php foreach ($paket as $t) : ?>
                                <option value="<?= $t['name'] ?>"><?= $t['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>
    </div>
</main>
<script src="<?= base_url('assets/js/jquery-3.4.0.min.js'); ?>"></script>
<script>
    $(document).ready(function() {
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
        document.getElementById("paket").value = '<?= $student[0]['paket'] ?>';
        $('.select-form').select2();
        $('.add').on('click', add);
        $('.remove').on('click', remove);

        function add() {
            var new_student_no = parseInt($('#total_student').val()) + 1;
            var new_input = `<div id='new_` + new_student_no + `'>
                <p>Student ` + new_student_no + `</p>
                <div class='form-group'>
                    <label for='name_student'>Full Name</label>
                    <input type='text' class='form-control' required name='name_student` + new_student_no + `'>
                </div>
                <div class='form-group'>
                    <label for='nickname_student'>Nick Name</label>
                    <input type='text' class='form-control' required name='nickname_student` + new_student_no + `'>
                </div>
                <div class='form-group'>
                    <label for='dob_student'>DOB</label>
                    <input type='text' class='form-control' required name='dob_student` + new_student_no + `'>
                </div>
                <div class='form-group'>
                    <label for='school_student'>School</label>
                    <input type='text' class='form-control' required name='school_student` + new_student_no + `'>
                </div>
                <div class='form-group'>
                    <label for='phone_student'>Phone No</label>
                    <input type='text' class='form-control' required name='phone_student` + new_student_no + `'>
                </div>
            </div>`;

            $('#new_student').append(new_input);
            $('#total_student').val(new_student_no);
        }

        function remove() {
            var last_student_no = $('#total_student').val();

            if (last_student_no > 1) {
                $('#new_' + last_student_no).remove();
                $('#total_student').val(last_student_no - 1);
            }
        }

        $("#status_parent_check").on('click', function() {
            var value = $(this).val();
            if (value == 0) {
                document.getElementById("status_parent_check").value = "1";
                document.getElementById("pack_new_parent").classList.remove("hiden");
                document.getElementById("pack_old_parent").classList.add("hiden");
                document.getElementById("id_parent").value = "";
                document.getElementById("parent_student_2").value = "";
                document.getElementById("status_parent_1").value = "";
                document.getElementById("status_parent_2").value = "";
                document.getElementById("phone_parent_1").value = "";
                document.getElementById("phone_parent_2").value = "";
                document.getElementById("email_parent_1").value = "";
                document.getElementById("email_parent_2").value = "";
                document.getElementById("ig_parent_1").value = "";
                document.getElementById("ig_parent_2").value = "";

                document.getElementById("address_student").value = "";
                document.getElementById("kelurahan").value = "";
                document.getElementById("kecamatan").value = "";
                document.getElementById("kota").value = "";
                document.getElementById("provinsi").value = "";
                document.getElementById("zip").value = "";
                document.getElementById("country").value = "";
                document.getElementById("currency").value = "";
            } else {
                document.getElementById("status_parent_check").value = "0";
                document.getElementById("pack_old_parent").classList.remove("hiden");
                document.getElementById("pack_new_parent").classList.add("hiden");

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

    function myFunction(e) {
        var temp_val = e.target.value;
        console.log(temp_val);

        var temp = temp_val.split('<')[0];
        document.getElementById("id_parent").value = temp;
        var temp2 = temp_val.split('<')[2];
        document.getElementById("parent_student_2").value = temp2;
        var temp3 = temp_val.split('<')[3];
        document.getElementById("status_parent_1").value = temp3;
        var temp4 = temp_val.split('<')[4];
        document.getElementById("status_parent_2").value = temp4;
        var temp5 = temp_val.split('<')[5];
        document.getElementById("phone_parent_1").value = temp5;
        var temp6 = temp_val.split('<')[6];
        document.getElementById("phone_parent_2").value = temp6;
        var temp7 = temp_val.split('<')[7];
        document.getElementById("email_parent_1").value = temp7;
        var temp8 = temp_val.split('<')[8];
        document.getElementById("email_parent_2").value = temp8;
        var temp9 = temp_val.split('<')[9];
        document.getElementById("ig_parent_1").value = temp9;
        var temp10 = temp_val.split('<')[10];
        document.getElementById("ig_parent_2").value = temp10;

        var temp11 = temp_val.split('<')[11];
        document.getElementById("address_student").value = temp11;
        var temp12 = temp_val.split('<')[12];
        document.getElementById("kelurahan").value = temp12;
        var temp13 = temp_val.split('<')[13];
        document.getElementById("kecamatan").value = temp13;
        var temp14 = temp_val.split('<')[14];
        document.getElementById("kota").value = temp14;
        var temp15 = temp_val.split('<')[15];
        document.getElementById("provinsi").value = temp15;
        var temp16 = temp_val.split('<')[16];
        document.getElementById("zip").value = temp16;
        var temp17 = temp_val.split('<')[17];
        document.getElementById("country").value = temp17;
        var temp18 = temp_val.split('<')[18];
        document.getElementById("currency").value = temp18;
    }

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
</script>