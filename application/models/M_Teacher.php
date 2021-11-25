<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Teacher extends CI_Model
{
    var $column_order_offline_lesson = array(null, 's.name_student', null);
    var $column_search_offline_lesson = array('s.name_student');
    var $order_offline_lesson = array('ol.id_offline_lesson' => 'asc');

    private function _get_datatables_query_offline_lesson($id_teacher)
    {
        $this->db->select('ol.*, s.name_student, s.id_student');
        $this->db->from('offline_lesson as ol');
        $this->db->join('student as s', 'ol.id_student = s.id_student', 'left');
        $this->db->where('ol.status', '1');
        $this->db->where('ol.id_teacher', $id_teacher);

        $i = 0;
        foreach ($this->column_search_offline_lesson as $item) {
            if (@$_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search_offline_lesson) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_offline_lesson[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order_offline_lesson = $this->order;
            $this->db->order_by(key($order_offline_lesson), $order_offline_lesson[key($order_offline_lesson)]);
        }
    }

    var $column_order_online_pratical = array('s.name_student', null,  null);
    var $column_search_online_pratical = array('s.name_student');
    var $order_online_pratical = array('lp.id_list_pack' => 'asc');

    private function _get_datatables_query_online_pratical($id_teacher, $jenis)
    {
        $this->db->select('lp.*, s.name_student');
        $this->db->from('list_package as lp');
        $this->db->join('student as s', 'lp.id_student = s.id_student', 'left');
        if ($jenis === '1') {
            $this->db->where('lp.id_teacher_practical', $id_teacher);
        } else {
            $this->db->where('lp.id_teacher_theory', $id_teacher);
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

    var $column_order_online_theory = array(null, 's.name_student', null);
    var $column_search_online_theory = array('s.name_student');
    var $order_online_theory = array('ot.id_online_theory' => 'asc');

    private function _get_datatables_query_online_theory($id_teacher)
    {
        $this->db->select('ot.*, s.name_student, s.id_student');
        $this->db->from('online_theory as ot');
        $this->db->join('student as s', 'ot.id_student = s.id_student', 'left');
        $this->db->where('ot.status', '1');
        $this->db->where('ot.id_teacher', $id_teacher);
        $i = 0;
        foreach ($this->column_search_online_theory as $item) {
            if (@$_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search_online_theory) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_online_theory[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order_online_theory = $this->order;
            $this->db->order_by(key($order_online_theory), $order_online_theory[key($order_online_theory)]);
        }
    }

    var $column_order_note = array(null, 's.name_student', null);
    var $column_search_note = array('s.name_student');
    var $order_note = array('n.date' => 'asc');

    private function _get_datatables_query_note($id_teacher, $name_course, $id_course)
    {
        $this->db->select('n.*');
        $this->db->from('note as n');
        $this->db->where('n.id_teacher', $id_teacher);
        $this->db->where('n.name_course', $name_course);
        $this->db->where('n.id_course', $id_course);
        $i = 0;
        foreach ($this->column_search_note as $item) {
            if (@$_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search_note) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_note[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order_note = $this->order;
            $this->db->order_by(key($order_note), $order_note[key($order_note)]);
        }
    }

    var $column_order_event_teacher = array('ed.regist', 'e.event_name', 'e.event_date',  'ed.price', null);
    var $column_search_event_teacher = array('ed.regist', 'e.event_name', 'e.event_date',  'ed.price');
    var $order_event_teacher = array('ed.id_event_teacher' => 'asc');

    private function _get_datatables_query_event_teacher($id_teacher)
    {
        $this->db->select('ed.*,e.event_name,e.event_date');
        $this->db->from('event_teacher as ed');
        $this->db->join('event as e', 'ed.id_event = e.id_event', 'left');
        $this->db->where('ed.status', '1');
        $this->db->where('ed.id_teacher', $id_teacher);
        $i = 0;
        foreach ($this->column_search_event_teacher as $item) {
            if (@$_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search_event_teacher) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_event_teacher[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order_event_teacher = $this->order;
            $this->db->order_by(key($order_event_teacher), $order_event_teacher[key($order_event_teacher)]);
        }
    }

    var $column_order_event_teacher_new = array('ed.created_at', 't.name_teacher', null);
    var $column_search_event_teacher_new = array('ed.created_at', 't.name_teacher');
    var $order_event_teacher_new = array('ed.id_transaksi' => 'asc');

    private function _get_datatables_query_event_teacher_new($id_teacher)
    {
        $this->db->select('ed.*, t.name_teacher');
        $this->db->from('register_event as ed');
        // $this->db->join('event as e', 'ed.parent_event = e.parent_event', 'left');
        $this->db->join('teacher as t', 'ed.id_user = t.id_teacher', 'left');
        $this->db->where('ed.status', '1');
        $this->db->where('ed.tipe_user', '2');
        $this->db->where('t.status', '1');
        $this->db->where('ed.id_user', $id_teacher);
        $i = 0;
        foreach ($this->column_search_event_teacher_new as $item) {
            if (@$_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search_event_teacher_new) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_event_teacher_new[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order_event_teacher_new = $this->order;
            $this->db->order_by(key($order_event_teacher_new), $order_event_teacher_new[key($order_event_teacher_new)]);
        }
    }


    function get_datatables($table, $id_teacher, $id_course = null, $name_course = null, $jenis = null)
    {
        if ($table == "offline_lesson") {
            $this->_get_datatables_query_offline_lesson($id_teacher);
        }
        if ($table == "list_package") {
            $this->_get_datatables_query_online_pratical($id_teacher, $jenis);
        }
        if ($table == "online_theory") {
            $this->_get_datatables_query_online_theory($id_teacher, $jenis);
        }
        if ($table == "note") {
            $this->_get_datatables_query_note($id_teacher, $name_course, $id_course);
        }

        if ($table == "event_teacher") {
            $this->_get_datatables_query_event_teacher($id_teacher);
        }

        if ($table == "register_event") {
            $this->_get_datatables_query_event_teacher_new($id_teacher);
        }

        if (@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($table, $id_teacher, $id_course = null, $name_course = null, $jenis = null)
    {
        if ($table == "offline_lesson") {
            $this->_get_datatables_query_offline_lesson($id_teacher);
        }
        if ($table == "list_package") {
            $this->_get_datatables_query_online_pratical($id_teacher, $jenis);
        }
        if ($table == "online_theory") {
            $this->_get_datatables_query_online_theory($id_teacher, $jenis);
        }
        if ($table == "note") {
            $this->_get_datatables_query_note($id_teacher, $name_course, $id_course);
        }
        if ($table == "event_teacher") {
            $this->_get_datatables_query_event_teacher($id_teacher);
        }

        if ($table == "register_event") {
            $this->_get_datatables_query_event_teacher_new($id_teacher);
        }

        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all($table, $id_teacher, $id_course = null, $name_course = null, $jenis = null)
    {
        $this->db->from($table);
        if ($table == "list_package") {
            if ($jenis == '1') {
                $this->db->where('id_teacher_practical', $id_teacher);
            } else {
                $this->db->where('id_teacher_theory', $id_teacher);
            }
            $this->db->where('status', '1');
        } else {
            if ($table == "register_event") {
                $this->db->where('tipe_user', '2');
                $this->db->where('status', '1');
                $this->db->where('id_user', $id_teacher);
            }else{
                $this->db->where('id_teacher', $id_teacher);
            }
        }
        if ($name_course != null && $id_course != null) {
            $this->db->where('name_course', $name_course);
            $this->db->where('id_course', $id_course);
        }
        return $this->db->count_all_results();
    }

    public function getData_student($id_student = null)
    {
        $this->db->select('s.*');
        $this->db->from('student as s');
        $this->db->where('s.status', '1');
        if ($id_student != null) {
            $this->db->where('id_student', $id_student);
        }
        return $this->db->get()->result_array();
    }

    public function getData_teacher($id_teacher = null)
    {
        $this->db->select('t.*');
        $this->db->from('teacher as t');
        $this->db->where('t.status', '1');
        if ($id_teacher != null) {
            $this->db->where('id_teacher', $id_teacher);
        }
        return $this->db->get()->result_array();
    }

    public function getData_offline_lesson($id_offline_lesson = null)
    {
        $this->db->select('ol.*, s.name_student, s.id_student, t.name_teacher, t.id_teacher, p.name as name_paket');
        $this->db->from('offline_lesson as ol');
        $this->db->join('student as s', 'ol.id_student = s.id_student', 'left');
        $this->db->join('teacher as t', 'ol.id_teacher = t.id_teacher', 'left');
        $this->db->where('ol.status', '1');
        $this->db->join('paket as p', 'ol.id_paket = p.id', 'left');
        if ($id_offline_lesson != null) {
            $this->db->where('ol.id_offline_lesson', $id_offline_lesson);
        }
        return $this->db->get()->result_array();
    }

    public function getData_online_pratical($id_online_pratical = null)
    {
        $this->db->select('op.*, s.name_student, s.id_student, t.name_teacher, t.id_teacher,');
        $this->db->from('online_pratical as op');
        $this->db->join('student as s', 'op.id_student = s.id_student', 'left');
        $this->db->join('teacher as t', 'op.id_teacher = t.id_teacher', 'left');
        $this->db->where('op.status', '1');
        if ($id_online_pratical != null) {
            $this->db->where('id_online_pratical', $id_online_pratical);
        }
        return $this->db->get()->result_array();
    }

    public function getData_online_theory($id_online_theory = null)
    {
        $this->db->select('ot.*, s.name_student, s.id_student, t.name_teacher, t.id_teacher,');
        $this->db->from('online_theory as ot');
        $this->db->join('student as s', 'ot.id_student = s.id_student', 'left');
        $this->db->join('teacher as t', 'ot.id_teacher = t.id_teacher', 'left');
        $this->db->where('ot.status', '1');
        if ($id_online_theory != null) {
            $this->db->where('id_online_theory', $id_online_theory);
        }
        return $this->db->get()->result_array();
    }

    public function getData_note($id_note = null, $name_course = null, $id_course = null)
    {
        $this->db->select('n.*');
        $this->db->from('note as n');
        $this->db->join('student as s', 'n.id_student = s.id_student', 'left');
        if ($id_note != null) {
            $this->db->where('id_note', $id_note);
        }
        if ($name_course != null && $id_course != null) {
            $this->db->where('name_course', $name_course);
            $this->db->where('id_course', $id_course);
        }
        return $this->db->get()->result_array();
    }

    function fetch_summary_schedule($id_teacher)
    {
        $this->db->select('sc.*, s.name_student, s.id_student');
        $this->db->from('schedule as sc');
        $this->db->join('student as s', 'sc.id_student = s.id_student', 'left');
        $this->db->where('sc.id_teacher', $id_teacher);
        return $this->db->get();
    }

    function fetch_summary_offline_trial($id_teacher)
    {
        $this->db->select('sc.*');
        $this->db->from('offline_trial as sc');
        $this->db->where('sc.id_teacher', $id_teacher);
        return $this->db->get();
    }

    function fetch_summary_schedule_package($id_teacher, $jenis)
    {
        $this->db->select('sc.*, s.name_student, s.id_student');
        $this->db->from('schedule_package as sc');
        $this->db->join('student as s', 'sc.id_student = s.id_student', 'left');
        $this->db->where('sc.id_teacher', $id_teacher);
        $this->db->where('sc.jenis', $jenis);
        return $this->db->get();
    }

    function fetch_summary_schedule_theory($id_teacher)
    {
        $this->db->select('sc.*, s.name_student, s.id_student');
        $this->db->from('schedule_theory as sc');
        $this->db->join('student as s', 'sc.id_student = s.id_student', 'left');
        $this->db->where('sc.id_teacher', $id_teacher);
        return $this->db->get();
    }

    function fetch_all_schedule($id_teacher, $nama_course, $id_student)
    {
        $this->db->select('sc.*, s.name_student, s.id_student, co.*');
        $this->db->from('schedule as sc');
        if ($nama_course == "offline_lesson") {
            $this->db->join('offline_lesson as co', 'sc.id_course = co.id_offline_lesson', 'left');
        }
        if ($nama_course == "online_pratical") {
            $this->db->join('online_pratical as co', 'sc.id_course = co.id_online_pratical', 'left');
        }
        if ($nama_course == "online_theory") {
            $this->db->join('online_theory as co', 'sc.id_course = co.id_online_theory', 'left');
        }
        $this->db->join('student as s', 'sc.id_student = s.id_student', 'left');
        $this->db->where('sc.id_teacher', $id_teacher);
        $this->db->where('sc.id_student', $id_student);
        $this->db->where('sc.nama_course', $nama_course);
        return $this->db->get();
    }

    function insert_event_schedule($data)
    {
        $this->db->insert('schedule', $data);
    }

    function delete_event_schedule($id_schedule)
    {
        $this->db->where('id_schedule', $id_schedule);
        $this->db->delete('schedule');
    }

    function fetch_all_schedule_theory($id_schedule_theory = null, $id_course = null)
    {
        $this->db->select('sc.*, s.name_student, s.id_student, co.*');
        $this->db->from('schedule_theory as sc');
        $this->db->join('online_theory as co', 'sc.id_course = co.id_online_theory', 'left');
        $this->db->join('student as s', 'sc.id_student = s.id_student', 'left');
        if ($id_schedule_theory != null) {
            $this->db->where('sc.id_schedule_theory', $id_schedule_theory);
        }
        if ($id_course != null) {
            $this->db->where('sc.id_course', $id_course);
        }
        return $this->db->get();
    }

    function insert_event_schedule_theory($data)
    {
        $this->db->insert('schedule_theory', $data);
    }

    function delete_event_schedule_theory($id_schedule)
    {
        $this->db->where('id_schedule_theory', $id_schedule);
        $this->db->delete('schedule_theory');
    }


    function fetch_all_offline_trial($id_teacher)
    {
        $this->db->where('id_teacher', $id_teacher);
        return $this->db->get('offline_trial');
    }

    function insert_event_offline_trial($data)
    {
        $this->db->insert('offline_trial', $data);
    }

    function update_event_offline_trial($data, $id_offline_trial)
    {
        $this->db->where('id_offline_trial', $id_offline_trial);
        $this->db->update('offline_trial', $data);
    }

    function delete_event_offline_trial($id_offline_trial)
    {
        $this->db->where('id_offline_trial', $id_offline_trial);
        $this->db->delete('offline_trial');
    }

    public function insertDataNote()
    {
        $data =  [
            'id_student' => $this->input->post('id_student'),
            'id_teacher' => $this->input->post('id_teacher'),
            'id_course' => $this->input->post('id_course'),
            'name_course' => $this->input->post('name_course'),
            'keterangan' => $this->input->post('keterangan'),
        ];
        $this->db->insert('note', $data);
        return true;
    }

    public function updateDataNote()
    {
        $data =  [
            'keterangan' => $this->input->post('keterangan'),
        ];
        $this->db->where('id_note', $this->input->post('id_note'));
        $this->db->update('note', $data);
        return true;
    }

    public function deleteDataNote($id_note)
    {
        $this->db->where('id_note', $id_note);
        $this->db->delete('note');
    }

    public function getEventName($where = "")
    {
        $data = $this->db->query('select id_event from event_teacher ' . $where);
        return $data->result_array();
    }

    public function getData_event($id_event = null, $id_teacher = null, $today = null, $parent_event = null)
    {
        $this->db->select('*');
        $this->db->from('event');
        $this->db->where('status', '1');
        $this->db->where('member', '1');
        if ($id_event != null) {
            $this->db->where('id_event', $id_event);
        }
        if ($parent_event != null) {
            $this->db->where('parent_event', $parent_event);
        }
        if ($id_teacher != null) {
            $temp = $this->getEventName(" where id_teacher = '$id_teacher'");
            $test = [];
            if (count($temp) > 0) {
                for ($i = 0; $i < count($temp); $i++) {
                    $test[] = $temp[$i]['id_event'];
                }
                $this->db->where_not_in('id_event', $test);
            }
        }
        if ($today != null) {
            $startdate = strtotime("$today");
            $enddate = strtotime("+3 days", $startdate);
            $temp_date =  date("Y-m-d", $enddate);
            $this->db->where('event_date >=', $temp_date);
        }
        return $this->db->get()->result_array();
    }

    public function getData_event_teacher($id_event_teacher = null)
    {
        $this->db->select('*');
        $this->db->from('event_teacher');
        $this->db->where('status', '1');
        if ($id_event_teacher != null) {
            $this->db->where('id_event_teacher', $id_event_teacher);
        }
        return $this->db->get()->result_array();
    }

    public function getData_transaksi_event($no_transaksi_event = null)
    {
        $this->db->select('s.id_transaksi, s.no_transaksi_event, st.name_teacher, s.total_price, s.discount, s.price, s.parent_event');
        $this->db->from('register_event as s');
        $this->db->join('teacher as st', 's.id_user = st.id_teacher', 'left');
        if ($no_transaksi_event != null) {
            $this->db->like('no_transaksi_event', $no_transaksi_event);
        }
        return $this->db->get()->result_array();
    }

    public function getData_transaksi_event_detail($no_transaksi_event = null)
    {
        $this->db->select('s.*, p.event_name, st.name_teacher');
        $this->db->from('register_event_detail as s');
        $this->db->join('event as p', 's.id_event = p.id_event', 'left');
        $this->db->join('teacher as st', 's.id_user = st.id_teacher', 'left');
        if ($no_transaksi_event != null) {
            $this->db->like('no_transaksi_event', $no_transaksi_event);
        }
        return $this->db->get()->result_array();
    }

    public function insertDataEvent()
    {
        $id_user = $this->input->post('id_teacher');
        $tipe_user = '2';
        $created_at = date("Y-m-d");
        $created_by = $this->session->userdata('id');
        $price = $this->input->post('total_price');
        $discount = 0;
        $total_price = $this->input->post('total_price');

        //nomor transaksi event
        //EVN/210629/0041/001
        $startdate = strtotime($created_at);
        $temp_date_sirkulasi =  date("ymd", $startdate);

        $temp_id_teacher = substr($this->input->post('id_teacher'), 3);
        $no_transaksi_event = "EVN/" . $temp_date_sirkulasi . "/" . $temp_id_teacher;
        $data_transaksi_event = $this->getData_transaksi_event($no_transaksi_event);
        $z = 0;
        if (count($data_transaksi_event) == 0) {
            $z = "201";
        } else {
            if (count($data_transaksi_event) < 10) {
                $z = "20" . (count($data_transaksi_event) + 1);
            } else if (count($data_transaksi_event) < 100) {
                $z = "2" . (count($data_transaksi_event) + 1);
            } else {
                $z = (count($data_transaksi_event) + 1);
            }
        }

        $data =  [
            'no_transaksi_event' => $no_transaksi_event . "/" . $z,
            'id_user' => $id_user,
            'tipe_user' => $tipe_user,
            'created_at' => $created_at,
            'created_by' => $created_by,
            'price' => $price,
            'discount' => $discount,
            'total_price' => $total_price,
            'parent_event' => substr($this->input->post('id_event1'), 0, -1)
        ];
        $this->db->insert('register_event', $data);

        $counter = $this->input->post('total_event');
        for ($i = 1; $i <= $counter; $i++) {
            $event = "event" . $i;
            if ($this->input->post($event) == 1) {
                $id_event = "id_event" . $i;
                $price = "price" . $i;
                $date = "date" . $i;
                $data =  [
                    'no_transaksi_event' => $no_transaksi_event . "/" . $z,
                    'id_event' => $this->input->post($id_event),
                    'id_user' => $id_user,
                    'price' => $this->input->post($price),
                    'date' => $this->input->post($date)
                ];
                $this->db->insert('register_event_detail', $data);
            }
        }

        //nomor feereport 
        //FER/210629/004
        $tipe = 6;
        $startdate = strtotime($created_at);
        $temp_date_sirkulasi =  date("Ym", $startdate);
        $no_sirkulasi_feereport = "FER/" . $temp_date_sirkulasi . "/" . $temp_id_teacher;
        $data_sirkulasi_feereport = $this->M_Teacher->getData_sirkulasi_feereport(null, $no_sirkulasi_feereport);
        $data_sirkulasi_feereport_detail = $this->M_Teacher->getData_sirkulasi_feereport_detail(null, $no_sirkulasi_feereport, $tipe);
        $temp_counter = "FER/" . $temp_date_sirkulasi;
        $counter = $this->M_Teacher->getData_sirkulasi_feereport(null, $temp_counter);

        $data2 = [];
        $data3 = [];
        if ($data_sirkulasi_feereport[0]['status_approved'] == 0) {
            if (count($data_sirkulasi_feereport) == 0) {
                if (count($counter) == 0) {
                    $data2 =  [
                        'no_sirkulasi_feereport' => $no_sirkulasi_feereport . "/001",
                        'id_teacher' => $this->input->post('id_teacher'),
                        'created_at' => $created_at,
                        'updated_at' => $created_at,
                        'price' => $this->input->post('total_price'),
                    ];
                    $data3 = [
                        'no_sirkulasi_feereport' => $no_sirkulasi_feereport . "/001",
                        'id_teacher' => $this->input->post('id_teacher'),
                        'tipe' => $tipe,
                        'price' => $this->input->post('total_price'),
                        'id_barang' => $no_transaksi_event . "/" . $z,
                        
                    ];
                } else {
                    $x = 0;
                    if (count($counter) < 10) {
                        $x = "00" . count($counter);
                    } else if (count($counter) < 100) {
                        $x = "0" . count($counter);
                    } else {
                        $x = count($counter);
                    }
                    $data2 =  [
                        'no_sirkulasi_feereport' => $no_sirkulasi_feereport . "/" . $x,
                        'id_teacher' => $this->input->post('id_teacher'),
                        'created_at' => $created_at,
                        'updated_at' => $created_at,
                        'price' => $this->input->post('total_price'),
                    ];
                    $data3 = [
                        'no_sirkulasi_feereport' => $no_sirkulasi_feereport . "/" . $x,
                        'id_teacher' => $this->input->post('id_teacher'),
                        'tipe' => $tipe,
                        'price' => $this->input->post('total_price'),
                        'id_barang' => $no_transaksi_event . "/" . $z,
                    ];
                }
                $this->db->insert('sirkulasi_feereport', $data2);
                $this->db->insert('sirkulasi_feereport_detail', $data3);
                // echo "<br>";
                // echo var_dump($data2);
                // echo "<br>";
                // echo var_dump($data3);
            } else {
                $data2 =  [
                    'price' => intval($data_sirkulasi_feereport[0]['price']) + intval($this->input->post('total_price')),
                    'updated_at' => $created_at,
                ];
                $this->db->update('sirkulasi_feereport', $data2, ['id_sirkulasi_feereport' => $data_sirkulasi_feereport[0]['id_sirkulasi_feereport']]);

                if (count($data_sirkulasi_feereport_detail) == 0) {
                    $data3 = [
                        'no_sirkulasi_feereport' => $data_sirkulasi_feereport[0]['no_sirkulasi_feereport'],
                        'id_teacher' => $this->input->post('id_teacher'),
                        'tipe' => $tipe,
                        'price' => $this->input->post('total_price'),
                        'id_barang' => $no_transaksi_event . "/" . $z,
                    ];
                    $this->db->insert('sirkulasi_feereport_detail', $data3);
                } else {
                    $data3 = [
                        'price' => intval($data_sirkulasi_feereport_detail[0]['price']) + intval($this->input->post('total_price')),
                    ];
                    $this->db->update('sirkulasi_feereport_detail', $data3, ['id' => $data_sirkulasi_feereport_detail[0]['id']]);
                }
            }
        }

        // $counter = $this->input->post('total_event');
        // for ($i = 1; $i <= $counter; $i++) {
        //     $event = "event" . $i;
        //     if ($this->input->post($event) == 1) {
        //         $id_event = "id_event" . $i;
        //         $price = "price" . $i;
        //         $data =  [
        //             'id_event' => $this->input->post($id_event),
        //             'id_teacher' => $this->input->post('id_teacher'),
        //             'price' => $this->input->post($price),
        //             'total_rate' => $this->input->post($price),
        //             'regist' => $this->input->post('regist'),
        //         ];
        //         $this->db->insert('event_teacher', $data);
        //     }
        // }
        return true;
    }

    public function updateDataEvent()
    {
        $id_event_teacher = $this->input->post('id_event_teacher');
        $data =  [
            'id_event' => $this->input->post('id_event'),
            'id_teacher' => $this->input->post('id_teacher'),
            'price' => $this->input->post('price'),
            'regist' => $this->input->post('regist'),
        ];

        $this->db->update('event_teacher', $data, ['id_event_teacher' => $id_event_teacher]);
        return true;
    }

    public function deleteDataEvent($id_event_teacher)
    {
        $this->db->where('id_event_teacher', $id_event_teacher);
        $this->db->delete('event_teacher');
        return true;
    }

    // public function getData_pack_online($id_list_pack = null, $jenis = null)
    // {
    //     if ($jenis == 1 || $jenis == 2) {
    //         $this->db->select('op.*, s.name_student,  t.name_teacher, s.teacher_percentage');
    //     } else {
    //         $this->db->select('op.*, s.name_student,  t.name_teacher, t2.name_teacher as name_teacher2, s.teacher_percentage');
    //     }
    //     $this->db->from('list_package as op');
    //     $this->db->join('student as s', 'op.id_student = s.id_student', 'left');
    //     if ($jenis == 1) {
    //         $this->db->join('teacher as t', 'op.id_teacher_practical = t.id_teacher', 'left');
    //     } elseif ($jenis == 2) {
    //         $this->db->join('teacher as t', 'op.id_teacher_theory = t.id_teacher', 'left');
    //     } else {
    //         $this->db->join('teacher as t', 'op.id_teacher_practical = t.id_teacher', 'left');
    //         $this->db->join('teacher as t2', 'op.id_teacher_theory = t2.id_teacher', 'left');
    //     }
    //     $this->db->where('op.status', '1');
    //     if ($id_list_pack != null) {
    //         $this->db->where('id_list_pack', $id_list_pack);
    //     }
    //     return $this->db->get()->result_array();
    // }
    
    public function getData_pack_online($id_list_pack = null, $jenis = null)
    {
        if ($jenis == 1 || $jenis == 2) {
            $this->db->select('op.*, s.name_student,  t.name_teacher, s.teacher_percentage, p.name as name_paket, p.price_idr as price_idr_paket, p.price_euro, p.price_dollar');
        } else {
            $this->db->select('op.*, s.name_student,  t.name_teacher, t2.name_teacher as name_teacher2, s.teacher_percentage, p.name as name_paket, p.price_idr as price_idr_paket, p.price_euro, p.price_dollar');
        }
        $this->db->from('list_package as op');
        $this->db->join('paket as p', 'op.paket = p.id', 'left');
        $this->db->join('student as s', 'op.id_student = s.id_student', 'left');
        if ($jenis == 1) {
            $this->db->join('teacher as t', 'op.id_teacher_practical = t.id_teacher', 'left');
        } elseif ($jenis == 2) {
            $this->db->join('teacher as t', 'op.id_teacher_theory = t.id_teacher', 'left');
        } else {
            $this->db->join('teacher as t', 'op.id_teacher_practical = t.id_teacher', 'left');
            $this->db->join('teacher as t2', 'op.id_teacher_theory = t2.id_teacher', 'left');
        }
        $this->db->where('op.status', '1');
        if ($id_list_pack != null) {
            $this->db->where('id_list_pack', $id_list_pack);
        }
        return $this->db->get()->result_array();
    }

    public function getData_schedule_online($id_schedule_online = null, $id_pack = null, $cek_status = null, $today = null)
    {
        $this->db->select('so.*, s.name_student, s.id_student, t.name_teacher, t.id_teacher,');
        $this->db->from('schedule_online as so');
        $this->db->join('student as s', 'so.id_student = s.id_student', 'left');
        $this->db->join('teacher as t', 'so.id_teacher = t.id_teacher', 'left');
        $this->db->join('pack_online as op', 'so.id_pack = op.id_pack', 'left');
        // $this->db->where('so.status', '1');
        if ($id_schedule_online != null) {
            $this->db->where('so.id_schedule_online', $id_schedule_online);
        }
        if ($id_pack != null) {
            $this->db->where('so.id_pack', $id_pack);
        }
        if ($today != null) {
            $this->db->where('so.date <', $today);
        }
        if ($cek_status != null) {
            $this->db->where('so.status', $cek_status);
        }
        return $this->db->get()->result_array();
    }

    public function getData_schedule_package($id_schedule_pack = null, $id_list_pack = null, $cek_status = null, $today = null, $jenis = null, $daysago = null)
    {
        $this->db->select('so.*, s.name_student, s.id_student, t.name_teacher, t.id_teacher,');
        $this->db->from('schedule_package as so');
        $this->db->join('student as s', 'so.id_student = s.id_student', 'left');
        $this->db->join('teacher as t', 'so.id_teacher = t.id_teacher', 'left');
        $this->db->join('list_package as op', 'so.id_list_pack = op.id_list_pack', 'left');
        // $this->db->where('so.status', '1');
        if ($id_schedule_pack != null) {
            $this->db->where('so.id_schedule_pack', $id_schedule_pack);
        }
        if ($id_list_pack != null) {
            $this->db->where('so.id_list_pack', $id_list_pack);
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
        if ($jenis != null) {
            $this->db->where('so.jenis', $jenis);
        }
        return $this->db->get()->result_array();
    }

    function fetch_all_package($id_list_pack, $id_teacher = NULL)
    {
        $this->db->select('sc.*, s.name_student');
        $this->db->from('schedule_package as sc');
        $this->db->join('student as s', 'sc.id_student = s.id_student', 'left');
        $this->db->where('sc.id_list_pack', $id_list_pack);
        if ($id_teacher != null) {
            $this->db->where('sc.id_teacher', $id_teacher);
        }
        $this->db->order_by("id_schedule_pack", "ASC");
        return $this->db->get();
    }

    function insert_event_schedule_package($data)
    {
        $this->db->insert('schedule_package', $data);
    }

    function update_event_schedule_package($data, $id_schedule_pack)
    {
        $this->db->where('id_schedule_pack', $id_schedule_pack);
        $this->db->update('schedule_package', $data);
    }

    function delete_event_schedule_package($id_schedule_pack)
    {
        $this->db->where('id_schedule_pack', $id_schedule_pack);
        $this->db->delete('schedule_package');
    }

    public function getData_sirkulasi_lesson($id_sirkulasi_lesson = null, $no_sirkulasi_lesson = null, $id_teacher = null, $id_student = null, $tipe = null)
    {
        $this->db->select('sl.*');

        $this->db->from('sirkulasi_lesson as sl');
        
        if ($id_sirkulasi_lesson != null) {
            $this->db->where('id_sirkulasi_lesson', $id_sirkulasi_lesson);
        }

        if ($no_sirkulasi_lesson != null) {
            $this->db->where('no_sirkulasi_lesson', $no_sirkulasi_lesson);
        }

        if ($tipe != null) {
            $this->db->where('tipe', $tipe);
        }

        if ($id_student != null) {
            $this->db->join('student as s', 'sl.id_student = s.id_student', 'left');
            $this->db->where('s.id_student', $id_student);
            $this->db->where('s.status', '1');
        }

        if ($id_teacher != null) {
            $this->db->join('teacher as t', 'sl.id_teacher = t.id_teacher', 'left');
            $this->db->where('t.status', '1');
            $this->db->where('t.id_teacher', $id_teacher);
        }
        
        $this->db->where('sl.status', '1');
        $this->db->order_by('id_sirkulasi_lesson', 'DESC');
        return $this->db->get()->result_array();
    }

    public function getData_sirkulasi_lesson_detail($id_sirkulasi_lesson_detail = null, $no_sirkulasi_lesson = null, $id_teacher = null, $id_student = null, $tipe = null, $lesson_date = null)
    {
        $this->db->select('sl.*');

        $this->db->from('sirkulasi_lesson_detail as sl');
        if ($id_student != null) {
            $this->db->join('student as s', 'sl.id_student = s.id_student', 'left');
            $this->db->where('s.id_student', $id_student);
            $this->db->where('s.status', '1');
        }

        if ($id_teacher != null) {
            $this->db->join('teacher as t', 'sl.id_teacher = t.id_teacher', 'left');
            $this->db->where('t.status', '1');
            $this->db->where('t.id_teacher', $id_teacher);
        }

        if ($id_sirkulasi_lesson_detail != null) {
            $this->db->where('id_sirkulasi_lesson_detail', $id_sirkulasi_lesson_detail);
        }

        if ($no_sirkulasi_lesson != null) {
            $this->db->where('no_sirkulasi_lesson', $no_sirkulasi_lesson);
        }

        if ($tipe != null) {
            $this->db->where('tipe', $tipe);
        }

        if ($lesson_date != null) {
            $this->db->like('lesson_date', $lesson_date);
        }

        

        $this->db->order_by('id_sirkulasi_lesson_detail', 'DESC');
        return $this->db->get()->result_array();
    }

    public function addDataSirkulasiLesson($data)
    {
        $this->db->insert('sirkulasi_lesson', $data);
        return true;
    }

    public function addDataSirkulasiLessonDetail($data)
    {
        $this->db->insert('sirkulasi_lesson_detail', $data);
        return true;
    }

    public function updateDataSirkulasiLesson($data, $no_sirkulasi_lesson)
    {
        $this->db->where('no_sirkulasi_lesson', $no_sirkulasi_lesson);
        $this->db->update('sirkulasi_lesson', $data);
        return true;
    }

    function deleteDataSirkulasiLesson($id_sirkulasi_lesson)
    {
        $this->db->where('id_sirkulasi_lesson', $id_sirkulasi_lesson);
        $this->db->delete('sirkulasi_lesson');
    }

    function deleteDataSirkulasiLessonDetail($id_sirkulasi_lesson_detail)
    {
        $this->db->where('id_sirkulasi_lesson_detail', $id_sirkulasi_lesson_detail);
        $this->db->delete('sirkulasi_lesson_detail');
    }

    public function getData_sirkulasi_feereport($id_sirkulasi_feereport = null, $no_sirkulasi_feereport = null, $status_approved = null, $id_teacher = null)
    {
        $this->db->select('s.*');
        $this->db->from('sirkulasi_feereport as s');
        $this->db->where('s.status', '1');
        if ($id_sirkulasi_feereport != null) {
            $this->db->where('id_sirkulasi_feereport', $id_sirkulasi_feereport);
        }
        if ($no_sirkulasi_feereport != null) {
            $this->db->like('no_sirkulasi_feereport', $no_sirkulasi_feereport);
        }
        if ($status_approved != null) {
            $this->db->where('status_approved', $status_approved);
        }
        if ($id_teacher != null) {
            $this->db->where('id_teacher', $id_teacher);
        }
        return $this->db->get()->result_array();
    }

    public function getData_sirkulasi_feereport_detail($id = null, $no_sirkulasi_feereport = null, $tipe = null)
    {
        $this->db->select('s.*');
        $this->db->from('sirkulasi_feereport_detail as s');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        if ($no_sirkulasi_feereport != null) {
            $this->db->like('no_sirkulasi_feereport', $no_sirkulasi_feereport);
        }
        if ($tipe != null) {
            $this->db->like('tipe', $tipe);
        }
        return $this->db->get()->result_array();
    }
}
