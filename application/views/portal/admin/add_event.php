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
        <h2 style="font-weight:bold">Add Event</h2>
        <div class="row">
            <div class="col-lg-12 col-12 mt-4">
                <form action="<?= site_url('portal/C_Admin/add_data_event') ?>" method="POST">
                    <div class="form-group">
                        <label for="event_name">Event Name</label><br>
                        <input type="text" required class="form-control" id="event_name" required name="event_name">
                    </div>
                    <div class="form-group">
                        <input type="hidden" required class="form-control" id="member" required name="member" value="2">
                    </div>
                    <div class="form-group">
                        <label for="event_date">Event Date</label><br>
                        <input type="date" required class="form-control" id="event_date" required name="event_date1">
                        <input type="hidden" value="1" name="total_event_date" id="total_event_date">
                    </div>

                    <div class="form-group">
                        <label for="price">Event Price</label>
                        <input type="text" class="form-control" id="rupiah" />
                        <input type="hidden" class="form-control" id="price" name="price1">
                        <input type="hidden" value="1" name="total_price" id="total_price">
                    </div>
                    <div id="eventDetail2" class="hiden">
                        <hr>
                        <div class="form-group">
                            <label for="event_date">Event Date 2</label><br>
                            <input type="date" class="form-control" id="event_date2" name="event_date2">
                        </div>
                        <div class="form-group">
                            <label for="price">Event Price 2</label>
                            <input type="text" class="form-control" id="rupiah2" />
                            <input type="hidden" class="form-control" id="price2" name="price2">
                        </div>
                    </div>

                    <div id="eventDetail3" class="hiden">
                        <hr>
                        <div class="form-group">
                            <label for="event_date">Event Date 3</label><br>
                            <input type="date" class="form-control" id="event_date3" name="event_date3">
                        </div>
                        <div class="form-group">
                            <label for="price">Event Price 3</label>
                            <input type="text" class="form-control" id="rupiah3" />
                            <input type="hidden" class="form-control" id="price3" name="price3">
                        </div>
                    </div>

                    <div id="eventDetail4" class="hiden">
                        <hr>
                        <div class="form-group">
                            <label for="event_date">Event Date 4</label><br>
                            <input type="date" class="form-control" id="event_date4" name="event_date4">
                        </div>
                        <div class="form-group">
                            <label for="price">Event Price 4</label>
                            <input type="text" class="form-control" id="rupiah4" />
                            <input type="hidden" class="form-control" id="price4" name="price4">
                        </div>
                    </div>

                    <div id="eventDetail5" class="hiden">
                        <hr>
                        <div class="form-group">
                            <label for="event_date">Event Date 5</label><br>
                            <input type="date" class="form-control" id="event_date5" name="event_date5">
                        </div>
                        <div class="form-group">
                            <label for="price">Event Price 5</label>
                            <input type="text" class="form-control" id="rupiah5" />
                            <input type="hidden" class="form-control" id="price5" name="price5">
                        </div>
                    </div>


                    <div class="form-group form-check">
                        <div class="pt-2">
                            <button type="button" class="add btn btn-info">+</button>
                            <button type="button" class="remove btn btn-danger"><i class="fa fa-trash icon-white"></i></button>
                        </div>
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
        $('.add').on('click', add);
        $('.remove').on('click', remove);

        function add() {
            add_event_date();
            // add_price();
        }

        function remove() {
            remove_event_date();
            // remove_price();
        }

        function add_event_date() {
            var new_event_date_no = parseInt($('#total_event_date').val()) + 1;
            // var new_input = "<input class='form-control mt-2' placeholder='Date Event " + new_event_date_no + "..' name='event_date" + new_event_date_no + "' type='date' id='new_" + new_event_date_no + "'>";

            // $('#new_event_date').append(new_input);
            console.log(new_event_date_no);
            switch (new_event_date_no) {
                case 2:
                    document.getElementById("eventDetail2").classList.remove("hiden");
                    break;
                case 3:
                    document.getElementById("eventDetail3").classList.remove("hiden");
                    break;
                case 4:
                    document.getElementById("eventDetail4").classList.remove("hiden");
                    break;
                case 5:
                    document.getElementById("eventDetail5").classList.remove("hiden");
                    break;
                case 6:
                    alert('Maksimal total event!');
                    break;
            }
            if (new_event_date_no < 6) {
                $('#total_event_date').val(new_event_date_no);
            }
        }

        function remove_event_date() {
            var last_dob_no = $('#total_event_date').val();
            if (last_dob_no > 1) {
                // $('#new_' + last_dob_no).remove();
                switch (last_dob_no) {
                    case '2':
                        document.getElementById("eventDetail2").classList.add("hiden");
                        document.getElementById('event_date2').value = '';
                        document.getElementById('rupiah2').value = '';
                        document.getElementById('price2').value = '';
                        break;
                    case '3':
                        document.getElementById("eventDetail3").classList.add("hiden");
                        document.getElementById('event_date3').value = '';
                        document.getElementById('rupiah3').value = '';
                        document.getElementById('price3').value = '';
                        break;
                    case '4':
                        document.getElementById("eventDetail4").classList.add("hiden");
                        document.getElementById('event_date4').value = '';
                        document.getElementById('rupiah4').value = '';
                        document.getElementById('price4').value = '';
                        break;
                    case '5':
                        document.getElementById("eventDetail5").classList.add("hiden");
                        document.getElementById('event_date5').value = '';
                        document.getElementById('rupiah5').value = '';
                        document.getElementById('price5').value = '';
                        break;
                }

                $('#total_event_date').val(last_dob_no - 1);
            }
        }

        // function add_price() {
        //     var new_price_no = parseInt($('#total_price').val()) + 1;
        //     // var new_input = "<input type='text' name='currency-field' id='currency-field' pattern='^\$\d{1,3}(,\d{3})*(\.\d+)?$' value='' data-type='currency' placeholder='$1,000,000.00'><input pattern='^\$\d{1,3}(,\d{3})*(\.\d+)?$' data-type='currency' type='text' class='form-control  mt-2' placeholder='Price event " + new_price_no + "..' id='rupiah_" + new_price_no + "' /><input class='form-control mt-2' name='price" + new_price_no + "' type='text' id='price_" + new_price_no + "'>";

        //     // $('#new_price').append(new_input);

        //     $('#total_price').val(new_price_no);
        // }

        // function remove_price() {
        //     var last_school_no = $('#total_price').val();

        //     if (last_school_no > 1) {
        //         // $('#price_' + last_school_no).remove();
        //         // $('#rupiah_' + last_school_no).remove();
        //         $('#total_price').val(last_school_no - 1);
        //     }
        // }
    });

    var price = document.getElementById('price');
    var rupiah = document.getElementById('rupiah');
    var valuee = '';
    rupiah.addEventListener('keyup', function(e) {
        rupiah.value = formatRupiah(this.value);
        valuee = rupiah.value;
        price.value = valuee.split('.').join("");
    });

    var price2 = document.getElementById('price2');
    var rupiah2 = document.getElementById('rupiah2');
    var valuee2 = '';
    rupiah2.addEventListener('keyup', function(e) {
        rupiah2.value = formatRupiah(this.value);
        valuee2 = rupiah2.value;
        price2.value = valuee2.split('.').join("");
    });

    var price3 = document.getElementById('price3');
    var rupiah3 = document.getElementById('rupiah3');
    var valuee3 = '';
    rupiah3.addEventListener('keyup', function(e) {
        rupiah3.value = formatRupiah(this.value);
        valuee3 = rupiah3.value;
        price3.value = valuee3.split('.').join("");
    });

    var price4 = document.getElementById('price4');
    var rupiah4 = document.getElementById('rupiah4');
    var valuee4 = '';
    rupiah4.addEventListener('keyup', function(e) {
        rupiah4.value = formatRupiah(this.value);
        valuee4 = rupiah4.value;
        price4.value = valuee4.split('.').join("");
    });

    var price5 = document.getElementById('price5');
    var rupiah5 = document.getElementById('rupiah5');
    var valuee5 = '';
    rupiah5.addEventListener('keyup', function(e) {
        rupiah5.value = formatRupiah(this.value);
        valuee5 = rupiah5.value;
        price5.value = valuee5.split('.').join("");
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