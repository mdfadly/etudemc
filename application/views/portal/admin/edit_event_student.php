<main class="page-content">
    <div class="container-fluid">
        <div class="row">
            <?php if ($this->session->flashdata('warning') != null): ?>
                <div class="col-lg-12">
                    <div class="alert alert-danger" role="alert">
                        <?= $this->session->flashdata('warning') ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div style="text-align:left;">
            <span style="font-family:mReguler; font-size:20px;" class="font-weight-bold">
                <a href="<?= site_url() ?>portal/event/" class="btn btn-primary">
                    <i class="fa fa-angle-left"></i> Back
                </a>
            </span>
            <span style="float:right;">
                <button id="btn_delete" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
            </span>
        </div>

        <hr>
        <h2 style="font-weight:bold">Edit Student Event</h2>
        <div class="row">
            <div class="col-lg-12 col-12 mt-4">
                <div id="modalConfirmation" class="modal fade" id="staticBackdrop" data-backdrop="static"
                    data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>Confirmation Delete</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span aria-hidden="true">×</span> <span class="sr-only">close</span>
                                </button>
                            </div>
                            <div id="modalBody" class="modal-body text-center">
                                <a href="<?= site_url('portal/C_Admin/delete_data_event_student/' . str_replace("/", "-", $event_student[0]['no_transaksi_event'])) ?>" class="btn btn-primary col-lg-5 col-5">
                                    Yes
                                </a>
                                <button id="btn_cancel" class="btn btn-danger col-lg-5 col-5">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="<?= site_url('portal/C_Admin/edit_data_event_student') ?>" method="POST">
                    <input type="hidden" required class="form-control" id="id_transaksi"
                        value="<?= $event_student[0]['id_transaksi'] ?>" required name="id_transaksi">
                    <input type="hidden" required class="form-control" id="no_transaksi_event"
                        value="<?= $event_student[0]['no_transaksi_event'] ?>" required name="no_transaksi_event">
                    <div class="form-group">
                        <label for="name_student">Student Name</label><br>
                        <input type="text" class="form-control" id="name_student" name="name_student" readonly
                            value="<?= $event_student[0]['name_student'] ?>">
                        <input type="hidden" class="form-control" id="id_student" name="id_student"
                            value="<?= $event_student[0]['id_user'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name_event">event Name</label><br>
                        <input type="text" readonly class="form-control" id="event"
                            value="<?= $event_student[0]['event_name'] ?>" />
                    </div>
                    <div class="form-group">
                        <label for="event_date">Event Date</label><br>
                        <input type="date" class="form-control" id="event_date" readonly name="event_date"
                            value="<?= substr($event_student[0]['event_date'], 0, 10); ?>">
                        <input type="hidden" class="form-control" id="id_event" required name="id_event">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" id="total_price_rupiah" name="total_price_rupiah"
                            readonly>
                        <input type="hidden" class="form-control" id="total_price" name="total_price" readonly
                            value="<?= $event_student[0]['price'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="discount">Discount</label>
                        <input type="text" class="form-control" id="discount_rupiah" name="discount_rupiah">
                        <input type="hidden" class="form-control" id="discount" name="discount"
                            value="<?= $event_student[0]['discount'] ?>">
                        <small>Price (Rp)</small>
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
    $(document).ready(function () {
        $('#btn_delete').click(function() {
            $('#modalConfirmation').modal('show');
        });
        $('#btn_cancel').click(function() {
            $('#modalConfirmation').modal('hide');
        });
        $('.select-form').select2();
        document.getElementById("total_price_rupiah").value = 'Rp ' + formatRupiah(String('<?= $event_student[0]['price'] ?>'));
        document.getElementById("discount_rupiah").value = 'Rp ' + formatRupiah(String('<?= $event_student[0]['discount'] ?>'));
        document.getElementById("rate_rupiah").value = 'Rp ' + formatRupiah(String('<?= $event_student[0]['total_price'] ?>'));
        document.getElementById("rate").value = <?= $event_student[0]['total_price'] ?>;
    });
</script>
<script>
    var discount_rupiah = document.getElementById('discount_rupiah');
    var discount = document.getElementById('discount');
    var valuee = '';
    discount_rupiah.addEventListener('keyup', function (e) {
        discount_rupiah.value = formatRupiah(this.value);
        valuee = discount_rupiah.value;
        discount.value = valuee.split('.').join("");

        var total_price = $('#total_price').val();
        // let persentase = parseInt(total_price) - (parseInt(total_price) * discount.value / 100);
        let persentase = parseInt(parseInt(total_price) - discount.value);

        $('#rate_rupiah').val('Rp ' + formatRupiah(String(persentase)));
        $('#rate').val(persentase);
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