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
                        <label for="tipe">Type of Class</label>
                        <div id="tipeInput" class="form-group">
                            <select class="form-control" style="width:100%;" name="tipe" id="tipe" onchange="tipeFunc(event)">
                                <option>--- Choose Type ---</option>
                                <option value="Offline">Offline</option>
                                <option value="Online">Online</option>
                            </select>
                        </div>
                        <div id="categoryInput" class="form-group hiden">
                            <select class="form-control" style="width:100%;" name="tipe_cat" id="category" onchange="categoryFunc(event)">
                                <option>--- Choose Category ---</option>
                                <option value="Group">Group</option>
                                <option value="Private">Private</option>
                            </select>
                        </div>
                        <div id="subCategoryInput" class="form-group hiden">
                            <select class="form-control" style="width:100%;" name="tipe_sub" id="subCategory" onchange="subCategoryFunc(event)">
                            </select>
                        </div>
                        <div id="detailCategoryInput" class="form-group hiden">
                            <select class="form-control" style="width:100%;" name="tipe_detail" id="detailCategory" onchange="detailCategoryFunc(event)">
                            </select>
                        </div>
                        <div id="durationInput" class="form-group hiden">
                            <label for="duration">Duration</label>
                            <select class="form-control" style="width:100%;" name="duration" id="duration">
                            </select>
                        </div>
                        <small id="text_status" class="text-danger">Choose type class</small>
                    </div>
                    <div id="detail-package" class="hiden">
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
                    </div>
                    <button id="btn_submit" type="submit" disabled class="btn btn-primary btn-block">Submit</button>
                    <a id="btn_reset" class="btn btn-danger btn-block text-white" style="cursor:pointer">Reset</a>
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

    $('#btn_reset').click(function() {
        if (confirm("Reset this item?") == true) {
            document.getElementById("text_status").classList.remove("hiden");
            location.reload();
        }
    });

    var price_idr_rupiah = document.getElementById('price_idr_rupiah');
    var price_idr = document.getElementById('price_idr');
    var valuee2 = '';
    price_idr_rupiah.addEventListener('keyup', function(e) {
        price_idr_rupiah.value = formatRupiah(this.value);
        valuee2 = price_idr_rupiah.value;
        price_idr.value = valuee2.split('.').join("");
    });

    function tipeFunc(e) {
        if (e.target.value === "Offline" || e.target.value === "Online") {
            document.getElementById("tipeInput").classList.add("hiden");
            document.getElementById("categoryInput").classList.remove("hiden");
        }
    }

    function categoryFunc(e) {
        let tipe = document.getElementById('tipe').value;
        let component = "";
        switch (e.target.value) {
            case "Group":
                switch (tipe) {
                    case "Offline":
                        component += '<option>--- Choose Sub Category ---</option><option value="Music Class">Music Class</option>';
                        break;
                    case "Online":
                        component += '<option>--- Choose Sub Category ---</option><option value="Music Group Lesson">Music Group Lesson</option><option value="Theory Group Class">Theory Group Class</option><option value="Composser Group Class">Composser Group Class</option>';
                        break;
                    default:
                        $("#btn_submit").attr('disabled', 'disabled');
                        return;
                }
                break;
            case "Private":
                component += '<option>--- Choose Sub Category ---</option><option value="Private Regular Class">Private Regular Class</option><option value="Private Master Class">Private Master Class</option>';
                break;
            default:
                $("#btn_submit").attr('disabled', 'disabled');
                return;
        }
        $('#subCategory').html(component);
        document.getElementById("categoryInput").classList.add("hiden");
        document.getElementById("subCategoryInput").classList.remove("hiden");
    }

    function subCategoryFunc(e) {
        let category = document.getElementById('category').value;
        let subCategory = document.getElementById('subCategory').value;
        let component = "";
        if (subCategory === "Music Group Lesson" || subCategory === "Music Class" || subCategory === "Private Master Class") {
            document.getElementById("text_status").classList.add("hiden");
            document.getElementById("detail-package").classList.remove("hiden");
            $("#btn_submit").removeAttr('disabled');
        } else {
            document.getElementById("text_status").classList.remove("hiden");
            document.getElementById("detail-package").classList.add("hiden");
            $("#btn_submit").attr('disabled', 'disabled');
        }
        switch (subCategory) {
            case "Theory Group Class":
                console.log('halo theory group class')
                component += '<option>--- Choose Detail ---</option><option value="Baby Toddler">Baby Toddler</option><option value="Theory Class">Theory Class</option>';
                $('#detailCategory').html(component);
                document.getElementById("text_status").classList.remove("hiden");
                document.getElementById("subCategoryInput").classList.add("hiden");
                document.getElementById("detailCategoryInput").classList.remove("hiden");
                $("#btn_submit").attr('disabled', 'disabled');
                break;
            case "Composser Group Class":
                component += '<option>--- Choose Detail ---</option><option value="Advanced">Advanced</option><option value="Beginner">Beginner</option>';
                $('#detailCategory').html(component);
                document.getElementById("text_status").classList.remove("hiden");
                document.getElementById("subCategoryInput").classList.add("hiden");
                document.getElementById("detailCategoryInput").classList.remove("hiden");
                $("#btn_submit").attr('disabled', 'disabled');
                break;
            case "Private Regular Class":
                component += '<option>--- Choose Detail ---</option><option value="Bachelor">Bachelor</option><option value="Master">Master</option>';
                $('#detailCategory').html(component);
                document.getElementById("text_status").classList.remove("hiden");
                document.getElementById("subCategoryInput").classList.add("hiden");
                document.getElementById("detailCategoryInput").classList.remove("hiden");
                $("#btn_submit").attr('disabled', 'disabled');
                break;
            default:
                document.getElementById("text_status").classList.add("hiden");
                return;
        }
    }

    function detailCategoryFunc(e) {
        let tipe = document.getElementById('tipe').value;
        let subCategory = document.getElementById('subCategory').value;
        let component = "<option>--- Choose Duration ---</option>";
        switch (subCategory) {
            case "Private Regular Class":
                switch (tipe) {
                    case "Offline":
                        component += '<option value="30`">30`</option><option value="45`">45`</option><option value="60`">60`</option>';
                        $('#duration').html(component);
                        document.getElementById("durationInput").classList.remove("hiden");
                        document.getElementById("detail-package").classList.remove("hiden");
                        document.getElementById("text_status").classList.add("hiden");
                        $("#btn_submit").removeAttr('disabled');
                        break;
                    case "Online":
                        component += '<option value="2x30` + theory">2x30` + theory</option><option value="2x30`">2x30`</option><option value="2x20`">2x20`</option>';
                        $('#duration').html(component);
                        document.getElementById("durationInput").classList.remove("hiden");
                        document.getElementById("detail-package").classList.remove("hiden");
                        document.getElementById("text_status").classList.add("hiden");
                        $("#btn_submit").removeAttr('disabled');
                        break;
                    default:
                        $("#btn_submit").attr('disabled', 'disabled');
                        return;
                }
                break;
            case "Composser Group Class":
                document.getElementById("detail-package").classList.remove("hiden");
                document.getElementById("text_status").classList.add("hiden");
                $("#btn_submit").removeAttr('disabled');
                break;
            case "Theory Group Class":
                component = "";
                component += '<option value="1 x 30`">1 x 30`</option>';
                $('#duration').html(component);
                document.getElementById("durationInput").classList.remove("hiden");
                document.getElementById("detail-package").classList.remove("hiden");
                document.getElementById("text_status").classList.add("hiden");
                $("#btn_submit").removeAttr('disabled');
                break;
            default:
                return;
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