<main class="page-content">
    <div class="container-fluid">
        <h2 style="font-weight:bold">Fee Report</h2>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <div class="mr-3 ml-3 mt-3">
                    <table id="example" class="table table-striped table-white display " style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Periode</th>
                                <th>View</th>
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
                                            $startdate2 = strtotime($feereport_temp[$i]);
                                            $enddate2 = strtotime("+0 months", $startdate2);
                                            $temp_date2 =  date("F - Y", $enddate2);
                                            ?>
                                        <?= $temp_date2 ?>
                                    </td>
                                    <td>
                                        <a target="_blank" href="<?= site_url(); ?>portal/feereport/view/<?= $feereport_temp[$i] ?>/<?= $this->session->userdata('id') ?>" class="btn btn-primary">
                                            <i class="fa fa-info"></i>
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
            "bInfo": false,
            'columnDefs': [{
                'targets': [1, 2], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
            }],
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