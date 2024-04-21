<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Teacher extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_Portal');
        $this->load->model('M_Teacher');
        $this->load->model('M_Admin');
    }

    private function cekLogin()
    {
        if (!$this->session->userdata('login_user')) {
            redirect('portal/user-login');
        }
    }

    public function get_offline_lesson()
    {
        $this->cekLogin();
        $id_teacher = $_POST['id_teacher'];
        $this->get_ajax_offline_lesson2($id_teacher);
    }

    function get_ajax_offline_lesson($id_teacher)
    {
        $this->cekLogin();
        $dbTable = "offline_lesson";
        $list = $this->M_Teacher->get_datatables($dbTable, $id_teacher);

        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            // $row[] = $no . ".";
            $row[] = $item->name_student;
            // add html for action
            $row[] = '<div class="btn-group"><a href="' . site_url('portal/offline_lesson/attendance/' . $item->id_offline_lesson) . '" class="btn btn-primary mr-2" title="Edit Data ini"> <i class="fa fa-info"></i> </a></div>';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_Teacher->count_all($dbTable, $id_teacher),
            "recordsFiltered" => $this->M_Teacher->count_filtered($dbTable, $id_teacher),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    function get_ajax_offline_lesson2($id_teacher)
    {
        $this->cekLogin();
        $dbTable = "list_package_offline";
        $list = $this->M_Teacher->get_datatables($dbTable, $id_teacher);

        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();

            $count_done = 0;
            $count_cancel = 0;
            $count_ongoing = 0;
            $data_schedule = $this->M_Teacher->getData_schedule_package_offline(null, $item->id_list_package_offline);
            foreach ($data_schedule as $ds) {
                if ($ds['status'] == '1' || ($ds['status'] == '3' && $ds['date_update_cancel'] == null) || $ds['status'] == '7' || $ds['status'] == '5') {
                    $count_ongoing += 1;
                } else if ($ds['status'] == '2' || ($ds['status'] == '3' && $ds['date_update_cancel'] != null)) {
                    $count_done += 1;
                } else if ($ds['status'] == '3' && $ds['date_update_cancel'] == null) {
                    $count_cancel += 1;
                }
            }

            $row[] = $item->name_student;

            $startdate = date_create(substr($item->created_at, 0, 10));
            $tgl_awal = date_format($startdate, "d/m/Y");

            $enddate = date_create(substr($item->end_at, 0, 10));
            $tgl_akhir = date_format($enddate, "d/m/Y");

            $today = date("Y-m-d");

            $row[] = $tgl_awal . " - " . $tgl_akhir;

            $status_pack = "";
            if ($count_ongoing == 0 && $count_done == 0 && $count_cancel == 0) {
                $status_pack = '<span class="badge badge-danger text-white">InActive</span>';
            } else {
                if (count($data_schedule) == $count_done) {
                    $status_pack = '<span class="badge badge-danger">InActive</span>';
                } else if (($count_ongoing == 2) && $count_done > 0) {
                    $status_pack = '<span class="badge badge-warning text-white">2 pack more!</span>';
                } else if (($count_ongoing == 1) && $count_done > 0) {
                    $status_pack = '<span class="badge badge-warning text-white">1 pack more!</span>';
                } else {
                    $status_pack = '<span class="badge text-white" style="background-color:#00B050">Active</span>';
                }
            }
            $row[] = $status_pack;
            // $row[] = $status_pack ." - ". $count_ongoing ." - " . $count_done ." - " . $count_cancel;
            // add html for action
            if ($count_ongoing == 0 && $count_done == 0 && $count_cancel == 0) {
                $row[] = '';
            } else {
                if (count($data_schedule) == $count_done) {
                    $row[] = '<a class="text-danger" href="' . site_url('portal/offline_lesson/attendance/' . $item->id_list_package_offline) . '" style="font-size:23px;"> <i class="fa fa-calendar"></i> </a><br>';
                } else if (($count_ongoing == 2 || $count_ongoing == 1) && $count_done > 0) {
                    $row[] = '<a class="text-warning" href="' . site_url('portal/offline_lesson/attendance/' . $item->id_list_package_offline) . '" style="font-size:23px;"> <i class="fa fa-calendar"></i> </a><br>';
                } else {
                    $row[] = '<a href="' . site_url('portal/offline_lesson/attendance/' . $item->id_list_package_offline) . '" style="font-size:23px; color:#00B050"> <i class="fa fa-calendar"></i> </a><br>';
                }
            }
            // if ($count_ongoing == 0 && $count_done == 0 && $count_cancel == 0) {
            //     $row[] = '';
            // }else{
            //     $row[] = '<div class="btn-group"><a href="' . site_url('portal/offline_lesson/attendance/' . $item->id_list_package_offline) . '" class="btn btn-primary mr-2" title="Edit Data ini"> <i class="fa fa-info"></i> </a></div>';
            // }
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_Teacher->count_all($dbTable, $id_teacher),
            "recordsFiltered" => $this->M_Teacher->count_filtered($dbTable, $id_teacher),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    public function get_online_pratical()
    {
        $this->cekLogin();
        $id_teacher = $_POST['id_teacher'];
        $jenis = $_POST['jenis'];
        $this->get_ajax_online_pratical($id_teacher, $jenis);
    }

    function get_ajax_online_pratical($id_teacher, $jenis)
    {
        $this->cekLogin();
        $dbTable = "list_package";
        // $jenis = '1';
        $list = $this->M_Teacher->get_datatables($dbTable, $id_teacher, null, null, $jenis);

        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            // $row[] = $no . ".";

            $count_done = 0;
            $count_cancel = 0;
            $count_ongoing = 0;
            $data_schedule = $this->M_Teacher->getData_schedule_package(null, $item->id_list_pack, null, null, $jenis);
            foreach ($data_schedule as $ds) {
                if ($ds['status'] == '1' || ($ds['status'] == '3' && $ds['date_update_cancel'] == null) || $ds['status'] == '7' || $ds['status'] == '5') {
                    $count_ongoing += 1;
                } else if ($ds['status'] == '2' || ($ds['status'] == '3' && $ds['date_update_cancel'] != null)) {
                    $count_done += 1;
                } else if ($ds['status'] == '3' && $ds['date_update_cancel'] == null) {
                    $count_cancel += 1;
                }
            }

            $row[] = $item->name_student;

            $startdate = date_create(substr($item->created_at, 0, 10));
            $tgl_awal = date_format($startdate, "d/m/Y");

            $enddate = date_create(substr($item->end_at, 0, 10));
            $tgl_akhir = date_format($enddate, "d/m/Y");

            $today = date("Y-m-d");

            $row[] = $tgl_awal . " - " . $tgl_akhir;

            $status_pack = "";
            if ($count_ongoing == 0 && $count_done == 0 && $count_cancel == 0) {
                $status_pack = '<span class="badge badge-danger text-white">InActive</span>';
            } else {
                if (count($data_schedule) == $count_done) {
                    $status_pack = '<span class="badge badge-danger">InActive</span>';
                } else if (($count_ongoing == 3 || $count_ongoing == 4) && $count_done > 0) {
                    $status_pack = '<span class="badge badge-warning text-white">2 pack more!</span>';
                } else if (($count_ongoing == 2 || $count_ongoing == 1) && $count_done > 0) {
                    $status_pack = '<span class="badge badge-warning text-white">1 pack more!</span>';
                } else {
                    $status_pack = '<span class="badge text-white" style="background-color:#00B050">Active</span>';
                }
            }
            $row[] = $status_pack;
            // $row[] = $status_pack ." - ". $count_ongoing ." - " . $count_done ." - " . $count_cancel;
            // add html for action
            if ($count_ongoing == 0 && $count_done == 0 && $count_cancel == 0) {
                $row[] = '';
            } else {
                if (count($data_schedule) == $count_done) {
                    $row[] = '<a class="text-danger" href="' . site_url('portal/online_pratical/attendance/' . $item->id_list_pack . '/1') . '" style="font-size:23px;"> <i class="fa fa-calendar"></i> </a><br>';
                } else if (($count_ongoing == 2 || $count_ongoing == 1 || $count_ongoing == 3 || $count_ongoing == 4) && $count_done > 0) {
                    $row[] = '<a class="text-warning" href="' . site_url('portal/online_pratical/attendance/' . $item->id_list_pack . '/1') . '" style="font-size:23px;"> <i class="fa fa-calendar"></i> </a><br>';
                } else {
                    $row[] = '<a href="' . site_url('portal/online_pratical/attendance/' . $item->id_list_pack . '/1') . '" style="font-size:23px; color:#00B050"> <i class="fa fa-calendar"></i> </a><br>';
                }
            }
            // if ($count_ongoing == 0 && $count_done == 0 && $count_cancel == 0) {
            //     $row[] = '';
            // }else{
            //     $row[] = '<div class="btn-group"><a href="' . site_url('portal/online_pratical/attendance/' . $item->id_list_pack . '/1') . '" class="btn btn-primary mr-2" title="Edit Data ini"> <i class="fa fa-info"></i> </a></div>';
            // }
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_Teacher->count_all($dbTable, $id_teacher, null, null, $jenis),
            "recordsFiltered" => $this->M_Teacher->count_filtered($dbTable, $id_teacher, null, null, $jenis),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    public function get_online_theory()
    {
        $this->cekLogin();
        $id_teacher = $_POST['id_teacher'];
        $jenis = $_POST['jenis'];
        // $id_teacher = '200005';
        // $jenis = 2;
        $this->get_ajax_online_theory($id_teacher, $jenis);
    }

    function get_ajax_online_theory($id_teacher, $jenis)
    {
        $this->cekLogin();
        $dbTable = "online_theory";
        $list = $this->M_Teacher->get_datatables($dbTable, $id_teacher);
        $dbTable2 = "list_package";
        $list2 = $this->M_Teacher->get_datatables($dbTable2, $id_teacher, null, null, $jenis);
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            // $row[] = $no . ".";
            $row[] = $item->name_student;
            $row[] = '';
            $row[] = '';
            // add html for action
            $row[] = '<a href="' . site_url('portal/online_theory/attendance/' . $item->id_online_theory) . '" class=" mr-2" style="font-size:23px;"> <i class="fa fa-calendar"></i></a>';
            $data[] = $row;
        }
        foreach ($list2 as $item) {
            $no++;
            $row = array();
            // $row[] = $no . ".";
            $count_done = 0;
            $count_cancel = 0;
            $count_ongoing = 0;

            $data_schedule = $this->M_Teacher->getData_schedule_package(null, $item->id_list_pack, null, null, $jenis);
            foreach ($data_schedule as $ds) {
                if ($ds['status'] == '1' || ($ds['status'] == '3' && $ds['date_update_cancel'] == null)) {
                    $count_ongoing += 1;
                } else if ($ds['status'] == '2' || ($ds['status'] == '3' && $ds['date_update_cancel'] != null)) {
                    $count_done += 1;
                } else if ($ds['status'] == '3' && $ds['date_update_cancel'] == null) {
                    $count_cancel += 1;
                }
            }

            $row[] = $item->name_student;

            $startdate = date_create(substr($item->created_at, 0, 10));
            $tgl_awal = date_format($startdate, "d/m/Y");

            $enddate = date_create(substr($item->end_at, 0, 10));
            $tgl_akhir = date_format($enddate, "d/m/Y");

            $today = date("Y-m-d");

            $row[] = $tgl_awal . " - " . $tgl_akhir;

            $status_pack = "";
            if ($count_ongoing == 0 && $count_done == 0 && $count_cancel == 0) {
                $status_pack = '<span class="badge badge-danger text-white">InActive</span>';
            } else {
                if (count($data_schedule) == $count_done) {
                    $status_pack = '<span class="badge badge-danger">InActive</span>';
                } else if ($count_ongoing == 2 && $count_done > 0) {
                    $status_pack = '<span class="badge badge-warning text-white">2 pack more!</span>';
                } else if (($count_ongoing == 1) && $count_done > 0) {
                    $status_pack = '<span class="badge badge-warning text-white">1 pack more!</span>';
                } else {
                    $status_pack = '<span class="badge text-white" style="background-color:#00B050">Active</span>';
                }
            }
            $row[] = $status_pack;

            if ($count_ongoing == 0 && $count_done == 0 && $count_cancel == 0) {
                $row[] = '';
            } else {
                if (count($data_schedule) == $count_done) {
                    $row[] = '<a class="text-danger" href="' . site_url('portal/online_theory/attendance/' . $item->id_list_pack . '/2') . '" style="font-size:23px;"> <i class="fa fa-calendar"></i> </a><br>';
                } else if (($count_ongoing == 1 || $count_ongoing == 2) && $count_done > 0) {
                    $row[] = '<a class="text-warning" href="' . site_url('portal/online_theory/attendance/' . $item->id_list_pack . '/2') . '" style="font-size:23px;"> <i class="fa fa-calendar"></i> </a><br>';
                } else {
                    $row[] = '<a href="' . site_url('portal/online_theory/attendance/' . $item->id_list_pack . '/2') . '" style="font-size:23px; color:#00B050"> <i class="fa fa-calendar"></i> </a><br>';
                }
            }

            $data[] = $row;
        }
        $temp = $this->M_Teacher->count_filtered($dbTable, $id_teacher, null, null, $jenis);
        $temp2 = $this->M_Teacher->count_filtered('list_package', $id_teacher, null, null, $jenis);
        // echo var_dump($temp);
        // echo "<br>";
        // echo "<br>";
        // echo var_dump($temp2);
        // echo var_dump(array_merge($temp, $temp2));
        // die();
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $temp + $temp2,
            "recordsFiltered" => $temp + $temp2,
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    public function get_note()
    {
        $this->cekLogin();
        $id_teacher = $_POST['id_teacher'];
        $name_course = $_POST['name_course'];
        $id_course = $_POST['id_course'];
        $this->get_ajax_note($id_teacher, $id_course, $name_course);
    }

    function get_ajax_note($id_teacher, $id_course, $name_course)
    {
        $this->cekLogin();
        $dbTable = "note";
        $list = $this->M_Teacher->get_datatables($dbTable, $id_teacher, $id_course, $name_course);

        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $item->keterangan;
            $row[] = $item->date;
            // add html for action
            $row[] = '<div class="btn-group"><a href="' . site_url('portal/' . $name_course . '/note/update/' . $item->id_note) . '" class="btn btn-info mr-2" title="Edit Data ini"> <i class="fa fa-edit"></i> </a>
            <a href="' . site_url('portal/C_Teacher/delete_data_note/' . $item->id_note . '/' . $name_course . '/' . $id_course) . '" class="btn btn btn-danger" title="Hapus Data Ini" onclick="return confirm("ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?")"><i class="fa fa-trash icon-white"></i></a>
            </div>';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_Teacher->count_all($dbTable, $id_teacher, $id_course, $name_course),
            "recordsFiltered" => $this->M_Teacher->count_filtered($dbTable, $id_teacher, $id_course, $name_course),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    function get_ajax_event_teacher($id_teacher)
    {
        // $this->cekLogin();
        $dbTable = "register_event";
        $list = $this->M_Teacher->get_datatables($dbTable, $id_teacher);

        $data = array();
        $no = @$_POST['start'];
        $temp_id_parent = "";
        foreach ($list as $item) {
            $no++;
            $row = array();

            $temp_event = $this->M_Admin->getEventByParent($item->parent_event);
            $date_event = [];
            $price_event = [];
            $price = "Rp" . number_format($item->price, 0, ".", ".");
            $discount = "Rp" . number_format($item->discount, 0, ".", ".");
            $total_price = "Rp" . number_format($item->total_price, 0, ".", ".");
            $temp_detail = $this->M_Admin->getRegisterEventDetail(null, $item->no_transaksi_event);
            foreach ($temp_detail as $e) {
                $date_event[] = date_format(date_create(substr($e['date'], 0, 10)), "d/m/Y");
                $price_event[] = "Rp" . number_format($e['price'], 0, ".", ".");
            }

            $date2 = date_create(substr($item->created_at, 0, 10));
            $row[] = date_format($date2, "d/m/Y");
            $row[] = $temp_event[0]['event_name'];
            $row[] = implode("<br>", $date_event);
            $row[] = implode("<br>", $price_event);
            $row[] = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop' . $item->id_transaksi . '"><i class="fa fa-info"></i></button>
                <div class="modal fade" id="staticBackdrop' . $item->id_transaksi . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel" style="font-weight:bold">Detail of Event</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label" style="font-weight:bold">
                                        No Transaksi
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                       :
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . $item->no_transaksi_event . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label" style="font-weight:bold">
                                        Registration Date
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                       :
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . date_format($date2, "d/m/Y") . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label" style="font-weight:bold">
                                        Teacher Name
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                       :
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . $item->name_teacher . '
                                    </div>
                                </div>    
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label" style="font-weight:bold">
                                        Event Name
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                       :
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . $temp_event[0]['event_name'] . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label" style="font-weight:bold">
                                        Event Date
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                       :
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . implode("<br>", $date_event) . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label" style="font-weight:bold">
                                        Event Price
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                       :
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . implode("<br>", $price_event) . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label" style="font-weight:bold">
                                        Price
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                       :
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . $price . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label" style="font-weight:bold">
                                        Discount
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                       :
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . $discount . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label" style="font-weight:bold">
                                        Total Price
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                       :
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . $total_price . '
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="pl-4 pr-4">
                               
                            </div>

                            <div class="modal-footer">
                                
                            </div>
                        </div>
                    </div>
                </div>
                ';
            // <a href="' . site_url('portal/event/student/edit/' . $item->id_transaksi) . '" class="btn btn-xs btn-primary mr-2 btn-update" title="Edit Data ini"> <i class="fa fa-edit icon-white"></i> </a>
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_Teacher->count_all($dbTable, $id_teacher),
            "recordsFiltered" => $this->M_Teacher->count_filtered($dbTable, $id_teacher),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    public function profile($username)
    {
        $this->cekLogin();
        if (substr($this->session->userdata('id'), 0, 1) == 1) {
            $teacher = $this->M_Teacher->getData_teacher($this->session->userdata('id'));
        } else {
            $teacher = $this->M_Teacher->getData_teacher(null, $username);
        }

        $cek_teacher = $this->M_Teacher->getData_teacher(null, $username);
        $bank_account_teacher = $this->M_Teacher->getData_bank_account_teacher(null, $cek_teacher[0]['id_teacher']);

        $title = "Profile | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'teacher' => $teacher));
        $this->load->view('portal/teacher/profile', array('teacher' => $teacher, 'bank_account_teacher' => $bank_account_teacher));
        $this->load->view('portal/reuse/footer');
    }

    public function edit_profile($username)
    {
        $this->cekLogin();
        $teacher = $this->M_Teacher->getData_teacher($this->session->userdata('id'));
        $title = "Edit Profile | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'teacher' => $teacher));
        $this->load->view('portal/teacher/edit_profile', $teacher);
        $this->load->view('portal/reuse/footer');
    }

    public function data_edit_profile()
    {
        $this->cekLogin();
        $id_teacher = $_POST['id'];
        $name_teacher = $_POST['name'];
        $dob_teacher = $_POST['tempat_dob_teacher'] . ", " . $_POST['tanggal_dob_teacher'];
        $address_teacher = $_POST['address'] . "~" . $_POST['kelurahan'] . "~" . $_POST['kecamatan'] . "~" . $_POST['kota'] . "~" . $_POST['provinsi'] . "~" . $_POST['zip'] . "~" . $_POST['negara'];
        $instrument = $this->input->post('instrument');
        if ($instrument == "Others") {
            $instrument = "Others|" . $this->input->post('others');
        }
        $linkedin = $_POST['linkedin'];
        $credentials_teacher = $_POST['credentials'];
        $phone_teacher = $_POST['phone'];
        $email_teacher = $_POST['email'];
        $bank_teacher = $_POST['bank'];
        $norek_teacher = $_POST['norek'];
        $name_rek_teacher = $_POST['name_rek_teacher'];
        $iban_rek_teacher = $_POST['iban_rek_teacher'];
        $swift_rek_teacher = $_POST['swift_rek_teacher'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $kat = $_POST['kat'];

        $name_pict = explode(".", $this->input->post('pict_lama'));
        $temp_name = substr($name_pict[0], 0, -1);
        $counter = substr($name_pict[0], -1);
        $name_picture = $temp_name . "" . (intval($counter) + 1);

        //upload Picture
        $ubah = $_POST['ubah-pict'];
        if ($ubah == "ya") {
            $pict_teacher = "";
            $this->load->library('upload');
            $config['upload_path'] = './assets/img/pict_guru';
            $config['allowed_types'] = 'pdf|PDF|jpg|JPG|jpeg|JPEG|png|PNG';
            $new_name = "pict_" . $name_teacher;
            $config['file_name'] = $name_picture;

            $filename = './assets/img/pict_guru/' . $_POST['pict_lama'];
            if (file_exists($filename)) {
                unlink($filename);
            }

            $this->upload->initialize($config);
            if (!$this->upload->do_upload('pict')) {
                $this->session->set_flashdata('warning', $this->upload->display_errors());
                redirect('portal/profile/edit/' . $username);
            } else {
                $upload_data_team = $this->upload->data(); // added this..
                $pict_teacher = $upload_data_team['file_name']; // changed this..
            }
        } else {
            $pict_teacher = $_POST['pict_lama'];
        }

        $data = array(
            'name_teacher' => $name_teacher,
            'dob_teacher' => $dob_teacher,
            'address_teacher' => $address_teacher,
            'credentials_teacher' => $credentials_teacher,
            'instrument' => $instrument,
            'linkedin' => $linkedin,
            'phone_teacher' => $phone_teacher,
            'email_teacher' => $email_teacher,
            'bank_teacher' => $bank_teacher,
            'norek_teacher' => $norek_teacher,
            'name_rek_teacher' => $name_rek_teacher,
            'iban_rek_teacher' => $iban_rek_teacher,
            'swift_rek_teacher' => $swift_rek_teacher,
            'username' => $username,
            'password' => $password,
            'kat' => $kat,
            // 'ktp_teacher' => $ktp_teacher,
            'pict_teacher' => $pict_teacher,
            // 'status' => '0',
        );

        $where = array('id_teacher' => $id_teacher);
        $res = $this->M_Portal->updateData('teacher', $data, $where);

        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Profile successfully changed');
            redirect('portal/profile/' . $username);
        } else {
            $this->session->set_flashdata('warning', 'Failed change information');
            redirect('portal/profile/edit/' . $username);
        }
    }

    public function offline_lesson()
    {
        $this->cekLogin();
        $teacher = $this->M_Teacher->getData_teacher($this->session->userdata('id'));
        $title = "Offline Lesson | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'teacher' => $teacher));
        $this->load->view('portal/teacher/offline_lesson');
        $this->load->view('portal/reuse/footer');
    }

    public function attendance_offline_lesson($id_course)
    {
        $this->cekLogin();
        $teacher = $this->M_Teacher->getData_teacher($this->session->userdata('id'));
        $offline_lesson = $this->M_Teacher->getData_offline_lesson($id_course);
        $feereport = $this->M_Teacher->getData_sirkulasi_feereport(null, null, null, $offline_lesson[0]['id_teacher']);
        $title = "Attendance Offline Lesson | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'teacher' => $teacher));
        $this->load->view('portal/teacher/attendance_offline_lesson', array('offline_lesson' => $offline_lesson, 'feereport' => $feereport));
        $this->load->view('portal/reuse/footer');
    }

    public function attendance_offline_lesson_package($id_package)
    {
        $this->cekLogin();
        $teacher = $this->M_Teacher->getData_teacher($this->session->userdata('id'));
        $pack_online = $this->M_Teacher->getData_pack_offline($id_package);
        $schedule_online = $this->M_Teacher->getData_schedule_package_offline(null, $id_package);
        $count_package = [];
        foreach ($schedule_online as $so) {
            $count_package[] = $so['id_schedule_package_offline'];
        }
        $feereport = $this->M_Teacher->getData_sirkulasi_feereport(null, null, null, $schedule_online[0]['id_teacher']);

        // echo var_dump($feereport);
        // echo "<br/>";
        // echo var_dump($pack_online);
        $title = "Attendance Offline Lesson | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'teacher' => $teacher));
        $this->load->view('portal/teacher/attendance_offline_lesson_package', array('pack_online' => $pack_online, 'count_package' => $count_package, 'feereport' => $feereport));
        $this->load->view('portal/reuse/footer');
    }

    public function online_pratical()
    {
        $this->cekLogin();
        $teacher = $this->M_Teacher->getData_teacher($this->session->userdata('id'));
        $title = "Online Pratical | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'teacher' => $teacher));
        $this->load->view('portal/teacher/online_pratical');
        $this->load->view('portal/reuse/footer');
    }

    public function attendance_online_pratical($id_package, $jenis)
    {
        $this->cekLogin();
        $teacher = $this->M_Teacher->getData_teacher($this->session->userdata('id'));
        $pack_online = $this->M_Teacher->getData_pack_online($id_package, 1);
        $schedule_online = $this->M_Teacher->getData_schedule_package(null, $id_package, null, null, $jenis);
        $count_theory = [];
        $count_pratical = [];
        foreach ($schedule_online as $so) {
            if ($so['jenis'] == 1 && $so['status'] == 2) {
                $count_pratical[] = $so['id_schedule_pack'];
            }
            if ($so['jenis'] == 2 && $so['status'] == 2) {
                $count_theory[] = $so['id_schedule_pack'];
            }
        }
        $feereport = $this->M_Teacher->getData_sirkulasi_feereport(null, null, null, $schedule_online[0]['id_teacher']);

        $title = "Attendance Offline Lesson | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'teacher' => $teacher));
        $this->load->view('portal/teacher/attendance_online_pratical', array('pack_online' => $pack_online, 'count_theory' => $count_theory, 'count_pratical' => $count_pratical, 'jenis' => $jenis, 'feereport' => $feereport));
        $this->load->view('portal/reuse/footer');
    }

    public function online_theory()
    {
        $this->cekLogin();
        $teacher = $this->M_Teacher->getData_teacher($this->session->userdata('id'));
        $title = "Online Theory | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'teacher' => $teacher));
        $this->load->view('portal/teacher/online_theory');
        $this->load->view('portal/reuse/footer');
    }

    public function attendance_online_theory($id_course)
    {
        $this->cekLogin();
        $teacher = $this->M_Teacher->getData_teacher($this->session->userdata('id'));
        $online_theory = $this->M_Teacher->getData_online_theory($id_course);

        $feereport = $this->M_Teacher->getData_sirkulasi_feereport(null, null, null, $online_theory[0]['id_teacher']);

        $title = "Attendance Offline Lesson | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'teacher' => $teacher));
        $this->load->view('portal/teacher/attendance_online_theory', array('online_theory' => $online_theory, 'feereport' => $feereport));
        $this->load->view('portal/reuse/footer');
    }

    function load_schedule($id_teacher, $nama_course, $id_student)
    {

        $event_data = $this->M_Teacher->fetch_all_schedule($id_teacher, $nama_course, $id_student);
        foreach ($event_data->result_array() as $row) {
            $data[] = array(
                'id' => $row['id_schedule'],
                'title' => $row['name_student'],
                'date' => $row['date'],
                'instrument' => $row['instrument'],
                'fee' => $row['fee'],
                'id_course' => $row['id_course'],
                'nama_course' => $row['nama_course'],
            );
        }
        echo json_encode($data);
    }

    function load_schedule_theory($id_course)
    {
        $this->cekLogin();
        $event_data = $this->M_Teacher->fetch_all_schedule_theory(null, $id_course);
        foreach ($event_data->result_array() as $row) {
            $data[] = array(
                'id' => $row['id_schedule_theory'],
                'title' => $row['name_student'],
                'date' => $row['date'],
                'instrument' => $row['instrument'],
                'fee' => $row['fee'],
                'id_course' => $row['id_course'],
                'color' => "#0776BD",
            );
        }
        echo json_encode($data);
    }

    public function insert_schedule()
    {
        // $this->cekLogin();
        // $id_teacher = '200002';
        // $created_at = '2021-09-05';

        $created_at = $this->input->post('tgl');
        $id_teacher = $this->input->post('id_teacher');
        $id_student = $this->input->post('id_student');
        $paket = $this->input->post('paket');
        $id_offline_lesson = $this->input->post('id_course');
        $temp_id_student = substr($id_student, 3);
        $temp_id_teacher = substr($id_teacher, 3);
        $tipe = 3;
        $tipe_rate = '';

        //cek total id_student -> <- id_teacher
        //nomor sirkulasi lesson
        //LESS/002/015/2 => tipe offline lesson
        $no_sirkulasi_lesson = 'LESS/' .  $temp_id_teacher . "/" . $temp_id_student . "/" . $tipe . "/" . $id_offline_lesson;

        $cek_sirkulasi = $this->M_Teacher->getData_sirkulasi_lesson(null, $no_sirkulasi_lesson);

        if (count($cek_sirkulasi) > 0) {
            $data_update_sirkulasi = null;

            $total = $cek_sirkulasi[0]['total'];
            $total_50 = $cek_sirkulasi[0]['total_50'];
            $total_rate = $cek_sirkulasi[0]['total_rate'];

            if ($total_50 >= 10) {
                if ($cek_sirkulasi[0]['rate_created_at'] == NULL) {
                    $data_update_sirkulasi = array(
                        'rate_created_at' => $created_at,
                        'last_updated_rate' => $created_at,
                        'total_rate' => $total_rate + 1,
                        'total' => $total + 1
                    );
                } else {
                    $data_update_sirkulasi = array(
                        'last_updated_rate' => $created_at,
                        'total_rate' => $total_rate + 1,
                        'total' => $total + 1
                    );
                }
                $tipe_rate = 80;
            } else {
                $data_update_sirkulasi = array(
                    'last_updated_50' => $created_at,
                    'total_50' => $total_50 + 1,
                    'total' => $total + 1
                );
                $tipe_rate = 50;
            }
            // echo var_dump($data_update_sirkulasi);
            $this->M_Teacher->updateDataSirkulasiLesson($data_update_sirkulasi, $no_sirkulasi_lesson);
        } else {
            $data_sirkulasi = array(
                'no_sirkulasi_lesson' => $no_sirkulasi_lesson,
                'id_student' => $id_student,
                'id_teacher' => $id_teacher,
                'id_offline_lesson' => $id_offline_lesson,
                'tipe' => $tipe,
                'rate' => 80,
                'total_50' => 1,
                'total_rate' => 0,
                'total' => 1,
                'created_at' => $created_at,
                'last_updated_50' => $created_at,
            );
            $this->M_Teacher->addDataSirkulasiLesson($data_sirkulasi);
            $tipe_rate = 50;
        }
        $data_sirkulasi_lesson_detail = array(
            'no_sirkulasi_lesson' => $no_sirkulasi_lesson,
            'id_student' => $id_student,
            'id_teacher' => $id_teacher,
            'id_offline_lesson' => $id_offline_lesson,
            'lesson_date' => $created_at,
            'tipe' => $tipe,
            'rate' => $tipe_rate,
            'price' => $this->input->post('fee'),
            'paket' => $paket,
        );
        $this->M_Teacher->addDataSirkulasiLessonDetail($data_sirkulasi_lesson_detail);

        $data = array(
            'id_teacher'  => $this->input->post('id_teacher'),
            'id_student'  => $this->input->post('id_student'),
            'nama_course'  => $this->input->post('nama_course'),
            'id_course'  => $this->input->post('id_course'),
            'instrument'  => $this->input->post('instrument'),
            'date' => $this->input->post('tgl'),
            'fee'  => $this->input->post('fee')
        );
        $data2 = $this->M_Teacher->insert_event_schedule($data);


        //nomor feereport 
        //FER/210629/004
        $startdate = strtotime($created_at);
        $temp_date_sirkulasi =  date("Ym", $startdate);
        $no_sirkulasi_feereport = "FER/" . $temp_date_sirkulasi . "/" . $temp_id_teacher;
        $data_sirkulasi_feereport = $this->M_Teacher->getData_sirkulasi_feereport(null, $no_sirkulasi_feereport);
        $data_sirkulasi_feereport_detail = $this->M_Teacher->getData_sirkulasi_feereport_detail(null, $no_sirkulasi_feereport, $tipe);
        $temp_counter = "FER/" . $temp_date_sirkulasi;
        $counter = $this->M_Teacher->getData_sirkulasi_feereport(null, $temp_counter);

        $data2 = [];
        $data3 = [];

        if (count($data_sirkulasi_feereport) == 0) {

            // if (count($counter) == 0) {
            $data2 =  [
                'no_sirkulasi_feereport' => $no_sirkulasi_feereport . "/001",
                'id_teacher' => $this->input->post('id_teacher'),
                'created_at' => $created_at,
                'updated_at' => $created_at,
                'price' => $this->input->post('fee'),
            ];
            $data3 = [
                'no_sirkulasi_feereport' => $no_sirkulasi_feereport . "/001",
                'id_teacher' => $this->input->post('id_teacher'),
                'tipe' => $tipe,
                'price' => $this->input->post('fee'),
            ];
            // } 
            // else {
            //     $x = 0;
            //     if (count($counter) < 10) {
            //         $x = "00" . count($counter);
            //     } else if (count($counter) < 100) {
            //         $x = "0" . count($counter);
            //     } else {
            //         $x = count($counter);
            //     }
            //     $data2 =  [
            //         'no_sirkulasi_feereport' => $no_sirkulasi_feereport . "/". $x,
            //         'id_teacher' => $this->input->post('id_teacher'),
            //         'created_at' => $created_at,
            //         'updated_at' => $created_at,
            //         'price' => $this->input->post('fee'),
            //     ];
            //     $data3 = [
            //         'no_sirkulasi_feereport' => $no_sirkulasi_feereport . "/". $x,
            //         'id_teacher' => $this->input->post('id_teacher'),
            //         'tipe' => $tipe,
            //         'price' => $this->input->post('fee'),
            //     ];
            // }
            $this->db->insert('sirkulasi_feereport', $data2);
            $this->db->insert('sirkulasi_feereport_detail', $data3);
            // echo "<br>";
            // echo var_dump($data2);
            // echo "<br>";
            // echo var_dump($data3);
        } else {
            if ($data_sirkulasi_feereport[0]['status_approved'] == 0) {
                $data2 =  [
                    'price' => intval($data_sirkulasi_feereport[0]['price']) + intval($this->input->post('fee')),
                    'updated_at' => $created_at,
                ];
                $this->db->update('sirkulasi_feereport', $data2, ['id_sirkulasi_feereport' => $data_sirkulasi_feereport[0]['id_sirkulasi_feereport']]);

                if (count($data_sirkulasi_feereport_detail) == 0) {
                    $data3 = [
                        'no_sirkulasi_feereport' => $data_sirkulasi_feereport[0]['no_sirkulasi_feereport'],
                        'id_teacher' => $this->input->post('id_teacher'),
                        'tipe' => $tipe,
                        'price' => $this->input->post('fee'),
                    ];
                    $this->db->insert('sirkulasi_feereport_detail', $data3);
                } else {
                    $data3 = [
                        'price' => intval($data_sirkulasi_feereport_detail[0]['price']) + intval($this->input->post('fee')),
                    ];
                    $this->db->update('sirkulasi_feereport_detail', $data3, ['id' => $data_sirkulasi_feereport_detail[0]['id']]);
                }
            }
        }


        echo json_encode($data2);
    }

    // function delete_schedule($id_teacher, $id_student)
    function delete_schedule()
    {
        // $this->cekLogin();
        // $id_teacher = '200002';
        // $id_student = '1000011';
        // $id_course = '16';
        // $created_at = '2021-09-09';
        $created_at = $this->input->post('tgl');
        $id_teacher = $this->input->post('id_teacher');
        $id_student = $this->input->post('id_student');
        $id_course = $this->input->post('id_course');
        $temp_id_student = substr($id_student, 3);
        $temp_id_teacher = substr($id_teacher, 3);
        $tipe = 3;

        //cek total id_student -> <- id_teacher
        //nomor sirkulasi lesson
        //LESS/002/015/2 => tipe offline lesson
        $no_sirkulasi_lesson = 'LESS/' .  $temp_id_teacher . "/" . $temp_id_student . "/" . $tipe . "/" . $id_course;

        $cek_sirkulasi = $this->M_Teacher->getData_sirkulasi_lesson(null, $no_sirkulasi_lesson);
        $cek_sirkulasi_detail = $this->M_Teacher->getData_sirkulasi_lesson_detail(null, $no_sirkulasi_lesson, null, null, $tipe, $created_at);

        // echo var_dump($no_sirkulasi_lesson);
        // echo "<br>";
        // echo "<br>";
        // echo var_dump($cek_sirkulasi);
        // echo "<br>";
        // echo var_dump($cek_sirkulasi_detail);
        // echo "<br>";
        // die();
        $data_update_sirkulasi = null;
        if (count($cek_sirkulasi) > 0) {
            if (count($cek_sirkulasi_detail) > 0) {
                $this->M_Teacher->deleteDataSirkulasiLessonDetail($cek_sirkulasi_detail[0]['id_sirkulasi_lesson_detail']);
                $total = $cek_sirkulasi[0]['total'];
                $total_50 = $cek_sirkulasi[0]['total_50'];
                $total_rate = $cek_sirkulasi[0]['total_rate'];

                if ($total == 1) {
                    $this->M_Teacher->deleteDataSirkulasiLesson($cek_sirkulasi[0]['id_sirkulasi_lesson']);
                } else {
                    if ($total > 4) {
                        if ($total == 5) {
                            $data_update_sirkulasi = array(
                                'last_updated_rate' => NULL,
                                'rate_created_at' => NULL,
                                'total_rate' => $total_rate - 1,
                                'total' => $total - 1
                            );
                        } else {
                            $data_update_sirkulasi = array(
                                'last_updated_rate' => $created_at,
                                'total_rate' => $total_rate - 1,
                                'total' => $total - 1
                            );
                        }
                    } else {
                        $data_update_sirkulasi = array(
                            'last_updated_50' => $created_at,
                            'total_50' => $total_50 - 1,
                            'total' => $total - 1
                        );
                    }
                }
                $this->M_Teacher->updateDataSirkulasiLesson($data_update_sirkulasi, $no_sirkulasi_lesson);
            }
        }

        $data2 = $this->M_Teacher->delete_event_schedule($this->input->post('id_schedule'));


        //nomor feereport 
        //FER/210629/004
        $tgl = $this->input->post('tgl');
        $fee = $this->input->post('fee');
        // $tgl = '2021-09-09';
        // $fee = '325000';
        $startdate = strtotime($tgl);
        $temp_date_sirkulasi =  date("Ym", $startdate);
        $no_sirkulasi_feereport = "FER/" . $temp_date_sirkulasi . "/" . $temp_id_teacher;
        $data_sirkulasi_feereport = $this->M_Teacher->getData_sirkulasi_feereport(null, $no_sirkulasi_feereport);
        $data_sirkulasi_feereport_detail = $this->M_Teacher->getData_sirkulasi_feereport_detail(null, $no_sirkulasi_feereport, $tipe);

        $data2 = [];
        $data3 = [];
        if (count($data_sirkulasi_feereport) > 0) {
            if ($data_sirkulasi_feereport[0]['status_approved'] == 0) {
                if (count($data_sirkulasi_feereport_detail) > 0) {
                    $price_now = intval($data_sirkulasi_feereport[0]['price']) - intval($fee);
                    $price_now_detail = intval($data_sirkulasi_feereport_detail[0]['price']) - intval($fee);
                    if ($price_now_detail > 0) {
                        $data3 = [
                            'price' => $price_now_detail,
                        ];
                        $this->db->update('sirkulasi_feereport_detail', $data3, ['id' => $data_sirkulasi_feereport_detail[0]['id']]);
                    } else {
                        $this->db->delete('sirkulasi_feereport_detail', ['id' => $data_sirkulasi_feereport_detail[0]['id']]);
                    }
                    if ($price_now > 0) {
                        $data2 = [
                            'price' => $price_now,
                            'updated_at' => $tgl,
                        ];
                        $this->db->update('sirkulasi_feereport', $data2, ['id_sirkulasi_feereport' => $data_sirkulasi_feereport[0]['id_sirkulasi_feereport']]);
                    } else {
                        $this->db->delete('sirkulasi_feereport', ['id_sirkulasi_feereport' => $data_sirkulasi_feereport[0]['id_sirkulasi_feereport']]);
                    }
                }
            }
        }

        echo json_encode($data2);
    }

    public function insert_schedule_theory()
    {
        $this->cekLogin();
        $data = array(
            'id_teacher'  => $this->input->post('id_teacher'),
            'id_student'  => $this->input->post('id_student'),
            'id_course'  => $this->input->post('id_course'),
            'instrument'  => $this->input->post('instrument'),
            'date' => $this->input->post('tgl'),
            'fee'  => $this->input->post('fee')
        );
        $data2 = $this->M_Teacher->insert_event_schedule_theory($data);
        echo json_encode($data2);
    }

    function delete_schedule_theory()
    {
        $data2 = $this->M_Teacher->delete_event_schedule_theory($this->input->post('id_schedule_theory'));
        echo json_encode($data2);
    }

    public function note($id_course)
    {
        $this->cekLogin();
        $teacher = $this->M_Teacher->getData_teacher($this->session->userdata('id'));
        $offline_lesson = $this->M_Teacher->getData_offline_lesson($id_course);
        $online_theory = $this->M_Teacher->getData_online_theory($id_course);
        $online_pratical = $this->M_Teacher->getData_online_pratical($id_course);
        $title = "Note | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'teacher' => $teacher));
        $this->load->view('portal/teacher/note', array('offline_lesson' => $offline_lesson, 'online_theory' => $online_theory, 'online_pratical' => $online_pratical));
        $this->load->view('portal/reuse/footer');
    }

    public function addnote($id_course)
    {
        $this->cekLogin();
        $teacher = $this->M_Teacher->getData_teacher($this->session->userdata('id'));
        $offline_lesson = $this->M_Teacher->getData_offline_lesson($id_course);
        $online_theory = $this->M_Teacher->getData_online_theory($id_course);
        $online_pratical = $this->M_Teacher->getData_online_pratical($id_course);

        $title = "Add Note | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'teacher' => $teacher));
        $this->load->view('portal/teacher/add_note', array('offline_lesson' => $offline_lesson, 'online_theory' => $online_theory, 'online_pratical' => $online_pratical));
        $this->load->view('portal/reuse/footer');
    }

    public function add_data_note()
    {
        $this->cekLogin();
        $res = $this->M_Teacher->insertDataNote();
        $id_course = $this->input->post('id_course');
        $name_course = $this->input->post('name_course');
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully added');
            redirect('portal/' . $name_course . '/note/' . $id_course);
        } else {
            $this->session->set_flashdata('warning', 'Failed to add data');
            redirect('portal/' . $name_course . '/note/' . $id_course);
        }
    }

    public function updatenote($id_note)
    {
        $this->cekLogin();
        $teacher = $this->M_Portal->get_teacher();
        $note = $this->M_Teacher->getData_note($id_note);
        $id_course = $note[0]['id_course'];
        $offline_lesson = $this->M_Teacher->getData_offline_lesson($id_course);
        $online_theory = $this->M_Teacher->getData_online_theory($id_course);
        $online_pratical = $this->M_Teacher->getData_online_pratical($id_course);

        $title = "update Note | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'teacher' => $teacher));
        $this->load->view('portal/teacher/edit_note', array('note' => $note, 'offline_lesson' => $offline_lesson, 'online_theory' => $online_theory, 'online_pratical' => $online_pratical));
        $this->load->view('portal/reuse/footer');
    }

    public function update_data_note()
    {
        $this->cekLogin();
        $res = $this->M_Teacher->updateDataNote();
        $id_course = $this->input->post('id_course');
        $name_course = $this->input->post('name_course');
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully updated');
            redirect('portal/' . $name_course . '/note/' . $id_course);
        } else {
            $this->session->set_flashdata('warning', 'Failed to update data');
            redirect('portal/' . $name_course . '/note/' . $id_course);
        }
    }

    public function delete_data_note($id_note, $name_course, $id_course)
    {
        $res = $this->M_Teacher->deleteDataNote($id_note);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully deleted');
            redirect('portal/' . $name_course . '/note/' . $id_course);
        } else {
            $this->session->set_flashdata('warning', 'Failed to delete data');
            redirect('portal/' . $name_course . '/note/' . $id_course);
        }
    }

    public function offline_trial()
    {
        $this->cekLogin();
        $teacher = $this->M_Teacher->getData_teacher($this->session->userdata('id'));

        $feereport = $this->M_Teacher->getData_sirkulasi_feereport(null, null, null, $this->session->userdata('id'));

        $title = "Offline Trial | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'teacher' => $teacher));
        $this->load->view('portal/teacher/offline_trial', array('teacher' => $teacher, 'feereport' => $feereport));
        $this->load->view('portal/reuse/footer');
    }

    function load_offline_trial($id_teacher)
    {
        $event_data = $this->M_Teacher->fetch_all_offline_trial($id_teacher);
        foreach ($event_data->result_array() as $row) {
            $data[] = array(
                'id' => $row['id_offline_trial'],
                'title' => $row['name_student'],
                'date' => $row['date'],
                'color' => "#ffd32a",
                // 'end' => $row['end_event']
            );
        }
        echo json_encode($data);
    }

    public function insert_offline_trial()
    {
        //nomor feereport 
        //FER/210629/004
        $created_at = $this->input->post('tgl');
        $id_teacher = $this->input->post('id_teacher');
        $temp_id_teacher = substr($id_teacher, 3);

        $startdate = strtotime($created_at);
        $temp_date_sirkulasi =  date("Ym", $startdate);

        $price = '100000';
        $tipe = 5;

        $no_sirkulasi_feereport = "FER/" . $temp_date_sirkulasi . "/" . $temp_id_teacher;
        $data_sirkulasi_feereport = $this->M_Teacher->getData_sirkulasi_feereport(null, $no_sirkulasi_feereport);
        $data_sirkulasi_feereport_detail = $this->M_Teacher->getData_sirkulasi_feereport_detail(null, $no_sirkulasi_feereport, $tipe);
        $temp_counter = "FER/" . $temp_date_sirkulasi;
        $counter = $this->M_Teacher->getData_sirkulasi_feereport(null, $temp_counter);

        $data2 = [];
        $data3 = [];
        if (count($data_sirkulasi_feereport) == 0) {

            // if (count($counter) == 0) {
            $data2 =  [
                'no_sirkulasi_feereport' => $no_sirkulasi_feereport . "/001",
                'id_teacher' => $this->input->post('id_teacher'),
                'created_at' => $created_at,
                'updated_at' => $created_at,
                'price' => $price,
            ];
            $data3 = [
                'no_sirkulasi_feereport' => $no_sirkulasi_feereport . "/001",
                'id_teacher' => $this->input->post('id_teacher'),
                'tipe' => $tipe,
                'price' => $price,
            ];
            // } 
            // else {
            //     $x = 0;
            //     if (count($counter) < 10) {
            //         $x = "00" . count($counter);
            //     } else if (count($counter) < 100) {
            //         $x = "0" . count($counter);
            //     } else {
            //         $x = count($counter);
            //     }
            //     $data2 =  [
            //         'no_sirkulasi_feereport' => $no_sirkulasi_feereport . "/" . $x,
            //         'id_teacher' => $this->input->post('id_teacher'),
            //         'created_at' => $created_at,
            //         'updated_at' => $created_at,
            //         'price' => $price,
            //     ];
            //     $data3 = [
            //         'no_sirkulasi_feereport' => $no_sirkulasi_feereport . "/" . $x,
            //         'id_teacher' => $this->input->post('id_teacher'),
            //         'tipe' => $tipe,
            //         'price' => $price,
            //     ];
            // }
            $this->db->insert('sirkulasi_feereport', $data2);
            $this->db->insert('sirkulasi_feereport_detail', $data3);
        } else {
            if ($data_sirkulasi_feereport[0]['status_approved'] == 0) {
                $data2 =  [
                    'price' => intval($data_sirkulasi_feereport[0]['price']) + intval($price),
                    'updated_at' => $created_at,
                ];
                $this->db->update('sirkulasi_feereport', $data2, ['id_sirkulasi_feereport' => $data_sirkulasi_feereport[0]['id_sirkulasi_feereport']]);

                if (count($data_sirkulasi_feereport_detail) == 0) {
                    $data3 = [
                        'no_sirkulasi_feereport' => $data_sirkulasi_feereport[0]['no_sirkulasi_feereport'],
                        'id_teacher' => $this->input->post('id_teacher'),
                        'tipe' => $tipe,
                        'price' => $price,
                    ];
                    $this->db->insert('sirkulasi_feereport_detail', $data3);
                } else {
                    $data3 = [
                        'price' => intval($data_sirkulasi_feereport_detail[0]['price']) + intval($price),
                    ];
                    $this->db->update('sirkulasi_feereport_detail', $data3, ['id' => $data_sirkulasi_feereport_detail[0]['id']]);
                }
            }
        }

        $data = array(
            'id_teacher'  => $this->input->post('id_teacher'),
            'name_student' => $this->input->post('name_student'),
            'date' => $this->input->post('tgl')
        );
        $data2 = $this->M_Teacher->insert_event_offline_trial($data);
        echo json_encode($data2);
    }

    function update_offline_trial()
    {
        $data = array(
            'id_offline_trial'  => $this->input->post('id_offline_trial'),
            'id_teacher'  => $this->input->post('id_teacher'),
            'name_student' => $this->input->post('name_student'),
            'date' => $this->input->post('tgl')
        );
        $data2 = $this->M_Teacher->update_event_offline_trial($data, $this->input->post('id_offline_trial'));
        echo json_encode($data2);
    }

    function delete_offline_trial()
    {
        //nomor feereport 
        //FER/210629/004
        $tgl = $this->input->post('tgl');
        $id_teacher = $this->input->post('id_teacher');
        $temp_id_teacher = substr($id_teacher, 3);

        $fee = '100000';
        $tipe = 5;

        $startdate = strtotime($tgl);
        $temp_date_sirkulasi =  date("Ym", $startdate);
        $no_sirkulasi_feereport = "FER/" . $temp_date_sirkulasi . "/" . $temp_id_teacher;
        $data_sirkulasi_feereport = $this->M_Teacher->getData_sirkulasi_feereport(null, $no_sirkulasi_feereport);
        $data_sirkulasi_feereport_detail = $this->M_Teacher->getData_sirkulasi_feereport_detail(null, $no_sirkulasi_feereport, $tipe);

        $data2 = [];
        $data3 = [];
        if (count($data_sirkulasi_feereport) > 0) {
            if ($data_sirkulasi_feereport[0]['status_approved'] == 0) {
                if (count($data_sirkulasi_feereport_detail) > 0) {
                    $price_now = intval($data_sirkulasi_feereport[0]['price']) - intval($fee);
                    $price_now_detail = intval($data_sirkulasi_feereport_detail[0]['price']) - intval($fee);
                    if ($price_now_detail > 0) {
                        $data3 = [
                            'price' => $price_now_detail,
                        ];
                        $this->db->update('sirkulasi_feereport_detail', $data3, ['id' => $data_sirkulasi_feereport_detail[0]['id']]);
                    } else {
                        $this->db->delete('sirkulasi_feereport_detail', ['id' => $data_sirkulasi_feereport_detail[0]['id']]);
                    }
                    if ($price_now > 0) {
                        $data2 = [
                            'price' => $price_now,
                            'updated_at' => $tgl,
                        ];
                        $this->db->update('sirkulasi_feereport', $data2, ['id_sirkulasi_feereport' => $data_sirkulasi_feereport[0]['id_sirkulasi_feereport']]);
                    } else {
                        $this->db->delete('sirkulasi_feereport', ['id_sirkulasi_feereport' => $data_sirkulasi_feereport[0]['id_sirkulasi_feereport']]);
                    }
                }
            }
        }
        $data2 = $this->M_Teacher->delete_event_offline_trial($this->input->post('id_offline_trial'));
        echo json_encode($data2);
    }

    public function attendance_summary()
    {
        $this->cekLogin();
        $teacher = $this->M_Teacher->getData_teacher($this->session->userdata('id'));
        $title = "Attendance Summary | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'teacher' => $teacher));
        $this->load->view('portal/teacher/attendance_summary');
        $this->load->view('portal/reuse/footer');
    }

    function load_summary($id_teacher)
    {
        $data = [];
        $event_data = $this->M_Teacher->fetch_summary_schedule_package_offline($id_teacher);
        $offline_trial = $this->M_Teacher->fetch_summary_offline_trial($id_teacher);
        $schedule_online_pratical = $this->M_Teacher->fetch_summary_schedule_package($id_teacher, 1);
        $schedule_online_theory = $this->M_Teacher->fetch_summary_schedule_package($id_teacher, 2);
        $schedule_theory = $this->M_Teacher->fetch_summary_schedule_theory($id_teacher);
        foreach ($event_data->result_array() as $row) {
            $color = "#DE7CD9";
            if ($row['status'] == 2 || $row['status'] == 4) {
                $data[] = array(
                    'id' => "offline_lesson-" . $row['id_schedule_package_offline'],
                    'title' => $row['name_student'],
                    'color' => $color,
                    'date' => $row['date_schedule'],
                );
            }
            if ($row['status'] == 3 && $row['date_update_cancel'] != NULL) {
                $data[] = array(
                    'id' => "offline_lesson-" . $row['id_schedule_package_offline'],
                    'title' => $row['name_student'],
                    'color' => $color,
                    'date' => $row['date_update_cancel'],
                );
            }
        }
        foreach ($offline_trial->result_array() as $row) {
            $color = "#ffd32a";
            $data[] = array(
                'id' => "offline_trial-" . $row['id_offline_trial'],
                'title' => $row['name_student'],
                'color' => $color,
                'date' => $row['date'],
            );
        }
        foreach ($schedule_online_pratical->result_array() as $row) {
            $color = "#43E514";
            if ($row['status'] == 2 || $row['status'] == 4) {
                $data[] = array(
                    'id' => "pratical_lesson-" . $row['id_schedule_pack'],
                    'title' => $row['name_student'],
                    'color' => $color,
                    'date' => $row['date_schedule'],
                );
            }
            if ($row['status'] == 3 && $row['date_update_cancel'] != NULL) {
                $data[] = array(
                    'id' => "pratical_lesson-" . $row['id_schedule_pack'],
                    'title' => $row['name_student'],
                    'color' => $color,
                    'date' => $row['date_update_cancel'],
                );
            }
        }
        foreach ($schedule_online_theory->result_array() as $row) {
            $color = "#0676BD";
            if ($row['status'] == 2 || $row['status'] == 4) {
                $data[] = array(
                    'id' => "theory_lesson-" . $row['id_schedule_pack'],
                    'title' => $row['name_student'],
                    'color' => $color,
                    'date' => $row['date_schedule'],
                );
            }
            if ($row['status'] == 3 && $row['date_update_cancel'] != NULL) {
                $data[] = array(
                    'id' => "theory_lesson-" . $row['id_schedule_pack'],
                    'title' => $row['name_student'],
                    'color' => $color,
                    'date' => $row['date_update_cancel'],
                );
            }
        }
        foreach ($schedule_theory->result_array() as $row) {
            $color = "#0676BD";
            $data[] = array(
                'id' => "schedule_theory-" . $row['id_schedule_theory'],
                'title' => $row['name_student'],
                'color' => $color,
                'date' => $row['date'],
            );
        }
        echo json_encode($data);
    }

    public function fee_report($id_teacher)
    {
        $this->cekLogin();
        // $feereport = $this->M_Admin->getData_schedule(null, null, $id_teacher);
        // $offline_trial = $this->M_Admin->getData_offline_trial(null, null, $id_teacher);
        // $event_teacher = $this->M_Admin->getData_event_teacher(null, $id_teacher);
        // $schedule_theory = $this->M_Admin->getData_schedule_theory(null, null, null, null, $id_teacher);
        // $schedule_pratical = $this->M_Admin->getData_schedule_package_teacher(null, null, null, null, $id_teacher);

        // $feereport_temp = [];
        // if (count($feereport) > 0) {
        //     foreach ($feereport as $n) {
        //         $feereport_temp[] = substr($n['date'], 0, 7);
        //     }
        // }
        // if (count($offline_trial) > 0) {
        //     foreach ($offline_trial as $ot) {
        //         $feereport_temp[] = substr($ot['date'], 0, 7);
        //     }
        // }
        // if (count($schedule_theory) > 0) {
        //     foreach ($schedule_theory as $ot) {
        //         $feereport_temp[] = substr($ot['date'], 0, 7);
        //     }
        // }
        // if (count($schedule_pratical) > 0) {
        //     foreach ($schedule_pratical as $ot) {
        //         if ($ot['status'] == 2 || $ot['status'] == 4) {
        //             $feereport_temp[] = substr($ot['date_schedule'], 0, 7);
        //         }
        //         if ($ot['status'] == 3 && $ot['date_update_cancel'] != null) {
        //             $feereport_temp[] = substr($ot['date_update_cancel'], 0, 7);
        //         }
        //     }
        // }
        // if (count($event_teacher) > 0) {
        //     foreach ($event_teacher as $n) {
        //         $temp_month =  substr($n['event_date'], 0, 7) . "-05";
        //         $periode = substr($n['event_date'], 0, 7);
        //         if (substr($n['event_date'], 0, 10) < $temp_month) {
        //             $feereport_temp[] = substr($n['event_date'], 0, 7);
        //         } else {
        //             $startdate = strtotime("$periode");
        //             $enddate = strtotime("+1 months", $startdate);
        //             $temp_date =  date("Y-m", $enddate);

        //             $feereport_temp[] = $temp_date;
        //         }
        //     }
        // }
        $feereport = $this->M_Admin->getData_sirkulasi_feereport(null, null, null, null, $id_teacher);
        $feereport_temp = [];
        foreach ($feereport as $n) {
            $feereport_temp[] = substr($n['created_at'], 0, 7);
        }
        $feereport_temp = array_unique($feereport_temp);
        rsort($feereport_temp);
        // echo var_dump($feereport_temp);
        $teacher = $this->M_Teacher->getData_teacher($this->session->userdata('id'));
        $title = "Fee Report | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'teacher' => $teacher));
        $this->load->view('portal/teacher/fee_report', array('feereport_temp' => $feereport_temp));
        $this->load->view('portal/reuse/footer');
    }

    public function event()
    {
        $this->cekLogin();
        $teacher = $this->M_Teacher->getData_teacher($this->session->userdata('id'));
        $title = "Fee Report | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'teacher' => $teacher));
        $this->load->view('portal/teacher/event', $teacher);
        $this->load->view('portal/reuse/footer');
    }

    public function add_event($id_teacher)
    {
        $this->cekLogin();
        $today = date("Y-m-d");
        $teacher = $this->M_Teacher->getData_teacher($this->session->userdata('id'));
        $title = "Data add_event | Portal Etude";
        $description = "Welcome to Portal Etude";
        $event = $this->M_Teacher->getData_event(null, $id_teacher, $today);
        $temp_event_teacher = [];
        $event_teacher = $this->M_Admin->getData_event_teacher();
        foreach ($event_teacher as $es) :
            if ($es['id_teacher'] == $id_teacher) {
                $temp_event_teacher[] = $es['id_event'];
            }
        endforeach;
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'teacher' => $teacher));
        $this->load->view('portal/teacher/add_event', array('event' => $event, 'temp_event_teacher' => $temp_event_teacher));
        $this->load->view('portal/reuse/footer');
    }

    public function add_data_event()
    {
        $this->cekLogin();
        $res = $this->M_Teacher->insertDataEvent();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully added');
            redirect('portal/event_teacher');
        } else {
            $this->session->set_flashdata('warning', 'Failed to add data');
            redirect('portal/event_teacher');
        }
    }

    function delete_data_event($id_event)
    {
        $res = $this->M_Teacher->deleteDataEvent($id_event);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully deleted');
            redirect('portal/event_teacher');
        } else {
            $this->session->set_flashdata('warning', 'Failed to delete data');
            redirect('portal/event_teacher');
        }
    }

    public function load_package_offline($id_list_package_offline)
    {
        $event_data = $this->M_Teacher->fetch_all_package_offline($id_list_package_offline, $this->session->userdata('id'));
        $z = 1;
        $x = 1;
        foreach ($event_data->result_array() as $row) {
            $title = '';
            $color = '';
            $temp_date = '';
            if ($row['status'] != 3) {
                if ($row['status'] == 1) {
                    $title = 'Undone';
                    $color = '#EB1AE0';
                }
                if ($row['status'] == 2) {
                    $title = 'Paket ' . $x++;
                    $color = '#DE7CD9';
                }
                if ($row['status'] == 3) {
                    // $title = 'Cancel';
                    $color = '#ffffff';
                }
                if ($row['status'] == 4) {
                    $title = 'New Schedule';
                    $color = '#54a0ff';
                }
                if ($row['status'] == 5) {
                    $title = 'Late';
                    $color = '#FF5C58';
                }
                if ($row['status'] == 7) {
                    $title = 'No Lesson';
                    $color = '#D0CAB2';
                }
                $temp_date = $row['date_schedule'];
            }
            if ($row['status'] == 3 && $row['date_update_cancel'] != NULL) {
                $title = 'Reschedule';
                $title = 'Re - Lesson ' . $x++;
                $color = '#DE7CD9';
                $temp_date = $row['date_update_cancel'];
            }
            if ($row['status'] == 3 && $row['date_update_cancel'] == NULL) {
                $title = 'Cancel';
                $color = '#DE7CD9';
                $temp_date = $row['date_schedule'];
            }
            $data[] = array(
                'id' => $row['id_schedule_package_offline'],
                'allDay' => true,
                'stick' => true,
                'start' => $temp_date,
                'end' => $temp_date,
                'title' => $title,
                'date' => $temp_date,
                'id_list_package_offline' => $row['id_list_package_offline'],
                'color' => $color,
                'status' => $row['status']
            );
        }
        echo json_encode($data);
    }

    public function load_package($id_list_pack)
    {
        $event_data = $this->M_Teacher->fetch_all_package($id_list_pack, $this->session->userdata('id'));
        // echo var_dump($event_data->result_array());
        // die();
        $z = 1;
        $x = 1;
        foreach ($event_data->result_array() as $row) {
            // echo $row['id_schedule_pack'];/
            // die();
            $title = '';
            $color = '';
            $temp_date = '';
            if ($row['status'] != 3) {
                if ($row['jenis'] == 1) {
                    if ($row['status'] == 1) {
                        $title = 'Undone';
                        $color = '#43E514';
                    }
                    if ($row['status'] == 2) {
                        if (fmod($z++, 2) == 1) {
                            $title = 'Paket ' . $x . ' A';
                        } else {
                            $title = 'Paket ' . $x++ . ' B';
                        }
                        $color = '#5356FF';
                    }
                    if ($row['status'] == 3) {
                        // $title = 'Cancel';
                        $color = '#ffffff';
                    }
                    if ($row['status'] == 4) {
                        $title = 'New Schedule';
                        $color = '#54a0ff';
                    }
                    if ($row['status'] == 5) {
                        $title = 'Late';
                        $color = '#FF5C58';
                    }
                    if ($row['status'] == 7) {
                        $title = 'No Lesson';
                        $color = '#D0CAB2';
                    }
                }
                if ($row['jenis'] == 2) {
                    if ($row['status'] == 1) {
                        $title = 'Undone';
                        $color = '#0676BD';
                    }
                    if ($row['status'] == 2) {
                        if (fmod($z++, 2) == 1) {
                            $title = 'Paket ' . $x . ' A';
                        } else {
                            $title = 'Paket ' . $x++ . ' B';
                        }
                        $color = '#0D99FF';
                    }
                    if ($row['status'] == 3) {
                        // $title = 'Cancel';
                        $color = '#ffffff';
                    }
                    if ($row['status'] == 4) {
                        $title = 'New Schedule';
                        $color = '#54a0ff';
                    }
                    if ($row['status'] == 5) {
                        $title = 'Late';
                        $color = '#FF5C58';
                    }
                    if ($row['status'] == 7) {
                        $title = 'No Lesson';
                        $color = '#D0CAB2';
                    }
                }
                $temp_date = $row['date_schedule'];
            }
            if ($row['status'] == 3 && $row['date_update_cancel'] != NULL) {
                $title = 'Reschedule';

                if (fmod($z++, 2) == 1) {
                    $title = 'Re - Lesson ' . $x . ' A';
                } else {
                    $title = 'Re - Lesson ' . $x++ . ' B';
                }
                if ($row['jenis'] == 1) {
                    $color = '#5356FF';
                }
                if ($row['jenis'] == 2) {
                    $color = '#0D99FF';
                }
                $temp_date = $row['date_update_cancel'];
            }
            if ($row['status'] == 3 && $row['date_update_cancel'] == NULL) {
                $title = 'Cancel';
                if ($row['jenis'] == 1) {
                    $color = '#5356FF';
                }
                if ($row['jenis'] == 2) {
                    $color = '#0D99FF';
                }
                $temp_date = $row['date_schedule'];
            }
            $data[] = array(
                'id' => $row['id_schedule_pack'],
                'allDay' => true,
                'stick' => true,
                'start' => $temp_date,
                'end' => $temp_date,
                'title' => $title,
                'date' => $temp_date,
                'id_list_pack' => $row['id_list_pack'],
                'color' => $color,
                'jenis' => $row['jenis'],
                'status' => $row['status']
            );
        }
        // foreach ($event_data->result_array() as $row) {
        //     if ($row['status'] == 3 && $row['date_update_cancel'] != NULL) {
        //         // if (fmod($z++, 2) == 1) {
        //         //     $title = 'Reschedule - Lesson ' . $x . ' A';
        //         // } else {
        //         //     $title = 'Reschedule - Lesson ' . $x++ . ' B';
        //         // }
        //         $title = 'Reschedule';
        //         $color = '#10ac84';
        //         $temp_date = $row['date_update_cancel'];
        //         $data[] = array(
        //             'id' => $row['id_schedule_pack'],
        //             'allDay' => true,
        //             'stick' => true,
        //             'start' => $temp_date,
        //             'end' => $temp_date,
        //             'title' => $title,
        //             'date' => $temp_date,
        //             'id_list_pack' => $row['id_list_pack'],
        //             'color' => $color,
        //             'jenis' => $row['jenis'],
        //             'status' => $row['status']
        //         );
        //     }
        // }
        echo json_encode($data);
    }

    public function testWeek()
    {
        $today = date("Y-m-d");
        $tempDay = '';

        if ((date('N', strtotime($today)) == 1)) {
            $tempDay = $today;
        }
        if ((date('N', strtotime($today)) == 2)) {
            $tempDay = date('Y-m-d', strtotime('-1 days'));
        }
        if ((date('N', strtotime($today)) == 3)) {
            $tempDay = date('Y-m-d', strtotime('-2 days'));
        }
        if ((date('N', strtotime($today)) == 4)) {
            $tempDay = date('Y-m-d', strtotime('-3 days'));
        }
        if ((date('N', strtotime($today)) == 5)) {
            $tempDay = date('Y-m-d', strtotime('-4 days'));
        }
        if ((date('N', strtotime($today)) == 6)) {
            $tempDay = date('Y-m-d', strtotime('-5 days'));
        }
        if ((date('N', strtotime($today)) == 4)) {
            $tempDay = date('Y-m-d', strtotime('-3 days'));
        }
        echo "<br>";
        echo "<br>";
        echo var_dump($tempDay);
    }

    public function cek_package_offline($id_pack)
    {
        $this->cekLogin();
        $today = date("Y-m-d");
        $tempDay = '';

        if ((date('N', strtotime($today)) == 1)) {
            $tempDay = $today;
        }
        if ((date('N', strtotime($today)) == 2)) {
            $tempDay = date('Y-m-d', strtotime('-1 days'));
        }
        if ((date('N', strtotime($today)) == 3)) {
            $tempDay = date('Y-m-d', strtotime('-2 days'));
        }
        if ((date('N', strtotime($today)) == 4)) {
            $tempDay = date('Y-m-d', strtotime('-3 days'));
        }
        if ((date('N', strtotime($today)) == 5)) {
            $tempDay = date('Y-m-d', strtotime('-4 days'));
        }
        if ((date('N', strtotime($today)) == 6)) {
            $tempDay = date('Y-m-d', strtotime('-5 days'));
        }
        if ((date('N', strtotime($today)) == 7)) {
            $tempDay = date('Y-m-d', strtotime('-6 days'));
        }
        $schedule_online2 = $this->M_Teacher->getData_schedule_package_offline(null, $id_pack, 1, $tempDay);
        $temp_schedule = [];
        foreach ($schedule_online2 as $so) {
            $temp_schedule[] = $so['id_schedule_package_offline'];
        }
        for ($i = 0; $i < count($temp_schedule); $i++) {
            $data = array(
                'status' => 5,
            );
            $this->M_Teacher->update_event_schedule_package_offline($data, $temp_schedule[$i]);
        }

        $pack_online = $this->M_Teacher->getData_pack_offline($id_pack, 1);
        $schedule_online = $this->M_Teacher->getData_schedule_package_offline(null, $id_pack);
        $schedule_cancel = $this->M_Teacher->getData_schedule_package_offline(null, $id_pack, 3);
        $schedule_new = $this->M_Teacher->getData_schedule_package_offline(null, $id_pack, 4);
        $count_package = [];
        foreach ($schedule_online as $so) {
            if ($so['status'] == 2 || ($so['status'] == 3 && $so['date_update_cancel'] != NULL)) :
                $count_package[] = $so['id_schedule_package_offline'];
            endif;
        }

        $pack_package = $pack_online[0]['total_package'];
        $count1 = intval($pack_package) - intval(count($count_package));
        $count3 = 0;
        foreach ($schedule_cancel as $sc) {
            if ($sc['date_update_cancel'] == NULL) {
                $count3++;
            }
        }
        $temp_event[] = " Lesson Package : ";
        $temp_event[] = '<span class="badge badge-primary">' . $count1 . ' package (' . $count1 . ' meeting)</span> ';
        $temp_event[] = '<input type="hidden" id="countPackage" name="countPackage" value="' . $count1 . '">';

        if ($count3 > 0) {
            $temp_event[] = "<br>";
            $temp_event[] = "Lesson Cancel = ";
            $temp_event[] = '<span class="badge badge-danger">' . $count3 . ' lesson</span>, Please change date!';
            $z = 1;
            foreach ($schedule_cancel as $so) {
                if ($so['date_update_cancel'] == NULL) {
                    $temp_event[] = '<input type="hidden" id="id_schedule_package_offline' . $z++ . '" value="' . $so['id_schedule_package_offline'] . '">';
                }
            }
        }
        $temp_event[] = '<input type="hidden" id="countCancel" name="countCancel" value="' . $count3 . '">';

        $event_join = implode(" ", $temp_event);
        echo $event_join;
    }

    function update_schedule_package_offline()
    {
        $this->cekLogin();
        $status = $this->input->post('status');
        $id_list_package_offline = $this->input->post('id_list_package_offline');
        $is_new = $this->input->post('is_new');

        if ($status == 2) {
            $teacher_percentage = $this->input->post('teacher_percentage');
            $paket = $this->input->post('paket');
            $price = $this->input->post('price');
            $created_at = $this->input->post('tgl');
            $id_teacher = $this->input->post('id_teacher');
            $id_student = $this->input->post('id_student');
            $temp_id_student = substr($id_student, 3);
            $temp_id_teacher = substr($id_teacher, 3);
            $tipe = 3;
            $tipe_rate = '';
            $potongan = $this->input->post('potongan');
            $price_paket = $this->input->post('price_paket');
            //nomor sirkulasi lesson
            //LESS/002/015/3 => tipe offline lesson

            $no_sirkulasi_lesson = 'LESS/' .  $temp_id_teacher . "/" . $temp_id_student . "/" . $tipe . "/" . $id_list_package_offline;
            $cek_sirkulasi = $this->M_Teacher->getData_sirkulasi_lesson(null, $no_sirkulasi_lesson, $id_teacher, $id_student, $tipe);

            $periode_now = substr($created_at, 0, 7);
            $effectiveDate = date($periode_now);
            $effectiveDate = date('Y-m', strtotime("+1 months", strtotime($effectiveDate)));
            $temp_period = $effectiveDate . "-01";
            //cek next periode
            $get_data_50_next_periode = $this->M_Teacher->getData_sirkulasi_lesson_detail(null, null, $id_teacher, $id_student, $tipe, null, 50, $temp_period);
            //cek before periode
            $get_data_before_periode = $this->M_Teacher->getData_sirkulasi_lesson_detail_before($id_teacher, $id_student, $tipe, $created_at);
            $get_data_after_periode = $this->M_Teacher->getData_sirkulasi_lesson_detail_after($id_teacher, $id_student, $tipe, $created_at);
            if (count($get_data_50_next_periode) > 0) {
                $cek_sirkulasi_next_periode = $this->M_Teacher->getData_sirkulasi_lesson(null, $get_data_50_next_periode[0]['no_sirkulasi_lesson'], $id_teacher, $id_student, $tipe);
            }
            if ((count($get_data_before_periode) + count($get_data_after_periode)) >= $potongan) {
                if (count($cek_sirkulasi) > 0) {
                    $data_update_sirkulasi = null;
                    $total = $cek_sirkulasi[0]['total'];
                    $total_rate = $cek_sirkulasi[0]['total_rate'];
                    $total_50 = $cek_sirkulasi[0]['total_50'];

                    if (count($get_data_50_next_periode) > 0) {
                        $data = array(
                            'total_50' => $cek_sirkulasi_next_periode[0]['total_50'] - 1,
                            'total_rate' => $cek_sirkulasi_next_periode[0]['total_rate'] + 1,
                        );
                        $this->M_Teacher->updateDataSirkulasiLesson($data, $cek_sirkulasi_next_periode[0]['no_sirkulasi_lesson']);
                        if ($cek_sirkulasi[0]['created_at'] == NULL) {
                            $data_update_sirkulasi = array(
                                'created_at' => $created_at,
                                'last_updated_50' => $created_at,
                                'total_50' => $total_50 + 1,
                                'total' => $total + 1
                            );
                        } else {
                            $data_update_sirkulasi = array(
                                'last_updated_50' => $created_at,
                                'total_50' => $total_50 + 1,
                                'total' => $total + 1
                            );
                        }
                    } else {
                        if ($cek_sirkulasi[0]['rate_created_at'] == NULL) {
                            $data_update_sirkulasi = array(
                                'rate_created_at' => $created_at,
                                'last_updated_rate' => $created_at,
                                'total_rate' => $total_rate + 1,
                                'total' => $total + 1
                            );
                        } else {
                            $data_update_sirkulasi = array(
                                'last_updated_rate' => $created_at,
                                'total_rate' => $total_rate + 1,
                                'total' => $total + 1
                            );
                        }
                    }
                    $this->M_Teacher->updateDataSirkulasiLesson($data_update_sirkulasi, $no_sirkulasi_lesson);
                } else {
                    if (count($get_data_50_next_periode) > 0) {
                        $data = array(
                            'total_50' => intval($cek_sirkulasi_next_periode[0]['total_50']) - 1,
                            'total_rate' => intval($cek_sirkulasi_next_periode[0]['total_rate']) + 1,
                            'rate_created_at' => $created_at,
                            'last_updated_rate' => $created_at,
                        );
                        $this->M_Teacher->updateDataSirkulasiLesson($data, $cek_sirkulasi_next_periode[0]['no_sirkulasi_lesson']);
                        $data_sirkulasi = array(
                            'no_sirkulasi_lesson' => $no_sirkulasi_lesson,
                            'id_teacher' => $id_teacher,
                            'id_student' => $id_student,
                            'tipe' => $tipe,
                            'id_list_package_offline' => $id_list_package_offline,
                            'rate' => $teacher_percentage,
                            'total_50' => 1,
                            'total_rate' => 0,
                            'total' => 1,
                            'created_at' => $created_at,
                            'last_updated_50' => $created_at,
                            'rate_created_at' => NULL,
                            'last_updated_rate' => NULL,
                        );
                    } else {
                        $data_sirkulasi = array(
                            'no_sirkulasi_lesson' => $no_sirkulasi_lesson,
                            'id_teacher' => $id_teacher,
                            'id_student' => $id_student,
                            'tipe' => $tipe,
                            'id_list_package_offline' => $id_list_package_offline,
                            'rate' => $teacher_percentage,
                            'total_50' => 0,
                            'total_rate' => 1,
                            'total' => 1,
                            'created_at' => NULL,
                            'last_updated_50' => NULL,
                            'rate_created_at' => $created_at,
                            'last_updated_rate' => $created_at,
                        );
                    }
                    $this->M_Teacher->addDataSirkulasiLesson($data_sirkulasi);
                }
                $tipe_rate = $teacher_percentage;
            } else {
                if (count($cek_sirkulasi) > 0) {
                    $data_update_sirkulasi = null;

                    $total = $cek_sirkulasi[0]['total'];
                    $total_50 = $cek_sirkulasi[0]['total_50'];
                    $total_rate = $cek_sirkulasi[0]['total_rate'];

                    if ($total_50 >= $potongan) {
                        if ($cek_sirkulasi[0]['rate_created_at'] == NULL) {
                            $data_update_sirkulasi = array(
                                'rate_created_at' => $created_at,
                                'last_updated_rate' => $created_at,
                                'total_rate' => $total_rate + 1,
                                'total' => $total + 1
                            );
                        } else {
                            $data_update_sirkulasi = array(
                                'last_updated_rate' => $created_at,
                                'total_rate' => $total_rate + 1,
                                'total' => $total + 1
                            );
                        }
                        $tipe_rate = $teacher_percentage;
                    } else {
                        $data_update_sirkulasi = array(
                            'last_updated_50' => $created_at,
                            'total_50' => $total_50 + 1,
                            'total' => $total + 1
                        );
                        if ($is_new == 2) {
                            $tipe_rate = $teacher_percentage;
                        } else {
                            $tipe_rate = 50;
                        }
                    }
                    $this->M_Teacher->updateDataSirkulasiLesson($data_update_sirkulasi, $no_sirkulasi_lesson);
                } else {
                    $data_sirkulasi = array(
                        'no_sirkulasi_lesson' => $no_sirkulasi_lesson,
                        'id_teacher' => $id_teacher,
                        'id_student' => $id_student,
                        'tipe' => $tipe,
                        'id_list_package_offline' => $id_list_package_offline,
                        'rate' => $teacher_percentage,
                        'total_50' => 1,
                        'total_rate' => 0,
                        'total' => 1,
                        'created_at' => $created_at,
                        'last_updated_50' => $created_at,
                    );
                    $this->M_Teacher->addDataSirkulasiLesson($data_sirkulasi);
                    $tipe_rate = 50;
                }
            }

            if ($tipe_rate != 50) {
                if (count($get_data_50_next_periode) > 0) {
                    $tipe_rate = 50;
                    $data = array(
                        'rate' => $teacher_percentage,
                        'price' => $price_paket * $teacher_percentage / 100,
                        // 'price' => $price * $teacher_percentage / 100,
                    );
                    $this->M_Teacher->updateDataSirkulasiLessonDetail($data, $get_data_50_next_periode[0]['id_sirkulasi_lesson_detail']);
                } else {
                    $tipe_rate = $teacher_percentage;
                }
            }

            $data_sirkulasi_lesson_detail = array(
                'no_sirkulasi_lesson' => $no_sirkulasi_lesson,
                'id_teacher' => $id_teacher,
                'id_student' => $id_student,
                'lesson_date' => $created_at,
                'id_list_package_offline' => $id_list_package_offline,
                'tipe' => $tipe,
                'rate' => $tipe_rate,
                'price' => $price_paket * $tipe_rate / 100,
                'paket' => $paket,
            );
            $this->M_Teacher->addDataSirkulasiLessonDetail($data_sirkulasi_lesson_detail);

            //nomor feereport 
            //FER/210629/004
            $startdate = strtotime($created_at);
            $temp_date_sirkulasi =  date("Ym", $startdate);
            $no_sirkulasi_feereport = "FER/" . $temp_date_sirkulasi . "/" . $temp_id_teacher . "/001";
            $data_sirkulasi_feereport = $this->M_Teacher->getData_sirkulasi_feereport(null, $no_sirkulasi_feereport);
            $data_sirkulasi_feereport_detail = $this->M_Teacher->getData_sirkulasi_feereport_detail(null, $no_sirkulasi_feereport, $tipe, $no_sirkulasi_lesson);

            $data_sirkulasi_feereport_next_periode = $this->M_Teacher->getData_sirkulasi_feereport(null, null, 0, $id_teacher, $effectiveDate);

            if ((count($get_data_before_periode) + count($get_data_after_periode)) >= $potongan) {
                if (count($get_data_50_next_periode) > 0) {
                    $sirkulasi_detail_after = $this->M_Teacher->getData_sirkulasi_feereport_detail(null, $data_sirkulasi_feereport_next_periode[0]["no_sirkulasi_feereport"], $tipe, $cek_sirkulasi_next_periode[0]['no_sirkulasi_lesson']);
                    $data = array(
                        'price' => $sirkulasi_detail_after[0]['price'] - ($price_paket * 50 / 100) + ($price_paket * $teacher_percentage / 100),
                    );
                    $this->db->update('sirkulasi_feereport_detail', $data, ['id' => $sirkulasi_detail_after[0]['id']]);

                    $discount = (intval($data_sirkulasi_feereport_next_periode[0]['price']) - ($price_paket * 50 / 100) + ($price_paket * $teacher_percentage / 100)) * intval($data_sirkulasi_feereport_next_periode[0]['discount']) / 100;
                    $price_temp_feereport = intval($data_sirkulasi_feereport_next_periode[0]['price']) - ($price_paket * 50 / 100) + ($price_paket * $teacher_percentage / 100);
                    $data2 =  [
                        'price' => $price_temp_feereport,
                        'total_price' => $price_temp_feereport - $discount,
                        'updated_at' => $created_at,
                    ];
                    $this->db->update('sirkulasi_feereport', $data2, ['id_sirkulasi_feereport' => $data_sirkulasi_feereport_next_periode[0]['id_sirkulasi_feereport']]);
                }
            }

            $data2 = [];
            $data3 = [];
            $price = $price_paket * $tipe_rate / 100;
            if (count($data_sirkulasi_feereport) == 0) {
                $data2 =  [
                    'no_sirkulasi_feereport' => $no_sirkulasi_feereport,
                    'id_teacher' => $this->input->post('id_teacher'),
                    'created_at' => $created_at,
                    'updated_at' => $created_at,
                    'price' => $price,
                    'total_price' => $price,
                ];
                $data3 = [
                    'no_sirkulasi_feereport' => $no_sirkulasi_feereport,
                    'id_barang' => $no_sirkulasi_lesson,
                    'id_teacher' => $this->input->post('id_teacher'),
                    'tipe' => $tipe,
                    'price' => $price,
                ];
                $this->db->insert('sirkulasi_feereport', $data2);
                $this->db->insert('sirkulasi_feereport_detail', $data3);
            } else {
                if ($data_sirkulasi_feereport[0]['status_approved'] == 0) {
                    $discount = (intval($data_sirkulasi_feereport[0]['price']) + intval($price)) * intval($data_sirkulasi_feereport[0]['discount']) / 100;
                    $data2 =  [
                        'price' => intval($data_sirkulasi_feereport[0]['price']) + intval($price),
                        'total_price' => intval($data_sirkulasi_feereport[0]['price']) + intval($price) - $discount,
                        'updated_at' => $created_at,
                    ];
                    $this->db->update('sirkulasi_feereport', $data2, ['id_sirkulasi_feereport' => $data_sirkulasi_feereport[0]['id_sirkulasi_feereport']]);

                    if (count($data_sirkulasi_feereport_detail) == 0) {
                        $data3 = [
                            'no_sirkulasi_feereport' => $data_sirkulasi_feereport[0]['no_sirkulasi_feereport'],
                            'id_teacher' => $this->input->post('id_teacher'),
                            'id_barang' => $no_sirkulasi_lesson,
                            'tipe' => $tipe,
                            'price' => $price,
                        ];
                        $this->db->insert('sirkulasi_feereport_detail', $data3);
                    } else {
                        $data3 = [
                            'price' => intval($data_sirkulasi_feereport_detail[0]['price']) + intval($price),
                        ];
                        $this->db->update('sirkulasi_feereport_detail', $data3, ['id' => $data_sirkulasi_feereport_detail[0]['id']]);
                    }
                }
            }
        }

        $data = array(
            'status' => $this->input->post('status'),
        );
        $data2 = $this->M_Teacher->update_event_schedule_package_offline($data, $this->input->post('id_schedule_online'));

        $pack_online = $this->M_Teacher->getData_pack_offline($id_list_package_offline);
        $schedule_online = $this->M_Teacher->getData_schedule_package_offline(null, $id_list_package_offline);
        $schedule_cancel = $this->M_Teacher->getData_schedule_package_offline(null, $id_list_package_offline, 3);
        $schedule_new = $this->M_Teacher->getData_schedule_package_offline(null, $id_list_package_offline, 4);
        $count_package = [];
        foreach ($schedule_online as $so) {
            if ($so['status'] == 2 || ($so['status'] == 3 && $so['date_update_cancel'] != NULL)) :
                $count_package[] = $so['id_schedule_package_offline'];
            endif;
        }

        $pack_package = $pack_online[0]['total_package'];
        $count1 = intval($pack_package) - intval(count($count_package));
        $count3 = 0;
        foreach ($schedule_cancel as $sc) {
            if ($sc['date_update_cancel'] == NULL) {
                $count3++;
            }
        }
        $temp_event[] = " Lesson Package :";
        $temp_event[] = '<span class="badge badge-primary">' . $count1 . ' package (' . $count1 . ' meeting)</span> ';
        $temp_event[] = '<input type="hidden" id="countPackage" name="countPackage" value="' . $count1 . '">';
        if ($count3 > 0) {
            $temp_event[] = "<br>";
            $temp_event[] = "Lesson Cancel = ";
            $temp_event[] = '<span class="badge badge-danger">' . $count3 . ' lesson</span>, Please change date!';
        }
        $temp_event[] = '<input type="hidden" id="countCancel" name="countCancel" value="' . $count3 . '">';

        $event_join = implode(" ", $temp_event);
        echo $event_join;
    }

    function reschedule_package_offline()
    {
        $this->cekLogin();

        $id_list_package_offline = $this->input->post('id_list_package_offline');
        $is_new = $this->input->post('is_new');

        $teacher_percentage = $this->input->post('teacher_percentage');
        $paket = $this->input->post('paket');
        $price = $this->input->post('price');
        $created_at = $this->input->post('date_update_cancel');
        $id_student = $this->input->post('id_student');
        $id_teacher = $this->input->post('id_teacher');
        $temp_id_student = substr($id_student, 3);
        $temp_id_teacher = substr($id_teacher, 3);
        $tipe = 3;
        $tipe_rate = '';
        $potongan = $this->input->post('potongan');
        $price_paket = $this->input->post('price_paket');

        //nomor sirkulasi lesson
        //LESS/002/015/1 => tipe online lesson

        $no_sirkulasi_lesson = 'LESS/' .  $temp_id_teacher . "/" . $temp_id_student . "/" . $tipe . "/" . $id_list_package_offline;
        $cek_sirkulasi = $this->M_Teacher->getData_sirkulasi_lesson(null, $no_sirkulasi_lesson, $id_teacher, $id_student, $tipe);

        $periode_now = substr($created_at, 0, 7);
        $effectiveDate = date($periode_now);
        $effectiveDate = date('Y-m', strtotime("+1 months", strtotime($effectiveDate)));
        $temp_period = $effectiveDate . "-01";
        //cek next periode
        $get_data_50_next_periode = $this->M_Teacher->getData_sirkulasi_lesson_detail(null, null, $id_teacher, $id_student, $tipe, null, 50, $temp_period);
        //cek before periode
        $get_data_before_periode = $this->M_Teacher->getData_sirkulasi_lesson_detail_before($id_teacher, $id_student, $tipe, $created_at);
        $get_data_after_periode = $this->M_Teacher->getData_sirkulasi_lesson_detail_after($id_teacher, $id_student, $tipe, $created_at);
        if (count($get_data_50_next_periode) > 0) {
            $cek_sirkulasi_next_periode = $this->M_Teacher->getData_sirkulasi_lesson(null, $get_data_50_next_periode[0]['no_sirkulasi_lesson'], $id_teacher, $id_student, $tipe);
        }

        if ((count($get_data_before_periode) + count($get_data_after_periode)) >= $potongan) {
            if (count($cek_sirkulasi) > 0) {
                $data_update_sirkulasi = null;
                $total = $cek_sirkulasi[0]['total'];
                $total_rate = $cek_sirkulasi[0]['total_rate'];
                $total_50 = $cek_sirkulasi[0]['total_50'];

                if (count($get_data_50_next_periode) > 0) {
                    $data = array(
                        'total_50' => $cek_sirkulasi_next_periode[0]['total_50'] - 1,
                        'total_rate' => $cek_sirkulasi_next_periode[0]['total_rate'] + 1,
                    );
                    $this->M_Teacher->updateDataSirkulasiLesson($data, $cek_sirkulasi_next_periode[0]['no_sirkulasi_lesson']);
                    if ($cek_sirkulasi[0]['created_at'] == NULL) {
                        $data_update_sirkulasi = array(
                            'created_at' => $created_at,
                            'last_updated_50' => $created_at,
                            'total_50' => $total_50 + 1,
                            'total' => $total + 1
                        );
                    } else {
                        $data_update_sirkulasi = array(
                            'last_updated_50' => $created_at,
                            'total_50' => $total_50 + 1,
                            'total' => $total + 1
                        );
                    }
                } else {
                    if ($cek_sirkulasi[0]['rate_created_at'] == NULL) {
                        $data_update_sirkulasi = array(
                            'rate_created_at' => $created_at,
                            'last_updated_rate' => $created_at,
                            'total_rate' => $total_rate + 1,
                            'total' => $total + 1
                        );
                    } else {
                        $data_update_sirkulasi = array(
                            'last_updated_rate' => $created_at,
                            'total_rate' => $total_rate + 1,
                            'total' => $total + 1
                        );
                    }
                }
                $this->M_Teacher->updateDataSirkulasiLesson($data_update_sirkulasi, $no_sirkulasi_lesson);
            } else {
                if (count($get_data_50_next_periode) > 0) {
                    $data = array(
                        'total_50' => intval($cek_sirkulasi_next_periode[0]['total_50']) - 1,
                        'total_rate' => intval($cek_sirkulasi_next_periode[0]['total_rate']) + 1,
                        'rate_created_at' => $created_at,
                        'last_updated_rate' => $created_at,
                    );
                    $this->M_Teacher->updateDataSirkulasiLesson($data, $cek_sirkulasi_next_periode[0]['no_sirkulasi_lesson']);
                    $data_sirkulasi = array(
                        'no_sirkulasi_lesson' => $no_sirkulasi_lesson,
                        'id_teacher' => $id_teacher,
                        'id_student' => $id_student,
                        'tipe' => $tipe,
                        'id_list_package_offline' => $id_list_package_offline,
                        'rate' => $teacher_percentage,
                        'total_50' => 1,
                        'total_rate' => 0,
                        'total' => 1,
                        'created_at' => $created_at,
                        'last_updated_50' => $created_at,
                        'rate_created_at' => NULL,
                        'last_updated_rate' => NULL,
                    );
                } else {
                    $data_sirkulasi = array(
                        'no_sirkulasi_lesson' => $no_sirkulasi_lesson,
                        'id_teacher' => $id_teacher,
                        'id_student' => $id_student,
                        'tipe' => $tipe,
                        'id_list_package_offline' => $id_list_package_offline,
                        'rate' => $teacher_percentage,
                        'total_50' => 0,
                        'total_rate' => 1,
                        'total' => 1,
                        'created_at' => NULL,
                        'last_updated_50' => NULL,
                        'rate_created_at' => $created_at,
                        'last_updated_rate' => $created_at,
                    );
                }
                $this->M_Teacher->addDataSirkulasiLesson($data_sirkulasi);
            }
            $tipe_rate = $teacher_percentage;
        } else {
            if (count($cek_sirkulasi) > 0) {
                $data_update_sirkulasi = null;

                $total = $cek_sirkulasi[0]['total'];
                $total_50 = $cek_sirkulasi[0]['total_50'];
                $total_rate = $cek_sirkulasi[0]['total_rate'];

                if ($total_50 >= $potongan) {
                    if ($cek_sirkulasi[0]['rate_created_at'] == NULL) {
                        $data_update_sirkulasi = array(
                            'rate_created_at' => $created_at,
                            'last_updated_rate' => $created_at,
                            'total_rate' => $total_rate + 1,
                            'total' => $total + 1
                        );
                    } else {
                        $data_update_sirkulasi = array(
                            'last_updated_rate' => $created_at,
                            'total_rate' => $total_rate + 1,
                            'total' => $total + 1
                        );
                    }
                    $tipe_rate = $teacher_percentage;
                } else {
                    $data_update_sirkulasi = array(
                        'last_updated_50' => $created_at,
                        'total_50' => $total_50 + 1,
                        'total' => $total + 1
                    );
                    if ($is_new == 2) {
                        $tipe_rate = $teacher_percentage;
                    } else {
                        $tipe_rate = 50;
                    }
                }
                $this->M_Teacher->updateDataSirkulasiLesson($data_update_sirkulasi, $no_sirkulasi_lesson);
            } else {
                $data_sirkulasi = array(
                    'no_sirkulasi_lesson' => $no_sirkulasi_lesson,
                    'id_teacher' => $id_teacher,
                    'id_student' => $id_student,
                    'tipe' => $tipe,
                    'id_list_package_offline' => $id_list_package_offline,
                    'rate' => $teacher_percentage,
                    'total_50' => 1,
                    'total_rate' => 0,
                    'total' => 1,
                    'created_at' => $created_at,
                    'last_updated_50' => $created_at,
                );
                $this->M_Teacher->addDataSirkulasiLesson($data_sirkulasi);
                $tipe_rate = 50;
            }
        }

        if ($tipe_rate != 50) {
            if (count($get_data_50_next_periode) > 0) {
                $tipe_rate = 50;
                $data = array(
                    'rate' => $teacher_percentage,
                    'price' => $price_paket * $teacher_percentage / 100,
                    // 'price' => $price * $teacher_percentage / 100,
                );
                $this->M_Teacher->updateDataSirkulasiLessonDetail($data, $get_data_50_next_periode[0]['id_sirkulasi_lesson_detail']);
            } else {
                $tipe_rate = $teacher_percentage;
            }
        }

        $data_sirkulasi_lesson_detail = array(
            'no_sirkulasi_lesson' => $no_sirkulasi_lesson,
            'id_student' => $id_student,
            'id_teacher' => $id_teacher,
            'id_list_package_offline' => $id_list_package_offline,
            'lesson_date' => $created_at,
            'tipe' => $tipe,
            'rate' => $tipe_rate,
            'paket' => $paket,
            'price' => $price_paket,
        );
        $this->M_Teacher->addDataSirkulasiLessonDetail($data_sirkulasi_lesson_detail);

        //nomor feereport 
        //FER/210629/004
        $startdate = strtotime($created_at);
        $temp_date_sirkulasi =  date("Ym", $startdate);
        $no_sirkulasi_feereport = "FER/" . $temp_date_sirkulasi . "/" . $temp_id_teacher . "/001";
        $data_sirkulasi_feereport = $this->M_Teacher->getData_sirkulasi_feereport(null, $no_sirkulasi_feereport);
        $data_sirkulasi_feereport_detail = $this->M_Teacher->getData_sirkulasi_feereport_detail(null, $no_sirkulasi_feereport, $tipe, $no_sirkulasi_lesson);

        $data_sirkulasi_feereport_next_periode = $this->M_Teacher->getData_sirkulasi_feereport(null, null, 0, $id_teacher, $effectiveDate);

        if ((count($get_data_before_periode) + count($get_data_after_periode)) >= $potongan) {
            if (count($get_data_50_next_periode) > 0) {
                $sirkulasi_detail_after = $this->M_Teacher->getData_sirkulasi_feereport_detail(null, $data_sirkulasi_feereport_next_periode[0]["no_sirkulasi_feereport"], $tipe, $cek_sirkulasi_next_periode[0]['no_sirkulasi_lesson']);
                $data = array(
                    'price' => $sirkulasi_detail_after[0]['price'] - ($price_paket * 50 / 100) + ($price_paket * $teacher_percentage / 100),
                );
                $this->db->update('sirkulasi_feereport_detail', $data, ['id' => $sirkulasi_detail_after[0]['id']]);

                $discount = (intval($data_sirkulasi_feereport_next_periode[0]['price']) - ($price_paket * 50 / 100) + ($price_paket * $teacher_percentage / 100)) * intval($data_sirkulasi_feereport_next_periode[0]['discount']) / 100;
                $price_temp_feereport = intval($data_sirkulasi_feereport_next_periode[0]['price']) - ($price_paket * 50 / 100) + ($price_paket * $teacher_percentage / 100);
                $data2 =  [
                    'price' => $price_temp_feereport,
                    'total_price' => $price_temp_feereport - $discount,
                    'updated_at' => $created_at,
                ];
                $this->db->update('sirkulasi_feereport', $data2, ['id_sirkulasi_feereport' => $data_sirkulasi_feereport_next_periode[0]['id_sirkulasi_feereport']]);
            }
        }

        $data2 = [];
        $data3 = [];
        $price = $price_paket * $tipe_rate / 100;
        if (count($data_sirkulasi_feereport) == 0) {
            $data2 =  [
                'no_sirkulasi_feereport' => $no_sirkulasi_feereport,
                'id_teacher' => $this->input->post('id_teacher'),
                'created_at' => $created_at,
                'updated_at' => $created_at,
                'price' => $price,
                'total_price' => $price,
            ];
            $data3 = [
                'no_sirkulasi_feereport' => $no_sirkulasi_feereport,
                'id_barang' => $no_sirkulasi_lesson,
                'id_teacher' => $this->input->post('id_teacher'),
                'tipe' => $tipe,
                'price' => $price,
            ];
            $this->db->insert('sirkulasi_feereport', $data2);
            $this->db->insert('sirkulasi_feereport_detail', $data3);
        } else {
            if ($data_sirkulasi_feereport[0]['status_approved'] == 0) {
                $discount = (intval($data_sirkulasi_feereport[0]['price']) + intval($price)) * intval($data_sirkulasi_feereport[0]['discount']) / 100;
                $data2 =  [
                    'price' => intval($data_sirkulasi_feereport[0]['price']) + intval($price),
                    'total_price' => intval($data_sirkulasi_feereport[0]['price']) + intval($price) - $discount,
                    'updated_at' => $created_at,
                ];
                $this->db->update('sirkulasi_feereport', $data2, ['id_sirkulasi_feereport' => $data_sirkulasi_feereport[0]['id_sirkulasi_feereport']]);

                if (count($data_sirkulasi_feereport_detail) == 0) {
                    $data3 = [
                        'no_sirkulasi_feereport' => $data_sirkulasi_feereport[0]['no_sirkulasi_feereport'],
                        'id_teacher' => $this->input->post('id_teacher'),
                        'id_barang' => $no_sirkulasi_lesson,
                        'tipe' => $tipe,
                        'price' => $price,
                    ];
                    $this->db->insert('sirkulasi_feereport_detail', $data3);
                } else {
                    $data3 = [
                        'price' => intval($data_sirkulasi_feereport_detail[0]['price']) + intval($price),
                    ];
                    $this->db->update('sirkulasi_feereport_detail', $data3, ['id' => $data_sirkulasi_feereport_detail[0]['id']]);
                }
            }
        }

        $data = array(
            'date_update_cancel' => $this->input->post('date_update_cancel'),
        );
        $data2 = $this->M_Teacher->update_event_schedule_package_offline($data, $this->input->post('id_schedule_pack'));

        $pack_online = $this->M_Teacher->getData_pack_offline($id_list_package_offline);
        $schedule_online = $this->M_Teacher->getData_schedule_package_offline(null, $id_list_package_offline);
        $schedule_cancel = $this->M_Teacher->getData_schedule_package_offline(null, $id_list_package_offline, 3);
        $schedule_new = $this->M_Teacher->getData_schedule_package_offline(null, $id_list_package_offline, 4);
        $count_package = [];
        foreach ($schedule_online as $so) {
            if ($so['status'] == 2 || ($so['status'] == 3 && $so['date_update_cancel'] != NULL)) :
                $count_package[] = $so['id_schedule_package_offline'];
            endif;
        }

        $pack_package = $pack_online[0]['total_package'];
        $count1 = intval($pack_package) - intval(count($count_package));
        $count3 = 0;
        foreach ($schedule_cancel as $sc) {
            if ($sc['date_update_cancel'] == NULL) {
                $count3++;
            }
        }
        $temp_event[] = " Lesson Package :";
        $temp_event[] = '<span class="badge badge-primary">' . $count1 . ' package (' . $count1 . ' meeting)</span> ';
        $temp_event[] = '<input type="hidden" id="countPackage" name="countPackage" value="' . $count1 . '">';
        if ($count3 > 0) {
            $temp_event[] = "<br>";
            $temp_event[] = "Lesson Cancel = ";
            $temp_event[] = '<span class="badge badge-danger">' . $count3 . ' lesson</span>, Please change date!';
        }
        $temp_event[] = '<input type="hidden" id="countCancel" name="countCancel" value="' . $count3 . '">';

        $event_join = implode(" ", $temp_event);
        echo $event_join;
    }

    function change_date_package_offline()
    {
        $this->cekLogin();
        $data = [];
        if($this->input->post('status_date_change') == '2'){
            $data = array(
                'date_schedule' => $this->input->post('date_change'),
            );
        }
        if($this->input->post('status_date_change') == '3'){
            $data = array(
                'date_update_cancel' => $this->input->post('date_change'),
            );
        }

        $this->M_Teacher->update_change_date_package_offline($data, $this->input->post('active_schedule_id'));
    }

    public function cek_package($id_pack, $jenis = NULL)
    {
        $this->cekLogin();
        $today = date("Y-m-d");
        $tempDay = '';

        if ((date('N', strtotime($today)) == 1)) {
            $tempDay = $today;
        }
        if ((date('N', strtotime($today)) == 2)) {
            $tempDay = date('Y-m-d', strtotime('-1 days'));
        }
        if ((date('N', strtotime($today)) == 3)) {
            $tempDay = date('Y-m-d', strtotime('-2 days'));
        }
        if ((date('N', strtotime($today)) == 4)) {
            $tempDay = date('Y-m-d', strtotime('-3 days'));
        }
        if ((date('N', strtotime($today)) == 5)) {
            $tempDay = date('Y-m-d', strtotime('-4 days'));
        }
        if ((date('N', strtotime($today)) == 6)) {
            $tempDay = date('Y-m-d', strtotime('-5 days'));
        }
        if ((date('N', strtotime($today)) == 7)) {
            $tempDay = date('Y-m-d', strtotime('-6 days'));
        }
        $schedule_online2 = $this->M_Teacher->getData_schedule_package(null, $id_pack, 1, $tempDay);
        $temp_schedule = [];
        foreach ($schedule_online2 as $so) {
            $temp_schedule[] = $so['id_schedule_pack'];
        }
        for ($i = 0; $i < count($temp_schedule); $i++) {
            $data = array(
                'status' => 5,
            );
            $this->M_Teacher->update_event_schedule_package($data, $temp_schedule[$i]);
        }


        $pack_online = $this->M_Teacher->getData_pack_online($id_pack, 1);
        $schedule_online = $this->M_Teacher->getData_schedule_package(null, $id_pack);
        $schedule_cancel = $this->M_Teacher->getData_schedule_package(null, $id_pack, 3, NULL, $jenis);
        $schedule_new = $this->M_Teacher->getData_schedule_package(null, $id_pack, 4);
        $count_theory = [];
        $count_pratical = [];
        foreach ($schedule_online as $so) {
            if ($so['status'] == 2 || ($so['status'] == 3 && $so['date_update_cancel'] != NULL)) :
                if ($so['jenis'] == 1) {
                    $count_pratical[] = $so['id_schedule_pack'];
                }
                if ($so['jenis'] == 2) {
                    $count_theory[] = $so['id_schedule_pack'];
                }
            endif;
        }

        $pack_pratical = $pack_online[0]['total_pack_practical'];
        $pack_theory = $pack_online[0]['total_pack_theory'];
        $count1 = intval($pack_pratical) - intval(count($count_pratical));
        $count2 = intval($pack_theory) - intval(count($count_theory));
        $count3 = 0;
        foreach ($schedule_cancel as $sc) {
            if ($sc['date_update_cancel'] == NULL) {
                $count3++;
            }
        }
        if ($jenis == 1) :
            $temp_event[] = "Lesson Package : ";
            $temp_event[] = '<span class="badge badge-primary">' . round($count1 / 2) . ' package (' . $count1 . ' meeting)</span> ';
            $temp_event[] = '<input type="hidden" id="countPractical" name="countPractical" value="' . $count1 . '">';
        else :
            $temp_event[] = "Lesson Package : ";
            $temp_event[] = '<span class="badge badge-primary">' . $count2 . ' package (' . $count2 . ' meeting)</span> ';
            $temp_event[] = '<input type="hidden" id="countTheory" name="countTheory" value="' . $count2 . '">';
        endif;
        if ($count3 > 0) {
            $temp_event[] = "<br>";
            $temp_event[] = "Lesson Cancel = ";
            $temp_event[] = '<span class="badge badge-danger">' . $count3 . ' lesson</span>, Please change date!';
            // $temp_event[] = '<input type="hidden" id="countCancel" name="countCancel" value="' . $count3 . '">';
            $z = 1;
            // // $jenis1 = 0;
            // // $jenis2 = 0;
            // // $temp_event[] = "<br>";
            foreach ($schedule_cancel as $so) {
                if ($so['date_update_cancel'] == NULL) {
                    $temp_event[] = '<input type="hidden" id="id_schedule_pack' . $z++ . '" value="' . $so['id_schedule_pack'] . '">';
                }
            }
            // $temp_event[] = '<input type="hidden" id="countJenis1" name="countJenis1" value="' . $jenis1 . '">';
            // $temp_event[] = '<input type="hidden" id="countJenis2" name="countJenis2" value="' . $jenis2 . '">';
        }
        $temp_event[] = '<input type="hidden" id="countCancel" name="countCancel" value="' . $count3 . '">';

        $event_join = implode(" ", $temp_event);
        echo $event_join;
    }

    function tempDuluCek()
    {
        $no_sirkulasi_lesson = 'LESS/002/0011/1/195';
        $cek_sirkulasi = $this->M_Teacher->getData_sirkulasi_lesson(null, $no_sirkulasi_lesson, "200002", "1000011", 1);

        $get_data_50_next_periode = $this->M_Teacher->getData_sirkulasi_lesson_detail(null, null, "200002", "1000011", 1, null, 50, "2022-05-01");
        $cek_sirkulasi_next_periode = $this->M_Teacher->getData_sirkulasi_lesson(null, $get_data_50_next_periode[0]['no_sirkulasi_lesson'], "200002", "1000011", 1);

        $get_data_before_periode = $this->M_Teacher->getData_sirkulasi_lesson_detail_before("200002", "1000011", 1, "2022-04-26 00:00:00");
        $get_data_after_periode = $this->M_Teacher->getData_sirkulasi_lesson_detail_after("200002", "1000011", 1, "2022-04-26 00:00:00");

        echo count($get_data_before_periode);
        echo count($get_data_after_periode);

        echo (count($get_data_before_periode) + count($get_data_after_periode));

        if (count($cek_sirkulasi) > 0) {
            echo "wioo";
        }
        echo var_dump($cek_sirkulasi);
        echo "<br>";
        echo "<br>";
        echo var_dump($get_data_50_next_periode[0]);
        echo "<br>";
        echo "<br>";
        echo var_dump($cek_sirkulasi_next_periode);
    }

    function update_schedule_package()
    {
        $this->cekLogin();
        $status = $this->input->post('status');
        $id_list_pack = $this->input->post('id_list_pack');
        $jenis = $this->input->post('jenis');
        $is_new = $this->input->post('is_new');

        if ($status == 2) {
            $teacher_percentage = $this->input->post('teacher_percentage');
            $paket = $this->input->post('paket');
            $price = $this->input->post('price');
            $created_at = $this->input->post('tgl');
            $id_teacher = $this->input->post('id_teacher');
            $id_student = $this->input->post('id_student');
            $temp_id_student = substr($id_student, 3);
            $temp_id_teacher = substr($id_teacher, 3);
            $tipe = $jenis;
            $tipe_rate = '';
            $potongan = $this->input->post('potongan');
            $price_paket_theory = $this->input->post('price_paket_theory');
            $price_paket_pratical = $this->input->post('price_paket_pratical');

            //nomor sirkulasi lesson
            //LESS/002/015/1 => tipe online lesson
            //LESS/002/015/2 => tipe theory lesson

            $no_sirkulasi_lesson = 'LESS/' .  $temp_id_teacher . "/" . $temp_id_student . "/" . $tipe . "/" . $id_list_pack;
            $cek_sirkulasi = $this->M_Teacher->getData_sirkulasi_lesson(null, $no_sirkulasi_lesson, $id_teacher, $id_student, $tipe);

            $periode_now = substr($created_at, 0, 7);
            $effectiveDate = date($periode_now);
            $effectiveDate = date('Y-m', strtotime("+1 months", strtotime($effectiveDate)));
            $temp_period = $effectiveDate . "-01";
            //cek next periode
            $get_data_50_next_periode = $this->M_Teacher->getData_sirkulasi_lesson_detail(null, null, $id_teacher, $id_student, $tipe, null, 50, $temp_period);
            //cek before periode
            $get_data_before_periode = $this->M_Teacher->getData_sirkulasi_lesson_detail_before($id_teacher, $id_student, $tipe, $created_at);
            $get_data_after_periode = $this->M_Teacher->getData_sirkulasi_lesson_detail_after($id_teacher, $id_student, $tipe, $created_at);
            if (count($get_data_50_next_periode) > 0) {
                $cek_sirkulasi_next_periode = $this->M_Teacher->getData_sirkulasi_lesson(null, $get_data_50_next_periode[0]['no_sirkulasi_lesson'], $id_teacher, $id_student, $tipe);
            }

            if ($tipe == 1) {
                if ((count($get_data_before_periode) + count($get_data_after_periode)) >= ($potongan * 2)) {
                    if (count($cek_sirkulasi) > 0) {
                        $data_update_sirkulasi = null;
                        $total = $cek_sirkulasi[0]['total'];
                        $total_50 = $cek_sirkulasi[0]['total_50'];
                        $total_rate = $cek_sirkulasi[0]['total_rate'];

                        if (count($get_data_50_next_periode) > 0) {
                            $data = array(
                                'total_50' => $cek_sirkulasi_next_periode[0]['total_50'] - 1,
                                'total_rate' => $cek_sirkulasi_next_periode[0]['total_rate'] + 1,
                            );
                            $this->M_Teacher->updateDataSirkulasiLesson($data, $cek_sirkulasi_next_periode[0]['no_sirkulasi_lesson']);

                            if ($cek_sirkulasi[0]['created_at'] == NULL) {
                                $data_update_sirkulasi = array(
                                    'created_at' => $created_at,
                                    'last_updated_50' => $created_at,
                                    'total_50' => $total_50 + 1,
                                    'total' => $total + 1
                                );
                            } else {
                                $data_update_sirkulasi = array(
                                    'last_updated_50' => $created_at,
                                    'total_50' => $total_50 + 1,
                                    'total' => $total + 1
                                );
                            }
                        } else {
                            if ($cek_sirkulasi[0]['rate_created_at'] == NULL) {
                                $data_update_sirkulasi = array(
                                    'rate_created_at' => $created_at,
                                    'last_updated_rate' => $created_at,
                                    'total_rate' => $total_rate + 1,
                                    'total' => $total + 1
                                );
                            } else {
                                $data_update_sirkulasi = array(
                                    'last_updated_rate' => $created_at,
                                    'total_rate' => $total_rate + 1,
                                    'total' => $total + 1
                                );
                            }
                        }
                        $this->M_Teacher->updateDataSirkulasiLesson($data_update_sirkulasi, $no_sirkulasi_lesson);
                    } else {
                        if (count($get_data_50_next_periode) > 0) {
                            $data = array(
                                'total_50' => intval($cek_sirkulasi_next_periode[0]['total_50']) - 1,
                                'total_rate' => intval($cek_sirkulasi_next_periode[0]['total_rate']) + 1,
                                'rate_created_at' => $created_at,
                                'last_updated_rate' => $created_at,
                            );
                            $this->M_Teacher->updateDataSirkulasiLesson($data, $cek_sirkulasi_next_periode[0]['no_sirkulasi_lesson']);

                            $data_sirkulasi = array(
                                'no_sirkulasi_lesson' => $no_sirkulasi_lesson,
                                'id_student' => $id_student,
                                'id_teacher' => $id_teacher,
                                'id_list_pack' => $id_list_pack,
                                'tipe' => $tipe,
                                'rate' => $teacher_percentage,
                                'total_50' => 1,
                                'total_rate' => 0,
                                'total' => 1,
                                'created_at' => $created_at,
                                'last_updated_50' => $created_at,
                                'rate_created_at' => NULL,
                                'last_updated_rate' => NULL,
                            );
                        } else {
                            $data_sirkulasi = array(
                                'no_sirkulasi_lesson' => $no_sirkulasi_lesson,
                                'id_student' => $id_student,
                                'id_teacher' => $id_teacher,
                                'id_list_pack' => $id_list_pack,
                                'tipe' => $tipe,
                                'rate' => $teacher_percentage,
                                'total_50' => 0,
                                'total_rate' => 1,
                                'total' => 1,
                                'created_at' => NULL,
                                'last_updated_50' => NULL,
                                'rate_created_at' => $created_at,
                                'last_updated_rate' => $created_at,
                            );
                        }
                        $this->M_Teacher->addDataSirkulasiLesson($data_sirkulasi);
                    }
                    $tipe_rate = $teacher_percentage;
                } else {
                    if (count($cek_sirkulasi) > 0) {
                        $data_update_sirkulasi = null;

                        $total = $cek_sirkulasi[0]['total'];
                        $total_50 = $cek_sirkulasi[0]['total_50'];
                        $total_rate = $cek_sirkulasi[0]['total_rate'];

                        if ($total_50 >= ($potongan * 2)) {
                            if ($cek_sirkulasi[0]['rate_created_at'] == NULL) {
                                $data_update_sirkulasi = array(
                                    'rate_created_at' => $created_at,
                                    'last_updated_rate' => $created_at,
                                    'total_rate' => $total_rate + 1,
                                    'total' => $total + 1
                                );
                            } else {
                                $data_update_sirkulasi = array(
                                    'last_updated_rate' => $created_at,
                                    'total_rate' => $total_rate + 1,
                                    'total' => $total + 1
                                );
                            }
                            $tipe_rate = $teacher_percentage;
                        } else {
                            $data_update_sirkulasi = array(
                                'last_updated_50' => $created_at,
                                'total_50' => $total_50 + 1,
                                'total' => $total + 1
                            );
                            if ($is_new == 2) {
                                $tipe_rate = $teacher_percentage;
                            } else {
                                $tipe_rate = 50;
                            }
                        }
                        $this->M_Teacher->updateDataSirkulasiLesson($data_update_sirkulasi, $no_sirkulasi_lesson);
                    } else {
                        $data_sirkulasi = array(
                            'no_sirkulasi_lesson' => $no_sirkulasi_lesson,
                            'id_student' => $id_student,
                            'id_teacher' => $id_teacher,
                            'id_list_pack' => $id_list_pack,
                            'tipe' => $tipe,
                            'rate' => $teacher_percentage,
                            'total_50' => 1,
                            'total_rate' => 0,
                            'total' => 1,
                            'created_at' => $created_at,
                            'last_updated_50' => $created_at,
                        );
                        $this->M_Teacher->addDataSirkulasiLesson($data_sirkulasi);
                        $tipe_rate = 50;
                    }
                }
            }

            if ($tipe == 2) {
                if ((count($get_data_before_periode) + count($get_data_after_periode)) >= $potongan) {
                    if (count($cek_sirkulasi) > 0) {
                        $data_update_sirkulasi = null;
                        $total = $cek_sirkulasi[0]['total'];
                        $total_50 = $cek_sirkulasi[0]['total_50'];
                        $total_rate = $cek_sirkulasi[0]['total_rate'];

                        if (count($get_data_50_next_periode) > 0) {
                            $data = array(
                                'total_50' => $cek_sirkulasi_next_periode[0]['total_50'] - 1,
                                'total_rate' => $cek_sirkulasi_next_periode[0]['total_rate'] + 1,
                            );
                            $this->M_Teacher->updateDataSirkulasiLesson($data, $cek_sirkulasi_next_periode[0]['no_sirkulasi_lesson']);
                            if ($cek_sirkulasi[0]['created_at'] == NULL) {
                                $data_update_sirkulasi = array(
                                    'created_at' => $created_at,
                                    'last_updated_50' => $created_at,
                                    'total_50' => $total_50 + 1,
                                    'total' => $total + 1
                                );
                            } else {
                                $data_update_sirkulasi = array(
                                    'last_updated_50' => $created_at,
                                    'total_50' => $total_50 + 1,
                                    'total' => $total + 1
                                );
                            }
                        } else {
                            if ($cek_sirkulasi[0]['rate_created_at'] == NULL) {
                                $data_update_sirkulasi = array(
                                    'rate_created_at' => $created_at,
                                    'last_updated_rate' => $created_at,
                                    'total_rate' => $total_rate + 1,
                                    'total' => $total + 1
                                );
                            } else {
                                $data_update_sirkulasi = array(
                                    'last_updated_rate' => $created_at,
                                    'total_rate' => $total_rate + 1,
                                    'total' => $total + 1
                                );
                            }
                        }
                        $this->M_Teacher->updateDataSirkulasiLesson($data_update_sirkulasi, $no_sirkulasi_lesson);
                    } else {
                        if (count($get_data_50_next_periode) > 0) {
                            $data = array(
                                'total_50' => intval($cek_sirkulasi_next_periode[0]['total_50']) - 1,
                                'total_rate' => intval($cek_sirkulasi_next_periode[0]['total_rate']) + 1,
                                'rate_created_at' => $created_at,
                                'last_updated_rate' => $created_at,
                            );
                            $this->M_Teacher->updateDataSirkulasiLesson($data, $cek_sirkulasi_next_periode[0]['no_sirkulasi_lesson']);
                            $data_sirkulasi = array(
                                'no_sirkulasi_lesson' => $no_sirkulasi_lesson,
                                'id_student' => $id_student,
                                'id_teacher' => $id_teacher,
                                'id_list_pack' => $id_list_pack,
                                'tipe' => $tipe,
                                'rate' => $teacher_percentage,
                                'total_50' => 1,
                                'total_rate' => 0,
                                'total' => 1,
                                'created_at' => $created_at,
                                'last_updated_50' => $created_at,
                                'rate_created_at' => NULL,
                                'last_updated_rate' => NULL,
                            );
                        } else {
                            $data_sirkulasi = array(
                                'no_sirkulasi_lesson' => $no_sirkulasi_lesson,
                                'id_student' => $id_student,
                                'id_teacher' => $id_teacher,
                                'id_list_pack' => $id_list_pack,
                                'tipe' => $tipe,
                                'rate' => $teacher_percentage,
                                'total_50' => 0,
                                'total_rate' => 1,
                                'total' => 1,
                                'created_at' => NULL,
                                'last_updated_50' => NULL,
                                'rate_created_at' => $created_at,
                                'last_updated_rate' => $created_at,
                            );
                        }
                        $this->M_Teacher->addDataSirkulasiLesson($data_sirkulasi);
                    }
                    $tipe_rate = $teacher_percentage;
                } else {
                    if (count($cek_sirkulasi) > 0) {
                        $data_update_sirkulasi = null;

                        $total = $cek_sirkulasi[0]['total'];
                        $total_50 = $cek_sirkulasi[0]['total_50'];
                        $total_rate = $cek_sirkulasi[0]['total_rate'];

                        if ($total_50 >= $potongan) {
                            if ($cek_sirkulasi[0]['rate_created_at'] == NULL) {
                                $data_update_sirkulasi = array(
                                    'rate_created_at' => $created_at,
                                    'last_updated_rate' => $created_at,
                                    'total_rate' => $total_rate + 1,
                                    'total' => $total + 1
                                );
                            } else {
                                $data_update_sirkulasi = array(
                                    'last_updated_rate' => $created_at,
                                    'total_rate' => $total_rate + 1,
                                    'total' => $total + 1
                                );
                            }
                            $tipe_rate = $teacher_percentage;
                        } else {
                            $data_update_sirkulasi = array(
                                'last_updated_50' => $created_at,
                                'total_50' => $total_50 + 1,
                                'total' => $total + 1
                            );
                            if ($is_new == 2) {
                                $tipe_rate = $teacher_percentage;
                            } else {
                                $tipe_rate = 50;
                            }
                        }
                        $this->M_Teacher->updateDataSirkulasiLesson($data_update_sirkulasi, $no_sirkulasi_lesson);
                    } else {
                        $data_sirkulasi = array(
                            'no_sirkulasi_lesson' => $no_sirkulasi_lesson,
                            'id_student' => $id_student,
                            'id_teacher' => $id_teacher,
                            'id_list_pack' => $id_list_pack,
                            'tipe' => $tipe,
                            'rate' => $teacher_percentage,
                            'total_50' => 1,
                            'total_rate' => 0,
                            'total' => 1,
                            'created_at' => $created_at,
                            'last_updated_50' => $created_at,
                        );
                        $this->M_Teacher->addDataSirkulasiLesson($data_sirkulasi);
                        $tipe_rate = 50;
                    }
                }
            }

            if ($tipe_rate != 50) {
                if (count($get_data_50_next_periode) > 0) {
                    $tipe_rate = 50;
                    $price_next_periode_temp = 0;
                    if ($tipe == 1) {
                        $price_next_periode_temp = $price_paket_pratical / 2;
                        // if ($get_data_50_next_periode[0]['status_pack_theory'] == 1) {
                        //     $price_next_periode_temp = (($get_data_50_next_periode[0]['price_idr'] - 100000) / 2);
                        // }
                    }
                    if ($tipe == 2) {
                        $price_next_periode_temp = $price_paket_theory;
                        // if ($get_data_50_next_periode[0]['status_pack_practical'] == 1) {
                        //     $price_next_periode_temp = 100000;
                        // }
                    }
                    $data = array(
                        'rate' => $teacher_percentage,
                        'price' => $price_next_periode_temp * $teacher_percentage / 100,
                    );
                    $this->M_Teacher->updateDataSirkulasiLessonDetail($data, $get_data_50_next_periode[0]['id_sirkulasi_lesson_detail']);
                } else {
                    $tipe_rate = $teacher_percentage;
                }
            }

            $price_temp_sirkulasi_detail = 0;
            if ($tipe == 1) {
                $price_temp_sirkulasi_detail = ($price_paket_pratical / 2) * $tipe_rate / 100;
            }
            if ($tipe == 2) {
                $price_temp_sirkulasi_detail = $price_paket_theory * $tipe_rate / 100;
            }

            $data_sirkulasi_lesson_detail = array(
                'no_sirkulasi_lesson' => $no_sirkulasi_lesson,
                'id_student' => $id_student,
                'id_teacher' => $id_teacher,
                'id_list_pack' => $id_list_pack,
                'lesson_date' => $created_at,
                'tipe' => $tipe,
                'rate' => $tipe_rate,
                'price' => $price_temp_sirkulasi_detail,
                'paket' => $paket,
            );
            $this->M_Teacher->addDataSirkulasiLessonDetail($data_sirkulasi_lesson_detail);

            //nomor feereport 
            //FER/210629/004
            $startdate = strtotime($created_at);
            $temp_date_sirkulasi =  date("Ym", $startdate);
            $no_sirkulasi_feereport = "FER/" . $temp_date_sirkulasi . "/" . $temp_id_teacher . "/001";
            $data_sirkulasi_feereport = $this->M_Teacher->getData_sirkulasi_feereport(null, $no_sirkulasi_feereport);
            $data_sirkulasi_feereport_detail = $this->M_Teacher->getData_sirkulasi_feereport_detail(null, $no_sirkulasi_feereport, $tipe, $no_sirkulasi_lesson);

            $data_sirkulasi_feereport_next_periode = $this->M_Teacher->getData_sirkulasi_feereport(null, null, 0, $id_teacher, $effectiveDate);

            if ($tipe == 1) {
                if ((count($get_data_before_periode) + count($get_data_after_periode)) >= ($potongan * 2)) {
                    if (count($get_data_50_next_periode) > 0) {
                        $price_next_periode = $price_paket_pratical / 2;
                        $sirkulasi_detail_after = $this->M_Teacher->getData_sirkulasi_feereport_detail(null, $data_sirkulasi_feereport_next_periode[0]["no_sirkulasi_feereport"], $tipe, $cek_sirkulasi_next_periode[0]['no_sirkulasi_lesson']);
                        $price_temp_feereport_detail = $sirkulasi_detail_after[0]['price'] / 2;
                        $data = array(
                            'price' => $price_temp_feereport_detail - ($price_next_periode * 50 / 100) + ($price_next_periode * $teacher_percentage / 100),
                        );
                        $this->db->update('sirkulasi_feereport_detail', $data, ['id' => $sirkulasi_detail_after[0]['id']]);

                        $discount = (intval($data_sirkulasi_feereport_next_periode[0]['price']) - ($price_next_periode * 50 / 100) + ($price_next_periode * $teacher_percentage / 100)) * intval($data_sirkulasi_feereport_next_periode[0]['discount']) / 100;
                        $price_temp_feereport = intval($data_sirkulasi_feereport_next_periode[0]['price']) - ($price_next_periode * 50 / 100) + ($price_next_periode * $teacher_percentage / 100);
                        $data2 =  [
                            'price' => $price_temp_feereport,
                            'total_price' => $price_temp_feereport - $discount,
                            'updated_at' => $created_at,
                        ];
                        $this->db->update('sirkulasi_feereport', $data2, ['id_sirkulasi_feereport' => $data_sirkulasi_feereport_next_periode[0]['id_sirkulasi_feereport']]);
                    }
                }
            }
            if ($tipe == 2) {
                if ((count($get_data_before_periode) + count($get_data_after_periode)) >= $potongan) {
                    if (count($get_data_50_next_periode) > 0) {
                        $price_next_periode = $price_paket_theory;
                        $sirkulasi_detail_after = $this->M_Teacher->getData_sirkulasi_feereport_detail(null, $data_sirkulasi_feereport_next_periode[0]["no_sirkulasi_feereport"], $tipe, $cek_sirkulasi_next_periode[0]['no_sirkulasi_lesson']);
                        $data = array(
                            'price' => $sirkulasi_detail_after[0]['price'] - ($price_next_periode * 50 / 100) + ($price_next_periode * $teacher_percentage / 100),
                        );
                        $this->db->update('sirkulasi_feereport_detail', $data, ['id' => $sirkulasi_detail_after[0]['id']]);

                        $discount = (intval($data_sirkulasi_feereport_next_periode[0]['price']) - ($price_next_periode * 50 / 100) + ($price_next_periode * $teacher_percentage / 100)) * intval($data_sirkulasi_feereport_next_periode[0]['discount']) / 100;
                        $price_temp_feereport = intval($data_sirkulasi_feereport_next_periode[0]['price']) - ($price_next_periode * 50 / 100) + ($price_next_periode * $teacher_percentage / 100);
                        $data2 =  [
                            'price' => $price_temp_feereport,
                            'total_price' => $price_temp_feereport - $discount,
                            'updated_at' => $created_at,
                        ];
                        $this->db->update('sirkulasi_feereport', $data2, ['id_sirkulasi_feereport' => $data_sirkulasi_feereport_next_periode[0]['id_sirkulasi_feereport']]);
                    }
                }
            }

            $data2 = [];
            $data3 = [];
            $price = 0;
            if ($tipe == 1) {
                $price = ($price_paket_pratical / 2) * $tipe_rate / 100;
            }
            if ($tipe == 2) {
                $price = $price_paket_theory * $tipe_rate / 100;
            }

            if (count($data_sirkulasi_feereport) == 0) {
                $data2 =  [
                    'no_sirkulasi_feereport' => $no_sirkulasi_feereport,
                    'id_teacher' => $this->input->post('id_teacher'),
                    'created_at' => $created_at,
                    'updated_at' => $created_at,
                    'price' => $price,
                    'total_price' => $price,
                ];
                $data3 = [
                    'no_sirkulasi_feereport' => $no_sirkulasi_feereport,
                    'id_teacher' => $this->input->post('id_teacher'),
                    'id_barang' => $no_sirkulasi_lesson,
                    'tipe' => $tipe,
                    'price' => $price,
                ];
                $this->db->insert('sirkulasi_feereport', $data2);
                $this->db->insert('sirkulasi_feereport_detail', $data3);
            } else {
                if ($data_sirkulasi_feereport[0]['status_approved'] == 0) {
                    $discount = (intval($data_sirkulasi_feereport[0]['price']) + intval($price)) * intval($data_sirkulasi_feereport[0]['discount']) / 100;
                    $data2 =  [
                        'price' => intval($data_sirkulasi_feereport[0]['price']) + intval($price),
                        'total_price' => intval($data_sirkulasi_feereport[0]['price']) + intval($price) - $discount,
                        'updated_at' => $created_at,
                    ];
                    $this->db->update('sirkulasi_feereport', $data2, ['id_sirkulasi_feereport' => $data_sirkulasi_feereport[0]['id_sirkulasi_feereport']]);

                    if (count($data_sirkulasi_feereport_detail) == 0) {
                        $data3 = [
                            'no_sirkulasi_feereport' => $data_sirkulasi_feereport[0]['no_sirkulasi_feereport'],
                            'id_teacher' => $this->input->post('id_teacher'),
                            'id_barang' => $no_sirkulasi_lesson,
                            'tipe' => $tipe,
                            'price' => $price,
                        ];
                        $this->db->insert('sirkulasi_feereport_detail', $data3);
                    } else {
                        $data3 = [
                            'price' => intval($data_sirkulasi_feereport_detail[0]['price']) + intval($price),
                        ];
                        $this->db->update('sirkulasi_feereport_detail', $data3, ['id' => $data_sirkulasi_feereport_detail[0]['id']]);
                    }
                }
            }
        }

        $data = array(
            'status' => $this->input->post('status'),
        );
        $data2 = $this->M_Teacher->update_event_schedule_package($data, $this->input->post('id_schedule_online'));

        $pack_online = $this->M_Teacher->getData_pack_online($id_list_pack, 1);
        $schedule_online = $this->M_Teacher->getData_schedule_package(null, $id_list_pack);
        $schedule_cancel = $this->M_Teacher->getData_schedule_package(null, $id_list_pack, 3, null, $jenis);
        $schedule_new = $this->M_Teacher->getData_schedule_package(null, $id_list_pack, 4);
        $count_theory = [];
        $count_pratical = [];
        foreach ($schedule_online as $so) {
            if ($so['status'] == 2 || ($so['status'] == 3 && $so['date_update_cancel'] != NULL)) :
                if ($so['jenis'] == 1) {
                    $count_pratical[] = $so['id_schedule_pack'];
                }
                if ($so['jenis'] == 2) {
                    $count_theory[] = $so['id_schedule_pack'];
                }
            endif;
        }

        $pack_pratical = $pack_online[0]['total_pack_practical'];
        $pack_theory = $pack_online[0]['total_pack_theory'];
        $count1 = intval($pack_pratical) - intval(count($count_pratical));
        $count2 = intval($pack_theory) - intval(count($count_theory));
        $count3 = 0;
        foreach ($schedule_cancel as $sc) {
            if ($sc['date_update_cancel'] == NULL) {
                $count3++;
            }
        }
        if ($jenis == 1) :
            $temp_event[] = "Lesson Package : ";
            $temp_event[] = '<span class="badge badge-primary">' . round($count1 / 2) . ' package (' . $count1 . ' meeting)</span> ';
            $temp_event[] = '<input type="hidden" id="countPractical" name="countPractical" value="' . $count1 . '">';
        else :
            $temp_event[] = "Lesson Package : ";
            $temp_event[] = '<span class="badge badge-primary">' . $count2 . ' package (' . $count2 . ' meeting)</span> ';
            $temp_event[] = '<input type="hidden" id="countTheory" name="countTheory" value="' . $count2 . '">';
        endif;
        if ($count3 > 0) {
            $temp_event[] = "<br>";
            $temp_event[] = "Lesson Cancel = ";
            $temp_event[] = '<span class="badge badge-danger">' . $count3 . ' lesson</span>, Please change date!';
        }
        $temp_event[] = '<input type="hidden" id="countCancel" name="countCancel" value="' . $count3 . '">';

        $event_join = implode(" ", $temp_event);
        echo $event_join;
    }

    function reschedule_package()
    {
        $this->cekLogin();

        $created_at = $this->input->post('date_update_cancel');
        $id_teacher = $this->input->post('id_teacher');
        $id_student = $this->input->post('id_student');
        $id_list_pack = $this->input->post('id_list_pack');
        $paket = $this->input->post('paket');
        $price = $this->input->post('price');
        $jenis = $this->input->post('jenis');
        $teacher_percentage = $this->input->post('teacher_percentage');
        $temp_id_student = substr($id_student, 3);
        $temp_id_teacher = substr($id_teacher, 3);
        $tipe = $jenis;
        $tipe_rate = '';
        $is_new = $this->input->post('is_new');
        $potongan = $this->input->post('potongan');
        $price_paket_theory = $this->input->post('price_paket_theory');
        $price_paket_pratical = $this->input->post('price_paket_pratical');

        //cek total id_student -> <- id_teacher
        //nomor sirkulasi lesson
        //LESS/002/015/1 => tipe online lesson
        $no_sirkulasi_lesson = 'LESS/' .  $temp_id_teacher . "/" . $temp_id_student . "/" . $tipe . "/" . $id_list_pack;
        $cek_sirkulasi = $this->M_Teacher->getData_sirkulasi_lesson(null, $no_sirkulasi_lesson, $id_teacher, $id_student, $tipe);

        $periode_now = substr($created_at, 0, 7);
        $effectiveDate = date($periode_now);
        $effectiveDate = date('Y-m', strtotime("+1 months", strtotime($effectiveDate)));
        $temp_period = $effectiveDate . "-01";
        //cek next periode
        $get_data_50_next_periode = $this->M_Teacher->getData_sirkulasi_lesson_detail(null, null, $id_teacher, $id_student, $tipe, null, 50, $temp_period);
        //cek before periode
        $get_data_before_periode = $this->M_Teacher->getData_sirkulasi_lesson_detail_before($id_teacher, $id_student, $tipe, $created_at);
        $get_data_after_periode = $this->M_Teacher->getData_sirkulasi_lesson_detail_after($id_teacher, $id_student, $tipe, $created_at);
        if (count($get_data_50_next_periode) > 0) {
            $cek_sirkulasi_next_periode = $this->M_Teacher->getData_sirkulasi_lesson(null, $get_data_50_next_periode[0]['no_sirkulasi_lesson'], $id_teacher, $id_student, $tipe);
        }

        if ($tipe == 1) {
            if ((count($get_data_before_periode) + count($get_data_after_periode)) >= ($potongan * 2)) {
                if (count($cek_sirkulasi) > 0) {
                    $data_update_sirkulasi = null;
                    $total = $cek_sirkulasi[0]['total'];
                    $total_50 = $cek_sirkulasi[0]['total_50'];
                    $total_rate = $cek_sirkulasi[0]['total_rate'];

                    if (count($get_data_50_next_periode) > 0) {
                        $data = array(
                            'total_50' => $cek_sirkulasi_next_periode[0]['total_50'] - 1,
                            'total_rate' => $cek_sirkulasi_next_periode[0]['total_rate'] + 1,
                        );
                        $this->M_Teacher->updateDataSirkulasiLesson($data, $cek_sirkulasi_next_periode[0]['no_sirkulasi_lesson']);

                        if ($cek_sirkulasi[0]['created_at'] == NULL) {
                            $data_update_sirkulasi = array(
                                'created_at' => $created_at,
                                'last_updated_50' => $created_at,
                                'total_50' => $total_50 + 1,
                                'total' => $total + 1
                            );
                        } else {
                            $data_update_sirkulasi = array(
                                'last_updated_50' => $created_at,
                                'total_50' => $total_50 + 1,
                                'total' => $total + 1
                            );
                        }
                    } else {
                        if ($cek_sirkulasi[0]['rate_created_at'] == NULL) {
                            $data_update_sirkulasi = array(
                                'rate_created_at' => $created_at,
                                'last_updated_rate' => $created_at,
                                'total_rate' => $total_rate + 1,
                                'total' => $total + 1
                            );
                        } else {
                            $data_update_sirkulasi = array(
                                'last_updated_rate' => $created_at,
                                'total_rate' => $total_rate + 1,
                                'total' => $total + 1
                            );
                        }
                    }
                    $this->M_Teacher->updateDataSirkulasiLesson($data_update_sirkulasi, $no_sirkulasi_lesson);
                } else {
                    if (count($get_data_50_next_periode) > 0) {
                        $data = array(
                            'total_50' => intval($cek_sirkulasi_next_periode[0]['total_50']) - 1,
                            'total_rate' => intval($cek_sirkulasi_next_periode[0]['total_rate']) + 1,
                            'rate_created_at' => $created_at,
                            'last_updated_rate' => $created_at,
                        );
                        $this->M_Teacher->updateDataSirkulasiLesson($data, $cek_sirkulasi_next_periode[0]['no_sirkulasi_lesson']);

                        $data_sirkulasi = array(
                            'no_sirkulasi_lesson' => $no_sirkulasi_lesson,
                            'id_student' => $id_student,
                            'id_teacher' => $id_teacher,
                            'id_list_pack' => $id_list_pack,
                            'tipe' => $tipe,
                            'rate' => $teacher_percentage,
                            'total_50' => 1,
                            'total_rate' => 0,
                            'total' => 1,
                            'created_at' => $created_at,
                            'last_updated_50' => $created_at,
                            'rate_created_at' => NULL,
                            'last_updated_rate' => NULL,
                        );
                    } else {
                        $data_sirkulasi = array(
                            'no_sirkulasi_lesson' => $no_sirkulasi_lesson,
                            'id_student' => $id_student,
                            'id_teacher' => $id_teacher,
                            'id_list_pack' => $id_list_pack,
                            'tipe' => $tipe,
                            'rate' => $teacher_percentage,
                            'total_50' => 0,
                            'total_rate' => 1,
                            'total' => 1,
                            'created_at' => NULL,
                            'last_updated_50' => NULL,
                            'rate_created_at' => $created_at,
                            'last_updated_rate' => $created_at,
                        );
                    }
                    $this->M_Teacher->addDataSirkulasiLesson($data_sirkulasi);
                }
                $tipe_rate = $teacher_percentage;
            } else {
                if (count($cek_sirkulasi) > 0) {
                    $data_update_sirkulasi = null;

                    $total = $cek_sirkulasi[0]['total'];
                    $total_50 = $cek_sirkulasi[0]['total_50'];
                    $total_rate = $cek_sirkulasi[0]['total_rate'];

                    if ($total_50 >= ($potongan * 2)) {
                        if ($cek_sirkulasi[0]['rate_created_at'] == NULL) {
                            $data_update_sirkulasi = array(
                                'rate_created_at' => $created_at,
                                'last_updated_rate' => $created_at,
                                'total_rate' => $total_rate + 1,
                                'total' => $total + 1
                            );
                        } else {
                            $data_update_sirkulasi = array(
                                'last_updated_rate' => $created_at,
                                'total_rate' => $total_rate + 1,
                                'total' => $total + 1
                            );
                        }
                        $tipe_rate = $teacher_percentage;
                    } else {
                        $data_update_sirkulasi = array(
                            'last_updated_50' => $created_at,
                            'total_50' => $total_50 + 1,
                            'total' => $total + 1
                        );
                        if ($is_new == 2) {
                            $tipe_rate = $teacher_percentage;
                        } else {
                            $tipe_rate = 50;
                        }
                    }
                    $this->M_Teacher->updateDataSirkulasiLesson($data_update_sirkulasi, $no_sirkulasi_lesson);
                } else {
                    $data_sirkulasi = array(
                        'no_sirkulasi_lesson' => $no_sirkulasi_lesson,
                        'id_student' => $id_student,
                        'id_teacher' => $id_teacher,
                        'id_list_pack' => $id_list_pack,
                        'tipe' => $tipe,
                        'rate' => $teacher_percentage,
                        'total_50' => 1,
                        'total_rate' => 0,
                        'total' => 1,
                        'created_at' => $created_at,
                        'last_updated_50' => $created_at,
                    );
                    $this->M_Teacher->addDataSirkulasiLesson($data_sirkulasi);
                    $tipe_rate = 50;
                }
            }
        }

        if ($tipe == 2) {
            if ((count($get_data_before_periode) + count($get_data_after_periode)) >= $potongan) {
                if (count($cek_sirkulasi) > 0) {
                    $data_update_sirkulasi = null;
                    $total = $cek_sirkulasi[0]['total'];
                    $total_50 = $cek_sirkulasi[0]['total_50'];
                    $total_rate = $cek_sirkulasi[0]['total_rate'];

                    if (count($get_data_50_next_periode) > 0) {
                        $data = array(
                            'total_50' => $cek_sirkulasi_next_periode[0]['total_50'] - 1,
                            'total_rate' => $cek_sirkulasi_next_periode[0]['total_rate'] + 1,
                        );
                        $this->M_Teacher->updateDataSirkulasiLesson($data, $cek_sirkulasi_next_periode[0]['no_sirkulasi_lesson']);
                        if ($cek_sirkulasi[0]['created_at'] == NULL) {
                            $data_update_sirkulasi = array(
                                'created_at' => $created_at,
                                'last_updated_50' => $created_at,
                                'total_50' => $total_50 + 1,
                                'total' => $total + 1
                            );
                        } else {
                            $data_update_sirkulasi = array(
                                'last_updated_50' => $created_at,
                                'total_50' => $total_50 + 1,
                                'total' => $total + 1
                            );
                        }
                    } else {
                        if ($cek_sirkulasi[0]['rate_created_at'] == NULL) {
                            $data_update_sirkulasi = array(
                                'rate_created_at' => $created_at,
                                'last_updated_rate' => $created_at,
                                'total_rate' => $total_rate + 1,
                                'total' => $total + 1
                            );
                        } else {
                            $data_update_sirkulasi = array(
                                'last_updated_rate' => $created_at,
                                'total_rate' => $total_rate + 1,
                                'total' => $total + 1
                            );
                        }
                    }
                    $this->M_Teacher->updateDataSirkulasiLesson($data_update_sirkulasi, $no_sirkulasi_lesson);
                } else {
                    if (count($get_data_50_next_periode) > 0) {
                        $data = array(
                            'total_50' => intval($cek_sirkulasi_next_periode[0]['total_50']) - 1,
                            'total_rate' => intval($cek_sirkulasi_next_periode[0]['total_rate']) + 1,
                            'rate_created_at' => $created_at,
                            'last_updated_rate' => $created_at,
                        );
                        $this->M_Teacher->updateDataSirkulasiLesson($data, $cek_sirkulasi_next_periode[0]['no_sirkulasi_lesson']);
                        $data_sirkulasi = array(
                            'no_sirkulasi_lesson' => $no_sirkulasi_lesson,
                            'id_student' => $id_student,
                            'id_teacher' => $id_teacher,
                            'id_list_pack' => $id_list_pack,
                            'tipe' => $tipe,
                            'rate' => $teacher_percentage,
                            'total_50' => 1,
                            'total_rate' => 0,
                            'total' => 1,
                            'created_at' => $created_at,
                            'last_updated_50' => $created_at,
                            'rate_created_at' => NULL,
                            'last_updated_rate' => NULL,
                        );
                    } else {
                        $data_sirkulasi = array(
                            'no_sirkulasi_lesson' => $no_sirkulasi_lesson,
                            'id_student' => $id_student,
                            'id_teacher' => $id_teacher,
                            'id_list_pack' => $id_list_pack,
                            'tipe' => $tipe,
                            'rate' => $teacher_percentage,
                            'total_50' => 0,
                            'total_rate' => 1,
                            'total' => 1,
                            'created_at' => NULL,
                            'last_updated_50' => NULL,
                            'rate_created_at' => $created_at,
                            'last_updated_rate' => $created_at,
                        );
                    }
                    $this->M_Teacher->addDataSirkulasiLesson($data_sirkulasi);
                }
                $tipe_rate = $teacher_percentage;
            } else {
                if (count($cek_sirkulasi) > 0) {
                    $data_update_sirkulasi = null;

                    $total = $cek_sirkulasi[0]['total'];
                    $total_50 = $cek_sirkulasi[0]['total_50'];
                    $total_rate = $cek_sirkulasi[0]['total_rate'];

                    if ($total_50 >= $potongan) {
                        if ($cek_sirkulasi[0]['rate_created_at'] == NULL) {
                            $data_update_sirkulasi = array(
                                'rate_created_at' => $created_at,
                                'last_updated_rate' => $created_at,
                                'total_rate' => $total_rate + 1,
                                'total' => $total + 1
                            );
                        } else {
                            $data_update_sirkulasi = array(
                                'last_updated_rate' => $created_at,
                                'total_rate' => $total_rate + 1,
                                'total' => $total + 1
                            );
                        }
                        $tipe_rate = $teacher_percentage;
                    } else {
                        $data_update_sirkulasi = array(
                            'last_updated_50' => $created_at,
                            'total_50' => $total_50 + 1,
                            'total' => $total + 1
                        );
                        if ($is_new == 2) {
                            $tipe_rate = $teacher_percentage;
                        } else {
                            $tipe_rate = 50;
                        }
                    }
                    $this->M_Teacher->updateDataSirkulasiLesson($data_update_sirkulasi, $no_sirkulasi_lesson);
                } else {
                    $data_sirkulasi = array(
                        'no_sirkulasi_lesson' => $no_sirkulasi_lesson,
                        'id_student' => $id_student,
                        'id_teacher' => $id_teacher,
                        'id_list_pack' => $id_list_pack,
                        'tipe' => $tipe,
                        'rate' => $teacher_percentage,
                        'total_50' => 1,
                        'total_rate' => 0,
                        'total' => 1,
                        'created_at' => $created_at,
                        'last_updated_50' => $created_at,
                    );
                    $this->M_Teacher->addDataSirkulasiLesson($data_sirkulasi);
                    $tipe_rate = 50;
                }
            }
        }

        if ($tipe_rate != 50) {
            if (count($get_data_50_next_periode) > 0) {
                $tipe_rate = 50;
                $price_next_periode_temp = 0;
                if ($tipe == 1) {
                    $price_next_periode_temp = $price_paket_pratical / 2;
                    // if ($get_data_50_next_periode[0]['status_pack_theory'] == 1) {
                    //     $price_next_periode_temp = (($get_data_50_next_periode[0]['price_idr'] - 100000) / 2);
                    // }
                }
                if ($tipe == 2) {
                    $price_next_periode_temp = $price_paket_theory;
                    // if ($get_data_50_next_periode[0]['status_pack_practical'] == 1) {
                    //     $price_next_periode_temp = 100000;
                    // }
                }
                $data = array(
                    'rate' => $teacher_percentage,
                    'price' => $price_next_periode_temp * $teacher_percentage / 100,
                );
                $this->M_Teacher->updateDataSirkulasiLessonDetail($data, $get_data_50_next_periode[0]['id_sirkulasi_lesson_detail']);
            } else {
                $tipe_rate = $teacher_percentage;
            }
        }

        $price_temp_sirkulasi_detail = 0;
        if ($tipe == 1) {
            $price_temp_sirkulasi_detail = ($price_paket_pratical / 2) * $tipe_rate / 100;
        }
        if ($tipe == 2) {
            $price_temp_sirkulasi_detail = $price_paket_theory * $tipe_rate / 100;
        }

        $data_sirkulasi_lesson_detail = array(
            'no_sirkulasi_lesson' => $no_sirkulasi_lesson,
            'id_student' => $id_student,
            'id_teacher' => $id_teacher,
            'id_list_pack' => $id_list_pack,
            'lesson_date' => $created_at,
            'tipe' => $tipe,
            'rate' => $tipe_rate,
            'price' => $price_temp_sirkulasi_detail,
            'paket' => $paket,
        );
        $this->M_Teacher->addDataSirkulasiLessonDetail($data_sirkulasi_lesson_detail);

        //nomor feereport 
        //FER/210629/004
        $startdate = strtotime($created_at);
        $temp_date_sirkulasi =  date("Ym", $startdate);
        $no_sirkulasi_feereport = "FER/" . $temp_date_sirkulasi . "/" . $temp_id_teacher . "/001";
        $data_sirkulasi_feereport = $this->M_Teacher->getData_sirkulasi_feereport(null, $no_sirkulasi_feereport);
        $data_sirkulasi_feereport_detail = $this->M_Teacher->getData_sirkulasi_feereport_detail(null, $no_sirkulasi_feereport, $tipe, $no_sirkulasi_lesson);

        $data_sirkulasi_feereport_next_periode = $this->M_Teacher->getData_sirkulasi_feereport(null, null, 0, $id_teacher, $effectiveDate);

        if ($tipe == 1) {
            if ((count($get_data_before_periode) + count($get_data_after_periode)) >= ($potongan * 2)) {
                if (count($get_data_50_next_periode) > 0) {
                    $price_next_periode = $price_paket_pratical / 2;
                    $sirkulasi_detail_after = $this->M_Teacher->getData_sirkulasi_feereport_detail(null, $data_sirkulasi_feereport_next_periode[0]["no_sirkulasi_feereport"], $tipe, $cek_sirkulasi_next_periode[0]['no_sirkulasi_lesson']);
                    $price_temp_feereport_detail = $sirkulasi_detail_after[0]['price'] / 2;
                    $data = array(
                        'price' => $price_temp_feereport_detail - ($price_next_periode * 50 / 100) + ($price_next_periode * $teacher_percentage / 100),
                    );
                    $this->db->update('sirkulasi_feereport_detail', $data, ['id' => $sirkulasi_detail_after[0]['id']]);

                    $discount = (intval($data_sirkulasi_feereport_next_periode[0]['price']) - ($price_next_periode * 50 / 100) + ($price_next_periode * $teacher_percentage / 100)) * intval($data_sirkulasi_feereport_next_periode[0]['discount']) / 100;
                    $price_temp_feereport = intval($data_sirkulasi_feereport_next_periode[0]['price']) - ($price_next_periode * 50 / 100) + ($price_next_periode * $teacher_percentage / 100);
                    $data2 =  [
                        'price' => $price_temp_feereport,
                        'total_price' => $price_temp_feereport - $discount,
                        'updated_at' => $created_at,
                    ];
                    $this->db->update('sirkulasi_feereport', $data2, ['id_sirkulasi_feereport' => $data_sirkulasi_feereport_next_periode[0]['id_sirkulasi_feereport']]);
                }
            }
        }
        if ($tipe == 2) {
            if ((count($get_data_before_periode) + count($get_data_after_periode)) >= $potongan) {
                if (count($get_data_50_next_periode) > 0) {
                    $price_next_periode = $price_paket_theory;
                    $sirkulasi_detail_after = $this->M_Teacher->getData_sirkulasi_feereport_detail(null, $data_sirkulasi_feereport_next_periode[0]["no_sirkulasi_feereport"], $tipe, $cek_sirkulasi_next_periode[0]['no_sirkulasi_lesson']);
                    $data = array(
                        'price' => $sirkulasi_detail_after[0]['price'] - ($price_next_periode * 50 / 100) + ($price_next_periode * $teacher_percentage / 100),
                    );
                    $this->db->update('sirkulasi_feereport_detail', $data, ['id' => $sirkulasi_detail_after[0]['id']]);

                    $discount = (intval($data_sirkulasi_feereport_next_periode[0]['price']) - ($price_next_periode * 50 / 100) + ($price_next_periode * $teacher_percentage / 100)) * intval($data_sirkulasi_feereport_next_periode[0]['discount']) / 100;
                    $price_temp_feereport = intval($data_sirkulasi_feereport_next_periode[0]['price']) - ($price_next_periode * 50 / 100) + ($price_next_periode * $teacher_percentage / 100);
                    $data2 =  [
                        'price' => $price_temp_feereport,
                        'total_price' => $price_temp_feereport - $discount,
                        'updated_at' => $created_at,
                    ];
                    $this->db->update('sirkulasi_feereport', $data2, ['id_sirkulasi_feereport' => $data_sirkulasi_feereport_next_periode[0]['id_sirkulasi_feereport']]);
                }
            }
        }

        $data2 = [];
        $data3 = [];
        $price = 0;
        if ($tipe == 1) {
            $price = ($price_paket_pratical / 2) * $tipe_rate / 100;
        }
        if ($tipe == 2) {
            $price = $price_paket_theory * $tipe_rate / 100;
        }
        if (count($data_sirkulasi_feereport) == 0) {
            $data2 =  [
                'no_sirkulasi_feereport' => $no_sirkulasi_feereport,
                'id_teacher' => $this->input->post('id_teacher'),
                'created_at' => $created_at,
                'updated_at' => $created_at,
                'price' => $price,
                'total_price' => $price,
            ];
            $data3 = [
                'no_sirkulasi_feereport' => $no_sirkulasi_feereport,
                'id_teacher' => $this->input->post('id_teacher'),
                'id_barang' => $no_sirkulasi_lesson,
                'tipe' => $tipe,
                'price' => $price,
            ];
            $this->db->insert('sirkulasi_feereport', $data2);
            $this->db->insert('sirkulasi_feereport_detail', $data3);
        } else {
            if ($data_sirkulasi_feereport[0]['status_approved'] == 0) {
                $discount = (intval($data_sirkulasi_feereport[0]['price']) + intval($price)) * intval($data_sirkulasi_feereport[0]['discount']) / 100;
                $data2 =  [
                    'price' => intval($data_sirkulasi_feereport[0]['price']) + intval($price),
                    'total_price' => intval($data_sirkulasi_feereport[0]['price']) + intval($price) - $discount,
                    'updated_at' => $created_at,
                ];
                $this->db->update('sirkulasi_feereport', $data2, ['id_sirkulasi_feereport' => $data_sirkulasi_feereport[0]['id_sirkulasi_feereport']]);

                if (count($data_sirkulasi_feereport_detail) == 0) {
                    $data3 = [
                        'no_sirkulasi_feereport' => $data_sirkulasi_feereport[0]['no_sirkulasi_feereport'],
                        'id_teacher' => $this->input->post('id_teacher'),
                        'id_barang' => $no_sirkulasi_lesson,
                        'tipe' => $tipe,
                        'price' => $price,
                    ];
                    $this->db->insert('sirkulasi_feereport_detail', $data3);
                } else {
                    $data3 = [
                        'price' => intval($data_sirkulasi_feereport_detail[0]['price']) + intval($price),
                    ];
                    $this->db->update('sirkulasi_feereport_detail', $data3, ['id' => $data_sirkulasi_feereport_detail[0]['id']]);
                }
            }
        }

        $data = array(
            'date_update_cancel' => $this->input->post('date_update_cancel'),
        );
        $data2 = $this->M_Teacher->update_event_schedule_package($data, $this->input->post('id_schedule_pack'));

        $pack_online = $this->M_Teacher->getData_pack_online($id_list_pack, 1);
        $schedule_online = $this->M_Teacher->getData_schedule_package(null, $id_list_pack);
        $schedule_cancel = $this->M_Teacher->getData_schedule_package(null, $id_list_pack, 3, null, $jenis);
        $schedule_new = $this->M_Teacher->getData_schedule_package(null, $id_list_pack, 4);
        $count_theory = [];
        $count_pratical = [];
        foreach ($schedule_online as $so) {
            if ($so['status'] == 2 || ($so['status'] == 3 && $so['date_update_cancel'] != NULL)) :
                if ($so['jenis'] == 1) {
                    $count_pratical[] = $so['id_schedule_pack'];
                }
                if ($so['jenis'] == 2) {
                    $count_theory[] = $so['id_schedule_pack'];
                }
            endif;
        }

        $pack_pratical = $pack_online[0]['total_pack_practical'];
        $pack_theory = $pack_online[0]['total_pack_theory'];
        $count1 = intval($pack_pratical) - intval(count($count_pratical));
        $count2 = intval($pack_theory) - intval(count($count_theory));
        $count3 = 0;
        foreach ($schedule_cancel as $sc) {
            if ($sc['date_update_cancel'] == NULL) {
                $count3++;
            }
        }
        if ($jenis == 1) :
            $temp_event[] = "Lesson Package : ";
            $temp_event[] = '<span class="badge badge-primary">' . round($count1 / 2) . ' package (' . $count1 . ' meeting)</span> ';
            $temp_event[] = '<input type="hidden" id="countPractical" name="countPractical" value="' . $count1 . '">';
        else :
            $temp_event[] = "Lesson Package : ";
            $temp_event[] = '<span class="badge badge-primary">' . $count2 . ' package (' . $count2 . ' meeting)</span> ';
            $temp_event[] = '<input type="hidden" id="countTheory" name="countTheory" value="' . $count2 . '">';
        endif;
        if ($count3 > 0) {
            $temp_event[] = "<br>";
            $temp_event[] = "Lesson Cancel = ";
            $temp_event[] = '<span class="badge badge-danger">' . $count3 . ' lesson</span>, Please change date!';
        }
        $temp_event[] = '<input type="hidden" id="countCancel" name="countCancel" value="' . $count3 . '">';

        $event_join = implode(" ", $temp_event);
        echo $event_join;
    }

    function change_date_package()
    {
        $this->cekLogin();
        $data = [];
        if($this->input->post('status_date_change') == '2'){
            $data = array(
                'date_schedule' => $this->input->post('date_change'),
            );
        }
        if($this->input->post('status_date_change') == '3'){
            $data = array(
                'date_update_cancel' => $this->input->post('date_change'),
            );
        }

        $this->M_Teacher->update_change_date_package($data, $this->input->post('active_schedule_id'));
    }

    public function insert_schedule_package()
    {
        $this->cekLogin();
        $id_list_pack = $this->input->post('id_list_pack');
        $jenis = $this->input->post('jenis');
        $data = array(
            'id_list_pack'  => $this->input->post('id_list_pack'),
            'id_student'  => $this->input->post('id_student'),
            'id_teacher'  => $this->input->post('id_teacher'),
            'jenis' => $this->input->post('jenis'),
            'status' => $this->input->post('status'),
            'date_schedule' => $this->input->post('date_schedule'),
        );
        $data2 = $this->M_Teacher->insert_event_schedule_package($data);

        $pack_online = $this->M_Teacher->getData_pack_online($id_list_pack, 1);
        $schedule_online = $this->M_Teacher->getData_schedule_package(null, $id_list_pack);
        $schedule_cancel = $this->M_Teacher->getData_schedule_package(null, $id_list_pack, 3, null, $jenis);
        $schedule_new = $this->M_Teacher->getData_schedule_package(null, $id_list_pack, 4);
        $count_theory = [];
        $count_pratical = [];
        foreach ($schedule_online as $so) {
            if ($so['status'] == 2 || ($so['status'] == 3 && $so['date_update_cancel'] != NULL)) :
                if ($so['jenis'] == 1) {
                    $count_pratical[] = $so['id_schedule_pack'];
                }
                if ($so['jenis'] == 2) {
                    $count_theory[] = $so['id_schedule_pack'];
                }
            endif;
        }

        $pack_pratical = $pack_online[0]['total_pack_practical'];
        $pack_theory = $pack_online[0]['total_pack_theory'];
        $count1 = intval($pack_pratical) - intval(count($count_pratical));
        $count2 = intval($pack_theory) - intval(count($count_theory));
        $count3 = 0;
        foreach ($schedule_cancel as $sc) {
            if ($sc['date_update_cancel'] == NULL) {
                $count3++;
            }
        }
        if ($jenis == 1) :
            $temp_event[] = "Lesson Package : ";
            $temp_event[] = '<span class="badge badge-primary">' . round($count1 / 2) . ' package (' . $count1 . ' meeting)</span> ';
            $temp_event[] = '<input type="hidden" id="countPractical" name="countPractical" value="' . $count1 . '">';
        else :
            $temp_event[] =  "Lesson Package : ";
            $temp_event[] = '<span class="badge badge-primary">' . $count2 . ' package (' . $count2 . ' meeting)</span> ';
            $temp_event[] = '<input type="hidden" id="countTheory" name="countTheory" value="' . $count2 . '">';
        endif;
        if ($count3 > 0) {
            $temp_event[] = "<br>";
            $temp_event[] = "Lesson Cancel = ";
            $temp_event[] = '<span class="badge badge-danger">' . $count3 . ' lesson</span>, Please change date!';
        }
        $temp_event[] = '<input type="hidden" id="countCancel" name="countCancel" value="' . $count3 . '">';

        $event_join = implode(" ", $temp_event);
        echo $event_join;
    }
}
