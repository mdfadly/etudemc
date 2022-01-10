<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_Portal');
        $this->load->model('M_Admin');
    }

    private function cekLogin()
    {
        if (!$this->session->userdata('login_user')) {
            redirect('portal/user-login');
        }
    }



    function get_ajax_student()
    {
        $this->cekLogin();
        $dbTable = "student";
        $list = $this->M_Admin->get_datatables($dbTable);

        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no . ".";
            $temp_id_student = substr($item->id_student, 6);
            $row[] = $item->id_parent . "-" . $temp_id_student;
            $row[] = $item->name_student;
            if (substr($item->instrument, 0, 6) == "Others") :
                $temp_ins = explode('|', $item->instrument);
                $row[] = $temp_ins[1];
            else :
                $row[] = $item->instrument;
            endif;
            // $row[] = $item->id_parent;
            // $row[] = $item->parent_student;
            // $row[] = $item->address_student;
            // $row[] = $item->phone_student_1;
            // $row[] = $item->phone_student_2;
            // $row[] = $item->school_student;
            $row[] = '<a href="' . site_url('portal/data_student/detail/' . $item->id_student) . '" class="btn btn-primary mr-2 btn-update" title="Detail"> <i class="fa fa-info"></i> </a>';
            // add html for action
            // $row[] = '<div class="btn-group"><a href="' . site_url('portal/data_student/edit/' . $item->id_student) . '" class="btn btn-info mr-2 btn-update" title="Edit Data ini"> <i class="fa fa-edit icon-white"></i> </a>
            // <a href="' . site_url('portal/C_Admin/delete_data_student/' . $item->id_student) . '" class="btn btn-danger" title="Hapus Data Ini" onclick=\'return confirm("are you sure want to delete this data?")\'><i class="fa fa-trash icon-white"></i></a></div>';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_Admin->count_all($dbTable),
            "recordsFiltered" => $this->M_Admin->count_filtered($dbTable),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    public function get_ajax_teacher()
    {
        $this->cekLogin();
        $dbTable = "teacher";
        $list = $this->M_Admin->get_datatables($dbTable);

        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $item->id_teacher;
            $row[] = $item->name_teacher;
            $row[] = $item->instrument;
            // $row[] = $item->address_teacher;
            // $row[] = $item->phone_teacher;
            // $row[] = $item->email_teacher;
            // $row[] = $item->bank_teacher;
            // $row[] = $item->norek_teacher;
            // add html for action
            $row[] = '<a href="' . site_url('portal/profile/' . $item->username) . '" class="btn btn-primary mr-2 btn-update" title="Detail"> <i class="fa fa-info"></i> </a>';

            // $row[] = '<a href="' . site_url('portal/C_Admin/delete_data_teacher/' . $item->id_teacher) . '" class="btn btn-danger mr-2" title="Hapus Data Ini" onclick=\'return confirm("are you sure want to delete this data?")\'><i class="fa fa-trash icon-white"></i></a>';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_Admin->count_all($dbTable),
            "recordsFiltered" => $this->M_Admin->count_filtered($dbTable),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    function get_ajax_offline_lesson()
    {
        $this->cekLogin();
        $dbTable = "offline_lesson";
        $list = $this->M_Admin->get_datatables($dbTable);

        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $item->id_student;
            $row[] = $item->name_student;
            $row[] = $item->id_teacher;
            $row[] = $item->name_teacher;

            $instrument = $item->instrument;
            if (substr($instrument, 0, 6) == "Others") {
                $temp_ins = explode('|', $instrument);
                $instrument = $temp_ins[1];
            }

            $rate = $item->rate;
            if (substr($rate, 0, 6) == "Others") {
                $temp_ins = explode('|', $rate);
                $rate = $temp_ins[1];
            }

            $row[] = $instrument;
            // $row[] = $item->duration;
            // $row[] = "Rp" . number_format($item->rate, 0, ".", ".");

            $row[] = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop' . $item->id_offline_lesson . '"><i class="fa fa-info"></i></button>
            <div class="modal fade" id="staticBackdrop' . $item->id_offline_lesson . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel" style="font-weight:bold">Data Offline Lesson</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Teacher Name
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . $item->name_teacher . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Student Name
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . $item->name_student . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Instrument
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . $instrument . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Package
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . $item->name_paket . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Duration
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . $item->duration . '`
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Rate
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                Rp ' . number_format($rate, 0, ',', '.') . '
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-group"><a href="' . site_url('portal/data_offline_lesson/edit/' . $item->id_offline_lesson) . '" class="btn btn-xs btn-primary mr-2 btn-update" title="Edit Data ini"> <i class="fa fa-edit icon-white"></i> </a>
                            <a href="' . site_url('portal/C_Admin/delete_data_offline_lesson/' . $item->id_offline_lesson) . '" class="btn btn-danger" title="Hapus Data Ini" onclick=\'return confirm("are you sure want to delete this data?")\'><i class="fa fa-trash icon-white"></i></a></div>
                        </div>

                    </div>
                </div>
            </div>
            ';
            // add html for action
            // $row[] = '<div class="btn-group"><a href="' . site_url('portal/data_offline_lesson/edit/' . $item->id_offline_lesson) . '" class="btn btn-xs btn-primary mr-2 btn-update" title="Edit Data ini"> <i class="fa fa-edit icon-white"></i> </a>
            // <a href="' . site_url('portal/C_Admin/delete_data_offline_lesson/' . $item->id_offline_lesson) . '" class="btn btn-danger" title="Hapus Data Ini" onclick=\'return confirm("are you sure want to delete this data?")\'><i class="fa fa-trash icon-white"></i></a></div>';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_Admin->count_all($dbTable),
            "recordsFiltered" => $this->M_Admin->count_filtered($dbTable),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    function get_ajax_online_lesson()
    {
        $this->cekLogin();
        $dbTable = "list_package";
        $list = $this->M_Admin->get_datatables($dbTable, 'data_all');
        // echo var_dump($list);
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            if ($item->status_pack_practical == '1' && $item->status_pack_theory == '1') {
                $no++;
                $row = array();
                // $row[] = $no . ".";
                $row[] = $item->id_student;
                $row[] = $item->name_student;
                // $row[] = $item->name_teacher;
                $name_teacher2 = "";
                if ($item->nama_teacher2 == "") {
                    $name_teacher2 = '<span class="badge badge-warning">No</span>';
                } else {
                    $name_teacher2 = $item->nama_teacher2;
                }
                // $row[] = $name_teacher2;
                // echo $item->id_list_pack ."<br>";
                // die();
                $count_praktek = 0;
                $count_done = 0;
                $count_cancel = 0;
                $count_ongoing = 0;
                $data_schedule = $this->M_Teacher->getData_schedule_package(null, $item->id_list_pack);
                foreach ($data_schedule as $ds) {
                    if($ds['jenis'] == '1'){
                        $count_praktek += 1;
                        if ($ds['status'] == '1' || ($ds['status'] == '3' && $ds['date_update_cancel'] == null)) {
                            $count_ongoing += 1;
                        } else if ($ds['status'] == '2' || ($ds['status'] == '3' && $ds['date_update_cancel'] != null)) {
                            $count_done += 1;
                        } else if ($ds['status'] == '3' && $ds['date_update_cancel'] == null) {
                            $count_cancel += 1;
                        }
                    }
                }
                $status_pack = "";
                if ($count_ongoing == 0 && $count_done == 0 && $count_cancel == 0) {
                    $status_pack = '<span class="badge badge-primary text-white">Choose the date !</span>';
                } else {
                    if ($count_praktek == $count_done) {
                        $status_pack = '<span class="badge badge-danger">Done</span>';
                    } else if (($count_ongoing == 3 || $count_ongoing == 4) && $count_done > 0) {
                        $status_pack = '<span class="badge badge-warning text-white">2 pack more!</span>';
                    } else if (($count_ongoing == 2 || $count_ongoing == 1) && $count_done > 0) {
                        $status_pack = '<span class="badge badge-warning text-white">1 pack more!</span>';
                    } else {
                        $status_pack = '<span class="badge text-white" style="background-color:#00B050">On Going</span>';
                    }
                }
                // $row[] = $status_pack ." - ". $count_ongoing ." - " . $count_done ." - " . $count_cancel;
                $buttonDlt = '';
                if ($count_ongoing == 0 && $count_done == 0 && $count_cancel == 0) {
                    $buttonDlt = '<a href="' . site_url('portal/C_Admin/delete_data_online_pratical/' . $item->id_list_pack . '/' . str_replace("/", "-", $item->no_transaksi_package)) . '" class="btn btn-danger" title="Hapus Data Ini" onclick=\'return confirm("are you sure want to delete this data?")\'><i class="fa fa-trash icon-white"></i></a>';
                    $row[] = '<a href="' . site_url() . 'portal/data_online_lesson/package/calendar/' . $item->id_list_pack . '" style="font-size:23px; color:#0676BD"> <i class="fa fa-calendar"></i> </a><br>' . $status_pack;
                } else {
                    if ($count_praktek == $count_done) {
                        $row[] = '<a class="text-danger" href="' . site_url() . 'portal/data_online_lesson/package/calendar/' . $item->id_list_pack . '" style="font-size:23px;"> <i class="fa fa-calendar"></i> </a><br>' . $status_pack;
                    } else if (($count_ongoing == 2 || $count_ongoing == 1 || $count_ongoing == 3 || $count_ongoing == 4) && $count_done > 0) {
                        $row[] = '<a class="text-warning" href="' . site_url() . 'portal/data_online_lesson/package/calendar/' . $item->id_list_pack . '" style="font-size:23px;"> <i class="fa fa-calendar"></i> </a><br>' . $status_pack;
                    } else {
                        $row[] = '<a href="' . site_url() . 'portal/data_online_lesson/package/calendar/' . $item->id_list_pack . '" style="font-size:23px; color:#00B050"> <i class="fa fa-calendar"></i> </a><br>' . $status_pack;
                    }
                }
                $date = date_create($item->created_at);
                $row[] = date_format($date, "d-m-Y");
                $row[] = date_format(date_create($item->end_at), "d-m-Y");

                $instrument_temp = '';
                if (substr($item->instrument, 0, 6) == "Others") :
                    $temp_ins = explode('|', $item->instrument);
                    $instrument_temp = $temp_ins[1];
                else :
                    $instrument_temp = $item->instrument;
                endif;

                $row[] = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop' . $item->id_list_pack . '"><i class="fa fa-info"></i></button>
                <div class="modal fade" id="staticBackdrop' . $item->id_list_pack . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel" style="font-weight:bold">Detail of Package</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Student Name
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . $item->name_student . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    ID Student
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . $item->id_student . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Practical Teacher
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . $item->name_teacher . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Theory Teacher
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . $name_teacher2 . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Instrument
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . $instrument_temp . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Pack Practical
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . $item->total_pack_practical . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Pack Theory
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . $item->total_pack_theory . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Rate
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">' . ($item->rate_dollar == 1 ? "Rp" : ($item->rate_dollar == 2 ? "USD" : "EUR")) . ' ' . number_format($item->rate, 0, ".", ".") . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Purchase Date
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . date_format(date_create($item->created_at), "d-m-y") . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Expired Date
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . date_format(date_create($item->end_at), "d-m-y") . '
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-group">' . $buttonDlt . '</div>
                        </div>

                    </div>
                </div>
                </div>';


                // add html for action
                // $row[] = '<div class="btn-group"><a href="' . site_url('portal/data_online_lesson/edit/' . $item->id_list_pack) . '" class="btn btn-xs btn-info mr-2 btn-update" title="Edit Data ini"> <i class="fa fa-edit icon-white"></i> </a>
                // <a href="' . site_url('portal/C_Admin/delete_data_online_pratical/' . $item->id_list_pack) . '" class="btn btn-danger" title="Hapus Data Ini" onclick=\'return confirm("are you sure want to delete this data?")\'><i class="fa fa-trash icon-white"></i></a></div>';
                $data[] = $row;
            }
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_Admin->count_all($dbTable, 'data_all'),
            "recordsFiltered" => $this->M_Admin->count_filtered($dbTable, 'data_all'),
            "data" => $data,
        );

        // output to json format
        echo json_encode($output);
    }

    function get_ajax_online_lesson_practice()
    {
        $this->cekLogin();
        $dbTable = "list_package";
        $list = $this->M_Admin->get_datatables($dbTable, 'data_practice');
        // echo var_dump($list);
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            if ($item->status_pack_practical == '1' && $item->status_pack_theory == '0') {
                $no++;
                $row = array();
                // $row[] = $no . ".";
                $row[] = $item->id_student;
                $row[] = $item->name_student;
                // $row[] = $item->name_teacher;
                $name_teacher2 = "";
                if ($item->nama_teacher2 == "") {
                    $name_teacher2 = '<span class="badge badge-warning">No</span>';
                } else {
                    $name_teacher2 = $item->nama_teacher2;
                }
                // $row[] = $name_teacher2;
                // echo $item->id_list_pack ."<br>";
                // die();
                $count_done = 0;
                $count_cancel = 0;
                $count_ongoing = 0;
                $data_schedule = $this->M_Teacher->getData_schedule_package(null, $item->id_list_pack);
                foreach ($data_schedule as $ds) {
                    if ($ds['status'] == '1' || ($ds['status'] == '3' && $ds['date_update_cancel'] == null)) {
                        $count_ongoing += 1;
                    } else if ($ds['status'] == '2' || ($ds['status'] == '3' && $ds['date_update_cancel'] != null)) {
                        $count_done += 1;
                    } else if ($ds['status'] == '3' && $ds['date_update_cancel'] == null) {
                        $count_cancel += 1;
                    }
                }
                $status_pack = "";
                if ($count_ongoing == 0 && $count_done == 0 && $count_cancel == 0) {
                    $status_pack = '<span class="badge badge-primary text-white">Choose the date !</span>';
                } else {
                    if (count($data_schedule) == $count_done) {
                        $status_pack = '<span class="badge badge-danger">Done</span>';
                    } else if (($count_ongoing == 3 || $count_ongoing == 4) && $count_done > 0) {
                        $status_pack = '<span class="badge badge-warning text-white">2 pack more!</span>';
                    } else if (($count_ongoing == 2 || $count_ongoing == 1) && $count_done > 0) {
                        $status_pack = '<span class="badge badge-warning text-white">1 pack more!</span>';
                    } else {
                        $status_pack = '<span class="badge text-white" style="background-color:#00B050">On Going</span>';
                    }
                }
                // $row[] = $status_pack ." - ". $count_ongoing ." - " . $count_done ." - " . $count_cancel;
                $buttonDlt = '';
                if ($count_ongoing == 0 && $count_done == 0 && $count_cancel == 0) {
                    $buttonDlt = '<a href="' . site_url('portal/C_Admin/delete_data_online_pratical/' . $item->id_list_pack . '/' . str_replace("/", "-", $item->no_transaksi_package)) . '" class="btn btn-danger" title="Hapus Data Ini" onclick=\'return confirm("are you sure want to delete this data?")\'><i class="fa fa-trash icon-white"></i></a>';
                    $row[] = '<a href="' . site_url() . 'portal/data_online_lesson/package/calendar/' . $item->id_list_pack . '" style="font-size:23px; color:#0676BD"> <i class="fa fa-calendar"></i> </a><br>' . $status_pack;
                } else {
                    if (count($data_schedule) == $count_done) {
                        $row[] = '<a class="text-danger" href="' . site_url() . 'portal/data_online_lesson/package/calendar/' . $item->id_list_pack . '" style="font-size:23px;"> <i class="fa fa-calendar"></i> </a><br>' . $status_pack;
                    } else if (($count_ongoing == 2 || $count_ongoing == 1 || $count_ongoing == 3 || $count_ongoing == 4) && $count_done > 0) {
                        $row[] = '<a class="text-warning" href="' . site_url() . 'portal/data_online_lesson/package/calendar/' . $item->id_list_pack . '" style="font-size:23px;"> <i class="fa fa-calendar"></i> </a><br>' . $status_pack;
                    } else {
                        $row[] = '<a href="' . site_url() . 'portal/data_online_lesson/package/calendar/' . $item->id_list_pack . '" style="font-size:23px; color:#00B050"> <i class="fa fa-calendar"></i> </a><br>' . $status_pack;
                    }
                }
                $date = date_create($item->created_at);
                $row[] = date_format($date, "d-m-Y");
                $row[] = date_format(date_create($item->end_at), "d-m-Y");

                $instrument_temp = '';
                if (substr($item->instrument, 0, 6) == "Others") :
                    $temp_ins = explode('|', $item->instrument);
                    $instrument_temp = $temp_ins[1];
                else :
                    $instrument_temp = $item->instrument;
                endif;

                $row[] = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop' . $item->id_list_pack . '"><i class="fa fa-info"></i></button>
                <div class="modal fade" id="staticBackdrop' . $item->id_list_pack . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel" style="font-weight:bold">Detail of Package</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Student Name
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . $item->name_student . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        ID Student
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . $item->id_student . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Practical Teacher
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . $item->name_teacher . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Theory Teacher
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . $name_teacher2 . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Instrument
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . $instrument_temp . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Pack Practical
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . $item->total_pack_practical . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Pack Theory
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . $item->total_pack_theory . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Rate
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">' . ($item->rate_dollar == 1 ? "Rp" : ($item->rate_dollar == 2 ? "USD" : "EUR")) . ' ' . number_format($item->rate, 0, ".", ".") . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Purchase Date
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . date_format(date_create($item->created_at), "d-m-y") . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Expired Date
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . date_format(date_create($item->end_at), "d-m-y") . '
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="btn-group">' . $buttonDlt . '</div>
                            </div>
    
                        </div>
                    </div>
                </div>
                ';


                // add html for action
                // $row[] = '<div class="btn-group"><a href="' . site_url('portal/data_online_lesson/edit/' . $item->id_list_pack) . '" class="btn btn-xs btn-info mr-2 btn-update" title="Edit Data ini"> <i class="fa fa-edit icon-white"></i> </a>
                // <a href="' . site_url('portal/C_Admin/delete_data_online_pratical/' . $item->id_list_pack) . '" class="btn btn-danger" title="Hapus Data Ini" onclick=\'return confirm("are you sure want to delete this data?")\'><i class="fa fa-trash icon-white"></i></a></div>';
                $data[] = $row;
            }
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_Admin->count_all($dbTable, 'data_practice'),
            "recordsFiltered" => $this->M_Admin->count_filtered($dbTable, 'data_practice'),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }
    function get_ajax_online_lesson_theory()
    {
        $this->cekLogin();
        $dbTable = "list_package";
        $list = $this->M_Admin->get_datatables($dbTable, 'data_theory');
        // echo var_dump($list);
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            if ($item->status_pack_practical == '0' && $item->status_pack_theory == '1') {
                $no++;
                $row = array();
                // $row[] = $no . ".";
                $row[] = $item->id_student;
                $row[] = $item->name_student;
                // $row[] = $item->name_teacher;
                $name_teacher2 = "";
                if ($item->nama_teacher2 == "") {
                    $name_teacher2 = '<span class="badge badge-warning">No</span>';
                } else {
                    $name_teacher2 = $item->nama_teacher2;
                }
                // $row[] = $name_teacher2;
                // echo $item->id_list_pack ."<br>";
                // die();
                $count_done = 0;
                $count_cancel = 0;
                $count_ongoing = 0;
                $data_schedule = $this->M_Teacher->getData_schedule_package(null, $item->id_list_pack);
                foreach ($data_schedule as $ds) {
                    if ($ds['status'] == '1' || ($ds['status'] == '3' && $ds['date_update_cancel'] == null)) {
                        $count_ongoing += 1;
                    } else if ($ds['status'] == '2' || ($ds['status'] == '3' && $ds['date_update_cancel'] != null)) {
                        $count_done += 1;
                    } else if ($ds['status'] == '3' && $ds['date_update_cancel'] == null) {
                        $count_cancel += 1;
                    }
                }
                $status_pack = "";
                if ($count_ongoing == 0 && $count_done == 0 && $count_cancel == 0) {
                    $status_pack = '<span class="badge badge-primary text-white">Choose The Date !</span>';
                } else {
                    if (count($data_schedule) == $count_done) {
                        $status_pack = '<span class="badge badge-danger">Done</span>';
                    } else if ($count_ongoing == 2 && $count_done > 0) {
                        $status_pack = '<span class="badge badge-warning text-white">2 pack more!</span>';
                    } else if (($count_ongoing == 1) && $count_done > 0) {
                        $status_pack = '<span class="badge badge-warning text-white">1 pack more!</span>';
                    } else {
                        $status_pack = '<span class="badge text-white" style="background-color:#00B050">On Going</span>';
                    }
                }
                // $row[] = $status_pack ." - ". $count_ongoing ." - " . $count_done ." - " . $count_cancel;
                $buttonDlt = '';
                if ($count_ongoing == 0 && $count_done == 0 && $count_cancel == 0) {
                    $buttonDlt = '<a href="' . site_url('portal/C_Admin/delete_data_online_pratical/' . $item->id_list_pack . '/' . str_replace("/", "-", $item->no_transaksi_package)) . '" class="btn btn-danger" title="Hapus Data Ini" onclick=\'return confirm("are you sure want to delete this data?")\'><i class="fa fa-trash icon-white"></i></a>';
                    $row[] = '<a href="' . site_url() . 'portal/data_online_lesson/package/calendar/' . $item->id_list_pack . '" style="font-size:23px; color:#0676BD"> <i class="fa fa-calendar"></i> </a><br>' . $status_pack;
                } else {
                    if (count($data_schedule) == $count_done) {
                        $row[] = '<a class="text-danger" href="' . site_url() . 'portal/data_online_lesson/package/calendar/' . $item->id_list_pack . '" style="font-size:23px;"> <i class="fa fa-calendar"></i> </a><br>' . $status_pack;
                    } else if ($count_ongoing == 2 && $count_done > 0) {
                        $row[] = '<a class="text-warning" href="' . site_url() . 'portal/data_online_lesson/package/calendar/' . $item->id_list_pack . '" style="font-size:23px;"> <i class="fa fa-calendar"></i> </a><br>' . $status_pack;
                    } else if (($count_ongoing == 1) && $count_done > 0) {
                        $row[] = '<a class="text-warning" href="' . site_url() . 'portal/data_online_lesson/package/calendar/' . $item->id_list_pack . '" style="font-size:23px;"> <i class="fa fa-calendar"></i> </a><br>' . $status_pack;
                    } else {
                        $row[] = '<a href="' . site_url() . 'portal/data_online_lesson/package/calendar/' . $item->id_list_pack . '" style="font-size:23px; color:#00B050"> <i class="fa fa-calendar"></i> </a><br>' . $status_pack;
                    }
                }
                $date = date_create($item->created_at);
                $row[] = date_format($date, "d-m-Y");
                $row[] = date_format(date_create($item->end_at), "d-m-Y");

                $instrument_temp = '';
                if (substr($item->instrument, 0, 6) == "Others") :
                    $temp_ins = explode('|', $item->instrument);
                    $instrument_temp = $temp_ins[1];
                else :
                    $instrument_temp = $item->instrument;
                endif;

                $row[] = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop' . $item->id_list_pack . '"><i class="fa fa-info"></i></button>
                <div class="modal fade" id="staticBackdrop' . $item->id_list_pack . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel" style="font-weight:bold">Detail of Package</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Student Name
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . $item->name_student . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        ID Student
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . $item->id_student . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Practical Teacher
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . $item->name_teacher . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Theory Teacher
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . $name_teacher2 . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Instrument
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . $instrument_temp . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Pack Practical
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . $item->total_pack_practical . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Pack Theory
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . $item->total_pack_theory . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Rate
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">' . ($item->rate_dollar == 1 ? "Rp" : ($item->rate_dollar == 2 ? "USD" : "EUR")) . ' ' . number_format($item->rate, 0, ".", ".") . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Purchase Date
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . date_format(date_create($item->created_at), "d-m-y") . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Expired Date
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . date_format(date_create($item->end_at), "d-m-y") . '
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="btn-group">' . $buttonDlt . '</div>
                            </div>
    
                        </div>
                    </div>
                </div>
                ';


                // add html for action
                // $row[] = '<div class="btn-group"><a href="' . site_url('portal/data_online_lesson/edit/' . $item->id_list_pack) . '" class="btn btn-xs btn-info mr-2 btn-update" title="Edit Data ini"> <i class="fa fa-edit icon-white"></i> </a>
                // <a href="' . site_url('portal/C_Admin/delete_data_online_pratical/' . $item->id_list_pack) . '" class="btn btn-danger" title="Hapus Data Ini" onclick=\'return confirm("are you sure want to delete this data?")\'><i class="fa fa-trash icon-white"></i></a></div>';
                $data[] = $row;
            }
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_Admin->count_all($dbTable, 'data_theory'),
            "recordsFiltered" => $this->M_Admin->count_filtered($dbTable, 'data_theory'),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    function get_ajax_theory_lesson()
    {
        $this->cekLogin();
        $dbTable = "online_theory";
        $list = $this->M_Admin->get_datatables($dbTable);

        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $item->id_student;
            $row[] = $item->name_student;
            $row[] = $item->id_teacher;
            // $row[] = $item->name_teacher;
            $instrument_temp = '';
            if (substr($item->instrument, 0, 6) == "Others") :
                $temp_ins = explode('|', $item->instrument);
                $instrument_temp = $temp_ins[1];
            else :
                $instrument_temp = $item->instrument;
            endif;
            $row[] = $instrument_temp;
            // $row[] = $item->duration;
            // $row[] = "Rp" . number_format($item->rate, 0, ".", ".");
            // add html for action
            $row[] = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop' . $item->id_online_theory . '"><i class="fa fa-info"></i></button>
            <div class="modal fade" id="staticBackdrop' . $item->id_online_theory . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel" style="font-weight:bold">Detail of Package</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Teacher Name
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . $item->name_teacher . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Student Name
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . $item->name_student . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Instrument
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' .  $instrument_temp . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Duration
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . $item->duration . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Rate
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                Rp ' . number_format($item->rate, 0, ".", ".") . '
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-group"><a href="' . site_url('portal/data_theory_lesson/edit/' . $item->id_online_theory) . '" class="btn btn-xs btn-primary mr-2 btn-update" title="Edit Data ini"> <i class="fa fa-edit icon-white"></i> </a>
            <a href="' . site_url('portal/C_Admin/delete_data_online_theory/' . $item->id_online_theory) . '" class="btn btn-danger" title="Hapus Data Ini" onclick=\'return confirm("are you sure want to delete this data?")\'><i class="fa fa-trash icon-white"></i></a></div>
                        </div>
                    </div>
                </div>
            </div>
            ';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_Admin->count_all($dbTable),
            "recordsFiltered" => $this->M_Admin->count_filtered($dbTable),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    function get_ajax_book()
    {
        $this->cekLogin();
        $dbTable = "book";
        $list = $this->M_Admin->get_datatables($dbTable);

        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $item->title;
            // $row[] = $item->level;
            $row[] = $item->publisher;
            $row[] = $item->qty;

            $distributor = '';
            if (substr($item->distributor, 0, 6) == "Others") :
                $temp_ins = explode('|', $item->distributor);
                $distributor = $temp_ins[1];
            else :
                $distributor = $item->distributor;
            endif;

            $distributor_price = '';
            if ($item->qty > 0) {
                $distributor_price = "Rp " . number_format($item->distributor_price, 0, ".", ".");
            } else {
                $distributor = "-";
                $distributor_price = "Rp 0";
            }

            $selling_price = '';
            if ($item->qty > 0) {
                $selling_price = "Rp " . number_format($item->selling_price, 0, ".", ".");
            } else {
                $distributor = "-";
                $selling_price = "Rp 0";
            }
            // if ($item->qty > 0) {
            //     $row[] = $item->distributor;
            //     $row[] = "Rp" . number_format($item->distributor_price, 0, ".", ".");
            // } else {
            //     $row[] = "-";
            //     $row[] = "Rp 0";
            // }
            $row[] = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop' . $item->id_book . '"><i class="fa fa-info"></i></button>
            <div class="modal fade" id="staticBackdrop' . $item->id_book . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Detail of Book</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Book Title - Level
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . $item->title . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Publisher
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . $item->publisher . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Qty
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . $item->qty . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Distributor
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . $distributor . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Distributor Price
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . $distributor_price . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Selling Price
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . $selling_price . '
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ';
            // add html for action
            // $row[] = '<div class="btn-group"><a href="' . site_url('portal/book/edit/' . $item->id_book) . '" class="btn btn-xs btn-info mr-2 btn-update" title="Edit Data ini"> <i class="fa fa-edit icon-white"></i> </a>
            // <a href="' . site_url('portal/C_Admin/delete_data_book/' . $item->id_book) . '" class="btn btn-danger" title="Hapus Data Ini" onclick=\'return confirm("are you sure want to delete this data?")\'><i class="fa fa-trash icon-white"></i></a></div>';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_Admin->count_all($dbTable),
            "recordsFiltered" => $this->M_Admin->count_filtered($dbTable),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    function get_ajax_book_order()
    {
        $this->cekLogin();
        $dbTable = "order_book";
        $list = $this->M_Admin->get_datatables($dbTable);

        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $item->name_student;
            $row[] = $item->title;
            // $row[] = $item->level;
            $row[] = $item->qty_order_book;
            // $row[] = "Rp " . number_format($item->distributor_price, 0, ".", ".");

            // if (substr($item->tgl_send, 0, 10) == "0000-00-00") {
            //     $row[] = "-";
            // } else {
            //     $date = date_create(substr($item->tgl_send, 0, 10));
            //     $row[] = date_format($date, "j F Y");
            // }
            // if (substr($item->tgl_terima, 0, 10) == "0000-00-00") {
            //     $row[] = "-";
            // } else {
            //     $date = date_create(substr($item->tgl_terima, 0, 10));
            //     $row[] = date_format($date, "j F Y");
            // }
            // $row[] = $item->penerima;

            $status_book = '';
            if ($item->status_order_book == "1") {
                $status_book = '<span class="badge badge-warning text-white">Order</span>';
            } else if ($item->status_order_book == "2") {
                $status_book = '<span class="badge badge-info">Sent</span>';
            } else {
                $status_book = '<span class="badge badge-success">Received</span>';
            }

            $row[] = $status_book;

            $kirim = '';
            if (substr($item->tgl_send, 0, 10) == "0000-00-00") {
                $kirim = "-";
            } else {
                $date = date_create(substr($item->tgl_send, 0, 10));
                $kirim = date_format($date, "d/m/Y");
            }

            $terima = '';
            if (substr($item->tgl_terima, 0, 10) == "0000-00-00") {
                $terima = "-";
            } else {
                $date = date_create(substr($item->tgl_terima, 0, 10));
                $terima = date_format($date, "d/m/Y");
            }

            $row[] = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop' . $item->id_order . '"><i class="fa fa-info"></i></button>
            <div class="modal fade" id="staticBackdrop' . $item->id_order . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Detail of Book</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Student Name
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . $item->name_student . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Book Title - Level
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . $item->title . '
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Qty
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . $item->qty_order_book . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Status
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . $status_book . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Date Order
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . date_format(date_create("$item->tgl_order"), "d/m/Y") . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Tanggal terikirim
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . $kirim . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Tanggal terima
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . $terima . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Penerima
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . $item->penerima . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Book Price
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . "Rp " . number_format($item->selling_price, 0, ".", ".") . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Shipping Price
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . "Rp " . number_format($item->shipping_price, 0, ".", ".") . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Discount
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . "Rp " . number_format($item->discount, 0, ".", ".") . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Total Price
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . "Rp " . number_format($item->price, 0, ".", ".") . '
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-group"><a href="' . site_url('portal/book/sell/edit/' . $item->id_order) . '" class="btn btn-xs btn-primary mr-2 btn-update" title="Edit Data ini"> <i class="fa fa-edit icon-white"></i> </a> <a href="' . site_url('portal/C_Admin/delete_data_book_order/' . $item->id_order . '/' . $item->id_book . '/' . $item->qty_order_book . '/' . str_replace("/", "-", $item->no_transaksi_book)) . '" class="btn btn-danger" title="Hapus Data Ini" onclick=\'return confirm("are you sure want to delete this data?")\'><i class="fa fa-trash icon-white"></i></a></div>
                        </div>
                    </div>
                </div>
            </div>
            ';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_Admin->count_all($dbTable),
            "recordsFiltered" => $this->M_Admin->count_filtered($dbTable),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    function get_ajax_book_purchase()
    {
        $this->cekLogin();
        $dbTable = "book_purchase";
        $list = $this->M_Admin->get_datatables($dbTable);

        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no . ".";
            $date = date_create("$item->date");
            $row[] = date_format($date, "d/m/Y");
            $row[] = $item->title;
            $row[] = $item->publisher;
            $row[] = $item->qty;
            // $row[] = $item->distributor;
            // $row[] = "Rp " . number_format($item->distributor_price, 0, ".", ".");

            // $row[] = "Rp " . number_format($item->shipping_rate, 0, ".", ".");
            // $row[] = '-';
            // add html for action
            $distributor = '';
            if (substr($item->distributor, 0, 6) == "Others") :
                $temp_ins = explode('|', $item->distributor);
                $distributor = $temp_ins[1];
            else :
                $distributor = $item->distributor;
            endif;

            $row[] = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop' . $item->id_purchase . '"><i class="fa fa-info"></i></button>
            <div class="modal fade" id="staticBackdrop' . $item->id_purchase . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Detail of Book</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Purchase Date
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                    ' . date_format($date, "d/m/Y") . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Book Title - Level
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                    ' . $item->title . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Publisher
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                    ' . $item->publisher . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Qty
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                    ' . $item->qty . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Distributor
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                    ' . $distributor . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Distributor Price
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                    Rp ' . number_format($item->distributor_price, 0, ".", ".") . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                   Shipping Price
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                    Rp ' . number_format($item->shipping_rate, 0, ".", ".") . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                   Selling Price
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                    Rp ' . number_format($item->selling_price, 0, ".", ".")  . '
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-group"><a href="' . site_url('portal/book/input/edit/' . $item->id_purchase) . '" class="btn btn-xs btn-primary mr-2 btn-update" title="Edit Data ini"> <i class="fa fa-edit icon-white"></i> </a> <a href="' . site_url('portal/C_Admin/delete_data_book_purchase/' . $item->id_purchase) . '" class="btn btn-danger" title="Hapus Data Ini" onclick=\'return confirm("are you sure want to delete this data?")\'><i class="fa fa-trash icon-white"></i></a></div>
                        </div>
                    </div>
                </div>
            </div>
            ';
            // $row[] = '<div class="btn-group"><a href="' . site_url('portal/book/input/edit/' . $item->id_purchase) . '" class="btn btn-xs btn-primary mr-2 btn-update" title="Edit Data ini"> <i class="fa fa-edit icon-white"></i> </a>
            // <a href="' . site_url('portal/C_Admin/delete_data_book_purchase/' . $item->id_purchase) . '" class="btn btn-danger" title="Hapus Data Ini" onclick=\'return confirm("are you sure want to delete this data?")\'><i class="fa fa-trash icon-white"></i></a></div>';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_Admin->count_all($dbTable),
            "recordsFiltered" => $this->M_Admin->count_filtered($dbTable),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    function get_ajax_event()
    {
        $this->cekLogin();
        $dbTable = "data_event";
        $list = $this->M_Admin->get_datatables($dbTable);
        $data = array();
        $no = @$_POST['start'];
        $noo = 0;
        if (count($list) > 0) {
            foreach ($list as $item) {
                $temp_event = $this->M_Admin->getEventByParent($item->parent_event);
                $date_event_price = [];
                $date_event = [];
                $price_event = [];
                $status_event = [];
                $today = date("Y-m-d");

                foreach ($temp_event as $e) {
                    $date_event[] = date_format(date_create(substr($e['event_date'], 0, 10)), "d/m/Y");
                    $price_event[] = "Rp" . number_format($e['price'], 0, ".", ".");
                    $temp_status = '';
                    if ($today > $e['event_date']) {
                        $temp_status = '<span class="badge badge-success">Finished</span>';
                    } elseif ($today == $e['event_date']) {
                        $temp_status = '<span class="badge badge-warning text-white">On Going</span>';
                    } else {
                        $temp_status = '<span class="badge badge-info">Upcoming</span>';
                    }
                    $status_event[] = $temp_status;
                    $date_event_price[] = date_format(date_create(substr($e['event_date'], 0, 10)), "d/m/Y") . '  -  ' . $temp_status;
                }
                $temp_member = '';
                if ($temp_event[0]['member'] == 1) {
                    $temp_member = "Teacher";
                } else {
                    $temp_member = "Student";
                }

                $row = array();
                $row[] = ++$no;
                $row[] = $temp_event[0]['event_name'];
                $row[] = implode("<br>", $date_event);
                $row[] = $temp_member;
                $row[] = implode("<br>", $status_event);
                $row[] = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop' . $item->parent_event . '"><i class="fa fa-info"></i></button>
                <div class="modal fade" id="staticBackdrop' . $item->parent_event . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel" style="font-weight:bold">Detail of Event</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Event Name
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . $temp_event[0]['event_name'] . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Event Date
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . implode("<br>", $date_event_price) . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Teacher / Student
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . $temp_member . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Event Price
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . implode("<br>", $price_event) . '
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="btn-group"><a href="' . site_url('portal/event/edit/' . $item->parent_event) . '" class="btn btn-xs btn-primary mr-2 btn-update" title="Edit Data ini"> <i class="fa fa-edit icon-white"></i> </a>
        <a href="' . site_url('portal/C_Admin/delete_data_event/' . $item->parent_event) . '" class="btn btn-danger" title="Hapus Data Ini" onclick=\'return confirm("are you sure want to delete this data?")\'><i class="fa fa-trash icon-white"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                ';
                $data[] = $row;
            }
        } else {
            $row = array();
            $row[] = '';
            $row[] = '';
            $row[] = 'No data available in table';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_Admin->count_all($dbTable),
            "recordsFiltered" => $this->M_Admin->count_filtered($dbTable),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    function get_ajax_event_teacher()
    {
        // $this->cekLogin();
        $dbTable = "register_event";
        $list = $this->M_Admin->get_datatables($dbTable,null,null,1);

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
            $row[] = $item->name_teacher;
            $row[] = $temp_event[0]['event_name'];
            $row[] = implode("<br>", $date_event);
            $row[] = $total_price;
            $row[] = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop' . $item->id_transaksi . '"><i class="fa fa-info"></i></button>
                <div class="modal fade" id="staticBackdrop' . $item->id_transaksi . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel" style="font-weight:bold">Detail of Event</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        No Transaksi
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . $item->no_transaksi_event . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Registration Date
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . date_format($date2, "d/m/Y") . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Event Name
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . $item->name_teacher . '
                                    </div>
                                </div>    
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Event Name
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . $temp_event[0]['event_name'] . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Event Date
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . implode("<br>", $date_event) . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Event Price
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . implode("<br>", $price_event) . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Price
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . $price . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Discount
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . $discount . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Total Price
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . $total_price . '
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="pl-4 pr-4">
                                <form action="' . site_url('portal/C_Admin/edit_event_teacher_discount') . '" method="POST">
                                    <div class="form-group">
                                        <label for="discount" class="col-form-label">Add Discount:</label>
                                        <input type="number" class="form-control" name="discount" id="discount" value="0">
                                        <input type="hidden" class="form-control" name="total_price" id="total_price" value="' . $item->total_price . '">
                                        <input type="hidden" class="form-control" name="no_transaksi_event" id="no_transaksi_event" value="' . $item->no_transaksi_event . '">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                    </div>
                                </form>
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
            "recordsTotal" => $this->M_Admin->count_all($dbTable, null, null, 1),
            "recordsFiltered" => $this->M_Admin->count_filtered($dbTable, null, null, 1),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    function get_ajax_event_student()
    {
        $this->cekLogin();
        $dbTable = "register_event";
        $list = $this->M_Admin->get_datatables($dbTable);

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
            $row[] = $item->name_student;
            $row[] = $temp_event[0]['event_name'];
            $row[] = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop' . $item->id_transaksi . '"><i class="fa fa-info"></i></button>
                <div class="modal fade" id="staticBackdrop' . $item->id_transaksi . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel" style="font-weight:bold">Detail of Event</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        No Transaksi
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . $item->no_transaksi_event . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Registration Date
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . date_format($date2, "d/m/Y") . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Event Name
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . $item->name_student . '
                                    </div>
                                </div>    
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Event Name
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . $temp_event[0]['event_name'] . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Event Date
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . implode("<br>", $date_event) . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Event Price
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . implode("<br>", $price_event) . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Price
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . $price . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Discount
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . $discount . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Total Price
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                        =
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . $total_price . '
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="btn-group"><a href="' . site_url('portal/C_Admin/delete_data_event_student/' . str_replace("/", "-", $item->no_transaksi_event)) . '" class="btn btn-danger" title="Hapus Data Ini" onclick=\'return confirm("are you sure want to delete this data?")\'><i class="fa fa-trash icon-white"></i></a></div>
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
            "recordsTotal" => $this->M_Admin->count_all($dbTable),
            "recordsFiltered" => $this->M_Admin->count_filtered($dbTable),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    function get_ajax_paket()
    {
        $this->cekLogin();
        $dbTable = "paket";
        $list = $this->M_Admin->get_datatables($dbTable);

        $data = array();
        $no = @$_POST['start'];
        $temp_id_parent = "";
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->name;

            $row[] = $item->description;
            $row[] = $item->status_pack_practical == 1 ? 'Yes' : 'No';
            $row[] = $item->status_pack_theory == 1 ? 'Yes' : 'No';
            // $row[] = $item->detail;
            // $row[] = $item->price_idr;

            $row[] = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop' . $item->id . '"><i class="fa fa-info"></i></button>
            <div class="modal fade" id="staticBackdrop' . $item->id . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel" style="font-weight:bold">Detail of Package</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Name of Package
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . $item->name . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Type of Class
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . $item->description . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Package Description
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . $item->detail . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    IDR Price
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                Rp ' . number_format($item->price_idr, 0, ".", ".")  . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Euro Price
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                € ' . $item->price_euro . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Dollar Price
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                $ ' . $item->price_dollar . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Duration
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . $item->duration . '`
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-group"><a href="' . site_url('portal/data_paket/edit/' . $item->id) . '" class="btn btn-xs btn-primary mr-2 btn-update" title="Edit Data ini"> <i class="fa fa-edit icon-white"></i> </a>
                            <a href="' . site_url('portal/C_Admin/delete_data_paket/' . $item->id) . '" class="btn btn-danger" title="Hapus Data Ini" onclick=\'return confirm("are you sure want to delete this data?")\'><i class="fa fa-trash icon-white"></i></a></div>
                        </div>

                    </div>
                </div>
            </div>
            ';

            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_Admin->count_all($dbTable),
            "recordsFiltered" => $this->M_Admin->count_filtered($dbTable),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    function get_ajax_sirkulasi($periode = null)
    {
        // $this->cekLogin();
        $dbTable = "sirkulasi";
        $list = $this->M_Admin->get_datatables($dbTable, null, $periode);
        $data = array();
        $no = @$_POST['start'];
        if (count($list) > 0) {
            foreach ($list as $item) {
                $parent = $this->M_Admin->getData_student(null, $item->is_id_parent);
                $row = array();
                $row[] = ++$no . ".";
                $row[] = date_format(date_create(substr($item->created_at, 0, 10)), "d/m/Y");
                $row[] = $item->no_transaksi;
                $row[] = $parent[0]['parent_student'];

                $date_invoice = date_format(date_create(substr($item->created_at, 0, 10)), "F Y");
                $link = "https://api.whatsapp.com/send?phone=62" . substr($parent[0]['phone_parent_1'], 1) . "&text=Thank%20you%20so%20much%20for%20being%20our%20loyal%20customer.%20You%20can%20access%20the%20invoice%20for%20(" . $date_invoice . ")%20lesson%20in%20here%20:%20" . site_url('portal/invoice/purchase/etude/' . md5($item->no_transaksi)) . "%20.%20Please%20write%20student's%20name%20on%20transfer%20description.%20Thank%20You.";

                $row[] = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop' . $item->id_sirkulasi . '"><i class="fa fa-info"></i></button>
            <div class="modal fade" id="staticBackdrop' . $item->id_sirkulasi . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel" style="font-weight:bold">Detail of Invoice</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Date
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . date_format(date_create(substr($item->created_at, 0, 10)), "d/m/Y") . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    No. Invoice
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . $item->no_transaksi . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Parent
                                </label>
                                <div class="col-lg-1 pt-2">
                                    =
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . $parent[0]['parent_student'] . '
                                </div>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <div class="btn-group"><a target="_blank" href="' . $link . '" class="btn btn-xs btn-success mr-2 btn-update" title="Open Data ini"> <i class="fa fa-whatsapp icon-white"></i> </a> <a target="_blank" href="' . site_url('portal/C_Admin/detail_invoice_purchase/' . str_replace("/", "", $item->no_transaksi)) . '" class="btn btn-xs btn-primary mr-2 btn-update" title="Open Data ini"> <i class="fas fa-file icon-white"></i> </a></div>
                        </div>

                    </div>
                </div>
            </div>
            ';
                $data[] = $row;
            }
        } else {
            $row = array();
            $row[] = '';
            $row[] = '';
            $row[] = 'No data available in table';
            $row[] = '';
            $row[] = '';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_Admin->count_all($dbTable, null, $periode),
            "recordsFiltered" => $this->M_Admin->count_filtered($dbTable, null, $periode),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    public function convert()
    {
        $this->cekLogin();
        $title = "Data Student | Portal Etude";
        $description = "Welcome to Portal Etude";
        $dollar = $this->M_Admin->getData_ConvertDollar();
        $euro = $this->M_Admin->getData_ConvertEuro();
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/convert', array('dollar' => $dollar, 'euro' => $euro));
        $this->load->view('portal/reuse/footer');
    }

    public function updateConvert($data)
    {
        $res = $this->M_Admin->updateDataConvert($data);
    }

    public function data_student()
    {
        $this->cekLogin();
        $title = "Data Student | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/data_student');
        $this->load->view('portal/reuse/footer');
    }

    public function detail_student($id_student)
    {
        $this->cekLogin();
        $student = $this->M_Admin->getData_student($id_student);
        $title = "Data Student | Portal Etude";
        $description = "Welcome to Portal Etude";

        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/detail_student', array('student' => $student));
        $this->load->view('portal/reuse/footer');
    }

    public function add_new_student()
    {
        $this->cekLogin();
        $title = "Data Student | Portal Etude";
        $description = "Welcome to Portal Etude";
        $student = $this->M_Admin->getData_student();
        $paket = $this->M_Admin->getData_paket();
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/student/add', array('student' => $student, 'paket' => $paket));
        $this->load->view('portal/reuse/footer');
    }

    public function add_student($choose)
    {
        $this->cekLogin();
        $title = "Data Student | Portal Etude";
        $description = "Welcome to Portal Etude";
        $student = $this->M_Admin->getData_student();
        $data['choose'] = $choose;
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/add_student', array('data' => $data, 'student' => $student));
        $this->load->view('portal/reuse/footer');
    }

    public function add_data_student()
    {
        $res = $this->M_Admin->insertDataStudent();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully added');
            redirect('portal/data_student');
        } else {
            $this->session->set_flashdata('warning', 'Failed to add data');
            redirect('portal/data_student');
        }
    }
    public function add_data_student2()
    {
        $res = $this->M_Admin->insertDataStudent2();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully added');
            redirect('portal/data_student');
        } else {
            $this->session->set_flashdata('warning', 'Failed to add data');
            redirect('portal/data_student');
        }
    }

    public function edit_student($id_student)
    {
        $this->cekLogin();
        $student = $this->M_Admin->getData_student($id_student);
        // $student = $this->M_Portal->get_student(" where id_student = '$id_student'");
        $title = "Data Student | Portal Etude";
        $description = "Welcome to Portal Etude";

        // $data['id_student'] = $id_student;
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'student' => $student));
        $this->load->view('portal/admin/edit_student', array('student' => $student));
        $this->load->view('portal/reuse/footer');
    }

    public function edit_student_2($id_student)
    {
        $this->cekLogin();
        $student = $this->M_Admin->getData_student($id_student);
        // $student = $this->M_Portal->get_student(" where id_student = '$id_student'");
        $title = "Data Student | Portal Etude";
        $description = "Welcome to Portal Etude";

        // $data['id_student'] = $id_student;
        $paket = $this->M_Admin->getData_paket();
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'student' => $student));
        $this->load->view('portal/admin/student/edit', array('student' => $student, 'paket' => $paket));
        $this->load->view('portal/reuse/footer');
    }

    public function edit_data_student()
    {
        $res = $this->M_Admin->updateDataStudent();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully updated');
            redirect('portal/data_student');
        } else {
            $this->session->set_flashdata('warning', 'Failed to update data');
            redirect('portal/data_student');
        }
    }
    public function edit_data_student2()
    {
        $res = $this->M_Admin->updateDataStudent2();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully updated');
            redirect('portal/data_student/detail/' . $this->input->post('id_student'));
        } else {
            $this->session->set_flashdata('warning', 'Failed to update data');
            redirect('portal/data_student/detail/' . $this->input->post('id_student'));
        }
    }

    function delete_data_student($id_student)
    {
        $res = $this->M_Admin->deleteDataStudent($id_student);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully deleted');
            redirect('portal/data_student');
        } else {
            $this->session->set_flashdata('warning', 'Failed to delete data');
            redirect('portal/data_student');
        }
    }

    function delete_data_teacher($id_teacher)
    {
        $res = $this->M_Admin->deleteDataTeacher($id_teacher);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully deleted');
            redirect('portal/data_teacher');
        } else {
            $this->session->set_flashdata('warning', 'Failed to delete data');
            redirect('portal/data_teacher');
        }
    }

    public function data_teacher()
    {
        $this->cekLogin();
        $title = "Data teacher | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/data_teacher');
        $this->load->view('portal/reuse/footer');
    }

    public function data_paket()
    {
        $this->cekLogin();
        $title = "Data Package | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/data_paket');
        $this->load->view('portal/reuse/footer');
    }

    public function add_paket()
    {
        $this->cekLogin();
        $title = "Add Data Package | Portal Etude";
        $description = "Welcome to Portal Etude";

        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/paket/add');
        $this->load->view('portal/reuse/footer');
    }

    public function add_data_paket()
    {
        $res = $this->M_Admin->insertDataPaket();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully added');
            redirect('portal/data_paket');
        } else {
            $this->session->set_flashdata('warning', 'Failed to add data');
            redirect('portal/data_paket');
        }
    }

    public function edit_paket($id)
    {
        $this->cekLogin();
        $title = "edit Data Package | Portal Etude";
        $description = "Welcome to Portal Etude";
        $paket = $this->M_Admin->getData_paket($id);

        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/paket/edit', array('paket' => $paket));
        $this->load->view('portal/reuse/footer');
    }

    public function edit_data_paket()
    {
        $res = $this->M_Admin->updateDataPaket();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully updated');
            redirect('portal/data_paket');
        } else {
            $this->session->set_flashdata('warning', 'Failed to update data');
            redirect('portal/data_paket');
        }
    }

    function delete_data_paket($id)
    {
        $res = $this->M_Admin->deleteDataPaket($id);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully deleted');
            redirect('portal/data_paket');
        } else {
            $this->session->set_flashdata('warning', 'Failed to delete data');
            redirect('portal/data_paket');
        }
    }

    public function update_data_sirkulasi($id_sirkulasi)
    {
        $discount = $_POST['discount'];
        $total_rate = $_POST['total_rate'];
        $res = $this->M_Admin->updateDataSirkulasi($id_sirkulasi, $discount, $total_rate);
    }

    function delete_data_sirkulasi($id_sirkulasi)
    {
        $res = $this->M_Admin->deleteDataSirkulasi($id_sirkulasi);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully deleted');
            redirect('portal/C_Admin/data_invoice_purchase');
        } else {
            $this->session->set_flashdata('warning', 'Failed to delete data');
            redirect('portal/C_Admin/data_invoice_purchase');
        }
    }

    public function data_offline_lesson()
    {
        $this->cekLogin();
        $title = "Data offline_lesson | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/data_offline_lesson');
        $this->load->view('portal/reuse/footer');
    }

    public function add_offline_lesson()
    {
        $this->cekLogin();
        $teacher = $this->M_Admin->getData_teacher();
        $student = $this->M_Admin->getData_student();
        $paket = $this->M_Admin->getData_paket(null, 2);
        $title = "Data offline_lesson | Portal Etude";
        $description = "Welcome to Portal Etude";

        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/add_offline_lesson', array('teacher' => $teacher, 'student' => $student, 'paket' => $paket));
        $this->load->view('portal/reuse/footer');
    }

    public function add_data_offline_lesson()
    {
        $res = $this->M_Admin->insertDataOfflineLesson();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully added');
            redirect('portal/data_offline_lesson');
        } else {
            $this->session->set_flashdata('warning', 'Failed to add data');
            redirect('portal/data_offline_lesson');
        }
    }

    public function edit_offline_lesson($id_offline_lesson)
    {
        $this->cekLogin();
        $teacher = $this->M_Admin->getData_teacher();
        $student = $this->M_Admin->getData_student();
        $offline_lesson = $this->M_Admin->getData_offline_lesson($id_offline_lesson);
        $paket = $this->M_Admin->getData_paket(null, 2);
        $title = "Data offline_lesson | Portal Etude";
        $description = "Welcome to Portal Etude";

        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/edit_offline_lesson', array('teacher' => $teacher, 'student' => $student, 'offline_lesson' => $offline_lesson, 'paket' => $paket));
        $this->load->view('portal/reuse/footer');
    }

    public function edit_data_offline_lesson()
    {
        $res = $this->M_Admin->updateDataOfflineLesson();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully updated');
            redirect('portal/data_offline_lesson');
        } else {
            $this->session->set_flashdata('warning', 'Failed to update data');
            redirect('portal/data_offline_lesson');
        }
    }

    function delete_data_offline_lesson($id_offline_lesson)
    {
        $res = $this->M_Admin->deleteDataOfflineLesson($id_offline_lesson);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully deleted');
            redirect('portal/data_offline_lesson');
        } else {
            $this->session->set_flashdata('warning', 'Failed to delete data');
            redirect('portal/data_offline_lesson');
        }
    }


    public function data_online_pratical()
    {
        $this->cekLogin();
        $online_pratical = $this->M_Portal->get_online_pratical();
        $title = "Data Online Lesson | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'online_pratical' => $online_pratical));
        $this->load->view('portal/admin/data_online_pratical', $online_pratical);
        $this->load->view('portal/reuse/footer');
    }

    public function data_online_pratical_theory()
    {
        $this->cekLogin();
        $online_pratical = $this->M_Portal->get_online_pratical();
        $title = "Data Online Lesson | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'online_pratical' => $online_pratical));
        $this->load->view('portal/admin/data_online/data_theory', $online_pratical);
        $this->load->view('portal/reuse/footer');
    }

    public function data_online_pratical_practice()
    {
        $this->cekLogin();
        $online_pratical = $this->M_Portal->get_online_pratical();
        $title = "Data Online Lesson | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'online_pratical' => $online_pratical));
        $this->load->view('portal/admin/data_online/data_practice', $online_pratical);
        $this->load->view('portal/reuse/footer');
    }

    public function add_online_pratical()
    {
        $this->cekLogin();
        $teacher = $this->M_Admin->getData_teacher();
        $student = $this->M_Admin->getData_student();
        $paket = $this->M_Admin->getData_paket_online();

        $title = "Data Online Lesson | Portal Etude";
        $description = "Welcome to Portal Etude";

        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/add_package', array('teacher' => $teacher, 'student' => $student, 'paket' => $paket));
        $this->load->view('portal/reuse/footer');
    }

    public function add_data_online_pratical()
    {
        $res = $this->M_Admin->insertDataPackage();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully added');
            redirect('portal/data_online_lesson');
        } else {
            $this->session->set_flashdata('warning', 'Failed to add data');
            redirect('portal/data_online_lesson');
        }
    }

    public function edit_online_pratical($id_online_pratical)
    {
        $this->cekLogin();
        $teacher = $this->M_Admin->getData_teacher();
        $student = $this->M_Admin->getData_student();
        $online_pratical = $this->M_Admin->getData_list_pack($id_online_pratical);
        $paket = $this->M_Admin->getData_paket();
        $title = "Data Online Lesson | Portal Etude";
        $description = "Welcome to Portal Etude";

        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/edit_online_pratical', array('teacher' => $teacher, 'student' => $student, 'online_pratical' => $online_pratical, 'paket' => $paket));
        $this->load->view('portal/reuse/footer');
    }

    public function edit_data_online_pratical()
    {
        $res = $this->M_Admin->updateDataPackage();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully updated');
            redirect('portal/data_online_lesson');
        } else {
            $this->session->set_flashdata('warning', 'Failed to update data');
            redirect('portal/data_online_lesson');
        }
    }

    function delete_data_online_pratical($id_pack, $no_transaksi_package)
    {
        $temp_no_transaksi = str_replace("-", "/", $no_transaksi_package);
        $res = $this->M_Admin->deleteDataPackage($id_pack, $temp_no_transaksi);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully deleted');
            redirect('portal/data_online_lesson');
        } else {
            $this->session->set_flashdata('warning', 'Failed to delete data');
            redirect('portal/data_online_lesson');
        }
    }

    public function package_calendar($id_package)
    {
        $this->cekLogin();
        $id_teacher_pratical = "";
        $id_teacher_theory = "";
        $pack_online = $this->M_Admin->getData_list_pack($id_package);
        $schedule_pack = $this->M_Admin->getData_schedule_package(null, $id_package, 0);
        $count_theory = [];
        $count_pratical = [];

        $feereport_pratical = [];
        $feereport_theory = [];
        foreach($pack_online as $p){
            if($p['status_pack_practical'] == "1"){
                $id_teacher_pratical = $p['id_teacher_practical'];
                $feereport_pratical = $this->M_Teacher->getData_sirkulasi_feereport(null, null, null, $id_teacher_pratical);
            }
            if ($p['status_pack_theory'] == "1") {
                $id_teacher_theory = $p['id_teacher_practical'];
                $feereport_theory = $this->M_Teacher->getData_sirkulasi_feereport(null, null, null, $id_teacher_theory);
            }
            
        }
        foreach ($schedule_pack as $so) {
            if ($so['status'] == 2 || ($so['status'] == 3 && $so['date_update_cancel'] != NULL)) {
                if ($so['jenis'] == 1) {
                    $count_pratical[] = $so['id_schedule_pack'];
                }
                if ($so['jenis'] == 2) {
                    $count_theory[] = $so['id_schedule_pack'];
                }
            }
        }

        // $feereport = $this->M_Teacher->getData_sirkulasi_feereport(null, null, null, $schedule_pack[0]['id_teacher']);
        // echo "<br>";
        // echo "<br>";
        // echo var_dump($pack_online);
        // echo "<br>";echo "<br>";
        // echo var_dump($feereport_pratical);
        // echo "<br>";echo "<br>";
        // echo var_dump($feereport_theory);
        // echo "<br>";
        // echo "<br>";
        // echo var_dump($feereport);
        // echo $schedule_pack[0]['id_teacher'];

        $title = "Data Online Lesson | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/package_calendar', array('pack_online' => $pack_online, 'schedule_pack' => $schedule_pack, 'count_theory' => $count_theory, 'count_pratical' => $count_pratical, 'feereport_pratical' => $feereport_pratical, 'feereport_theory' => $feereport_theory));
        $this->load->view('portal/reuse/footer');
    }

    public function load_package($id_list_pack)
    {
        $event_data = $this->M_Admin->fetch_all_package($id_list_pack);
        foreach ($event_data->result_array() as $row) {
            $title = '';
            $color = '';
            if ($row['jenis'] == 1) {
                if ($row['status'] == 1) {
                    $title = 'Undone';
                    $color = '#f0a500';
                }
                if ($row['status'] == 2) {
                    $title = 'Done';
                    $color = '#fddb3a';
                }
                if ($row['status'] == 3) {
                    $title = 'Cancel';
                    $color = '#ff4b5c';
                }
                if ($row['status'] == 4) {
                    $title = 'New Schedule';
                    $color = '#54a0ff';
                }
                if ($row['status'] == 5 ) {
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
                    $color = '#056676';
                }
                if ($row['status'] == 2) {
                    $title = 'Done';
                    $color = '#5eaaa8';
                }
                if ($row['status'] == 3) {
                    $title = 'Cancel';
                    $color = '#ff4b5c';
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
        foreach ($event_data->result_array() as $row) {
            if ($row['status'] == 3 && $row['date_update_cancel'] != NULL) {
                $title = 'Reschedule';
                $color = '#10ac84';
                $temp_date = $row['date_update_cancel'];
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
            
        }
        echo json_encode($data);
    }

    public function insert_schedule_package()
    {
        $id_list_pack = $this->input->post('id_list_pack');
        $data = array(
            'id_teacher'  => $this->input->post('id_teacher'),
            'id_student'  => $this->input->post('id_student'),
            'id_list_pack'  => $this->input->post('id_list_pack'),
            'date_schedule' => $this->input->post('tgl'),
            'status' => $this->input->post('status'),
            'jenis' => $this->input->post('jenis'),
        );
        $data2 = $this->M_Admin->insert_event_schedule_package($data);
        $pack_online = $this->M_Admin->getData_list_pack($id_list_pack);
        $schedule_pack = $this->M_Admin->getData_schedule_package(null, $id_list_pack, 0);
        $count_theory = [];
        $count_pratical = [];
        foreach ($schedule_pack as $so) {
            if ($so['jenis'] == 1) {
                $count_pratical[] = $so['id_schedule_pack'];
            }
            if ($so['jenis'] == 2) {
                $count_theory[] = $so['id_schedule_pack'];
            }
        }
        $total_pack_pratical = $pack_online[0]['total_pack_practical'];
        $total_pack_theory = $pack_online[0]['total_pack_theory'];
        $count1 = intval($total_pack_pratical) - intval(count($count_pratical));
        $count2 = intval($total_pack_theory) - intval(count($count_theory));
        $temp_event[] = "Total Practical Meeting = ";
        $temp_event[] = '<span class="badge badge-primary" id="total_practical_meet">' . $count1 . ' lesson</span>';
        $temp_event[] = '<input type="hidden" id="countPractical" name="countPractical" value="' . $count1 . '">';
        $temp_event[] = "<br>";
        $temp_event[] = "Total Theory Meeting = ";
        $temp_event[] = '<span class="badge badge-primary" id="total_theory_meet">' . $count2 . ' lesson<span>';
        $temp_event[] = '<input type="hidden" id="countTheory" name="countTheory" value="' . $count2 . '">';

        $event_join = implode(" ", $temp_event);
        echo $event_join;
    }
    function update_schedule_package()
    {
        $id_list_pack = $this->input->post('id_list_pack');
        $data = array(
            'id_teacher'  => $this->input->post('id_teacher'),
            'id_student'  => $this->input->post('id_student'),
            'id_list_pack'  => $this->input->post('id_list_pack'),
            'date_schedule' => $this->input->post('tgl'),
            'status' => $this->input->post('status'),
            'jenis' => $this->input->post('jenis'),
        );
        $data2 = $this->M_Admin->update_event_schedule_package($data, $this->input->post('id_schedule_online'));

        $pack_online = $this->M_Admin->getData_list_pack($id_list_pack);
        $schedule_pack = $this->M_Admin->getData_schedule_package(null, $id_list_pack, 0);
        $count_theory = [];
        $count_pratical = [];
        foreach ($schedule_pack as $so) {
            if ($so['jenis'] == 1) {
                $count_pratical[] = $so['id_schedule_pack'];
            }
            if ($so['jenis'] == 2) {
                $count_theory[] = $so['id_schedule_pack'];
            }
        }
        $total_pack_pratical = $pack_online[0]['total_pack_practical'];
        $total_pack_theory = $pack_online[0]['total_pack_theory'];
        $count1 = intval($total_pack_pratical) - intval(count($count_pratical));
        $count2 = intval($total_pack_theory) - intval(count($count_theory));
        $temp_event[] = "Total Practical Meeting = ";
        $temp_event[] = '<span class="badge badge-primary">' . $count1 . ' lesson</span>';
        $temp_event[] = '<input type="hidden" id="countPractical" name="countPractical" value="' . $count1 . '">';
        $temp_event[] = "<br>";
        $temp_event[] = "Total Theory Meeting = ";
        $temp_event[] = '<span class="badge badge-primary">' . $count2 . ' lesson<span>';
        $temp_event[] = '<input type="hidden" id="countTheory" name="countTheory" value="' . $count2 . '">';

        $event_join = implode(" ", $temp_event);
        echo $event_join;

        // echo json_encode($data2);
    }

    function delete_schedule_package()
    {
        $data2 = $this->M_Admin->delete_event_schedule_package($this->input->post('id_schedule_online'));
        // echo json_encode($data2);

        $id_list_pack = $this->input->post('id_list_pack');
        $pack_online = $this->M_Admin->getData_list_pack($id_list_pack);
        $schedule_pack = $this->M_Admin->getData_schedule_package(null, $id_list_pack, 0);
        $count_theory = [];
        $count_pratical = [];
        foreach ($schedule_pack as $so) {
            if ($so['jenis'] == 1) {
                $count_pratical[] = $so['id_schedule_pack'];
            }
            if ($so['jenis'] == 2) {
                $count_theory[] = $so['id_schedule_pack'];
            }
        }
        $total_pack_pratical = $pack_online[0]['total_pack_practical'];
        $total_pack_theory = $pack_online[0]['total_pack_theory'];
        $count1 = intval($total_pack_pratical) - intval(count($count_pratical));
        $count2 = intval($total_pack_theory) - intval(count($count_theory));
        $temp_event[] = "Total Practical Meeting = ";
        $temp_event[] = '<span class="badge badge-primary">' . $count1 . ' lesson</span>';
        $temp_event[] = '<input type="hidden" id="countPractical" name="countPractical" value="' . $count1 . '">';
        $temp_event[] = "<br>";
        $temp_event[] = "Total Theory Meeting = ";
        $temp_event[] = '<span class="badge badge-primary">' . $count2 . ' lesson<span>';
        $temp_event[] = '<input type="hidden" id="countTheory" name="countTheory" value="' . $count2 . '">';

        $event_join = implode(" ", $temp_event);
        echo $event_join;
    }

    public function data_online_pratical_package()
    {
        $this->cekLogin();
        $online_pratical = $this->M_Portal->get_online_pratical();
        $title = "Data Online Lesson | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'online_pratical' => $online_pratical));
        $this->load->view('portal/admin/data_online_pratical_package', $online_pratical);
        $this->load->view('portal/reuse/footer');
    }

    public function data_online_theory()
    {
        $this->cekLogin();
        $title = "Data Theory Lesson | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/data_online_theory');
        $this->load->view('portal/reuse/footer');
    }

    public function add_online_theory()
    {
        $this->cekLogin();
        $teacher = $this->M_Admin->getData_teacher();
        $student = $this->M_Admin->getData_student();
        $title = "Data Theory Lesson | Portal Etude";
        $description = "Welcome to Portal Etude";

        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/add_online_theory', array('teacher' => $teacher, 'student' => $student));
        $this->load->view('portal/reuse/footer');
    }

    public function add_data_online_theory()
    {
        $res = $this->M_Admin->insertDataOnlineTheory();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully added');
            redirect('portal/data_theory_lesson');
        } else {
            $this->session->set_flashdata('warning', 'Failed to add data');
            redirect('portal/data_theory_lesson');
        }
    }

    public function edit_online_theory($id_online_theory)
    {
        $this->cekLogin();
        $teacher = $this->M_Admin->getData_teacher();
        $student = $this->M_Admin->getData_student();
        $online_theory = $this->M_Admin->getData_online_theory($id_online_theory);
        $title = "Data Theory Lesson | Portal Etude";
        $description = "Welcome to Portal Etude";

        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/edit_online_theory', array('teacher' => $teacher, 'student' => $student, 'online_theory' => $online_theory));
        $this->load->view('portal/reuse/footer');
    }

    public function edit_data_online_theory()
    {
        $res = $this->M_Admin->updateDataOnlineTheory();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully updated');
            redirect('portal/data_theory_lesson');
        } else {
            $this->session->set_flashdata('warning', 'Failed to update data');
            redirect('portal/data_theory_lesson');
        }
    }

    function delete_data_online_theory($id_online_theory)
    {
        $res = $this->M_Admin->deleteDataOnlineTheory($id_online_theory);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully deleted');
            redirect('portal/data_theory_lesson');
        } else {
            $this->session->set_flashdata('warning', 'Failed to delete data');
            redirect('portal/data_theory_lesson');
        }
    }

    public function book()
    {
        $this->cekLogin();
        $title = "Data book | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/data_book');
        $this->load->view('portal/reuse/footer');
    }

    public function add_book()
    {
        $this->cekLogin();
        $title = "Add Data book | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/add_book');
        $this->load->view('portal/reuse/footer');
    }

    public function add_data_book()
    {
        $res = $this->M_Admin->insertDataBook();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully added');
            redirect('portal/book');
        } else {
            $this->session->set_flashdata('warning', 'Failed to add data');
            redirect('portal/book');
        }
    }

    public function edit_book($id_book)
    {
        $this->cekLogin();
        $book = $this->M_Admin->getData_book($id_book);
        $title = "Data book | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'book' => $book));
        $this->load->view('portal/admin/edit_book', $book);
        $this->load->view('portal/reuse/footer');
    }

    public function edit_data_book()
    {
        $res = $this->M_Admin->updateDataBook();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully updated');
            redirect('portal/book');
        } else {
            $this->session->set_flashdata('warning', 'Failed to update data');
            redirect('portal/book');
        }
    }

    function delete_data_book($id_book)
    {
        $res = $this->M_Admin->deleteDataBook($id_book);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully deleted');
            redirect('portal/book');
        } else {
            $this->session->set_flashdata('warning', 'Failed to delete data');
            redirect('portal/book');
        }
    }

    public function book_order()
    {
        $this->cekLogin();
        $title = "Data book order | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/data_book_order');
        $this->load->view('portal/reuse/footer');
    }

    public function add_book_order()
    {
        $this->cekLogin();
        $title = "Add book order | Portal Etude";
        $description = "Welcome to Portal Etude";
        $student = $this->M_Admin->getData_student();
        $book = $this->M_Admin->getData_book(null, 'cek');
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/add_book_order', array('student' => $student, 'book' => $book));
        $this->load->view('portal/reuse/footer');
    }

    public function add_data_book_order()
    {   
        if($this->input->post('id_student') == ""){
            $this->session->set_flashdata('warning', 'Not Select Student');
            redirect('portal/book/sell');
        }
        if ($this->input->post('id_book') == "") {
            $this->session->set_flashdata('warning', 'Not Select Book');
            redirect('portal/book/sell');
        }
        $res = $this->M_Admin->insertDataBookOrder();
        $res2 = $this->M_Admin->updateDataStockBook();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully added');
            redirect('portal/book/sell');
        } else {
            $this->session->set_flashdata('warning', 'Failed to add data');
            redirect('portal/book/sell');
        }
    }

    public function edit_book_order($id_order)
    {
        $this->cekLogin();
        $book_order = $this->M_Admin->getData_order_book($id_order);
        $temp_student = $this->M_Admin->getData_student($book_order[0]['id_student']);
        $book_order[0]['name_student'] = $temp_student[0]['name_student'];

        $book = $this->M_Admin->getData_book(null, 'cek');
        $temp_book = $this->M_Admin->getData_book2($book_order[0]['id_book']);
        $book_order[0]['title'] = $temp_book[0]['title'];
        $book_order[0]['qty_before'] = $temp_book[0]['qty'];

        $student = $this->M_Admin->getData_student();

        // echo var_dump($book_order);
        // echo var_dump($book);

        // die();
        $title = "Data book | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'book' => $book));
        $this->load->view('portal/admin/edit_book_order', array('book_order' => $book_order, 'book' => $book, 'student' => $student));
        $this->load->view('portal/reuse/footer');
    }

    public function edit_data_book_order()
    {
        $res = $this->M_Admin->updateDataBookOrder();
        $res2 = $this->M_Admin->updateDataStockBook();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully updated');
            redirect('portal/book/sell');
        } else {
            $this->session->set_flashdata('warning', 'Failed to update data');
            redirect('portal/book/sell');
        }
    }

    function delete_data_book_order($id_order, $id_book, $qty, $no_transaksi_book)
    {
        $temp_no_transaksi = str_replace("-", "/", $no_transaksi_book);
        $res = $this->M_Admin->deleteDataBookOrder($id_order, $id_book, $qty, $temp_no_transaksi);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully deleted');
            redirect('portal/book/sell');
        } else {
            $this->session->set_flashdata('warning', 'Failed to delete data');
            redirect('portal/book/sell');
        }
    }

    public function book_purchase()
    {
        $this->cekLogin();
        $title = "Data book purchase | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/data_book_purchase');
        $this->load->view('portal/reuse/footer');
    }

    public function add_book_purchase()
    {
        $this->cekLogin();
        $title = "Add book purchase | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/add_book_purchase');
        $this->load->view('portal/reuse/footer');
    }

    // public function test_dulu($title, $publisher, $qty, $distributor, $distributor_price)
    // {
    //     $test = $this->M_Admin->getData_booksame($title, $publisher, $qty, $distributor, $distributor_price);
    //     // echo var_dump($test);
    //     echo var_dump($test[0]['id_book']);
    //     $temp_qty = intval($test[0]['qty']) + intval($qty);
    //     echo "$temp_qty";
    // }
    public function add_data_book_purchase()
    {
        $res = $this->M_Admin->insertDataBookPurchase();
        $res2 = $this->M_Admin->insertDataBook();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully added');
            redirect('portal/book/input');
        } else {
            $this->session->set_flashdata('warning', 'Failed to add data');
            redirect('portal/book/input');
        }
    }

    public function edit_book_purchase($id_purchase)
    {
        $this->cekLogin();
        $title = "Data book | Portal Etude";
        $description = "Welcome to Portal Etude";
        $book_purchase = $this->M_Admin->getData_book_purchase($id_purchase);
        $book_stock = $this->M_Admin->getData_booksame($book_purchase[0]['title'], $book_purchase[0]['publisher'], $book_purchase[0]['distributor'], $book_purchase[0]['distributor_price'], $book_purchase[0]['selling_price'], $book_purchase[0]['shipping_rate']);

        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/edit_book_purchase', array('book_purchase' => $book_purchase, 'book_stock' => $book_stock));
        $this->load->view('portal/reuse/footer');
    }

    public function edit_data_book_purchase()
    {
        $res = $this->M_Admin->updateDataBookPurchase();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully updated');
            redirect('portal/book/input');
        } else {
            $this->session->set_flashdata('warning', 'Failed to update data');
            redirect('portal/book/input');
        }
    }

    function delete_data_book_purchase($id_purchase)
    {
        $res = $this->M_Admin->deleteDataBookPurchase($id_purchase);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully deleted');
            redirect('portal/book/input');
        } else {
            $this->session->set_flashdata('warning', 'Failed to delete data');
            redirect('portal/book/input');
        }
    }

    public function event()
    {
        $this->cekLogin();
        $title = "Data event | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/data_event');
        $this->load->view('portal/reuse/footer');
    }

    public function add_event()
    {
        $this->cekLogin();
        $title = "Data add_event | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/add_event');
        $this->load->view('portal/reuse/footer');
    }

    public function add_data_event()
    {
        $res = $this->M_Admin->insertDataEvent();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully added');
            redirect('portal/event');
        } else {
            $this->session->set_flashdata('warning', 'Failed to add data');
            redirect('portal/event');
        }
    }

    public function edit_event($parent_event)
    {
        $this->cekLogin();
        $event = $this->M_Admin->getData_event(null, null, $parent_event);
        $event_child = $this->M_Admin->getEventByParent($parent_event);
        $title = "Data event | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/edit_event', array('event' => $event, 'event_child' => $event_child));
        $this->load->view('portal/reuse/footer');
    }

    public function edit_data_event()
    {
        $res = $this->M_Admin->updateDataEvent();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully updated');
            redirect('portal/event');
        } else {
            $this->session->set_flashdata('warning', 'Failed to update data');
            redirect('portal/event');
        }
    }

    function delete_data_event($parent_event)
    {
        $res = $this->M_Admin->deleteDataevent($parent_event);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully deleted');
            redirect('portal/event');
        } else {
            $this->session->set_flashdata('warning', 'Failed to delete data');
            redirect('portal/event');
        }
    }

    function delete_data_event_detail($id_event)
    {
        $res = $this->M_Admin->deleteDataEventDetail($id_event);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully deleted');
            redirect('portal/event');
        } else {
            $this->session->set_flashdata('warning', 'Failed to delete data');
            redirect('portal/event');
        }
    }


    public function event_teacher()
    {
        $this->cekLogin();
        $title = "Data event Teacher | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/data_event_teacher');
        $this->load->view('portal/reuse/footer');
    }

    public function edit_event_teacher_discount()
    {
        $res = $this->M_Admin->updateDataEventTeacherDiscount();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully updated');
            redirect('portal/event/teacher');
        } else {
            $this->session->set_flashdata('warning', 'Failed to update data');
            redirect('portal/event/teacher');
        }
    }

    public function event_student()
    {
        $this->cekLogin();
        $title = "Data event Student | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/data_event_student');
        $this->load->view('portal/reuse/footer');
    }

    public function add_event_student()
    {
        $this->cekLogin();
        $title = "Data add_event_student | Portal Etude";
        $description = "Welcome to Portal Etude";
        $event = $this->M_Admin->getData_event(null, 2);
        $student = $this->M_Admin->getData_student();
        $event_student = $this->M_Admin->getData_detail_event_student();
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/add_event_student', array('event' => $event, 'event_student' => $event_student, 'student' => $student));
        $this->load->view('portal/reuse/footer');
    }

    public function filter_event_student()
    {
        $id_student = $_POST['value'];
        $today = date("Y-m-d");
        $event_student = $this->M_Admin->getData_detail_event_student();
        $temp_event_student = [];
        $temp_event = [];
        $event = [];
        foreach ($event_student as $es) :
            if ($es['id_user'] == $id_student) {
                $temp_event_student[] = $es['id_event'];
            }
        endforeach;
        if (count($temp_event_student) != 0) {
            $event_join = implode("-", $temp_event_student);
            $event = $this->M_Admin->getData_event_filter($event_join, $today);
        } else {
            $event = $this->M_Admin->getData_event_filter(null, $today);
        }
        if ($_POST['data'] != null) {
            $event2 = $this->M_Admin->getData_event($_POST['data'], 2);
            foreach ($event2 as $e) :
                $temp_event[] = "<option value='" .  $e['parent_event'] . "/" . substr($e['event_date'], 0, 10) . "/" . $e['price'] . "'>" . $e['event_name'] . "</option>";
            endforeach;
        } else {
            // $temp_event[] = "<option value=''>Choose</option>";
        }
        $temp_parent_event = "";
        // echo var_dump($temp_event_student);
        // echo "<br>";
        // echo "<br>";
        // echo "<br>";
        // echo var_dump($event);
        // echo "<br>";
        // echo "<br>";
        // echo "<br>";
        $temp_event[] = "<option value=''>Choose</option>";
        foreach ($event as $e) :
            if ($temp_parent_event != $e['parent_event']) {
                $event_join = implode("-", $temp_event_student);
                $child = $this->M_Admin->getEventByParent($e['parent_event'], $event_join);
                $temp_child = 1;
                $temp_value = [];
                $value = "";
                if (count($child) > 1) {
                    foreach ($child as $c) {
                        if ($e['id_event'] != $c['id_event']) {
                            $temp_child = $temp_child + 1;
                            $temp_value[] = $c['id_event'] . "<" . $c['parent_event'] . "<" . substr($c['event_date'], 0, 10) . "<" . $c['price'];
                        }
                    };
                    $value = implode("<", $temp_value);
                }
                // echo "<br>";
                // echo ($temp_child);
                // echo var_dump($child);
                // echo "<br>";
                // echo $value;
                $temp_event[] = "<option value='" .  $e['id_event'] . "<" . $e['parent_event'] . "<" . substr($e['event_date'], 0, 10) . "<" . $e['price'] . "<" . $temp_child .  "<" . $value . "'>" . $e['event_name'] . "</option>";
            }
            $temp_parent_event = $e['parent_event'];
        endforeach;
        $event_join = implode(" ", $temp_event);
        echo $event_join;
    }

    public function add_data_event_student()
    {
        $res = $this->M_Admin->insertDataEventStudent();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully added');
            redirect('portal/event/student');
        } else {
            $this->session->set_flashdata('warning', 'Failed to add data');
            redirect('portal/event/student');
        }
    }

    public function edit_event_student($id_event_student)
    {
        $this->cekLogin();
        $event_student = $this->M_Admin->getData_event_student($id_event_student);
        $event = $this->M_Admin->getData_event(null, 2);
        $student = $this->M_Admin->getData_student();

        $temp_student = $this->M_Admin->getData_student($event_student[0]['id_student']);
        $event_student[0]['name_student'] = $temp_student[0]['name_student'];

        $temp_event = $this->M_Admin->getData_event($event_student[0]['id_event']);
        $event_student[0]['event_name'] = $temp_event[0]['event_name'];
        $event_student[0]['event_date'] = $temp_event[0]['event_date'];

        $title = "Data event | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/edit_event_student', array('event' => $event, 'student' => $student, 'event_student' => $event_student));
        $this->load->view('portal/reuse/footer');
    }

    public function edit_data_event_student()
    {
        $res = $this->M_Admin->updateDataEventStudent();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully updated');
            redirect('portal/event/student');
        } else {
            $this->session->set_flashdata('warning', 'Failed to update data');
            redirect('portal/event/student');
        }
    }

    function delete_data_event_student($no_transaksi_event)
    {
        $temp_no_transaksi = str_replace("-", "/", $no_transaksi_event);
        $res = $this->M_Admin->deleteDataEventStudent($temp_no_transaksi);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully deleted');
            redirect('portal/event/student');
        } else {
            $this->session->set_flashdata('warning', 'Failed to delete data');
            redirect('portal/event/student');
        }
    }


    public function note()
    {
        $this->cekLogin();
        $note = $this->M_Admin->getData_note();
        $note_temp = [];
        foreach ($note as $n) {
            $note_temp[] = substr($n['date'], 0, 7);
        }

        $note_temp = array_unique($note_temp);
        $note_temp_im = implode(".", $note_temp);
        $note_temp_ex = explode(".", $note_temp_im);
        sort($note_temp_ex);

        $title = "Data note | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/note', array('note_temp' => $note_temp_ex));
        $this->load->view('portal/reuse/footer');
    }

    public function note_periode($periode)
    {
        $this->cekLogin();
        $id_note = null;
        $note = $this->M_Admin->getData_note($id_note, $periode);
        $note_temp = [];
        foreach ($note as $n) {
            $note_temp[] = $n['id_teacher'] . "-" . $n['name_teacher'];
        }
        $note_temp = array_unique($note_temp);
        $note_temp_im = implode(".", $note_temp);
        $note_temp_ex = explode(".", $note_temp_im);
        sort($note_temp_ex);

        $title = "Data note | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/note_periode', array('note_temp' => $note_temp_ex));
        $this->load->view('portal/reuse/footer');
    }

    public function note_teacher($periode, $id_teacher)
    {
        $this->cekLogin();
        $id_note = null;
        $note = $this->M_Admin->getData_note($id_note, $periode, $id_teacher);

        $title = "Data note | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/note_teacher', array('note' => $note));
        $this->load->view('portal/reuse/footer');
    }

    // public function testlah()
    // {
    //     $event_student = $this->M_Admin->getData_event_student();
    //     $invoice_temp = [];
    //     foreach ($event_student as $n) {
    //         $temp_month =  substr($n['event_date'], 0, 7) . "-07";
    //         $periode = substr($n['event_date'], 0, 7);
    //         echo substr($n['event_date'], 0, 10) . " - ";
    //         echo $temp_month . "<br>";
    //         if (substr($n['event_date'], 0, 10) < $temp_month) {
    //             echo 'di atas';
    //             $invoice_temp[] = substr($n['event_date'], 0, 7);
    //         } else {
    //             echo 'di bawah';
    //             $startdate = strtotime("$periode");
    //             $enddate = strtotime("+1 months", $startdate);
    //             $temp_date =  date("Y-m", $enddate);
    //             $invoice_temp[] = $temp_date;
    //         }
    //     }
    //     echo var_dump($invoice_temp) . "<br>";
    //     // echo var_dump($event_student) . "<br>";
    // }

    public function data_invoice()
    {
        $this->cekLogin();
        $invoice = $this->M_Admin->getData_schedule();
        $order_book = $this->M_Admin->getData_order_book();
        $event_student = $this->M_Admin->getData_event_student();
        $schedule_theory = $this->M_Admin->getData_schedule_theory();
        $pack_online = $this->M_Admin->getData_list_pack();
        $new_pack = $this->M_Admin->getData_schedule_package(null, null, null, null, 4);

        $invoice_temp = [];
        if (count($invoice) > 0) {
            foreach ($invoice as $n) {
                $invoice_temp[] = substr($n['date'], 0, 7);
            }
        }

        if (count($schedule_theory) > 0) {
            foreach ($schedule_theory as $n) {
                $invoice_temp[] = substr($n['date'], 0, 7);
            }
        }
        
        $invoice_temp = array_unique($invoice_temp);
        rsort($invoice_temp);
        // echo var_dump($invoice_temp);
        $title = "Data invoice | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/data_invoice', array('invoice_temp' => $invoice_temp));
        $this->load->view('portal/reuse/footer');
    }

    public function data_invoice_purchase()
    {
        $this->cekLogin();
        $invoice = $this->M_Admin->getData_sirkulasi();
        $invoice_temp = [];
        if (count($invoice) > 0) {
            foreach ($invoice as $n) {
                $invoice_temp[] = substr($n['created_at'], 0, 7);
            }
        }
        $invoice_temp = array_unique($invoice_temp);
        rsort($invoice_temp);

        $title = "Data Purchase invoice | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/invoice/purchase/data', array('invoice_temp' => $invoice_temp));
        $this->load->view('portal/reuse/footer');
    }

    public function data_invoice_purchase_periode($periode)
    {
        $this->cekLogin();
        $title = "Data Purchase invoice | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/invoice/purchase/data_periode', array('periode' => $periode));
        $this->load->view('portal/reuse/footer');
    }

    public function detail_invoice_purchase($no_transaksi)
    {
        $this->cekLogin();

        $id_parent = '100' . substr($no_transaksi, 9, 3);
        $ortu = $this->M_Admin->getData_student(null, $id_parent);
        // INV/210629/022/001
        $temp_no_transaksi = "INV/" . substr($no_transaksi, 3, 6) . "/" . substr($no_transaksi, 9, 3) . "/" . substr($no_transaksi, 12);
        $sirkulasi_detail = $this->M_Admin->getData_sirkulasi_transaksi($temp_no_transaksi);
        $sirkulasi = $this->M_Admin->getData_sirkulasi(null, $temp_no_transaksi);

        //get Data Package & event
        $package = [];
        $schedule_package = [];
        $event = [];
        $event_detail = [];
        $book = [];
        $book_detail = [];
        $other_discount_lesson = [];
        $other_discount_event = [];

        foreach ($sirkulasi_detail as $sd) {
            if (substr($sd['id_barang'], 0, 3) == "PAC") {
                $temp_package = $this->M_Admin->getData_transaksi_package($sd['id_barang']);
                $package[] = $temp_package[0];
                if($temp_package[0]['discount'] > 0){
                    $other_discount_lesson[] = $temp_package[0]['no_transaksi_package'] ."&Lesson Package&". $temp_package[0]['discount'] . "&" . $temp_package[0]['name_student'];
                }
            }
            if (substr($sd['id_barang'], 0, 3) == "EVN") {
                $temp_event = $this->M_Admin->getData_transaksi_event($sd['id_barang']);
                $event[] = $temp_event[0];
                if ($temp_event[0]['discount'] > 0) {
                    $temp_event_name = $this->M_Admin->getData_event(null, null, $temp_event[0]['parent_event']);
                    $other_discount_event[] = $temp_event[0]['no_transaksi_event'] . "&Event&" . $temp_event[0]['discount'] . "&" . $temp_event[0]['name_student'] . "&" . $temp_event_name[0]['event_name'];
                }
            }
            if (substr($sd['id_barang'], 0, 3) == "BOK") {
                $temp_book = $this->M_Admin->getData_transaksi_book($sd['id_barang']);
                $book[] = $temp_book[0];
            }
        }
        // echo var_dump($sirkulasi_detail);
        // echo "<br>";
        // echo "<br>";
        // echo var_dump($package);
        // echo "<br>";
        // echo "<br>";

        // die();
        for ($i = 0; $i < count($package); $i++) {
            $temp_schedule_pack = $this->M_Admin->getData_schedule_package_invoice(null, $package[$i]['id_list_pack']);
            $schedule_package[$package[$i]['id_list_pack']][] = $temp_schedule_pack;
        }

        for ($i = 0; $i < count($event); $i++) {
            $temp_event_detail = $this->M_Admin->getData_transaksi_event_detail($event[$i]['no_transaksi_event']);
            $event_detail[$event[$i]['no_transaksi_event']][] = $temp_event_detail;
        }

        for ($i = 0; $i < count($book); $i++) {
            $temp_book_detail = $this->M_Admin->getData_transaksi_book($book[$i]['no_transaksi_book']);
            $book_detail[$book[$i]['no_transaksi_book']][] = $temp_book_detail;
        }
        // echo var_dump($schedule_package);
        // echo "<br>";
        // echo "<br>";

        // echo var_dump($event);
        // echo "<br>";
        // echo "<br>";
        $other_invoice = $this->M_Admin->getData_other_invoice_online(null, null, $no_transaksi);

        // echo var_dump($package);

        $title = "Detail Online invoice | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/admin/invoice/purchase/detail', array('ortu' => $ortu, 'title' => $title, 'description' => $description, 'package' => $package, 'event' => $event, 'event_detail' => $event_detail, 'sirkulasi' => $sirkulasi, 'sirkulasi_detail' => $sirkulasi_detail, 'schedule_package' => $schedule_package, 'book' => $book, 'book_detail' => $book_detail, 'other_invoice' => $other_invoice, 'other_discount_lesson' => $other_discount_lesson, 'other_discount_event' => $other_discount_event));
    }

    public function detail_invoice_purchase_parent($hash_no_transaksi)
    {
        $no_transaksi = 'Not Found';
        $total_sirkulasi = $this->M_Admin->getData_sirkulasi();
        foreach ($total_sirkulasi as $ts) {
            if (md5($ts['no_transaksi']) == $hash_no_transaksi) {
                $no_transaksi = $ts['no_transaksi'];
            }
        }
        $no_transaksi = str_replace("/", "", $no_transaksi);

        $id_parent = '100' . substr($no_transaksi, 9, 3);
        $ortu = $this->M_Admin->getData_student(null, $id_parent);
        // INV/210629/022/001
        $temp_no_transaksi = "INV/" . substr($no_transaksi, 3, 6) . "/" . substr($no_transaksi, 9, 3) . "/" . substr($no_transaksi, 12);
        $sirkulasi_detail = $this->M_Admin->getData_sirkulasi_transaksi($temp_no_transaksi);
        $sirkulasi = $this->M_Admin->getData_sirkulasi(null, $temp_no_transaksi);

        //get Data Package & event
        $package = [];
        $schedule_package = [];
        $event = [];
        $event_detail = [];
        $book = [];
        $book_detail = [];
        $other_discount_lesson = [];
        $other_discount_event = [];

        foreach ($sirkulasi_detail as $sd) {
            if (substr($sd['id_barang'], 0, 3) == "PAC") {
                $temp_package = $this->M_Admin->getData_transaksi_package($sd['id_barang']);
                $package[] = $temp_package[0];
                if ($temp_package[0]['discount'] > 0) {
                    $other_discount_lesson[] = $temp_package[0]['no_transaksi_package'] . "&Lesson Package&" . $temp_package[0]['discount'] . "&" . $temp_package[0]['name_student'];
                }
            }
            if (substr($sd['id_barang'], 0, 3) == "EVN") {
                $temp_event = $this->M_Admin->getData_transaksi_event($sd['id_barang']);
                $event[] = $temp_event[0];
                if ($temp_event[0]['discount'] > 0) {
                    $other_discount_event[] = $temp_event[0]['no_transaksi_event'] . "&Event&" . $temp_event[0]['discount'] . "&" . $temp_event[0]['name_student'];
                }
            }
            if (substr($sd['id_barang'], 0, 3) == "BOK") {
                $temp_book = $this->M_Admin->getData_transaksi_book($sd['id_barang']);
                $book[] = $temp_book[0];
            }
        }
        // echo var_dump($sirkulasi_detail);
        // echo "<br>";
        // echo "<br>";
        // echo var_dump($book);
        // echo "<br>";
        // echo "<br>";

        for ($i = 0; $i < count($package); $i++) {
            $temp_schedule_pack = $this->M_Admin->getData_schedule_package(null, $package[$i]['id_list_pack']);
            $schedule_package[$package[$i]['id_list_pack']][] = $temp_schedule_pack;
        }

        for ($i = 0; $i < count($event); $i++) {
            $temp_event_detail = $this->M_Admin->getData_transaksi_event_detail($event[$i]['no_transaksi_event']);
            $event_detail[$event[$i]['no_transaksi_event']][] = $temp_event_detail;
        }

        for ($i = 0; $i < count($book); $i++) {
            $temp_book_detail = $this->M_Admin->getData_transaksi_book($book[$i]['no_transaksi_book']);
            $book_detail[$book[$i]['no_transaksi_book']][] = $temp_book_detail;
        }

        // echo var_dump($schedule_package);
        // echo "<br>";
        // echo "<br>";

        // echo var_dump($book);
        // echo "<br>";
        // echo "<br>";
        // die();

        $other_invoice = $this->M_Admin->getData_other_invoice_online(null, null, $no_transaksi);

        $title = "Detail Online invoice " . $no_transaksi;
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/admin/invoice/parent/detail_purchase', array('ortu' => $ortu, 'title' => $title, 'description' => $description, 'package' => $package, 'event' => $event, 'event_detail' => $event_detail, 'sirkulasi' => $sirkulasi, 'sirkulasi_detail' => $sirkulasi_detail, 'schedule_package' => $schedule_package, 'book' => $book, 'book_detail' => $book_detail, 'other_invoice' => $other_invoice, 'other_discount_lesson' => $other_discount_lesson, 'other_discount_event' => $other_discount_event));
    }

    public function data_invoice_offline()
    {
        $this->cekLogin();
        $invoice = $this->M_Admin->getData_schedule();
        $invoice_temp = [];
        foreach ($invoice as $n) {
            $invoice_temp[] = substr($n['date'], 0, 7);
        }

        $invoice_temp = array_unique($invoice_temp);
        $invoice_temp_im = implode(".", $invoice_temp);
        $invoice_temp_ex = explode(".", $invoice_temp_im);
        sort($invoice_temp_ex);

        $title = "Data invoice | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/data_invoice_offline', array('invoice_temp' => $invoice_temp_ex));
        $this->load->view('portal/reuse/footer');
    }

    public function data_invoice_online()
    {
        $this->cekLogin();
        $title = "Data invoice | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/data_invoice_online');
        $this->load->view('portal/reuse/footer');
    }

    public function data_invoice_periode($periode)
    {
        $this->cekLogin();
        $id_schedule = null;
        $invoice = $this->M_Admin->getData_schedule($id_schedule, $periode);
        $schedule_theory = $this->M_Admin->getData_schedule_theory(null, null, $periode);

        $invoice_temp = [];
        foreach ($invoice as $n) {
            $invoice_temp[] = $n['id_parent'] . "-" . $n['parent_student'];
        }

        foreach ($schedule_theory as $n) {
            $invoice_temp[] = $n['id_parent'] . "-" . $n['parent_student'];
        }

        $invoice_temp = array_unique($invoice_temp);
        sort($invoice_temp);

        $title = "Data invoice | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/data_invoice_periode', array('invoice_temp' => $invoice_temp));
        $this->load->view('portal/reuse/footer');
    }

    public function data_invoice_summary_offline($periode)
    {
        $this->cekLogin();
        $title = "Data Invoice Summary | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/data_invoice_summary_offline');
        $this->load->view('portal/reuse/footer');
    }

    public function data_invoice_summary($periode)
    {
        $other_invoice = $this->M_Admin->getData_other_invoice(null, $periode);
        $order_book = $this->M_Admin->getData_order_book(null, null, $periode);
        $event_student = $this->M_Admin->getData_event_student(null, null, $periode);
        $pack_online = $this->M_Admin->getData_list_pack(null, null, $periode);
        $schedule_theory = $this->M_Admin->getData_schedule_theory(null, null, $periode);
        $schedule = $this->M_Admin->getData_schedule(null,  $periode);
        $new_package = $this->M_Admin->getData_list_pack(null, null, null, $periode);
        $dollar = $this->M_Admin->getData_ConvertDollar(null, $periode);
        $euro = $this->M_Admin->getData_ConvertEuro(null, $periode);

        // echo var_dump($new_package);
        // echo "<br>";
        // echo "<br>";
        // echo var_dump($order_book);
        // echo "<br>";
        // echo "<br>";
        // echo var_dump($event_student);
        // echo "<br>";
        // echo "<br>";

        $id_parent_others = [];
        $data_other_parent = [];
        $data_other_parent_count = [];
        $count_other_parent = [];
        $get_payment_date = [];
        $name_parent = [];

        if (count($schedule) > 0) {
            foreach ($schedule as $n) {

                $name_parent[] = $n['id_parent']  . "-" . $n['parent_student'];
            }
        }

        if (count($other_invoice) > 0) {
            foreach ($other_invoice as $n) {
                $id_parent_others[] = $n['id_parent'];
                $count_other_parent[] = $n['id_parent'];
                $get_parent_name = $this->M_Admin->getData_student(null,  $n['id_parent']);
                $name_parent[] = $n['id_parent']  . "-" . $get_parent_name[0]['parent_student'];
            }
            $id_parent_others = array_unique($id_parent_others);
            sort($id_parent_others);
            for ($i = 0; $i < count($id_parent_others); $i++) {
                $payment_date = $this->M_Admin->getData_payment_date($periode, $id_parent_others[$i]);
                if (count($payment_date) > 0) :
                    $get_payment_date[$id_parent_others[$i]] = $payment_date[0]['date'];
                else :
                    $get_payment_date[$id_parent_others[$i]] = '';
                endif;
                $data_temp = $this->M_Admin->getData_other_invoice($id_parent_others[$i], $periode);
                foreach ($data_temp as $n) {
                    $data_other_parent[] = $n['id_parent'] . "-Others-" . $n['other_note'] . "-" . $n['other_price'];
                    $data_other_parent_count[$id_parent_others[$i]][] = $n['other_price'];
                }
            }
        }
        if (count($order_book) > 0) {
            foreach ($order_book as $n) {
                $id_parent_others[] = $n['id_parent'];
                $count_other_parent[] = $n['id_parent'];
                $name_parent[] = $n['id_parent']  . "-" . $n['parent_student'];
            }
            $id_parent_others = array_unique($id_parent_others);
            sort($id_parent_others);
            for ($i = 0; $i < count($id_parent_others); $i++) {
                $payment_date = $this->M_Admin->getData_payment_date($periode, $id_parent_others[$i]);
                if (count($payment_date) > 0) :
                    $get_payment_date[$id_parent_others[$i]] = $payment_date[0]['date'];
                else :
                    $get_payment_date[$id_parent_others[$i]] = '';
                endif;
                $data_temp = $this->M_Admin->getData_order_book(null, $id_parent_others[$i], $periode);
                foreach ($data_temp as $n) {
                    $data_other_parent[] = $n['id_parent'] . "-Buku-" . $n['title'] . "-" . $n['price'];
                    $data_other_parent_count[$id_parent_others[$i]][] = $n['price'];
                }
            }
        }
        if (count($event_student) > 0) {
            foreach ($event_student as $n) {
                $id_parent_others[] = $n['id_parent'];
                $count_other_parent[] = $n['id_parent'];
                $name_parent[] = $n['id_parent']  . "-" . $n['parent_student'];
            }
            $id_parent_others = array_unique($id_parent_others);
            sort($id_parent_others);
            for ($i = 0; $i < count($id_parent_others); $i++) {
                $payment_date = $this->M_Admin->getData_payment_date($periode, $id_parent_others[$i]);
                if (count($payment_date) > 0) :
                    $get_payment_date[$id_parent_others[$i]] = $payment_date[0]['date'];
                else :
                    $get_payment_date[$id_parent_others[$i]] = '';
                endif;
                $data_temp = $this->M_Admin->getData_event_student(null, $id_parent_others[$i], $periode);
                foreach ($data_temp as $n) {
                    $data_other_parent[] = $n['id_parent'] . "-Events-" . $n['event_name'] . "-" . $n['price'];
                    $data_other_parent_count[$id_parent_others[$i]][] = $n['price'];
                }
            }
        }
        for ($i = 0; $i < count($count_other_parent); $i++) {
            $data_temp = $this->M_Admin->getData_student(null, $count_other_parent[$i]);
            foreach ($data_temp as $n) {
                $count_other_parent[$i] = $n['id_parent'] . "-" . $n['parent_student'];
            }
        }
        sort($count_other_parent);
        sort($data_other_parent);
        for ($i = 0; $i < count($data_other_parent); $i++) {
            $data_other_parent[$i] = $data_other_parent[$i] . "-" . $count_other_parent[$i];
        }

        $id_parent = [];
        $date_pack_online = [];
        $date_schedulue_theory = [];
        $date_schedulue_new_package_practical = [];
        $date_schedulue_new_package_theory = [];
        $count_package = [];
        $total_invoice = [];


        if (count($pack_online) > 0) {
            $id_list_pack_unique = [];
            $rate = 0;
            foreach ($pack_online as $n) {
                if ($n['rate_dollar'] == 1) {
                    $rate = $n['rate'];
                } elseif ($n['rate_dollar'] == 2) {
                    if (count($dollar) > 0) {
                        $rate = intval($n['rate']) * intval($dollar[0]['value']);
                    } else {
                        $rate = intval($n['rate']);
                    }
                } else {
                    if (count($euro) > 0) {
                        $rate = intval($n['rate']) * intval($euro[0]['value']);
                    } else {
                        $rate = intval($n['rate']);
                    }
                }
                $id_parent[] = $n['id_parent'] . "-" . $n['id_student'] . "-" . $n['name_student'] . "-" . $n['parent_student'] . "-" . $n['name_teacher'] . "-" . $rate . "-package";
                $name_parent[] = $n['id_parent']  . "-" . $n['parent_student'];
                $total_invoice[$n['id_parent']][] = $rate;
                $id_list_pack_unique[] = $n['id_list_pack'];
            }
            $id_parent_unique = [];
            $id_parent_unique = array_unique($id_parent);
            sort($id_parent);
            sort($id_parent_unique);
            $name_parent = array_unique($name_parent);
            sort($name_parent);
            $id_list_pack_unique = array_unique($id_list_pack_unique);
            sort($id_list_pack_unique);

            for ($i = 0; $i < count($id_parent); $i++) {
                for ($j = 0; $j < count($id_parent_unique); $j++) {
                    if ($id_parent[$i] == $id_parent_unique[$j]) {
                        $count_package[$id_parent[$i]][] = "1";
                    }
                }
            }
            $id_parent = $id_parent_unique;
            $id_parent_temp_ex = [];
            for ($i = 0; $i < count($id_parent); $i++) {
                $id_parent_temp_ex[] = explode("-", $id_parent[$i]);
            }

            for ($i = 0; $i < count($id_parent_temp_ex); $i++) {
                $schedule_online = $this->M_Admin->getData_schedule_package(null, null, null, $id_parent_temp_ex[$i][1], null, $periode);
                // echo count($schedule_online);
                $temp_index = $id_parent_temp_ex[$i][0] . "-" . $id_parent_temp_ex[$i][1];
                if (count($schedule_online) > 0) {
                    foreach ($schedule_online as $n) {
                        if ($n['status'] == 1 || $n['status'] == 2) {
                            $date_pack_online[$temp_index][] = substr($n['date_schedule'], 0, 10);
                        }
                        if ($n['status'] == 3 && $n['date_update_cancel'] != NULL) {
                            $date_pack_online[$temp_index][] = substr($n['date_update_cancel'], 0, 10);
                        }
                    }
                } else {
                    $date_pack_online[$temp_index][] = 0;
                }
            }
        }
        if (count($new_package) > 0) {
            $id_list_pack_unique = [];
            $id_teacher_practical_unique = [];
            $id_teacher_theory_unique = [];
            foreach ($new_package as $n) {
                if ($n['id_teacher_theory'] != NULL) {
                    $id_list_pack_unique[] = $n['id_list_pack'] . "-" . $n['id_teacher_practical'] . "-" . $n['id_teacher_theory'] . "-" . $n['rate_dollar'];
                } else {
                    $id_list_pack_unique[] = $n['id_list_pack'] . "-" . $n['id_teacher_practical'] . "-NULL-" . $n['rate_dollar'];
                }
            }
            $id_list_pack_unique = array_unique($id_list_pack_unique);
            sort($id_list_pack_unique);
            // echo "<br>";
            // echo "<br>";
            // echo var_dump($id_list_pack_unique);
            $id_list_pack_temp_ex = [];
            for ($i = 0; $i < count($id_list_pack_unique); $i++) {
                $id_list_pack_temp_ex[] = explode("-", $id_list_pack_unique[$i]);
            }
            // echo "<br>";
            // echo "<br>";
            // echo var_dump($id_list_pack_temp_ex);
            for ($i = 0; $i < count($id_list_pack_temp_ex); $i++) {
                $new_pack_practical = $this->M_Admin->getData_schedule_package(null, $id_list_pack_temp_ex[$i][0], null, null, 4, null, $id_list_pack_temp_ex[$i][1]);
                // echo "<br>";
                // echo "<br>";
                // echo var_dump($new_pack_practical);
                if (count($new_pack_practical) > 0) {
                    $id_parent_unique = [];
                    $rate = 0;
                    // $rate = 475000;
                    foreach ($new_pack_practical as $n) {
                        if ($id_list_pack_temp_ex[$i][3] == 1) {
                            $rate = 475000;
                        } elseif ($id_list_pack_temp_ex[$i][3] == 2) {
                            if (count($dollar) > 0) {
                                $rate = 48 * intval($dollar[0]['value']);
                            } else {
                                $rate = 48;
                            }
                        } else {
                            if (count($euro) > 0) {
                                $rate = 48 * intval($euro[0]['value']);
                            } else {
                                $rate = 48;
                            }
                        }
                        $id_parent[] = $n['id_parent'] . "-" . $n['id_student'] . "-" . $n['name_student'] . "-" . $n['parent_student'] . "-" . $n['name_teacher'] . "-" . $rate . "-newpackage-practical";
                        $name_parent[] = $n['id_parent']  . "-" . $n['parent_student'];
                        $id_parent_unique[] = $n['id_parent'] . "-" . $n['id_student'];
                        $date_schedulue_new_package_practical[$n['id_parent'] . "-" . $n['id_student']][] = substr($n['date_schedule'], 0, 10);
                    }
                    $tot = $rate * round(count($new_pack_practical) / 2);
                    $total_invoice[$new_pack_practical[0]['id_parent']][] = $tot;
                    $name_parent = array_unique($name_parent);
                    sort($name_parent);
                    $id_parent = array_unique($id_parent);
                    sort($id_parent);
                }
                if ($id_list_pack_temp_ex[$i][2] != NULL) {
                    $new_pack_theory = $this->M_Admin->getData_schedule_package(null, $id_list_pack_temp_ex[$i][0], null, null, 4, null, $id_list_pack_temp_ex[$i][2]);
                    // echo "<br>";
                    // echo "<br>";
                    // echo var_dump($new_pack_theory);
                    foreach ($new_pack_theory as $n) {
                        $rate = 100000;
                        if ($id_list_pack_temp_ex[$i][3] == 1) {
                            $rate = 100000;
                        } elseif ($id_list_pack_temp_ex[$i][3] == 2) {
                            $rate = 10 * intval($dollar[0]['value']);
                        } else {
                            $rate = 10 * intval($euro[0]['value']);
                        }
                        $id_parent[] = $n['id_parent'] . "-" . $n['id_student'] . "-" . $n['name_student'] . "-" . $n['parent_student'] . "-" . $n['name_teacher'] . "-" . $rate . "-newpackage-theory";
                        $name_parent[] = $n['id_parent']  . "-" . $n['parent_student'];
                        $total_invoice[$n['id_parent']][] = $rate;
                        $date_schedulue_new_package_theory[$n['id_parent'] . "-" . $n['id_student']][] = substr($n['date_schedule'], 0, 10);
                    }
                    $name_parent = array_unique($name_parent);
                    sort($name_parent);
                    $id_parent = array_unique($id_parent);
                    sort($id_parent);
                }
            }
        }
        // echo "<br>";
        // echo "<br>";
        // echo "<br>";
        // echo "<br>";
        // echo var_dump($date_schedulue_new_package_practical);
        // echo "<br>";
        // echo "<br>";
        // echo "<br>";
        // echo "<br>";
        // echo var_dump($date_schedulue_new_package_theory);
        if (count($schedule_theory) > 0) {
            $id_parent_unique = [];

            foreach ($schedule_theory as $n) {
                $id_parent[] = $n['id_parent'] . "-" . $n['id_student'] . "-" . $n['name_student'] . "-" . $n['parent_student'] . "-" . $n['name_teacher'] . "-" . $n['fee'] . "-theory";
                $name_parent[] = $n['id_parent']  . "-" . $n['parent_student'];
                $id_parent_unique[] = $n['id_parent'] . "-" . $n['id_student'];
                $total_invoice[$n['id_parent']][] = $n['fee'];
            }
            $id_parent_unique = array_unique($id_parent_unique);
            sort($id_parent_unique);

            $name_parent = array_unique($name_parent);
            sort($name_parent);
            $id_parent = array_unique($id_parent);
            sort($id_parent);

            $id_parent_temp_ex = [];
            for ($i = 0; $i < count($id_parent_unique); $i++) {
                $id_parent_temp_ex[] = explode("-", $id_parent_unique[$i]);
            }

            for ($i = 0; $i < count($id_parent_temp_ex); $i++) {
                $schedule_theory = $this->M_Admin->getData_schedule_theory(null, null, $periode, $id_parent_temp_ex[$i][1]);
                $temp_index = $id_parent_temp_ex[$i][0] . "-" . $id_parent_temp_ex[$i][1];
                foreach ($schedule_theory as $n) {
                    $date_schedulue_theory[$temp_index][] = substr($n['date'], 0, 10);
                }
            }
        }


        $count_data_parent = [];
        $cek_parent_full = [];
        for ($i = 0; $i < count($id_parent); $i++) {
            $cek_parent_full[] = explode("-", $id_parent[$i]);
        }

        $cek_parent_satuan = [];
        for ($i = 0; $i < count($name_parent); $i++) {
            $cek_parent_satuan[] = explode("-", $name_parent[$i]);
        }

        for ($i = 0; $i < count($cek_parent_full); $i++) {
            for ($j = 0; $j < count($cek_parent_satuan); $j++) {
                if ($cek_parent_full[$i][0] == $cek_parent_satuan[$j][0]) {
                    $count_data_parent[$cek_parent_full[$i][0]][] = "1";
                }
            }
        }
        for ($j = 0; $j < count($cek_parent_satuan); $j++) {
            $payment_date = $this->M_Admin->getData_payment_date($periode, $cek_parent_satuan[$j][0]);
            if (count($payment_date) > 0) :
                $get_payment_date[$cek_parent_satuan[$j][0]] = $payment_date[0]['date'];
            else :
                $get_payment_date[$cek_parent_satuan[$j][0]] = '';
            endif;
        }


        $this->cekLogin();
        $title = "Data Invoice Summary | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/data_invoice_summary', array('count_data_parent' => $count_data_parent, 'name_parent' => $name_parent, 'id_parent' => $id_parent, 'count_package' => $count_package, 'date_pack_online' => $date_pack_online, 'date_schedulue_theory' => $date_schedulue_theory, 'date_schedulue_new_package_practical' => $date_schedulue_new_package_practical, 'date_schedulue_new_package_theory' => $date_schedulue_new_package_theory, 'total_invoice' => $total_invoice, 'id_parent_others' => $id_parent_others, 'data_other_parent' => $data_other_parent, 'count_other_parent' => $count_other_parent, 'data_other_parent_count' => $data_other_parent_count, 'get_payment_date' => $get_payment_date, 'dollar' => $dollar, 'euro' => $euro));
        $this->load->view('portal/reuse/footer');
    }

    public function update_date_payment($periode, $id_parent)
    {
        $get = $this->M_Admin->getData_payment_date($periode, $id_parent);
        $date = $_GET['date'];
        // echo $date;
        // echo json_encode($_GET['date']);
        // echo var_dump($get);
        if (count($get) > 0) {
            $res = $this->M_Admin->updateDataDatePayment($get[0]['id_payment'], $date);
            // echo "update";
        } else {
            $res = $this->M_Admin->addDataDatePayment($periode, $id_parent, $date);
            // echo "add";
        }
    }

    public function updateCurrencyParent()
    {
        $this->M_Admin->updateCurrencyParent();
    }

    public function data_invoice_view($periode, $id_parent)
    {
        $this->cekLogin();
        $ortu = $this->M_Admin->getData_student(null, $id_parent);
        $other_invoice = $this->M_Admin->getData_other_invoice($id_parent, $periode);
        $order_book = $this->M_Admin->getData_order_book(null, $id_parent, $periode);
        $event_student = $this->M_Admin->getData_event_student(null, $id_parent, $periode);
        $pack_online = $this->M_Admin->getData_list_pack(null, $id_parent, $periode);
        $schedule_theory = $this->M_Admin->getData_schedule_theory(null, $id_parent, $periode);
        $schedule_offline = $this->M_Admin->getData_summary_invoice($id_parent, $periode);
        $new_package = $this->M_Admin->getData_list_pack(null, $id_parent, null, $periode);
        $dollar = $this->M_Admin->getData_ConvertDollar(null, $periode);
        $euro = $this->M_Admin->getData_ConvertEuro(null, $periode);
        // echo var_dump($order_book);

        $id_pack_online = [];
        $date_pack_online = [];

        if (count($pack_online) > 0) {
            foreach ($pack_online as $n) {
                $id_pack_online[] = $n['id_list_pack'];
            }
            for ($i = 0; $i < count($id_pack_online); $i++) {
                $schedule_online = $this->M_Admin->getData_schedule_package(null, $id_pack_online[$i], 0);
                if (count($schedule_online) > 0) {
                    foreach ($schedule_online as $n) {
                        if ($n['status'] == 1 || $n['status'] == 2 || ($n['status'] == 3 && $n['date_update_cancel'] != NULL)) {
                            $date_pack_online[$id_pack_online[$i]][] = $n['date_schedule'];
                        }
                    }
                } else {
                    $date_pack_online[$id_pack_online[$i]][] = 0;
                }
            }
        }
        // echo "<br>";
        // echo "<br>";
        // echo var_dump($date_pack_online);
        $id_new_package_practical = [];
        $name_student_new_package_practical = [];
        $date_schedulue_new_package_practical = [];
        $id_new_package_theory = [];
        $name_student_new_package_theory = [];
        $date_schedulue_new_package_theory = [];
        if (count($new_package) > 0) {
            $id_list_pack_unique = [];
            foreach ($new_package as $n) {
                if ($n['id_teacher_theory'] != NULL) {
                    $id_list_pack_unique[] = $n['id_list_pack'] . "-" . $n['id_teacher_practical'] . "-" . $n['id_teacher_theory'];
                } else {
                    $id_list_pack_unique[] = $n['id_list_pack'] . "-" . $n['id_teacher_practical'] . "-NULL";
                }
            }

            $id_list_pack_unique = array_unique($id_list_pack_unique);
            sort($id_list_pack_unique);
            $id_list_pack_temp_ex = [];
            for ($i = 0; $i < count($id_list_pack_unique); $i++) {
                $id_list_pack_temp_ex[] = explode("-", $id_list_pack_unique[$i]);
            }
            for ($i = 0; $i < count($id_list_pack_temp_ex); $i++) {
                $new_pack_practical = $this->M_Admin->getData_schedule_package(null, $id_list_pack_temp_ex[$i][0], null, null, 4, null, $id_list_pack_temp_ex[$i][1]);
                if (count($new_pack_practical) > 0) {
                    $id_parent_unique = [];
                    $rate = 475000;
                    foreach ($new_pack_practical as $n) {
                        $id_new_package_practical[] = $n['id_student'] . "-" . $n['name_student'];
                        $date_schedulue_new_package_practical[$n['id_student']][] = substr($n['date_schedule'], 0, 10);
                    }
                }
                $new_pack_theory = $this->M_Admin->getData_schedule_package(null, $id_list_pack_temp_ex[$i][0], null, null, 4, null, $id_list_pack_temp_ex[$i][2]);
                if (count($new_pack_theory) > 0) {
                    $id_parent_unique = [];
                    $rate = 100000;
                    foreach ($new_pack_theory as $n) {
                        $id_new_package_theory[] = $n['id_student'] . "-" . $n['name_student'];
                        $date_schedulue_new_package_theory[$n['id_student']][] = substr($n['date_schedule'], 0, 10);
                    }
                }
            }
            $id_new_package_practical = array_unique($id_new_package_practical);
            sort($id_new_package_practical);

            for ($i = 0; $i < count($id_new_package_practical); $i++) {
                $name_student_new_package_practical[$i] = explode("-", $id_new_package_practical[$i]);
            }
            $id_new_package_theory = array_unique($id_new_package_theory);
            sort($id_new_package_theory);

            for ($i = 0; $i < count($id_new_package_theory); $i++) {
                $name_student_new_package_theory[$i] = explode("-", $id_new_package_theory[$i]);
            }
        }

        // echo var_dump($date_pack_online);

        $id_schedule_theory = [];
        $name_student_schedule_theory = [];
        $date_schedulue_theory = [];

        if (count($schedule_theory) > 0) {

            foreach ($schedule_theory as $n) {
                $id_schedule_theory[] = $n['id_student'] . "-" . $n['name_student'];
            }

            $id_schedule_theory = array_unique($id_schedule_theory);
            sort($id_schedule_theory);

            for ($i = 0; $i < count($id_schedule_theory); $i++) {
                $name_student_schedule_theory[$i] = explode("-", $id_schedule_theory[$i]);
            }


            for ($i = 0; $i < count($name_student_schedule_theory); $i++) {
                $schedule_online = $this->M_Admin->getData_schedule_theory(null, null, $periode, $name_student_schedule_theory[$i][0]);
                foreach ($schedule_online as $n) {
                    $date_schedulue_theory[$name_student_schedule_theory[$i][0]][] = substr($n['date'], 8, 2);
                }
                sort($date_schedulue_theory[$name_student_schedule_theory[$i][0]]);
            }
        }
        $title = "invoice | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/admin/invoice', array('other_invoice' => $other_invoice, 'schedule_offline' => $schedule_offline, 'ortu' => $ortu, 'title' => $title, 'description' => $description, 'order_book' => $order_book, 'event_student' => $event_student, 'pack_online' => $pack_online, 'date_pack_online' => $date_pack_online, 'id_schedule_theory' => $name_student_schedule_theory, 'date_schedulue_theory' => $date_schedulue_theory, 'id_new_package_practical' => $name_student_new_package_practical, 'date_schedulue_new_package_practical' => $date_schedulue_new_package_practical, 'id_new_package_theory' => $name_student_new_package_theory, 'date_schedulue_new_package_theory' => $date_schedulue_new_package_theory, 'dollar' => $dollar, 'euro' => $euro));
    }

    public function data_invoice_view_parent($periode, $hash_parent)
    {
        $cek_student = $this->M_Admin->getData_student();
        $no = 1;
        foreach ($cek_student as $s) {
            if ($no == 1) {
                if (md5($s['id_parent']) == $hash_parent) {
                    $no = 2;
                    $id_parent = $s['id_parent'];
                    $ortu = $this->M_Admin->getData_student(null, $id_parent);
                    $other_invoice = $this->M_Admin->getData_other_invoice($id_parent, $periode);
                    $order_book = $this->M_Admin->getData_order_book(null, $id_parent, $periode);
                    $event_student = $this->M_Admin->getData_event_student(null, $id_parent, $periode);
                    $pack_online = $this->M_Admin->getData_list_pack(null, $id_parent, $periode);
                    $schedule_theory = $this->M_Admin->getData_schedule_theory(null, $id_parent, $periode);
                    $schedule_offline = $this->M_Admin->getData_summary_invoice($id_parent, $periode);
                    $new_package = $this->M_Admin->getData_list_pack(null, $id_parent, null, $periode);
                    $dollar = $this->M_Admin->getData_ConvertDollar(null, $periode);
                    $euro = $this->M_Admin->getData_ConvertEuro(null, $periode);
                    // echo var_dump($order_book);

                    $id_pack_online = [];
                    $date_pack_online = [];

                    if (count($pack_online) > 0) {
                        foreach ($pack_online as $n) {
                            $id_pack_online[] = $n['id_list_pack'];
                        }
                        for ($i = 0; $i < count($id_pack_online); $i++) {
                            $schedule_online = $this->M_Admin->getData_schedule_package(null, $id_pack_online[$i], 0);
                            if (count($schedule_online) > 0) {
                                foreach ($schedule_online as $n) {
                                    if ($n['status'] == 1 || $n['status'] == 2 || ($n['status'] == 3 && $n['date_update_cancel'] != NULL)) {
                                        $date_pack_online[$id_pack_online[$i]][] = $n['date_schedule'];
                                    }
                                }
                            } else {
                                $date_pack_online[$id_pack_online[$i]][] = 0;
                            }
                        }
                    }
                    // echo "<br>";
                    // echo "<br>";
                    // echo var_dump($date_pack_online);
                    $id_new_package_practical = [];
                    $name_student_new_package_practical = [];
                    $date_schedulue_new_package_practical = [];
                    $id_new_package_theory = [];
                    $name_student_new_package_theory = [];
                    $date_schedulue_new_package_theory = [];
                    if (count($new_package) > 0) {
                        $id_list_pack_unique = [];
                        foreach ($new_package as $n) {
                            if ($n['id_teacher_theory'] != NULL) {
                                $id_list_pack_unique[] = $n['id_list_pack'] . "-" . $n['id_teacher_practical'] . "-" . $n['id_teacher_theory'];
                            } else {
                                $id_list_pack_unique[] = $n['id_list_pack'] . "-" . $n['id_teacher_practical'] . "-NULL";
                            }
                        }

                        $id_list_pack_unique = array_unique($id_list_pack_unique);
                        sort($id_list_pack_unique);
                        $id_list_pack_temp_ex = [];
                        for ($i = 0; $i < count($id_list_pack_unique); $i++) {
                            $id_list_pack_temp_ex[] = explode("-", $id_list_pack_unique[$i]);
                        }
                        for ($i = 0; $i < count($id_list_pack_temp_ex); $i++) {
                            $new_pack_practical = $this->M_Admin->getData_schedule_package(null, $id_list_pack_temp_ex[$i][0], null, null, 4, null, $id_list_pack_temp_ex[$i][1]);
                            if (count($new_pack_practical) > 0) {
                                $id_parent_unique = [];
                                $rate = 475000;
                                foreach ($new_pack_practical as $n) {
                                    $id_new_package_practical[] = $n['id_student'] . "-" . $n['name_student'];
                                    $date_schedulue_new_package_practical[$n['id_student']][] = substr($n['date_schedule'], 0, 10);
                                }
                            }
                            $new_pack_theory = $this->M_Admin->getData_schedule_package(null, $id_list_pack_temp_ex[$i][0], null, null, 4, null, $id_list_pack_temp_ex[$i][2]);
                            if (count($new_pack_theory) > 0) {
                                $id_parent_unique = [];
                                $rate = 100000;
                                foreach ($new_pack_theory as $n) {
                                    $id_new_package_theory[] = $n['id_student'] . "-" . $n['name_student'];
                                    $date_schedulue_new_package_theory[$n['id_student']][] = substr($n['date_schedule'], 0, 10);
                                }
                            }
                        }
                        $id_new_package_practical = array_unique($id_new_package_practical);
                        sort($id_new_package_practical);

                        for ($i = 0; $i < count($id_new_package_practical); $i++) {
                            $name_student_new_package_practical[$i] = explode("-", $id_new_package_practical[$i]);
                        }
                        $id_new_package_theory = array_unique($id_new_package_theory);
                        sort($id_new_package_theory);

                        for ($i = 0; $i < count($id_new_package_theory); $i++) {
                            $name_student_new_package_theory[$i] = explode("-", $id_new_package_theory[$i]);
                        }
                    }

                    // echo var_dump($date_pack_online);

                    $id_schedule_theory = [];
                    $name_student_schedule_theory = [];
                    $date_schedulue_theory = [];

                    if (count($schedule_theory) > 0) {

                        foreach ($schedule_theory as $n) {
                            $id_schedule_theory[] = $n['id_student'] . "-" . $n['name_student'];
                        }

                        $id_schedule_theory = array_unique($id_schedule_theory);
                        sort($id_schedule_theory);

                        for ($i = 0; $i < count($id_schedule_theory); $i++) {
                            $name_student_schedule_theory[$i] = explode("-", $id_schedule_theory[$i]);
                        }


                        for ($i = 0; $i < count($name_student_schedule_theory); $i++) {
                            $schedule_online = $this->M_Admin->getData_schedule_theory(null, null, $periode, $name_student_schedule_theory[$i][0]);
                            foreach ($schedule_online as $n) {
                                $date_schedulue_theory[$name_student_schedule_theory[$i][0]][] = substr($n['date'], 8, 2);
                            }
                            sort($date_schedulue_theory[$name_student_schedule_theory[$i][0]]);
                        }
                    }
                    $title = "invoice | Portal Etude";
                    $description = "Welcome to Portal Etude";
                    $this->load->view('portal/admin/invoice', array('other_invoice' => $other_invoice, 'schedule_offline' => $schedule_offline, 'ortu' => $ortu, 'title' => $title, 'description' => $description, 'order_book' => $order_book, 'event_student' => $event_student, 'pack_online' => $pack_online, 'date_pack_online' => $date_pack_online, 'id_schedule_theory' => $name_student_schedule_theory, 'date_schedulue_theory' => $date_schedulue_theory, 'id_new_package_practical' => $name_student_new_package_practical, 'date_schedulue_new_package_practical' => $date_schedulue_new_package_practical, 'id_new_package_theory' => $name_student_new_package_theory, 'date_schedulue_new_package_theory' => $date_schedulue_new_package_theory, 'dollar' => $dollar, 'euro' => $euro));
                }
            }
        }
    }

    public function pdf($periode, $id_parent)
    {
        $this->load->library('dompdf_gen');

        $ortu = $this->M_Admin->getData_student(null, $id_parent);
        $other_invoice = $this->M_Admin->getData_other_invoice($id_parent, $periode);
        $order_book = $this->M_Admin->getData_order_book(null, $id_parent, $periode);
        $event_student = $this->M_Admin->getData_event_student(null, $id_parent, $periode);
        $pack_online = $this->M_Admin->getData_pack_online(null, $id_parent, $periode);
        $schedule_theory = $this->M_Admin->getData_schedule_theory(null, $id_parent, $periode);
        $schedule_offline = $this->M_Admin->getData_summary_invoice($id_parent, $periode);

        // echo var_dump($order_book);

        $id_pack_online = [];
        $date_pack_online = [];

        if (count($pack_online) > 0) {
            foreach ($pack_online as $n) {
                $id_pack_online[] = $n['id_pack'];
            }
            for ($i = 0; $i < count($id_pack_online); $i++) {
                $schedule_online = $this->M_Admin->getData_schedule_online(null, $id_pack_online[$i], 3);
                foreach ($schedule_online as $n) {
                    $date_pack_online[$id_pack_online[$i]][] = $n['date'];
                }
                // if (count($date_pack_online[$id_pack_online[$i]]) < 1) {
                //     $date_pack_online[$id_pack_online[$i]][] = " ";
                // }
            }
        }

        // echo var_dump($date_pack_online);

        $id_schedule_theory = [];
        $name_student_schedule_theory = [];
        $date_schedulue_theory = [];

        if (count($schedule_theory) > 0) {

            foreach ($schedule_theory as $n) {
                $id_schedule_theory[] = $n['id_student'] . "-" . $n['name_student'];
            }

            $id_schedule_theory = array_unique($id_schedule_theory);
            $id_schedule_theory_im = implode(".", $id_schedule_theory);
            $id_schedule_theory_ex = explode(".", $id_schedule_theory_im);
            sort($id_schedule_theory_ex);

            for ($i = 0; $i < count($id_schedule_theory_ex); $i++) {
                $name_student_schedule_theory[$i] = explode("-", $id_schedule_theory_ex[$i]);
            }


            for ($i = 0; $i < count($name_student_schedule_theory); $i++) {
                $schedule_online = $this->M_Admin->getData_schedule_theory(null, null, $periode, $name_student_schedule_theory[$i][0]);
                foreach ($schedule_online as $n) {
                    $date_schedulue_theory[$name_student_schedule_theory[$i][0]][] = substr($n['date'], 8, 2);
                }
                sort($date_schedulue_theory[$name_student_schedule_theory[$i][0]]);
            }
        }
        $title = "invoice | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/admin/invoice_pdf', array('other_invoice' => $other_invoice, 'schedule_offline' => $schedule_offline, 'ortu' => $ortu, 'title' => $title, 'description' => $description, 'order_book' => $order_book, 'event_student' => $event_student, 'pack_online' => $pack_online, 'date_pack_online' => $date_pack_online, 'id_schedule_theory' => $name_student_schedule_theory, 'date_schedulue_theory' => $date_schedulue_theory));

        $paper_size = 'A4';
        $orientation = 'potrait';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $name_file = "invoice_" . $periode . "_" . $id_parent;
        $this->dompdf->stream($name_file, array('Attachment' => 0));
    }

    public function add_data_other_invoice()
    {
        $res = $this->M_Admin->insertDataOtherInvoice();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully added');
            redirect('portal/invoice/view/' . $_POST['periode'] . '/' . $_POST['id_parent']);
        } else {
            $this->session->set_flashdata('warning', 'Failed to add data');
            redirect('portal/invoice/view/' . $_POST['periode'] . '/' . $_POST['id_parent']);
        }
    }



    public function update_data_other_invoice($id_other_invoice)
    {
        $data = $_POST['data'];
        $value = $_POST['value'];
        $res = $this->M_Admin->updateDataOtherInvoice($id_other_invoice, $data, $value);
        // $res = $this->M->updateData('request', $data, ['id_other_invoice' => $id_other_invoice]);
    }

    public function delete_data_other_invoice($id_other_invoice, $periode, $id_parent)
    {
        $res = $this->M_Admin->deleteDataOtherInvoice($id_other_invoice);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully added');
            redirect('portal/C_Admin/detail_invoice_periode_transaksi/' . $periode . '/' . $id_parent);
        } else {
            $this->session->set_flashdata('warning', 'Failed to add data');
            redirect('portal/C_Admin/detail_invoice_periode_transaksi/' . $periode . '/' . $id_parent);
        }
    }

    public function add_data_other_feereport()
    {
        $res = $this->M_Admin->insertDataOtherFeereport();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully added');
            redirect('portal/feereport/view/' . $_POST['periode'] . '/' . $_POST['id_teacher']);
        } else {
            $this->session->set_flashdata('warning', 'Failed to add data');
            redirect('portal/feereport/view/' . $_POST['periode'] . '/' . $_POST['id_teacher']);
        }
    }

    public function update_data_other_feereport($id_other_feereport)
    {
        $data = $_POST['data'];
        $value = $_POST['value'];
        $res = $this->M_Admin->updateDataOtherFeereport($id_other_feereport, $data, $value);
    }

    public function delete_data_other_feereport($id_other_feereport, $periode, $id_teacher)
    {
        $res = $this->M_Admin->deleteDataOtherFeereport($id_other_feereport);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully added');
            redirect('portal/feereport/view/' . $periode . '/' . $id_teacher);
        } else {
            $this->session->set_flashdata('warning', 'Failed to add data');
            redirect('portal/feereport/view/' . $periode . '/' . $id_teacher);
        }
    }

    public function get_data_invoice_parent()
    {
        $periode = $_POST['periode'];
        $id_parent = $_POST['id_parent'];
        // $periode = '2021-10';
        // $id_parent = '100039';
        $temp_id_course = $this->M_Admin->getData_summary_invoice($id_parent, $periode);
        $id_course = [];
        $nama_course = [];
        $name_student = [];
        $name_teacher = [];
        $date = [];
        $date2 = [];
        $fee = [];
        $tot_invoice = [];
        if (count($temp_id_course) > 0) {
            for ($z = 0; $z < count($temp_id_course); $z++) :
                $id_course[] = $temp_id_course[$z]['id_course'] . "-" . $temp_id_course[$z]['nama_course'] . "-" . $temp_id_course[$z]['id_student'] . "-" . $temp_id_course[$z]['fee'];
                $nama_course[] = $temp_id_course[$z]['nama_course'];
                $name_student[] = $temp_id_course[$z]['name_student'];
                $name_teacher[] = $temp_id_course[$z]['name_teacher'];
                $date[] = $temp_id_course[$z]['name_student'] . "-" . substr($temp_id_course[$z]['date'], 8, 2);
                $date2[$temp_id_course[$z]['name_student']][] = substr($temp_id_course[$z]['date'], 8, 2);
                $fee[] = $temp_id_course[$z]['fee'];
            endfor;
            $id_course = array_unique($id_course);
            $id_course_im = implode(".", $id_course);
            $id_course_ex = explode(".", $id_course_im);

            $nama_course = array_unique($nama_course);
            $nama_course_im = implode(".", $nama_course);
            $nama_course_ex = explode(".", $nama_course_im);

            $name_student = array_unique($name_student);
            $name_student_im = implode(".", $name_student);
            $name_student_ex = explode(".", $name_student_im);

            $fee = array_unique($fee);
            $fee_im = implode(".", $fee);
            $fee_ex = explode(".", $fee_im);

            for ($b = 0; $b < count($id_course_ex); $b++) : ?>
                <tr>
                    <td style="width: 3%;"><?= intval($b + 1) ?></td>
                    <td>
                        <?= $name_student_ex[$b] ?>
                    </td>
                    <td>
                        <?php for ($d = 0; $d < count($date); $d++) : ?>
                            <?php $arr = [] ?>
                            <?php $arr = explode("-", $date[$d]); ?>
                            <?php if ($arr[0] == $name_student_ex[$b]) : ?>
                                <?= $arr[1] ?>,
                            <?php endif ?>
                        <?php endfor; ?>
                    </td>
                    <td>
                        <?= count($date2[$name_student_ex[$b]]) ?>
                    </td>
                    <td>
                        <?php $temp_fee_before  = [] ?>
                        <?php $temp_fee_before[] =  explode("-", $id_course_ex[$b]) ?>
                        Rp<?= number_format($temp_fee_before[0][3], 0, ".", ".") ?>
                    </td>
                    <td class="pl-4 pr-4 p-0 pt-2" style="width: 20%;">
                        <?php $tot_tuition = 0 ?>
                        <?php $tot_tuition = count($date2[$name_student_ex[$b]]) * intval($temp_fee_before[0][3]) ?>
                        <?php $tot_invoice[] = $tot_tuition ?>
                        <p style="text-align:left;">
                            Rp
                            <span style="float:right;">
                                <?= number_format($tot_tuition, 0, ".", ".") ?>
                            </span>
                        </p>
                    </td>
                </tr>
            <?php endfor; ?>
            <tr>
                <td colspan="5" class="text-center">
                    Sub Total
                </td>
                <td colspan="3" class="pl-4 pr-4 p-0 pt-2" style="width: 20%;">
                    <input type="hidden" name="tot_parent" id="tot_parent" value="<?= array_sum($tot_invoice) ?>">
                    <p style="text-align:left;">
                        Rp
                        <span style="float:right;">
                            <?= number_format(array_sum($tot_invoice), 0, ".", ".") ?>
                        </span>
                    </p>
                </td>
            </tr>
        <?php } else { ?>
            <?php $tot_tuition = 0 ?>
            <tr>
                <td style="width: 3%;"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="pl-4 pr-4 p-0 pt-2" style="width: 20%;">
                    <p style="text-align:left;">
                        Rp
                        <span style="float:right;">
                            <?= number_format($tot_tuition, 0, ".", ".") ?>
                        </span>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="5" class="text-center">
                    Sub Total
                </td>
                <td colspan="3" class="pl-4 pr-4 p-0 pt-2" style="width: 20%;">
                    <input type="hidden" name="tot_parent" id="tot_parent" value="<?= $tot_tuition ?>">
                    <p style="text-align:left;">
                        Rp
                        <span style="float:right;">
                            <?= number_format($tot_tuition, 0, ".", ".") ?>
                        </span>
                    </p>
                </td>
            </tr>
        <?php }
            }

            public function get_data_invoice_summary()
            {
                $periode = $_GET['periode'];

                $invoice = $this->M_Admin->getData_schedule(null, $periode);
                $invoice_temp_lesson = [];
                foreach ($invoice as $n) {
                    $invoice_temp_lesson[] = $n['id_parent'] . "-" . $n['parent_student'];
                }
                $invoice_temp_lesson = array_unique($invoice_temp_lesson);
                $invoice_temp_lesson_im = implode(".", $invoice_temp_lesson);
                $invoice_temp_lesson_ex = explode(".", $invoice_temp_lesson_im);
                sort($invoice_temp_lesson_ex);



                if (!empty($invoice)) { ?>
            <div id="count_data" style="display:none;">
                <?= count($invoice_temp_lesson_ex) ?>
            </div>
            <?php for ($i = 0; $i < count($invoice_temp_lesson_ex); $i++) :  ?>
                <?php
                                $temp_id_course = [];
                                $temp_id_course = $this->M_Admin->getData_summary_invoice(substr($invoice_temp_lesson_ex[$i], 0, 6), $periode);
                                $id_course = [];
                                $nama_course = [];
                                $name_student = [];
                                $name_teacher = [];
                                $date = [];
                                $date2 = [];
                                $fee = [];
                                $tot_invoice = [];
                                $get_payment_date = [];
                                $payment_date = $this->M_Admin->getData_payment_date($periode, substr($invoice_temp_lesson_ex[$i], 0, 6));
                                if (count($payment_date) > 0) :
                                    $get_payment_date[substr($invoice_temp_lesson_ex[$i], 0, 6)] = $payment_date[0]['date'];
                                else :
                                    $get_payment_date[substr($invoice_temp_lesson_ex[$i], 0, 6)] = '';
                                endif;

                                ?>
                <?php for ($z = 0; $z < count($temp_id_course); $z++) : ?>
                    <?php $id_course[] = $temp_id_course[$z]['id_course'] . "-" . $temp_id_course[$z]['nama_course'] . "-" . $temp_id_course[$z]['id_student'] . "-" . $temp_id_course[$z]['fee'] ?>
                    <?php $nama_course[] = $temp_id_course[$z]['nama_course'] ?>
                    <?php $name_student[] = $temp_id_course[$z]['name_student'] ?>
                    <?php $name_teacher[] = $temp_id_course[$z]['name_teacher'] ?>
                    <?php $date[] = $temp_id_course[$z]['name_student'] . "-" . substr($temp_id_course[$z]['date'], 8, 2) ?>
                    <?php $date2[$temp_id_course[$z]['name_student']][] = substr($temp_id_course[$z]['date'], 8, 2) ?>
                    <?php $fee[] = $temp_id_course[$z]['fee'] ?>
                <?php endfor; ?>
                <?php $id_course = array_unique($id_course); ?>
                <?php $id_course_im = implode(".", $id_course); ?>
                <?php $id_course_ex = explode(".", $id_course_im); ?>

                <?php $nama_course = array_unique($nama_course); ?>
                <?php $nama_course_im = implode(".", $nama_course); ?>
                <?php $nama_course_ex = explode(".", $nama_course_im); ?>

                <?php $name_student = array_unique($name_student); ?>
                <?php $name_student_im = implode(".", $name_student); ?>
                <?php $name_student_ex = explode(".", $name_student_im); ?>

                <?php $name_teacher = array_unique($name_teacher); ?>
                <?php $name_teacher_im = implode(".", $name_teacher); ?>
                <?php $name_teacher_ex = explode(".", $name_teacher_im); ?>

                <?php $fee = array_unique($fee); ?>
                <?php $fee_im = implode(".", $fee); ?>
                <?php $fee_ex = explode(".", $fee_im); ?>
                <?php for ($b = 0; $b < count($id_course_ex); $b++) : ?>
                    <tr>
                        <?php if ($b == 0) : ?>
                            <td style="width: 10%;" rowspan="<?= count($id_course_ex) ?>">
                                <?= substr($invoice_temp_lesson_ex[$i], 0, 6) ?>
                            </td>
                        <?php endif; ?>
                        <?php if ($b == 0) : ?>
                            <td style="width: 10%;" rowspan="<?= count($id_course_ex) ?>">
                                <?= substr($invoice_temp_lesson_ex[$i], 7) ?>
                            </td>
                        <?php endif; ?>
                        <?php if ($b < count($name_teacher_ex)) { ?>
                            <td>
                                <?= $name_teacher_ex[$b] ?>
                            </td>
                        <?php } else { ?>
                            <td style="border:0">
                            </td>
                        <?php } ?>
                        <td>
                            <?= $name_student_ex[$b] ?>
                        </td>
                        <td>
                            <?php for ($d = 0; $d < count($date); $d++) : ?>
                                <?php $arr = [] ?>
                                <?php $arr = explode("-", $date[$d]); ?>
                                <?php if ($arr[0] == $name_student_ex[$b]) : ?>
                                    <?= $arr[1] ?>,
                                <?php endif ?>
                            <?php endfor; ?>
                        </td>

                        <td>
                            <?= count($date2[$name_student_ex[$b]]) ?>
                        </td>
                        <td>
                            <?php $temp_fee_before  = [] ?>
                            <?php $temp_fee_before[] =  explode("-", $id_course_ex[$b]) ?>
                            Rp<?= number_format($temp_fee_before[0][3], 0, ".", ".") ?>
                        </td>
                        <td>
                            <?php $tot_tuition = 0 ?>
                            <?php $tot_tuition = count($date2[$name_student_ex[$b]]) * intval($temp_fee_before[0][3]) ?>
                            <?php $tot_invoice[substr($invoice_temp_lesson_ex[$i], 0, 6)][] =  $tot_tuition ?>
                            Rp<?= number_format($tot_tuition, 0, ".", ".") ?>
                        </td>
                        <?php if ($b == 0) : ?>
                            <?php $other_invoice = []; ?>
                            <?php $tot_other_invoice = []; ?>
                            <?php $other_invoice = $this->M_Admin->getData_other_invoice(substr($invoice_temp_lesson_ex[$i], 0, 6), $periode); ?>

                            <td rowspan="<?= count($id_course_ex) ?>" id="tot_lah<?= $i ?>" style="width: 10%;">
                            </td>
                            <td rowspan="<?= count($id_course_ex) ?>" style="width: 10%;">
                                <div>
                                    <input name="date" value="<?= $get_payment_date[substr($invoice_temp_lesson_ex[$i], 0, 6)] ?>" id="payment_date_offline<?= substr($invoice_temp_lesson_ex[$i], 0, 6) ?>" type="date" onchange="handler<?= substr($invoice_temp_lesson_ex[$i], 0, 6) ?>(event);">
                                </div>
                            </td>
                        <?php endif; ?>

                        <?php if ($b == (count($id_course_ex) - 1)) : ?>
                            <td style="display:none" id="temp_lah<?= $i ?>">
                                <?= array_sum($tot_invoice[substr($invoice_temp_lesson_ex[$i], 0, 6)]) ?>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endfor; ?>
            <?php endfor; ?>
        <?php } else { ?>
            <tr>
                <td class="text-center" colspan="12">
                    Data Tidak Ada
                </td>
            </tr>
        <?php } ?>
    <?php    }

        public function data_feereport()
        {
            $this->cekLogin();
            $feereport = $this->M_Admin->getData_schedule();
            $offline_trial = $this->M_Admin->getData_offline_trial();
            $event_teacher = $this->M_Admin->getData_event_teacher();
            $schedule_theory = $this->M_Admin->getData_schedule_theory();
            $schedule_pratical = $this->M_Admin->getData_schedule_package_teacher();

            $feereport_temp = [];
            foreach ($feereport as $n) {
                $feereport_temp[] = substr($n['date'], 0, 7);
            }

            foreach ($offline_trial as $ot) {
                $feereport_temp[] = substr($ot['date'], 0, 7);
            }

            foreach ($schedule_theory as $ot) {
                $feereport_temp[] = substr($ot['date'], 0, 7);
            }

            foreach ($schedule_pratical as $ot) {
                if ($ot['status'] == 2 || $ot['status'] == 4) {
                    $feereport_temp[] = substr($ot['date_schedule'], 0, 7);
                }
                if ($ot['status'] == 3 && $ot['date_update_cancel'] != null) {
                    $feereport_temp[] = substr($ot['date_update_cancel'], 0, 7);
                }
            }

            foreach ($event_teacher as $n) {
                $temp_month =  substr($n['event_date'], 0, 7) . "-05";
                $periode = substr($n['event_date'], 0, 7);
                if (substr($n['event_date'], 0, 10) < $temp_month) {
                    $feereport_temp[] = substr($n['event_date'], 0, 7);
                } else {
                    $startdate = strtotime("$periode");
                    $enddate = strtotime("+1 months", $startdate);
                    $temp_date =  date("Y-m", $enddate);

                    $feereport_temp[] = $temp_date;
                }
            }

            $feereport_temp = array_unique($feereport_temp);
            rsort($feereport_temp);

            $title = "Data feereport | Portal Etude";
            $description = "Welcome to Portal Etude";
            $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
            $this->load->view('portal/admin/data_feereport', array('feereport_temp' => $feereport_temp));
            $this->load->view('portal/reuse/footer');
        }



        public function data_feereport_offline()
        {
            $this->cekLogin();
            $feereport = $this->M_Admin->getData_schedule();
            $offline_trial = $this->M_Admin->getData_offline_trial();

            $feereport_temp = [];
            foreach ($feereport as $n) {
                $feereport_temp[] = substr($n['date'], 0, 7);
            }

            foreach ($offline_trial as $ot) {
                $feereport_temp[] = substr($ot['date'], 0, 7);
            }

            $feereport_temp = array_unique($feereport_temp);
            $feereport_temp_im = implode(".", $feereport_temp);
            $feereport_temp_ex = explode(".", $feereport_temp_im);
            sort($feereport_temp_ex);

            $title = "Data feereport | Portal Etude";
            $description = "Welcome to Portal Etude";
            $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
            $this->load->view('portal/admin/data_feereport_offline', array('feereport_temp' => $feereport_temp_ex));
            $this->load->view('portal/reuse/footer');
        }

        public function data_feereport_online()
        {
            $this->cekLogin();
            $title = "Data feereport | Portal Etude";
            $description = "Welcome to Portal Etude";
            $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
            $this->load->view('portal/admin/data_feereport_online');
            $this->load->view('portal/reuse/footer');
        }

        public function data_feereport_periode($periode)
        {
            $this->cekLogin();
            $id_schedule = null;
            $id_offline_trial = null;
            $feereport = $this->M_Admin->getData_schedule($id_schedule, $periode);
            $offline_trial = $this->M_Admin->getData_offline_trial($id_offline_trial, $periode);
            $event_teacher = $this->M_Admin->getData_event_teacher(null, null, $periode);
            $schedule_theory = $this->M_Admin->getData_schedule_theory(null, null, $periode);
            $pack_online = $this->M_Admin->getData_schedule_package_teacher(null, null, $periode, null, null, 2);
            $pack_online_lesson_add = $this->M_Admin->getData_schedule_package_teacher(null, null, $periode, null, null, 4);
            $pack_online_lesson_cancel = $this->M_Admin->getData_schedule_package_teacher(null, null, $periode, null, null, 3);

            $feereport_temp = [];
            foreach ($feereport as $n) {
                $feereport_temp[] = $n['id_teacher'] . "-" . $n['name_teacher'];
            }

            foreach ($offline_trial as $ot) {
                $feereport_temp[] = $ot['id_teacher'] . "-" . $ot['name_teacher'];
            }
            foreach ($event_teacher as $n) {
                $feereport_temp[] = $n['id_teacher'] . "-" . $n['name_teacher'];
            }

            foreach ($schedule_theory as $ot) {
                $feereport_temp[] = $ot['id_teacher'] . "-" . $ot['name_teacher'];
            }
            foreach ($pack_online as $n) {
                $feereport_temp[] = $n['id_teacher'] . "-" . $n['name_teacher'];
            }
            foreach ($pack_online_lesson_add as $n) {
                $feereport_temp[] = $n['id_teacher'] . "-" . $n['name_teacher'];
            }
            foreach ($pack_online_lesson_cancel as $n) {
                $feereport_temp[] = $n['id_teacher'] . "-" . $n['name_teacher'];
            }

            $feereport_temp = array_unique($feereport_temp);
            sort($feereport_temp);

            $title = "Data feereport | Portal Etude";
            $description = "Welcome to Portal Etude";
            $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
            $this->load->view('portal/admin/data_feereport_periode', array('feereport_temp' => $feereport_temp));
            $this->load->view('portal/reuse/footer');
        }

        public function data_feereport_view($periode, $id_teacher)
        {
            $this->cekLogin();
            $teacher = $this->M_Admin->getData_teacher($id_teacher);
            $other_feereport = $this->M_Admin->getData_other_feereport($id_teacher, $periode);
            $event_teacher = $this->M_Admin->getData_event_teacher(null, $id_teacher, $periode);
            $offline_trial = $this->M_Admin->getData_offline_trial(null, $periode, $id_teacher);
            $dollar = $this->M_Admin->getData_ConvertDollar(null, $periode);
            $euro = $this->M_Admin->getData_ConvertEuro(null, $periode);


            $title = "Feereport | Portal Etude";
            $description = "Welcome to Portal Etude";
            $this->load->view('portal/admin/feereport', array('other_feereport' => $other_feereport, 'teacher' => $teacher, 'title' => $title, 'description' => $description, 'event_teacher' => $event_teacher, 'offline_trial' => $offline_trial, 'dollar' => $dollar, 'euro' => $euro));
        }

        public function data_feereport_summary($periode)
        {
            // $this->cekLogin();
            $id_schedule = null;
            $id_offline_trial = null;
            $dollar = $this->M_Admin->getData_ConvertDollar(null, $periode);
            $euro = $this->M_Admin->getData_ConvertEuro(null, $periode);
            $name_teacher = [];
            $schedule = $this->M_Admin->getData_schedule(null, $periode);
            if (count($schedule) > 0) {
                foreach ($schedule as $ot) {
                    $name_teacher[] = $ot['id_teacher'] . "-" . $ot['name_teacher'];
                }
            }

            $schedule_theory = $this->M_Admin->getData_schedule_theory(null, null, $periode);
            if (count($schedule_theory) > 0) {
                foreach ($schedule_theory as $ot) {
                    $name_teacher[] = $ot['id_teacher'] . "-" . $ot['name_teacher'];
                }
            }

            $pack_online = $this->M_Admin->getData_schedule_package_teacher(null, null, $periode, null, null, 2);
            if (count($pack_online) > 0) {
                foreach ($pack_online as $ot) {
                    $name_teacher[] = $ot['id_teacher'] . "-" . $ot['name_teacher'];
                }
            }
            $pack_online_lesson_add = $this->M_Admin->getData_schedule_package_teacher(null, null, $periode, null, null, 4);
            if (count($pack_online_lesson_add) > 0) {
                foreach ($pack_online_lesson_add as $ot) {
                    $name_teacher[] = $ot['id_teacher'] . "-" . $ot['name_teacher'];
                }
            }
            $pack_online_lesson_cancel = $this->M_Admin->getData_schedule_package_teacher(null, null, $periode, null, null, 3);
            if (count($pack_online_lesson_cancel) > 0) {
                foreach ($pack_online_lesson_cancel as $ot) {
                    $name_teacher[] = $ot['id_teacher'] . "-" . $ot['name_teacher'];
                }
            }

            // $schedule_pratical = $this->M_Admin->getData_schedule_package_teacher(null, null, $periode);
            // if (count($schedule_pratical) > 0) {
            //     foreach ($schedule_pratical as $ot) {
            //         $name_teacher[] = $ot['id_teacher'] . "-" . $ot['name_teacher'];
            //     }
            // }

            $offline_trial = $this->M_Admin->getData_offline_trial($id_offline_trial, $periode);

            $feereport_temp_trial = [];
            $summary_feereport_trial = [];
            $feereport_temp_trial_ex = [];
            $get_payment_date = [];


            if (count($offline_trial) > 0) {
                foreach ($offline_trial as $ot) {
                    $feereport_temp_trial[] = $ot['id_teacher'] . "-" . $ot['name_teacher'];
                    $name_teacher[] = $ot['id_teacher'] . "-" . $ot['name_teacher'];
                }
                $feereport_temp_trial = array_unique($feereport_temp_trial);
                $feereport_temp_trial_im = implode(".", $feereport_temp_trial);
                $feereport_temp_trial_ex = explode(".", $feereport_temp_trial_im);
                sort($feereport_temp_trial_ex);


                for ($i = 0; $i < count($feereport_temp_trial_ex); $i++) {
                    $payment_date = $this->M_Admin->getData_payment_date($periode, substr($feereport_temp_trial_ex[$i], 0, 6));
                    if (count($payment_date) > 0) :
                        $get_payment_date[substr($feereport_temp_trial_ex[$i], 0, 6)] = $payment_date[0]['date'];
                    else :
                        $get_payment_date[substr($feereport_temp_trial_ex[$i], 0, 6)] = '';
                    endif;
                    $temp_sumot = $this->M_Admin->getData_summary_feereport_offline_trial(substr($feereport_temp_trial_ex[$i], 0, 6), $periode);
                    if (count($temp_sumot) > 0) {
                        $summary_feereport_trial[$feereport_temp_trial_ex[$i]] = $temp_sumot;
                    }
                }
            }

            $other_feereport = $this->M_Admin->getData_other_feereport(null, $periode);
            $event_teacher = $this->M_Admin->getData_event_teacher(null, null, $periode);

            $id_teacher_others = [];
            $data_other_teacher = [];
            $data_other_teacher_count = [];
            $count_other_teacher = [];

            if (count($other_feereport) > 0) {
                foreach ($other_feereport as $n) {
                    $id_teacher_others[] = $n['id_teacher'];
                    $count_other_teacher[] = $n['id_teacher'];
                    $name_teacher[] = $ot['id_teacher'] . "-" . $ot['name_teacher'];
                }
                $id_teacher_others = array_unique($id_teacher_others);
                sort($id_teacher_others);
                for ($i = 0; $i < count($id_teacher_others); $i++) {
                    $payment_date = $this->M_Admin->getData_payment_date($periode, $id_teacher_others[$i]);
                    if (count($payment_date) > 0) :
                        $get_payment_date[$id_teacher_others[$i]] = $payment_date[0]['date'];
                    else :
                        $get_payment_date[$id_teacher_others[$i]] = '';
                    endif;
                    $data_temp = $this->M_Admin->getData_other_feereport($id_teacher_others[$i], $periode);
                    foreach ($data_temp as $n) {
                        $data_other_teacher[] = $n['id_teacher'] . "-Others-" . $n['other_note'] . "-" . $n['other_price'];
                        $data_other_teacher_count[$id_teacher_others[$i]][] = $n['other_price'];
                    }
                }
            }

            if (count($event_teacher) > 0) {
                foreach ($event_teacher as $n) {
                    $id_teacher_others[] = $n['id_teacher'];
                    $count_other_teacher[] = $n['id_teacher'];
                    $name_teacher[] = $ot['id_teacher'] . "-" . $ot['name_teacher'];
                }
                $id_teacher_others = array_unique($id_teacher_others);
                sort($id_teacher_others);
                for ($i = 0; $i < count($id_teacher_others); $i++) {
                    $payment_date = $this->M_Admin->getData_payment_date($periode, $id_teacher_others[$i]);
                    if (count($payment_date) > 0) :
                        $get_payment_date[$id_teacher_others[$i]] = $payment_date[0]['date'];
                    else :
                        $get_payment_date[$id_teacher_others[$i]] = '';
                    endif;
                    $data_temp = $this->M_Admin->getData_event_teacher(null, $id_teacher_others[$i], $periode);
                    foreach ($data_temp as $n) {
                        $data_other_teacher[] = $n['id_teacher'] . "-Events-" . $n['event_name'] . "-" . $n['price'];
                        $data_other_teacher_count[$id_teacher_others[$i]][] = $n['price'];
                    }
                }
            }

            for ($i = 0; $i < count($count_other_teacher); $i++) {
                $data_temp = $this->M_Admin->getData_teacher($count_other_teacher[$i]);
                foreach ($data_temp as $n) {
                    $count_other_teacher[$i] = $n['id_teacher'] . "-" . $n['name_teacher'];
                }
            }
            sort($count_other_teacher);
            sort($data_other_teacher);
            for ($i = 0; $i < count($data_other_teacher); $i++) {
                $data_other_teacher[$i] = $data_other_teacher[$i] . "-" . $count_other_teacher[$i];
            }

            // echo var_dump($id_teacher_others) . "<br>";
            // echo var_dump($data_other_teacher) . "<br>";
            // echo var_dump($count_other_teacher) . "<br>";
            // echo var_dump($data_other_teacher_count) . "<br>";
            // echo var_dump($get_payment_date) . "<br>";

            $title = "Data feereport | Portal Etude";
            $description = "Welcome to Portal Etude";
            $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
            $this->load->view('portal/admin/data_feereport_summary', array('feereport_temp_trial' => $feereport_temp_trial_ex, 'summary_feereport_trial' => $summary_feereport_trial, 'id_teacher_others' => $id_teacher_others, 'data_other_teacher' => $data_other_teacher, 'count_other_teacher' => $count_other_teacher, 'data_other_teacher_count' => $data_other_teacher_count, 'get_payment_date' => $get_payment_date, 'name_teacher' => $name_teacher, 'dollar' => $dollar, 'euro' => $euro));
            $this->load->view('portal/reuse/footer');
        }

        public function get_data_feereport_summary_offline($periode)
        {
            // $periode = $_GET['periode'];
            $feereport = $this->M_Admin->getData_schedule(null, $periode);
            $feereport_temp_lesson = [];
            foreach ($feereport as $n) {
                $feereport_temp_lesson[] = $n['id_teacher'] . "-" . $n['name_teacher'];
            }
            $feereport_temp_lesson = array_unique($feereport_temp_lesson);
            sort($feereport_temp_lesson); ?>

        <?php if (!empty($feereport)) : ?>
            <div id="count_data" style="display:none;">
                <?= count($feereport_temp_lesson) ?>
            </div>
            <?php for ($i = 0; $i < count($feereport_temp_lesson); $i++) :  ?>
                <?php $temp_id_course = $this->M_Admin->getData_schedule_idcourse(substr($feereport_temp_lesson[$i], 0, 6), $periode); ?>
                <?php $id_course = []; ?>
                <?php $instrument = []; ?>
                <?php $name_student = []; ?>
                <?php $date = []; ?>
                <?php $date2 = []; ?>
                <?php $fee = []; ?>
                <?php $tot_fee_teacher = []; ?>
                <?php
                                $payment_date = $this->M_Admin->getData_payment_date($periode, substr($feereport_temp_lesson[$i], 0, 6));
                                if (count($payment_date) > 0) :
                                    $get_payment_date[substr($feereport_temp_lesson[$i], 0, 6)] = $payment_date[0]['date'];
                                else :
                                    $get_payment_date[substr($feereport_temp_lesson[$i], 0, 6)] = '';
                                endif;
                                ?>
                <?php for ($z = 0; $z < count($temp_id_course); $z++) : ?>
                    <?php $id_course[] = $temp_id_course[$z]['id_course'] . "-" . $temp_id_course[$z]['nama_course'] . "-" . $temp_id_course[$z]['id_student'] . "-" . $temp_id_course[$z]['fee'] . "-" . $temp_id_course[$z]['instrument'] . "-" . $temp_id_course[$z]['name_student'] ?>
                    <?php $instrument[] = $temp_id_course[$z]['instrument'] ?>
                    <?php $name_student[] = $temp_id_course[$z]['name_student'] ?>
                    <?php $date[] = $temp_id_course[$z]['name_student'] . "-" . substr($temp_id_course[$z]['date'], 8, 2) ?>
                    <?php $date2[$temp_id_course[$z]['id_student']][] = substr($temp_id_course[$z]['date'], 8, 2) ?>
                    <?php $fee[] = $temp_id_course[$z]['fee'] ?>
                <?php endfor; ?>

                <?php $id_course = array_unique($id_course); ?>
                <?php sort($id_course) ?>
                <?php $name_student = array_unique($name_student); ?>
                <?php sort($name_student) ?>
                <?php $fee = array_unique($fee); ?>
                <?php sort($fee) ?>

                <?php $temp_instrument = '' ?>
                <?php for ($b = 0; $b < count($id_course); $b++) : ?>
                    <?php $id_course_ex = explode("-", $id_course[$b]) ?>
                    <tr>
                        <?php if ($b == 0) : ?>
                            <td rowspan="<?= count($id_course) ?>">
                                <?= substr($feereport_temp_lesson[$i], 0, 6) ?>
                            </td>
                        <?php endif; ?>
                        <?php if ($b == 0) : ?>
                            <td rowspan="<?= count($id_course) ?>">
                                <?= substr($feereport_temp_lesson[$i], 7) ?>
                            </td>
                        <?php endif; ?>
                        <?php if ($id_course_ex[4] != $temp_instrument) { ?>
                            <td>
                                <?= $id_course_ex[4] ?>
                            </td>
                        <?php } else { ?>
                            <td style="border:0">
                            </td>
                        <?php } ?>
                        <?php $temp_instrument = $id_course_ex[4] ?>
                        <td>
                            <?= $id_course_ex[5] ?>
                        </td>
                        <td>
                            <?php for ($j = 0; $j < count($date2[$id_course_ex[2]]); $j++) :  ?>
                                <?= $date2[$id_course_ex[2]][$j] ?>,
                            <?php endfor; ?>
                        </td>
                        <td>
                            <?= count($date2[$id_course_ex[2]]) ?>
                        </td>
                        <td>
                            Rp<?= number_format($id_course_ex[3], 0, ".", ".") ?>
                        </td>
                        <td>
                            <?php $tot_tuition = count($date2[$id_course_ex[2]]) * intval($id_course_ex[3]) ?>
                            <?php $temp_id_course_before = $this->M_Admin->getData_schedule_idcourse_before($id_course_ex[0], $periode); ?>

                            <?php $count_date_before = count($temp_id_course_before); ?>
                            <?php $count_date_now = count($date2[$id_course_ex[2]]) ?>
                            <?php $kurang = 4 - $count_date_before ?>
                            <?php $sisa = $count_date_now - $kurang ?>
                            <?php $fee_teacher = 0; ?>

                            <?php if ($count_date_before <= 4) { ?>
                                <?php if ($kurang <= 0) : ?>
                                    <?php $fee_teacher = ($tot_tuition * 80) / 100 ?>
                                    <?php $tot_fee_teacher[substr($feereport_temp_lesson[$i], 0, 6)][] = $fee_teacher; ?>
                                    Rp<?= number_format($fee_teacher, 0, ".", ".") ?>
                                <?php else : ?>
                                    <?php if ($count_date_now <= $kurang) { ?>
                                        <?php $fee_teacher = ($tot_tuition * 50) / 100 ?>
                                        <?php $tot_fee_teacher[substr($feereport_temp_lesson[$i], 0, 6)][] = $fee_teacher; ?>
                                        Rp<?= number_format($fee_teacher, 0, ".", ".") ?>
                                    <?php } else { ?>
                                        <?php $fee_teacher1 = (($kurang * intval($id_course_ex[3])) * 50) / 100 ?>
                                        <?php $fee_teacher2 = (($sisa * intval($id_course_ex[3])) * 80) / 100 ?>
                                        <?php $tot_fee_teacher[substr($feereport_temp_lesson[$i], 0, 6)][] = intval($fee_teacher1) + intval($fee_teacher2); ?>
                                        Pertemuan 50% = Rp<?= number_format($fee_teacher1, 0, ".", ".") ?><br>
                                        Pertemuan 80% = Rp<?= number_format($fee_teacher2, 0, ".", ".") ?><br>
                                        Sub Total => Rp<?= number_format(intval($fee_teacher1) + intval($fee_teacher2), 0, ".", ".") ?><br>
                                    <?php } ?>
                                <?php endif; ?>
                            <?php } else { ?>
                                <?php $fee_teacher = ($tot_tuition * 80) / 100 ?>
                                <?php $tot_fee_teacher[substr($feereport_temp_lesson[$i], 0, 6)][] = $fee_teacher; ?>
                                Rp<?= number_format($fee_teacher, 0, ".", ".") ?>

                            <?php } ?>
                        </td>

                        <?php if ($b == 0) : ?>
                            <td rowspan="<?= count($id_course) ?>" id="tot_lah<?= $i ?>" style="width: 10%;">
                            </td>
                            <td rowspan="<?= count($id_course) ?>" style="width: 10%;">
                                <div>
                                    <input name="date" value="<?= $get_payment_date[substr($feereport_temp_lesson[$i], 0, 6)] ?>" id="payment_date_offline<?= substr($feereport_temp_lesson[$i], 0, 6) ?>" type="date" onchange="handler<?= substr($feereport_temp_lesson[$i], 0, 6) ?>(event);">
                                </div>
                            </td>
                        <?php endif; ?>
                        <?php if ($b == (count($id_course) - 1)) : ?>
                            <td style="display:none" id="temp_lah<?= $i ?>">
                                <?= array_sum($tot_fee_teacher[substr($feereport_temp_lesson[$i], 0, 6)]) ?>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endfor; ?>
            <?php endfor; ?>
        <?php else : ?>
            <tr>
                <td class="text-center" colspan="10">
                    Data Not Avalibale
                </td>
            </tr>
        <?php endif; ?>
    <?php  }

        public function get_data_feereport_summary_online($periode)
        {
            // $periode = $_GET['periode'];
            $online_temp_lesson = [];
            $dollar = $this->M_Admin->getData_ConvertDollar(null, $periode);
            $euro = $this->M_Admin->getData_ConvertEuro(null, $periode);
            $theory = $this->M_Admin->getData_schedule_theory(null, null, $periode);
            foreach ($theory as $n) {
                $online_temp_lesson[] = $n['id_teacher'] . "-" . $n['name_teacher'];
            }

            $pack_online = $this->M_Admin->getData_schedule_package_teacher(null, null, $periode, null, null, 2);
            if (count($pack_online) > 0) {
                foreach ($pack_online as $ot) {
                    $online_temp_lesson[] = $ot['id_teacher'] . "-" . $ot['name_teacher'];
                }
            }
            $pack_online_lesson_add = $this->M_Admin->getData_schedule_package_teacher(null, null, $periode, null, null, 4);
            if (count($pack_online_lesson_add) > 0) {
                foreach ($pack_online_lesson_add as $ot) {
                    $online_temp_lesson[] = $ot['id_teacher'] . "-" . $ot['name_teacher'];
                }
            }
            $pack_online_lesson_cancel = $this->M_Admin->getData_schedule_package_teacher(null, null, $periode, null, null, 3);
            if (count($pack_online_lesson_cancel) > 0) {
                foreach ($pack_online_lesson_cancel as $ot) {
                    $online_temp_lesson[] = $ot['id_teacher'] . "-" . $ot['name_teacher'];
                }
            }

            $pratical = $this->M_Admin->getData_schedule_package_teacher(null, null, $periode);
            // foreach ($pratical as $n) {
            //     $online_temp_lesson[] = $n['id_teacher'] . "-" . $n['name_teacher'];
            // }

            $online_temp_lesson = array_unique($online_temp_lesson);
            sort($online_temp_lesson); ?>

        <?php if (!empty($theory) || !empty($pratical) || !empty($pack_online) || !empty($pack_online_lesson_add) || !empty($pack_online_lesson_cancel)) : ?>
            <!-- <?= count($online_temp_lesson) ?> -->
            <div id="count_data2" style="display:none;">
                <?= count($online_temp_lesson) ?>
            </div>
            <?php for ($i = 0; $i < count($online_temp_lesson); $i++) :  ?>
                <?php $online_temp_lesson_ex[$i] = explode("-", $online_temp_lesson[$i]) ?>

                <?php $id_course = [] ?>
                <?php $date2 = []; ?>
                <?php $tot_fee_teacher = []; ?>

                <?php
                                $payment_date = $this->M_Admin->getData_payment_date($periode, $online_temp_lesson_ex[$i][0]);
                                if (count($payment_date) > 0) :
                                    $get_payment_date[$online_temp_lesson_ex[$i][0]] = $payment_date[0]['date'];
                                else :
                                    $get_payment_date[$online_temp_lesson_ex[$i][0]] = '';
                                endif;
                                ?>

                <?php $temp_id_course_theory = $this->M_Admin->getData_schedule_theory_idcourse($online_temp_lesson_ex[$i][0], $periode); ?>

                <?php for ($z = 0; $z < count($temp_id_course_theory); $z++) : ?>
                    <?php $id_course[] = $temp_id_course_theory[$z]['id_course'] . "-" . $temp_id_course_theory[$z]['id_student'] . "-" . $temp_id_course_theory[$z]['fee'] . "-" . $temp_id_course_theory[$z]['instrument'] . "-" . $temp_id_course_theory[$z]['name_student'] . "-course" ?>

                    <?php $date2[$temp_id_course_theory[$z]['id_student']][3][] = substr($temp_id_course_theory[$z]['date'], 8, 2) ?>
                <?php endfor; ?>

                <?php $temp_id_pack_pratical = $this->M_Admin->getData_schedule_package_idcourse($online_temp_lesson_ex[$i][0], $periode, 2); ?>
                <?php for ($z = 0; $z < count($temp_id_pack_pratical); $z++) : ?>
                    <?php $rate = 0 ?>
                    <?php if ($temp_id_pack_pratical[$z]['jenis'] == '1') : ?>
                        <?php if (($temp_id_pack_pratical[$z]['rate_dollar'] == 1)) { ?>
                            <?php $rate = 475000 ?>
                        <?php } elseif (($temp_id_pack_pratical[$z]['rate_dollar'] == 2)) { ?>
                            <?php if (count($dollar) > 0) { ?>
                                <?php $rate = 48 * intval($dollar[0]['value']); ?>
                            <?php } else { ?>
                                <?php $rate = 48; ?>
                            <?php } ?>
                        <?php } else { ?>
                            <?php if (count($euro) > 0) { ?>
                                <?php $rate = 48 * intval($euro[0]['value']); ?>
                            <?php } else { ?>
                                <?php $rate = 48; ?>
                            <?php } ?>
                        <?php } ?>
                        <?php $id_course[] = $temp_id_pack_pratical[$z]['id_list_pack'] . "-" . $temp_id_pack_pratical[$z]['id_student'] . "-" . $rate . "-" . $temp_id_pack_pratical[$z]['instrument'] . "-" . $temp_id_pack_pratical[$z]['name_student'] . "-pack1" ?>

                        <?php $date2[$temp_id_pack_pratical[$z]['id_student']][1][] = substr($temp_id_pack_pratical[$z]['date_schedule'], 8, 2) ?>
                    <?php else : ?>
                        <?php if (($temp_id_pack_pratical[$z]['rate_dollar'] == 1)) { ?>
                            <?php $rate = 100000 ?>
                        <?php } elseif (($temp_id_pack_pratical[$z]['rate_dollar'] == 2)) { ?>
                            <?php if (count($dollar) > 0) { ?>
                                <?php $rate = 10 * intval($dollar[0]['value']); ?>
                            <?php } else { ?>
                                <?php $rate = 10; ?>
                            <?php } ?>
                        <?php } else { ?>
                            <?php if (count($euro) > 0) { ?>
                                <?php $rate = 10 * intval($euro[0]['value']); ?>
                            <?php } else { ?>
                                <?php $rate = 10; ?>
                            <?php } ?>
                        <?php } ?>
                        <?php $id_course[] = $temp_id_pack_pratical[$z]['id_list_pack'] . "-" . $temp_id_pack_pratical[$z]['id_student'] . "-" . $rate . "-" . $temp_id_pack_pratical[$z]['instrument'] . "-" . $temp_id_pack_pratical[$z]['name_student'] . "-pack2" ?>

                        <?php $date2[$temp_id_pack_pratical[$z]['id_student']][2][] = substr($temp_id_pack_pratical[$z]['date_schedule'], 8, 2) ?>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php $temp_id_pack_pratical_lesson_new = $this->M_Admin->getData_schedule_package_idcourse($online_temp_lesson_ex[$i][0], $periode, 4); ?>
                <?php for ($z = 0; $z < count($temp_id_pack_pratical_lesson_new); $z++) : ?>
                    <?php $rate = 0 ?>
                    <?php if ($temp_id_pack_pratical_lesson_new[$z]['jenis'] == '1') : ?>
                        <?php if (($temp_id_pack_pratical[$z]['rate_dollar'] == 1)) { ?>
                            <?php $rate = 475000 ?>
                        <?php } elseif (($temp_id_pack_pratical[$z]['rate_dollar'] == 2)) { ?>
                            <?php if (count($dollar) > 0) { ?>
                                <?php $rate = 48 * intval($dollar[0]['value']); ?>
                            <?php } else { ?>
                                <?php $rate = 48; ?>
                            <?php } ?>
                        <?php } else { ?>
                            <?php if (count($euro) > 0) { ?>
                                <?php $rate = 48 * intval($euro[0]['value']); ?>
                            <?php } else { ?>
                                <?php $rate = 48; ?>
                            <?php } ?>
                        <?php } ?>
                        <?php $id_course[] = $temp_id_pack_pratical_lesson_new[$z]['id_list_pack'] . "-" . $temp_id_pack_pratical_lesson_new[$z]['id_student'] . "-" . $rate . "-" . $temp_id_pack_pratical_lesson_new[$z]['instrument'] . "-" . $temp_id_pack_pratical_lesson_new[$z]['name_student'] . "-pack1" ?>

                        <?php $date2[$temp_id_pack_pratical_lesson_new[$z]['id_student']][1][] = substr($temp_id_pack_pratical_lesson_new[$z]['date_schedule'], 8, 2) ?>
                    <?php else : ?>
                        <?php if (($temp_id_pack_pratical[$z]['rate_dollar'] == 1)) { ?>
                            <?php $rate = 100000 ?>
                        <?php } elseif (($temp_id_pack_pratical[$z]['rate_dollar'] == 2)) { ?>
                            <?php if (count($dollar) > 0) { ?>
                                <?php $rate = 10 * intval($dollar[0]['value']); ?>
                            <?php } else { ?>
                                <?php $rate = 10; ?>
                            <?php } ?>
                        <?php } else { ?>
                            <?php if (count($euro) > 0) { ?>
                                <?php $rate = 10 * intval($euro[0]['value']); ?>
                            <?php } else { ?>
                                <?php $rate = 10; ?>
                            <?php } ?>
                        <?php } ?>
                        <?php $id_course[] = $temp_id_pack_pratical_lesson_new[$z]['id_list_pack'] . "-" . $temp_id_pack_pratical_lesson_new[$z]['id_student'] . "-" . $rate . "-" . $temp_id_pack_pratical_lesson_new[$z]['instrument'] . "-" . $temp_id_pack_pratical_lesson_new[$z]['name_student'] . "-pack2" ?>

                        <?php $date2[$temp_id_pack_pratical_lesson_new[$z]['id_student']][2][] = substr($temp_id_pack_pratical_lesson_new[$z]['date_schedule'], 8, 2) ?>
                    <?php endif; ?>
                <?php endfor; ?>
                <?php $temp_id_pack_pratical_lesson_cancel = $this->M_Admin->getData_schedule_package_idcourse($online_temp_lesson_ex[$i][0], $periode, 3); ?>
                <?php for ($z = 0; $z < count($temp_id_pack_pratical_lesson_cancel); $z++) : ?>
                    <?php $rate = 0 ?>
                    <?php if ($temp_id_pack_pratical_lesson_cancel[$z]['jenis'] == '1') : ?>
                        <?php if (($temp_id_pack_pratical[$z]['rate_dollar'] == 1)) { ?>
                            <?php $rate = 475000 ?>
                        <?php } elseif (($temp_id_pack_pratical[$z]['rate_dollar'] == 2)) { ?>
                            <?php if (count($dollar) > 0) { ?>
                                <?php $rate = 48 * intval($dollar[0]['value']); ?>
                            <?php } else { ?>
                                <?php $rate = 48; ?>
                            <?php } ?>
                        <?php } else { ?>
                            <?php if (count($euro) > 0) { ?>
                                <?php $rate = 48 * intval($euro[0]['value']); ?>
                            <?php } else { ?>
                                <?php $rate = 48; ?>
                            <?php } ?>
                        <?php } ?>
                        <?php $id_course[] = $temp_id_pack_pratical_lesson_cancel[$z]['id_list_pack'] . "-" . $temp_id_pack_pratical_lesson_cancel[$z]['id_student'] . "-" . $rate . "-" . $temp_id_pack_pratical_lesson_cancel[$z]['instrument'] . "-" . $temp_id_pack_pratical_lesson_cancel[$z]['name_student'] . "-pack1" ?>

                        <?php $date2[$temp_id_pack_pratical_lesson_cancel[$z]['id_student']][1][] = substr($temp_id_pack_pratical_lesson_cancel[$z]['date_update_cancel'], 8, 2) ?>
                    <?php else : ?>
                        <?php if (($temp_id_pack_pratical[$z]['rate_dollar'] == 1)) { ?>
                            <?php $rate = 100000 ?>
                        <?php } elseif (($temp_id_pack_pratical[$z]['rate_dollar'] == 2)) { ?>
                            <?php if (count($dollar) > 0) { ?>
                                <?php $rate = 10 * intval($dollar[0]['value']); ?>
                            <?php } else { ?>
                                <?php $rate = 10; ?>
                            <?php } ?>
                        <?php } else { ?>
                            <?php if (count($euro) > 0) { ?>
                                <?php $rate = 10 * intval($euro[0]['value']); ?>
                            <?php } else { ?>
                                <?php $rate = 10; ?>
                            <?php } ?>
                        <?php } ?>
                        <?php $id_course[] = $temp_id_pack_pratical_lesson_cancel[$z]['id_list_pack'] . "-" . $temp_id_pack_pratical_lesson_cancel[$z]['id_student'] . "-" . $rate . "-" . $temp_id_pack_pratical_lesson_cancel[$z]['instrument'] . "-" . $temp_id_pack_pratical_lesson_cancel[$z]['name_student'] . "-pack2" ?>

                        <?php $date2[$temp_id_pack_pratical_lesson_cancel[$z]['id_student']][2][] = substr($temp_id_pack_pratical_lesson_cancel[$z]['date_update_cancel'], 8, 2) ?>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php $id_course = array_unique($id_course); ?>
                <?php sort($id_course) ?>

                <?php $temp_instrument = '' ?>
                <?php for ($b = 0; $b < count($id_course); $b++) : ?>
                    <?php $id_course_ex = explode("-", $id_course[$b]) ?>
                    <tr>
                        <?php if ($b == 0) : ?>
                            <td rowspan="<?= count($id_course) ?>">
                                <?= $online_temp_lesson_ex[$i][0] ?>
                            </td>
                        <?php endif; ?>
                        <?php if ($b == 0) : ?>
                            <td rowspan="<?= count($id_course) ?>">
                                <?= $online_temp_lesson_ex[$i][1] ?>
                            </td>
                        <?php endif; ?>
                        <?php if ($id_course_ex[3] != $temp_instrument) { ?>
                            <td>
                                <?= $id_course_ex[3] ?>
                            </td>
                        <?php } else { ?>
                            <td style="border:0">
                            </td>
                        <?php } ?>
                        <?php $temp_instrument = $id_course_ex[3] ?>
                        <td>
                            <?= $id_course_ex[4] ?>
                        </td>
                        <td>
                            <?php if ($id_course_ex[5] == "course") : ?>
                                <?php for ($j = 0; $j < count($date2[$id_course_ex[1]][3]); $j++) :  ?>
                                    <?= ($date2[$id_course_ex[1]][3][$j]) ?>,
                                <?php endfor; ?>
                            <?php else : ?>
                                <?php if ($id_course_ex[5] == "pack1") : ?>
                                    <?php for ($j = 0; $j < count($date2[$id_course_ex[1]][1]); $j++) :  ?>
                                        <?= ($date2[$id_course_ex[1]][1][$j]) ?>,
                                    <?php endfor; ?>
                                <?php else : ?>
                                    <?php for ($j = 0; $j < count($date2[$id_course_ex[1]][2]); $j++) :  ?>
                                        <?= ($date2[$id_course_ex[1]][2][$j]) ?>,
                                    <?php endfor; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php $temp_id_pack_now = 0 ?>
                            <?php $temp_id_pack_before = [] ?>
                            <?php $count_pack_now = 0 ?>
                            <?php if ($id_course_ex[5] == "pack1") : ?>
                                <?php $temp_id_pack_before = $this->M_Admin->getData_schedule_pratical_idcourse_before($id_course_ex[0], $periode, 1); ?>
                                <?php $temp_id_pack_now = count($date2[$id_course_ex[1]][1]) ?>
                            <?php endif; ?>
                            <?php if ($id_course_ex[5] == "course") : ?>
                                <?= count($date2[$id_course_ex[1]][3]) ?>
                            <?php else : ?>
                                <?php if ($id_course_ex[5] == "pack1") : ?>
                                    <?php if ((count($temp_id_pack_before) % 2) == 0) : ?>
                                        <?php $count_pack_now =  intval(($temp_id_pack_now / 2) + 0.5) ?>
                                    <?php else : ?>
                                        <?php $count_pack_now =  intval((($temp_id_pack_now - 1) / 2) + 0.5) ?>
                                    <?php endif; ?>
                                    <?= $count_pack_now ?>
                                <?php else : ?>
                                    <?= count($date2[$id_course_ex[1]][2]) ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            Rp<?= number_format($id_course_ex[2], 0, ".", ".") ?>
                        </td>
                        <td>
                            <?php $tot_tuition = 0 ?>
                            <?php $count_date_now = 0 ?>
                            <?php $temp_id_course_before = [] ?>
                            <?php if ($id_course_ex[5] == "course") : ?>
                                <?php $tot_tuition = count($date2[$id_course_ex[1]][3]) * intval($id_course_ex[2]) ?>
                                <?php $temp_id_course_before = $this->M_Admin->getData_schedule_theory_idcourse_before($id_course_ex[0], $periode); ?>
                                <?php $count_date_now = count($date2[$id_course_ex[1]][3]) ?>
                            <?php else : ?>
                                <?php if ($id_course_ex[5] == "pack1") : ?>
                                    <?php $tot_tuition = intval($count_pack_now) * intval($id_course_ex[2]) ?>
                                    <?php $temp_id_course_before = $this->M_Admin->getData_schedule_pratical_idcourse_before($id_course_ex[0], $periode, 1); ?>
                                    <?php $count_date_now = count($date2[$id_course_ex[1]][1]) ?>
                                <?php else : ?>
                                    <?php $tot_tuition = count($date2[$id_course_ex[1]][2]) * intval($id_course_ex[2]) ?>
                                    <?php $temp_id_course_before = $this->M_Admin->getData_schedule_pratical_idcourse_before($id_course_ex[0], $periode, 2); ?>
                                    <?php $count_date_now = count($date2[$id_course_ex[1]][2]) ?>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php $count_date_before = count($temp_id_course_before); ?>
                            <?php $kurang = 4 - $count_date_before ?>
                            <?php $sisa = $count_date_now - $kurang ?>
                            <?php $fee_teacher = 0; ?>

                            <?php if ($count_date_before <= 4) { ?>
                                <?php if ($kurang <= 0) : ?>
                                    <?php $fee_teacher = ($tot_tuition * 80) / 100 ?>
                                    <?php $tot_fee_teacher[$online_temp_lesson_ex[$i][0]][] = $fee_teacher; ?>
                                    Rp<?= number_format($fee_teacher, 0, ".", ".") ?>
                                <?php else : ?>
                                    <?php if ($count_date_now <= $kurang) { ?>
                                        <?php $fee_teacher = ($tot_tuition * 50) / 100 ?>
                                        <?php $tot_fee_teacher[$online_temp_lesson_ex[$i][0]][] = $fee_teacher; ?>
                                        Rp<?= number_format($fee_teacher, 0, ".", ".") ?>
                                    <?php } else { ?>
                                        <?php if ($id_course_ex[5] == "pack1") : ?>
                                            <?php $kurang_praktek = 0 ?>
                                            <?php $sisa_praktek = 0 ?>
                                            <?php if (($kurang % 2) == 0) : ?>
                                                <?php $kurang_praktek =  intval(($kurang / 2) + 0.5) ?>
                                            <?php else : ?>
                                                <?php $kurang_praktek =  intval((($kurang - 1) / 2) + 0.5) ?>
                                            <?php endif; ?>
                                            <?php if (($sisa % 2) == 0) : ?>
                                                <?php $sisa_praktek =  intval(($sisa / 2) + 0.5) ?>
                                            <?php else : ?>
                                                <?php $sisa_praktek =  intval((($sisa - 1) / 2) + 0.5) ?>
                                            <?php endif; ?>
                                            <?php $fee_teacher1 = (($kurang_praktek * intval($id_course_ex[2])) * 50) / 100 ?>
                                            <?php $fee_teacher2 = (($sisa_praktek * intval($id_course_ex[2])) * 80) / 100 ?>
                                            <?php $tot_fee_teacher[$online_temp_lesson_ex[$i][0]][] = intval($fee_teacher1) + intval($fee_teacher2); ?>
                                            Pertemuan 50% = Rp<?= number_format($fee_teacher1, 0, ".", ".") ?><br>
                                            Pertemuan 80% = Rp<?= number_format($fee_teacher2, 0, ".", ".") ?><br>
                                            Sub Total => Rp<?= number_format(intval($fee_teacher1) + intval($fee_teacher2), 0, ".", ".") ?><br>
                                        <?php else : ?>
                                            <?php $fee_teacher1 = (($kurang * intval($id_course_ex[2])) * 50) / 100 ?>
                                            <?php $fee_teacher2 = (($sisa * intval($id_course_ex[2])) * 80) / 100 ?>
                                            <?php $tot_fee_teacher[$online_temp_lesson_ex[$i][0]][] = intval($fee_teacher1) + intval($fee_teacher2); ?>
                                            Pertemuan 50% = Rp<?= number_format($fee_teacher1, 0, ".", ".") ?><br>
                                            Pertemuan 80% = Rp<?= number_format($fee_teacher2, 0, ".", ".") ?><br>
                                            Sub Total => Rp<?= number_format(intval($fee_teacher1) + intval($fee_teacher2), 0, ".", ".") ?><br>
                                        <?php endif; ?>

                                    <?php } ?>
                                <?php endif; ?>
                            <?php } else { ?>
                                <?php $fee_teacher = ($tot_tuition * 80) / 100 ?>
                                <?php $tot_fee_teacher[$online_temp_lesson_ex[$i][0]][] = $fee_teacher; ?>
                                Rp<?= number_format($fee_teacher, 0, ".", ".") ?>

                            <?php } ?>
                        </td>
                        <?php if ($b == 0) : ?>
                            <td rowspan="<?= count($id_course) ?>" id="tot_lah2<?= $i ?>" style="width: 10%;">
                            </td>
                            <td rowspan="<?= count($id_course) ?>" style="width: 10%;">
                                <div>
                                    <input name="date" value="<?= $get_payment_date[$online_temp_lesson_ex[$i][0]] ?>" id="payment_date_online<?= $online_temp_lesson_ex[$i][0] ?>" type="date" onchange="handler<?= $online_temp_lesson_ex[$i][0] ?>(event);">
                                </div>
                            </td>
                        <?php endif; ?>
                        <?php if ($b == (count($id_course) - 1)) : ?>
                            <td style="display:none" id="temp_lah2<?= $i ?>">
                                <?= array_sum($tot_fee_teacher[$online_temp_lesson_ex[$i][0]]) ?>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endfor; ?>
            <?php endfor; ?>
        <?php else : ?>
            <tr>
                <td class="text-center" colspan="10">
                    Data Not Avalibale
                </td>
            </tr>
        <?php endif; ?>
    <?php    }

        public function get_data_feereport_teacher_offline()
        {
            $periode = $_GET['periode'];
            $id_teacher = $_GET['id_teacher'];
            $temp_id_course = $this->M_Admin->getData_summary_feereport($id_teacher, $periode);

            $id_course = [];
            $date2 = [];
            $tot_feereport = []; ?>
        <?php if (count($temp_id_course) > 0) : ?>
            <?php for ($z = 0; $z < count($temp_id_course); $z++) : ?>
                <?php $id_course[] = $temp_id_course[$z]['id_course'] . "-" . $temp_id_course[$z]['id_student'] . "-" .  $temp_id_course[$z]['name_student'] . "-" . $temp_id_course[$z]['fee']; ?>
                <?php $date2[$temp_id_course[$z]['id_student']][] = substr($temp_id_course[$z]['date'], 8, 2); ?>
            <?php endfor; ?>
            <?php $id_course = array_unique($id_course); ?>
            <?php sort($id_course) ?>
            <?php $tot_fee_teacher = [] ?>
            <?php for ($b = 0; $b < count($id_course); $b++) : ?>
                <?php $id_course_ex = explode("-", $id_course[$b]) ?>
                <tr>
                    <td style="width: 3%;"><?= intval($b + 1) ?></td>
                    <td>
                        <?= $id_course_ex[2] ?>
                    </td>
                    <td>
                        <?php for ($j = 0; $j < count($date2[$id_course_ex[1]]); $j++) :  ?>
                            <?= ($date2[$id_course_ex[1]][$j]) ?>,
                        <?php endfor; ?>
                    </td>
                    <td>
                        <?= count($date2[$id_course_ex[1]]) ?>
                    </td>
                    <td>
                        Rp<?= number_format($id_course_ex[3], 0, ".", ".") ?>
                    </td>
                    <td class="pl-4 pr-4 p-0 pt-2" style="width: 20%;">
                        <?php $tot_tuition = count($date2[$id_course_ex[1]]) * intval($id_course_ex[3]) ?>
                        <?php $temp_id_course_before = $this->M_Admin->getData_schedule_idcourse_before($id_course_ex[0], $periode); ?>

                        <?php $count_date_before = count($temp_id_course_before); ?>
                        <?php $count_date_now = count($date2[$id_course_ex[1]]) ?>
                        <?php $kurang = 4 - $count_date_before ?>
                        <?php $sisa = $count_date_now - $kurang ?>
                        <?php $fee_teacher = 0; ?>
                        <?php $tot_feereport[] = $tot_tuition ?>
                        <?php if ($count_date_before <= 4) { ?>
                            <?php if ($kurang <= 0) : ?>
                                <?php $fee_teacher = ($tot_tuition * 80) / 100 ?>
                                <?php $tot_fee_teacher[] = $fee_teacher; ?>
                                <p style="text-align:left;">
                                    Rp
                                    <span style="float:right;">
                                        <?= number_format($fee_teacher, 0, ".", ".") ?>
                                    </span>
                                </p>
                            <?php else : ?>
                                <?php if ($count_date_now <= $kurang) { ?>
                                    <?php $fee_teacher = ($tot_tuition * 50) / 100 ?>
                                    <?php $tot_fee_teacher[] = $fee_teacher; ?>
                                    <p style="text-align:left;">
                                        Rp
                                        <span style="float:right;">
                                            <?= number_format($fee_teacher, 0, ".", ".") ?>
                                        </span>
                                    </p>
                                <?php } else { ?>
                                    <?php $fee_teacher1 = (($kurang * intval($id_course_ex[3])) * 50) / 100 ?>
                                    <?php $fee_teacher2 = (($sisa * intval($id_course_ex[3])) * 80) / 100 ?>
                                    <?php $tot_fee_teacher[] = intval($fee_teacher1) + intval($fee_teacher2); ?>
                                    <p style="text-align:left;">
                                        Rp
                                        <span style="float:right;">
                                            <?= number_format(intval($fee_teacher1) + intval($fee_teacher2), 0, ".", ".") ?>
                                        </span>
                                    </p>
                                <?php } ?>
                            <?php endif; ?>
                        <?php } else { ?>
                            <?php $fee_teacher = ($tot_tuition * 80) / 100 ?>
                            <?php $tot_fee_teacher[] = $fee_teacher; ?>
                            <p style="text-align:left;">
                                Rp
                                <span style="float:right;">
                                    <?= number_format($fee_teacher, 0, ".", ".") ?>
                                </span>
                            </p>
                        <?php } ?>

                    </td>
                </tr>
            <?php endfor; ?>
            <tr>
                <td colspan="5" class="text-center">
                    Sub Total
                </td>
                <td colspan="3" class="pl-4 pr-4 p-0 pt-2" style="width: 20%;">
                    <input type="hidden" name="tot_parent" id="tot_parent_offline" value="<?= array_sum($tot_fee_teacher) ?>">
                    <p style="text-align:left;">
                        Rp
                        <span style="float:right;">
                            <?= number_format(array_sum($tot_fee_teacher), 0, ".", ".") ?>
                        </span>
                    </p>
                </td>
            </tr>
        <?php else : ?>
            <?php $tot_fee_teacher = 0 ?>
            <tr>
                <td style="width: 3%;"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="pl-4 pr-4 p-0 pt-2" style="width: 20%;">
                    <p style="text-align:left;">
                        Rp
                        <span style="float:right;">
                            <?= number_format($tot_fee_teacher, 0, ".", ".") ?>
                        </span>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="5" class="text-center">
                    Sub Total
                </td>
                <td colspan="3" class="pl-4 pr-4 p-0 pt-2" style="width: 20%;">
                    <input type="hidden" name="tot_parent" id="tot_parent_offline" value="<?= $tot_fee_teacher ?>">
                    <p style="text-align:left;">
                        Rp
                        <span style="float:right;">
                            <?= number_format($tot_fee_teacher, 0, ".", ".") ?>
                        </span>
                    </p>
                </td>
            </tr>
        <?php endif;
            }

            public function get_data_feereport_teacher_online($periode, $id_teacher)
            {
                // $periode = $_GET['periode'];
                // $id_teacher = $_GET['id_teacher'];
                $dollar = $this->M_Admin->getData_ConvertDollar(null, $periode);
                $euro = $this->M_Admin->getData_ConvertEuro(null, $periode);
                $id_course = [];
                $date2 = [];
                $tot_feereport = []; ?>
        <?php $temp_id_course_theory = $this->M_Admin->getData_schedule_theory_idcourse($id_teacher, $periode); ?>
        <?php for ($z = 0; $z < count($temp_id_course_theory); $z++) : ?>
            <?php $id_course[] = $temp_id_course_theory[$z]['id_course'] . "-" . $temp_id_course_theory[$z]['id_student'] . "-" . $temp_id_course_theory[$z]['fee'] . "-" . $temp_id_course_theory[$z]['instrument'] . "-" . $temp_id_course_theory[$z]['name_student'] . "-course" ?>

            <?php $date2[$temp_id_course_theory[$z]['id_student']][3][] = substr($temp_id_course_theory[$z]['date'], 8, 2) ?>
        <?php endfor; ?>


        <?php $temp_id_pack_pratical = $this->M_Admin->getData_schedule_package_idcourse($id_teacher, $periode, 2); ?>
        <?php for ($z = 0; $z < count($temp_id_pack_pratical); $z++) : ?>
            <?php $rate = 0 ?>
            <?php if ($temp_id_pack_pratical[$z]['jenis'] == '1') : ?>
                <?php if (($temp_id_pack_pratical[$z]['rate_dollar'] == 1)) { ?>
                    <?php $rate = 475000 ?>
                <?php } elseif (($temp_id_pack_pratical[$z]['rate_dollar'] == 2)) { ?>
                    <?php if (count($dollar) > 0) { ?>
                        <?php $rate = 48 * intval($dollar[0]['value']); ?>
                    <?php } else { ?>
                        <?php $rate = 48; ?>
                    <?php } ?>
                <?php } else { ?>
                    <?php if (count($euro) > 0) { ?>
                        <?php $rate = 48 * intval($euro[0]['value']); ?>
                    <?php } else { ?>
                        <?php $rate = 48; ?>
                    <?php } ?>
                <?php } ?>
                <?php $id_course[] = $temp_id_pack_pratical[$z]['id_list_pack'] . "-" . $temp_id_pack_pratical[$z]['id_student'] . "-" . $rate . "-" . $temp_id_pack_pratical[$z]['instrument'] . "-" . $temp_id_pack_pratical[$z]['name_student'] . "-pack1" ?>

                <?php $date2[$temp_id_pack_pratical[$z]['id_student']][1][] = substr($temp_id_pack_pratical[$z]['date_schedule'], 8, 2) ?>
            <?php else : ?>
                <?php if (($temp_id_pack_pratical[$z]['rate_dollar'] == 1)) { ?>
                    <?php $rate = 100000 ?>
                <?php } elseif (($temp_id_pack_pratical[$z]['rate_dollar'] == 2)) { ?>
                    <?php if (count($dollar) > 0) { ?>
                        <?php $rate = 10 * intval($dollar[0]['value']); ?>
                    <?php } else { ?>
                        <?php $rate = 10; ?>
                    <?php } ?>
                <?php } else { ?>
                    <?php if (count($euro) > 0) { ?>
                        <?php $rate = 10 * intval($euro[0]['value']); ?>
                    <?php } else { ?>
                        <?php $rate = 10; ?>
                    <?php } ?>
                <?php } ?>
                <?php $id_course[] = $temp_id_pack_pratical[$z]['id_list_pack'] . "-" . $temp_id_pack_pratical[$z]['id_student'] . "-" . $rate . "-" . $temp_id_pack_pratical[$z]['instrument'] . "-" . $temp_id_pack_pratical[$z]['name_student'] . "-pack2" ?>

                <?php $date2[$temp_id_pack_pratical[$z]['id_student']][2][] = substr($temp_id_pack_pratical[$z]['date_schedule'], 8, 2) ?>
            <?php endif; ?>
        <?php endfor; ?>

        <?php $temp_id_pack_pratical_lesson_new = $this->M_Admin->getData_schedule_package_idcourse($id_teacher, $periode, 4); ?>
        <?php for ($z = 0; $z < count($temp_id_pack_pratical_lesson_new); $z++) : ?>
            <?php $rate = 0 ?>
            <?php if ($temp_id_pack_pratical_lesson_new[$z]['jenis'] == '1') : ?>
                <?php if (($temp_id_pack_pratical_lesson_new[$z]['rate_dollar'] == 1)) { ?>
                    <?php $rate = 475000 ?>
                <?php } elseif (($temp_id_pack_pratical_lesson_new[$z]['rate_dollar'] == 2)) { ?>
                    <?php if (count($dollar) > 0) { ?>
                        <?php $rate = 48 * intval($dollar[0]['value']); ?>
                    <?php } else { ?>
                        <?php $rate = 48; ?>
                    <?php } ?>
                <?php } else { ?>
                    <?php if (count($euro) > 0) { ?>
                        <?php $rate = 48 * intval($euro[0]['value']); ?>
                    <?php } else { ?>
                        <?php $rate = 48; ?>
                    <?php } ?>
                <?php } ?>
                <?php $id_course[] = $temp_id_pack_pratical_lesson_new[$z]['id_list_pack'] . "-" . $temp_id_pack_pratical_lesson_new[$z]['id_student'] . "-" . $rate . "-" . $temp_id_pack_pratical_lesson_new[$z]['instrument'] . "-" . $temp_id_pack_pratical_lesson_new[$z]['name_student'] . "-pack1" ?>

                <?php $date2[$temp_id_pack_pratical_lesson_new[$z]['id_student']][1][] = substr($temp_id_pack_pratical_lesson_new[$z]['date_schedule'], 8, 2) ?>
            <?php else : ?>
                <?php if (($temp_id_pack_pratical_lesson_new[$z]['rate_dollar'] == 1)) { ?>
                    <?php $rate = 100000 ?>
                <?php } elseif (($temp_id_pack_pratical_lesson_new[$z]['rate_dollar'] == 2)) { ?>
                    <?php if (count($dollar) > 0) { ?>
                        <?php $rate = 10 * intval($dollar[0]['value']); ?>
                    <?php } else { ?>
                        <?php $rate = 10; ?>
                    <?php } ?>
                <?php } else { ?>
                    <?php if (count($euro) > 0) { ?>
                        <?php $rate = 10 * intval($euro[0]['value']); ?>
                    <?php } else { ?>
                        <?php $rate = 10; ?>
                    <?php } ?>
                <?php } ?>
                <?php $id_course[] = $temp_id_pack_pratical_lesson_new[$z]['id_list_pack'] . "-" . $temp_id_pack_pratical_lesson_new[$z]['id_student'] . "-" . $rate . "-" . $temp_id_pack_pratical_lesson_new[$z]['instrument'] . "-" . $temp_id_pack_pratical_lesson_new[$z]['name_student'] . "-pack2" ?>

                <?php $date2[$temp_id_pack_pratical_lesson_new[$z]['id_student']][2][] = substr($temp_id_pack_pratical_lesson_new[$z]['date_schedule'], 8, 2) ?>
            <?php endif; ?>
        <?php endfor; ?>
        <?php $temp_id_pack_pratical_lesson_cancel = $this->M_Admin->getData_schedule_package_idcourse($id_teacher, $periode, 3); ?>
        <?php for ($z = 0; $z < count($temp_id_pack_pratical_lesson_cancel); $z++) : ?>
            <?php $rate = 0 ?>
            <?php if ($temp_id_pack_pratical_lesson_cancel[$z]['jenis'] == '1') : ?>
                <?php if (($temp_id_pack_pratical_lesson_cancel[$z]['rate_dollar'] == 1)) { ?>
                    <?php $rate = 475000 ?>
                <?php } elseif (($temp_id_pack_pratical_lesson_cancel[$z]['rate_dollar'] == 2)) { ?>
                    <?php if (count($dollar) > 0) { ?>
                        <?php $rate = 48 * intval($dollar[0]['value']); ?>
                    <?php } else { ?>
                        <?php $rate = 48; ?>
                    <?php } ?>
                <?php } else { ?>
                    <?php if (count($euro) > 0) { ?>
                        <?php $rate = 48 * intval($euro[0]['value']); ?>
                    <?php } else { ?>
                        <?php $rate = 48; ?>
                    <?php } ?>
                <?php } ?>
                <?php $id_course[] = $temp_id_pack_pratical_lesson_cancel[$z]['id_list_pack'] . "-" . $temp_id_pack_pratical_lesson_cancel[$z]['id_student'] . "-" . $rate . "-" . $temp_id_pack_pratical_lesson_cancel[$z]['instrument'] . "-" . $temp_id_pack_pratical_lesson_cancel[$z]['name_student'] . "-pack1" ?>

                <?php $date2[$temp_id_pack_pratical_lesson_cancel[$z]['id_student']][1][] = substr($temp_id_pack_pratical_lesson_cancel[$z]['date_update_cancel'], 8, 2) ?>
            <?php else : ?>
                <?php if (($temp_id_pack_pratical_lesson_cancel[$z]['rate_dollar'] == 1)) { ?>
                    <?php $rate = 100000 ?>
                <?php } elseif (($temp_id_pack_pratical_lesson_cancel[$z]['rate_dollar'] == 2)) { ?>
                    <?php if (count($dollar) > 0) { ?>
                        <?php $rate = 10 * intval($dollar[0]['value']); ?>
                    <?php } else { ?>
                        <?php $rate = 10; ?>
                    <?php } ?>
                <?php } else { ?>
                    <?php if (count($euro) > 0) { ?>
                        <?php $rate = 10 * intval($euro[0]['value']); ?>
                    <?php } else { ?>
                        <?php $rate = 10; ?>
                    <?php } ?>
                <?php } ?>
                <?php $id_course[] = $temp_id_pack_pratical_lesson_cancel[$z]['id_list_pack'] . "-" . $temp_id_pack_pratical_lesson_cancel[$z]['id_student'] . "-" . $rate . "-" . $temp_id_pack_pratical_lesson_cancel[$z]['instrument'] . "-" . $temp_id_pack_pratical_lesson_cancel[$z]['name_student'] . "-pack2" ?>

                <?php $date2[$temp_id_pack_pratical_lesson_cancel[$z]['id_student']][2][] = substr($temp_id_pack_pratical_lesson_cancel[$z]['date_update_cancel'], 8, 2) ?>
            <?php endif; ?>
        <?php endfor; ?>


        <?php $id_course = array_unique($id_course); ?>
        <?php sort($id_course) ?>

        <?php $temp_instrument = '' ?>
        <?php if (count($id_course) > 0) : ?>
            <?php $tot_fee_teacher = [] ?>
            <?php for ($b = 0; $b < count($id_course); $b++) : ?>
                <?php $id_course_ex = explode("-", $id_course[$b]) ?>
                <tr>
                    <td style="width: 3%;"><?= intval($b + 1) ?></td>
                    <td>
                        <?php if ($id_course_ex[5] == "course" || $id_course_ex[5] == "pack2") : ?>
                            <?= $id_course_ex[4] ?> (Theory Lesson)
                        <?php else : ?>
                            <?= $id_course_ex[4] ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($id_course_ex[5] == "course") : ?>
                            <?php for ($j = 0; $j < count($date2[$id_course_ex[1]][3]); $j++) :  ?>
                                <?= ($date2[$id_course_ex[1]][3][$j]) ?>,
                            <?php endfor; ?>
                        <?php else : ?>
                            <?php if ($id_course_ex[5] == "pack1") : ?>
                                <?php for ($j = 0; $j < count($date2[$id_course_ex[1]][1]); $j++) :  ?>
                                    <?= ($date2[$id_course_ex[1]][1][$j]) ?>,
                                <?php endfor; ?>
                            <?php else : ?>
                                <?php for ($j = 0; $j < count($date2[$id_course_ex[1]][2]); $j++) :  ?>
                                    <?= ($date2[$id_course_ex[1]][2][$j]) ?>,
                                <?php endfor; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php $temp_id_pack_now = 0 ?>
                        <?php $temp_id_pack_before = [] ?>
                        <?php $count_pack_now = 0 ?>
                        <?php if ($id_course_ex[5] == "pack1") : ?>
                            <?php $temp_id_pack_before = $this->M_Admin->getData_schedule_pratical_idcourse_before($id_course_ex[0], $periode, 1); ?>
                            <?php $temp_id_pack_now = count($date2[$id_course_ex[1]][1]) ?>
                        <?php endif; ?>
                        <?php if ($id_course_ex[5] == "course") : ?>
                            <?= count($date2[$id_course_ex[1]][3]) ?>
                        <?php else : ?>
                            <?php if ($id_course_ex[5] == "pack1") : ?>
                                <?php if ((count($temp_id_pack_before) % 2) == 0) : ?>
                                    <?php $count_pack_now =  intval(($temp_id_pack_now / 2) + 0.5) ?>
                                <?php else : ?>
                                    <?php $count_pack_now =  intval((($temp_id_pack_now - 1) / 2) + 0.5) ?>
                                <?php endif; ?>
                                <?= $count_pack_now ?>
                            <?php else : ?>
                                <?= count($date2[$id_course_ex[1]][2]) ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        Rp<?= number_format($id_course_ex[2], 0, ".", ".") ?>
                    </td>
                    <td>
                        <?php $tot_tuition = 0 ?>
                        <?php $count_date_now = 0 ?>
                        <?php $temp_id_course_before = [] ?>
                        <?php if ($id_course_ex[5] == "course") : ?>
                            <?php $tot_tuition = count($date2[$id_course_ex[1]][3]) * intval($id_course_ex[2]) ?>
                            <?php $temp_id_course_before = $this->M_Admin->getData_schedule_theory_idcourse_before($id_course_ex[0], $periode); ?>
                            <?php $count_date_now = count($date2[$id_course_ex[1]][3]) ?>
                        <?php else : ?>
                            <?php if ($id_course_ex[5] == "pack1") : ?>
                                <?php $tot_tuition = intval($count_pack_now) * intval($id_course_ex[2]) ?>
                                <?php $temp_id_course_before = $this->M_Admin->getData_schedule_pratical_idcourse_before(null, $periode, 1, $id_teacher, $id_course_ex[1]); ?>
                                <?php $count_date_now = count($date2[$id_course_ex[1]][1]) ?>
                            <?php else : ?>
                                <?php $tot_tuition = count($date2[$id_course_ex[1]][2]) * intval($id_course_ex[2]) ?>
                                <?php $temp_id_course_before = $this->M_Admin->getData_schedule_pratical_idcourse_before(null, $periode, 2, $id_teacher, $id_course_ex[1]); ?>
                                <?php $count_date_now = count($date2[$id_course_ex[1]][2]) ?>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php $count_date_before = count($temp_id_course_before); ?>
                        <?php $kurang = 4 - $count_date_before ?>
                        <?php $sisa = $count_date_now - $kurang ?>

                        <?php $fee_teacher = 0; ?>
                        <?php if ($count_date_before <= 4) { ?>
                            <?php if ($kurang <= 0) : ?>
                                <?php $fee_teacher = ($tot_tuition * 80) / 100 ?>
                                <?php $tot_fee_teacher[] = $fee_teacher; ?>
                                <p style="text-align:left;">
                                    Rp
                                    <span style="float:right;">
                                        <?= number_format($fee_teacher, 0, ".", ".") ?>
                                    </span>
                                </p>
                            <?php else : ?>
                                <?php if ($count_date_now <= $kurang) { ?>
                                    <?php $fee_teacher = ($tot_tuition * 50) / 100 ?>
                                    <?php $tot_fee_teacher[] = $fee_teacher; ?>
                                    <p style="text-align:left;">
                                        Rp
                                        <span style="float:right;">
                                            <?= number_format($fee_teacher, 0, ".", ".") ?>
                                        </span>
                                    </p>
                                <?php } else { ?>
                                    <?php if ($id_course_ex[5] == "pack1") : ?>
                                        <?php $kurang_praktek = 0 ?>
                                        <?php $sisa_praktek = 0 ?>
                                        <?php if (($kurang % 2) == 0) : ?>
                                            <?php $kurang_praktek =  intval(($kurang / 2) + 0.5) ?>
                                        <?php else : ?>
                                            <?php $kurang_praktek =  intval((($kurang - 1) / 2) + 0.5) ?>
                                        <?php endif; ?>
                                        <?php if (($sisa % 2) == 0) : ?>
                                            <?php $sisa_praktek =  intval(($sisa / 2) + 0.5) ?>
                                        <?php else : ?>
                                            <?php $sisa_praktek =  intval((($sisa - 1) / 2) + 0.5) ?>
                                        <?php endif; ?>
                                        <?php $fee_teacher1 = (($kurang_praktek * intval($id_course_ex[2])) * 50) / 100 ?>
                                        <?php $fee_teacher2 = (($sisa_praktek * intval($id_course_ex[2])) * 80) / 100 ?>
                                        <?php $tot_fee_teacher[] = intval($fee_teacher1) + intval($fee_teacher2); ?>
                                        <p style="text-align:left;">
                                            Rp
                                            <span style="float:right;">
                                                <?= number_format(intval($fee_teacher1) + intval($fee_teacher2), 0, ".", ".") ?>
                                            </span>
                                        </p>
                                    <?php else : ?>
                                        <?php $fee_teacher1 = (($kurang * intval($id_course_ex[2])) * 50) / 100 ?>
                                        <?php $fee_teacher2 = (($sisa * intval($id_course_ex[2])) * 80) / 100 ?>
                                        <?php $tot_fee_teacher[] = intval($fee_teacher1) + intval($fee_teacher2); ?>
                                        <p style="text-align:left;">
                                            Rp
                                            <span style="float:right;">
                                                <?= number_format(intval($fee_teacher1) + intval($fee_teacher2), 0, ".", ".") ?>
                                            </span>
                                        </p>
                                    <?php endif; ?>
                                <?php } ?>
                            <?php endif; ?>
                        <?php } else { ?>
                            <?php $fee_teacher = ($tot_tuition * 80) / 100 ?>
                            <?php $tot_fee_teacher[] = $fee_teacher; ?>
                            <p style="text-align:left;">
                                Rp
                                <span style="float:right;">
                                    <?= number_format($fee_teacher, 0, ".", ".") ?>
                                </span>
                            </p>
                        <?php } ?>
                    </td>
                </tr>
            <?php endfor; ?>
            <tr>
                <td colspan="5" class="text-center">
                    Sub Total
                </td>
                <td colspan="3" class="pl-4 pr-4 p-0 pt-2" style="width: 20%;">
                    <input type="hidden" name="tot_parent" id="tot_parent_online" value="<?= array_sum($tot_fee_teacher) ?>">
                    <p style="text-align:left;">
                        Rp
                        <span style="float:right;">
                            <?= number_format(array_sum($tot_fee_teacher), 0, ".", ".") ?>
                        </span>
                    </p>
                </td>
            </tr>
        <?php else : ?>
            <?php $tot_fee_teacher = 0 ?>
            <tr>
                <td style="width: 3%;"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="pl-4 pr-4 p-0 pt-2" style="width: 20%;">
                    <p style="text-align:left;">
                        Rp
                        <span style="float:right;">
                            <?= number_format($tot_fee_teacher, 0, ".", ".") ?>
                        </span>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="5" class="text-center">
                    Sub Total
                </td>
                <td colspan="3" class="pl-4 pr-4 p-0 pt-2" style="width: 20%;">
                    <input type="hidden" name="tot_parent" id="tot_parent_online" value="<?= $tot_fee_teacher ?>">
                    <p style="text-align:left;">
                        Rp
                        <span style="float:right;">
                            <?= number_format($tot_fee_teacher, 0, ".", ".") ?>
                        </span>
                    </p>
                </td>
            </tr>
<?php endif;
    }

    public function data_feereport_new()
    {
        $this->cekLogin();
        $feereport = $this->M_Admin->getData_sirkulasi_feereport();
        $feereport_temp = [];
        foreach ($feereport as $n) {
            $feereport_temp[] = substr($n['created_at'], 0, 7);
        }
        $feereport_temp = array_unique($feereport_temp);
        rsort($feereport_temp);

        // $fee_report = $this->M_Admin->getData_sirkulasi_feereport();
        // echo var_dump($fee_report);

        $title = "Data feereport | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/feereport/data', array('feereport_temp' => $feereport_temp));
        $this->load->view('portal/reuse/footer');
    }

    public function data_feereport_periode_new($periode)
    {
        $this->cekLogin();

        $feereport = $this->M_Admin->getData_sirkulasi_feereport(null, null, null, $periode);
        $feereport_temp = [];
        foreach ($feereport as $n) {
            $feereport_temp[] = $n['id_teacher'] . "-" . $n['name_teacher'];
        }
        $feereport_temp = array_unique($feereport_temp);
        rsort($feereport_temp);

        $title = "Data feereport | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/feereport/data_teacher', array('feereport_temp' => $feereport_temp));
        $this->load->view('portal/reuse/footer');
    }

    public function data_feereport_view_new($periode, $id_teacher)
    {
        $this->cekLogin();
        $teacher = $this->M_Admin->getData_teacher($id_teacher);
        $feereport = $this->M_Admin->getData_sirkulasi_lesson_detail(null, null, $id_teacher, null, null, $periode);
        $feereport_before = $this->M_Admin->getData_sirkulasi_lesson_detail_before_periode(null, null, $id_teacher, null, null, $periode, 50);

        //cek id student
        $id_student_nadia_paket_pratical = [];
        $id_student_nadia_paket_teory = [];
        $id_student_nadia_offline_lesson = [];

        $id_student_paket_pratical = [];
        $id_student_paket_teory = [];
        $id_student_offline_lesson = [];

        // echo var_dump($feereport);
        // echo "<br>";
        // echo "<br>";
        foreach ($feereport as $n) {
            if($n['id_teacher'] == '200001'){
                if ($n['tipe'] == 1) {
                    $rate_dollar = $this->M_Admin->getData_list_pack($n['id_list_pack']);
                    $id_student_nadia_paket_pratical[] = $n['id_student'] . "&" . $n['name_student']  . "&" . $n['name_paket'] . "&" . $n['price'] . "&1&" . $n['id_list_pack'] . "&" . $n['no_sirkulasi_lesson'] ."&" . $rate_dollar[0]['rate_dollar'];
                }
                if ($n['tipe'] == 2) {
                    $rate_dollar = $this->M_Admin->getData_list_pack($n['id_list_pack']);
                    $id_student_nadia_paket_teory[] = $n['id_student'] . "&" . $n['name_student']  . "&" . $n['name_paket'] . "&" . $n['price'] . "&2&" . $n['id_list_pack'] . "&" . $n['no_sirkulasi_lesson'] . "&" . $rate_dollar[0]['rate_dollar'];
                }
                if ($n['tipe'] == 3) {
                    $id_student_nadia_offline_lesson[] = $n['id_student'] . "&" . $n['name_student']  . "&" . $n['name_paket'] . "&" . $n['price'] . "&3&" . $n['id_offline_lesson'] . "&" . $n['no_sirkulasi_lesson'];
                }
            }else{
                if ($n['tipe'] == 1) {
                    $id_student_paket_pratical[] = $n['id_student'] . "&" . $n['name_student']  . "&" . $n['name_paket'] . "&" . $n['price'] . "&" . $n['rate'] . "&1&" . $n['id_list_pack'] . "&" . $n['no_sirkulasi_lesson'];
                }
                if ($n['tipe'] == 2) {
                    $id_student_paket_teory[] = $n['id_student'] . "&" . $n['name_student']  . "&" . $n['name_paket'] . "&" . $n['price'] . "&" . $n['rate'] . "&2&" . $n['id_list_pack'] . "&" . $n['no_sirkulasi_lesson'];
                }
                if ($n['tipe'] == 3) {
                    $id_student_offline_lesson[] = $n['id_student'] . "&" . $n['name_student']  . "&" . $n['name_paket'] . "&" . $n['price'] . "&" . $n['rate'] . "&3&" . $n['id_offline_lesson'] . "&" . $n['no_sirkulasi_lesson'];
                }
            }
        }

        $id_student_nadia_paket_pratical_temp = array_unique($id_student_nadia_paket_pratical);
        rsort($id_student_nadia_paket_pratical_temp);

        $id_student_nadia_paket_teory_temp = array_unique($id_student_nadia_paket_teory);
        rsort($id_student_nadia_paket_teory_temp);

        $id_student_nadia_offline_lesson_temp = array_unique($id_student_nadia_offline_lesson);
        rsort($id_student_nadia_offline_lesson_temp);

        $id_student_paket_pratical_temp = array_unique($id_student_paket_pratical);
        rsort($id_student_paket_pratical_temp);

        $id_student_paket_teory_temp = array_unique($id_student_paket_teory);
        rsort($id_student_paket_teory_temp);

        $id_student_offline_lesson_temp = array_unique($id_student_offline_lesson);
        rsort($id_student_offline_lesson_temp);

        //cek periode before
        $tipe_rate100_paket_pratical_before = [];
        $tipe_rate50_paket_pratical_before = [];
        $tipe_rate_paket_pratical_before = [];

        $tipe_rate100_paket_teory_before = [];
        $tipe_rate50_paket_teory_before = [];
        $tipe_rate_paket_teory_before = [];

        $tipe_rate100_offline_lesson_before = [];
        $tipe_rate50_offline_lesson_before = [];
        $tipe_rate_offline_lesson_before = [];

        //cek periode
        $tipe_rate100_paket_pratical = [];
        $tipe_rate50_paket_pratical = [];
        $tipe_rate_paket_pratical = [];

        $tipe_rate100_paket_teory = [];
        $tipe_rate50_paket_teory = [];
        $tipe_rate_paket_teory = [];

        $tipe_rate100_offline_lesson = [];
        $tipe_rate50_offline_lesson = [];
        $tipe_rate_offline_lesson = [];

        //cek total pack 
        $total_pack_periode_rate100_paket_pratical = [];
        $total_pack_periode_rate50_paket_pratical = [];
        $total_pack_periode_rate_paket_pratical = [];

        $total_pack_periode_rate100_paket_teory = [];
        $total_pack_periode_rate50_paket_teory = [];
        $total_pack_periode_rate_paket_teory = [];

        $total_pack_periode_rate100_offline_lesson = [];
        $total_pack_periode_rate50_offline_lesson = [];
        $total_pack_periode_rate_offline_lesson = [];

        //cek total Fee teacher
        $total_fee_periode_rate100_paket_pratical = [];
        $total_fee_periode_rate50_paket_pratical = [];
        $total_fee_periode_rate_paket_pratical = [];

        $total_fee_periode_rate100_paket_teory = [];
        $total_fee_periode_rate50_paket_teory = [];
        $total_fee_periode_rate_paket_teory = [];

        $total_fee_periode_rate100_offline_lesson = [];
        $total_fee_periode_rate50_offline_lesson = [];
        $total_fee_periode_rate_offline_lesson = [];

        //cek date lesson
        $date_rate100_paket_pratical = [];
        $date_rate50_paket_pratical = [];
        $date_rate_paket_pratical = [];

        $date_rate100_paket_teory = [];
        $date_rate50_paket_teory = [];
        $date_rate_paket_teory = [];

        $date_rate100_offline_lesson = [];
        $date_rate50_offline_lesson = [];
        $date_rate_offline_lesson = [];

        //notes
        $notes_rate50_paket_pratical = [];
        $notes_rate50_paket_teory = [];
        $notes_rate50_offline_lesson = [];

        sort($id_student_paket_pratical_temp);
        sort($id_student_paket_teory_temp);
        sort($id_student_offline_lesson_temp);

        // echo var_dump($id_student_nadia_paket_pratical_temp);
        // echo "<br>";
        // echo "<br>";
        // echo var_dump($id_student_nadia_paket_teory_temp);
        // echo "<br>";
        // echo "<br>";
        // echo var_dump($id_student_nadia_offline_lesson_temp);
        // echo "<br>";
        // echo "<br>";

        $date_temp_for_teory = null;
        $index_teory = [];
        if($id_teacher == '200001'){
            for ($i = 0; $i < count($id_student_nadia_paket_pratical_temp); $i++) {
                $id_student_nadia_paket_pratical_temp2[$i] = explode("&", $id_student_nadia_paket_pratical_temp[$i]);
                $temp_before_rate100_paket_pratical = $this->M_Admin->getData_sirkulasi_lesson_detail_before_periode(null, null, null, $id_student_nadia_paket_pratical_temp2[$i][0], $id_student_nadia_paket_pratical_temp2[$i][4], $periode, null, $id_student_nadia_paket_pratical_temp2[$i][5]);
                $tipe_rate100_paket_pratical_before[$id_student_nadia_paket_pratical_temp2[$i][6]] = count($temp_before_rate100_paket_pratical);

                $temp_rate100_paket_pratical = $this->M_Admin->getData_sirkulasi_lesson_detail(null, null, null, $id_student_nadia_paket_pratical_temp2[$i][0], $id_student_nadia_paket_pratical_temp2[$i][4], $periode, null, $id_student_nadia_paket_pratical_temp2[$i][5]);
                $tipe_rate100_paket_pratical[$id_student_nadia_paket_pratical_temp2[$i][6]] = count($temp_rate100_paket_pratical);
                $date_rate100_paket_pratical[$id_student_nadia_paket_pratical_temp2[$i][6]] = [];

                if (($tipe_rate100_paket_pratical_before[$id_student_nadia_paket_pratical_temp2[$i][6]] % 2) == 0) {
                    $total_pack_periode_rate100_paket_pratical[$id_student_nadia_paket_pratical_temp2[$i][6]] = round($tipe_rate100_paket_pratical[$id_student_nadia_paket_pratical_temp2[$i][6]] / 2);
                    foreach ($temp_rate100_paket_pratical as $n) {
                        array_push($date_rate100_paket_pratical[$id_student_nadia_paket_pratical_temp2[$i][6]], date_format(date_create(substr($n['lesson_date'], 0, 10)), "d"));
                    }
                } else {
                    $a = 1;
                    foreach ($temp_rate100_paket_pratical as $n) {
                        if ($a == 1) {
                            array_push($date_rate100_paket_pratical[$id_student_nadia_paket_pratical_temp2[$i][6]], date_format(date_create(substr($n['lesson_date'], 0, 10)), "(d)"));
                        } else {
                            array_push($date_rate100_paket_pratical[$id_student_nadia_paket_pratical_temp2[$i][6]], date_format(date_create(substr($n['lesson_date'], 0, 10)), "d"));
                        }
                        $a += 1;
                    }
                    $total_pack_periode_rate100_paket_pratical[$id_student_nadia_paket_pratical_temp2[$i][6]] = round(($tipe_rate100_paket_pratical[$id_student_nadia_paket_pratical_temp2[$i][6]] - 1) / 2);
                }
                $date_rate100_paket_pratical[$id_student_nadia_paket_pratical_temp2[$i][6]] = implode(", ", $date_rate100_paket_pratical[$id_student_nadia_paket_pratical_temp2[$i][6]]);
                $total_fee_periode_rate100_paket_pratical[$id_student_nadia_paket_pratical_temp2[$i][6]] = $total_pack_periode_rate100_paket_pratical[$id_student_nadia_paket_pratical_temp2[$i][6]] * $id_student_nadia_paket_pratical_temp2[$i][3] * 100 / 100;
            }
            for ($i = 0; $i < count($id_student_nadia_paket_teory_temp); $i++) {
                $id_student_nadia_paket_teory_temp2[$i] = explode("&", $id_student_nadia_paket_teory_temp[$i]);
                $temp_before_rate100_paket_teory = $this->M_Admin->getData_sirkulasi_lesson_detail_before_periode(null, null, null, $id_student_nadia_paket_teory_temp2[$i][0], $id_student_nadia_paket_teory_temp2[$i][4], $periode, null, $id_student_nadia_paket_teory_temp2[$i][5]);
                $tipe_rate100_paket_teory_before[$id_student_nadia_paket_teory_temp2[$i][6]] = count($temp_before_rate100_paket_teory);

                $temp_rate100_paket_teory = $this->M_Admin->getData_sirkulasi_lesson_detail(null, null, null, $id_student_nadia_paket_teory_temp2[$i][0], $id_student_nadia_paket_teory_temp2[$i][4], $periode, null, $id_student_nadia_paket_teory_temp2[$i][5]);
                $tipe_rate100_paket_teory[$id_student_nadia_paket_teory_temp2[$i][6]] = count($temp_rate100_paket_teory);

                $date_rate100_paket_teory[$id_student_nadia_paket_teory_temp2[$i][6]] = [];
                $total_pack_periode_rate100_paket_teory[$id_student_nadia_paket_teory_temp2[$i][6]] = $tipe_rate100_paket_teory[$id_student_nadia_paket_teory_temp2[$i][6]];

                foreach ($temp_rate100_paket_teory as $n) {
                    array_push($date_rate100_paket_teory[$id_student_nadia_paket_teory_temp2[$i][6]], date_format(date_create(substr($n['lesson_date'], 0, 10)), "d"));
                }

                $date_rate100_paket_teory[$id_student_nadia_paket_teory_temp2[$i][6]] = implode(", ", $date_rate100_paket_teory[$id_student_nadia_paket_teory_temp2[$i][6]]);
                $total_fee_periode_rate100_paket_teory[$id_student_nadia_paket_teory_temp2[$i][6]] = $total_pack_periode_rate100_paket_teory[$id_student_nadia_paket_teory_temp2[$i][6]] * $id_student_nadia_paket_teory_temp2[$i][3] * 100 / 100;
            }
            for ($i = 0; $i < count($id_student_nadia_offline_lesson_temp); $i++) {
                $id_student_nadia_offline_lesson_temp2[$i] = explode("&", $id_student_nadia_offline_lesson_temp[$i]);

                $temp_before_rate100_offline_lesson = $this->M_Admin->getData_sirkulasi_lesson_detail_before_periode(null, null, null, $id_student_nadia_offline_lesson_temp2[$i][0], $id_student_nadia_offline_lesson_temp2[$i][4], $periode, null, null, $id_student_nadia_offline_lesson_temp2[$i][5]);

                $tipe_rate100_offline_lesson_before[$id_student_nadia_offline_lesson_temp2[$i][6]] = count($temp_before_rate100_offline_lesson);

                $temp_rate100_offline_lesson = $this->M_Admin->getData_sirkulasi_lesson_detail(null, null, null, $id_student_nadia_offline_lesson_temp2[$i][0], $id_student_nadia_offline_lesson_temp2[$i][4], $periode, null, null, $id_student_nadia_offline_lesson_temp2[$i][5]);
                $tipe_rate100_offline_lesson[$id_student_nadia_offline_lesson_temp2[$i][6]] = count($temp_rate100_offline_lesson);

                $date_rate100_offline_lesson[$id_student_nadia_offline_lesson_temp2[$i][6]] = [];
                $total_pack_periode_rate100_offline_lesson[$id_student_nadia_offline_lesson_temp2[$i][6]] = $tipe_rate100_offline_lesson[$id_student_nadia_offline_lesson_temp2[$i][6]];

                foreach ($temp_rate100_offline_lesson as $n) {
                    array_push($date_rate100_offline_lesson[$id_student_nadia_offline_lesson_temp2[$i][6]], date_format(date_create(substr($n['lesson_date'], 0, 10)), "d"));
                }

                $date_rate100_offline_lesson[$id_student_nadia_offline_lesson_temp2[$i][6]] = implode(", ", $date_rate100_offline_lesson[$id_student_nadia_offline_lesson_temp2[$i][6]]);
                $total_fee_periode_rate100_offline_lesson[$id_student_nadia_offline_lesson_temp2[$i][6]] = $total_pack_periode_rate100_offline_lesson[$id_student_nadia_offline_lesson_temp2[$i][6]] * $id_student_nadia_offline_lesson_temp2[$i][3] * 100 / 100;
            }
        }else{
            for ($i = 0; $i < count($id_student_paket_pratical_temp); $i++) {
                $id_student_paket_pratical_temp2[$i] = explode("&", $id_student_paket_pratical_temp[$i]);
                $temp_temp[$id_student_paket_pratical_temp2[$i][7]] = null;
                if ($id_student_paket_pratical_temp2[$i][4] == 50) {
                    $temp_before_rate50_paket_pratical = $this->M_Admin->getData_sirkulasi_lesson_detail_before_periode(null, null, null, $id_student_paket_pratical_temp2[$i][0], $id_student_paket_pratical_temp2[$i][5], $periode, $id_student_paket_pratical_temp2[$i][4], $id_student_paket_pratical_temp2[$i][6]);
                    $tipe_rate50_paket_pratical_before[$id_student_paket_pratical_temp2[$i][7]] = count($temp_before_rate50_paket_pratical);
                    $temp_rate50_paket_pratical = $this->M_Admin->getData_sirkulasi_lesson_detail(null, null, null, $id_student_paket_pratical_temp2[$i][0], $id_student_paket_pratical_temp2[$i][5], $periode, $id_student_paket_pratical_temp2[$i][4], $id_student_paket_pratical_temp2[$i][6]);
                    $tipe_rate50_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] = count($temp_rate50_paket_pratical);
    
                    if ($tipe_rate50_paket_pratical_before[$id_student_paket_pratical_temp2[$i][7]] == 7) {
                        $temp_temp[$id_student_paket_pratical_temp2[$i][7]] = $id_student_paket_pratical_temp[$i];
                        $date_temp_for_teory[$id_student_paket_pratical_temp2[$i][7]] = [];
                        $a = 1;
                        $date_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] = [];
                        foreach ($temp_rate50_paket_pratical as $n) {
                            if ($a == 1) {
                                $date_temp_for_teory[$id_student_paket_pratical_temp2[$i][7]] = date_format(date_create(substr($n['lesson_date'], 0, 10)), "(d)");
                            }
                            $a += 1;
                        }
                        $index_teory[] = $id_student_paket_pratical_temp[$i];
                    } else {
                        $date_rate50_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] = [];
                        if (($tipe_rate50_paket_pratical_before[$id_student_paket_pratical_temp2[$i][7]] % 2) == 0) {
                            $total_pack_periode_rate50_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] = round($tipe_rate50_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] / 2);
                            foreach ($temp_rate50_paket_pratical as $n) {
                                array_push($date_rate50_paket_pratical[$id_student_paket_pratical_temp2[$i][7]], date_format(date_create(substr($n['lesson_date'], 0, 10)), "d"));
                            }
                        } else {
                            $a = 1;
                            foreach ($temp_rate50_paket_pratical as $n) {
                                if ($a == 1) {
                                    array_push($date_rate50_paket_pratical[$id_student_paket_pratical_temp2[$i][7]], date_format(date_create(substr($n['lesson_date'], 0, 10)), "(d)"));
                                } else {
                                    array_push($date_rate50_paket_pratical[$id_student_paket_pratical_temp2[$i][7]], date_format(date_create(substr($n['lesson_date'], 0, 10)), "d"));
                                }
                                $a += 1;
                            }
                            $total_pack_periode_rate50_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] = round(($tipe_rate50_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] - 1) / 2);
                        }
                        $date_rate50_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] = implode(", ", $date_rate50_paket_pratical[$id_student_paket_pratical_temp2[$i][7]]);
                        $total_fee_periode_rate50_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] = $total_pack_periode_rate50_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] * $id_student_paket_pratical_temp2[$i][3] * 50 / 100;
    
                        $temp = round(($tipe_rate50_paket_pratical_before[$id_student_paket_pratical_temp2[$i][7]] / 2) + ($tipe_rate50_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] / 2));
                        $notes_rate50_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] = "50%(" . $temp . "/4)";
                    }
                }
                if ($id_student_paket_pratical_temp2[$i][4] == 70) {
                    $temp_before_rate_paket_pratical = $this->M_Admin->getData_sirkulasi_lesson_detail_before_periode(null, null, null, $id_student_paket_pratical_temp2[$i][0], $id_student_paket_pratical_temp2[$i][5], $periode, $id_student_paket_pratical_temp2[$i][4], $id_student_paket_pratical_temp2[$i][6]);
                    $tipe_rate_paket_pratical_before[$id_student_paket_pratical_temp2[$i][7]] = count($temp_before_rate_paket_pratical);
    
                    $temp_rate_paket_pratical = $this->M_Admin->getData_sirkulasi_lesson_detail(null, null, null, $id_student_paket_pratical_temp2[$i][0], $id_student_paket_pratical_temp2[$i][5], $periode, $id_student_paket_pratical_temp2[$i][4], $id_student_paket_pratical_temp2[$i][6]);
                    $tipe_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] = count($temp_rate_paket_pratical);
                    $date_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] = [];
    
                    if (($tipe_rate_paket_pratical_before[$id_student_paket_pratical_temp2[$i][7]] % 2) == 0) {
                        $total_pack_periode_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] = round($tipe_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] / 2);
                        foreach ($temp_rate_paket_pratical as $n) {
                            array_push($date_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]], date_format(date_create(substr($n['lesson_date'], 0, 10)), "d"));
                        }
                    } else {
                        $a = 1;
                        foreach ($temp_rate_paket_pratical as $n) {
                            if ($a == 1) {
                                array_push($date_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]], date_format(date_create(substr($n['lesson_date'], 0, 10)), "(d)"));
                            } else {
                                array_push($date_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]], date_format(date_create(substr($n['lesson_date'], 0, 10)), "d"));
                            }
                            $a += 1;
                        }
                        $total_pack_periode_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] = round(($tipe_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] - 1) / 2);
                    }
                    $date_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] = implode(", ", $date_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]]);
                    $total_fee_periode_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] = $total_pack_periode_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] * $id_student_paket_pratical_temp2[$i][3] * 70 / 100;
                }
                if ($id_student_paket_pratical_temp2[$i][4] == 80) {
                    $temp_before_rate_paket_pratical = $this->M_Admin->getData_sirkulasi_lesson_detail_before_periode(null, null, null, $id_student_paket_pratical_temp2[$i][0], $id_student_paket_pratical_temp2[$i][5], $periode, $id_student_paket_pratical_temp2[$i][4], $id_student_paket_pratical_temp2[$i][6]);
                    $tipe_rate_paket_pratical_before[$id_student_paket_pratical_temp2[$i][7]] = count($temp_before_rate_paket_pratical);
    
                    $temp_rate_paket_pratical = $this->M_Admin->getData_sirkulasi_lesson_detail(null, null, null, $id_student_paket_pratical_temp2[$i][0], $id_student_paket_pratical_temp2[$i][5], $periode, $id_student_paket_pratical_temp2[$i][4], $id_student_paket_pratical_temp2[$i][6]);
                    $tipe_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] = count($temp_rate_paket_pratical);
                    $date_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] = [];
    
                    if (($tipe_rate_paket_pratical_before[$id_student_paket_pratical_temp2[$i][7]] % 2) == 0) {
                        $total_pack_periode_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] = round($tipe_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] / 2);
                        foreach ($temp_rate_paket_pratical as $n) {
                            array_push($date_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]], date_format(date_create(substr($n['lesson_date'], 0, 10)), "d"));
                        }
                    } else {
                        $a = 1;
                        foreach ($temp_rate_paket_pratical as $n) {
                            if ($a == 1) {
                                array_push($date_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]], date_format(date_create(substr($n['lesson_date'], 0, 10)), "(d)"));
                            } else {
                                array_push($date_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]], date_format(date_create(substr($n['lesson_date'], 0, 10)), "d"));
                            }
                            $a += 1;
                        }
                        $total_pack_periode_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] = round(($tipe_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] - 1) / 2);
                    }
                    $date_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] = implode(", ", $date_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]]);
                    $total_fee_periode_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] = $total_pack_periode_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] * $id_student_paket_pratical_temp2[$i][3] * 80 / 100;
                }
            }
            for ($i = 0; $i < count($id_student_paket_teory_temp); $i++) {
                $id_student_paket_teory_temp2[$i] = explode("&", $id_student_paket_teory_temp[$i]);
                if ($id_student_paket_teory_temp2[$i][4] == 50) {
                    $temp_before_rate50_paket_teory = $this->M_Admin->getData_sirkulasi_lesson_detail_before_periode(null, null, null, $id_student_paket_teory_temp2[$i][0], $id_student_paket_teory_temp2[$i][5], $periode, $id_student_paket_teory_temp2[$i][4], $id_student_paket_teory_temp2[$i][6]);
                    $tipe_rate50_paket_teory_before[$id_student_paket_teory_temp2[$i][7]] = count($temp_before_rate50_paket_teory);
    
                    $temp_rate50_paket_teory = $this->M_Admin->getData_sirkulasi_lesson_detail(null, null, null, $id_student_paket_teory_temp2[$i][0], $id_student_paket_teory_temp2[$i][5], $periode, $id_student_paket_teory_temp2[$i][4], $id_student_paket_teory_temp2[$i][6]);
                    $tipe_rate50_paket_teory[$id_student_paket_teory_temp2[$i][7]] = count($temp_rate50_paket_teory);
    
                    $date_rate50_paket_teory[$id_student_paket_teory_temp2[$i][7]] = [];
                    $total_pack_periode_rate50_paket_teory[$id_student_paket_teory_temp2[$i][7]] = $tipe_rate50_paket_teory[$id_student_paket_teory_temp2[$i][7]];
    
                    foreach ($temp_rate50_paket_teory as $n) {
                        array_push($date_rate50_paket_teory[$id_student_paket_teory_temp2[$i][7]], date_format(date_create(substr($n['lesson_date'], 0, 10)), "d"));
                    }
    
                    $date_rate50_paket_teory[$id_student_paket_teory_temp2[$i][7]] = implode(", ", $date_rate50_paket_teory[$id_student_paket_teory_temp2[$i][7]]);
                    $total_fee_periode_rate50_paket_teory[$id_student_paket_teory_temp2[$i][7]] = $total_pack_periode_rate50_paket_teory[$id_student_paket_teory_temp2[$i][7]] * $id_student_paket_teory_temp2[$i][3] * 50 / 100;
    
                    $temp = round(($tipe_rate50_paket_teory_before[$id_student_paket_teory_temp2[$i][7]]) + ($tipe_rate50_paket_teory[$id_student_paket_teory_temp2[$i][7]]));
                    $notes_rate50_paket_teory[$id_student_paket_teory_temp2[$i][7]] = "50%(" . $temp . "/4)";
                }
                if ($id_student_paket_teory_temp2[$i][4] == 70) {
                    $temp_before_rate_paket_teory = $this->M_Admin->getData_sirkulasi_lesson_detail_before_periode(null, null, null, $id_student_paket_teory_temp2[$i][0], $id_student_paket_teory_temp2[$i][5], $periode, $id_student_paket_teory_temp2[$i][4], $id_student_paket_teory_temp2[$i][6]);
                    $tipe_rate_paket_teory_before[$id_student_paket_teory_temp2[$i][7]] = count($temp_before_rate_paket_teory);
    
                    $temp_rate_paket_teory = $this->M_Admin->getData_sirkulasi_lesson_detail(null, null, null, $id_student_paket_teory_temp2[$i][0], $id_student_paket_teory_temp2[$i][5], $periode, $id_student_paket_teory_temp2[$i][4], $id_student_paket_teory_temp2[$i][6]);
                    $tipe_rate_paket_teory[$id_student_paket_teory_temp2[$i][7]] = count($temp_rate_paket_teory);
    
                    $date_rate_paket_teory[$id_student_paket_teory_temp2[$i][7]] = [];
                    $total_pack_periode_rate_paket_teory[$id_student_paket_teory_temp2[$i][7]] = $tipe_rate_paket_teory[$id_student_paket_teory_temp2[$i][7]];
    
                    foreach ($temp_rate_paket_teory as $n) {
                        array_push($date_rate_paket_teory[$id_student_paket_teory_temp2[$i][7]], date_format(date_create(substr($n['lesson_date'], 0, 10)), "d"));
                    }
    
                    $date_rate_paket_teory[$id_student_paket_teory_temp2[$i][7]] = implode(", ", $date_rate_paket_teory[$id_student_paket_teory_temp2[$i][7]]);
                    $total_fee_periode_rate_paket_teory[$id_student_paket_teory_temp2[$i][7]] = $total_pack_periode_rate_paket_teory[$id_student_paket_teory_temp2[$i][7]] * $id_student_paket_teory_temp2[$i][3] * 70 / 100;
                }
                if ($id_student_paket_teory_temp2[$i][4] == 80) {
                    $temp_before_rate_paket_teory = $this->M_Admin->getData_sirkulasi_lesson_detail_before_periode(null, null, null, $id_student_paket_teory_temp2[$i][0], $id_student_paket_teory_temp2[$i][5], $periode, $id_student_paket_teory_temp2[$i][4], $id_student_paket_teory_temp2[$i][6]);
                    $tipe_rate_paket_teory_before[$id_student_paket_teory_temp2[$i][7]] = count($temp_before_rate_paket_teory);
    
                    $temp_rate_paket_teory = $this->M_Admin->getData_sirkulasi_lesson_detail(null, null, null, $id_student_paket_teory_temp2[$i][0], $id_student_paket_teory_temp2[$i][5], $periode, $id_student_paket_teory_temp2[$i][4], $id_student_paket_teory_temp2[$i][6]);
                    $tipe_rate_paket_teory[$id_student_paket_teory_temp2[$i][7]] = count($temp_rate_paket_teory);
    
                    $date_rate_paket_teory[$id_student_paket_teory_temp2[$i][7]] = [];
                    $total_pack_periode_rate_paket_teory[$id_student_paket_teory_temp2[$i][7]] = $tipe_rate_paket_teory[$id_student_paket_teory_temp2[$i][7]];
    
                    foreach ($temp_rate_paket_teory as $n) {
                        array_push($date_rate_paket_teory[$id_student_paket_teory_temp2[$i][7]], date_format(date_create(substr($n['lesson_date'], 0, 10)), "d"));
                    }
    
                    $date_rate_paket_teory[$id_student_paket_teory_temp2[$i][7]] = implode(", ", $date_rate_paket_teory[$id_student_paket_teory_temp2[$i][7]]);
                    $total_fee_periode_rate_paket_teory[$id_student_paket_teory_temp2[$i][7]] = $total_pack_periode_rate_paket_teory[$id_student_paket_teory_temp2[$i][7]] * $id_student_paket_teory_temp2[$i][3] * 80 / 100;
                }
            }
            for ($i = 0; $i < count($id_student_offline_lesson_temp); $i++) {
                $id_student_offline_lesson_temp2[$i] = explode("&", $id_student_offline_lesson_temp[$i]);
                
                if ($id_student_offline_lesson_temp2[$i][4] == 50) {
                    $temp_before_rate50_offline_lesson = $this->M_Admin->getData_sirkulasi_lesson_detail_before_periode(null, null, null, $id_student_offline_lesson_temp2[$i][0], $id_student_offline_lesson_temp2[$i][5], $periode, $id_student_offline_lesson_temp2[$i][4], null, $id_student_offline_lesson_temp2[$i][6]);
                    $tipe_rate50_offline_lesson_before[$id_student_offline_lesson_temp2[$i][7]] = count($temp_before_rate50_offline_lesson);
    
                    $temp_rate50_offline_lesson = $this->M_Admin->getData_sirkulasi_lesson_detail(null, null, null, $id_student_offline_lesson_temp2[$i][0], $id_student_offline_lesson_temp2[$i][5], $periode, $id_student_offline_lesson_temp2[$i][4], null, $id_student_offline_lesson_temp2[$i][6]);
                    $tipe_rate50_offline_lesson[$id_student_offline_lesson_temp2[$i][7]] = count($temp_rate50_offline_lesson);
    
                    $date_rate50_offline_lesson[$id_student_offline_lesson_temp2[$i][7]] = [];
                    $total_pack_periode_rate50_offline_lesson[$id_student_offline_lesson_temp2[$i][7]] = $tipe_rate50_offline_lesson[$id_student_offline_lesson_temp2[$i][7]];
    
                    foreach ($temp_rate50_offline_lesson as $n) {
                        array_push($date_rate50_offline_lesson[$id_student_offline_lesson_temp2[$i][7]], date_format(date_create(substr($n['lesson_date'], 0, 10)), "d"));
                    }
    
                    $date_rate50_offline_lesson[$id_student_offline_lesson_temp2[$i][7]] = implode(", ", $date_rate50_offline_lesson[$id_student_offline_lesson_temp2[$i][7]]);
                    $total_fee_periode_rate50_offline_lesson[$id_student_offline_lesson_temp2[$i][7]] = $total_pack_periode_rate50_offline_lesson[$id_student_offline_lesson_temp2[$i][7]] * $id_student_offline_lesson_temp2[$i][3] * 50 / 100;
    
                    $temp = round(($tipe_rate50_offline_lesson_before[$id_student_offline_lesson_temp2[$i][7]]) + ($tipe_rate50_offline_lesson[$id_student_offline_lesson_temp2[$i][7]]));
                    $notes_rate50_offline_lesson[$id_student_offline_lesson_temp2[$i][7]] = "50%(" . $temp . "/4)";
                }
                if ($id_student_offline_lesson_temp2[$i][4] == 80) {
                    $temp_before_rate_offline_lesson = $this->M_Admin->getData_sirkulasi_lesson_detail_before_periode(null, null, null, $id_student_offline_lesson_temp2[$i][0], $id_student_offline_lesson_temp2[$i][5], $periode, $id_student_offline_lesson_temp2[$i][4], null, $id_student_offline_lesson_temp2[$i][6]);
                    $tipe_rate_offline_lesson_before[$id_student_offline_lesson_temp2[$i][7]] = count($temp_before_rate_offline_lesson);
    
                    $temp_rate_offline_lesson = $this->M_Admin->getData_sirkulasi_lesson_detail(null, null, null, $id_student_offline_lesson_temp2[$i][0], $id_student_offline_lesson_temp2[$i][5], $periode, $id_student_offline_lesson_temp2[$i][4], null, $id_student_offline_lesson_temp2[$i][6]);
                    $tipe_rate_offline_lesson[$id_student_offline_lesson_temp2[$i][7]] = count($temp_rate_offline_lesson);
    
                    $date_rate_offline_lesson[$id_student_offline_lesson_temp2[$i][7]] = [];
                    $total_pack_periode_rate_offline_lesson[$id_student_offline_lesson_temp2[$i][7]] = $tipe_rate_offline_lesson[$id_student_offline_lesson_temp2[$i][7]];
    
                    foreach ($temp_rate_offline_lesson as $n) {
                        array_push($date_rate_offline_lesson[$id_student_offline_lesson_temp2[$i][7]], date_format(date_create(substr($n['lesson_date'], 0, 10)), "d"));
                    }
    
                    $date_rate_offline_lesson[$id_student_offline_lesson_temp2[$i][7]] = implode(", ", $date_rate_offline_lesson[$id_student_offline_lesson_temp2[$i][7]]);
                    $total_fee_periode_rate_offline_lesson[$id_student_offline_lesson_temp2[$i][7]] = $total_pack_periode_rate_offline_lesson[$id_student_offline_lesson_temp2[$i][7]] * $id_student_offline_lesson_temp2[$i][3] * 80 / 100;
                }
            }
        }

        for ($i = 0; $i < count($index_teory); $i++) {
            $index_teory_temp2[$i] = explode("&", $index_teory[$i]);
            // echo "<br>";
            // echo var_dump($date_rate_paket_pratical[$index_teory_temp2[$i][7]]);
            // echo "<br>";
            $date_rate_paket_pratical[$index_teory_temp2[$i][7]] = $date_temp_for_teory[$index_teory_temp2[$i][7]] . ", " . $date_rate_paket_pratical[$index_teory_temp2[$i][7]];
            $tipe_rate_paket_pratical_before[$index_teory_temp2[$i][7]] += 1;
            $value = array($index_teory[$i]);
            $id_student_paket_pratical_temp = array_diff($id_student_paket_pratical_temp, $value);
        }

        // echo "BEFORE 50 (tgl)";
        // echo "<br>";
        // echo var_dump($date_temp_for_teory);
        // echo "<br>";
        // echo var_dump($index_teory);
        // echo "<br>";

        // echo "BEFORE";
        // echo "<br>";
        // echo var_dump($tipe_rate100_paket_pratical_before);
        // echo "<br>";
        // echo var_dump($tipe_rate100_paket_teory_before);
        // echo "<br>";
        // echo var_dump($tipe_rate100_offline_lesson_before);
        // echo "<br>";

        // echo "<br>";
        // echo var_dump($tipe_rate_paket_pratical_before);
        // echo "<br>";
        // echo var_dump($tipe_rate50_paket_pratical_before);
        // echo "<br>";

        // echo var_dump($tipe_rate_paket_teory_before);
        // echo "<br>";
        // echo var_dump($tipe_rate50_paket_teory_before);
        // echo "<br>";

        // echo var_dump($tipe_rate_offline_lesson_before);
        // echo "<br>";
        // echo var_dump($tipe_rate50_offline_lesson_before);
        // echo "<br>";

        // echo "<br>";
        // echo "AFTER";
        // echo "<br>";
        // echo var_dump($tipe_rate100_paket_pratical);
        // echo "<br>";
        // echo var_dump($tipe_rate100_paket_teory);
        // echo "<br>";
        // echo var_dump($tipe_rate100_offline_lesson);
        // echo "<br>";
        // echo "<br>";

        // echo var_dump($tipe_rate_paket_pratical);
        // echo "<br>";
        // echo var_dump($tipe_rate50_paket_pratical);
        // echo "<br>";
        // echo var_dump($tipe_rate_paket_teory);
        // echo "<br>";
        // echo var_dump($tipe_rate50_paket_teory);
        // echo "<br>";
        // echo var_dump($tipe_rate_offline_lesson);
        // echo "<br>";
        // echo var_dump($tipe_rate50_offline_lesson);
        // echo "<br>";
        // echo "<br>";

        // echo "<br>";
        // echo "DATE";
        // echo "<br>";
        // echo var_dump($date_rate100_paket_pratical);
        // echo "<br>";
        // echo var_dump($date_rate100_paket_teory);
        // echo "<br>";
        // echo var_dump($date_rate100_offline_lesson);
        // echo "<br>";
        // echo "<br>";

        // echo var_dump($date_rate_paket_pratical);
        // echo "<br>";
        // echo var_dump($date_rate50_paket_pratical);
        // echo "<br>";
        // echo var_dump($date_rate_paket_teory);
        // echo "<br>";
        // echo var_dump($date_rate50_paket_teory);
        // echo "<br>";
        // echo var_dump($date_rate_offline_lesson);
        // echo "<br>";
        // echo var_dump($date_rate50_offline_lesson);
        // echo "<br>";
        // echo "<br>";

//         echo "FEE";
//         echo "<br>";
//         echo var_dump($total_pack_periode_rate100_paket_pratical);
//         echo "<br>";
//         echo var_dump($total_fee_periode_rate100_paket_pratical);
//         echo "<br>";
//         echo "<br>";
//          echo var_dump($total_pack_periode_rate100_paket_teory);
//         echo "<br>";
//         echo var_dump($total_fee_periode_rate100_paket_teory);
//         echo "<br>";
//         echo "<br>";
// echo var_dump($total_pack_periode_rate100_offline_lesson);
//         echo "<br>";
//         echo var_dump($total_fee_periode_rate100_offline_lesson);
//         echo "<br>";
//         echo "<br>";


        // echo var_dump($total_pack_periode_rate_paket_pratical);
        // echo "<br>";
        // echo var_dump($total_fee_periode_rate_paket_pratical);
        // echo "<br>";
        // echo "<br>";
        // echo var_dump($total_pack_periode_rate50_paket_pratical);
        // echo "<br>";
        // echo var_dump($total_fee_periode_rate50_paket_pratical);
        // echo "<br>";
        // echo "<br>";
        // echo var_dump($total_pack_periode_rate_paket_teory);
        // echo "<br>";
        // echo var_dump($total_fee_periode_rate_paket_teory);
        // echo "<br>";
        // echo "<br>";
        // echo var_dump($total_pack_periode_rate50_paket_teory);
        // echo "<br>";
        // echo var_dump($total_fee_periode_rate50_paket_teory);
        // echo "<br>";
        // echo "<br>";
        // echo var_dump($total_pack_periode_rate_offline_lesson);
        // echo "<br>";
        // echo var_dump($total_fee_periode_rate_offline_lesson);
        // echo "<br>";
        // echo "<br>";
        // echo var_dump($total_pack_periode_rate50_offline_lesson);
        // echo "<br>";
        // echo var_dump($total_fee_periode_rate50_offline_lesson);
        // echo "<br>";
        // echo "<br>";

        // echo "<br>";
        // echo "NOTES";
        // echo "<br>";
        // echo var_dump($notes_rate50_paket_pratical);
        // echo "<br>";
        // echo var_dump($notes_rate50_offline_lesson);
        // echo "<br>";




        $id_student_online_temp = array_merge($id_student_paket_pratical_temp, $id_student_paket_teory_temp);
        $total_pack_online_temp = array_merge($total_pack_periode_rate_paket_pratical, $total_pack_periode_rate50_paket_pratical, $total_pack_periode_rate_paket_teory, $total_pack_periode_rate50_paket_teory);
        
        $id_student_nadia_online_temp = array_merge($id_student_nadia_paket_pratical_temp, $id_student_nadia_paket_teory_temp);
        $total_pack_nadia_online_temp = array_merge($total_pack_periode_rate100_paket_pratical, $total_pack_periode_rate100_paket_teory);

        sort($id_student_online_temp);
        sort($id_student_nadia_online_temp);
        // echo "<br>";
        // echo "<br>";
        // echo var_dump($id_student_online_temp);

        $event = [];
        $event_detail = [];

        $other_discount_event = [];

        

        //no_fereport
        //FER/202109/002/001
        $data_fee_tipe = [];
        $temp_id_teacher = substr($id_teacher, 3);
        $no_sirkulasi_feereport = "FER/" . str_replace('-', '', $periode) . "/" . $temp_id_teacher;
        $data_sirkulasi_feereport = $this->M_Teacher->getData_sirkulasi_feereport(null, $no_sirkulasi_feereport);
        $data_sirkulasi_feereport_detail = $this->M_Teacher->getData_sirkulasi_feereport_detail(null, $no_sirkulasi_feereport);
        foreach ($data_sirkulasi_feereport_detail as $n) {
            if ($n['tipe'] == 1) {
                $data_fee_tipe[1] = $n['price'];
            }
            if ($n['tipe'] == 2) {
                $data_fee_tipe[2] = $n['price'];
            }
            if ($n['tipe'] == 3) {
                $data_fee_tipe[3] = $n['price'];
            }
            if (substr($n['id_barang'], 0, 3) == "EVN") {
                $temp_event = $this->M_Teacher->getData_transaksi_event($n['id_barang']);
                $event[] = $temp_event[0];
                if ($temp_event[0]['discount'] > 0) {
                    $temp_event_name = $this->M_Teacher->getData_event(null,null,null, $temp_event[0]['parent_event']);
                    $other_discount_event[] = $temp_event[0]['no_transaksi_event'] . "&Event&" . $temp_event[0]['discount'] . "&" . $temp_event[0]['name_teacher'] . "&" . $temp_event_name[0]['event_name'];
                }
            }
        }

        for ($i = 0; $i < count($event); $i++) {
            $temp_event_detail = $this->M_Teacher->getData_transaksi_event_detail($event[$i]['no_transaksi_event']);
            $event_detail[$event[$i]['no_transaksi_event']][] = $temp_event_detail;
        }

        $data_other_category = [];

        $other_feereport = $this->M_Admin->getData_other_feereport($id_teacher, $periode);
        $event_teacher = $this->M_Admin->getData_event_teacher(null, $id_teacher, $periode);
        $offline_trial = $this->M_Admin->getData_offline_trial(null, $periode, $id_teacher);

        $data_other_category['event'] = [];
        $data_other_category['trial'] = [];
        foreach ($event_teacher as $e) {
            $data_other_category['event'][] = $e['event_name'] . "&" . $e['total_rate'];
        }
        foreach ($offline_trial as $e) {
            $data_other_category['trial'][] = $e['name_student'] . "&" . $e['date'] . "&100000";
        }

        // $dollar = $this->M_Admin->getData_ConvertDollar(null, $periode);
        // $euro = $this->M_Admin->getData_ConvertEuro(null, $periode);
        // echo var_dump($id_student_online_temp);

        $title = "Feereport | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/admin/feereport/detail', array(
            'teacher' => $teacher, 'title' => $title, 'description' => $description, 'id_student_online_temp' => $id_student_online_temp, 'id_student_nadia_online_temp' => $id_student_nadia_online_temp, 'id_student_nadia_offline_lesson_temp' => $id_student_nadia_offline_lesson_temp, 'total_pack_online_temp' => $total_pack_online_temp, 'total_pack_nadia_online_temp' => $total_pack_nadia_online_temp, 'id_student_paket_pratical_temp' => $id_student_paket_pratical_temp, 'id_student_paket_teory_temp' => $id_student_paket_teory_temp, 'id_student_offline_lesson_temp' => $id_student_offline_lesson_temp, 'total_pack_periode_rate_paket_pratical' => $total_pack_periode_rate_paket_pratical, 'total_fee_periode_rate_paket_pratical' => $total_fee_periode_rate_paket_pratical, 'total_pack_periode_rate100_paket_pratical' => $total_pack_periode_rate100_paket_pratical, 'total_fee_periode_rate100_paket_pratical' => $total_fee_periode_rate100_paket_pratical, 'total_pack_periode_rate50_paket_pratical' => $total_pack_periode_rate50_paket_pratical, 'total_fee_periode_rate50_paket_pratical' => $total_fee_periode_rate50_paket_pratical, 'total_pack_periode_rate_paket_teory' => $total_pack_periode_rate_paket_teory, 'total_fee_periode_rate_paket_teory' => $total_fee_periode_rate_paket_teory, 'total_pack_periode_rate100_paket_teory' => $total_pack_periode_rate100_paket_teory, 'total_fee_periode_rate100_paket_teory' => $total_fee_periode_rate100_paket_teory, 'total_pack_periode_rate50_paket_teory' => $total_pack_periode_rate50_paket_teory, 'total_fee_periode_rate50_paket_teory' => $total_fee_periode_rate50_paket_teory, 'total_pack_periode_rate_offline_lesson' => $total_pack_periode_rate_offline_lesson, 'total_fee_periode_rate_offline_lesson' => $total_fee_periode_rate_offline_lesson, 'total_pack_periode_rate100_offline_lesson' => $total_pack_periode_rate100_offline_lesson, 'total_fee_periode_rate100_offline_lesson' => $total_fee_periode_rate100_offline_lesson,  'total_pack_periode_rate50_offline_lesson' => $total_pack_periode_rate50_offline_lesson, 'total_fee_periode_rate50_offline_lesson' => $total_fee_periode_rate50_offline_lesson, 'tipe_rate100_paket_pratical_before' => $tipe_rate100_paket_pratical_before, 'tipe_rate50_paket_pratical_before' => $tipe_rate50_paket_pratical_before,  'tipe_rate100_paket_teory_before' => $tipe_rate100_paket_teory_before, 'tipe_rate50_paket_teory_before' => $tipe_rate50_paket_teory_before, 'tipe_rate100_offline_lesson_before' => $tipe_rate100_offline_lesson_before, 'tipe_rate50_offline_lesson_before' => $tipe_rate50_offline_lesson_before,
            'date_rate100_paket_pratical' => $date_rate100_paket_pratical,
            'date_rate50_paket_pratical' => $date_rate50_paket_pratical,
            'date_rate_paket_pratical' => $date_rate_paket_pratical,
            'date_rate100_paket_teory' => $date_rate100_paket_teory,
            'date_rate50_paket_teory' => $date_rate50_paket_teory,
            'date_rate_paket_teory' => $date_rate_paket_teory,
            'date_rate100_offline_lesson' => $date_rate100_offline_lesson,
            'date_rate50_offline_lesson' => $date_rate50_offline_lesson,
            'date_rate_offline_lesson' => $date_rate_offline_lesson,
            'notes_rate50_paket_pratical' => $notes_rate50_paket_pratical,
            'notes_rate50_paket_teory' => $notes_rate50_paket_teory,
            'notes_rate50_offline_lesson' => $notes_rate50_offline_lesson,
            'data_sirkulasi_feereport' => $data_sirkulasi_feereport,
            'data_fee_tipe' => $data_fee_tipe,
            'tipe_rate100_paket_pratical' => $tipe_rate100_paket_pratical,
            'tipe_rate50_paket_pratical' => $tipe_rate50_paket_pratical,
            'tipe_rate_paket_pratical' => $tipe_rate_paket_pratical,
            'tipe_rate_paket_pratical_before' => $tipe_rate_paket_pratical_before,
            'data_other_category' => $data_other_category,
            'other_feereport' => $other_feereport,
            'event' => $event,
            'event_detail' => $event_detail,
            'other_discount_event' => $other_discount_event,
        ));
    }

    public function add_other_feereport($id_teacher, $periode)
    {
        $data =  [
            'id_teacher' => $id_teacher,
            'periode' => $periode,
            'other_category' => '',
            'other_note' => '',
            'other_price' => '0',
        ];
        $this->db->insert('other_feereport', $data);
        redirect('portal/feereport/view/' . $periode . '/' . $id_teacher);
    }
    public function updated_approved()
    {
        $today = date("Y-m-d");
        $data =  [
            'status_approved' => $this->input->post('status_approved'),
            'date_approved' => $today
        ];
        $this->db->update('sirkulasi_feereport', $data, ['id_sirkulasi_feereport' => $this->input->post('id_sirkulasi_feereport')]);
        return true;
    }

    public function detail_invoice_periode_transaksi($periode, $id_parent)
    {
        $this->cekLogin();

        $ortu = $this->M_Admin->getData_student(null, $id_parent);
        $other_invoice = $this->M_Admin->getData_other_invoice($id_parent, $periode);
        $data_offline = $this->M_Admin->getData_summary_invoice($id_parent, $periode);

        $id_student_offline_lesson = [];
        $date_schedule_offline_lesson = [];
        $total_pack_offline_lesson = [];

        foreach ($data_offline as $n) {
            $id_student_offline_lesson[] = $n['id_teacher'] . "&" . $n['id_student'] . "&" . $n['name_student']  . "&" . $n['name_paket'] . "&" . $n['rate'] . "&" . $n['id_course'];
        }

        $id_student_offline_lesson_temp = array_unique($id_student_offline_lesson);
        sort($id_student_offline_lesson_temp);

        for ($i = 0; $i < count($id_student_offline_lesson_temp); $i++) {
            $id_student_offline_lesson_temp2[$i] = explode("&", $id_student_offline_lesson_temp[$i]);

            $temp_date = $this->M_Admin->getData_schedule(null, $periode, null, $id_student_offline_lesson_temp2[$i][5]);
            $total_pack_offline_lesson[$id_student_offline_lesson_temp2[$i][5]] = count($temp_date);
            $date_schedule_offline_lesson[$id_student_offline_lesson_temp2[$i][5]] = [];
            foreach ($temp_date as $n) {
                array_push($date_schedule_offline_lesson[$id_student_offline_lesson_temp2[$i][5]], date_format(date_create(substr($n['date'], 0, 10)), "d"));
            }
            $date_schedule_offline_lesson[$id_student_offline_lesson_temp2[$i][5]] = implode(", ", $date_schedule_offline_lesson[$id_student_offline_lesson_temp2[$i][5]]);
        }

        // echo "<br>";
        // echo "<br>";
        // echo var_dump($id_student_offline_lesson_temp);
        // echo "<br>";
        // echo "<br>";
        // echo var_dump($date_schedule_offline_lesson);
        // echo "<br>";
        // echo "<br>";
        $id_pack_online = [];
        $date_pack_online = [];

        $other_invoice = $this->M_Admin->getData_other_invoice($id_parent, $periode);

        $title = "Detail Offline invoice | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/admin/invoice/periode/detail', array('ortu' => $ortu, 'title' => $title, 'description' => $description, 'id_student_offline_lesson_temp' => $id_student_offline_lesson_temp, 'date_schedule_offline_lesson' => $date_schedule_offline_lesson, 'total_pack_offline_lesson' => $total_pack_offline_lesson, 'other_invoice' => $other_invoice));
    }

    public function detail_invoice_periode_transaksi_parent($periode, $id_parent)
    {
        $ortu = $this->M_Admin->getData_student(null, $id_parent);
        $other_invoice = $this->M_Admin->getData_other_invoice($id_parent, $periode);
        $data_offline = $this->M_Admin->getData_summary_invoice($id_parent, $periode);

        $id_student_offline_lesson = [];
        $date_schedule_offline_lesson = [];
        $total_pack_offline_lesson = [];

        foreach ($data_offline as $n) {
            $id_student_offline_lesson[] = $n['id_teacher'] . "&" . $n['id_student'] . "&" . $n['name_student']  . "&" . $n['name_paket'] . "&" . $n['rate'] . "&" . $n['id_course'];
        }

        $id_student_offline_lesson_temp = array_unique($id_student_offline_lesson);
        sort($id_student_offline_lesson_temp);

        for ($i = 0; $i < count($id_student_offline_lesson_temp); $i++) {
            $id_student_offline_lesson_temp2[$i] = explode("&", $id_student_offline_lesson_temp[$i]);

            $temp_date = $this->M_Admin->getData_schedule(null, $periode, null, $id_student_offline_lesson_temp2[$i][5]);
            $total_pack_offline_lesson[$id_student_offline_lesson_temp2[$i][5]] = count($temp_date);
            $date_schedule_offline_lesson[$id_student_offline_lesson_temp2[$i][5]] = [];
            foreach ($temp_date as $n) {
                array_push($date_schedule_offline_lesson[$id_student_offline_lesson_temp2[$i][5]], date_format(date_create(substr($n['date'], 0, 10)), "d"));
            }
            $date_schedule_offline_lesson[$id_student_offline_lesson_temp2[$i][5]] = implode(", ", $date_schedule_offline_lesson[$id_student_offline_lesson_temp2[$i][5]]);
        }

        // echo "<br>";
        // echo "<br>";
        // echo var_dump($id_student_offline_lesson_temp);
        // echo "<br>";
        // echo "<br>";
        // echo var_dump($date_schedule_offline_lesson);
        // echo "<br>";
        // echo "<br>";
        $id_pack_online = [];
        $date_pack_online = [];

        $other_invoice = $this->M_Admin->getData_other_invoice($id_parent, $periode);

        $title = "Detail Offline invoice | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/admin/invoice/parent/detail_periode', array('ortu' => $ortu, 'title' => $title, 'description' => $description, 'id_student_offline_lesson_temp' => $id_student_offline_lesson_temp, 'date_schedule_offline_lesson' => $date_schedule_offline_lesson, 'total_pack_offline_lesson' => $total_pack_offline_lesson, 'other_invoice' => $other_invoice));
    }

    public function add_other_invoice($id_parent, $periode)
    {
        $data =  [
            'id_parent' => $id_parent,
            'periode' => $periode,
            'other_category' => '',
            'other_note' => '',
            'other_price' => '0',
        ];
        $this->db->insert('other_invoice', $data);
        redirect('portal/C_Admin/detail_invoice_periode_transaksi/' . $periode . '/' . $id_parent);
    }

    public function add_other_invoice_online($id_parent, $periode, $no_transaksi)
    {
        $data =  [
            'id_parent' => $id_parent,
            'periode' => $periode,
            'no_transaksi' => $no_transaksi,
            'other_category' => '',
            'other_note' => '',
            'other_price' => '0',
        ];
        $this->db->insert('other_invoice_online', $data);
        redirect('portal/C_Admin/detail_invoice_purchase/' . $no_transaksi);
    }

    public function update_data_other_invoice_online($id_other_invoice)
    {
        $data = $_POST['data'];
        $value = $_POST['value'];
        $this->M_Admin->updateDataOtherInvoiceOnline($id_other_invoice, $data, $value);
    }

    public function delete_data_other_invoice_online($id_other_invoice, $no_transaksi)
    {
        $res = $this->M_Admin->deleteDataOtherInvoiceOnline($id_other_invoice);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully added');
            redirect('portal/C_Admin/detail_invoice_purchase/' . $no_transaksi);
        } else {
            $this->session->set_flashdata('warning', 'Failed to add data');
            redirect('portal/C_Admin/detail_invoice_purchase/' . $no_transaksi);
        }
    }

    public function data_invoice_parent_summary()
    {
        $this->cekLogin();
        $offline_invoice = $this->M_Admin->getData_schedule();
        $online_invoice = $this->M_Admin->getData_sirkulasi();

        $invoice_periode = [];
        $summ_off = [];
        $summ_on = [];

        if (count($offline_invoice) > 0) {
            foreach ($offline_invoice as $n) {
                $invoice_periode[] = substr($n['date'], 0, 7);
                $summ_off[] = substr($n['date'], 0, 7);
            }
        }
        if (count($online_invoice) > 0) {
            foreach ($online_invoice as $n) {
                $invoice_periode[] = substr($n['created_at'], 0, 7);
                $summ_on[] = substr($n['created_at'], 0, 7);
            }
        }

        $invoice_periode = array_unique($invoice_periode);
        $summ_off = array_unique($summ_off);
        $summ_on = array_unique($summ_on);

        rsort($invoice_periode);
        rsort($summ_off);
        rsort($summ_on);

        // echo var_dump($invoice_periode);

        $title = "Data Invoice | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/invoice/summary/data', array('invoice_periode' => $invoice_periode, 'summ_off' => $summ_off, 'summ_on' => $summ_on));
        $this->load->view('portal/reuse/footer');
    }

    public function detail_summary_offline_invoice($periode)
    {
        $this->cekLogin();

        $data = [];
        $data_lesson_date = [];
        $count_total_lesson = [];
        $total_other_price = [];
        $payment_date = [];


        $invoice = $this->M_Admin->getData_summary_invoice(null, $periode);
        $invoice_temp_lesson = [];
        foreach ($invoice as $n) {
            $invoice_temp_lesson[] = $n['id_parent'] . "&" . $n['parent_student'] . "&" . $n['name_student'] . "&" . $n['name_teacher'] . "&" . $n['id_course'] . "&" . $n['name_paket'] . "&" . $n['rate'];
        }
        $invoice_temp_lesson = array_unique($invoice_temp_lesson);
        sort($invoice_temp_lesson);


        for ($i = 0; $i < count($invoice_temp_lesson); $i++) {
            $invoice_temp_lesson_ex2[$i] = explode("&", $invoice_temp_lesson[$i]);
            $data[$invoice_temp_lesson_ex2[$i][0]][$invoice_temp_lesson_ex2[$i][4]] = [];
            $data_lesson_date[$invoice_temp_lesson_ex2[$i][0]][$invoice_temp_lesson_ex2[$i][4]] = [];

            $temp_id_course = $this->M_Admin->getData_summary_invoice($invoice_temp_lesson_ex2[$i][0], $periode, $invoice_temp_lesson_ex2[$i][4]);
            $count_total_lesson[$invoice_temp_lesson_ex2[$i][0]][$invoice_temp_lesson_ex2[$i][4]] = count($temp_id_course);

            $other_invoice = $this->M_Admin->getData_other_invoice($invoice_temp_lesson_ex2[$i][0], $periode);
            $total_other_price[$invoice_temp_lesson_ex2[$i][0]][$invoice_temp_lesson_ex2[$i][4]] = 0;
            if(count($other_invoice) > 0){
                foreach ($other_invoice as $n) {
                    $total_other_price[$invoice_temp_lesson_ex2[$i][0]][$invoice_temp_lesson_ex2[$i][4]] += intval($n['other_price']);
                }
            }
            $date_payment = $this->M_Admin->getData_payment_date($periode, $invoice_temp_lesson_ex2[$i][0], 2);
            $payment_date[$invoice_temp_lesson_ex2[$i][0]][$invoice_temp_lesson_ex2[$i][4]] = '';
            if (count($date_payment) > 0) {
                $payment_date[$invoice_temp_lesson_ex2[$i][0]][$invoice_temp_lesson_ex2[$i][4]] = $date_payment[0]['date'];
            }

            foreach ($temp_id_course as $n) {
                array_push($data_lesson_date[$invoice_temp_lesson_ex2[$i][0]][$invoice_temp_lesson_ex2[$i][4]], date_format(date_create(substr($n['date'], 0, 10)), "d"));
            }
            $data_lesson_date[$invoice_temp_lesson_ex2[$i][0]][$invoice_temp_lesson_ex2[$i][4]] = implode(", ", $data_lesson_date[$invoice_temp_lesson_ex2[$i][0]][$invoice_temp_lesson_ex2[$i][4]]);
        }

        $title = "Data Summary Offline Invoice | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/admin/invoice/summary/detail_summary_offline', array('title' => $title, 'description' => $description,
            'invoice_temp_lesson' => $invoice_temp_lesson,
            'data_lesson_date' => $data_lesson_date,
            'count_total_lesson' => $count_total_lesson,
            'total_other_price' => $total_other_price,
            'payment_date' => $payment_date,
        ));
    }

    public function detail_summary_online_invoice($periode)
    {
        $this->cekLogin();

        $data = [];
        $data_lesson_date = [];
        $count_total_lesson = [];
        $data_package = [];
        $data_teacher = [];
        $paket_name = [];
        $total_lesson_price = [];
        $total_other_price = [];
        $total_event = [];
        $total_book = [];
        $payment_date = [];

        $invoice = $this->M_Admin->getData_sirkulasi(null, null, $periode);
        
        $invoice_temp_lesson = [];
        foreach ($invoice as $n) {
            $invoice_temp_lesson[] = $n['no_transaksi'] . "&" . $n['is_id_parent'] . "&" . $n['parent_student'] . "&" . $n['name_student'] . "&" . $n['rate'];
        }

        $invoice_temp_lesson = array_unique($invoice_temp_lesson);
        sort($invoice_temp_lesson);
        // echo var_dump($invoice_temp_lesson);
        for ($i = 0; $i < count($invoice_temp_lesson); $i++) {
            $invoice_temp_lesson_ex2[$i] = explode("&", $invoice_temp_lesson[$i]);

            $data_package[$invoice_temp_lesson_ex2[$i][0]] = [];
            $data_teacher[$invoice_temp_lesson_ex2[$i][0]] = [];
            $paket_name[$invoice_temp_lesson_ex2[$i][0]] = [];
            $data_lesson_date[$invoice_temp_lesson_ex2[$i][0]] = [];
            $total_lesson_price[$invoice_temp_lesson_ex2[$i][0]] = 0;
            $total_other_price[$invoice_temp_lesson_ex2[$i][0]] = 0;
            $total_event[$invoice_temp_lesson_ex2[$i][0]] = 0;
            $total_book[$invoice_temp_lesson_ex2[$i][0]] = 0;
            $payment_date[$invoice_temp_lesson_ex2[$i][0]] = 0;


            $invoice_detail = $this->M_Admin->getData_sirkulasi_transaksi($invoice_temp_lesson_ex2[$i][0]);
            // echo "<br>";
            // echo "<br>";
            // echo var_dump($invoice_detail);
            // echo "<br>";
            // echo "<br>";
            // echo "=========================";
            foreach ($invoice_detail as $sd) {
                if (substr($sd['id_barang'], 0, 3) == "PAC") {
                    $total_lesson_price[$invoice_temp_lesson_ex2[$i][0]] += $sd['price'];
                    $temp_package = $this->M_Admin->getData_transaksi_package($sd['id_barang']);
                    foreach ($temp_package as $tp) {
                        $data_teacher[$invoice_temp_lesson_ex2[$i][0]][$tp['no_transaksi_package']] = [];
                        $paket_name[$invoice_temp_lesson_ex2[$i][0]][$tp['no_transaksi_package']] = [];
                        $data_lesson_date[$invoice_temp_lesson_ex2[$i][0]][$tp['no_transaksi_package']] = [];
                    }
                    foreach($temp_package as $tp){
                        array_push($data_package[$invoice_temp_lesson_ex2[$i][0]], $tp['no_transaksi_package']);

                        if($tp['status_pack_practical'] == 1){
                            array_push($paket_name[$invoice_temp_lesson_ex2[$i][0]][$tp['no_transaksi_package']], $tp['name']);
                            array_push($data_teacher[$invoice_temp_lesson_ex2[$i][0]][$tp['no_transaksi_package']], $tp['teacher_pratical']);   
                            
                            $temp_schedule_pack = $this->M_Admin->getData_schedule_package_invoice(null, $tp['id_list_pack'], null, null, null, null, null, 1);
                            
                            $temp = [];
                            foreach ($temp_schedule_pack as $n) {
                                array_push($temp, date_format(date_create(substr($n['date_schedule'], 0, 10)), "d/m"));
                            }
                            $temp = implode(", ", $temp);
                            array_push($data_lesson_date[$invoice_temp_lesson_ex2[$i][0]][$tp['no_transaksi_package']], $temp);
                        }
                        if ($tp['status_pack_theory'] == 1) {
                            array_push($paket_name[$invoice_temp_lesson_ex2[$i][0]][$tp['no_transaksi_package']], $tp['name']);
                            array_push($data_teacher[$invoice_temp_lesson_ex2[$i][0]][$tp['no_transaksi_package']], $tp['teacher_teory']);

                            $temp_schedule_pack = $this->M_Admin->getData_schedule_package_invoice(null, $tp['id_list_pack'], null, null, null, null, null, 2);

                            $temp = [];
                            foreach ($temp_schedule_pack as $n) {
                                array_push($temp, date_format(date_create(substr($n['date_schedule'], 0, 10)), "d/m"));
                            }
                            $temp = implode(", ", $temp);
                            array_push($data_lesson_date[$invoice_temp_lesson_ex2[$i][0]][$tp['no_transaksi_package']], $temp);
                        }
                    }
                }
                if (substr($sd['id_barang'], 0, 3) == "EVN") {
                    $total_event[$invoice_temp_lesson_ex2[$i][0]] += $sd['price'];
                    $temp_event = $this->M_Admin->getData_transaksi_event($sd['id_barang']);
                    $event[] = $temp_event[0];
                }
                if (substr($sd['id_barang'], 0, 3) == "BOK") {
                    $total_book[$invoice_temp_lesson_ex2[$i][0]] += $sd['price'];
                    $temp_book = $this->M_Admin->getData_transaksi_book($sd['id_barang']);
                    $book[] = $temp_book[0];
                }
            }

            $tempNoTransaksi = str_replace("/", "", $invoice_temp_lesson_ex2[$i][0]);
            $other_invoice = $this->M_Admin->getData_other_invoice_online(null,$periode, $tempNoTransaksi);
            if (count($other_invoice) > 0) {
                foreach ($other_invoice as $n) {
                    $total_other_price[$invoice_temp_lesson_ex2[$i][0]] += intval($n['other_price']);
                }
            }
            $date_payment = $this->M_Admin->getData_payment_date($periode, null, 1, $tempNoTransaksi);
            if (count($date_payment) > 0) {
                $payment_date[$invoice_temp_lesson_ex2[$i][0]] = $date_payment[0]['date'];
            }
        }
       
        // echo "<br>";
        // echo "<br>";
        // echo var_dump($data_package);
        // echo "<br>";
        // echo "<br>";
        // echo "<br>";
        // echo "<br>";
        // echo var_dump($data_teacher);
        // echo "<br>";
        // echo "<br>";
        // echo "<br>";
        // echo "<br>";
        // echo var_dump($data_lesson_date);
        // echo "<br>";
        // echo "<br>";
        
        $title = "Data Summary Online Invoice | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/admin/invoice/summary/detail_summary_online', array('title' => $title, 'description' => $description,
            'invoice_temp_lesson' => $invoice_temp_lesson,
            'data_package' => $data_package,
            'data_teacher' => $data_teacher,
            'paket_name' => $paket_name,
            'data_lesson_date' => $data_lesson_date,
            'total_lesson_price' => $total_lesson_price,
            'total_event' => $total_event,
            'total_book' => $total_book,
            'total_other_price' => $total_other_price,
            'payment_date' => $payment_date,
        ));
    }

    public function update_data_payment_date_offline()
    {
        $tipe = $_POST['tipe'];
        $no_sirkulasi = $_POST['no_sirkulasi'];
        $periode = $_POST['periode'];
        $id_parent = $_POST['id_parent'];
        $date = $_POST['date'];

        $data =  [
            "tipe" => $tipe,
            "no_sirkulasi" => $no_sirkulasi,
            "periode" => $periode,
            "id_parent" => $id_parent,
            "date" => $date
        ];

        $date_payment = $this->M_Admin->getData_payment_date($periode, $id_parent, $tipe, $no_sirkulasi);
        if(count($date_payment) > 0){
            $this->db->update('payment_date', $data, ['id_payment' => $date_payment[0]['id_payment']]);
        }else{
            $this->db->insert('payment_date', $data);
        }
    }

    public function cek_package($id_pack)
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
    }
    public function data_feereport_teacher_summary()
    {
        $this->cekLogin();
        $feereport = $this->M_Admin->getData_sirkulasi_feereport();
        $feereport_temp = [];
        foreach ($feereport as $n) {
            $feereport_temp[] = substr($n['created_at'], 0, 7);
        }
        $feereport_temp = array_unique($feereport_temp);
        rsort($feereport_temp);

        // $feereport = $this->M_Admin->getData_sirkulasi_lesson_detail();
        // $feereport_temp = [];
        // foreach ($feereport as $n) {
        //     $feereport_temp[] = substr($n['lesson_date'], 0, 7);
        // }
        // $feereport_temp = array_unique($feereport_temp);
        // rsort($feereport_temp);
        $title = "Data Feereport Teacher | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/admin/feereport/summary/data', array('feereport_temp' => $feereport_temp));
        $this->load->view('portal/reuse/footer');
    }
    public function detail_feereport_teacher_summary($periode)
    {
        $this->cekLogin();
        
        $data = [];
        $data_lesson_date = [];
        $count_total_lesson = [];
        $total_other_price = [];
        $payment_date = [];
        $data_teacher = [];

        $feereport_data = $this->M_Admin->getData_sirkulasi_feereport(null,null,null, $periode);
        $feereport_temp_lesson = [];
        foreach ($feereport_data as $n) {
            $date_paid = "null";
            if($n['date_paid'] != null){
                $date_paid = $n['date_paid'];
            }
            $feereport_temp_lesson[] = $n['no_sirkulasi_feereport'] . "&" . $n['name_teacher'] . "&" . $n['status_approved'] . "&" . $n['id_teacher'] . "&" . $n['instrument'] . "&" . $date_paid;
            $data_teacher[] = $n['id_teacher'];
        }
        $feereport_temp_lesson = array_unique($feereport_temp_lesson);
        sort($feereport_temp_lesson);

        $data_teacher = array_unique($data_teacher);
        sort($data_teacher);

        //cek periode before
            $tipe_rate100_paket_pratical_before = [];
            $tipe_rate50_paket_pratical_before = [];
            $tipe_rate_paket_pratical_before = [];

            $tipe_rate100_paket_teory_before = [];
            $tipe_rate50_paket_teory_before = [];
            $tipe_rate_paket_teory_before = [];

            $tipe_rate100_offline_lesson_before = [];
            $tipe_rate50_offline_lesson_before = [];
            $tipe_rate_offline_lesson_before = [];

            //cek periode
            $tipe_rate100_paket_pratical = [];
            $tipe_rate50_paket_pratical = [];
            $tipe_rate_paket_pratical = [];

            $tipe_rate100_paket_teory = [];
            $tipe_rate50_paket_teory = [];
            $tipe_rate_paket_teory = [];

            $tipe_rate100_offline_lesson = [];
            $tipe_rate50_offline_lesson = [];
            $tipe_rate_offline_lesson = [];

            //cek total pack 
            $total_pack_periode_rate100_paket_pratical = [];
            $total_pack_periode_rate50_paket_pratical = [];
            $total_pack_periode_rate_paket_pratical = [];

            $total_pack_periode_rate100_paket_teory = [];
            $total_pack_periode_rate50_paket_teory = [];
            $total_pack_periode_rate_paket_teory = [];

            $total_pack_periode_rate100_offline_lesson = [];
            $total_pack_periode_rate50_offline_lesson = [];
            $total_pack_periode_rate_offline_lesson = [];

            //cek date lesson
            $date_rate_paket_pratical = [];

        $total_lesson_fee_teacher = [];
        $total_lesson_fee_teacher_euro = [];
        $total_lesson_fee_teacher_dollar = [];


        $total_other_fee_teacher = [];

       
        for ($p = 0; $p < count($data_teacher); $p++) {
            $id_teacher = $data_teacher[$p];
            $feereport = $this->M_Admin->getData_sirkulasi_lesson_detail(null, null, $id_teacher, null, null, $periode);
            $feereport_before = $this->M_Admin->getData_sirkulasi_lesson_detail_before_periode(null, null, $id_teacher, null, null, $periode, 50);

            //cek id student
            $id_student_nadia_paket_pratical = [];
            $id_student_nadia_paket_teory = [];
            $id_student_nadia_offline_lesson = [];

            $id_student_paket_pratical = [];
            $id_student_paket_teory = [];
            $id_student_offline_lesson = [];

            $total_lesson_fee_teacher[$id_teacher] = 0;
            $total_lesson_fee_teacher_euro[$id_teacher] = 0;
            $total_lesson_fee_teacher_dollar[$id_teacher] = 0;

            $total_other_fee_teacher[$id_teacher] = 0;

            foreach ($feereport as $n) {
                if ($n['id_teacher'] == '200001') {
                    if ($n['tipe'] == 1) {
                        $rate_dollar = $this->M_Admin->getData_list_pack($n['id_list_pack']);
                        $id_student_nadia_paket_pratical[] = $n['id_student'] . "&" . $n['name_student']  . "&" . $n['name_paket'] . "&" . $n['price'] . "&1&" . $n['id_list_pack'] . "&" . $n['no_sirkulasi_lesson'] . "&" . $rate_dollar[0]['rate_dollar'];
                    }
                    if ($n['tipe'] == 2) {
                        $rate_dollar = $this->M_Admin->getData_list_pack($n['id_list_pack']);
                        $id_student_nadia_paket_teory[] = $n['id_student'] . "&" . $n['name_student']  . "&" . $n['name_paket'] . "&" . $n['price'] . "&2&" . $n['id_list_pack'] . "&" . $n['no_sirkulasi_lesson'] . "&" . $rate_dollar[0]['rate_dollar'];
                    }
                    if ($n['tipe'] == 3) {
                        $id_student_nadia_offline_lesson[] = $n['id_student'] . "&" . $n['name_student']  . "&" . $n['name_paket'] . "&" . $n['price'] . "&3&" . $n['id_offline_lesson'] . "&" . $n['no_sirkulasi_lesson'];
                    }
                } else {
                    if ($n['tipe'] == 1) {
                        $id_student_paket_pratical[] = $n['id_student'] . "&" . $n['name_student']  . "&" . $n['name_paket'] . "&" . $n['price'] . "&" . $n['rate'] . "&1&" . $n['id_list_pack'] . "&" . $n['no_sirkulasi_lesson'];
                    }
                    if ($n['tipe'] == 2) {
                        $id_student_paket_teory[] = $n['id_student'] . "&" . $n['name_student']  . "&" . $n['name_paket'] . "&" . $n['price'] . "&" . $n['rate'] . "&2&" . $n['id_list_pack'] . "&" . $n['no_sirkulasi_lesson'];
                    }
                    if ($n['tipe'] == 3) {
                        $id_student_offline_lesson[] = $n['id_student'] . "&" . $n['name_student']  . "&" . $n['name_paket'] . "&" . $n['price'] . "&" . $n['rate'] . "&3&" . $n['id_offline_lesson'] . "&" . $n['no_sirkulasi_lesson'];
                    }
                }
            }
            $id_student_nadia_paket_pratical_temp = array_unique($id_student_nadia_paket_pratical);
            rsort($id_student_nadia_paket_pratical_temp);

            $id_student_nadia_paket_teory_temp = array_unique($id_student_nadia_paket_teory);
            rsort($id_student_nadia_paket_teory_temp);

            $id_student_nadia_offline_lesson_temp = array_unique($id_student_nadia_offline_lesson);
            rsort($id_student_nadia_offline_lesson_temp);

            $id_student_paket_pratical_temp = array_unique($id_student_paket_pratical);
            rsort($id_student_paket_pratical_temp);

            $id_student_paket_teory_temp = array_unique($id_student_paket_teory);
            rsort($id_student_paket_teory_temp);

            $id_student_offline_lesson_temp = array_unique($id_student_offline_lesson);
            rsort($id_student_offline_lesson_temp);



            sort($id_student_paket_pratical_temp);
            sort($id_student_paket_teory_temp);
            sort($id_student_offline_lesson_temp);

            $date_temp_for_teory = null;
            $index_teory = [];
            if ($id_teacher == '200001') {
                for ($i = 0; $i < count($id_student_nadia_paket_pratical_temp); $i++) {
                    $id_student_nadia_paket_pratical_temp2[$i] = explode("&", $id_student_nadia_paket_pratical_temp[$i]);

                    $temp_before_rate100_paket_pratical = $this->M_Admin->getData_sirkulasi_lesson_detail_before_periode(null, null, null, $id_student_nadia_paket_pratical_temp2[$i][0], $id_student_nadia_paket_pratical_temp2[$i][4], $periode, null, $id_student_nadia_paket_pratical_temp2[$i][5]);
                    $tipe_rate100_paket_pratical_before[$id_student_nadia_paket_pratical_temp2[$i][6]] = count($temp_before_rate100_paket_pratical);

                    $temp_rate100_paket_pratical = $this->M_Admin->getData_sirkulasi_lesson_detail(null, null, null, $id_student_nadia_paket_pratical_temp2[$i][0], $id_student_nadia_paket_pratical_temp2[$i][4], $periode, null, $id_student_nadia_paket_pratical_temp2[$i][5]);
                    $tipe_rate100_paket_pratical[$id_student_nadia_paket_pratical_temp2[$i][6]] = count($temp_rate100_paket_pratical);

                    if (($tipe_rate100_paket_pratical_before[$id_student_nadia_paket_pratical_temp2[$i][6]] % 2) == 0) {
                        $total_pack_periode_rate100_paket_pratical[$id_student_nadia_paket_pratical_temp2[$i][6]] = round($tipe_rate100_paket_pratical[$id_student_nadia_paket_pratical_temp2[$i][6]] / 2);
                    } else {
                        $total_pack_periode_rate100_paket_pratical[$id_student_nadia_paket_pratical_temp2[$i][6]] = round(($tipe_rate100_paket_pratical[$id_student_nadia_paket_pratical_temp2[$i][6]] - 1) / 2);
                    }


                    if ($id_student_nadia_paket_pratical_temp2[$i][7] == '1') {
                        $total_lesson_fee_teacher[$id_teacher] += $total_pack_periode_rate100_paket_pratical[$id_student_nadia_paket_pratical_temp2[$i][6]] * $id_student_nadia_paket_pratical_temp2[$i][3] * 100 / 100;
                    }
                    if ($id_student_nadia_paket_pratical_temp2[$i][7] == '2') {
                        $total_lesson_fee_teacher_dollar[$id_teacher] += $total_pack_periode_rate100_paket_pratical[$id_student_nadia_paket_pratical_temp2[$i][6]] * $id_student_nadia_paket_pratical_temp2[$i][3] * 100 / 100;
                    }
                    if ($id_student_nadia_paket_pratical_temp2[$i][7] == '3') {
                        $total_lesson_fee_teacher_euro[$id_teacher] += $total_pack_periode_rate100_paket_pratical[$id_student_nadia_paket_pratical_temp2[$i][6]] * $id_student_nadia_paket_pratical_temp2[$i][3] * 100 / 100;
                    }

                }
                for ($i = 0; $i < count($id_student_nadia_paket_teory_temp); $i++) {
                    $id_student_nadia_paket_teory_temp2[$i] = explode("&", $id_student_nadia_paket_teory_temp[$i]);
                    $temp_before_rate100_paket_teory = $this->M_Admin->getData_sirkulasi_lesson_detail_before_periode(null, null, null, $id_student_nadia_paket_teory_temp2[$i][0], $id_student_nadia_paket_teory_temp2[$i][4], $periode, null, $id_student_nadia_paket_teory_temp2[$i][5]);
                    $tipe_rate100_paket_teory_before[$id_student_nadia_paket_teory_temp2[$i][6]] = count($temp_before_rate100_paket_teory);

                    $temp_rate100_paket_teory = $this->M_Admin->getData_sirkulasi_lesson_detail(null, null, null, $id_student_nadia_paket_teory_temp2[$i][0], $id_student_nadia_paket_teory_temp2[$i][4], $periode, null, $id_student_nadia_paket_teory_temp2[$i][5]);
                    $tipe_rate100_paket_teory[$id_student_nadia_paket_teory_temp2[$i][6]] = count($temp_rate100_paket_teory);

                    $total_pack_periode_rate100_paket_teory[$id_student_nadia_paket_teory_temp2[$i][6]] = $tipe_rate100_paket_teory[$id_student_nadia_paket_teory_temp2[$i][6]];

                     if ($id_student_nadia_paket_pratical_temp2[$i][7] == '1') {
                        $total_lesson_fee_teacher[$id_teacher] += $total_pack_periode_rate100_paket_teory[$id_student_nadia_paket_teory_temp2[$i][6]] * $id_student_nadia_paket_teory_temp2[$i][3] * 100 / 100;
                    }
                    if ($id_student_nadia_paket_pratical_temp2[$i][7] == '2') {
                        $total_lesson_fee_teacher_dollar[$id_teacher] += $total_pack_periode_rate100_paket_teory[$id_student_nadia_paket_teory_temp2[$i][6]] * $id_student_nadia_paket_teory_temp2[$i][3] * 100 / 100;
                    }
                    if ($id_student_nadia_paket_pratical_temp2[$i][7] == '3') {
                        $total_lesson_fee_teacher_euro[$id_teacher] += $total_pack_periode_rate100_paket_teory[$id_student_nadia_paket_teory_temp2[$i][6]] * $id_student_nadia_paket_teory_temp2[$i][3] * 100 / 100;
                    }
                    
                }
                for ($i = 0; $i < count($id_student_nadia_offline_lesson_temp); $i++) {
                    $id_student_nadia_offline_lesson_temp2[$i] = explode("&", $id_student_nadia_offline_lesson_temp[$i]);

                    $temp_before_rate100_offline_lesson = $this->M_Admin->getData_sirkulasi_lesson_detail_before_periode(null, null, null, $id_student_nadia_offline_lesson_temp2[$i][0], $id_student_nadia_offline_lesson_temp2[$i][4], $periode, null, null, $id_student_nadia_offline_lesson_temp2[$i][5]);

                    $tipe_rate100_offline_lesson_before[$id_student_nadia_offline_lesson_temp2[$i][6]] = count($temp_before_rate100_offline_lesson);

                    $temp_rate100_offline_lesson = $this->M_Admin->getData_sirkulasi_lesson_detail(null, null, null, $id_student_nadia_offline_lesson_temp2[$i][0], $id_student_nadia_offline_lesson_temp2[$i][4], $periode, null, null, $id_student_nadia_offline_lesson_temp2[$i][5]);
                    $tipe_rate100_offline_lesson[$id_student_nadia_offline_lesson_temp2[$i][6]] = count($temp_rate100_offline_lesson);

                    $total_pack_periode_rate100_offline_lesson[$id_student_nadia_offline_lesson_temp2[$i][6]] = $tipe_rate100_offline_lesson[$id_student_nadia_offline_lesson_temp2[$i][6]];
                    if ($id_student_nadia_paket_pratical_temp2[$i][7] == '1') {
                        $total_lesson_fee_teacher[$id_teacher] += $total_pack_periode_rate100_offline_lesson[$id_student_nadia_offline_lesson_temp2[$i][6]] * $id_student_nadia_offline_lesson_temp2[$i][3] * 100 / 100;
                    }
                    if ($id_student_nadia_paket_pratical_temp2[$i][7] == '2') {
                        $total_lesson_fee_teacher_dollar[$id_teacher] += $total_pack_periode_rate100_offline_lesson[$id_student_nadia_offline_lesson_temp2[$i][6]] * $id_student_nadia_offline_lesson_temp2[$i][3] * 100 / 100;
                    }
                    if ($id_student_nadia_paket_pratical_temp2[$i][7] == '3') {
                        $total_lesson_fee_teacher_euro[$id_teacher] += $total_pack_periode_rate100_offline_lesson[$id_student_nadia_offline_lesson_temp2[$i][6]] * $id_student_nadia_offline_lesson_temp2[$i][3] * 100 / 100;
                    }
                }
            } else {
                for ($i = 0; $i < count($id_student_paket_pratical_temp); $i++) {
                    $id_student_paket_pratical_temp2[$i] = explode("&", $id_student_paket_pratical_temp[$i]);
                    $temp_temp[$id_student_paket_pratical_temp2[$i][7]] = null;

                    if ($id_student_paket_pratical_temp2[$i][4] == 50) {
                        $temp_before_rate50_paket_pratical = $this->M_Admin->getData_sirkulasi_lesson_detail_before_periode(null, null, null, $id_student_paket_pratical_temp2[$i][0], $id_student_paket_pratical_temp2[$i][5], $periode, $id_student_paket_pratical_temp2[$i][4], $id_student_paket_pratical_temp2[$i][6]);
                        $tipe_rate50_paket_pratical_before[$id_student_paket_pratical_temp2[$i][7]] = count($temp_before_rate50_paket_pratical);
                        $temp_rate50_paket_pratical = $this->M_Admin->getData_sirkulasi_lesson_detail(null, null, null, $id_student_paket_pratical_temp2[$i][0], $id_student_paket_pratical_temp2[$i][5], $periode, $id_student_paket_pratical_temp2[$i][4], $id_student_paket_pratical_temp2[$i][6]);
                        $tipe_rate50_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] = count($temp_rate50_paket_pratical);

                        if ($tipe_rate50_paket_pratical_before[$id_student_paket_pratical_temp2[$i][7]] == 7) {
                            $temp_temp[$id_student_paket_pratical_temp2[$i][7]] = $id_student_paket_pratical_temp[$i];
                            $date_temp_for_teory[$id_student_paket_pratical_temp2[$i][7]] = [];
                            $a = 1;
                            $index_teory[] = $id_student_paket_pratical_temp[$i];
                        } else {
                            if (($tipe_rate50_paket_pratical_before[$id_student_paket_pratical_temp2[$i][7]] % 2) == 0) {
                                $total_pack_periode_rate50_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] = round($tipe_rate50_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] / 2);
                            } else {
                                $total_pack_periode_rate50_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] = round(($tipe_rate50_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] - 1) / 2);
                            }
                            $total_lesson_fee_teacher[$id_teacher] += $total_pack_periode_rate50_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] * $id_student_paket_pratical_temp2[$i][3] * 50 / 100;
                        }
                    }
                    if ($id_student_paket_pratical_temp2[$i][4] == 70) {
                        $temp_before_rate_paket_pratical = $this->M_Admin->getData_sirkulasi_lesson_detail_before_periode(null, null, null, $id_student_paket_pratical_temp2[$i][0], $id_student_paket_pratical_temp2[$i][5], $periode, $id_student_paket_pratical_temp2[$i][4], $id_student_paket_pratical_temp2[$i][6]);
                        $tipe_rate_paket_pratical_before[$id_student_paket_pratical_temp2[$i][7]] = count($temp_before_rate_paket_pratical);

                        $temp_rate_paket_pratical = $this->M_Admin->getData_sirkulasi_lesson_detail(null, null, null, $id_student_paket_pratical_temp2[$i][0], $id_student_paket_pratical_temp2[$i][5], $periode, $id_student_paket_pratical_temp2[$i][4], $id_student_paket_pratical_temp2[$i][6]);
                        $tipe_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] = count($temp_rate_paket_pratical);

                        if (($tipe_rate_paket_pratical_before[$id_student_paket_pratical_temp2[$i][7]] % 2) == 0) {
                            $total_pack_periode_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] = round($tipe_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] / 2);
                        } else {
                            $total_pack_periode_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] = round(($tipe_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] - 1) / 2);
                        }
                        $total_lesson_fee_teacher[$id_teacher] += $total_pack_periode_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] * $id_student_paket_pratical_temp2[$i][3] * 70 / 100;
                    }
                    if ($id_student_paket_pratical_temp2[$i][4] == 80) {
                        $temp_before_rate_paket_pratical = $this->M_Admin->getData_sirkulasi_lesson_detail_before_periode(null, null, null, $id_student_paket_pratical_temp2[$i][0], $id_student_paket_pratical_temp2[$i][5], $periode, $id_student_paket_pratical_temp2[$i][4], $id_student_paket_pratical_temp2[$i][6]);
                        $tipe_rate_paket_pratical_before[$id_student_paket_pratical_temp2[$i][7]] = count($temp_before_rate_paket_pratical);

                        $temp_rate_paket_pratical = $this->M_Admin->getData_sirkulasi_lesson_detail(null, null, null, $id_student_paket_pratical_temp2[$i][0], $id_student_paket_pratical_temp2[$i][5], $periode, $id_student_paket_pratical_temp2[$i][4], $id_student_paket_pratical_temp2[$i][6]);
                        $tipe_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] = count($temp_rate_paket_pratical);
                        $date_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] = [];

                        if (($tipe_rate_paket_pratical_before[$id_student_paket_pratical_temp2[$i][7]] % 2) == 0) {
                            $total_pack_periode_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] = round($tipe_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] / 2);
                        } else {
                            $total_pack_periode_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] = round(($tipe_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] - 1) / 2);
                        }
                        $total_lesson_fee_teacher[$id_teacher] += $total_pack_periode_rate_paket_pratical[$id_student_paket_pratical_temp2[$i][7]] * $id_student_paket_pratical_temp2[$i][3] * 80 / 100;
                    }
                }
                for ($i = 0; $i < count($id_student_paket_teory_temp); $i++) {
                    $id_student_paket_teory_temp2[$i] = explode("&", $id_student_paket_teory_temp[$i]);
                    if ($id_student_paket_teory_temp2[$i][4] == 50) {
                        $temp_before_rate50_paket_teory = $this->M_Admin->getData_sirkulasi_lesson_detail_before_periode(null, null, null, $id_student_paket_teory_temp2[$i][0], $id_student_paket_teory_temp2[$i][5], $periode, $id_student_paket_teory_temp2[$i][4], $id_student_paket_teory_temp2[$i][6]);
                        $tipe_rate50_paket_teory_before[$id_student_paket_teory_temp2[$i][7]] = count($temp_before_rate50_paket_teory);

                        $temp_rate50_paket_teory = $this->M_Admin->getData_sirkulasi_lesson_detail(null, null, null, $id_student_paket_teory_temp2[$i][0], $id_student_paket_teory_temp2[$i][5], $periode, $id_student_paket_teory_temp2[$i][4], $id_student_paket_teory_temp2[$i][6]);
                        $tipe_rate50_paket_teory[$id_student_paket_teory_temp2[$i][7]] = count($temp_rate50_paket_teory);

                        $total_pack_periode_rate50_paket_teory[$id_student_paket_teory_temp2[$i][7]] = $tipe_rate50_paket_teory[$id_student_paket_teory_temp2[$i][7]];

                        $total_lesson_fee_teacher[$id_teacher] += $total_pack_periode_rate50_paket_teory[$id_student_paket_teory_temp2[$i][7]] * $id_student_paket_teory_temp2[$i][3] * 50 / 100;
                    }
                    if ($id_student_paket_teory_temp2[$i][4] == 70) {
                        $temp_before_rate_paket_teory = $this->M_Admin->getData_sirkulasi_lesson_detail_before_periode(null, null, null, $id_student_paket_teory_temp2[$i][0], $id_student_paket_teory_temp2[$i][5], $periode, $id_student_paket_teory_temp2[$i][4], $id_student_paket_teory_temp2[$i][6]);
                        $tipe_rate_paket_teory_before[$id_student_paket_teory_temp2[$i][7]] = count($temp_before_rate_paket_teory);

                        $temp_rate_paket_teory = $this->M_Admin->getData_sirkulasi_lesson_detail(null, null, null, $id_student_paket_teory_temp2[$i][0], $id_student_paket_teory_temp2[$i][5], $periode, $id_student_paket_teory_temp2[$i][4], $id_student_paket_teory_temp2[$i][6]);
                        $tipe_rate_paket_teory[$id_student_paket_teory_temp2[$i][7]] = count($temp_rate_paket_teory);

                        $total_pack_periode_rate_paket_teory[$id_student_paket_teory_temp2[$i][7]] = $tipe_rate_paket_teory[$id_student_paket_teory_temp2[$i][7]];

                        $total_lesson_fee_teacher[$id_teacher] += $total_pack_periode_rate_paket_teory[$id_student_paket_teory_temp2[$i][7]] * $id_student_paket_teory_temp2[$i][3] * 70 / 100;
                    }
                    if ($id_student_paket_teory_temp2[$i][4] == 80) {
                        $temp_before_rate_paket_teory = $this->M_Admin->getData_sirkulasi_lesson_detail_before_periode(null, null, null, $id_student_paket_teory_temp2[$i][0], $id_student_paket_teory_temp2[$i][5], $periode, $id_student_paket_teory_temp2[$i][4], $id_student_paket_teory_temp2[$i][6]);
                        $tipe_rate_paket_teory_before[$id_student_paket_teory_temp2[$i][7]] = count($temp_before_rate_paket_teory);

                        $temp_rate_paket_teory = $this->M_Admin->getData_sirkulasi_lesson_detail(null, null, null, $id_student_paket_teory_temp2[$i][0], $id_student_paket_teory_temp2[$i][5], $periode, $id_student_paket_teory_temp2[$i][4], $id_student_paket_teory_temp2[$i][6]);
                        $tipe_rate_paket_teory[$id_student_paket_teory_temp2[$i][7]] = count($temp_rate_paket_teory);

                        $total_pack_periode_rate_paket_teory[$id_student_paket_teory_temp2[$i][7]] = $tipe_rate_paket_teory[$id_student_paket_teory_temp2[$i][7]];

                        $total_lesson_fee_teacher[$id_teacher] += $total_pack_periode_rate_paket_teory[$id_student_paket_teory_temp2[$i][7]] * $id_student_paket_teory_temp2[$i][3] * 80 / 100;
                    }
                }
                for ($i = 0; $i < count($id_student_offline_lesson_temp); $i++) {
                    $id_student_offline_lesson_temp2[$i] = explode("&", $id_student_offline_lesson_temp[$i]);

                    if ($id_student_offline_lesson_temp2[$i][4] == 50) {
                        $temp_before_rate50_offline_lesson = $this->M_Admin->getData_sirkulasi_lesson_detail_before_periode(null, null, null, $id_student_offline_lesson_temp2[$i][0], $id_student_offline_lesson_temp2[$i][5], $periode, $id_student_offline_lesson_temp2[$i][4], null, $id_student_offline_lesson_temp2[$i][6]);
                        $tipe_rate50_offline_lesson_before[$id_student_offline_lesson_temp2[$i][7]] = count($temp_before_rate50_offline_lesson);

                        $temp_rate50_offline_lesson = $this->M_Admin->getData_sirkulasi_lesson_detail(null, null, null, $id_student_offline_lesson_temp2[$i][0], $id_student_offline_lesson_temp2[$i][5], $periode, $id_student_offline_lesson_temp2[$i][4], null, $id_student_offline_lesson_temp2[$i][6]);
                        $tipe_rate50_offline_lesson[$id_student_offline_lesson_temp2[$i][7]] = count($temp_rate50_offline_lesson);

                        $total_pack_periode_rate50_offline_lesson[$id_student_offline_lesson_temp2[$i][7]] = $tipe_rate50_offline_lesson[$id_student_offline_lesson_temp2[$i][7]];

                        $total_lesson_fee_teacher[$id_teacher] += $total_pack_periode_rate50_offline_lesson[$id_student_offline_lesson_temp2[$i][7]] * $id_student_offline_lesson_temp2[$i][3] * 50 / 100;
                    }
                    if ($id_student_offline_lesson_temp2[$i][4] == 80) {
                        $temp_before_rate_offline_lesson = $this->M_Admin->getData_sirkulasi_lesson_detail_before_periode(null, null, null, $id_student_offline_lesson_temp2[$i][0], $id_student_offline_lesson_temp2[$i][5], $periode, $id_student_offline_lesson_temp2[$i][4], null, $id_student_offline_lesson_temp2[$i][6]);
                        $tipe_rate_offline_lesson_before[$id_student_offline_lesson_temp2[$i][7]] = count($temp_before_rate_offline_lesson);

                        $temp_rate_offline_lesson = $this->M_Admin->getData_sirkulasi_lesson_detail(null, null, null, $id_student_offline_lesson_temp2[$i][0], $id_student_offline_lesson_temp2[$i][5], $periode, $id_student_offline_lesson_temp2[$i][4], null, $id_student_offline_lesson_temp2[$i][6]);
                        $tipe_rate_offline_lesson[$id_student_offline_lesson_temp2[$i][7]] = count($temp_rate_offline_lesson);

                        $total_pack_periode_rate_offline_lesson[$id_student_offline_lesson_temp2[$i][7]] = $tipe_rate_offline_lesson[$id_student_offline_lesson_temp2[$i][7]];
                        
                        $total_lesson_fee_teacher[$id_teacher] += $total_pack_periode_rate_offline_lesson[$id_student_offline_lesson_temp2[$i][7]] * $id_student_offline_lesson_temp2[$i][3] * 80 / 100;
                    }
                }
            }

            $other_feereport = $this->M_Admin->getData_other_feereport($id_teacher, $periode);
            $event_teacher = $this->M_Admin->getData_event_teacher(null, $id_teacher, $periode);
            $offline_trial = $this->M_Admin->getData_offline_trial(null, $periode, $id_teacher);

            foreach ($event_teacher as $e) {
                $total_other_fee_teacher[$id_teacher] -= $e['total_rate'];
            }
            foreach ($offline_trial as $e) {
                $total_other_fee_teacher[$id_teacher] += 100000;
            }
             foreach ($other_feereport as $oi) {
                $total_other_fee_teacher[$id_teacher] += $oi['other_price'];
            }
        }
        // echo "FEE";
        // echo "<br>";
        // echo var_dump($total_lesson_fee_teacher);
        // echo "<br>";
        // echo "<br>";
        // echo var_dump($total_lesson_fee_teacher_dollar);
        // echo "<br>";
        // echo "<br>";
        // echo var_dump($total_lesson_fee_teacher_euro);
        // echo "<br>";
        // echo "<br>";

        // echo var_dump($total_other_fee_teacher);
        // echo "<br>";
        // echo "<br>";

        $title = "Data Summary Fee Report Teacher | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/admin/feereport/summary/detail_summary_feereport', array('title' => $title, 'description' => $description,
            'feereport_temp_lesson' => $feereport_temp_lesson,
            'total_lesson_fee_teacher' => $total_lesson_fee_teacher,
            'total_lesson_fee_teacher_dollar' => $total_lesson_fee_teacher_dollar,
            'total_lesson_fee_teacher_euro' => $total_lesson_fee_teacher_euro,
            'total_other_fee_teacher' => $total_other_fee_teacher,
        ));
    }

    public function update_data_payment_feereport()
    {
        $no_sirkulasi_feereport = $_POST['no_sirkulasi_feereport'];
        $date = $_POST['date'];

        $data =  [
            "date_paid" => $date
        ];

        $this->db->update('sirkulasi_feereport', $data, ['no_sirkulasi_feereport' => $no_sirkulasi_feereport]);
        
    }
}
