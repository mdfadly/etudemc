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
                <a href="<?= site_url() ?>portal/book/input" class="btn btn-primary">
                    <i class="fa fa-angle-left"></i> Back
                </a>
            </span>
            <span style="float:right;">

            </span>
        </div>

        <hr>
        <h2 style="font-weight:bold">Add Purchase Book</h2>
        <div class="row">
            <div class="col-lg-12 col-12 mt-4">
                <form action="<?= site_url('portal/C_Admin/add_data_book_purchase') ?>" method="POST">
                    <?php date_default_timezone_set("Asia/Jakarta"); ?>
                    <input type="hidden" class="form-control" value="<?= date('Y-m-d H:i:s') ?>" name="date" readonly>
                    <div class="form-group">
                        <label for="title">Book Title</label>
                        <input type="text" class="form-control" id="title" required name="title">
                    </div>
                    <div class="form-group">
                        <label for="publisher">Publisher</label>
                        <input type="text" class="form-control" id="publisher" required name="publisher">
                    </div>
                    <div class="form-group">
                        <label for="qty">Qty</label>
                        <input type="number" class="form-control" value="1" id="qty" required name="qty">
                    </div>
                    <div class="form-group">
                        <label for="distributor">Distributor</label>
                        <select class="form-control" style="width:100%;" name="distributor" id="distributor" onchange="distributorFunc(event)">
                            <option value="Quatro Store">Quatro Store</option>
                            <option value="Others">Others</option>
                        </select>
                        <div id="inputOthers">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="distributor_price">Distributor Price</label>
                        <input type="text" class="form-control" id="rupiah" />
                        <input type="hidden" class="form-control" id="distributor_price" name="distributor_price">
                    </div>
                    <div id="sellingPrice" class="form-group">
                        <label for="selling_price">Selling Price</label>
                        <input type="text" class="form-control" id="rupiah3" />
                        <input type="hidden" class="form-control" id="selling_price" name="selling_price">
                    </div>
                    <div class="form-group">
                        <label for="shipping_rate">Shipping Price</label>
                        <input type="text" class="form-control" id="rupiah2" />
                        <input type="hidden" class="form-control" id="shipping_rate" name="shipping_rate">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Order</button>
                </form>
            </div>
        </div>
    </div>
</main>
<script src="<?= base_url('assets/js/jquery-3.4.0.min.js'); ?>"></script>
<script>
    var distributor_price = document.getElementById('distributor_price');
    var rupiah = document.getElementById('rupiah');
    var valuee = '';
    rupiah.addEventListener('keyup', function(e) {
        rupiah.value = formatRupiah(this.value);
        valuee = rupiah.value;
        distributor_price.value = valuee.split('.').join("");
        var distributor = document.getElementById('distributor').value;
        if (distributor === "Others") {
            var selling_price = document.getElementById('selling_price');
            var rupiah3 = document.getElementById('rupiah3');
            let rumus = parseInt(distributor_price.value) + 10000 + (parseInt(distributor_price.value) * 10 / 100) + 15000;
            rupiah3.value = formatRupiah(rumus.toString());
            selling_price.value = rumus;
        }
    });

    var selling_price = document.getElementById('selling_price');
    var rupiah3 = document.getElementById('rupiah3');
    var valuee3 = '';
    rupiah3.addEventListener('keyup', function(e) {
        rupiah3.value = formatRupiah(this.value);
        valuee3 = rupiah3.value;
        selling_price.value = valuee3.split('.').join("");
    });

    var shipping_rate = document.getElementById('shipping_rate');
    var rupiah2 = document.getElementById('rupiah2');
    var valuee2 = '';
    rupiah2.addEventListener('keyup', function(e) {
        rupiah2.value = formatRupiah(this.value);
        valuee2 = rupiah2.value;
        shipping_rate.value = valuee2.split('.').join("");
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
<script>
    $(document).ready(function() {
        $('.select-form').select2();
    });

    function distributorFunc(e) {
        var temp_val = e.target.value;
        console.log(temp_val);
        var distributor_price = document.getElementById('distributor_price').value;
        var selling_price = document.getElementById('selling_price');
        var rupiah3 = document.getElementById('rupiah3');
        let rumus = 0;
        if (temp_val === 'Others') {
            var new_input = `<input type="text" class="form-control" placeholder="input other distributor" id="others" required name="others">`;
            $('#inputOthers').append(new_input);

            $('#rupiah3').prop('readonly', true);

            rumus = parseInt(distributor_price) + 10000 + (parseInt(distributor_price) * 10 / 100) + 15000;
        } else {
            $('#others').remove();
            $('#rupiah3').prop('readonly', false);
            rumus = 0;
        }
        rupiah3.value = formatRupiah(rumus.toString());
        selling_price.value = rumus;
    }
</script>