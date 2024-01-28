<style>
    label {
        font-weight: normal !important;
    }

    h5 {
        font-weight: bold;
    }

    .login-form {
        font-weight: bold;
        border: 0;
        height: 40px;
        border-radius: 0;
        background-color: white;
    }

    .login-form:focus {
        box-shadow: none;
        outline: 0;
        background-color: white;
    }

    .hiden {
        display: none;
    }
</style>
<main class="page-content">
    <div class="container-fluid">
        <div class="row pr-3">
            <div class="col-lg-12 col-12">
                <h5 style="font-family:mReguler" class="font-weight-bold">Person in Charge (Parent) Information</h5>
            </div>
            <div class="col-lg-4 col-2" id="divImg">

            </div>
            <div class="col-lg-2 col-2">
                <!-- <a href="<?= site_url() ?>portal/profile-parent/edit/<?= $this->session->userdata('id') ?>" class="btn btn-primary">
                    Edit
                </a> -->
            </div>
        </div>
        <div class="row pt-lg-3 pt-2">
            <div class="col-lg-12">
                <?php if ($this->session->flashdata('success') != null) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= $this->session->flashdata('success') ?>
                    </div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('warning') != null) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $this->session->flashdata('warning') ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row pr-lg-3 pl-lg-3">
            <div class="col-lg-12 mt-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row pr-3">
                            <div class="col-lg-6 col-6">
                                <h5 style="font-family:mReguler" class="font-weight-bold">PROFILE</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-12">
                                <div class="mr-lg-3 ml-lg-3 mt-3">
                                    <table id="profileParent" class="table table-striped table-white display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>ID Person in Charge</th>
                                                <th>Person in Charge Name</th>
                                                <th>Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    1
                                                </td>
                                                <td>
                                                    <?= $student[0]['id_parent'] ?>
                                                </td>
                                                <td>
                                                    <?= $student[0]['parent_student'] ?>
                                                </td>
                                                <td>
                                                    <a href="<?= site_url('portal/profile-parent/detail/' . $student[0]['id_parent']) ?>" class="btn btn-primary mr-2 btn-update" title="Detail"> <i class="fa fa-info"></i> </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pr-lg-3 pl-lg-3 justify-content-center">
            <!-- <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">PROFILE</h5>
                        <hr />
                        <p>ID : <?= $student[0]['id_parent'] ?></p>
                        <p>Name : <?= $student[0]['parent_student'] ?></p>
                        <p>Email : <?= $student[0]['email_parent_1'] ?></p>
                        <p>Instagram : <?= $student[0]['ig_parent_1'] ?></p>
                        <p>Phone No. : <?= $student[0]['phone_parent_1'] ?></p>
                        <p>Phone No. Alternative : <?= $student[0]['phone_parent_2'] ?></p>
                        <p>Username : <?= $student[0]['username_parent'] ?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">ADDRESS</h5>
                        <hr />
                        <p>Street : <?= $student[0]['address_parent']  ?></p>
                        <p>Sub District : <?= $student[0]['kelurahan_parent']  ?></p>
                        <p>District : <?= $student[0]['kecamatan_parent']  ?></p>
                        <p>City : <?= $student[0]['kota_parent']  ?></p>
                        <p>Postal Code : <?= $student[0]['zip_parent']  ?></p>
                        <p>Province : <?= $student[0]['provinsi_parent']  ?></p>
                        <p>Country : <?= $student[0]['country_parent']  ?></p>
                    </div>
                </div>
            </div> -->
            <div class="col-lg-12 mt-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row pr-3">
                            <div class="col-lg-6 col-12 text-center text-lg-left">
                                <span style="font-family:mReguler; font-size:20px;" class="font-weight-bold">
                                    STUDENT INFORMATION
                                </span>
                            </div>
                            <div class="col-lg-6 col-12 text-center text-lg-right">
                                <a href="<?= site_url() ?>portal/profile-parent/student/add/<?= $this->session->userdata('id') ?>" class="btn btn-primary">
                                    add student
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-12">
                                <div class="mr-lg-3 ml-lg-3 mt-3">
                                    <table id="example" class="table table-striped table-white display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>ID Student</th>
                                                <th>Student Name</th>
                                                <th>Instrument</th>
                                                <th>Name Package</th>
                                                <th>Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="<?= base_url('assets/js/jquery-3.4.0.min.js'); ?>"></script>
<!-- Optional JavaScript -->
<script>
    function openPass() {
        $('.iconEye').removeClass('fa-eye-slash');
        $('.iconEye').addClass('fa-eye');
        $(".pwd").replaceWith($('.pwd').clone().attr('type', 'text'));
        $('#btn-eye').removeAttr("onclick");
        $('#btn-eye').attr("onclick", 'closePass()');
    }

    function closePass() {
        $('.iconEye').removeClass('fa-eye');
        $('.iconEye').addClass('fa-eye-slash');
        $(".pwd").replaceWith($('.pwd').clone().attr('type', 'password'));
        $('#btn-eye').removeAttr("onclick");
        $('#btn-eye').attr("onclick", 'openPass()');
    }

    $(document).ready(function() {
        var x = window.matchMedia("(max-width: 990px)");
        myFunction(x); // Call listener function at run time
        x.addListener(myFunction); // Attach listener function on state changes

        function myFunction(x) {
            if (x.matches) { // If media query matches
                $('.head-login').addClass('text-center');
            } else {
                $('.head-login').removeClass('text-center');
            }
        };
    });
</script>
<script>
    $(document).ready(function() {
        $('#profileParent').DataTable({
            "paging": false,
            "ordering": false,
            "info": false,
            "searching": false,
            "scrollX": true,
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            // "responsive": true,
            'columnDefs': [{
                'targets': [0, 1, 2], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
            }, {
                targets: 2,
                "className": "text-center",
            }, ],
        });
        $('#example').DataTable({
            // "responsive": true,
            "paging": false,
            "ordering": false,
            "info": false,
            "searching": false,
            "scrollX": true,
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('portal/C_Parent/get_ajax_student') ?>",
                "type": "POST"
            },
            'columnDefs': [{
                'targets': [0, 3], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
            }, {
                targets: 3,
                "className": "text-center",
            }, ],
            "order": [
                [1, 'asc']
            ],
        });

        var x = window.matchMedia("(min-width: 350px)");
        myFunction(x); // Call listener function at run time
        x.addListener(myFunction); // Attach listener function on state changes

        function myFunction(x) {
            if (x.matches) { // If media query matches
                $('#example_filter').removeClass('hiden');
            } else {
                $('#example_filter').addClass('hiden');
            }
        };
    });
</script>