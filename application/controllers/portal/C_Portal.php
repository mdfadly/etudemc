<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Portal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_Portal');
        $this->load->model('M_Admin');
    }

    public function index()
    {
        $this->cekLogin();
        $student = $this->M_Admin->getData_student(null, $this->session->userdata('id'));
        $teacher = $this->M_Teacher->getData_teacher($this->session->userdata('id'));
        $title = "Dashboard | Welcome to Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'teacher' => $teacher, 'student' => $student));
        $this->load->view('portal/dashboard');
        $this->load->view('portal/reuse/footer');
    }

    public function login()
    {
        $title = "Portal Etude | Login";
        $description = "Please login first to start a journey";
        $this->load->view('portal/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/login');
        $this->load->view('portal/footer');
    }

    private function cekLogin()
    {
        if (!$this->session->userdata('login_user')) {
            redirect('portal/user-login');
        }
    }

    public function forgot_password()
    {
        $title = "Portal Etude | Change Password";
        $description = "Create a new password";
        $this->load->view('portal/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/forgot_password');
        $this->load->view('portal/footer');
    }

    public function update_password()
    {
        $dataEmail = $_POST['email'];
        $email = $this->M_Portal->get_teacher(" where email_teacher = '$dataEmail'");
        if (count($email) < 1) {
            $this->session->set_flashdata('warning', 'Your email is wrong or not registered');
            redirect('portal/user-forgotPassword');
        } else {
            $data = array(
                'password' => $_POST['password'],
            );
            $where = array('email_teacher' => $_POST['email']);
            $this->M_Portal->updateData('teacher', $data, $where);
            $this->session->set_flashdata('success', 'Your password has been changed, Please login again!');
            redirect('portal/user-login');
        }
    }

    public function register()
    {
        $title = "Portal Etude | Register Account";
        $description = "Create an account first before starting";
        // $this->load->view('portal/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/register', array('title' => $title, 'description' => $description));
        // $this->load->view('portal/footer');
    }

    public function addDataRegister()
    {
        $user = $this->M_Portal->getLastTeacher();
        $id_teacher = "";
        if (count($user) < 1) {
            $id_teacher = "100001";
        } else {
            $id_teacher =  intval($user[0]['id_teacher']) + 1;
        }

        $total_bank_account = $this->input->post('total_bank_account');

        $dataEmail = $_POST['email'];
        $dataUsername = $_POST['username'];
        $cek_email = $this->M_Portal->get_teacher(" where email_teacher = '$dataEmail'");
        $cek_username = $this->M_Portal->get_teacher(" where username = '$dataUsername'");
        if (count($cek_email) < 1 && count($cek_username) < 1) {
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
            $bank_teacher = $_POST['bank1'];
            $norek_teacher = $_POST['norek1'];
            $name_rek_teacher = $_POST['name_rek_teacher1'];
            $iban_rek_teacher = $_POST['iban_rek_teacher1'];
            $swift_rek_teacher = $_POST['swift_rek_teacher1'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $kat = $_POST['kat'];

            //upload KTP
            $ktp_teacher = "";

            $this->load->library('upload');

            $config['upload_path'] = './assets/img/ktp_guru';
            $config['allowed_types'] = 'jpg|JPG|jpeg|JPEG|png|PNG';
            $new_name = "ktp_" . strtolower($username);
            $config['file_name'] = $new_name;

            $this->upload->initialize($config);
            if (!$this->upload->do_upload('ktp')) {
                $this->session->set_flashdata('warning', 'Upload identity card failed. ' . $this->upload->display_errors());
                redirect('portal/user-register');
            } else {
                $upload_data_team = $this->upload->data(); // added this..
                //get the uploaded file name
                $ktp_teacher = $upload_data_team['file_name']; // changed this..
            }

            //upload Picture
            $pict_teacher = "";

            $config2['upload_path'] = './assets/img/pict_guru';
            $config2['allowed_types'] = 'jpg|JPG|jpeg|JPEG|png|PNG';
            $new_name2 = "pict_" . strtolower($username) . "_1";
            $config2['file_name'] = $new_name2;

            $this->upload->initialize($config2);
            if (!$this->upload->do_upload('pict')) {
                $this->session->set_flashdata('warning', 'Upload profile picture failed. ' . $this->upload->display_errors());
                redirect('portal/user-register');
            } else {
                $upload_data_team = $this->upload->data(); // added this..
                //get the uploaded file name
                $pict_teacher = $upload_data_team['file_name']; // changed this..
            }

            $data = array(
                'id_teacher' => $id_teacher,
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
                'ktp_teacher' => $ktp_teacher,
                'pict_teacher' => $pict_teacher,
                'kat' => $kat,
            );

            $res = $this->M_Portal->insertData('teacher', $data);

            for ($i = 1; $i <= $total_bank_account; $i++) {
                $bank = "bank" . $i;
                $name_rek_teacher = "name_rek_teacher" . $i;
                $norek = "norek" . $i;
                $iban_rek_teacher = "iban_rek_teacher" . $i;
                $swift_rek_teacher = "swift_rek_teacher" . $i;
                $data2 =  [
                    'id_teacher' => $id_teacher,
                    'bank_name' => $this->input->post($bank),
                    'bank_account_name' => $this->input->post($name_rek_teacher),
                    'bank_account_no' => $this->input->post($norek),
                    'iban' => $this->input->post($iban_rek_teacher),
                    'swift' => $this->input->post($swift_rek_teacher),
                ];
                $this->db->insert('bank_account_teacher', $data2);
            }

            if ($res >= 1) {
                $session_data = array(
                    'login_user' => true,
                    'username' => $username,
                    'name'     => $name_teacher,
                    'id'     => $id_teacher
                );
                $this->session->set_userdata($session_data);
                $this->session->set_flashdata('success', 'Login Berhasi! hallo ' . $username);
                redirect('portal', $session_data);
            } else {
                $this->session->set_flashdata('warning', 'Failed Add Data');
                redirect('portal/user-register');
            }
        } else {
            if (count($cek_email) > 1 && count($cek_username) > 1) {
                $this->session->set_flashdata('warning', 'Your email and username had been registered');
            } else if (count($cek_email) > 1 && count($cek_username) < 1) {
                $this->session->set_flashdata('warning', 'Your username had been registered');
            } else {
                $this->session->set_flashdata('warning', 'Your email had been registered');
            }
            redirect('portal/user-register');
        }
    }

    public function login_validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run()) {
            //true
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            //model function
            $this->load->model('M_Portal');

            //Jika Teacher
            $cek = $this->M_Portal->can_login("teacher", $username, $password);
            $cek = $cek->row_array(); //now u get an Array

            //Jika Admin
            $cek2 = $this->M_Portal->can_login("admin", $username, $password);
            $cek2 = $cek2->row_array(); //now u get an Array

            //Jika Admin
            $cek3 = $this->M_Portal->can_login("student", $username, $password);
            $cek3 = $cek3->row_array(); //now u get an Array

            if ((count($cek) > 0) && ($cek['status'] == 1)) {
                $session_data = array(
                    'login_user' => true,
                    'username' => $username,
                    'name'     => $cek['name_teacher'],
                    'pict'     => $cek['name_teacher'],
                    'id'     => $cek['id_teacher']
                );
                $this->session->set_userdata($session_data);
                $this->session->set_flashdata('success', 'Login Berhasi! hallo ' . $username);
                redirect('portal', $session_data);
            } else {
                if ((count($cek2) > 0) && ($cek2['status'] == 1)) {
                    if ($cek2['is_login'] == 1) {
                        $this->session->set_flashdata('warning', 'Your account is active on another device');
                        // $this->session->set_flashdata('warning', 'Your account is active on another device, please <a href="' . site_url() . '/portal/C_Portal/push_account/' . $username . '" target="_blank">click here</a>');
                        redirect('portal/user-login');
                    } else {
                        $session_data = array(
                            'login_user' => true,
                            'username' => $username,
                            'name'     => $cek2['nama_admin'],
                            'id'     => $cek2['id_admin']
                        );
                        $this->session->set_userdata($session_data);
                        $this->session->set_flashdata('success', 'Login Berhasi! hallo ' . $username);
                        $data =  [
                            'is_login' => true,
                        ];
                        $this->db->update('admin', $data, ['id_admin' => $cek2['id_admin']]);
                        redirect('portal', $session_data);
                    }
                } else if ((count($cek3) > 0) && ($cek3['status'] == 1)) {
                    $session_data = array(
                        'login_user' => true,
                        'username' => $username,
                        'name'     => $cek3['parent_student'],
                        'id'     => $cek3['id_parent']
                    );
                    $this->session->set_userdata($session_data);
                    $this->session->set_flashdata('success', 'Login Berhasi! hallo ' . $username);
                    redirect('portal', $session_data);
                } else {
                    $this->session->set_flashdata('warning', 'Invalid username and password, Please try again!');
                    redirect('portal/user-login');
                }
            }
        } else {
            $this->session->set_flashdata('warning', 'Something is wrong');
            $this->login();
        }
    }

    function logout()
    {
        if ($this->session->userdata('login_user')) {
            $data =  [
                'is_login' => false,
            ];
            $this->db->update('admin', $data, ['id_admin' => $this->session->userdata('id')]);
        }
        $this->session->sess_destroy();
        $this->session->unset_userdata('username');
        redirect('portal/user-login');
    }

    public function change_status_login($username, $password)
    {
        $cek = $this->M_Portal->can_login("admin", $username, $password);
        $cek = $cek->row_array(); //now u get an Array
        if ($cek != NULL) {
            $data =  [
                'is_login' => false,
            ];
            $this->db->update('admin', $data, ['id_admin' => $cek['id_admin']]);
            echo "updated success";
        } else {
            echo "User Not Found";
        }
    }

    public function checkUsername()
    {
        $username = $this->input->post('username');
        $from = $this->input->post('from');
        if (!empty($username)) {
            $cek_teacher = $this->M_Portal->get_teacher(" where username = '$username'");
            $cek_student = $this->M_Portal->get_student(" where username_parent = '$username'");
            $cek_admin = $this->M_Portal->get_admin(" where username = '$username'");
            $val = count($cek_teacher) + count($cek_student) + count($cek_admin);
            if ($val > 0) {
                echo "<span style='color:red; font-weight:bold'>Username already exists .</span>";
                if ($from == "teacher") {
                    echo "<script>$('#submit').prop('disabled',true);</script>";
                } else {
                    echo "<script>$('#submit-parent').prop('disabled',true);</script>";
                }
            } else {
                echo "<span style='color:green; font-weight:bold'>Username available for registration .</span>";
                if ($from == "teacher") {
                    echo "<script>$('#submit').prop('disabled',false);</script>";
                } else {
                    echo "<script>$('#submit-parent').prop('disabled',false);</script>";
                }
            }
        }
    }

    public function checkEmail()
    {
        $email = $this->input->post('email');
        $from = $this->input->post('from');
        if (!empty($email)) {
            $cek_teacher = $this->M_Portal->get_teacher(" where email_teacher = '$email'");
            $cek_student = $this->M_Portal->get_student(" where email_parent_1 = '$email'");
            // $cek_admin = $this->M_Portal->get_admin(" where email = '$email'");
            // $val = count($cek_teacher) + count($cek_student) + count($cek_admin);
            $val = count($cek_teacher) + count($cek_student);
            if ($val > 0) {
                echo "<span style='color:red; font-weight:bold'>Your Email is Already Registered.</span>";
                if ($from == "teacher") {
                    echo "<script>$('#submit').prop('disabled',true);</script>";
                } else {
                    echo "<script>$('#submit-parent').prop('disabled',true);</script>";
                }
            } else {
                echo "<span style='color:green; font-weight:bold'>Your Email Available for registration .</span>";
                if ($from == "teacher") {
                    echo "<script>$('#submit').prop('disabled',false);</script>";
                } else {
                    echo "<script>$('#submit-parent').prop('disabled',false);</script>";
                }
            }
        }
    }
}
