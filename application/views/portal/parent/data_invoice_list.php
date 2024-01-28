<style>
    .btn-active {
        border-bottom: 2px solid #62A8D6;
        background-color: white;
        font-size: 0.9rem;
        cursor: text;
    }

    .btn-light {
        font-size: 12px
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
            <?php if ($this->session->flashdata('success') != null) : ?>
                <div class="alert alert-success" role="alert">
                    <?= $this->session->flashdata('success') ?>
                </div>
            <?php endif; ?>
        </div>
        <div style="text-align:left;">
            <span style="font-family:mReguler; font-size:20px;" class="font-weight-bold">
                <a href="<?= site_url() ?>portal/invoice-student" class="btn btn-primary">
                    <i class="fa fa-angle-left"></i> Back
                </a>
            </span>
            <span style="float:right;">

            </span>
        </div>
        <hr>

        <?php $date = date_create($this->uri->segment(4)); ?>
        <?php
        $startdate2 = strtotime($this->uri->segment(4));
        $enddate2 = strtotime("+0 months", $startdate2);
        $temp_date2 =  date("F - Y", $enddate2);
        ?>

        <h2 style="font-weight:bold">Invoice</h2>
        <h5>
            <?= $temp_date2 ?>
        </h5>
        <div class="row">
            <div id="table_offline" class="col-lg-12 col-12" style="">
                <div class="mt-3">
                    <table id="example" cellpadding="0" cellspacing="0" class="table table-striped table-white" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Date</th>
                                <th>No. Invoice</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
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
        $('#example').DataTable({
            "scrollX": true,
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],

            // "responsive": true,
            "searching": false,
            "processing": true,
            "serverSide": true,

            "ajax": {
                "url": "<?= site_url('portal/C_Parent/get_ajax_sirkulasi/' . $this->uri->segment(4)) ?>",
                "type": "POST",
            },
            'columnDefs': [{
                'targets': [2, 3], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
            }, {
                targets: 3,
                "className": "text-center",
            }, ]
        });
    });
</script>