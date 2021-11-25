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
        <h2>Periode FeeReport</h2>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <?php if ($this->session->flashdata('success') != null) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= $this->session->flashdata('success') ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-12 col-12 mt-3">
                <div class="mt-3">
                    <table id="example" cellpadding="0" cellspacing="0" class="table table-striped table-white" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Periode</th>
                                <th>Per Teacher</th>
                                <th>Summary</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < count($feereport_temp); $i++) : ?>
                                <tr>
                                    <td>
                                        <?= ($i + 1) ?>
                                    </td>
                                    <td>
                                        <?php
                                            $date = date_create("$feereport_temp[$i]");
                                            echo date_format($date, "F - Y");
                                            ?>
                                    </td>
                                    <td>
                                        <a href="<?= site_url(); ?>portal/feereport/teacher/<?= $feereport_temp[$i] ?>" class="btn btn-info">
                                            <i class="fa fa-info"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?= site_url(); ?>portal/feereport/summary/<?= $feereport_temp[$i] ?>" class="btn btn-secondary">
                                            <i class="fa fa-archive"></i>
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
            'columnDefs': [{
                'targets': [0, 1, 2], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
            }, {
                targets: 3,
                "className": "text-center",
            },],
        });
    });
</script>