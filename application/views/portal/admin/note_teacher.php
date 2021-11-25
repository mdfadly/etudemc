<main class="page-content">
    <div class="container-fluid">
        <?php $date = date_create($this->uri->segment(3)); ?>
        <h2>List Note <?= date_format($date, "M, Y") ?></h2>
        <h5>
            (<?= $note[0]['name_teacher'] ?>)
        </h5>
        <hr>
        <div class="row">
            <div class="col-lg-4">
                <a href="<?= site_url() ?>portal/note/<?= $this->uri->segment(3) ?>" class="btn btn-primary">
                    <i class="fa fa-angle-left"></i> Back
                </a>
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
            <div class="col-lg-12 col-12">
                <div class="mt-3">
                    <table id="example" cellpadding="0" cellspacing="0" class="table table-striped table-white" style="width:100%">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Student Name</th>
                                <th>Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($note as $n) : ?>
                                <tr>
                                    <td>
                                        <?php $date2 = date_create($n['date']); ?>
                                        <?= date_format($date2, "M, d Y") ?>
                                    </td>
                                    <td>
                                        <?= $n['name_student'] ?>
                                    </td>
                                    <td>
                                        <?= $n['keterangan'] ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
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