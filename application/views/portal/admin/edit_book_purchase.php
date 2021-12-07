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
        <h2 style="font-weight:bold">Edit Purchase Book</h2>
        <div class="row">
            <div class="col-lg-12 col-12 mt-4">
                <form action="<?= site_url('portal/C_Admin/edit_data_book_purchase') ?>" method="POST">
                    <?php date_default_timezone_set("Asia/Jakarta"); ?>
                    <!-- <input type="hidden" class="form-control" value="<?= date('Y-m-d H:i:s') ?>" name="date" readonly> -->
                    <div class="form-group">
                        <label for="title">Book Title</label>
                        <input type="text" class="form-control" id="title" required value="<?= $book_purchase[0]['title'] ?>" name="title">
                        <input type="hidden" required class="form-control" id="id_purchase" value="<?= $book_purchase[0]['id_purchase'] ?>" required name="id_purchase">
                    </div>
                    <div class="form-group">
                        <label for="publisher">Publisher</label>
                        <input type="text" class="form-control" id="publisher" required name="publisher" value="<?= $book_purchase[0]['publisher'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="qty">Qty</label>
                        <input type="number" class="form-control" id="qty" required value="<?= $book_purchase[0]['qty'] ?>" name="qty">
                    </div>
                    <div>
                        <!-- Stock before -->
                        <input type="hidden" required class="form-control" id="id_book" value="<?= $book_stock[0]['id_book'] ?>" required name="id_book">
                        <input type="hidden" class="form-control" id="title_stock" required name="title_stock" value="<?= $book_stock[0]['title'] ?>">
                        <input type="hidden" class="form-control" id="publisher_stock" required name="publisher_stock" value="<?= $book_stock[0]['publisher'] ?>">
                        <input type="hidden" class="form-control" id="qty_stock" required value="<?= (intval($book_stock[0]['qty']) - intval($book_purchase[0]['qty'])) ?>" name="qty_stock">
                        <input type="hidden" class="form-control" id="distributor_stock" required name="distributor_stock" value="<?= $book_stock[0]['distributor'] ?>">
                        <input type="hidden" class="form-control" id="distributor_price_stock" required name="distributor_price_stock" value="<?= $book_stock[0]['distributor_price'] ?>">
                        <input type="hidden" class="form-control" id="selling_price_stock" required name="selling_price_stock" value="<?= $book_stock[0]['selling_price'] ?>">
                        <input type="hidden" class="form-control" id="shipping_rate_stock" required name="shipping_rate_stock" value="<?= $book_stock[0]['shipping_rate'] ?>">
                        <!-- end stock before -->
                    </div>
                    <div class="form-group">
                        <label for="distributor">Distributor</label>
                        <select class="form-control" style="width:100%;" name="distributor" id="distributor" onchange="distributorFunc(event)">
                            <option value="Partner Store">Partner Store</option>
                            <option value="Others">Others</option>
                        </select>
                        <div id="inputOthers">

                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label for="distributor">Distributor</label>
                        <input type="text" class="form-control" id="distributor" required value="<?= $book_purchase[0]['distributor'] ?>" name="distributor">
                    </div> -->
                    <div class="form-group">
                        <label for="distributor_price">Distributor Price</label>
                        <input type="text" class="form-control" id="rupiah" value="<?= $book_purchase[0]['distributor_price'] ?>" />
                        <input type="hidden" class="form-control" id="distributor_price" name="distributor_price">
                    </div>
                    <div class="form-group">
                        <label for="selling_price">Selling Price</label>
                        <input type="text" class="form-control" id="rupiah3" value="<?= $book_purchase[0]['selling_price'] ?>" />
                        <input type="hidden" class="form-control" id="selling_price" name="selling_price">
                    </div>
                    <div class="form-group">
                        <label for="shipping_rate">Shipping Price</label>
                        <input type="text" class="form-control" id="rupiah2" value="<?= $book_purchase[0]['shipping_rate'] ?>" />
                        <input type="hidden" class="form-control" id="shipping_rate" name="shipping_rate">
                    </div>
                    <div class="form-group">
                        <label for="receive">Receive Date</label>
                        <input type="date" class="form-control" id="receive" name="receive" value="<?= substr($book_purchase[0]['receive'], 0, 10) ?>" />
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                </form>
            </div>
        </div>
    </div>
</main>
<script src="<?= base_url('assets/js/jquery-3.4.0.min.js'); ?>"></script>
<script>
    $(document).ready(function() {
        $('.select-form').select2();

        distributor_temp = '<?= $book_purchase[0]['distributor'] ?>';
        if (distributor_temp.split('|')[0] === 'Others') {
            document.getElementById("distributor").value = 'Others';
            var new_input = `<input type="text" class="form-control" placeholder="input other distributor" id="others" required name="others" value="` + distributor_temp.split('|')[1] + `">`;
            $('#inputOthers').append(new_input);
        } else {
            document.getElementById("distributor").value = '<?= $book_purchase[0]['distributor'] ?>';
        }

        var distributor_price = document.getElementById('distributor_price');
        var rupiah = document.getElementById('rupiah');
        distributor_price.value = rupiah.value;
        rupiah.value = formatRupiah(rupiah.value);

        var selling_price = document.getElementById('selling_price');
        var rupiah3 = document.getElementById('rupiah3');
        selling_price.value = rupiah3.value;
        rupiah3.value = formatRupiah(rupiah3.value);

        var shipping_rate = document.getElementById('shipping_rate');
        var rupiah2 = document.getElementById('rupiah2');
        shipping_rate.value = rupiah2.value;
        rupiah2.value = formatRupiah(rupiah2.value);
    });
</script>
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
    var valuee = '';
    rupiah2.addEventListener('keyup', function(e) {
        rupiah2.value = formatRupiah(this.value);
        valuee = rupiah2.value;
        shipping_rate.value = valuee.split('.').join("");
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