<main class="page-content">
    <div class="container-fluid">
        <h2>List Note</h2>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <?php if ($this->session->flashdata('success') != null) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= $this->session->flashdata('success') ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-12 col-12">
                <div class="mt-3">
                    <table id="example" cellpadding="0" cellspacing="0" class="table table-striped table-white" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Periode</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < count($note_temp); $i++) : ?>
                                <tr>
                                    <td>
                                        <?= ($i + 1) ?>
                                    </td>
                                    <td>
                                        <?php
                                            $date = date_create("$note_temp[$i]");
                                            echo date_format($date, "F - Y");
                                            ?>
                                    </td>
                                    <td>
                                        <a href="<?= site_url(); ?>portal/note/<?= $note_temp[$i] ?>" class="btn btn-info">
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
        $('#example').DataTable();
    });
</script>