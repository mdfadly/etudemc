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
                <a href="<?= site_url() ?>portal/book/sell" class="btn btn-primary">
                    <i class="fa fa-angle-left"></i> Back
                </a>
            </span>
            <span style="float:right;">

            </span>
        </div>

        <hr>
        <h2 style="font-weight:bold">Add Sell Book</h2>
        <div class="row">
            <div class="col-lg-12 col-12 mt-4">
                <form action="<?= site_url('portal/C_Admin/add_data_book_order') ?>" method="POST">
                    <?php date_default_timezone_set("Asia/Jakarta"); ?>
                    <input type="hidden" class="form-control" value="<?= date('Y-m-d H:i:s') ?>" name="tgl_order" readonly>
                    <div class="form-group">
                        <label for="name_student">Student Name</label><br>
                        <select class="form-control select-form" style="width:100%;" name="id_student" required>
                            <option value="">Choose</option>
                            <?php foreach ($student as $s) : ?>
                                <option value="<?= $s['id_student'] ?>">
                                    <?= $s['name_student'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Book Title</label><br>
                        <select class="form-control select-form" style="width:100%;" name="" required onchange="myFunction(event)">
                            <option value="">Choose</option>
                            <?php foreach ($book as $s) : ?>
                                <option value="<?= $s['id_book'] ?>-<?= $s['distributor_price'] ?>-<?= $s['qty'] ?>-<?= $s['selling_price'] ?>">
                                    <?= $s['title'] ?> | <?= $s['publisher'] ?> | <?= $s['selling_price'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="qty">Qty</label>
                        <input type="number" min="1" class="form-control" value="1" id="qty" required name="qty">
                        <span id="setMax"></span>
                    </div>
                    <div class="form-group hiden">
                        <label for="distributor_price">Distributor Price</label>
                        <input type="text" readonly class="form-control" id="temp_distributor_price">
                        <input type="hidden" readonly class="form-control" id="distributor_price" required name="distributor_price">
                    </div>
                    <input type="hidden" readonly class="form-control" id="id_book" required name="id_book">

                    <input type="hidden" readonly class="form-control" id="qty_before" required name="qty_before">
                    <div class="form-group">
                        <label for="selling_price">Book Price</label>
                        <input type="text" readonly class="form-control" id="selling_price_rupiah" required name="selling_price_rupiah">
                        <input type="hidden" readonly class="form-control" id="selling_price" required name="selling_price">
                    </div>
                    <div class="form-group">
                        <label for="shipping_price">Shipping Price</label>
                        <input type="text" class="form-control" id="shipping_price_rupiah" name="shipping_price_rupiah" value="0">
                        <input type="hidden" class="form-control" id="shipping_price" name="shipping_price" value="0">
                    </div>
                    <div class="form-group">
                        <label for="discount">Discount</label>
                        <input type="text" class="form-control" id="discount_rupiah" name="discount_rupiah" value="0">
                        <input type="hidden" class="form-control" id="discount" name="discount" value="0">
                        <small>Percentage (%)</small>
                    </div>
                    <div class="form-group">
                        <label for="price">Total Price</label>
                        <input type="text" readonly class="form-control" id="temp_price">
                        <input type="hidden" readonly class="form-control" id="price" required name="price">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Order</button>
                </form>
            </div>
        </div>
    </div>
</main>
<script src="<?= base_url('assets/js/jquery-3.4.0.min.js'); ?>"></script>
<script>
    function myFunction(e) {
        var temp_val = e.target.value;
        var temp2 = temp_val.split('-')[0];
        document.getElementById("id_book").value = temp2;

        var temp3 = temp_val.split('-')[2];
        document.getElementById("qty").max = temp3;
        document.getElementById("setMax").innerHTML = "<small>Max Quantity: " + temp3 + "</small>";
        document.getElementById("qty_before").value = temp3;

        var temp = temp_val.split('-')[1];
        document.getElementById("temp_distributor_price").value = "Rp " + formatRupiah(temp);
        document.getElementById("distributor_price").value = temp;

        var selling_price = temp_val.split('-')[3];
        document.getElementById("selling_price").value = selling_price;
        document.getElementById("selling_price_rupiah").value = formatRupiah(selling_price.toString());

        let qty = document.getElementById("qty").value;
        var discount = $('#discount').val();
        var shipping_price = $('#shipping_price').val();

        let total_price_book = (parseInt(selling_price) * parseInt(qty));
        let persentase = parseInt(total_price_book) - (parseInt(total_price_book) * discount / 100);
        var temp_price = persentase + parseInt(shipping_price);

        $('#temp_price').val('Rp ' + formatRupiah(String(temp_price)));
        $('#price').val(temp_price);
    }

    var qty = document.getElementById('qty');
    qty.addEventListener('keyup', function(e) {
        var temp = document.getElementById("distributor_price").value;
        temp *= this.value;
        var total = (parseInt(temp) * 10 / 100) + 70000 + parseInt(temp);

        var selling_price = document.getElementById("selling_price").value;
        let rumus = parseInt(selling_price) * parseInt(this.value);
        var discount = $('#discount').val();
        var shipping_price = $('#shipping_price').val();

        let persentase = parseInt(rumus) - (parseInt(rumus) * discount / 100);
        var temp_price = persentase + parseInt(shipping_price);

        $('#temp_price').val('Rp ' + formatRupiah(String(temp_price)));
        $('#price').val(temp_price);
    });

    var shipping_price_rupiah = document.getElementById('shipping_price_rupiah');
    var shipping_price = document.getElementById('shipping_price');
    var valuee = '';
    shipping_price_rupiah.addEventListener('keyup', function(e) {
        shipping_price_rupiah.value = formatRupiah(this.value);
        valuee = shipping_price_rupiah.value;
        shipping_price.value = valuee.split('.').join("");

        var qty = $('#qty').val();
        var selling_price = $('#selling_price').val();
        var discount = $('#discount').val();

        let total_price_book = (parseInt(selling_price) * parseInt(qty));
        let persentase = parseInt(total_price_book) - (parseInt(total_price_book) * discount / 100);
        var temp_price = persentase + parseInt(shipping_price.value);

        $('#temp_price').val('Rp ' + formatRupiah(String(temp_price)));
        $('#price').val(temp_price);
    });

    var discount_rupiah = document.getElementById('discount_rupiah');
    var discount = document.getElementById('discount');
    var valuee = '';
    discount_rupiah.addEventListener('keyup', function(e) {
        discount_rupiah.value = formatRupiah(this.value);
        valuee = discount_rupiah.value;
        discount.value = valuee.split('.').join("");

        var qty = $('#qty').val();
        var selling_price = $('#selling_price').val();
        var shipping_price = $('#shipping_price').val();

        let total_price_book = (parseInt(selling_price) * parseInt(qty));
        let persentase = parseInt(total_price_book) - (parseInt(total_price_book) * discount.value / 100);
        var temp_price = persentase + parseInt(shipping_price);

        $('#temp_price').val('Rp ' + formatRupiah(String(temp_price)));
        $('#price').val(temp_price);
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
</script>