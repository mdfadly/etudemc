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
<style type="text/css">
    input[type='checkbox'] {
        margin-top: 10px;
        width: 30px;
        height: 30px;
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
        <h2 style="font-weight:bold">Add Student Event</h2>
        <div class="row">
            <div id="form-add-event" class="col-lg-12 col-12 mt-4">
                <form action="<?= site_url('portal/C_Admin/add_data_event_student') ?>" method="POST">
                    <div class="form-group">
                        <label for="regist">Event Registration</label><br>
                        <?php date_default_timezone_set("Asia/Jakarta"); ?>
                        <input type="hidden" class="form-control" value="<?= date('Y-m-d H:i:s') ?>" name="regist" readonly>
                        <input type="date" disabled class="form-control" value="<?= date('Y-m-d') ?>">
                    </div>
                    <div class="form-group">
                        <label for="name_student">Student Name</label><br>
                        <select class="form-control select-form" style="width:100%;" name="id_student" id="id_student">
                            <option value="">Choose</option>
                            <?php foreach ($student as $s) : ?>
                                <option value="<?= $s['id_student'] ?>">
                                    <?= $s['name_student'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small>*Select students first</small>
                    </div>
                    <div class="form-group">
                        <label for="name_event">Event Name</label><br>
                        <input type="text" readonly class="form-control" value="<?= $event[0]['event_name'] ?>">
                        <input type="hidden" class="form-control" id="id_event1" required name="id_event1" value="<?= $event[0]['id_event'] ?>">
                        <input type="hidden" class="form-control" id="date1" required name="date1" value="<?= $event[0]['event_date'] ?>">
                        <input type="hidden" class="form-control" id="price1" name="price1" value="<?= $event[0]['price'] ?>">
                        <input type="hidden" id="event1" name="event1" value="1">
                    </div>
                    <hr>
                    <input type="hidden" id="total_event" name="total_event" value="1">
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" id="total_price_rupiah" name="total_price_rupiah" readonly>
                        <input type="hidden" class="form-control" id="total_price" name="total_price" readonly value="<?= $event[0]['price'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="discount">Discount</label>
                        <input type="text" class="form-control" id="discount_rupiah" name="discount_rupiah" value="0">
                        <input type="hidden" class="form-control" id="discount" name="discount" value="0">
                        <small>Price (Rp)</small>
                    </div>
                    <div class="form-group">
                        <label for="rate">Total Price</label>
                        <input type="text" class="form-control" readonly id="rate_rupiah" name="rate_rupiah">
                        <input type="hidden" class="form-control" readonly id="rate" name="rate">
                    </div>
                    <button type="submit" id="btnSubmit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>
    </div>
</main>
<script src="<?= base_url('assets/js/jquery-3.4.0.min.js'); ?>"></script>
<script>
    $(document).ready(function() {
        $('.select-form').select2();
        document.getElementById("total_price_rupiah").value = 'Rp ' + formatRupiah(String('<?= $event[0]['price'] ?>'));
        document.getElementById("rate_rupiah").value = 'Rp ' + formatRupiah(String('<?= $event[0]['price'] ?>'));
        document.getElementById("rate").value = <?= $event[0]['price'] ?>;
        $("#id_student").change(function() {
            var val = $(this).val();
            $.ajax({
                type: "POST",
                url: '<?= site_url() ?>portal/C_Admin/filter_event_student',
                data: {
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
    function myFunction(e) {
        console.log(e.target.value);
        var total_price = 0;
        var temp_val = e.target.value;
        // console.log(temp_val)
        var temp = temp_val.split('<')[0];
        document.getElementById("id_event1").value = temp;

        var temp2 = temp_val.split('<')[2];
        var dateObj = new Date(temp2);

        var curr_date1 = String(dateObj.getDate()).padStart(2, '0');
        var curr_month1 = String(dateObj.getMonth() + 1).padStart(2, '0'); //Months are zero based
        var curr_year1 = dateObj.getFullYear();
        var text_date1 = curr_date1 + "/" + curr_month1 + "/" + curr_year1;
        // console.log(text_date1)

        document.getElementById("date1").value = temp2;
        document.getElementById("event_date1").value = text_date1;

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
                // console.log(text_date)
                total_price = total_price + parseInt(price);

                $("#next_event").append(`
                    <div class="col-lg-12 col-12">
                        <span style="font-weight:bold">Sesi ` + i + `</span>
                        <br>
                    </div>
                    <div class="form-group col-lg-5 col-5">
                        <label for="event_date` + i + `">Event Date</label><br>
                        <input type="text" style="font-size:12px" class="form-control" id="event_date` + i + `" disabled name="event_date` + i + `" value="` + text_date + `">
                        <input type="hidden" class="form-control" id="date` + i + `" required name="date` + i + `" value="` + date + `">
                        <input type="hidden" class="form-control" id="id_event` + i + `" required name="id_event` + i + `" value="` + id_event + `">
                    </div>
                    <div class="form-group col-lg-5 col-5">
                        <label for="price` + i + `">Event Price</label>
                        <input type="text" style="font-size:12px" readonly class="form-control" id="rupiah` + i + `" value="Rp ` + formatRupiah(price) + `"/>
                        <input type="hidden" class="form-control" id="price` + i + `" name="price` + i + `" value="` + price + `">
                    </div>
                    <div class="col-lg-2 col-2">
                        <label class="form-check-label" for="status_event` + i + `"></label>
                        <input type="checkbox" name="status_event` + i + `" value="1" checked class="form-control" id="status_event` + i + `" onclick="check(` + i + `)">
                        <input type="hidden" id="event` + i + `" name="event` + i + `" value="1">
                    </div>
                `);
            }
            // console.log(total_price)
            // console.log(formatRupiah(String(total_price)))
            let discount = document.getElementById('discount').value;
            let persentase = parseInt(total_price) - (parseInt(total_price) * discount / 100);

            document.getElementById("total_price_rupiah").value = 'Rp ' + formatRupiah(String(total_price));
            document.getElementById("total_price").value = total_price;
            document.getElementById("rate_rupiah").value = 'Rp ' + formatRupiah(String(persentase));
            document.getElementById("rate").value = persentase;
        } else {
            document.getElementById("pick_event").classList.add("hiden");
            // console.log(total_price)
            // console.log(formatRupiah(String(total_price)))
            let discount = document.getElementById('discount').value;
            let persentase = parseInt(total_price) - (parseInt(total_price) * discount / 100);

            document.getElementById("total_price_rupiah").value = 'Rp ' + formatRupiah(String(total_price));
            document.getElementById("total_price").value = total_price;
            document.getElementById("rate_rupiah").value = 'Rp ' + formatRupiah(String(persentase));
            document.getElementById("rate").value = persentase;
        }
    }

    function check(i) {
        var data = $('#status_event' + i).val();
        var price = $('#price' + i).val();
        var total_price = $('#total_price').val();
        var discount = $('#discount').val();

        if (data == 0) {
            $('#status_event' + i).val("1");
            $('#event' + i).val("1");
            var temp_price = parseInt(total_price) + parseInt(price);
            $('#total_price_rupiah').val('Rp ' + formatRupiah(String(temp_price)));
            $('#total_price').val(temp_price);
            var tot_temp_price = parseInt(temp_price) - parseInt(discount);
            let persentase = parseInt(temp_price) - (parseInt(temp_price) * discount / 100);

            $('#rate_rupiah').val('Rp ' + formatRupiah(String(persentase)));
            $('#rate').val(persentase);
        } else {
            $('#status_event' + i).val("0");
            $('#event' + i).val("2");
            var temp_price = parseInt(total_price) - parseInt(price);
            $('#total_price_rupiah').val('Rp ' + formatRupiah(String(temp_price)));
            $('#total_price').val(temp_price);
            var tot_temp_price = parseInt(temp_price) - parseInt(discount);
            let persentase = parseInt(temp_price) - (parseInt(temp_price) * discount / 100);

            $('#rate_rupiah').val('Rp ' + formatRupiah(String(persentase)));
            $('#rate').val(persentase);
        }
    }

    var discount_rupiah = document.getElementById('discount_rupiah');
    var discount = document.getElementById('discount');
    var valuee = '';
    discount_rupiah.addEventListener('keyup', function(e) {
        discount_rupiah.value = formatRupiah(this.value);
        valuee = discount_rupiah.value;
        discount.value = valuee.split('.').join("");

        var total_price = $('#total_price').val();
        // let persentase = parseInt(total_price) - (parseInt(total_price) * discount.value / 100);
        let persentase = parseInt(parseInt(total_price) - discount.value);

        $('#rate_rupiah').val('Rp ' + formatRupiah(String(persentase)));
        $('#rate').val(persentase);
    });

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