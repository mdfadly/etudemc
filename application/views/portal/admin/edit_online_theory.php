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
        <h2 style="font-weight:bold">Edit Data Theory Lesson</h2>
        <div class="row">
            <div class="col-lg-12 col-12 mt-4">
                <form action="<?= site_url('portal/C_Admin/edit_data_online_theory') ?>" method="POST">
                    <input type="hidden" class="form-control" id="id_online_theory" value="<?= $online_theory[0]['id_online_theory'] ?>" required name="id_online_theory">
                    <div class="form-group">
                        <label for="id_teacher">Teacher Name</label>
                        <select class="form-control select-form" name="id_teacher">
                            <option value="<?= $online_theory[0]['id_teacher'] ?>">
                                <?= $online_theory[0]['name_teacher'] ?>
                            </option>

                            <?php foreach ($teacher as $t) : ?>
                                <option value="<?= $t['id_teacher'] ?>"><?= $t['name_teacher'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_student">Student Name</label>
                        <select class="form-control select-form" name="id_student">
                            <option value="<?= $online_theory[0]['id_student'] ?>">
                                <?= $online_theory[0]['name_student'] ?>
                            </option>

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
                            <option value="Others">Others</option>
                        </select>
                        <div id="inputOthers">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="duration">Duration</label>
                        <select class="form-control" name="duration" id="duration">
                            <option value="30">30'</option>
                            <option value="45">45'</option>
                            <option value="60">60'</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="rate">Rate</label>
                        <select class="form-control" name="rate" id="rate">
                            <option value="Rp-100000">Rp100,000</option>
                            <option value="$-10">$10</option>
                            <option value="€-10">€10</option>
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
        instrument_temp = '<?= $online_theory[0]['instrument'] ?>';
        console.log(instrument_temp.split('|')[0]);
        if (instrument_temp.split('|')[0] === 'Others') {
            document.getElementById("instrument").value = 'Others';
            var new_input = `<input type="text" class="form-control" placeholder="input other instrument" id="others" required name="others" value="` + instrument_temp.split('|')[1] + `">`;
            $('#inputOthers').append(new_input);
        } else {
            document.getElementById("instrument").value = '<?= $online_theory[0]['instrument'] ?>';
        }
        document.getElementById("rate").value = '<?= $online_theory[0]['rate'] ?>';
        document.getElementById("duration").value = '<?= $online_theory[0]['duration'] ?>';
    });
</script>
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
    // var rate = document.getElementById('rate');
    // var rupiah = document.getElementById('rupiah');
    // var valuee = '';
    // rupiah.addEventListener('keyup', function(e) {
    //     rupiah.value = formatRupiah(this.value);
    //     valuee = rupiah.value;
    //     rate.value = valuee.split('.').join("");
    // });

    // function formatRupiah(angka, prefix) {
    //     var number_string = angka.replace(/[^,\d]/g, '').toString(),
    //         split = number_string.split(','),
    //         sisa = split[0].length % 3,
    //         rupiah = split[0].substr(0, sisa),
    //         ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    //     if (ribuan) {
    //         separator = sisa ? '.' : '';
    //         rupiah += separator + ribuan.join('.');
    //     }

    //     rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    //     return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    // }
</script>