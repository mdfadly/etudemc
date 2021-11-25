<style>
    .hiden {
        display: none;
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
        </div>
        <div style="text-align:left;">
            <span style="font-family:mReguler; font-size:20px;" class="font-weight-bold">
                <a href="<?= site_url() ?>portal/event/" class="btn btn-primary">
                    <i class="fa fa-angle-left"></i> Back
                </a>
            </span>
            <span style="float:right;">

            </span>
        </div>

        <hr>
        <h2 style="font-weight:bold">Edit Event</h2>
        <div class="row">
            <div class="col-lg-12 col-12 mt-4">
                <form action="<?= site_url('portal/C_Admin/edit_data_event') ?>" method="POST">
                    <div class="form-group">
                        <label for="event_name">Event Name</label><br>
                        <input type="text" required class="form-control" id="event_name" required value="<?= $event[0]['event_name'] ?>" name="event_name">
                        <input type="hidden" required class="form-control" id="parent_event" required value="<?= $event[0]['parent_event'] ?>" name="parent_event">
                    </div>
                    <div class="form-group">
                        <label for="member">Teacher/Student</label>
                        <select class="form-control" id="member" required name="member">
                            <?php if ($event[0]['member'] == 1) { ?>
                                <option value="1">Teacher</option>
                                <option value="2">Student</option>
                            <?php } else { ?>
                                <option value="2">Student</option>
                                <option value="1">Teacher</option>
                            <?php } ?>
                        </select>
                    </div>
                    <h5>Event Date:</h5>
                    <hr>
                    <?php $no = 1; ?>
                    <?php foreach ($event_child as $e) : ?>
                        <div class="form-group">
                            <label for="event_date">Event Date <?= $no ?></label><br>
                            <input type="date" required class="form-control" id="event_date" required value="<?= substr($e['event_date'], 0, 10) ?>" name="event_date-<?= $e['id_event'] ?>">
                        </div>

                        <div class="form-group">
                            <label for="price">Event Price <?= $no ?></label>
                            <input type="text" class="form-control" id="rupiah<?= $no ?>" />

                            <input type="hidden" class="form-control" id="price<?= $no++ ?>" name="price-<?= $e['id_event'] ?>" value="<?= $e['price'] ?>">
                        </div>
                        <?php if(count($event_child) > 1): ?>
                            <div class="form-group">
                                <a href="<?= site_url() ?>portal/C_Admin/delete_data_event_detail/<?= $e['id_event'] ?>" class="btn btn-danger" title="Hapus Data Ini" onclick="return confirm('are you sure want to delete this data?')"><i class="fa fa-trash icon-white"></i></a>
                            </div>
                        <?php endif; ?>
                        <hr>
                    <?php endforeach; ?>
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>
    </div>
</main>
<script src="<?= base_url('assets/js/jquery-3.4.0.min.js'); ?>"></script>
<script>
    $(document).ready(function() {
        $('.select-form').select2();
        <?php $index = 1; ?>
        <?php foreach ($event_child as $e) : ?>
            var price<?= $index ?> = document.getElementById('price<?= $index ?>');
            var rupiah<?= $index ?> = document.getElementById('rupiah<?= $index ?>');
            rupiah<?= $index ?>.value = price<?= $index ?>.value;
            rupiah<?= $index ?>.value = formatRupiah(rupiah<?= $index ?>.value);

            var valuee<?= $index ?> = '';
            rupiah<?= $index ?>.addEventListener('keyup', function(e) {
                rupiah<?= $index ?>.value = formatRupiah(this.value);
                valuee<?= $index ?> = rupiah<?= $index ?>.value;
                price<?= $index ?>.value = valuee<?= $index++ ?>.split('.').join("");
            });
        <?php endforeach; ?>
    });
</script>
<script>
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>