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
        <h2>Periode Summary Feereport</h2>
        <h5>Offline Lesson</h5>
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
                <a href="<?= site_url() ?>portal/feereport" class="btn ml-1 mr-1 pl-4 pr-4 btn-light">
                    Feereport Per Parent
                </a>
                |
                <a href="<?= site_url() ?>portal/feereport/online" class="btn ml-1 mr-1 pl-4 pr-4 btn-light">
                    Summary Online Lesson
                </a>
                |
                <span class="mr-1 pb-2" style="border-bottom:2px solid #62A8D6">
                    Summary Offline Lesson
                </span>
            </div>
            <div id="table_offline" class="col-lg-12 col-12 mt-4" style="">
                <div class="mt-3">
                    <table id="example" cellpadding="0" cellspacing="0" class="table table-striped table-white" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Periode</th>
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
                                        <a href="<?= site_url(); ?>portal/feereport/summary/offline/<?= $feereport_temp[$i] ?>" class="btn btn-info">
                                            View
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
            'columnDefs': [{
                'targets': [0, 1, 2], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
            }],
        });
    });
</script>