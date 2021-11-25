<style>
    .add,
    .remove {
        /* background-color: #263850; */
        color: white;
        font-size: 12px;
    }

    h5 {
        font-weight: bold;
    }

    .add:hover,
    .remove:hover {
        /* background-color: #0676BD; */
        color: white;
    }

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
                <a href="<?= site_url() ?>portal/data_paket" class="btn btn-primary">
                    <i class="fa fa-angle-left"></i> Back
                </a>
            </span>
            <span style="float:right;">

            </span>
        </div>

        <hr>
        <h2 style="font-weight:bold">Add Data Package</h2>
        <div class="row">
            <div class="col-lg-12 col-12 mt-4">
                <form action="<?= site_url('portal/C_Admin/add_data_paket') ?>" method="POST">
                    <div class="form-group">
                        <label for="name">Package Name</label>
                        <input type="text" class="form-control" id="name" required name="name">
                    </div>
                    <div class="form-group">
                        <label for="description">Type of Class</label>
                        <select class="form-control" style="width:100%;" name="description" id="description" onchange="descriptionFunc(event)">
                            <option value="Online Private">Online Private</option>
                            <option value="Offline Private">Offline Private</option>
                            <option value="Online Group Class">Online Group Class</option>
                        </select>
                    </div>
                    <div id="status_online_lesson">
                        <div class="form-group">
                            <label for="status_pack_practical">Practical Status</label>
                            <select class="form-control" style="width:100%;" name="status_pack_practical" id="status_pack_practical">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status_pack_theory">Theory Status</label>
                            <select class="form-control" style="width:100%;" name="status_pack_theory" id="status_pack_theory">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="detail">Package Description</label>
                        <textarea class="form-control regist-form" rows="4" name="detail" id="detail"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="price_idr">IDR Price</label>
                        <input type="text" class="form-control" id="price_idr_rupiah" name="price_idr_rupiah" value="0">
                        <input type="hidden" class="form-control" id="price_idr" required name="price_idr">
                    </div>
                    <div class="form-group">
                        <label for="price_euro">Euro Price</label>
                        <input type="text" class="form-control" id="price_euro" required name="price_euro">
                    </div>
                    <div class="form-group">
                        <label for="price_dollar">Dollar Price</label>
                        <input type="text" class="form-control" id="price_dollar" required name="price_dollar">
                    </div>
                    <div class="form-group">
                        <label for="duration">Duration</label>
                        <select class="form-control" style="width:100%;" name="duration" id="duration">
                            <option value="20">20`</option>
                            <option value="30">30`</option>
                            <option value="45">45`</option>
                            <option value="60">60`</option>
                        </select>
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
    })
    var price_idr_rupiah = document.getElementById('price_idr_rupiah');
    var price_idr = document.getElementById('price_idr');
    var valuee2 = '';
    price_idr_rupiah.addEventListener('keyup', function(e) {
        price_idr_rupiah.value = formatRupiah(this.value);
        valuee2 = price_idr_rupiah.value;
        price_idr.value = valuee2.split('.').join("");
    });

    function descriptionFunc(e) {
        var temp_val = e.target.value;
        console.log(temp_val);
        document.getElementById("status_pack_practical").value = "0";
        document.getElementById("status_pack_theory").value = "0";
        if (temp_val === 'Online Private') {
            document.getElementById("status_online_lesson").classList.remove("hiden");
        }
        if (temp_val === 'Offline Private') {
            document.getElementById("status_online_lesson").classList.add("hiden");
        }
        if (temp_val === 'Online Group Class') {
            document.getElementById("status_online_lesson").classList.remove("hiden");
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