<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Portal extends CI_Model
{
    public function insertData($tableName, $data)
    {
        $res = $this->db->insert($tableName, $data);
        return $res;
    }

    public function updateData($tableName, $data, $where)
    {
        $res = $this->db->update($tableName, $data, $where);
        return $res;
    }

    public function deleteData($tableName, $where)
    {
        $res = $this->db->delete($tableName, $where);
        return $res;
    }

    public function can_login($user, $username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        return $this->db->get($user);
    }

    public function get_teacher($where = "")
    {
        $data = $this->db->query('select * from teacher ' . $where);
        return $data->result_array();
    }

    public function getLastTeacher()
    {
        $this->db->from('teacher');
        $this->db->order_by('id_teacher', 'DESC');
        $this->db->limit(1);
        $data = $this->db->get();
        return $data->result_array();
    }

    public function get_student($where = "")
    {
        $data = $this->db->query('select * from student ' . $where);
        return $data->result_array();
    }

    public function get_offline_lesson($where = "")
    {
        $data = $this->db->query('select * from offline_lesson ' . $where);
        return $data->result_array();
    }

    public function get_online_pratical($where = "")
    {
        $data = $this->db->query('select * from online_pratical ' . $where);
        return $data->result_array();
    }

    public function get_online_theory($where = "")
    {
        $data = $this->db->query('select * from online_theory ' . $where);
        return $data->result_array();
    }

    public function get_note($where = "")
    {
        $data = $this->db->query('select * from note ' . $where);
        return $data->result_array();
    }
}
