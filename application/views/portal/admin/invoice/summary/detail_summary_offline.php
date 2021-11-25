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
                            Summary Offline Invoice
                        </h4>
                    </div>
                </div>

                <div class="row mb-5">

                </div>

                <?php $tot_offline_lesson = 0 ?>
                <h3>
                    Invoice Details:
                </h3>
                <div class="table-responsive-sm">
                    <table class="table table-bordered table-white">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">No. Invoice</th>
                                <th class="text-center">Person in Charge</th>
                                <th class="text-center">Total Lesson Fee</th>
                                <th class="text-center">Total Others</th>
                                <th class="text-center">Grand Total Invoice</th>
                                <th class="text-center">Payment Date</th>
                            </tr>
                        </thead>
                        <tbody id="show_data">
                            <?php $z = 1; ?>
                            <?php for ($i = 0; $i < count($invoice_temp_lesson); $i++) : ?>
                                <?php $temp_invoice_temp_lesson[$i] = explode("&", $invoice_temp_lesson[$i]); ?>
                                <tr>
                                    <td class="text-center"><?= $z++ ?></td>
                                    <td class="text-center" style="font-weight:bold">
                                        INV/OFL/<?= substr($this->uri->segment(4), 0, 4) ?><?= substr($this->uri->segment(4), 5, 2) ?>/<?= substr($temp_invoice_temp_lesson[$i][0], 3, 3) ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $temp_invoice_temp_lesson[$i][1] ?>
                                    </td>
                                    <td class="text-center">
                                        <?php $tot_temp_offline_lesson = intval($temp_invoice_temp_lesson[$i][6]) * intval($count_total_lesson[$temp_invoice_temp_lesson[$i][0]][$temp_invoice_temp_lesson[$i][4]]) ?>
                                        Rp <?= number_format($tot_temp_offline_lesson, 0, ',', '.')  ?>
                                    </td>
                                    <td class="text-center">
                                        <?php $tot_temp_other = $total_other_price[$temp_invoice_temp_lesson[$i][0]][$temp_invoice_temp_lesson[$i][4]] ?>
                                        Rp <?= number_format($tot_temp_other, 0, ',', '.')  ?>
                                    </td>
                                    <td class="text-center">
                                        <?php $total_temp_invoice = intval($tot_temp_offline_lesson) + intval($tot_temp_other) ?>
                                        Rp <?= number_format($total_temp_invoice, 0, ',', '.')  ?>
                                        <?php $tot_offline_lesson += $total_temp_invoice ?>
                                    </td>
                                    <td class="text-center">
                                        <input type="date" class="form-control" id="payment_date<?= $temp_invoice_temp_lesson[$i][0] ?>" name="payment_date" value="<?= $payment_date[$temp_invoice_temp_lesson[$i][0]][$temp_invoice_temp_lesson[$i][4]] ?>" onchange="paymentFunc<?= $temp_invoice_temp_lesson[$i][0] ?>(event)">
                                    </td>
                                </tr>
                            <?php endfor ?>
                        </tbody>
                        <tbody>
                            <tr style="background-color:#E8F6EF">
                                <td class="text-center" colspan="5">
                                    <h5 class="font-weight:bold">Total Price</h5>
                                </td>
                                <td colspan="5">
                                    <h5 class="font-weight:bold">
                                        <p style="text-align:left;">
                                            Rp
                                            <span style="float:right;">
                                                <?= number_format($tot_offline_lesson, 0, ',', '.')  ?>
                                            </span>
                                        </p>
                                    </h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                

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
        <?php for ($i = 0; $i < count($invoice_temp_lesson); $i++) : ?>
            <?php $temp_invoice_temp_lesson[$i] = explode("&", $invoice_temp_lesson[$i]); ?>

            function paymentFunc<?= $temp_invoice_temp_lesson[$i][0] ?>(e) {
                var temp_val = e.target.value;
                console.log(temp_val)
                console.log(<?= $temp_invoice_temp_lesson[$i][0] ?>)

                $.ajax({
                    type: "POST",
                    url: '<?= site_url() ?>portal/C_Admin/update_data_payment_date_offline',
                    data: {
                        "tipe": 2,
                        "no_sirkulasi": "NULL",
                        "periode": "<?= $this->uri->segment(4) ?>",
                        "id_parent": "<?= $temp_invoice_temp_lesson[$i][0] ?>",
                        "date": temp_val
                    },
                    success: function(data) {
                        alert("successfully updated payment date")
                    }
                });
            }
        <?php endfor ?>
    </script>
</body>

</html>