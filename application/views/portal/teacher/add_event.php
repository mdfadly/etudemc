<style>
    .hiden {
        display: none;
    }

    @media (max-width: 990px) {
        #form-add-event {
            font-size: 12px;
        }
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
                <a href="<?= site_url() ?>portal/event_teacher/" class="btn btn-primary">
                    <i class="fa fa-angle-left"></i> Back
                </a>
            </span>
            <span style="float:right;">

            </span>
        </div>

        <hr>
        <h2 style="font-weight:bold">Regist Event</h2>
        <div class="row">

            <div id="form-add-event" class="col-lg-12 col-12 mt-4">
                <form action="<?= site_url('portal/C_Teacher/add_data_event') ?>" method="POST">
                    <div class="form-group">
                        <label for="regist">Event Regist</label><br>
                        <?php date_default_timezone_set("Asia/Jakarta"); ?>
                        <input type="hidden" class="form-control" value="<?= date('Y-m-d H:i:s') ?>" name="regist" readonly>
                        <input type="text" disabled class="form-control" value="<?= date('F d, Y') ?>">
                    </div>
                    <div class="form-group">
                        <label for="name_event">Event Name</label><br>
                        <select class="form-control select-form" style="width:100%;" name="" onchange="myFunction(event)">
                            <option>Choose</option>
                            <?php foreach ($event as $s) : ?>
                                <?php if ($temp_parent_event != $s['parent_event']) { ?>
                                    <?php
                                            $event_join = implode("-", $temp_event_teacher);
                                            $child = $this->M_Admin->getEventByParent($s['parent_event'], $event_join);
                                            $temp_child = 1;
                                            $temp_value = [];
                                            $value = "";
                                            if (count($child) > 1) {
                                                foreach ($child as $c) {
                                                    if ($s['id_event'] != $c['id_event']) {
                                                        $temp_child = $temp_child + 1;
                                                        $temp_value[] = $c['id_event'] . "<" . $c['parent_event'] . "<" . substr($c['event_date'], 0, 10) . "<" . $c['price'];
                                                    }
                                                };
                                                $value = implode("<", $temp_value);
                                            }
                                            ?>
                                    <option value="<?= $s['id_event'] ?><<?= $s['parent_event'] ?><<?= substr($s['event_date'], 0, 10) ?><<?= $s['price'] ?><<?= $temp_child ?><<?= $value ?>">
                                        <?= $s['event_name'] ?>
                                    </option>
                                <?php }
                                    $temp_parent_event = $s['parent_event'];  ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <hr>
                    <!-- <h5>Data Event</h5> -->
                    <input type="hidden" id="total_event" name="total_event">
                    <div id="pick_event" class="hiden">
                        <!-- <div class="form-check form-check-inline">
                            <input type="checkbox" name="status_event1" value="1" checked class="form-check-input" id="status_event1">
                            <label class="form-check-label" for="status_event1">Sesi 1</label>
                            <input type="hidden" id="event1" name="event1" value="1">
                        </div> -->
                        <div id="temp_next_pick">

                        </div>
                    </div>
                    <span style="font-weight:bold">Sesi 1</span>
                    <br>
                    <div id="event_data1" class="row">
                        <div class="form-group col-lg-5 col-5">
                            <label for="event_date1">Event Date</label><br>
                            <input style="font-size:12px" type="text" class="form-control" id="event_date1" disabled name="event_date1">
                            <input type="hidden" class="form-control" id="id_event1" required name="id_event1">
                            <input type="hidden" class="form-control" id="id_teacher" value="<?= $this->session->userdata('id'); ?>" required name="id_teacher">
                            <input type="hidden" class="form-control" id="date1" required name="date1">
                        </div>
                        <div class="form-group col-lg-5 col-5">
                            <label for="price1">Event Price</label>
                            <input style="font-size:12px" type="text" readonly class="form-control" id="rupiah1" />
                            <input type="hidden" class="form-control" id="price1" name="price1">
                        </div>
                        <div class="col-lg-2 col-2">
                            <label class="form-check-label" for="status_event1"></label>
                            <input type="checkbox" name="status_event1" value="1" checked class="form-control" id="status_event1" onclick="check(1)">
                            <input type="hidden" id="event1" name="event1" value="1">
                            <!-- <div class="form-check form-check-inline">
                            </div> -->
                        </div>
                    </div>
                    <div id="temp_next_event">

                    </div>
                    <!-- <div class="form-group">
                        <label for="event_date">Event Date</label><br>
                        <input type="date" class="form-control" id="event_date" disabled name="event_date">
                        <input type="hidden" class="form-control" id="id_event" required name="id_event">
                        <input type="hidden" class="form-control" id="id_teacher" value="<?= $this->session->userdata('id'); ?>" required name="id_teacher">
                    </div>
                    <div class="form-group">
                        <label for="price">Event Price</label>
                        <input type="text" readonly class="form-control" id="rupiah" />
                        <input type="hidden" class="form-control" id="price" name="price">
                    </div> -->
                    <div class="form-group">
                        <label for="price">Total Price</label>
                        <input type="text" class="form-control" id="total_price_rupiah" name="total_price_rupiah" readonly>
                        <input type="hidden" class="form-control" id="total_price" name="total_price" readonly>
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
        // $("#status_event1").on('click', function() {
        //     var value = $(this).val();
        //     if (value == 0) {
        //         document.getElementById("status_event1").value = "1";
        //         document.getElementById("event1").value = "1";
        //     } else {
        //         document.getElementById("status_event1").value = "0";
        //         document.getElementById("event1").value = "2";
        //     }
        // });
        var x = window.matchMedia("(max-width: 990px)");
        displayChange(x); // Call listener function at run time
        x.addListener(displayChange); // Attach listener function on state changes
        function displayChange(x) {
            if (x.matches) { // If media query matches
                $('.img-dashboard-logo').addClass('w-75');
                $('.icon').addClass('cover-dashboard-icon');
                $('.icon-img').addClass('w-100');
                $('.icon-flag').addClass('w-25');
                document.getElementById('flag').removeAttribute('style');
                document.getElementById('head-dashboard').removeAttribute('style');
            } else {
                $('.img-dashboard-logo').removeClass('w-75');
                $('.icon').removeClass('cover-dashboard-icon');
                $('.icon-img').removeClass('w-100');
                document.getElementById('flag').style.width = '100px';
                $('.icon-flag').removeClass('w-25');
                document.getElementById('head-dashboard').style.fontSize = '70px';
            }
        };
    });
</script>
<script>
    function myFunction(e) {
        var total_price = 0;
        var temp_val = e.target.value;
        console.log(temp_val)
        var temp = temp_val.split('<')[0];
        document.getElementById("id_event1").value = temp;

        var temp2 = temp_val.split('<')[2];
        var dateObj = new Date(temp2);

        var curr_date1 = String(dateObj.getDate()).padStart(2, '0');
        var curr_month1 = String(dateObj.getMonth() + 1).padStart(2, '0'); //Months are zero based
        var curr_year1 = dateObj.getFullYear();
        var text_date1 = curr_date1 + "/" + curr_month1 + "/" + curr_year1;
        console.log(text_date1)

        document.getElementById("date1").value = temp2;
        document.getElementById("event_date1").value = temp2;

        var temp3 = temp_val.split('<')[3];
        document.getElementById("price1").value = temp3;
        document.getElementById("rupiah1").value = "Rp " + formatRupiah(temp3);
        total_price = total_price + parseInt(temp3);

        let myEle = document.getElementById('next_event');
        if (myEle) {
            document.getElementById("next_event").remove();
            document.getElementById("next_pick").remove();
        }
        var temp4 = temp_val.split('<')[4];
        document.getElementById("total_event").value = temp4;
        if (temp4 > 1) {
            document.getElementById("pick_event").classList.remove("hiden");
            $("#temp_next_event").append('<div id="next_event" class="row"></div>');
            $("#temp_next_pick").append('<div id="next_pick"></div>');

            var index_date = 7;
            var index_price = 8;
            var index_id_event = 5;
            for (i = 2; i <= temp4; i++) {
                id_event = "";
                date = "";
                price = "";
                if (i == 2) {
                    date = temp_val.split('<')[index_date];
                    price = temp_val.split('<')[index_price];
                    id_event = temp_val.split('<')[index_id_event];
                } else {
                    index_date = index_date + 4;
                    date = temp_val.split('<')[index_date];
                    index_price = index_price + 4;
                    price = temp_val.split('<')[index_price];
                    index_id_event = index_id_event + 4;
                    id_event = temp_val.split('<')[index_id_event];
                }
                var d = new Date(date);

                var curr_date = String(d.getDate()).padStart(2, '0');
                var curr_month = String(d.getMonth() + 1).padStart(2, '0'); //Months are zero based
                var curr_year = d.getFullYear();
                var text_date = curr_date + "/" + curr_month + "/" + curr_year;
                console.log(text_date)
                total_price = total_price + parseInt(price);

                $("#next_event").append(`
                    <div class="col-lg-12 col-12">
                        <span style="font-weight:bold">Sesi ` + i + `</span>
                        <br>
                    </div>
                    <div class="form-group col-lg-5 col-5">
                        <label for="event_date` + i + `">Event Date</label><br>
                        <input style="font-size:12px" type="text" class="form-control" id="event_date` + i + `" disabled name="event_date` + i + `" value="` + date + `">
                        <input type="hidden" class="form-control" id="date` + i + `" required name="date` + i + `" value="` + date + `">
                        <input type="hidden" class="form-control" id="id_event` + i + `" required name="id_event` + i + `" value="` + id_event + `">
                    </div>
                    <div class="form-group col-lg-5 col-5">
                        <label for="price` + i + `">Event Price</label>
                        <input style="font-size:12px" type="text" readonly class="form-control" id="rupiah` + i + `" value="Rp ` + formatRupiah(price) + `"/>
                        <input type="hidden" class="form-control" id="price` + i + `" name="price` + i + `" value="` + price + `">
                    </div>
                    <div class="col-lg-2 col-2">
                        <label class="form-check-label" for="status_event` + i + `"></label>
                        <input type="checkbox" name="status_event` + i + `" value="1" checked class="form-control" id="status_event` + i + `" onclick="check(` + i + `)">
                        <input type="hidden" id="event` + i + `" name="event` + i + `" value="1">
                    </div>
                `);
                console.log(total_price)
                console.log(formatRupiah(String(total_price)))
                document.getElementById("total_price_rupiah").value = 'Rp ' + formatRupiah(String(total_price));
                document.getElementById("total_price").value = total_price;
            }
        } else {
            console.log(total_price)
            console.log(formatRupiah(String(total_price)))
            document.getElementById("pick_event").classList.add("hiden");
            document.getElementById("total_price_rupiah").value = 'Rp ' + formatRupiah(String(total_price));
            document.getElementById("total_price").value = total_price;
        }
    }

    function check(i) {
        data = $('#status_event' + i).val();
        var price = $('#price' + i).val();
        var total_price = $('#total_price').val();

        if (data == 0) {
            $('#status_event' + i).val("1");
            $('#event' + i).val("1");
            var temp_price = parseInt(total_price) + parseInt(price);
            $('#total_price_rupiah').val('Rp ' + formatRupiah(String(temp_price)));
            $('#total_price').val(temp_price);
        } else {
            $('#status_event' + i).val("0");
            $('#event' + i).val("2");
            var temp_price = parseInt(total_price) - parseInt(price);
            $('#total_price_rupiah').val('Rp ' + formatRupiah(String(temp_price)));
            $('#total_price').val(temp_price);
        }
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