<style>
    .add,
    .remove {
        /* background-color: #263850; */
        color: white;
        font-size: 12px;
    }

    h5 {
        font-weight: bold;
    }

    .add:hover,
    .remove:hover {
        /* background-color: #0676BD; */
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
                <a href="<?= site_url() ?>portal/data_student" class="btn btn-primary">
                    <i class="fa fa-angle-left"></i> Back
                </a>
            </span>
            <span style="float:right;">

            </span>
        </div>

        <hr>
        <h2 style="font-weight:bold">Add Data Student</h2>
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
                <form action="<?= site_url('portal/C_Admin/add_data_student2') ?>" method="POST">
                    <h5>STUDENT</h5>
                    <div class="form-group">
                        <label for="name_student">Full Name</label>
                        <input type="text" class="form-control" id="name_student" required name="name_student1">
                    </div>
                    <div class="form-group">
                        <label for="nickname_student">Nick Name</label>
                        <input type="text" class="form-control" id="nickname_student" required name="nickname_student1">
                    </div>
                    <div class="form-group">
                        <label for="dob_student">Place - DOB</label>
                        <input type="text" class="form-control" id="dob_student" required name="dob_student1">
                        <small id="emailHelp" class="form-text text-muted">(Ex: Jakarta - 20 Maret 1990)</small>
                    </div>
                    <div class="form-group">
                        <label for="school_student">School</label>
                        <input type="text" class="form-control" id="school_student" required name="school_student1">
                    </div>
                    <div class="form-group">
                        <label for="phone_student">Phone Number/WA</label>
                        <input type="text" class="form-control" id="phone_student" required name="phone_student1">
                    </div>
                    <div class="form-group">
                        <label for="email_student">Email</label>
                        <input type="text" class="form-control" id="email_student" name="email_student">
                    </div>
                    <div class="form-group">
                        <label for="ig_student">Instagram</label>
                        <input type="text" class="form-control" id="ig_student" name="ig_student">
                    </div>
                    <div class="form-group">
                        <label for="address_student">Address</label>
                        <textarea class="form-control regist-form" rows="4" required name="address_student" id="address_student"></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="inputCity">Sub District</label>
                            <input type="text" id="kelurahan" name="kelurahan" required class="form-control regist-form">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="inputCity">District</label>
                            <input type="text" name="kecamatan" id="kecamatan" required class="form-control regist-form">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="inputCity">City</label>
                            <input type="text" name="kota" id="kota" required class="form-control regist-form">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="inputCity">Province</label>
                            <input type="text" name="provinsi" id="provinsi" required class="form-control regist-form">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="inputZip">Postal Code</label>
                            <input type="text" name="zip" id="zip" required class="form-control regist-form">
                        </div>
                        <div id="check_country" class="form-group col-lg-6">
                            <label for="inputCity">Country</label>
                            <input id="country" type="text" name="country" id="country" required class="form-control regist-form">
                        </div>
                    </div>
                    <div id="new_student">

                    </div>

                    <div id="new_music_lesson">

                    </div>
                    <input type="hidden" value="1" name="total_student" id="total_student">
                    <!--<div class="pt-2">-->
                    <!--    <button type="button" class="add btn btn-primary">Add</button>-->
                    <!--    <button type="button" class="remove btn btn-primary">remove</button>-->
                    <!--</div>-->
                    <hr>
                    <h5>PERSON IN CHARGE (1)</h5>
                    <div class="form-group form-check">
                        <input type="checkbox" name="status_parent_check" value="1" checked class="form-check-input" id="status_parent_check">
                        <label class="form-check-label" for="status_parent_check">Add new parent</label>
                        <input type="hidden" id="cek_pack" value="1">
                    </div>
                    <div id="pack_old_parent" class="hiden">
                        <div class="form-group">
                            <label for="parent_student">Name</label><br>
                            <?php $id_parent = [];
                            $parent_student = []; ?>
                            <?php foreach ($student as $s) : ?>
                                <?php $id_parent[] = $s['id_parent'] . "<" . $s['parent_student'] . "<" . $s['parent_student_2'] . "<" . $s['status_parent_1'] . "<" . $s['status_parent_2'] . "<" . $s['phone_parent_1'] . "<" . $s['phone_parent_2'] . "<" . $s['email_parent_1'] . "<" . $s['email_parent_2'] . "<" . $s['ig_parent_1'] . "<" . $s['ig_parent_2'] . "<" . $s['address_parent'] . "<" . $s['kelurahan_parent'] . "<" . $s['kecamatan_parent'] . "<" . $s['kota_parent'] . "<" . $s['provinsi_parent'] . "<" . $s['zip_parent'] . "<" . $s['country_parent'] . "<" . $s['currency'] ?>
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
                    </div>

                    <div id="pack_new_parent" class="">
                        <div class="form-group">
                            <label for="parent_student">Name</label>
                            <input type="text" class="form-control" id="parent_student" name="parent_student">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status_parent_1">Status</label>
                        <input type="text" class="form-control" id="status_parent_1" required name="status_parent_1">
                    </div>
                    <div class="form-group">
                        <label for="phone_parent_1">Phone Number/WA</label>
                        <input type="number" class="form-control" id="phone_parent_1" required name="phone_parent_1">
                    </div>
                    <div class="form-group">
                        <label for="email_parent_1">Email</label>
                        <input type="text" class="form-control" id="email_parent_1" name="email_parent_1">
                    </div>
                    <div class="form-group">
                        <label for="ig_parent_1">Instagram</label>
                        <input type="text" class="form-control" id="ig_parent_1" name="ig_parent_1">
                    </div>
                    <h5>PERSON IN CHARGE (2)</h5>
                    <div class="form-group">
                        <label for="parent_student_2">Name</label>
                        <input type="text" class="form-control" id="parent_student_2" name="parent_student_2">
                    </div>
                    <div class="form-group">
                        <label for="status_parent_2">Status</label>
                        <input type="text" class="form-control" id="status_parent_2" name="status_parent_2">
                    </div>
                    <div class="form-group">
                        <label for="phone_parent_2">Phone Number/WA</label>
                        <input type="number" class="form-control" id="phone_parent_2" name="phone_parent_2">
                    </div>
                    <div class="form-group">
                        <label for="email_parent_2">Email</label>
                        <input type="text" class="form-control" id="email_parent_2" name="email_parent_2">
                    </div>
                    <div class="form-group">
                        <label for="ig_parent_2">Instagram</label>
                        <input type="text" class="form-control" id="ig_parent_2" name="ig_parent_2">
                    </div>
                    <hr>
                    <h5>Person in Charge Address</h5>
                    <div class="form-group form-check">
                        <input type="checkbox" name="check_address" value="1" checked class="form-check-input" id="check_address">
                        <label class="form-check-label" for="check_address">
                            The address same as student</label>
                    </div>
                    <div id="address_parent_same" class="hiden">
                        <div class="form-group">
                            <!-- <label for="address_student">Address</label> -->
                            <textarea class="form-control regist-form" rows="4" name="address_parent" id="address_parent"></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="inputCity">Sub District</label>
                                <input type="text" id="kelurahan_parent" name="kelurahan_parent" class="form-control regist-form">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="inputCity">District</label>
                                <input type="text" name="kecamatan_parent" id="kecamatan_parent" class="form-control regist-form">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="inputCity">City</label>
                                <input type="text" name="kota_parent" id="kota_parent" class="form-control regist-form">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="inputCity">Province</label>
                                <input type="text" name="provinsi_parent" id="provinsi_parent" class="form-control regist-form">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="inputZip">Postal Code</label>
                                <input type="text" name="zip_parent" id="zip_parent" class="form-control regist-form">
                            </div>
                            <div id="check_country" class="form-group col-lg-6">
                                <label for="inputCity">Country</label>
                                <input type="text" name="country_parent" id="country_parent" class="form-control regist-form">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Select currency:</label>
                        <select class="form-control" style="width:100%;" name="currency" id="currency">
                            <option value="1">IDR</option>
                            <option value="2">$</option>
                            <option value="3">€</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="teacher_percentage">Teacher Fee Percentage</label>
                        <input type="text" name="teacher_percentage" id="teacher_percentage" class="form-control regist-form">
                    </div>
                    <hr>
                    <h5>MUSIC LESSON</h5>
                    <div class="form-group">
                        <label for="instrument">Instrument</label>
                        <select class="form-control" style="width:100%;" name="instrument1" id="instrument" onchange="instrumentFunc(event)">
                            <option value="Piano">Piano</option>
                            <option value="Violin">Violin</option>
                            <option value="Cello">Cello</option>
                            <option value="Bass">Bass</option>
                            <option value="Vocal">Vocal</option>
                            <option value="Guitar">Guitar</option>
                            <option value="Others1">Others</option>
                        </select>
                        <div id="inputOthers">

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="paket">Package</label>
                        <select class="form-control" style="width:100%;" name="paket1" id="paket">
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
            var new_input2 = `<div id='new_music_` + new_student_no + `'>
                <p>Student ` + new_student_no + `</p>
                <div class="form-group">
                    <label for="instrument">Instrument</label>
                    <select class="form-control" style="width:100%;" name="instrument` + new_student_no + `" onchange="instrumentFunc2(event)">
                        <option value="Piano">Piano</option>
                        <option value="Violin">Violin</option>
                        <option value="Cello">Cello</option>
                        <option value="Bass">Bass</option>
                        <option value="Vocal">Vocal</option>
                        <option value="Guitar">Guitar</option>
                        <option value="Others` + new_student_no + `">Others</option>
                    </select>
                    <div id="inputOthers` + new_student_no + `">

                    </div>
                </div>
                <div class="form-group">
                    <label for="paket">Package</label>
                    <select class="form-control" style="width:100%;" name="paket` + new_student_no + `">
                        <option value="Etude in Silver">Etude in Silver</option>
                        <option value="Etude in Gold">Etude in Gold</option>
                        <option value="Etude in Olive">Etude in Olive</option>
                        <option value="Etude in Beige">Etude in Beige</option>
                        <option value="Etude in Azure">Etude in Azure</option>
                        <option value="Etude in Brown">Etude in Brown</option>
                        <option value="Etude in Pink">Etude in Pink</option>
                        <option value="Etude in Purple">Etude in Purple</option>
                        <option value="Etude in Tosca">Etude in Tosca</option>
                        <option value="Etude in Blue">Etude in Blue</option>
                    </select>
                </div>
            </div>`;
            $('#new_student').append(new_input);
            $('#new_music_lesson').append(new_input2);
            $('#total_student').val(new_student_no);
        }

        function remove() {
            var last_student_no = $('#total_student').val();

            if (last_student_no > 1) {
                $('#new_' + last_student_no).remove();
                $('#new_music_' + last_student_no).remove();
                $('#total_student').val(last_student_no - 1);
            }
        }

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

                document.getElementById("address_parent").value = "";
                document.getElementById("kelurahan_parent").value = "";
                document.getElementById("kecamatan_parent").value = "";
                document.getElementById("kota_parent").value = "";
                document.getElementById("provinsi_parent").value = "";
                document.getElementById("zip_parent").value = "";
                document.getElementById("country_parent").value = "";
                document.getElementById("currency").value = "";
            } else {
                document.getElementById("status_parent_check").value = "0";
                document.getElementById("pack_old_parent").classList.remove("hiden");
                document.getElementById("pack_new_parent").classList.add("hiden");

            }
        });
    })

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
        document.getElementById("address_parent").value = temp11;
        var temp12 = temp_val.split('<')[12];
        document.getElementById("kelurahan_parent").value = temp12;
        var temp13 = temp_val.split('<')[13];
        document.getElementById("kecamatan_parent").value = temp13;
        var temp14 = temp_val.split('<')[14];
        document.getElementById("kota_parent").value = temp14;
        var temp15 = temp_val.split('<')[15];
        document.getElementById("provinsi_parent").value = temp15;
        var temp16 = temp_val.split('<')[16];
        document.getElementById("zip_parent").value = temp16;
        var temp17 = temp_val.split('<')[17];
        document.getElementById("country_parent").value = temp17;
        var temp18 = temp_val.split('<')[18];
        document.getElementById("currency").value = temp18;
    }

    function instrumentFunc(e) {
        var temp_val = e.target.value;
        console.log(temp_val);
        if (temp_val === 'Others1') {
            var new_input = `<input type="text" class="form-control" placeholder="input other instrument" id="others" required name="others1">`;
            $('#inputOthers').append(new_input);
        } else {
            $('#others').remove();
        }
    }

    function instrumentFunc2(e) {
        var temp_val = e.target.value;
        console.log(temp_val);
        var temp = temp_val.substr(temp_val.length - 1);
        if (temp_val === 'Others' + temp) {
            var new_input = `<input type="text" class="form-control" placeholder="input other instrument" id="others` + temp + `" required name="others` + temp + `">`;
            $('#inputOthers' + temp).append(new_input);
        } else {
            $('#others' + temp).remove();
        }

    }
</script>