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
                            Summary Invoice
                        </h4>
                    </div>
                </div>

                <div class="row mb-5">

                </div>
                <h3>
                    Invoice Details:
                </h3>

                <?php $tot_online_lesson = 0 ?>
                <div class="table-responsive-sm">
                    <table class="table table-bordered table-white">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">No. Invoice</th>
                                <th class="text-center">Person in Charge</th>
                                <th class="text-center">Total Lesson Fee</th>
                                <th class="text-center">Total Event Fee</th>
                                <th class="text-center">Total Book Fee</th>
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
                                        <?= $temp_invoice_temp_lesson[$i][0] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $temp_invoice_temp_lesson[$i][2] ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if (substr($temp_invoice_temp_lesson[$i][0], 0, 6) == 'INV001') { ?>
                                            <?php $tot_fee = $temp_invoice_temp_lesson[$i][3] - $discount_coupon_offline[$temp_invoice_temp_lesson[$i][0]] ?>
                                        <?php } else { ?>
                                            <?php $tot_fee = 0 ?>
                                        <?php }  ?>
                                        Rp <?= number_format($tot_fee, 0, ',', '.')  ?>
                                    </td>
                                    <td class="text-center">
                                        <?php $tot_event = $total_event[$temp_invoice_temp_lesson[$i][0]] ?>
                                        Rp <?= number_format($tot_event, 0, ',', '.')  ?>
                                    </td>
                                    <td class="text-center">
                                        <?php $tot_book = $total_book[$temp_invoice_temp_lesson[$i][0]] ?>
                                        Rp <?= number_format($tot_book, 0, ',', '.')  ?>
                                    </td>
                                    <td class="text-center">
                                        <?php $tot_other_price = $total_other_price[$temp_invoice_temp_lesson[$i][0]] ?>
                                        Rp <?= number_format($tot_other_price, 0, ',', '.')  ?>
                                    </td>
                                    <td class="text-center">
                                        <?php $temp_tot = intval($tot_fee) + intval($tot_event) + intval($tot_book) + intval($tot_other_price) ?>
                                        Rp <?= number_format($temp_tot, 0, ',', '.')  ?>

                                        <?php $tot_online_lesson += $temp_tot ?>
                                    </td>
                                    <td class="text-center">
                                        <?php $tempNoTransaksi = str_replace("/", "", $temp_invoice_temp_lesson[$i][0]); ?>
                                        <input type="date" class="form-control" id="payment_date<?= $tempNoTransaksi ?>" name="payment_date" value="<?= $payment_date[$temp_invoice_temp_lesson[$i][0]] ?>" onchange="paymentFunc<?= $tempNoTransaksi ?>(event)">
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
                                                <?= number_format($tot_online_lesson, 0, ',', '.')  ?>
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
                    document.body.style.zoom = "30%"
                } else {
                    document.body.style.zoom = "80%"
                }
            };
        });
        <?php for ($i = 0; $i < count($invoice_temp_lesson); $i++) : ?>
            <?php $temp_invoice_temp_lesson[$i] = explode("&", $invoice_temp_lesson[$i]); ?>
            <?php $tempNoTransaksi = str_replace("/", "", $temp_invoice_temp_lesson[$i][0]); ?>

            function paymentFunc<?= $tempNoTransaksi ?>(e) {
                var temp_val = e.target.value;
                console.log(temp_val)
                console.log('<?= $tempNoTransaksi ?>')
                console.log("<?= $this->uri->segment(4) ?>")
                console.log("<?= $temp_invoice_temp_lesson[$i][1] ?>")

                $.ajax({
                    type: "POST",
                    url: '<?= site_url() ?>portal/C_Admin/update_data_payment_date_offline',
                    data: {
                        "tipe": 1,
                        "no_sirkulasi": "<?= $tempNoTransaksi ?>",
                        "periode": "<?= $this->uri->segment(4) ?>",
                        "id_parent": "<?= $temp_invoice_temp_lesson[$i][1] ?>",
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