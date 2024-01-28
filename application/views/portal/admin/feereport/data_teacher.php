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
                <a href="<?= site_url() ?>portal/feereport" class="btn btn-primary mr-3">
                    <i class="fa fa-arrow-left mr-2"></i>
                    Back
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

        <h2 style="font-weight:bold">Periode Fee Report</h2>
        <h5>
            <?= $temp_date2 ?>
        </h5>

        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="mt-3">
                    <table id="example" cellpadding="0" cellspacing="0" class="table table-striped table-white" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Teacher Name</th>
                                <th>Detail</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < count($feereport_temp); $i++) : ?>
                                <tr>
                                    <td>
                                        <?= ($i + 1) ?>
                                    </td>
                                    <td>
                                        <?= substr($feereport_temp[$i], 7) ?>
                                    </td>
                                    <td>
                                        <a target="_blank" href="<?= site_url(); ?>portal/feereport/view/<?= $this->uri->segment(4) ?>/<?= substr($feereport_temp[$i], 0, 6) ?>" class="btn btn-info">
                                            <i class="fa fa-info"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?= site_url() ?>portal/C_Admin/delete_data_feereport/FER-<?= date("Ym", $enddate2) ?>-<?= substr($feereport_temp[$i], 3, 3) ?>-001/<?= date("Y-m", $enddate2) ?>" class="btn btn-danger" title="Hapus Data Ini" onclick='return confirm("are you sure want to delete?")'>
                                            <i class="fa fa-trash icon-white"></i>
                                        </a>
                                    </td>
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
            // "responsive": true,
            "scrollX": true,
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            'columnDefs': [{
                'targets': [0, 1, 2, 3], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
            }, {
                targets: 2,
                "className": "text-center",
            }, ],
        });
    });
</script>