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
        <h2 style="font-weight:bold">Buy Package</h2>
        <div class="row">
            <div class="col-lg-12 col-12 mt-4">
                <form action="<?= site_url('portal/C_Admin/add_data_offline_lesson2') ?>" method="POST">
                    <h5 style="font-weight:bold">Data Student</h5>
                    <hr>
                    <div class="form-group">
                        <label for="">Student ID</label>
                        <input type="text" class="form-control" readonly id="temp_id_student" name="">
                    </div>
                    <div class="form-group">
                        <label for="id_student">Student Name</label>
                        <select class="form-control select-form" name="id_student" onchange="studentIdFunc(event)">
                            <option>--- Choose Student ---</option>
                            <?php foreach ($student as $t) : ?>
                                <option value="<?= $t['id_student'] ?>"><?= $t['name_student'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_paket">Name of Package</label>
                        <select class="form-control select-form" id="paket" name="id_paket" onchange="paketIdFunc(event)">
                            <option>--- Choose Package ---</option>
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
                            <option value="Others1">Others</option>
                        </select>
                        <div id="inputOthers">

                        </div>
                    </div>
                    <br />
                    <h5 style="font-weight:bold">Data Teacher</h5>
                    <hr>
                    <div class="form-group">
                        <label for="id_teacher">Teacher Name</label><br>
                        <select class="form-control select-form" style="width:100%;" name="id_teacher">
                            <option>--- Choose Teacher ---</option>
                            <?php foreach ($teacher as $t) : ?>
                                <option value="<?= $t['id_teacher'] ?>"><?= $t['name_teacher'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group hiden">
                        <label for="">Duration</label>
                        <input type="text" class="form-control" readonly id="duration" name="duration">
                    </div>
                    <div class="form-group">
                        <label for="pack_theory">Teacher Fee Percentage</label>
                        <input type="number" class="form-control" id="teacher_percentage" value="0" required name="teacher_percentage">
                    </div>
                    <div class="form-group">
                        <label for="total_discount_rate">Potongan Fee Percentage</label>
                        <input type="number" class="form-control" id="total_discount_rate" value="0" required name="total_discount_rate">
                        <!-- <select class="form-control select-form" style="width:100%;" name="total_discount_rate">
                            <option>--- Pilihan Potongan ---</option>
                            <option value="0">Tidak ada potongan</option>
                            <option value="4">4 potongan</option>
                            <option value="10">10 potongan</option>
                        </select> -->
                    </div>

                    <br />
                    <h5 style="font-weight:bold">Data Package</h5>
                    <hr>
                    <input type="hidden" class="form-control" readonly id="temp_paket" name="temp_paket">
                    <input type="hidden" class="form-control" value="0" readonly id="temp_harga_paket" name="temp_harga_paket">
                    <div>
                        <div class="form-group">
                            <label for="created_at">Purchase Date</label>
                            <input type="date" class="form-control" id="created_at" required name="created_at">
                        </div>
                    </div>

                    <div id="check_practical_pack" class="form-group">
                        <label style="font-weight:bold" for="pack_pratical">Detail of Package</label>
                        <br>
                        Total Package
                        <input type="number" class="form-control" id="total_package" required name="total_package">
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
                        <label for="temp_rate">Rate</label>
                        <input type="text" class="form-control" readonly id="temp_rate_rupiah" name="temp_rate_rupiah">
                        <input type="hidden" class="form-control" readonly id="temp_rate" name="rate_package">
                    </div>
                    <div class="form-group">
                        <label for="discount">Discount</label>
                        <input type="text" class="form-control" id="discount_rupiah" name="discount_rupiah" value="0">
                        <input type="hidden" class="form-control" id="discount" name="discount" value="0">
                        <small>Percentage (%)</small>
                    </div>
                    <div class="form-group">
                        <label for="rate">Total Price</label>
                        <input type="text" class="form-control" readonly id="rate_rupiah" name="rate_rupiah">
                        <input type="hidden" class="form-control" readonly id="rate" name="rate">
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

    function studentIdFunc(e) {
        var temp_val = e.target.value;
        document.getElementById("temp_id_student").value = temp_val;
        $.ajax({
            url: "<?= base_url('portal/C_Admin/getDataPaket') ?>",
            dataType: "JSON",
            type: "POST",
            data: {
                'id_student': temp_val,
                'tipe': "Offline",
            },
            success: function(data) {
                console.log(data);
                let html = "<option>--- Choose Package ---</option>";
                if (data.length > 0) {
                    paketFunction(`${data[0].id_paket}&${data[0].price_idr}&${data[0].price_dollar}&${data[0].price_euro}&${data[0].duration}`);
                    html = "";
                }
                for (let i = 0; i < data.length; i++) {
                    const element = data[i];
                    html += `<option value="${data[i].id_paket}&${data[i].price_idr}&${data[i].price_dollar}&${data[i].price_euro}&${data[i].duration}">${data[i].name_paket}</option>`
                }
                $('#paket').html(html);
            }
        });
        $.ajax({
            url: "<?= base_url('portal/C_Admin/getDataFeePercentage') ?>",
            dataType: "JSON",
            type: "POST",
            data: {
                'id_student': temp_val,
            },
            success: function(data) {
                console.log(data)
                document.getElementById("teacher_percentage").value = data;
            }
        });
    }

    function paketFunction(e) {
        var temp_val = e;
        console.log(temp_val);

        //reset 0
        var reset = 0;
        document.getElementById("duration").value = "";
        document.getElementById("total_package").value = reset;
        document.getElementById("temp_rate_rupiah").value = formatRupiah(String(reset));
        document.getElementById("temp_rate").value = reset;
        document.getElementById("temp_harga_paket").value = reset;
        document.getElementById('discount').value = reset;
        document.getElementById("rate_rupiah").value = formatRupiah(String(reset));
        document.getElementById("rate").value = reset;

        console.log(temp_val.split('&')[4])
        let durationTemp = "-";
        if (temp_val.split('&')[4] !== 'null') {
            durationTemp = temp_val.split('&')[4] + "'";
        }
        document.getElementById("duration").value = durationTemp;
        document.getElementById("temp_paket").value = temp_val.split('&')[0];
        var jmlhPaket = document.getElementById("total_package").value;

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
        document.getElementById("temp_rate_rupiah").value = formatRupiah(String(temp));
        document.getElementById("temp_rate").value = temp;
        document.getElementById("temp_harga_paket").value = temp_harga_paket;
        document.getElementById("rate_rupiah").value = formatRupiah(String(temp - discount));
        document.getElementById("rate").value = temp - discount;
    }

    function paketIdFunc(e) {
        var temp_val = e.target.value;
        console.log(temp_val);

        //reset 0
        var reset = 0;
        document.getElementById("duration").value = "";
        document.getElementById("total_package").value = reset;
        document.getElementById("temp_rate_rupiah").value = formatRupiah(String(reset));
        document.getElementById("temp_rate").value = reset;
        document.getElementById("temp_harga_paket").value = reset;
        document.getElementById('discount').value = reset;
        document.getElementById("rate_rupiah").value = formatRupiah(String(reset));
        document.getElementById("rate").value = reset;

        console.log(temp_val.split('&')[4])
        let durationTemp = "-";
        if (temp_val.split('&')[4] !== 'null') {
            durationTemp = temp_val.split('&')[4] + "'";
        }
        document.getElementById("duration").value = durationTemp;
        document.getElementById("temp_paket").value = temp_val.split('&')[0];
        var jmlhPaket = document.getElementById("total_package").value;

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
        document.getElementById("temp_rate_rupiah").value = formatRupiah(String(temp));
        document.getElementById("temp_rate").value = temp;
        document.getElementById("temp_harga_paket").value = temp_harga_paket;
        document.getElementById("rate_rupiah").value = formatRupiah(String(temp - discount));
        document.getElementById("rate").value = temp - discount;
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

    var total_package = document.getElementById('total_package');
    total_package.addEventListener('keyup', function(e) {
        var persentase = document.getElementById('discount').value;
        var temp_harga_paket = document.getElementById("temp_harga_paket").value;

        let totPaket = temp_harga_paket * total_package.value;
        let discount = (totPaket * persentase / 100);

        document.getElementById("temp_rate_rupiah").value = formatRupiah(String(totPaket));
        document.getElementById("temp_rate").value = totPaket;
        document.getElementById("rate_rupiah").value = formatRupiah(String(totPaket - discount));
        document.getElementById("rate").value = totPaket - discount;

    });

    var discount_rupiah = document.getElementById('discount_rupiah');
    var discount = document.getElementById('discount');
    var temp_rate = document.getElementById('temp_rate');
    var valuee2 = '';
    discount_rupiah.addEventListener('keyup', function(e) {
        discount_rupiah.value = formatRupiah(this.value);
        valuee2 = discount_rupiah.value;
        discount.value = valuee2.split('.').join("");

        let persentase = temp_rate.value - (temp_rate.value * discount.value / 100);

        document.getElementById("rate_rupiah").value = formatRupiah(String(persentase));
        document.getElementById("rate").value = persentase;
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