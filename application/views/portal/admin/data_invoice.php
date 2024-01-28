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
        <h2 style="font-weight:bold">Invoice Parents</h2>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <?php if ($this->session->flashdata('success') != null) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= $this->session->flashdata('success') ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-12 pt-3">
                <!-- <span class="mr-1 pb-2" style="border-bottom:2px solid #62A8D6">
                    Offline Invoice
                </span>
                | -->
                <a href="<?= site_url() ?>portal/C_Admin/data_invoice_purchase" class="btn ml-1 mr-1 pl-4 pr-4" style="background-color:#f1f3f8; font-size:12px">
                    Invoice
                </a>
                |
                <a href="<?= site_url() ?>portal/C_Admin/data_invoice_parent_summary" class="btn ml-1 mr-1 pl-4 pr-4" style="background-color:#f1f3f8; font-size:12px">
                    Summary Invoice
                </a>
            </div>
            <div id="table_offline" class="col-lg-12 col-12 mt-4" style="">
                <div class="mt-3">
                    <table id="example" cellpadding="0" cellspacing="0" class="table table-striped table-white" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Periode</th>
                                <th>View Parent</th>
                                <!-- <th>Summary</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < count($invoice_temp); $i++) : ?>
                                <tr>
                                    <td>
                                        <?= ($i + 1) ?>
                                    </td>
                                    <td>
                                        <?php
                                            $date = date_create("$invoice_temp[$i]");
                                            echo date_format($date, "F - Y");
                                            ?>
                                    </td>
                                    <td>
                                        <a href="<?= site_url(); ?>portal/invoice/parent/<?= $invoice_temp[$i] ?>" class="btn btn-info">
                                            <i class="fa fa-info"></i>
                                        </a>
                                    </td>
                                    <!-- <td>
                                        <a href="<?= site_url(); ?>portal/C_Admin/data_invoice_summary_offline/<?= $invoice_temp[$i] ?>" class="btn btn-secondary">
                                            <i class="fa fa-archive"></i>
                                        </a>
                                    </td> -->
                                </tr>
                            <?php endfor; ?>
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
            'columnDefs': [{
                'targets': [0, 1, 2], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
            }, {
                targets: 2,
                "className": "text-center",
            }, ],
        });
    });
</script>