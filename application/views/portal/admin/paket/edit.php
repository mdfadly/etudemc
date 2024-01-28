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
        <h2 style="font-weight:bold">Edit Data Package</h2>
        <div class="row">
            <div class="col-lg-12 col-12 mt-4">
                <form action="<?= site_url('portal/C_Admin/edit_data_paket') ?>" method="POST">
                    <div class="form-group">
                        <label for="name" style="font-weight:bold">Package Name</label>
                        <input type="text" class="form-control" id="name" required value="<?= $paket[0]['name'] ?>" name="name">
                        <input type="hidden" class="form-control" id="id" required value="<?= $paket[0]['id'] ?>" name="id">
                    </div>
                    <div class="form-group">
                        <label for="tipe">Type of Class</label>
                        <div id="tipeInput" class="form-group">
                            <select class="form-control" style="width:100%;" name="tipe" id="tipe" onchange="tipeFunc(event)">
                                <option>--- Pilih Tipe ---</option>
                                <option value="Offline">Offline</option>
                                <option value="Online">Online</option>
                            </select>
                        </div>
                        <div id="categoryInput" class="form-group">
                            <select class="form-control" style="width:100%;" name="tipe_cat" id="category" onchange="categoryFunc(event)">
                                <option>--- Pilih Category ---</option>
                                <option value="Group">Group</option>
                                <option value="Private">Private</option>
                            </select>
                        </div>
                        <div id="subCategoryInput" class="form-group">
                            <select class="form-control" style="width:100%;" name="tipe_sub" id="subCategory" onchange="subCategoryFunc(event)">
                            </select>
                        </div>
                        <div id="detailCategoryInput" class="form-group">
                            <select class="form-control" style="width:100%;" name="tipe_detail" id="detailCategory" onchange="detailCategoryFunc(event)">
                            </select>
                        </div>
                        <div id="durationInput" class="form-group">
                            <label for="duration">Duration</label>
                            <select class="form-control" style="width:100%;" name="duration" id="duration">
                            </select>
                        </div>
                        <!-- <small id="text_status" class="text-danger">Choose type class</small> -->
                    </div>
                    <div id="detail-package" class="">
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
                            <textarea class="form-control regist-form" rows="4" name="detail" id="detail"><?= $paket[0]['detail'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="price_idr">IDR Price</label>
                            <input type="text" class="form-control" id="price_idr_rupiah" name="price_idr_rupiah" value="0">
                            <input type="hidden" class="form-control" id="price_idr" required name="price_idr" value="<?= $paket[0]['price_idr'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="price_euro">Euro Price</label>
                            <input type="text" class="form-control" id="price_euro" required value="<?= $paket[0]['price_euro'] ?>" name="price_euro">
                        </div>
                        <div class="form-group">
                            <label for="price_dollar">Dollar Price</label>
                            <input type="text" class="form-control" id="price_dollar" required value="<?= $paket[0]['price_dollar'] ?>" name="price_dollar">
                        </div>
                    </div>
                    <button id="btn_submit" type="submit" class="btn btn-primary btn-block">Submit</button>
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

        let tipe = "<?= $paket[0]['tipe'] ?>";
        let tipe_cat = "<?= $paket[0]['tipe_cat'] ?>";
        let tipe_sub = "<?= $paket[0]['tipe_sub'] ?>";
        let tipe_detail = "<?= $paket[0]['tipe_detail'] ?>";
        let durationTipe = "<?= $paket[0]['duration'] ?>";

        if (tipe_detail === null || tipe_detail === '') {
            document.getElementById("detailCategoryInput").classList.add("hiden");
            document.getElementById("durationInput").classList.add("hiden");
        }

        document.getElementById("tipe").value = tipe;
        document.getElementById("category").value = tipe_cat;

        let componentSub = "<option>--- Pilih Sub Category ---</option>";
        let componentDetail = "<option>--- Pilih Detail ---</option>";
        let componentDuration = "<option>--- Pilih Duration ---</option>";

        switch (tipe_cat) {
            case "Group":
                switch (tipe) {
                    case "Offline":
                        componentSub += '<option value="Music Class">Music Class</option>';
                        break;
                    case "Online":
                        componentSub += '<option value="Music Group Lesson">Music Group Lesson</option><option value="Theory Group Class">Theory Group Class</option><option value="Composser Group Class">Composser Group Class</option>';
                        if (tipe_sub === "Composser Group Class") {
                            componentDetail += '<option value="Advanced">Advanced</option><option value="Beginner">Beginner</option>';
                        }
                        if (tipe_sub === "Theory Group Class") {
                            componentDetail += '<option value="Baby Toddler">Baby Toddler</option><option value="Theory Class">Theory Class</option>';
                            componentDuration += '<option value="1 x 30`">1 x 30`</option>';
                        }
                        break;
                    default:
                        return;
                }
                break;
            case "Private":
                componentSub += '<option value="Private Regular Class">Private Regular Class</option><option value="Private Master Class">Private Master Class</option>';
                if (tipe_sub === "Private Regular Class") {
                    componentDetail += '<option value="Bachelor">Bachelor</option><option value="Master">Master</option>';
                    if (tipe === "Offline") {
                        componentDuration += '<option value="30`">30`</option><option value="45`">45`</option><option value="60`">60`</option>';
                    } else {
                        componentDuration += '<option value="2x30` + theory">2x30` + theory</option><option value="2x30`">2x30`</option><option value="2x20`">2x20`</option>';
                    }
                }
                break;
            default:
                return;
        }

        $('#subCategory').html(componentSub);
        $('#detailCategory').html(componentDetail);
        $('#duration').html(componentDuration);

        document.getElementById("subCategory").value = tipe_sub;
        document.getElementById("detailCategory").value = tipe_detail;
        document.getElementById("duration").value = durationTipe;

        document.getElementById("price_idr_rupiah").value = formatRupiah(String(<?= $paket[0]['price_idr'] ?>));
        document.getElementById("status_pack_practical").value = '<?= $paket[0]['status_pack_practical'] ?>';
        document.getElementById("status_pack_theory").value = '<?= $paket[0]['status_pack_theory'] ?>';
    })

    var price_idr_rupiah = document.getElementById('price_idr_rupiah');
    var price_idr = document.getElementById('price_idr');
    var valuee2 = '';
    price_idr_rupiah.addEventListener('keyup', function(e) {
        price_idr_rupiah.value = formatRupiah(this.value);
        valuee2 = price_idr_rupiah.value;
        price_idr.value = valuee2.split('.').join("");
    });

    $('#btn_reset').click(function() {
        if (confirm("Apakah ingin reset form?") == true) {
            location.reload();
        }
    });

    function tipeFunc(e) {
        if (e.target.value === "Offline" || e.target.value === "Online") {
            document.getElementById("tipeInput").classList.add("hiden");
            document.getElementById("categoryInput").classList.remove("hiden");
        }
        document.getElementById("detail-package").classList.add("hiden");
        $("#btn_submit").attr('disabled', 'disabled');
    }

    function categoryFunc(e) {
        let tipe = document.getElementById('tipe').value;
        let component = "";
        switch (e.target.value) {
            case "Group":
                switch (tipe) {
                    case "Offline":
                        component += '<option>--- Pilih Sub Category ---</option><option value="Music Class">Music Class</option>';
                        break;
                    case "Online":
                        component += '<option>--- Pilih Sub Category ---</option><option value="Music Group Lesson">Music Group Lesson</option><option value="Theory Group Class">Theory Group Class</option><option value="Composser Group Class">Composser Group Class</option>';
                        break;
                    default:
                        $("#btn_submit").attr('disabled', 'disabled');
                        return;
                }
                break;
            case "Private":
                component += '<option>--- Pilih Sub Category ---</option><option value="Private Regular Class">Private Regular Class</option><option value="Private Master Class">Private Master Class</option>';
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
        if (subCategory === "Music Group Lesson" || subCategory === "Theory Group Class" || subCategory === "Music Class" || subCategory === "Private Master Class") {
            document.getElementById("detail-package").classList.remove("hiden");
            $("#btn_submit").removeAttr('disabled');
        } else {
            document.getElementById("detail-package").classList.add("hiden");
            $("#btn_submit").attr('disabled', 'disabled');
        }
        switch (subCategory) {
            case "Composser Group Class":
                component += '<option>--- Pilih Detail ---</option><option value="Advanced">Advanced</option><option value="Beginner">Beginner</option>';
                $('#detailCategory').html(component);
                document.getElementById("subCategoryInput").classList.add("hiden");
                document.getElementById("detailCategoryInput").classList.remove("hiden");
                $("#btn_submit").attr('disabled', 'disabled');
                break;
            case "Private Regular Class":
                component += '<option>--- Pilih Detail ---</option><option value="Bachelor">Bachelor</option><option value="Master">Master</option>';
                $('#detailCategory').html(component);
                document.getElementById("subCategoryInput").classList.add("hiden");
                document.getElementById("detailCategoryInput").classList.remove("hiden");
                $("#btn_submit").attr('disabled', 'disabled');
                break;
            default:
                return;
        }
    }

    function detailCategoryFunc(e) {
        let tipe = document.getElementById('tipe').value;
        let subCategory = document.getElementById('subCategory').value;
        let component = "<option>--- Pilih Duration ---</option>";
        switch (subCategory) {
            case "Private Regular Class":
                switch (tipe) {
                    case "Offline":
                        component += '<option value="30`">30`</option><option value="45`">45`</option><option value="60`">60`</option>';
                        $('#duration').html(component);
                        document.getElementById("durationInput").classList.remove("hiden");
                        document.getElementById("detail-package").classList.remove("hiden");
                        $("#btn_submit").removeAttr('disabled');
                        break;
                    case "Online":
                        component += '<option value="2x30` + theory">2x30` + theory</option><option value="2x30`">2x30`</option><option value="2x20`">2x20`</option>';
                        $('#duration').html(component);
                        document.getElementById("durationInput").classList.remove("hiden");
                        document.getElementById("detail-package").classList.remove("hiden");
                        $("#btn_submit").removeAttr('disabled');
                        break;
                    default:
                        $("#btn_submit").attr('disabled', 'disabled');
                        return;
                }
                break;
            case "Composser Group Class":
                document.getElementById("detail-package").classList.remove("hiden");
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