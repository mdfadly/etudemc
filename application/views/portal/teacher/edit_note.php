<main class="page-content">
    <div class="container-fluid">
        <h2>
            Update Note
        </h2>
        <hr>
        <form action="<?= site_url('portal/C_Teacher/update_data_note'); ?>" method="POST">
            <div class="row">
                <div class="col-lg-4 col-4">
                    <?php if ($this->uri->segment(2) == "offline_lesson") : ?>
                        <a href="<?= site_url() ?>portal/offline_lesson/note/<?= $offline_lesson[0]['id_offline_lesson'] ?>" class="btn btn-sm pl-3 pr-3 btn-primary">
                            <i class="fa fa-angle-left"></i> Back
                        </a>
                    <?php endif; ?>
                    <?php if ($this->uri->segment(2) == "online_pratical") : ?>
                        <a href="<?= site_url() ?>portal/online_pratical/note/<?= $online_pratical[0]['id_online_pratical'] ?>" class="btn btn-sm pl-3 pr-3 btn-primary">
                            <i class="fa fa-angle-left"></i> Back
                        </a>
                    <?php endif; ?>
                    <?php if ($this->uri->segment(2) == "online_theory") : ?>
                        <a href="<?= site_url() ?>portal/online_theory/note/<?= $online_theory[0]['id_online_theory'] ?>" class="btn btn-sm pl-3 pr-3 btn-primary">
                            <i class="fa fa-angle-left"></i> Back
                        </a>
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
                <div class="col-lg-4 col-4 text-right">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
            <div class="row pt-5">
                <?php if ($this->session->flashdata('success') != null) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= $this->session->flashdata('success') ?>
                    </div>
                <?php endif; ?>

                <div class="col-lg-12 col-12 justify-content-center">
                    <?php if ($this->uri->segment(2) == "offline_lesson") : ?>
                        <input type="hidden" name="id_course" value="<?= $offline_lesson[0]['id_offline_lesson'] ?>">
                        <input type="hidden" name="id_student" value="<?= $offline_lesson[0]['id_student'] ?>">
                        <input type="hidden" name="id_teacher" value="<?= $offline_lesson[0]['id_teacher'] ?>">
                    <?php endif; ?>
                    <?php if ($this->uri->segment(2) == "online_pratical") : ?>
                        <input type="hidden" name="id_course" value="<?= $online_pratical[0]['id_online_pratical'] ?>">
                        <input type="hidden" name="id_student" value="<?= $online_pratical[0]['id_student'] ?>">
                        <input type="hidden" name="id_teacher" value="<?= $online_pratical[0]['id_teacher'] ?>">
                    <?php endif; ?>
                    <?php if ($this->uri->segment(2) == "online_theory") : ?>
                        <input type="hidden" name="id_course" value="<?= $online_theory[0]['id_online_theory'] ?>">
                        <input type="hidden" name="id_student" value="<?= $online_theory[0]['id_student'] ?>">
                        <input type="hidden" name="id_teacher" value="<?= $online_theory[0]['id_teacher'] ?>">
                    <?php endif; ?>
                    <input type="hidden" name="name_course" value="<?= $this->uri->segment(2) ?>">
                    <input type="hidden" name="id_note" value="<?= $note[0]['id_note'] ?>">
                    <textarea class="form-control" rows="15" name="keterangan" placeholder="Input note here.."><?= $note[0]['keterangan'] ?></textarea>
                </div>
            </div>
        </form>
    </div>
</main>