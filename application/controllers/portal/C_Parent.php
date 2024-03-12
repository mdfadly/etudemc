<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Parent extends CI_Controller
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

    public function notfound()
    {
        $this->cekLogin();
        $student = $this->M_Admin->getData_student(null, $this->session->userdata('id'));
        $title = "Dashboard | Welcome to Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'student' => $student));
        $this->load->view('portal/parent/404');
        $this->load->view('portal/reuse/footer');
    }

    public function profile($username)
    {
        $this->cekLogin();
        $student = $this->M_Admin->getData_student(null, $this->session->userdata('id'));
        $tempTotPack = 0;
        foreach ($student as $key => $value) {
            $student_package = $this->M_Admin->getData_student_package($value['id_student']);
            $tempTotPack += count($student_package);
        }
        $title = "Profile | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'student' => $student));
        $this->load->view('portal/parent/profile', array('student' => $student, 'tempTotPack' => $tempTotPack));
        $this->load->view('portal/reuse/footer');
    }

    public function offline_lesson()
    {
        $this->cekLogin();
        $student = $this->M_Parent->getData_student(null, $this->session->userdata('id'));
        $package_offline = $this->M_Admin->getData_list_package_offline(null, $this->session->userdata('id'));
        $package_offline_temp = [];
        foreach ($package_offline as $p) {
            $test = $p["id_student"] . "-" . $p['name_student'];
            array_push($package_offline_temp, $test);
        }
        $package_offline_temp = array_unique($package_offline_temp);
        sort($package_offline_temp);
        $title = "Offline Lesson | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'student' => $student));
        $this->load->view('portal/parent/data_offline', array('package_offline' => $package_offline_temp));
        $this->load->view('portal/reuse/footer');
    }

    public function offline_lesson_list($id_student)
    {
        $this->cekLogin();
        $student = $this->M_Parent->getData_student(null, $this->session->userdata('id'));
        $studentTemp = $this->M_Parent->getData_student($id_student);
        $title = "Offline Lesson | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'student' => $student));
        $this->load->view('portal/parent/data_offline_list', array('studentTemp' => $studentTemp));
        $this->load->view('portal/reuse/footer');
    }

    function get_ajax_student()
    {
        $this->cekLogin();
        $dbTable = "student";
        $list = $this->M_Parent->get_datatables($dbTable);

        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no . ".";
            $temp_id_student = substr($item->id_student, 6);
            $row[] = $item->id_parent . "-" . $temp_id_student;
            $row[] = $item->name_student;

            $paket = '<span class="badge badge-danger">Not Package</span>';
            $cek_paket_student = $this->M_Admin->getData_student_package($item->id_student);
            $tempNamePaket = [];
            foreach ($cek_paket_student as $sp) :
                array_push($tempNamePaket, $sp['name_paket']);
            endforeach;

            if (count($cek_paket_student) > 0) {
                $paket = implode(", ", $tempNamePaket);
            }

            $instrument = $item->instrument;
            if (substr($instrument, 0, 6) == "Others") {
                $temp_ins = explode('|', $instrument);
                $instrument = $temp_ins[1];
            }

            $row[] = $instrument;
            $row[] = $paket;

            $row[] = '<a href="' . site_url('portal/profile-parent/student/' . $item->id_student) . '" class="btn btn-primary mr-2 btn-update" title="Detail"> <i class="fa fa-info"></i> </a>';

            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_Parent->count_all($dbTable),
            "recordsFiltered" => $this->M_Parent->count_filtered($dbTable),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    public function get_offline_lesson()
    {
        $this->cekLogin();
        $id_student = $_POST['id_student'];
        $this->get_ajax_offline_lesson2($id_student);
    }

    function get_ajax_offline_lesson2($id_student)
    {
        $this->cekLogin();
        $dbTable = "list_package_offline";
        $list = $this->M_Parent->get_datatables($dbTable, $id_student);

        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();

            $count_done = 0;
            $count_cancel = 0;
            $count_ongoing = 0;
            $data_schedule = $this->M_Parent->getData_schedule_package_offline(null, $item->id_list_package_offline);
            foreach ($data_schedule as $ds) {
                if ($ds['status'] == '1' || ($ds['status'] == '3' && $ds['date_update_cancel'] == null) || $ds['status'] == '7' || $ds['status'] == '5') {
                    $count_ongoing += 1;
                } else if ($ds['status'] == '2' || ($ds['status'] == '3' && $ds['date_update_cancel'] != null)) {
                    $count_done += 1;
                } else if ($ds['status'] == '3' && $ds['date_update_cancel'] == null) {
                    $count_cancel += 1;
                }
            }

            $row[] = $item->no_transaksi_package_offline;
            $row[] = $item->name_teacher;

            $startdate = date_create(substr($item->created_at, 0, 10));
            $tgl_awal = date_format($startdate, "d/m/Y");

            $enddate = date_create(substr($item->end_at, 0, 10));
            $tgl_akhir = date_format($enddate, "d/m/Y");

            $today = date("Y-m-d");

            $row[] = $tgl_awal . " - " . $tgl_akhir;

            $status_pack = "";
            if ($count_ongoing == 0 && $count_done == 0 && $count_cancel == 0) {
                $status_pack = `<span class="badge badge-primary text-white">No schedule yet"</span>`;
            } else {
                if (count($data_schedule) == $count_done) {
                    $status_pack = '<span class="badge badge-danger">Done</span>';
                } else if (($count_ongoing == 2) && $count_done > 0) {
                    $status_pack = '<span class="badge badge-warning text-white">2 pack more!</span>';
                } else if (($count_ongoing == 1) && $count_done > 0) {
                    $status_pack = '<span class="badge badge-warning text-white">1 pack more!</span>';
                } else {
                    $status_pack = '<span class="badge text-white" style="background-color:#00B050">On Going</span>';
                }
            }
            $row[] = $status_pack;
            // $row[] = $status_pack ." - ". $count_ongoing ." - " . $count_done ." - " . $count_cancel;
            // add html for action
            if ($count_ongoing == 0 && $count_done == 0 && $count_cancel == 0) {
                $row[] = '';
            } else {
                if (count($data_schedule) == $count_done) {
                    $row[] = '<a class="text-danger" href="' . site_url('portal/offline-lesson/calendar/' . $item->id_list_package_offline) . '" style="font-size:23px;"> <i class="fa fa-calendar"></i> </a><br>';
                } else if (($count_ongoing == 2 || $count_ongoing == 1) && $count_done > 0) {
                    $row[] = '<a class="text-warning" href="' . site_url('portal/offline-lesson/calendar/' . $item->id_list_package_offline) . '" style="font-size:23px;"> <i class="fa fa-calendar"></i> </a><br>';
                } else {
                    $row[] = '<a href="' . site_url('portal/offline-lesson/calendar/' . $item->id_list_package_offline) . '" style="font-size:23px; color:#00B050"> <i class="fa fa-calendar"></i> </a><br>';
                }
            }
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_Parent->count_all($dbTable, $id_student),
            "recordsFiltered" => $this->M_Parent->count_filtered($dbTable, $id_student),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    public function offline_lesson_calendar($id_package)
    {
        $this->cekLogin();
        $student = $this->M_Parent->getData_student(null, $this->session->userdata('id'));

        $pack_online = $this->M_Teacher->getData_pack_offline($id_package);
        $schedule_online = $this->M_Teacher->getData_schedule_package_offline(null, $id_package);
        $count_package = [];
        foreach ($schedule_online as $so) {
            $count_package[] = $so['id_schedule_package_offline'];
        }
        $title = "Attendance Offline Lesson | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'student' => $student));
        $this->load->view('portal/parent/data_offline_calendar', array('pack_online' => $pack_online, 'count_package' => $count_package));
        $this->load->view('portal/reuse/footer');
    }

    public function cek_package_offline($id_pack)
    {
        $this->cekLogin();
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

    public function load_package_offline($id_list_package_offline, $id_student)
    {
        $event_data = $this->M_Parent->fetch_all_package_offline($id_list_package_offline, $id_student);
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
                    if (fmod($z++, 2) == 1) {
                        $title = 'Paket ' . $x . ' A';
                    } else {
                        $title = 'Paket ' . $x++ . ' B';
                    }
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
                if (fmod($z++, 2) == 1) {
                    $title = 'Re - Lesson ' . $x . ' A';
                } else {
                    $title = 'Re - Lesson ' . $x++ . ' B';
                }
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

    public function load_package($id_list_pack, $id_student, $jenis)
    {
        $event_data = $this->M_Parent->fetch_all_package($id_list_pack, $id_student, $jenis);
        $z = 1;
        $x = 1;
        foreach ($event_data->result_array() as $row) {
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
        echo json_encode($data);
    }

    public function online_pratical()
    {
        $this->cekLogin();
        $student = $this->M_Parent->getData_student(null, $this->session->userdata('id'));
        $package_online = $this->M_Admin->getData_list_pack(null, $this->session->userdata('id'), null, null, 1);
        $package_online_temp = [];
        foreach ($package_online as $p) {
            $test = $p["id_student"] . "-" . $p['name_student'];
            array_push($package_online_temp, $test);
        }
        $package_online_temp = array_unique($package_online_temp);
        sort($package_online_temp);
        $title = "Online Pratical Lesson | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'student' => $student));
        $this->load->view('portal/parent/data_online', array('package_online' => $package_online_temp));
        $this->load->view('portal/reuse/footer');
    }

    public function online_pratical_list($id_student)
    {
        $this->cekLogin();
        $student = $this->M_Parent->getData_student(null, $this->session->userdata('id'));
        $studentTemp = $this->M_Parent->getData_student($id_student);

        $title = "Online Pratical Lesson | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'student' => $student));
        $this->load->view('portal/parent/data_online_list', array('studentTemp' => $studentTemp));
        $this->load->view('portal/reuse/footer');
    }

    public function get_online_pratical()
    {
        $this->cekLogin();
        $id_student = $_POST['id_student'];
        $jenis = $_POST['jenis'];
        // $id_student = '1000021';
        // $jenis = "1";

        $this->get_ajax_online_pratical($id_student, $jenis);
    }

    function get_ajax_online_pratical($id_student, $jenis)
    {
        $this->cekLogin();
        $dbTable = "list_package";
        $list = $this->M_Parent->get_datatables($dbTable, $id_student, null, $jenis);

        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();

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

            $row[] = $item->no_transaksi_package;
            $row[] = $item->name_teacher;

            $startdate = date_create(substr($item->created_at, 0, 10));
            $tgl_awal = date_format($startdate, "d/m/Y");

            $enddate = date_create(substr($item->end_at, 0, 10));
            $tgl_akhir = date_format($enddate, "d/m/Y");

            $today = date("Y-m-d");

            $row[] = $tgl_awal . " - " . $tgl_akhir;

            $status_pack = "";
            if ($count_ongoing == 0 && $count_done == 0 && $count_cancel == 0) {
                $status_pack = '<span class="badge badge-primary text-white">No schedule yet</span>';
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
            $row[] = $status_pack;
            // $row[] = $status_pack ." - ". $count_ongoing ." - " . $count_done ." - " . $count_cancel;
            // add html for action
            if ($count_ongoing == 0 && $count_done == 0 && $count_cancel == 0) {
                $row[] = '';
            } else {
                if (count($data_schedule) == $count_done) {
                    $row[] = '<a class="text-danger" href="' . site_url('portal/online-pratical/calendar/' . $item->id_list_pack . '/1') . '" style="font-size:23px;"> <i class="fa fa-calendar"></i> </a><br>';
                } else if (($count_ongoing == 2 || $count_ongoing == 1 || $count_ongoing == 3 || $count_ongoing == 4) && $count_done > 0) {
                    $row[] = '<a class="text-warning" href="' . site_url('portal/online-pratical/calendar/' . $item->id_list_pack . '/1') . '" style="font-size:23px;"> <i class="fa fa-calendar"></i> </a><br>';
                } else {
                    $row[] = '<a href="' . site_url('portal/online-pratical/calendar/' . $item->id_list_pack . '/1') . '" style="font-size:23px; color:#00B050"> <i class="fa fa-calendar"></i> </a><br>';
                }
            }
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_Parent->count_all($dbTable, $id_student, null, $jenis),
            "recordsFiltered" => $this->M_Parent->count_filtered($dbTable, $id_student, null, $jenis),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    public function online_pratical_calendar($id_package, $jenis)
    {
        $this->cekLogin();
        $student = $this->M_Parent->getData_student(null, $this->session->userdata('id'));

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

        $title = "Attendance Offline Lesson | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'student' => $student));
        $this->load->view('portal/parent/data_online_calendar', array('pack_online' => $pack_online, 'count_theory' => $count_theory, 'count_pratical' => $count_pratical, 'jenis' => $jenis));
        $this->load->view('portal/reuse/footer');
    }

    public function online_theory()
    {
        $this->cekLogin();
        $student = $this->M_Parent->getData_student(null, $this->session->userdata('id'));
        $package_online = $this->M_Admin->getData_list_pack(null, $this->session->userdata('id'), null, null, null, 1);
        $package_online_temp = [];
        foreach ($package_online as $p) {
            $test = $p["id_student"] . "-" . $p['name_student'];
            array_push($package_online_temp, $test);
        }
        $package_online_temp = array_unique($package_online_temp);
        sort($package_online_temp);
        $title = "Theory Lesson | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'student' => $student));
        $this->load->view('portal/parent/data_theory', array('package_online' => $package_online_temp));
        $this->load->view('portal/reuse/footer');
    }

    public function online_theory_list($id_student)
    {
        $this->cekLogin();
        $student = $this->M_Parent->getData_student(null, $this->session->userdata('id'));
        $studentTemp = $this->M_Parent->getData_student($id_student);

        $title = "Theory Lesson | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'student' => $student));
        $this->load->view('portal/parent/data_theory_list', array('studentTemp' => $studentTemp));
        $this->load->view('portal/reuse/footer');
    }

    public function get_online_theory()
    {
        $this->cekLogin();
        $id_student = $_POST['id_student'];
        $jenis = $_POST['jenis'];

        $this->get_ajax_online_theory($id_student, $jenis);
    }

    function get_ajax_online_theory($id_student, $jenis)
    {
        $this->cekLogin();
        $dbTable = "list_package";
        $list = $this->M_Parent->get_datatables($dbTable, $id_student, null, $jenis);

        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();

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

            $row[] = $item->no_transaksi_package;
            $row[] = $item->name_teacher;

            $startdate = date_create(substr($item->created_at, 0, 10));
            $tgl_awal = date_format($startdate, "d/m/Y");

            $enddate = date_create(substr($item->end_at, 0, 10));
            $tgl_akhir = date_format($enddate, "d/m/Y");

            $today = date("Y-m-d");

            $row[] = $tgl_awal . " - " . $tgl_akhir;

            $status_pack = "";
            if ($count_ongoing == 0 && $count_done == 0 && $count_cancel == 0) {
                $status_pack = '<span class="badge badge-primary text-white">No schedule yet</span>';
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
            $row[] = $status_pack;
            // $row[] = $status_pack ." - ". $count_ongoing ." - " . $count_done ." - " . $count_cancel;
            // add html for action
            if ($count_ongoing == 0 && $count_done == 0 && $count_cancel == 0) {
                $row[] = '';
            } else {
                if (count($data_schedule) == $count_done) {
                    $row[] = '<a class="text-danger" href="' . site_url('portal/online-theory/calendar/' . $item->id_list_pack . '/2') . '" style="font-size:23px;"> <i class="fa fa-calendar"></i> </a><br>';
                } else if (($count_ongoing == 2 || $count_ongoing == 1 || $count_ongoing == 3 || $count_ongoing == 4) && $count_done > 0) {
                    $row[] = '<a class="text-warning" href="' . site_url('portal/online-theory/calendar/' . $item->id_list_pack . '/2') . '" style="font-size:23px;"> <i class="fa fa-calendar"></i> </a><br>';
                } else {
                    $row[] = '<a href="' . site_url('portal/online-theory/calendar/' . $item->id_list_pack . '/2') . '" style="font-size:23px; color:#00B050"> <i class="fa fa-calendar"></i> </a><br>';
                }
            }
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_Parent->count_all($dbTable, $id_student, null, $jenis),
            "recordsFiltered" => $this->M_Parent->count_filtered($dbTable, $id_student, null, $jenis),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    public function data_invoice()
    {
        $this->cekLogin();
        $student = $this->M_Parent->getData_student(null, $this->session->userdata('id'));
        $sirkulasi = $this->M_Parent->getData_sirkulasi($this->session->userdata('id'));

        $invoice_temp = [];
        if (count($sirkulasi) > 0) {
            foreach ($sirkulasi as $n) {
                $invoice_temp[] = substr($n['created_at'], 0, 7);
            }
        }

        $invoice_temp = array_unique($invoice_temp);
        rsort($invoice_temp);
        $title = "Data Invoice | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'student' => $student));
        $this->load->view('portal/parent/data_invoice', array('invoice_temp' => $invoice_temp));
        $this->load->view('portal/reuse/footer');
    }

    public function data_invoice_list($periode)
    {
        $this->cekLogin();
        $student = $this->M_Parent->getData_student(null, $this->session->userdata('id'));
        $title = "Data Purchase invoice | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'student' => $student));
        $this->load->view('portal/parent/data_invoice_list', array('periode' => $periode));
        $this->load->view('portal/reuse/footer');
    }

    function get_ajax_sirkulasi($periode = null)
    {
        // $this->cekLogin();
        $dbTable = "sirkulasi";
        $list = $this->M_Parent->get_datatables($dbTable, null, $this->session->userdata('id'), null, $periode);
        $data = array();
        $no = @$_POST['start'];
        if (count($list) > 0) {
            foreach ($list as $item) {
                $parent = $this->M_Parent->getData_student(null, $item->is_id_parent);
                $row = array();
                $row[] = ++$no . ".";
                $row[] = date_format(date_create(substr($item->created_at, 0, 10)), "d/m/Y");
                $row[] = $item->no_transaksi;
                $row[] = '<a target="_blank" href="' . site_url('portal/invoice/purchase/etude/' . md5($item->no_transaksi)) . '" class="btn btn-xs btn-primary mr-2 btn-update" title="Open Data ini"> <i class="fas fa-file icon-white"></i> </a>';
                $data[] = $row;
            }
        } else {
            $row = array();
            $row[] = '';
            $row[] = '';
            $row[] = 'No data available in table';
            $row[] = '';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_Parent->count_all($dbTable, null, $this->session->userdata('id'), null, $periode),
            "recordsFiltered" => $this->M_Parent->count_filtered($dbTable, null, $this->session->userdata('id'), null, $periode),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    public function detail_student($id_student)
    {
        $this->cekLogin();
        $student = $this->M_Admin->getData_student($id_student);
        $student_package = $this->M_Admin->getData_student_package($id_student);
        $title = "Data Student | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'student' => $student));
        $this->load->view('portal/parent/data_student', array('student' => $student, 'student_package' => $student_package));
        $this->load->view('portal/reuse/footer');
    }

    public function add_student($id_student)
    {
        $this->cekLogin();
        $student = $this->M_Admin->getData_student(null, $id_student);
        $title = "Data Student | Portal Etude";
        $description = "Welcome to Portal Etude";

        $paket = $this->M_Admin->getData_paket();
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'student' => $student));
        $this->load->view('portal/parent/add_student', array('student' => $student, 'paket' => $paket));
        $this->load->view('portal/reuse/footer');
    }

    public function add_data_student()
    {
        $res = $this->M_Admin->insertDataStudent2();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully added');
            redirect('portal/profile-parent/' . $this->session->userdata('username'));
        } else {
            $this->session->set_flashdata('warning', 'Failed to add data');
            redirect('portal/profile-parent/' . $this->session->userdata('username'));
        }
    }

    public function edit_student($id_student)
    {
        $this->cekLogin();
        $student = $this->M_Admin->getData_student($id_student);
        $title = "Data Student | Portal Etude";
        $description = "Welcome to Portal Etude";

        $paket = $this->M_Admin->getData_paket();
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'student' => $student));
        $this->load->view('portal/parent/edit_student', array('student' => $student, 'paket' => $paket));
        $this->load->view('portal/reuse/footer');
    }

    public function edit_data_student()
    {
        $res = $this->M_Parent->updateDataStudent();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully updated');
            redirect('portal/profile-parent/student/' . $this->input->post('id_student'));
        } else {
            $this->session->set_flashdata('warning', 'Failed to update data');
            redirect('portal/profile-parent/student/' . $this->input->post('id_student'));
        }
    }

    function delete_data_student($id_student)
    {
        $res = $this->M_Admin->deleteDataStudent($id_student);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully deleted');
            redirect('portal/profile-parent/' . $this->session->userdata('username'));
        } else {
            $this->session->set_flashdata('warning', 'Failed to delete data');
            redirect('portal/profile-parent/' . $this->session->userdata('username'));
        }
    }

    public function edit_parent($id_parent)
    {
        $this->cekLogin();
        $student = $this->M_Parent->getData_student(null, $id_parent);
        $title = "Data Student | Portal Etude";
        $description = "Welcome to Portal Etude";

        $paket = $this->M_Admin->getData_paket();
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'student' => $student));
        $this->load->view('portal/parent/edit_parent', array('student' => $student, 'paket' => $paket));
        $this->load->view('portal/reuse/footer');
    }

    public function edit_data_parent()
    {
        $res = $this->M_Parent->updateDataParent();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully updated');
            redirect('portal/profile-parent/' . $this->session->userdata('username'));
        } else {
            $this->session->set_flashdata('warning', 'Failed to update data');
            redirect('portal/profile-parent/' . $this->session->userdata('username'));
        }
    }

    public function data_event()
    {
        $this->cekLogin();
        $student = $this->M_Parent->getData_student(null,  $this->session->userdata('id'));
        $title = "Data Event | Portal Etude";
        $description = "Welcome to Portal Etude";

        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'student' => $student));
        $this->load->view('portal/parent/data_event', array('student' => $student));
        $this->load->view('portal/reuse/footer');
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
                                       :
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
                                       :
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . implode("<br>", $date_event_price) . '
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
                                        Event Price
                                    </label>
                                    <div class="col-lg-1 pt-2">
                                       :
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . implode("<br>", $price_event) . '
                                    </div>
                                </div>
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

    function get_ajax_event_student()
    {
        $this->cekLogin();
        $dbTable = "register_event";
        $list = $this->M_Parent->get_datatables($dbTable, null, $this->session->userdata('id'));

        $data = array();
        $no = @$_POST['start'];
        $temp_id_parent = "";
        foreach ($list as $item) {
            $no++;
            $row = array();

            $temp_event = $this->M_Admin->getEventByParent_($item->parent_event);
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
                                       :
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
                                       :
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
                                       :
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
                                       :
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
                                       :
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
                                       :
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
                                       :
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
                                       :
                                    </div>
                                    <div class="col-lg-4 pt-2">
                                    ' . $item->discount . '%
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4 col-form-label">
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
                            <div class="modal-footer">
                                <div class="btn-group"><a href="' . site_url('portal/C_Parent/delete_data_event_student/' . str_replace("/", "-", $item->no_transaksi_event)) . '" class="btn btn-danger" title="Hapus Data Ini" onclick=\'return confirm("this data will be deleted. are you sure?")\'><i class="fa fa-trash icon-white"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                ';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_Parent->count_all($dbTable, null, $this->session->userdata('id')),
            "recordsFiltered" => $this->M_Parent->count_filtered($dbTable, null, $this->session->userdata('id')),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    public function data_event_student()
    {
        $this->cekLogin();
        $student = $this->M_Parent->getData_student(null,  $this->session->userdata('id'));
        $title = "Data Event | Portal Etude";
        $description = "Welcome to Portal Etude";

        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'student' => $student));
        $this->load->view('portal/parent/data_event_student', array('student' => $student));
        $this->load->view('portal/reuse/footer');
    }

    public function add_event_student()
    {
        $this->cekLogin();
        $student = $this->M_Parent->getData_student(null,  $this->session->userdata('id'));
        $title = "Data Event | Portal Etude";
        $description = "Welcome to Portal Etude";

        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'student' => $student));
        $this->load->view('portal/parent/add_event_student', array('student' => $student));
        $this->load->view('portal/reuse/footer');
    }

    public function add_data_event_student()
    {
        $res = $this->M_Admin->insertDataEventStudent();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully added');
            redirect('portal/join-event/student');
        } else {
            $this->session->set_flashdata('warning', 'Failed to add data');
            redirect('portal/join-event/student');
        }
    }

    function delete_data_event_student($no_transaksi_event)
    {
        $temp_no_transaksi = str_replace("-", "/", $no_transaksi_event);
        $res = $this->M_Admin->deleteDataEventStudent($temp_no_transaksi);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data successfully deleted');
            redirect('portal/join-event/student');
        } else {
            $this->session->set_flashdata('warning', 'Failed to delete data');
            redirect('portal/join-event/student');
        }
    }

    public function data_book()
    {
        $this->cekLogin();
        $student = $this->M_Parent->getData_student(null,  $this->session->userdata('id'));
        $title = "Data Stock Book | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'student' => $student));
        $this->load->view('portal/parent/data_book');
        $this->load->view('portal/reuse/footer');
    }

    public function data_order_book()
    {
        $this->cekLogin();
        $student = $this->M_Parent->getData_student(null,  $this->session->userdata('id'));
        $title = "Data Stock Book | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'student' => $student));
        $this->load->view('portal/parent/data_order_book');
        $this->load->view('portal/reuse/footer');
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
                                   :
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
                                   :
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
                                   :
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . $item->qty . '
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Selling Price
                                </label>
                                <div class="col-lg-1 pt-2">
                                   :
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
            $row[] = $item->qty_order_book;

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
                                   :
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
                                   :
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
                                   :
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
                                   :
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
                                   :
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
                                   :
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
                                   :
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
                                   :
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
                                   :
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
                                   :
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
                                   :
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . $item->discount . '%
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">
                                    Total Price
                                </label>
                                <div class="col-lg-1 pt-2">
                                   :
                                </div>
                                <div class="col-lg-4 pt-2">
                                ' . "Rp " . number_format($item->price, 0, ".", ".") . '
                                </div>
                            </div>
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

    public function detail_parent($id_parent)
    {
        $this->cekLogin();
        $student = $this->M_Admin->getData_student(null, $id_parent);
        $title = "Data Student | Portal Etude";
        $description = "Welcome to Portal Etude";

        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'student' => $student));
        $this->load->view('portal/parent/detail_parent', array('student' => $student));
        $this->load->view('portal/reuse/footer');
    }

    public function data_repository()
    {
        $this->cekLogin();
        $student = $this->M_Parent->getData_student(null, $this->session->userdata('id'));

        $title = "Repository Student | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'student' => $student));
        $this->load->view('portal/parent/data_repository', array('student' => $student));
        $this->load->view('portal/reuse/footer');
    }
}
