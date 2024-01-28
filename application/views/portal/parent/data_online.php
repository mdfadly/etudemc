<main class="page-content">
    <div class="container-fluid">
        <h2 style="font-weight:bold">Online Lesson</h2>
        <hr>
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="mr-3 ml-lg-3 mt-3">
                    <table id="example" class="table table-striped table-white display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Attendance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < count($package_online); $i++) : ?>
                                <?php $tempPackage[$i] =  explode("-", $package_online[$i]) ?>
                                <tr>
                                    <td>
                                        <?= $tempPackage[$i][1] ?>
                                    </td>
                                    <td>
                                        <a href="<?= site_url(); ?>portal/online-pratical/list/<?= $tempPackage[$i][0] ?>" class="btn btn-info">
                                            <i class="fa fa-info"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endfor ?>
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
            'columnDefs': [{
                'targets': [1], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
            }, {
                targets: 1,
                "className": "text-center",
            }],
            "order": []
        });
        var x = window.matchMedia("(max-width: 990px)");
        myFunction(x); // Call listener function at run time
        x.addListener(myFunction); // Attach listener function on state changes

        function myFunction(x) {

        };
    });
</script>