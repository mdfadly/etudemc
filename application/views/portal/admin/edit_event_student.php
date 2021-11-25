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
                <a href="<?= site_url() ?>portal/event/student/" class="btn btn-primary">
                    <i class="fa fa-angle-left"></i> Back
                </a>
            </span>
            <span style="float:right;">

            </span>
        </div>

        <hr>
        <h2 style="font-weight:bold">Edit Student Event</h2>
        <div class="row">
            <div class="col-lg-12 col-12 mt-4">
                <form action="<?= site_url('portal/C_Admin/edit_data_event_student') ?>" method="POST">
                    <input type="hidden" required class="form-control" id="id_event_student" value="<?= $event_student[0]['id_event_student'] ?>" required name="id_event_student">
                    <div class="form-group">
                        <label for="regist">Event Regist</label><br>
                        <input type="date" class="form-control" value="<?= substr($event_student[0]['regist'], 0, 10); ?>" name="regist" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name_student">Student Name</label><br>
                        <select class="form-control select-form" style="width:100%;" name="id_student" id="id_student">
                            <option value="<?= $event_student[0]['id_student'] ?>"><?= $event_student[0]['name_student'] ?></option>
                            <?php foreach ($student as $s) : ?>
                                <option value="<?= $s['id_student'] ?>">
                                    <?= $s['name_student'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name_event">event Name</label><br>
                        <select class="form-control select-form" style="width:100%;" name="" id="event" onchange="myFunction(event)">

                            <!-- <?php foreach ($event as $s) : ?>
                                <option value="<?= $s['id_event'] ?>/<?= substr($s['event_date'], 0, 10) ?>/<?= $s['price'] ?>">
                                    <?= $s['event_name'] ?>
                                </option>
                            <?php endforeach; ?> -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="event_date">Event Date</label><br>
                        <input type="date" class="form-control" id="event_date" disabled name="event_date">
                        <input type="hidden" class="form-control" id="id_event" required name="id_event">
                    </div>
                    <div class="form-group">
                        <label for="price">Event Price</label>
                        <input type="text" readonly class="form-control" id="rupiah" />
                        <input type="hidden" class="form-control" id="price" name="price">
                    </div>
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

        var temp_val = "<?= $event_student[0]['id_event'] ?>/<?= substr($event_student[0]['event_date'], 0, 10) ?>/<?= $event_student[0]['price'] ?>";

        var temp = temp_val.split('/')[0];
        document.getElementById("id_event").value = temp;

        var temp2 = temp_val.split('/')[1];
        document.getElementById("event_date").value = temp2;

        var temp3 = temp_val.split('/')[2];
        document.getElementById("price").value = temp3;
        document.getElementById("rupiah").value = "Rp " + formatRupiah(temp3);

        filter_event();
        $("#id_student").change(function() {
            var val = $(this).val();
            var id_event = null;
            if (val == <?= $event_student[0]['id_student'] ?>) {
                id_event = <?= $event_student[0]['id_event'] ?>;
            }
            $.ajax({
                type: "POST",
                url: '<?= site_url() ?>portal/C_Admin/filter_event_student',
                data: {

                    "data": id_event,
                    "value": val,
                },
                success: function(data) {
                    $("#event").html(data);
                }
            });
        });
    });
</script>
<script>
    function filter_event() {
        $.ajax({
            type: "POST",
            url: '<?= site_url() ?>portal/C_Admin/filter_event_student',
            data: {
                "value": <?= $event_student[0]['id_student'] ?>,
            },
            success: function(data) {
                $("#event").html(`<option value="
                    <?= $event_student[0]['id_event'] ?> / <?= substr($event_student[0]['event_date'], 0, 10) ?> / <?= $event_student[0]['price'] ?> "><?= $event_student[0]['event_name'] ?></option>`);
                $("#event").append(data);
            }
        });
    }

    function myFunction(e) {
        var temp_val = e.target.value;
        var temp = temp_val.split('/')[0];
        document.getElementById("id_event").value = temp;

        var temp2 = temp_val.split('/')[1];
        document.getElementById("event_date").value = temp2;

        var temp3 = temp_val.split('/')[2];
        document.getElementById("price").value = temp3;
        document.getElementById("rupiah").value = "Rp " + formatRupiah(temp3);
    }

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