<style>
    .hiden {
        display: none;
    }
</style>
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
                <a href="<?= site_url() ?>portal/data_offline_lesson" class="btn btn-primary">
                    <i class="fa fa-angle-left"></i> Back
                </a>
            </span>
            <span style="float:right;">

            </span>
        </div>

        <hr>
        <h2 style="font-weight:bold">Edit Data Offline Lesson</h2>
        <div class="row">

            <div class="col-lg-12 col-12 mt-4">
                <form action="<?= site_url('portal/C_Admin/edit_data_offline_lesson') ?>" method="POST">
                    <input type="hidden" class="form-control" id="id_offline_lesson" value="<?= $offline_lesson[0]['id_offline_lesson'] ?>" required name="id_offline_lesson">
                    <div class="form-group">
                        <label for="id_teacher">Teacher Name</label>
                        <select class="form-control select-form" name="id_teacher">
                            <option value="<?= $offline_lesson[0]['id_teacher'] ?>">
                                <?= $offline_lesson[0]['name_teacher'] ?>
                            </option>

                            <?php foreach ($teacher as $t) : ?>
                                <option value="<?= $t['id_teacher'] ?>"><?= $t['name_teacher'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_student">Student Name</label>
                        <select class="form-control select-form" name="id_student">
                            <option value="<?= $offline_lesson[0]['id_student'] ?>">
                                <?= $offline_lesson[0]['name_student'] ?>
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
                            <option value="Others">Others</option>
                        </select>
                        <div id="inputOthers">

                        </div>
                        <!-- <input type="text" class="form-control" id="instrument" value="<?= $offline_lesson[0]['instrument'] ?>" required name="instrument"> -->
                    </div>
                    <div class="form-group">
                        <label for="id_paket">Name of Package</label>
                        <select class="form-control select-form paket_dropdown" id="paket" name="id_paket" onchange="paketIdFunc(event)">
                            <option value="<?= $offline_lesson[0]['id_paket'] ?>">
                                <?= $offline_lesson[0]['name_paket'] ?>
                            </option>

                            <?php foreach ($paket as $t) : ?>
                                <option value="<?= $t['id'] ?>&<?= $t['price_idr'] ?>&<?= $t['price_dollar'] ?>&<?= $t['price_euro'] ?>&<?= $t['duration'] ?>"><?= $t['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Duration</label>
                        <input type="text" class="form-control" readonly id="duration_temp" value="<?= $offline_lesson[0]['duration'] ?>`">
                        <input type="hidden" class="form-control" readonly id="duration" name="duration" value="<?= $offline_lesson[0]['duration'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="rate">Rate</label>
                        <input type="text" class="form-control" readonly id="rate_rupiah" name="rate_rupiah" value="<?= number_format($offline_lesson[0]['rate'], 0, ',', '.') ?>">
                        <input type="hidden" class="form-control" readonly id="rate" name="rate" value="<?= $offline_lesson[0]['rate'] ?>">
                    </div>
                    <!-- <div class="form-group">
                        <label for="duration">Duration</label>
                        <select class="form-control" id="duration" name="duration">
                            <option value="30'">30'</option>
                            <option value="45'">45'</option>
                            <option value="60'">60'</option>
                        </select>
                    </div> -->
                    <!-- <div class="form-group">
                        <label for="rate">Rate</label>
                        <select class="form-control" name="rate" id="rate" onchange="rateFunc(event)">
                            <option value="350000">Rp350.000</option>
                            <option value="400000">Rp400.000</option>
                            <option value="450000">Rp450.000</option>
                            <option value="500000">Rp500.000</option>
                            <option value="550000">Rp550.000</option>
                            <option value="Others">Others</option>
                        </select>
                        <div id="inputOthers2">

                        </div>
                    </div> -->
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
        instrument_temp = '<?= $offline_lesson[0]['instrument'] ?>';
        if (instrument_temp.split('|')[0] === 'Others') {
            document.getElementById("instrument").value = 'Others';
            var new_input = `<input type="text" class="form-control" placeholder="input other instrument" id="others1" required name="others1" value="` + instrument_temp.split('|')[1] + `">`;
            $('#inputOthers').append(new_input);
        } else {
            document.getElementById("instrument").value = '<?= $offline_lesson[0]['instrument'] ?>';
        }

        rate_temp = '<?= $offline_lesson[0]['rate'] ?>';
        if (rate_temp.split('|')[0] === 'Others') {
            document.getElementById("rate").value = 'Others';
            var new_input = `<input type="text" class="form-control" placeholder="input other rate" id="others2" required name="others2" value="` + rate_temp.split('|')[1] + `">`;
            $('#inputOthers2').append(new_input);
        } else {
            document.getElementById("rate").value = '<?= $offline_lesson[0]['rate'] ?>';
        }

        document.getElementById("duration").value = "<?= $offline_lesson[0]['duration'] ?>";
    });

    function paketIdFunc(e) {
        var temp_val = e.target.value;
        console.log(temp_val);
        $(".paket_dropdown option[value='6']").remove();

        var reset = 0;
        document.getElementById("duration").value = reset;
        document.getElementById("duration_temp").value = reset;
        document.getElementById("rate_rupiah").value = formatRupiah(String(reset));
        document.getElementById("rate").value = reset;

        var temp_harga_paket = temp_val.split('&')[1];
        var duration = temp_val.split('&')[4];

        document.getElementById("duration").value = duration;
        document.getElementById("duration_temp").value = duration + "'";
        document.getElementById("rate_rupiah").value = formatRupiah(String(temp_harga_paket));
        document.getElementById("rate").value = temp_harga_paket;
    }

    function instrumentFunc(e) {
        var temp_val = e.target.value;
        console.log(temp_val);
        if (temp_val === 'Others') {
            var new_input = `<input type="text" class="form-control" placeholder="input other instrument" id="others1" required name="others1">`;
            $('#inputOthers').append(new_input);
        } else {
            $('#others1').remove();
        }
    }

    function rateFunc(e) {
        var temp_val = e.target.value;
        console.log(temp_val);
        if (temp_val === 'Others') {
            var new_input = `<input type="text" class="form-control" placeholder="input other rate" id="others2" required name="others2">`;
            $('#inputOthers2').append(new_input);
        } else {
            $('#others2').remove();
        }
    }

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>