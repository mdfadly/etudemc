<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title><?= $title ?></title>

    <meta name="title" property="title" data-react-helmet="true" content="<?= $title ?>">
    <meta data-react-helmet="true" content="<?= $title ?>" name="og:title" property="og:title">
    <meta data-react-helmet="true" content="<?= $description ?>" name="description" property="description">
    <meta data-react-helmet="true" content="<?= $description ?>" name="og:description" property="og:description">

    <meta content="<?= base_url() ?>assets/img/logo-1.png" name="og:image" property="og:image">
    <meta content="Etude" name="og:site_name" property="og:site_name">
    <meta content="website" name="og:type" property="og:type">

    <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url(); ?>assets/img/icon-etude.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url(); ?>assets/img/icon-etude.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url(); ?>assets/img/icon-etude.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>assets/img/icon-etude.png">

    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/styleInvoice.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/dataTables.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fullcalendar/fullcalendar.min.css" />

    <script src="<?= base_url('assets/js/fontawesome.min.js'); ?>"></script>
</head>

<body>
    <div class="container-fluid mt-5 mb-5 pl-5 pr-5">
        <div class="card">
            <div class="card-body">
                <div class="row p-4">
                    <div class="col-lg-7 col-12">
                        <a href="<?= site_url('portal') ?>" style="text-decoration:none">
                            <img src="<?= base_url(); ?>assets/img/logo.png" alt="logo Etude" class="w-50">
                        </a>
                        <br><br>
                        <h5 style="font-weight:bold">ETUDE MUSIC CENTRE</h5 style="font-weight:bold">
                        <small>Soho Capital - Central Park 32nd Floor/No.7 Jl. Letjend S. Parman Kav 28 Jakarta Barat 11470</small>
                        <small>etudemusiccentre@gmail.com | 0821-2231-4248</small>
                    </div>
                    <div class="col-lg-5 col-12 mt-5">
                        <h4 class="name text-center" style="color:black">
                            Summary Feereport Teachers
                        </h4>
                    </div>
                </div>

                <div class="row mb-5">

                </div>

                <?php $tot_feereport_idr = 0 ?>
                <h3>
                    Fee Report Details:
                </h3>
                <div class="table-responsive-sm">
                    <table class="table table-bordered table-white">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">No. Feereport</th>
                                <th class="text-center">Teacher Name</th>
                                <th class="text-center">Instrument</th>
                                <th class="text-center">Total Lesson Fee</th>
                                <th class="text-center">Total Others</th>
                                <th class="text-center">Grand Total Fee</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Paid Date</th>
                            </tr>
                        </thead>
                        <tbody id="show_data">
                            <?php $z = 1; ?>
                            <?php for ($i = 0; $i < count($feereport_temp_lesson); $i++) : ?>
                                <?php $temp_feereport_temp_lesson[$i] = explode("&", $feereport_temp_lesson[$i]); ?>
                                <tr>
                                    <td class="text-center"><?= $z++ ?></td>
                                    <td class="text-center" style="font-weight:bold">
                                        <?= $temp_feereport_temp_lesson[$i][0] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $temp_feereport_temp_lesson[$i][1] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $temp_feereport_temp_lesson[$i][4] ?>
                                    </td>
                                    <td class="text-center">
                                        Rp <?= number_format($total_lesson_fee_teacher[$temp_feereport_temp_lesson[$i][3]], 0, ',', '.') ?>
                                    </td>
                                    <td class="text-center">
                                        Rp <?= number_format($total_other_fee_teacher[$temp_feereport_temp_lesson[$i][3]], 0, ',', '.') ?>
                                    </td>
                                    <td class="text-center">
                                        <?php $totSumFee = $total_lesson_fee_teacher[$temp_feereport_temp_lesson[$i][3]] + $total_other_fee_teacher[$temp_feereport_temp_lesson[$i][3]] ?>
                                        <?php $tot_feereport_idr += $totSumFee ?>
                                        Rp <?= number_format($totSumFee, 0, ',', '.') ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($temp_feereport_temp_lesson[$i][2] == "0") : ?>
                                            <span class="badge bg-warning">Not Approved</span>
                                        <?php else : ?>
                                            <span class="badge bg-success">Approved</span>
                                        <?php endif ?>
                                    </td>
                                    <td class="text-center">
                                        <input type="date" class="form-control" id="paid_date" name="paid_date" value="<?= $temp_feereport_temp_lesson[$i][5] ?>" onchange="paymentFunc<?= $temp_feereport_temp_lesson[$i][3] ?>(event)">
                                    </td>

                                </tr>
                            <?php endfor ?>
                        </tbody>
                        <tbody>
                            <tr style="background-color:#E8F6EF">
                                <td class="text-center" colspan="6">
                                    <h5 class="font-weight:bold">Total Price</h5>
                                </td>
                                <td colspan="5">
                                    <h5 class="font-weight:bold">
                                        <p style="text-align:left;">
                                            Rp
                                            <span style="float:right;">
                                                <?= number_format($tot_feereport_idr, 0, ',', '.')  ?>
                                            </span>
                                        </p>
                                    </h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <?php for ($i = 0; $i < count($feereport_temp_lesson); $i++) : ?>
                    <?php $temp_feereport_temp_lesson[$i] = explode("&", $feereport_temp_lesson[$i]); ?>
                    <?php if ($temp_feereport_temp_lesson[$i][3] == "200001") : ?>
                        <?php $tot_feereport_dollar = 0 ?>
                        <?php $tot_feereport_euro = 0 ?>
                        <?php if ($total_lesson_fee_teacher_dollar[$temp_feereport_temp_lesson[$i][3]] > 0) : ?>
                            <h3>
                                Fee Report Details (DOLLAR):
                            </h3>
                            <div class="table-responsive-sm">
                                <table class="table table-bordered table-white">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th class="text-center">No. Feereport</th>
                                            <th class="text-center">Teacher Name</th>
                                            <th class="text-center">Instrument</th>
                                            <th class="text-center">Total Lesson Fee</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="show_data">
                                        <?php $z = 1; ?>
                                        <?php for ($i = 0; $i < count($feereport_temp_lesson); $i++) : ?>
                                            <?php $temp_feereport_temp_lesson[$i] = explode("&", $feereport_temp_lesson[$i]); ?>
                                            <?php if ($temp_feereport_temp_lesson[$i][3] == "200001") : ?>
                                                <tr>
                                                    <td class="text-center"><?= $z++ ?></td>
                                                    <td class="text-center" style="font-weight:bold">
                                                        <?= $temp_feereport_temp_lesson[$i][0] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?= $temp_feereport_temp_lesson[$i][1] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?= $temp_feereport_temp_lesson[$i][4] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php $totSumFee = $total_lesson_fee_teacher_dollar[$temp_feereport_temp_lesson[$i][3]] ?>
                                                        <?php $tot_feereport_dollar += $totSumFee ?>
                                                        $ <?= number_format($totSumFee, 0, ',', '.') ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php if ($temp_feereport_temp_lesson[$i][1] == 0) : ?>
                                                            <span class="badge bg-warning">Not Approved</span>
                                                        <?php else : ?>
                                                            <span class="badge bg-success">Approved</span>
                                                        <?php endif ?>
                                                    </td>

                                                </tr>
                                            <?php endif ?>
                                        <?php endfor ?>
                                    </tbody>
                                    <tbody>
                                        <tr style="background-color:#E8F6EF">
                                            <td class="text-center" colspan="4">
                                                <h5 class="font-weight:bold">Total Price</h5>
                                            </td>
                                            <td colspan="2">
                                                <h5 class="font-weight:bold">
                                                    <p style="text-align:left;">
                                                        $
                                                        <span style="float:right;">
                                                            <?= number_format($tot_feereport_dollar, 0, ',', '.')  ?>
                                                        </span>
                                                    </p>
                                                </h5>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                        <?php endif ?>
                        <?php if ($total_lesson_fee_teacher_euro[$temp_feereport_temp_lesson[$i][3]] > 0) : ?>
                            <h3>
                                Fee Report Details (EUR):
                            </h3>
                            <div class="table-responsive-sm">
                                <table class="table table-bordered table-white">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th class="text-center">No. Feereport</th>
                                            <th class="text-center">Teacher Name</th>
                                            <th class="text-center">Instrument</th>
                                            <th class="text-center">Total Lesson Fee</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="show_data">
                                        <?php $z = 1; ?>
                                        <?php for ($i = 0; $i < count($feereport_temp_lesson); $i++) : ?>
                                            <?php $temp_feereport_temp_lesson[$i] = explode("&", $feereport_temp_lesson[$i]); ?>
                                            <?php if ($temp_feereport_temp_lesson[$i][3] == "200001") : ?>
                                                <tr>
                                                    <td class="text-center"><?= $z++ ?></td>
                                                    <td class="text-center" style="font-weight:bold">
                                                        <?= $temp_feereport_temp_lesson[$i][0] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?= $temp_feereport_temp_lesson[$i][1] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?= $temp_feereport_temp_lesson[$i][4] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php $totSumFee = $total_lesson_fee_teacher_euro[$temp_feereport_temp_lesson[$i][3]] ?>
                                                        <?php $tot_feereport_euro += $totSumFee ?>
                                                        € <?= number_format($totSumFee, 0, ',', '.') ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php if ($temp_feereport_temp_lesson[$i][1] == 0) : ?>
                                                            <span class="badge bg-warning">Not Approved</span>
                                                        <?php else : ?>
                                                            <span class="badge bg-success">Approved</span>
                                                        <?php endif ?>
                                                    </td>

                                                </tr>
                                            <?php endif ?>
                                        <?php endfor ?>
                                    </tbody>
                                    <tbody>
                                        <tr style="background-color:#E8F6EF">
                                            <td class="text-center" colspan="4">
                                                <h5 class="font-weight:bold">Total Price</h5>
                                            </td>
                                            <td colspan="5">
                                                <h5 class="font-weight:bold">
                                                    <p style="text-align:left;">
                                                        €
                                                        <span style="float:right;">
                                                            <?= number_format($tot_feereport_euro, 0, ',', '.')  ?>
                                                        </span>
                                                    </p>
                                                </h5>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif ?>
                    <?php endif ?>
                <?php endfor ?>
            </div>
        </div>
    </div>
    <script src="<?= base_url('assets/js/jquery-3.4.0.min.js'); ?>"></script>
    <script>
        $(document).ready(function() {
            var x = window.matchMedia("(max-width: 768px)");
            myFunction(x); // Call listener function at run time
            x.addListener(myFunction); // Attach listener function on state changes

            function myFunction(x) {
                if (x.matches) { // If media query matches
                    document.body.style.zoom = "25%"
                } else {
                    document.body.style.zoom = "80%"
                }
            };
        });

        <?php for ($i = 0; $i < count($feereport_temp_lesson); $i++) : ?>
            <?php $temp_feereport_temp_lesson[$i] = explode("&", $feereport_temp_lesson[$i]); ?>
            <?php $id_teacher = $temp_feereport_temp_lesson[$i][3] ?>

            function paymentFunc<?= $id_teacher ?>(e) {
                var temp_val = e.target.value;

                $.ajax({
                    type: "POST",
                    url: '<?= site_url() ?>portal/C_Admin/update_data_payment_feereport',
                    data: {
                        "no_sirkulasi_feereport": "<?= $temp_feereport_temp_lesson[$i][0] ?>",
                        "date": temp_val
                    },
                    success: function(data) {
                        alert("successfully updated paid date");
                        location.reload();
                    }
                });
            }
        <?php endfor ?>
    </script>
</body>

</html>