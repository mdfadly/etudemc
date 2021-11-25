<main class="page-content">
    <div class="container-fluid">
        <div class="row">
            <?php if ($this->session->flashdata('warning') != null) : ?>
                <div class="col-lg-12">
                    <div class="alert alert-danger" role="alert">
                        <?= $this->session->flashdata('warning') ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div style="text-align:left;">
            <span style="font-family:mReguler; font-size:20px;" class="font-weight-bold">
                <a href="<?= site_url() ?>portal/data_theory_lesson" class="btn btn-primary">
                    <i class="fa fa-angle-left"></i> Back
                </a>
            </span>
            <span style="float:right;">

            </span>
        </div>

        <hr>
        <h2 style="font-weight:bold">Add Data Theory Lesson</h2>
        <div class="row">
            <div class="col-lg-12 col-12 mt-4">
                <form action="<?= site_url('portal/C_Admin/add_data_online_theory') ?>" method="POST">
                    <div class="form-group">
                        <label for="id_teacher">Teacher Name</label><br>
                        <select class="form-control select-form" style="width:100%;" name="id_teacher">
                            <option>Choose Teacher</option>
                            <?php foreach ($teacher as $t) : ?>
                                <option value="<?= $t['id_teacher'] ?>"><?= $t['name_teacher'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_student">Student Name</label><br>
                        <select class="form-control select-form" style="width:100%;" name="id_student">
                            <option>Choose Student</option>
                            <?php foreach ($student as $t) : ?>
                                <option value="<?= $t['id_student'] ?>"><?= $t['name_student'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="instrument">Instrument</label>
                        <select class="form-control" style="width:100%;" name="instrument" id="instrument" onchange="instrumentFunc(event)">
                            <option value="Piano">Piano</option>
                            <option value="Violin">Violin</option>
                            <option value="Cello">Cello</option>
                            <option value="Bass">Bass</option>
                            <option value="Vocal">Vocal</option>
                            <option value="Guitar">Guitar</option>
                            <option value="Theory Class">Theory Class</option>
                            <option value="Others1">Others</option>
                        </select>
                        <div id="inputOthers">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="duration">Duration</label>
                        <select class="form-control" name="duration">
                            <option value="30'">30'</option>
                            <option value="45'">45'</option>
                            <option value="60'">60'</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="rate">Rate</label>
                        <select class="form-control" name="rate">
                            <option value="100000">Rp100,000</option>
                            <option value="10">$10</option>
                            <option value="10">€10</option>
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
    });

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
</script>