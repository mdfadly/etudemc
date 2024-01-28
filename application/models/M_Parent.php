<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Parent extends CI_Model
{
    var $column_order_student = array(null, 'id_student', 'name_student', null);
    var $column_search_student = array('id_student', 'name_student');
    var $order_student = array('id_student' => 'asc');

    private function _get_datatables_query_student()
    {
        $this->db->select('*');
        $this->db->from('student as s');
        $this->db->where('status', '1');
        $this->db->where('id_parent', $this->session->userdata('id'));
        $i = 0;
        foreach ($this->column_search_student as $item) {
            if (@$_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search_student) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_student[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order_student = $this->order;
            $this->db->order_by(key($order_student), $order_student[key($order_student)]);
        }
    }

    var $column_order_list_package_offline = array('t.name_teacher', null,  null);
    var $column_search_list_package_offline = array('t.name_teacher');
    var $order_list_package_offline = array('lp.id_list_package_offline' => 'asc');

    private function _get_datatables_query_list_package_offline($id_student)
    {
        $this->db->select('lp.*, s.name_student, t.name_teacher');
        $this->db->from('list_package_offline as lp');
        $this->db->where('lp.id_student', $id_student);
        $this->db->join('student as s', 'lp.id_student = s.id_student', 'left');
        $this->db->join('teacher as t', 'lp.id_teacher = t.id_teacher', 'left');
        $this->db->where('lp.status', '1');
        $this->db->order_by('lp.created_at', 'DESC');

        $i = 0;
        foreach ($this->column_search_list_package_offline as $item) {
            if (@$_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search_list_package_offline) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_list_package_offline[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order_list_package_offline = $this->order;
            $this->db->order_by(key($order_list_package_offline), $order_list_package_offline[key($order_list_package_offline)]);
        }
    }

    var $column_order_online_pratical = array('t.name_teacher', null,  null);
    var $column_search_online_pratical = array('t.name_teacher');
    var $order_online_pratical = array('lp.id_list_pack' => 'asc');

    private function _get_datatables_query_online_pratical($id_student, $jenis)
    {
        $this->db->select('lp.*, s.name_student, t.name_teacher');
        $this->db->from('list_package as lp');
        $this->db->where('lp.id_student', $id_student);
        $this->db->join('student as s', 'lp.id_student = s.id_student', 'left');
        if ($jenis === '1') {
            $this->db->where('lp.status_pack_practical', '1');
            $this->db->join('teacher as t', 'lp.id_teacher_practical = t.id_teacher', 'left');
        } else {
            $this->db->where('lp.status_pack_theory', '1');
            $this->db->join('teacher as t', 'lp.id_teacher_theory = t.id_teacher', 'left');
        }
        $this->db->where('lp.status', '1');
        $this->db->order_by('lp.created_at', 'DESC');

        $i = 0;
        foreach ($this->column_search_online_pratical as $item) {
            if (@$_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search_online_pratical) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_online_pratical[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order_online_pratical = $this->order;
            $this->db->order_by(key($order_online_pratical), $order_online_pratical[key($order_online_pratical)]);
        }
    }

    var $column_order_sirkulasi = array(null, 'si.created_at', 'si.no_transaksi', null, null);
    var $column_search_sirkulasi = array('si.created_at', 'si.no_transaksi');
    var $order_sirkulasi = array('si.created_at' => 'DESC');

    private function _get_datatables_query_sirkulasi($periode = null, $id_parent = null)
    {
        $this->db->select('si.*');
        $this->db->from('sirkulasi as si');
        $this->db->where('si.status_sirkulasi', '1');
        if ($periode != null) {
            $this->db->like('si.created_at', "$periode");
        }
        if ($id_parent != null) {
            $this->db->like('si.is_id_parent', "$id_parent");
        }

        $i = 0;
        foreach ($this->column_search_sirkulasi as $item) {
            if (@$_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search_sirkulasi) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_sirkulasi[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order_sirkulasi = $this->order;
            $this->db->order_by(key($order_sirkulasi), $order_sirkulasi[key($order_sirkulasi)]);
        }
    }

    var $column_order_event_student = array('ed.created_at', 't.name_student', null);
    var $column_search_event_student = array('ed.created_at', 't.name_student');
    var $order_event_student = array('ed.id_transaksi' => 'asc');

    private function _get_datatables_query_event_student($id_parent = null)
    {
        $this->db->select('ed.*, t.name_student');
        $this->db->from('register_event as ed');
        $this->db->join('student as t', 'ed.id_user = t.id_student', 'left');
        $this->db->where('ed.status', '1');
        $this->db->where('ed.tipe_user', '1');
        $this->db->where('t.status', '1');
        $this->db->like('id_user', $id_parent);
        $i = 0;
        foreach ($this->column_search_event_student as $item) {
            if (@$_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search_event_student) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_event_student[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order_event_student = $this->order;
            $this->db->order_by(key($order_event_student), $order_event_student[key($order_event_student)]);
        }
    }

    function get_datatables($table, $id_student = null, $id_parent = null, $jenis = null, $periode = null)
    {
        if ($table == "student") {
            $this->_get_datatables_query_student();
        }
        if ($table == "list_package_offline") {
            $this->_get_datatables_query_list_package_offline($id_student);
        }
        if ($table == "list_package") {
            $this->_get_datatables_query_online_pratical($id_student, $jenis);
        }
        if ($table == "sirkulasi") {
            $this->_get_datatables_query_sirkulasi($periode, $id_parent);
        }
        if ($table == "register_event") {
            $this->_get_datatables_query_event_student($id_parent);
        }
        if (@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($table, $id_student = null, $id_parent = null, $jenis = null, $periode = null)
    {
        if ($table == "student") {
            $this->_get_datatables_query_student();
        }
        if ($table == "list_package_offline") {
            $this->_get_datatables_query_list_package_offline($id_student);
        }
        if ($table == "list_package") {
            $this->_get_datatables_query_online_pratical($id_student, $jenis);
        }
        if ($table == "sirkulasi") {
            $this->_get_datatables_query_sirkulasi($periode, $id_parent);
        }
        if ($table == "register_event") {
            $this->_get_datatables_query_event_student($id_parent);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all($table, $id_student = null, $id_parent = null, $jenis = null, $periode = null)
    {
        $this->db->from($table);
        if ($table == "student") {
            $this->db->where('status', '1');
            $this->db->where('id_parent', $this->session->userdata('id'));
        }
        if ($table == "list_package_offline") {
            $this->db->where('status', '1');
            $this->db->where('id_student', $id_student);
        }
        if ($table == "list_package") {
            $this->db->where('id_student', $id_student);
            $this->db->where('status', '1');
            if ($jenis === '1') {
                $this->db->where('status_pack_practical', '1');
            }
            if ($jenis === '2') {
                $this->db->where('status_pack_theory', '1');
            }
        }
        if ($table == "sirkulasi") {
            $this->db->where('status_sirkulasi', '1');
            if ($periode != null) {
                $this->db->like('created_at', "$periode");
            }
            if ($id_parent != null) {
                $this->db->like('is_id_parent', "$id_parent");
            }
        }
        if ($table == "register_event") {
            $this->db->where('status', '1');
            $this->db->like('id_user', $id_parent);
            $this->db->where('tipe_user', '1');
        }
        return $this->db->count_all_results();
    }

    public function getData_student($id_student = null, $id_parent = null)
    {
        $this->db->select('*');
        $this->db->from('student as t');
        $this->db->where('t.status', '1');
        if ($id_student != null) {
            $this->db->where('id_student', $id_student);
        }
        if ($id_parent != null) {
            $this->db->where('id_parent', $id_parent);
        }
        return $this->db->get()->result_array();
    }

    public function getData_schedule_package_offline($id_schedule_package_offline = null, $id_list_package_offline = null, $cek_status = null, $today = null, $jenis = null, $daysago = null)
    {
        $this->db->select('so.*, s.name_student, s.id_student, t.name_teacher, t.id_teacher,');
        $this->db->from('schedule_package_offline as so');
        $this->db->join('student as s', 'so.id_student = s.id_student', 'left');
        $this->db->join('teacher as t', 'so.id_teacher = t.id_teacher', 'left');
        $this->db->join('list_package_offline as op', 'so.id_list_package_offline = op.id_list_package_offline', 'left');
        // $this->db->where('so.status', '1');
        if ($id_schedule_package_offline != null) {
            $this->db->where('so.id_schedule_package_offline', $id_schedule_package_offline);
        }
        if ($id_list_package_offline != null) {
            $this->db->where('so.id_list_package_offline', $id_list_package_offline);
        }
        if ($today != null) {
            $this->db->where('so.date_schedule <', $today);
        }
        if ($daysago != null) {
            $this->db->where('so.date_schedule >', $daysago);
        }
        if ($cek_status != null) {
            $this->db->where('so.status', $cek_status);
        }
        return $this->db->get()->result_array();
    }

    function fetch_all_package_offline($id_list_package_offline, $id_student = NULL)
    {
        $this->db->select('sc.*, s.name_student');
        $this->db->from('schedule_package_offline as sc');
        $this->db->where('sc.id_list_package_offline', $id_list_package_offline);
        if ($id_student != null) {
            $this->db->where('sc.id_student', $id_student);
            $this->db->join('student as s', 'sc.id_student = s.id_student', 'left');
        }
        $this->db->order_by("id_schedule_package_offline", "ASC");
        return $this->db->get();
    }

    function fetch_all_package($id_list_pack, $id_student = NULL, $jenis = null)
    {
        $this->db->select('sc.*, s.name_student');
        $this->db->from('schedule_package as sc');
        $this->db->where('sc.id_list_pack', $id_list_pack);
        if ($id_student != null) {
            $this->db->where('sc.id_student', $id_student);
            $this->db->join('student as s', 'sc.id_student = s.id_student', 'left');
        }
        if ($jenis != null) {
            $this->db->where('sc.jenis', $jenis);
        }
        $this->db->order_by("id_schedule_pack", "ASC");
        return $this->db->get();
    }

    public function getData_sirkulasi($id_parent = null)
    {
        $this->db->select('s.*');
        $this->db->from('sirkulasi as s');
        $this->db->where('s.status_sirkulasi', '1');
        if ($id_parent != null) {
            $this->db->where('is_id_parent', $id_parent);
        }
        return $this->db->get()->result_array();
    }

    public function updateDataParent()
    {
        $id_parent = $this->input->post('id_parent');
        $data =  [
            'parent_student' => $this->input->post('parent_student'),
            'parent_student_2' => $this->input->post('parent_student_2'),
            'status_parent_1' => $this->input->post('status_parent_1'),
            'status_parent_2' => $this->input->post('status_parent_2'),
            'username_parent' => $this->input->post('username_parent'),
            'password_parent' => $this->input->post('password_parent'),
            'address_parent' => $this->input->post('address_parent'),
            'kelurahan_parent' => $this->input->post('kelurahan_parent'),
            'kecamatan_parent' => $this->input->post('kecamatan_parent'),
            'kota_parent' => $this->input->post('kota_parent'),
            'provinsi_parent' => $this->input->post('provinsi_parent'),
            'zip_parent' => $this->input->post('zip_parent'),
            'country_parent' => $this->input->post('country_parent'),
            'phone_parent_1' => $this->input->post('phone_parent_1'),
            'phone_parent_2' => $this->input->post('phone_parent_2'),
            'email_parent_1' => $this->input->post('email_parent_1'),
            'ig_parent_1' => $this->input->post('ig_parent_1'),
        ];

        $this->db->update('student', $data, ['id_parent' => $id_parent]);

        return true;
    }

    public function updateDataStudent()
    {
        $id_student = $this->input->post('id_student');
        $name_pict = explode(".", $this->input->post('pict_lama'));
        $temp_name = substr($name_pict[0], 0, -1);
        $counter = substr($name_pict[0], -1);
        $name_picture = $temp_name . "" . (intval($counter) + 1);

        $pict_student = "";
        $ubah = $_POST['ubah-pict'];
        if ($ubah == "ya") {
            $this->load->library('upload');
            $config['upload_path'] = './assets/img/pict_student';
            $config['allowed_types'] = 'jpg|JPG|jpeg|JPEG|png|PNG';
            $new_name = "pict_" . $this->input->post('name_student');
            $config['file_name'] = $name_picture;

            if ($_POST['pict_lama'] != "avatar.png") {
                $filename = './assets/img/pict_student/' . $_POST['pict_lama'];
                if (file_exists($filename)) {
                    unlink($filename);
                }
            }

            $this->upload->initialize($config);
            if (!$this->upload->do_upload('pict')) {
                $this->session->set_flashdata('warning', $this->upload->display_errors());
                redirect('portal/profile-parent/student/' . $id_student);
            } else {
                $upload_data_team = $this->upload->data(); // added this..
                $pict_student = $upload_data_team['file_name']; // changed this..
            }
        } else {
            $pict_student = $_POST['pict_lama'];
        }

        $data =  [
            'name_student' => $this->input->post('name_student'),
            'nickname_student' => $this->input->post('nickname_student'),
            'gender_student' => $this->input->post('gender_student'),
            'dob_student' => $this->input->post('tempat_dob') . ", " . $this->input->post('tanggal_dob'),
            'address_student' => $this->input->post('address_student'),
            'kelurahan' => $this->input->post('kelurahan'),
            'kecamatan' => $this->input->post('kecamatan'),
            'kota' => $this->input->post('kota'),
            'provinsi' => $this->input->post('provinsi'),
            'zip' => $this->input->post('zip'),
            'country' => $this->input->post('country'),
            'pict_student' => $pict_student,
        ];

        $this->db->update('student', $data, ['id_student' => $id_student]);

        return true;
    }
}
