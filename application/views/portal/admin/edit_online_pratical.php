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
                <a href="<?= site_url() ?>portal/data_online_lesson" class="btn btn-primary">
                    <i class="fa fa-angle-left"></i> Back
                </a>
            </span>
            <span style="float:right;">

            </span>
        </div>

        <hr>
        <h2 style="font-weight:bold">Edit Data Package</h2>
        <div class="row">
            <div class="col-lg-12 col-12 mt-4">
                <form action="<?= site_url('portal/C_Admin/edit_data_online_pratical') ?>" method="POST">
                    <input type="hidden" class="form-control" id="id_list_pack" value="<?= $online_pratical[0]['id_list_pack'] ?>" required name="id_list_pack">
                    <h5 style="font-weight:bold">Data Student</h5>
                    <hr>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="">Student ID</label>
                            <input type="text" readonly class="form-control" id="" required name="" value="<?= $online_pratical[0]['id_student'] ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_student">Student Name</label>
                        <select class="form-control select-form" name="id_student">
                            <option value="<?= $online_pratical[0]['id_student'] ?>"><?= $online_pratical[0]['name_student'] ?></option>
                            <?php foreach ($student as $t) : ?>
                                <option value="<?= $t['id_student'] ?>"><?= $t['name_student'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <br>
                    <div>
                        <h5 style="font-weight:bold">Data Teacher</h5>
                        <hr>
                        <div class="form-group">
                            <label for="id_teacher">Teacher Pratical Name</label>
                            <select class="form-control select-form" name="id_teacher_practical">
                                <option value="<?= $online_pratical[0]['id_teacher_practical'] ?>"><?= $online_pratical[0]['name_teacher'] ?></option>
                                <?php foreach ($teacher as $t) : ?>
                                    <option value="<?= $t['id_teacher'] ?>"><?= $t['name_teacher'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div id="check_theory_teacher" class="form-group">
                            <label for="id_teacher">Teacher Theory Name</label>
                            <select class="form-control select-form" name="id_teacher_theory">
                                <?php if ($online_pratical[0]['status_pack_theory'] == 1) : ?>
                                    <option value="<?= $online_pratical[0]['id_teacher_theory'] ?>"><?= $online_pratical[0]['name_teacher2'] ?></option>
                                <?php else : ?>
                                    <option value="NULL">Choose Teacher</option>
                                <?php endif; ?>
                                <?php foreach ($teacher as $t) : ?>
                                    <option value="<?= $t['id_teacher'] ?>"><?= $t['name_teacher'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div>
                        <h5 style="font-weight:bold">Data Package</h5>
                        <hr>
                        <div class="form-group form-check">
                            <input type="checkbox" name="status_pack_theory" class="form-check-input" id="status_pack_theory">
                            <label class="form-check-label" for="status_pack_theory">with theory online</label>
                            <input type="hidden" id="cek_pack" name="cek_pack" value="<?= $online_pratical[0]['status_pack_theory'] ?>">
                        </div>

                        <div class="form-group">
                            <label for="created_at">Purchase Date</label>
                            <input type="date" class="form-control" id="created_at" readonly required name="created_at" value="<?= $online_pratical[0]['created_at'] ?>">
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
                        </div>
                        <div class="form-group">
                            <label style="font-weight:bold" for="pack_pratical">Detail of Package</label>
                            <br>
                            Total Practical Package
                            <!-- <input type="number" class="form-control" id="pack_pratical" value="18" readonly required name="pack_pratical"> -->
                            <input type="number" class="form-control" id="total_pack_pratical" name="total_package" required value="<?= $online_pratical[0]['total_package'] ?>">
                            <br>
                            Total Practical Meeting
                            <input type="number" class="form-control" id="total_meet_pratical" value="<?= $online_pratical[0]['total_pack_practical'] ?>" name="pack_pratical" readonly>
                        </div>
                        <div id="check_theory_pack" class="form-group">
                            <label for="pack_theory">Total Theory Meeting</label>
                            <!-- <input type="number" class="form-control" id="pack_theory" value="9" readonly required name="pack_theory"> -->
                            <input type="number" class="form-control" id="total_pack_theory" value="<?= $online_pratical[0]['total_pack_theory'] ?>" readonly required name="total_pack_theory">
                        </div>
                        <div class="form-group">
                            <label for="">Select Currency:</label>
                            <select class="form-control" style="width:100%;" name="rate_dollar" id="rate_dollar">
                                <option value="1">IDR</option>
                                <option value="2">$</option>
                                <option value="3">€</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_paket">Name of Package</label>
                            <select class="form-control select-form" id="paket" name="id_paket" onchange="paketIdFunc(event)">
                                <option value="<?= $online_pratical[0]['paket'] ?>&<?= $online_pratical[0]['price_idr'] ?>&<?= $online_pratical[0]['price_dollar'] ?>&<?= $online_pratical[0]['price_euro'] ?>"><?= $online_pratical[0]['name'] ?></option>
                                <?php foreach ($paket as $t) : ?>
                                    <option value="<?= $t['id'] ?>&<?= $t['price_idr'] ?>&<?= $t['price_dollar'] ?>&<?= $t['price_euro'] ?>"><?= $t['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <input type="hidden" class="form-control" readonly id="temp_paket" name="temp_paket" value="<?= $online_pratical[0]['paket'] ?>">
                        <input type="hidden" class="form-control" value="0" readonly id="temp_harga_paket" name="temp_harga_paket">
                        <div class="form-group">
                            <label for="temp_rate">Rate</label>
                            <input type="text" class="form-control" readonly id="temp_rate" name="rate_package" value="<?= $online_pratical[0]['rate_package'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="discount">Discount</label>
                            <input type="number" class="form-control" id="discount" name="discount" value="<?= $online_pratical[0]['discount'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="rate">Total Price</label>
                            <input type="text" class="form-control" readonly id="rate" name="rate" value="<?= $online_pratical[0]['rate'] ?>">
                        </div>
                        <!-- <div class="form-group">
                            <label for="instrument">Instrument</label>
                            <input type="text" class="form-control" id="instrument" value="<?= $online_pratical[0]['instrument'] ?>" required name="instrument">
                        </div> -->
                        <!-- <div class="form-group">
                            <label for="pack_pratical">Pack practical</label>
                            <input type="number" class="form-control" id="pack_pratical" value="<?= $online_pratical[0]['total_pack_practical'] ?>" readonly required name="pack_pratical">
                        </div>
                        <div class="form-group">
                            <label for="pack_theory">Pack theory</label>
                            <input type="number" class="form-control" id="pack_theory" value="<?= $online_pratical[0]['total_pack_theory'] ?>" readonly required name="pack_theory">
                        </div> -->
                        <!-- <div class="form-group">
                            <label for="">Select Country:</label>
                            <select class="form-control" style="width:100%;" name="rate_dollar" id="rate_dollar">
                                <?php if ($online_pratical[0]['rate_dollar'] == 1) : ?>
                                    <option value="1">Rupiah</option>
                                    <option value="2">Dollar</option>
                                    <option value="3">Euro</option>
                                <?php elseif ($online_pratical[0]['rate_dollar'] == 2) : ?>
                                    <option value="2">Dollar</option>
                                    <option value="1">Rupiah</option>
                                    <option value="3">Euro</option>
                                <?php else : ?>
                                    <option value="3">Euro</option>
                                    <option value="1">Rupiah</option>
                                    <option value="2">Dollar</option>
                                <?php endif; ?>

                            </select>
                        </div> -->

                        <!-- <div class="form-group">
                            <label for="rate">Rate</label>
                            <input type="text" class="form-control" readonly value="<?= $online_pratical[0]['rate'] ?>" id="rupiah" />
                            <input type="hidden" class="form-control" id="rate" value="<?= $online_pratical[0]['rate'] ?>" name="rate">
                        </div> -->
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
        instrument_temp = '<?= $online_pratical[0]['instrument'] ?>';
        console.log(instrument_temp.split('|')[0]);
        if (instrument_temp.split('|')[0] === 'Others') {
            document.getElementById("instrument").value = 'Others';
            var new_input = `<input type="text" class="form-control" placeholder="input other instrument" id="others" required name="others" value="` + instrument_temp.split('|')[1] + `">`;
            $('#inputOthers').append(new_input);
        } else {
            document.getElementById("instrument").value = '<?= $online_pratical[0]['instrument'] ?>';
        }

        // document.getElementById("instrument").value = '<?= $online_pratical[0]['instrument'] ?>';
        document.getElementById("rate_dollar").value = '<?= $online_pratical[0]['rate_dollar'] ?>';
        if (<?= $online_pratical[0]['status_pack_theory'] ?> == 1) {
            document.getElementById("status_pack_theory").checked = true;
            document.getElementById("status_pack_theory").value = "1";
            document.getElementById("check_theory_teacher").classList.remove("hiden");
        } else {
            document.getElementById("status_pack_theory").checked = false;
            document.getElementById("status_pack_theory").value = "0";
            document.getElementById("check_theory_teacher").classList.add("hiden");
        }
        $("#status_pack_theory").on('click', function() {
            var value = document.getElementById("status_pack_theory").value;
            console.log(value)
            if (value === "1") {
                document.getElementById("status_pack_theory").value = "0";
                document.getElementById("cek_pack").value = "0";
                document.getElementById("check_theory_teacher").classList.add("hiden");
                document.getElementById("check_theory_pack").classList.add("hiden");
                document.getElementById("total_pack_theory").value = 0;
            } else {
                document.getElementById("status_pack_theory").value = "1";
                document.getElementById("cek_pack").value = "1";
                document.getElementById("check_theory_teacher").classList.remove("hiden");
                document.getElementById("check_theory_pack").classList.remove("hiden");
                var total_pack_pratical = document.getElementById("total_pack_pratical").value;
                document.getElementById("total_pack_theory").value = total_pack_pratical;
            }
        });
        $("#rate_dollar").change(function() {
            var val = $(this).val();
            console.log(val)
            var temp_val = document.getElementById("paket").value;
            console.log(temp_val)
            var jmlhPaket = document.getElementById("total_pack_pratical").value;
            var temp_harga_paket = '';

            var temp = "";
            if (val == 2) {
                temp = temp_val.split('&')[2] * jmlhPaket;
                temp_harga_paket = temp_val.split('&')[2];
            } else if (val == 3) {
                temp = temp_val.split('&')[3] * jmlhPaket;
                temp_harga_paket = temp_val.split('&')[3];
            } else {
                temp = temp_val.split('&')[1] * jmlhPaket;
                temp_harga_paket = temp_val.split('&')[1];
            }
            var discount = document.getElementById('discount').value;
            document.getElementById("temp_rate").value = temp;
            document.getElementById("temp_harga_paket").value = temp_harga_paket;
            document.getElementById("rate").value = temp - discount;

            // document.getElementById("temp_rate").value = temp;
            // document.getElementById("temp_harga_paket").value = temp_harga_paket;
        });

    });
</script>
<script>
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


    function studentIdFunc(e) {
        var temp_val = e.target.value;
        document.getElementById("temp_id_student").value = temp_val;
    }

    function paketIdFunc(e) {
        var temp_val = e.target.value;
        document.getElementById("temp_paket").value = temp_val.split('&')[0];
        var jmlhPaket = document.getElementById("total_pack_pratical").value;
        var temp = "";
        var temp_harga_paket = '';
        if (document.getElementById("rate_dollar").value == 1) {
            temp = temp_val.split('&')[1] * jmlhPaket;
            temp_harga_paket = temp_val.split('&')[1];
        } else if (document.getElementById("rate_dollar").value == 2) {
            temp = temp_val.split('&')[2] * jmlhPaket;
            temp_harga_paket = temp_val.split('&')[2];
        } else {
            temp = temp_val.split('&')[3] * jmlhPaket;
            temp_harga_paket = temp_val.split('&')[3];
        }
        var discount = document.getElementById('discount').value;
        document.getElementById("temp_rate").value = temp;
        document.getElementById("temp_harga_paket").value = temp_harga_paket;
        document.getElementById("rate").value = temp - discount;
    }


    var total_pack_pratical = document.getElementById('total_pack_pratical');
    total_pack_pratical.addEventListener('keyup', function(e) {
        var discount = document.getElementById('discount').value;
        console.log(discount)
        var temp_harga_paket = document.getElementById("temp_harga_paket").value;
        document.getElementById("total_meet_pratical").value = total_pack_pratical.value * 2;
        document.getElementById("temp_rate").value = temp_harga_paket * total_pack_pratical.value;
        document.getElementById("rate").value = temp_harga_paket * total_pack_pratical.value - discount;

        //cek theory atau tidak
        var status_pack_theory = document.getElementById("status_pack_theory").value;
        if (status_pack_theory === '1') {
            document.getElementById("total_pack_theory").value = total_pack_pratical.value;
        } else {
            document.getElementById("total_pack_theory").value = 0;
        }
        console.log(status_pack_theory)
    });

    var discount = document.getElementById('discount');
    var temp_rate = document.getElementById('temp_rate');
    discount.addEventListener('keyup', function(e) {
        document.getElementById("rate").value = temp_rate.value - discount.value;
    });
    var rate = document.getElementById('rate');
    var rupiah = document.getElementById('rupiah');
    var valuee = '';
    rupiah.addEventListener('keyup', function(e) {
        rupiah.value = formatRupiah(this.value);
        valuee = rupiah.value;
        rate.value = valuee.split('.').join("");
    });

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