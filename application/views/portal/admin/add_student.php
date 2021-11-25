<style>
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
</style>
<main class="page-content">
    <div class="container-fluid">
        <h2>Add Data <?= ucfirst($data['choose']) ?></h2>
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
                <a href="<?= site_url() ?>portal/data_student" class="btn btn-primary">
                    <i class="fa fa-angle-left"></i> Back
                </a>
            </div>

            <div class="col-lg-12 col-12 mt-4">
                <form action="<?= site_url('portal/C_Admin/add_data_student') ?>" method="POST">
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
                    <?php endif; ?>
                    <?php if ($data['choose'] == "parent") : ?>
                        <div class="form-group">
                            <label for="parent_student">Parent Name</label>
                            <input type="text" class="form-control" id="parent_student" required name="parent_student">
                        </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="name_student">Student Name</label>
                        <input type="text" class="form-control" id="name_student" required name="name_student1">

                        <div id="new_student">

                        </div>
                        <input type="hidden" value="1" name="total_student" id="total_student">
                        <div class="pt-2">
                            <button type="button" class="add btn btn-info">Add</button>
                            <button type="button" class="remove btn btn-info">remove</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="instrument">Instrument</label>
                        <input type="text" class="form-control" id="instrument" required name="instrument1">
                        <div id="new_instrument">

                        </div>
                        <input type="hidden" value="1" name="total_instrument" id="total_instrument">
                    </div>
                    <div class="form-group">
                        <label for="dob_student">DOB</label>
                        <input type="text" class="form-control" id="dob_student" required name="dob_student1">
                        <small id="emailHelp" class="form-text text-muted">(Ex: Jakarta, 20 Maret 1990)</small>
                        <div id="new_dob">

                        </div>
                        <input type="hidden" value="1" name="total_dob" id="total_dob">
                    </div>
                    <div class="form-group">
                        <label for="school_student">School</label>
                        <input type="text" class="form-control" id="school_student" required name="school_student1">
                        <div id="new_school">

                        </div>
                        <input type="hidden" value="1" name="total_school" id="total_school">
                    </div>
                    <?php if ($data['choose'] == "parent") : ?>
                        <div class="form-group">
                            <label for="address_student">Address</label>
                            <textarea class="form-control regist-form" rows="4" required name="address_student" id="address_student"></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="inputCity">Sub District</label>
                                <input type="text" name="kelurahan" required class="form-control regist-form">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="inputCity">District</label>
                                <input type="text" name="kecamatan" required class="form-control regist-form">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="inputCity">City</label>
                                <input type="text" name="kota" required class="form-control regist-form">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="inputCity">Province</label>
                                <input type="text" name="provinsi" required class="form-control regist-form">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="inputZip">Postal Code</label>
                                <input type="text" name="zip" required class="form-control regist-form">
                            </div>
                            <div id="check_country" class="form-group col-lg-6 hiden">
                                <label for="inputCity">Country</label>
                                <input id="country" type="text" name="country" required class="form-control regist-form">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone_student_1">Phone 1</label>
                            <input type="text" class="form-control" id="phone_student_1" required name="phone_student_1">
                        </div>
                        <div class="form-group">
                            <label for="phone_student_2">Phone 2</label>
                            <input type="text" class="form-control" id="phone_student_2" name="phone_student_2">
                            <small id="emailHelp" class="form-text text-muted">If more than one</small>
                        </div>
                        <div class="form-group">
                            <label for="">Select currency:</label>
                            <select class="form-control" style="width:100%;" name="currency" id="currency">
                                <option value="1">Rupiah</option>
                                <option value="2">Dollar</option>
                                <option value="3">Euro</option>
                            </select>
                        </div>
                    <?php endif; ?>

                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
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
            document.getElementById("status_country").value = "1";
            document.getElementById("kat").value = "1";
        } else {
            document.getElementById("status_country").value = "0";
            document.getElementById("kat").value = "2";
        }

    });
    $(document).ready(function() {
        $('.select-form').select2();
        $('.add').on('click', add);
        $('.remove').on('click', remove);

        function add() {
            add_dob();
            add_school();
            add_instrument();
            var new_student_no = parseInt($('#total_student').val()) + 1;
            var new_input = "<input class='form-control mt-2' placeholder='Student name " + new_student_no + "...' name='name_student" + new_student_no + "' type='text' id='new_" + new_student_no + "'>";

            $('#new_student').append(new_input);

            $('#total_student').val(new_student_no);
        }

        function remove() {
            remove_dob();
            remove_school();
            remove_instrument();
            var last_student_no = $('#total_student').val();

            if (last_student_no > 1) {
                $('#new_' + last_student_no).remove();
                $('#total_student').val(last_student_no - 1);
            }
        }

        // $('.add_dob').on('click', add_dob);
        // $('.remove_dob').on('click', remove_dob);

        function add_dob() {
            var new_dob_no = parseInt($('#total_dob').val()) + 1;
            var new_input = "<input class='form-control mt-2' placeholder='DOB Student " + new_dob_no + "..' name='dob_student" + new_dob_no + "' type='text' id='new_" + new_dob_no + "'>";

            $('#new_dob').append(new_input);

            $('#total_dob').val(new_dob_no);
        }

        function remove_dob() {
            var last_dob_no = $('#total_dob').val();

            if (last_dob_no > 1) {
                $('#new_' + last_dob_no).remove();
                $('#total_dob').val(last_dob_no - 1);
            }
        }

        function add_school() {
            var new_school_no = parseInt($('#total_school').val()) + 1;
            var new_input = "<input class='form-control mt-2' placeholder='school Student " + new_school_no + "..' name='school_student" + new_school_no + "' type='text' id='new_" + new_school_no + "'>";

            $('#new_school').append(new_input);

            $('#total_school').val(new_school_no);
        }

        function remove_school() {
            var last_school_no = $('#total_school').val();

            if (last_school_no > 1) {
                $('#new_' + last_school_no).remove();
                $('#total_school').val(last_school_no - 1);
            }
        }

        function add_instrument() {
            var new_instrument_no = parseInt($('#total_instrument').val()) + 1;
            var new_input = "<input class='form-control mt-2' placeholder='instrument Student " + new_instrument_no + "..' name='instrument" + new_instrument_no + "' type='text' id='new_" + new_instrument_no + "'>";

            $('#new_instrument').append(new_input);

            $('#total_instrument').val(new_instrument_no);
        }

        function remove_instrument() {
            var last_instrument_no = $('#total_instrument').val();

            if (last_instrument_no > 1) {
                $('#new_' + last_instrument_no).remove();
                $('#total_instrument').val(last_instrument_no - 1);
            }
        }
    });
</script>