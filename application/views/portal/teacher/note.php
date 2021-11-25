<main class="page-content">
    <div class="container-fluid">
        <h2>
            Note
        </h2>
        <hr>
        <div class="row">
            <div class="col-lg-4 col-4">
                <?php if ($this->uri->segment(2) == "offline_lesson") : ?>
                    <a href="<?= site_url() ?>portal/offline_lesson/attendance/<?= $offline_lesson[0]['id_offline_lesson'] ?>" class="btn btn-sm pl-3 pr-3 btn-primary">
                        <i class="fa fa-angle-left"></i> Back
                    </a>
                    <input type="hidden" id="id_course" name="id_course" value="<?= $offline_lesson[0]['id_offline_lesson'] ?>">
                <?php endif; ?>
                <?php if ($this->uri->segment(2) == "online_pratical") : ?>
                    <a href="<?= site_url() ?>portal/online_pratical/attendance/<?= $online_pratical[0]['id_online_pratical'] ?>" class="btn btn-sm pl-3 pr-3 btn-primary">
                        <i class="fa fa-angle-left"></i> Back
                    </a>
                    <input type="hidden" id="id_course" name="id_course" value="<?= $online_pratical[0]['id_online_pratical'] ?>">
                <?php endif; ?>
                <?php if ($this->uri->segment(2) == "online_theory") : ?>
                    <a href="<?= site_url() ?>portal/online_theory/attendance/<?= $online_theory[0]['id_online_theory'] ?>" class="btn btn-sm pl-3 pr-3 btn-primary">
                        <i class="fa fa-angle-left"></i> Back
                    </a>
                    <input type="hidden" id="id_course" name="id_course" value="<?= $online_theory[0]['id_online_theory'] ?>">
                <?php endif; ?>
            </div>
            <div class="col-lg-4 col-3 text-center">
                <h4>
                    <?php if ($this->uri->segment(2) == "offline_lesson") : ?>
                        <?= $offline_lesson[0]['name_student'] ?>
                    <?php endif; ?>
                    <?php if ($this->uri->segment(2) == "online_pratical") : ?>
                        <?= $online_pratical[0]['name_student'] ?>
                    <?php endif; ?>
                    <?php if ($this->uri->segment(2) == "online_theory") : ?>
                        <?= $online_theory[0]['name_student'] ?>
                    <?php endif; ?>
                </h4>
            </div>
            <div class="col-lg-4 col-5 text-right">
                <?php if ($this->uri->segment(2) == "offline_lesson") : ?>
                    <a href="<?= site_url() ?>portal/<?= $this->uri->segment(2) ?>/note/add/<?= $offline_lesson[0]['id_offline_lesson'] ?>" class="btn btn-sm pl-3 pr-3 btn-primary">
                        <i class="fa fa-plus"></i> Add Note
                    </a>
                <?php endif; ?>
                <?php if ($this->uri->segment(2) == "online_pratical") : ?>
                    <a href="<?= site_url() ?>portal/<?= $this->uri->segment(2) ?>/note/add/<?= $online_pratical[0]['id_online_pratical'] ?>" class="btn btn-sm pl-3 pr-3 btn-primary">
                        <i class="fa fa-plus"></i> Add Note
                    </a>
                <?php endif; ?>
                <?php if ($this->uri->segment(2) == "online_theory") : ?>
                    <a href="<?= site_url() ?>portal/<?= $this->uri->segment(2) ?>/note/add/<?= $online_theory[0]['id_online_theory'] ?>" class="btn btn-sm pl-3 pr-3 btn-primary">
                        <i class="fa fa-plus"></i> Add Note
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="row pt-5">
            <?php if ($this->session->flashdata('success') != null) : ?>
                <div class="col-lg-12">
                    <div class="alert alert-success" role="alert">
                        <?= $this->session->flashdata('success') ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-lg-12 col-12">
                <div class="mr-3 ml-3 mt-3">
                    <table id="example" class="table table-striped table-white display" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Note</th>
                                <th>Date</th>
                                <th>Aksi</th>
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
        var id_course = document.getElementById('id_course').value;
        console.log();
        $('#example').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('portal/C_Teacher/get_note') ?>",
                "type": "POST",
                "data": {
                    "id_teacher": '<?= $this->session->userdata('id'); ?>',
                    "name_course": '<?= $this->uri->segment(2) ?>',
                    "id_course": id_course,
                }
            },
            "coloumnDefs": [{

            }],
            "order": []
        });
        var x = window.matchMedia("(max-width: 990px)");
        myFunction(x); // Call listener function at run time
        x.addListener(myFunction); // Attach listener function on state changes

        function myFunction(x) {
            if (x.matches) { // If media query matches
                $('.table').addClass('table-responsive');
            } else {
                $('.table').removeClass('table-responsive');
            }
        };
    });
</script>