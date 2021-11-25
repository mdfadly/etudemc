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
        <h2 style="font-weight:bold">Edit Sell Book</h2>
        <div class="row">
            <div class="col-lg-12 col-12 mt-4">
                <form action="<?= site_url('portal/C_Admin/edit_data_book_order') ?>" method="POST">
                    <input type="hidden" required class="form-control" id="id_order" value="<?= $book_order[0]['id_order'] ?>" required name="id_order">
                    <div class="form-group">
                        <label for="name_student">Student Name</label><br>
                        <input type="text" readonly class="form-control" value="<?= $book_order[0]['name_student'] ?>">
                        <!-- <select id="id_student" class="form-control select-form" style="width:100%;" name="id_student">
                            <option value="<?= $book_order[0]['id_student'] ?>"><?= $book_order[0]['name_student'] ?></option>
                            <?php foreach ($student as $s) : ?>
                                <option value="<?= $s['id_student'] ?>">
                                    <?= $s['name_student'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select> -->
                    </div>
                    <div class="form-group">
                        <label for="title">Book Title</label><br>
                        <input type="text" readonly class="form-control" value="<?= $book_order[0]['title'] ?>">
                        <!-- <select id="title_book" class="form-control select-form" style="width:100%;" name="" onchange="myFunction(event)">
                            <option value="<?= $book_order[0]['id_book'] ?>-<?= $book_order[0]['distributor_price'] ?>-<?= $book_order[0]['qty_before'] ?>"><?= $book_order[0]['title'] ?></option>
                            <?php foreach ($book as $s) : ?>
                                <option value="<?= $s['id_book'] ?>-<?= $s['distributor_price'] ?>-<?= $s['qty'] ?>">
                                    <?= $s['title'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select> -->
                    </div>
                    <div class="form-group">
                        <label for="qty">Qty</label>
                        <input type="number" min="1" readonly class="form-control" value="<?= $book_order[0]['qty'] ?>" id="qty" required name="qty">
                        <span id="setMax"></span>
                    </div>

                    <div class="form-group">
                        <label for="distributor_price">Selling Price</label>
                        <input type="number" min="1" readonly class="form-control" value="<?= number_format($book_order[0]['selling_price'], 0, ".", ".") ?>" id="selling_price" required name="selling_price">
                        <input type="hidden" readonly class="form-control" id="temp_distributor_price">
                        <input type="hidden" readonly class="form-control" id="distributor_price" required name="distributor_price">
                        <input type="hidden" readonly class="form-control" id="id_book" required name="id_book">
                        <input type="hidden" readonly class="form-control" id="qty_before" required name="qty_before">
                    </div>
                    <!-- <?= var_dump($book_order[0]) ?> -->
                    <div class="form-group">
                        <label for="shipping_price">Shipping Price</label>
                        <input type="number" min="1" readonly class="form-control" value="<?= number_format($book_order[0]['shipping_price'], 0, ".", ".") ?>" id="shipping_price" required name="shipping_price">
                    </div>
                    <div class="form-group">
                        <label for="discount">Discount</label>
                        <input type="number" min="1" readonly class="form-control" value="<?= number_format($book_order[0]['discount'], 0, ".", ".") ?>" id="discount" required name="discount">
                    </div>
                    <div class="form-group">
                        <label for="price">Total Price</label>
                        <input type="number" min="1" readonly class="form-control" value="<?= number_format($book_order[0]['price'], 0, ".", ".") ?>" required name="price">
                        <!-- <input type="text" readonly class="form-control" id="temp_price">
                        <input type="hidden" readonly class="form-control" id="price" required name="price"> -->
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" class="form-control" name="status">
                            <?php if ($book_order[0]['status'] == 1) : ?>
                                <option value="<?= $book_order[0]['status'] ?>">
                                    Order
                                </option>
                            <?php endif; ?>
                            <?php if ($book_order[0]['status'] == 2) : ?>
                                <option value="<?= $book_order[0]['status'] ?>">Sent</option>
                            <?php endif; ?>
                            <?php if ($book_order[0]['status'] == 3) : ?>
                                <option value="<?= $book_order[0]['status'] ?>">Received</option>
                            <?php endif; ?>
                            
                            <option value="1">Order</option>
                            <option value="2">Sent</option>
                            <option value="3">Received</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tgl_send">Sent Date</label>
                        <input type="date" value="<?= substr($book_order[0]['tgl_send'], 0, 10) ?>" class="form-control" id="tgl_send" name="tgl_send">
                    </div>
                    <div class="form-group">
                        <label for="tgl_terima">Receive Date</label>
                        <input type="date" value="<?= substr($book_order[0]['tgl_terima'], 0, 10) ?>" class="form-control" id="tgl_terima" name="tgl_terima">
                    </div>
                    <div class="form-group">
                        <label for="penerima">Receiver</label>
                        <input type="text" value="<?= $book_order[0]['penerima'] ?>" class="form-control" id="penerima" name="penerima">
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

        <?php if ($book_order[0]['status'] != '1') : ?>
            $('#title_book').attr('disabled', true);
            $('#id_student').attr('disabled', true);
            $('#qty').attr('readonly', true);
        <?php endif; ?>
        <?php if ($book_order[0]['status'] == '3') : ?>
            $('#tgl_send').attr('readonly', true);
            $('#status').attr('disabled', true);
        <?php endif; ?>


        var temp_val = "<?= $book_order[0]['id_book'] ?>-<?= $book_order[0]['distributor_price'] ?>-<?= $book_order[0]['qty_before'] ?>";
        var temp2 = temp_val.split('-')[0];
        document.getElementById("id_book").value = temp2;

        var temp3 = temp_val.split('-')[2];
        tc = <?= $book_order[0]['qty'] ?>;
        temp3_count = parseInt(temp3) + tc;
        document.getElementById("qty").max = temp3_count;
        document.getElementById("qty_before").value = temp3_count;
        <?php if ($book_order[0]['status'] == '1') : ?>
            document.getElementById("setMax").innerHTML = "<small>Max Quantity: " + temp3_count + "</small>";
        <?php endif; ?>
        var temp = temp_val.split('-')[1];
        document.getElementById("temp_distributor_price").value = "Rp " + formatRupiah(temp);
        document.getElementById("distributor_price").value = temp;

        var total = (parseInt(temp) * 10 / 100) + 70000 + parseInt(temp);
        document.getElementById("price").value = total;
        document.getElementById("temp_price").value = "Rp " + formatRupiah(total.toString());

        var temp4 = document.getElementById("distributor_price").value;
        temp4 *= <?= $book_order[0]['qty'] ?>;
        var total = (parseInt(temp4) * 10 / 100) + 70000 + parseInt(temp4);
        document.getElementById("price").value = total;
        document.getElementById("temp_price").value = "Rp " + formatRupiah(total.toString());
    });
</script>
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

        var total = (parseInt(temp) * 10 / 100) + 70000 + parseInt(temp);
        document.getElementById("price").value = total;
        document.getElementById("temp_price").value = "Rp " + formatRupiah(total.toString());
    }

    var qty = document.getElementById('qty');
    qty.addEventListener('keyup', function(e) {
        var temp = document.getElementById("distributor_price").value;
        temp *= this.value;
        var total = (parseInt(temp) * 10 / 100) + 70000 + parseInt(temp);
        document.getElementById("price").value = total;
        document.getElementById("temp_price").value = "Rp " + formatRupiah(total.toString());
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