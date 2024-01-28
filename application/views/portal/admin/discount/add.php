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
                <a href="<?= site_url() ?>portal/discount" class="btn btn-primary">
                    <i class="fa fa-angle-left"></i> Back
                </a>
            </span>
            <span style="float:right;">

            </span>
        </div>

        <hr>
        <h2 style="font-weight:bold">Add Discount Coupon</h2>
        <div class="row">
            <div class="col-lg-12 col-12 mt-4">
                <form action="<?= site_url('portal/C_Admin/add_data_discount') ?>" method="POST">
                    <div class="form-group">
                        <label for="name_discount">Discount Name</label><br>
                        <input type="text" class="form-control" id="name_discount" required name="name_discount">
                    </div>
                    <div class="form-group">
                        <label for="for_discount">Discount For</label>
                        <select class="form-control" id="for_discount" required name="for_discount">
                            <option value="offline lesson">Offline lesson</option>
                            <option value="online lesson">Online lesson</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jenis_discount">Discount Type</label>
                        <select class="form-control" id="jenis_discount" required name="jenis_discount">
                            <option value="1">Percentage</option>
                            <option value="2">Nominal</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="value_discount">Value/Price</label><br>
                        <input type="text" class="form-control" id="value_discount" required name="value_discount">
                    </div>
                    <div class="form-group">
                        <label for="detail_discount">Detail Discount</label><br>
                        <textarea class="form-control" rows="4" required name="detail_discount" id="detail_discount"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>
    </div>
</main>
<script src="<?= base_url('assets/js/jquery-3.4.0.min.js'); ?>"></script>
<script>
    $(document).ready(function() {});
</script>