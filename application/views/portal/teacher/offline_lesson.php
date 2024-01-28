<main class="page-content">
    <div class="container-fluid">
        <h2 style="font-weight:bold">Offline Lesson</h2>
        <hr>
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="mr-3 ml-lg-3 mt-3">
                    <table id="example" class="table table-striped table-white" style="width:100%">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Package Range</th>
                                <th>Status</th>
                                <th>Attendance</th>
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
        $('#example').DataTable({
            "bInfo": false,
            // "responsive": true,
            "scrollX": true,
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('portal/C_Teacher/get_offline_lesson') ?>",
                "type": "POST",
                "data": {
                    "id_teacher": '<?= $this->session->userdata('id'); ?>'
                }
            },
            'columnDefs': [{
                    'targets': [1, 2, 3], // column index (start from 0)
                    'orderable': false, // set orderable false for selected columns
                },
                {
                    width: '17%',
                    targets: 3,
                    "className": "text-center",
                }
            ],
            "order": []
        });
    });
</script>