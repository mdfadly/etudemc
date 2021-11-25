<main class="page-content">
    <div class="container-fluid">
        <?php $date = date_create($this->uri->segment(5)); ?>
        <h2>Summary Invoice</h2>
        <h5>
            Offline Lesson
        </h5>
        <p>
            (<?= date_format($date, "F - Y") ?>)
        </p>
        <hr>
        <div class="row">
            <div class="col-lg-4">
                <a href="<?= site_url() ?>portal/invoice/offline" class="btn btn-primary">
                    <i class="fa fa-angle-left"></i> Back
                </a>
                <span class="ml-2 mr-2">|</span>
                <button class="btn btn-success" style="font-size:12px"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php if ($this->session->flashdata('success') != null) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= $this->session->flashdata('success') ?>
                    </div>
                <?php endif; ?>
            </div>
            <br>
            <div class="col-lg-12 col-12">
                <div class="mt-3">
                    <table id="example" cellpadding="0" cellspacing="0" class="table table-bordered table-white table-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID Parent</th>
                                <th>Parent</th>
                                <th>Teacher</th>
                                <th>Student</th>
                                <th>Lesson Date</th>
                                <th>Total Pack</th>
                                <th>Price/Pack</th>
                                <th>Total Price</th>
                                <th>Others</th>
                                <th>Total Invoice</th>
                                <th>Payment Date</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody id="show_data">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="<?= base_url('assets/js/jquery-3.4.0.min.js'); ?>"></script>

<script>
    $(document).ready(function() {
        show_data();
        // var table = $('#example').DataTable();
    });


    function show_data() {
        $.ajax({
            url: "<?= base_url() ?>portal/C_Admin/get_data_invoice_summary",
            data: {
                "periode": "<?= $this->uri->segment(5) ?>",
            },
            success: function(data) {
                $("#show_data").html(data);
                // console.log($('#count_data').text());
                var count_data = $('#count_data').text();
                for (i = 0; i < count_data; i++) {
                    // console.log($('#temp_lah' + i).text());
                    $('#tot_lah' + i).append(formatRupiah($('#temp_lah' + i).text(), 'Rp.'));
                }
                // table = $('#example').DataTable({
                //     "searching": false,
                //     "paging": false,
                //     "ordering": false,
                //     "info": false,
                //     lengthChange: false,
                //     buttons: ['print', 'excel', 'pdf', 'colvis'],
                // });
            },
            complete: function() {
                // table.buttons().container()
                //     .appendTo('#example_wrapper .col-md-6:eq(0)');
            }
        });
    }

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp.' + rupiah : '');
    }
</script>