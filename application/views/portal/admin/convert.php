<style>
    .btn-add-order {
        background-color: #263850;
        color: white;
        font-size: 12px;
    }

    .btn-add-order:hover {
        background-color: #0676BD;
        color: white;
    }
</style>
<main class="page-content">
    <div class="container-fluid">
        <h2>Convert to Rupiah</h2>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <?php if ($this->session->flashdata('success') != null) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= $this->session->flashdata('success') ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-12 col-12">
                <div class="mt-3">
                    <div class="card">
                        <div class="card-body">
                            <h5>Dollar</h5>
                            <?php if (count($dollar) > 0) { ?>
                                <p>Periode: <strong><?= date_format(date_create($dollar[0]['created_at']), "j M Y") ?></strong> - Now</p>
                            <?php } ?>
                            <div class="input-group mb-3">
                                <input type="text" readonly value="USD 1" class="form-control" />
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">IDR</span>
                                <input type="text" class="form-control" id="dollar_to_rupiah" />
                                <button class="btn btn-primary" type="button" id="btn_convert_dollar">Update</button>
                            </div>
                            <input type="hidden" class="form-control" id="price_dollar" name="value" value='<?= count($dollar) > 0 ? $dollar[0]['value'] : "0" ?>' placeholder="Input Your Nominal">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-12">
                <div class="mt-3">
                    <div class="card">
                        <div class="card-body">
                            <h5>Euro</h5>
                            <?php if (count($euro) > 0) { ?>
                                <p>Periode: <strong><?= date_format(date_create($euro[0]['created_at']), "j M Y") ?></strong> - Now</p>
                            <?php } ?>
                            <div class="input-group mb-3">
                                <input type="text" readonly value="EUR 1" class="form-control" />
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">IDR</span>
                                <input type="text" class="form-control" id="euro_to_rupiah" />
                                <button class="btn btn-primary" type="button" id="btn_convert_euro">Update</button>
                            </div>
                            <input type="hidden" class="form-control" id="price_euro" name="value" value='<?= count($euro) > 0 ? $euro[0]['value'] : "0" ?>' placeholder="Input Your Nominal">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="<?= base_url('assets/js/jquery-3.4.0.min.js'); ?>"></script>
<script>
    $(document).ready(function() {
        var price_dollar = document.getElementById('price_dollar');
        var dollar_to_rupiah = document.getElementById('dollar_to_rupiah');
        dollar_to_rupiah.value = price_dollar.value;
        dollar_to_rupiah.value = formatConvertDollar(dollar_to_rupiah.value);
        //euro
        var price_euro = document.getElementById('price_euro');
        var euro_to_rupiah = document.getElementById('euro_to_rupiah');
        euro_to_rupiah.value = price_euro.value;
        euro_to_rupiah.value = formatConvertEuro(euro_to_rupiah.value);
    });
    $("#btn_convert_dollar").on('click', function() {
        $.ajax({
            type: "POST",
            url: '<?= site_url() ?>portal/C_Admin/updateConvert/dollar',
            data: {
                "value": document.getElementById("price_dollar").value,
            },
            success: function(data) {
                alert("Update Successfully!");
            }
        });
    });
    $("#btn_convert_euro").on('click', function() {
        $.ajax({
            type: "POST",
            url: '<?= site_url() ?>portal/C_Admin/updateConvert/euro',
            data: {
                "value": document.getElementById("price_euro").value,
            },
            success: function(data) {
                alert("Update Successfully!");
            }
        });
    });
</script>
<script>
    var price_dollar = document.getElementById('price_dollar');
    var dollar_to_rupiah = document.getElementById('dollar_to_rupiah');
    var valuee = '';
    dollar_to_rupiah.addEventListener('keyup', function(e) {
        dollar_to_rupiah.value = formatConvertDollar(this.value);
        valuee = dollar_to_rupiah.value;
        price_dollar.value = valuee.split('.').join("");
    });

    function formatConvertDollar(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            dollar_to_rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            dollar_to_rupiah += separator + ribuan.join('.');
        }

        dollar_to_rupiah = split[1] != undefined ? dollar_to_rupiah + ',' + split[1] : dollar_to_rupiah;
        return prefix == undefined ? dollar_to_rupiah : (dollar_to_rupiah ? 'Rp. ' + dollar_to_rupiah : '');
    }
</script>
<script>
    var price_euro = document.getElementById('price_euro');
    var euro_to_rupiah = document.getElementById('euro_to_rupiah');
    var valuee = '';
    euro_to_rupiah.addEventListener('keyup', function(e) {
        euro_to_rupiah.value = formatConvertEuro(this.value);
        valuee = euro_to_rupiah.value;
        price_euro.value = valuee.split('.').join("");
    });

    function formatConvertEuro(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            euro_to_rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            euro_to_rupiah += separator + ribuan.join('.');
        }

        euro_to_rupiah = split[1] != undefined ? euro_to_rupiah + ',' + split[1] : euro_to_rupiah;
        return prefix == undefined ? euro_to_rupiah : (euro_to_rupiah ? 'Rp. ' + euro_to_rupiah : '');
    }
</script>