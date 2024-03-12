<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Admin extends CI_Model
{

    var $column_order_parent = array(null, 'id_parent', 'parent_student', null);
    var $column_search_parent = array('id_parent', 'parent_student');
    var $order_parent = array('id_parent' => 'asc');

    private function _get_datatables_query_parent()
    {
        $this->db->distinct();
        $this->db->select('id_parent, parent_student');
        $this->db->from('student as s');
        $this->db->where('status', '1');
        $i = 0;
        foreach ($this->column_search_parent as $item) {
            if (@$_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search_parent) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_parent[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order_parent = $this->order;
            $this->db->order_by(key($order_parent), $order_parent[key($order_parent)]);
        }
    }

    var $column_order_student = array(null, 'id_student', 'name_student', 'instrument', null);
    var $column_search_student = array('id_student', 'name_student', 'instrument');
    var $order_student = array('id_student' => 'asc');

    private function _get_datatables_query_student()
    {
        $this->db->select('*');
        $this->db->from('student as s');
        $this->db->where('status', '1');
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

    var $column_order_teacher = array('t.id_teacher', 't.name_teacher', 't.instrument', 't.address_teacher', 't.phone_teacher', 't.email_teacher', 't.bank_teacher', 't.norek_teacher', null);
    var $column_search_teacher = array('t.id_teacher', 't.name_teacher', 't.instrument', 't.address_teacher', 't.phone_teacher', 't.email_teacher', 't.bank_teacher', 't.norek_teacher');
    var $order_teacher = array('t.id_teacher' => 'asc');

    private function _get_datatables_query_teacher()
    {
        $this->db->select('t.*');
        $this->db->from('teacher as t');
        $this->db->where('status', '1');
        $i = 0;
        foreach ($this->column_search_teacher as $item) {
            if (@$_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search_teacher) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_teacher[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order_teacher = $this->order;
            $this->db->order_by(key($order_teacher), $order_teacher[key($order_teacher)]);
        }
    }

    var $column_order_offline_lesson = array(null, 's.id_student', 's.name_student', 't.id_teacher', 't.name_teacher', 'ol.instrument', 'ol.duration', 'ol.rate', null);
    var $column_search_offline_lesson = array('s.id_student', 's.name_student', 't.id_teacher', 't.name_teacher', 'ol.instrument', 'ol.duration', 'ol.rate');
    var $order_offline_lesson = array('ol.id_offline_lesson' => 'asc');

    private function _get_datatables_query_offline_lesson()
    {
        $this->db->select('ol.*, s.name_student, s.id_student, t.name_teacher, t.id_teacher, p.name as name_paket');
        $this->db->from('offline_lesson as ol');
        $this->db->join('student as s', 'ol.id_student = s.id_student', 'left');
        $this->db->join('teacher as t', 'ol.id_teacher = t.id_teacher', 'left');
        $this->db->join('paket as p', 'ol.id_paket = p.id', 'left');
        $this->db->where('ol.status', '1');
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

    var $column_order_list_package_offline = array(null, 'op.id_student', 's.name_student', null, null, 'op.created_at', null);
    var $column_search_list_package_offline = array('op.id_student', 's.name_student', 'op.created_at');
    var $order_list_package_offline = array('op.id_list_package_offline' => 'asc');

    private function _get_datatables_query_list_package_offline()
    {
        $this->db->select('op.*, s.name_student, t.name_teacher, a.nama_admin, p.name as name_paket, p.type_of_class, p.status_pack_practical, p.status_pack_theory');
        $this->db->from('list_package_offline as op');
        $this->db->join('student as s', 'op.id_student = s.id_student', 'left');
        $this->db->join('teacher as t', 'op.id_teacher = t.id_teacher', 'left');
        $this->db->join('admin as a', 'op.created_by = a.id_admin', 'left');
        $this->db->join('paket as p', 'op.paket = p.id', 'left');
        $this->db->order_by('created_at', 'DESC');

        $this->db->where('op.status', '1');

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

    var $column_order_online_pratical = array(null, 'op.id_student', 's.name_student', 't.name_teacher', 't2.name_teacher', null, null, 'op.created_at', null);
    var $column_search_online_pratical = array('op.id_student', 's.name_student', 't.name_teacher', 't2.name_teacher', 'op.created_at');
    var $order_online_pratical = array('op.id_list_pack' => 'asc');

    private function _get_datatables_query_online_pratical($data_online_lesson = null)
    {
        $this->db->select('op.*, s.name_student, t.name_teacher, t2.name_teacher as nama_teacher2,a.nama_admin, p.name as name_paket, p.type_of_class, p.status_pack_practical, p.status_pack_theory');
        $this->db->from('list_package as op');
        $this->db->join('student as s', 'op.id_student = s.id_student', 'left');
        $this->db->join('teacher as t', 'op.id_teacher_practical = t.id_teacher', 'left');
        $this->db->join('teacher as t2', 'op.id_teacher_theory = t2.id_teacher', 'left');
        $this->db->join('admin as a', 'op.created_by = a.id_admin', 'left');
        $this->db->join('paket as p', 'op.paket = p.id', 'left');
        $this->db->order_by('created_at', 'DESC');

        $this->db->where('op.status', '1');
        if ($data_online_lesson != null) {
            if ($data_online_lesson == 'data_all') {
                $this->db->where('op.status_pack_practical', '1');
                $this->db->where('op.status_pack_theory', '1');
            }
            if ($data_online_lesson == 'data_practice') {
                $this->db->where('op.status_pack_practical', '1');
                $this->db->where('op.status_pack_theory', '0');
            }
            if ($data_online_lesson == 'data_theory') {
                $this->db->where('op.status_pack_practical', '0');
                $this->db->where('op.status_pack_theory', '1');
            }
        }


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

    var $column_order_online_theory = array(null, 's.id_student', 's.name_student', 't.id_teacher', 't.name_teacher', 'ot.instrument', 'ot.duration', 'ot.rate', null);
    var $column_search_online_theory = array('s.id_student', 's.name_student', 't.id_teacher', 't.name_teacher', 'ot.instrument', 'ot.duration', 'ot.rate');
    var $order_online_theory = array('ot.id_online_theory' => 'asc');

    private function _get_datatables_query_online_theory()
    {
        $this->db->select('ot.*, s.name_student, s.id_student, t.name_teacher, t.id_teacher,');
        $this->db->from('online_theory as ot');
        $this->db->join('student as s', 'ot.id_student = s.id_student', 'left');
        $this->db->join('teacher as t', 'ot.id_teacher = t.id_teacher', 'left');
        $this->db->where('ot.status', '1');
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

    var $column_order_book = array(null, 'b.title', 'b.publisher', 'b.distributor', 'b.distributor_price', 'b.qty', null);
    var $column_search_book = array('b.title', 'b.publisher', 'b.distributor', 'b.distributor_price', 'b.qty');
    var $order_book = array('b.id_book' => 'asc');

    private function _get_datatables_query_book()
    {
        $this->db->select('b.*');
        $this->db->from('book as b');
        $this->db->where('status', '1');
        $i = 0;
        foreach ($this->column_search_book as $item) {
            if (@$_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search_book) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_book[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order_book = $this->order;
            $this->db->order_by(key($order_book), $order_book[key($order_book)]);
        }
    }

    var $column_order_order_book = array(null, 's.student_name', 'b.title', 'qty_order_book', 'status_order_book');
    var $column_search_order_book = array('s.student_name', 'b.title', 'qty_order_book', 'status_order_book');
    var $order_order_book = array('b.id_order' => 'asc');

    private function _get_datatables_query_order_book()
    {
        $this->db->select('ob.*, s.name_student, b.*, ob.qty as qty_order_book, ob.status as status_order_book');
        $this->db->from('order_book as ob');
        $this->db->join('book as b', 'ob.id_book = b.id_book', 'left');
        $this->db->join('student as s', 'ob.id_student = s.id_student', 'left');
        $this->db->where('s.status', '1');
        $i = 0;
        foreach ($this->column_search_order_book as $item) {
            if (@$_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search_order_book) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_order_book[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order_order_book = $this->order;
            $this->db->order_by(key($order_order_book), $order_order_book[key($order_order_book)]);
        }
    }

    var $column_order_book_purchase = array(null, 'bp.date', 'bp.title', 'bp.publisher', 'bp.qty', 'bp.distributor', 'bp.distributor_price', 'bp.receive', 'bp.shipping_rate', null);
    var $column_search_book_purchase = array('bp.date', 'bp.title', 'bp.publisher', 'bp.qty', 'bp.distributor', 'bp.distributor_price', 'bp.receive', 'bp.shipping_rate');
    var $order_book_purchase = array('bp.date' => 'desc');

    private function _get_datatables_query_book_purchase()
    {
        $this->db->select('bp.*');
        $this->db->from('book_purchase as bp');
        $this->db->order_by('date', 'desc');
        $i = 0;
        foreach ($this->column_search_book_purchase as $item) {
            if (@$_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search_book_purchase) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_book_purchase[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order_book_purchase = $this->order;
            $this->db->order_by(key($order_book_purchase), $order_book_purchase[key($order_book_purchase)]);
        }
    }

    var $column_order_event = array('de.parent_event', null);
    var $column_search_event = array('de.parent_event');
    var $order_event = array('de.parent_event' => 'DESC');

    private function _get_datatables_query_event()
    {
        $this->db->select('de.*');
        $this->db->from('data_event as de');
        $this->db->where('de.status', '1');
        $this->db->order_by('de.parent_event', 'DESC');
        $i = 0;
        foreach ($this->column_search_event as $item) {
            if (@$_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search_event) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_event[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order_event = $this->order;
            $this->db->order_by(key($order_event), $order_event[key($order_event)]);
        }
    }

    var $column_order_event_teacher = array('ed.regist', 't.name_teacher', 'e.event_name', 'e.event_date',  'ed.price', null);
    var $column_search_event_teacher = array('ed.regist', 't.name_teacher', 'e.event_name', 'e.event_date',  'ed.price');
    var $order_event_teacher = array('ed.id_event_teacher' => 'asc');

    private function _get_datatables_query_event_teacher()
    {
        $this->db->select('ed.*,e.event_name,e.event_date, t.name_teacher');
        $this->db->from('event_teacher as ed');
        $this->db->join('event as e', 'ed.id_event = e.id_event', 'left');
        $this->db->join('teacher as t', 'ed.id_teacher = t.id_teacher', 'left');
        $this->db->where('ed.status', '1');
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

    private function _get_datatables_query_event_teacher_new()
    {
        $this->db->select('ed.*, t.name_teacher');
        $this->db->from('register_event as ed');
        // $this->db->join('event as e', 'ed.parent_event = e.parent_event', 'left');
        $this->db->join('teacher as t', 'ed.id_user = t.id_teacher', 'left');
        $this->db->where('ed.status', '1');
        $this->db->where('ed.tipe_user', '2');
        $this->db->where('t.status', '1');
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

    var $column_order_event_student = array('ed.created_at', 't.name_student', null);
    var $column_search_event_student = array('ed.created_at', 't.name_student');
    var $order_event_student = array('ed.id_transaksi' => 'asc');

    private function _get_datatables_query_event_student()
    {
        $this->db->select('ed.*, t.name_student');
        $this->db->from('register_event as ed');
        // $this->db->join('event as e', 'ed.parent_event = e.parent_event', 'left');
        $this->db->join('student as t', 'ed.id_user = t.id_student', 'left');
        $this->db->where('ed.status', '1');
        $this->db->where('ed.tipe_user', '1');
        $this->db->where('t.status', '1');
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

    var $column_order_paket = array(null, 'p.name', 'p.description', 'p.detail', null);
    var $column_search_paket = array('p.name', 'p.description', 'p.detail');
    var $order_paket = array('p.id' => 'asc');

    private function _get_datatables_query_paket()
    {
        $this->db->select('p.*');
        $this->db->from('paket as p');
        $this->db->where('p.status', '1');
        $i = 0;
        foreach ($this->column_search_paket as $item) {
            if (@$_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search_paket) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_paket[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order_paket = $this->order;
            $this->db->order_by(key($order_paket), $order_paket[key($order_paket)]);
        }
    }

    var $column_order_sirkulasi = array(null, 'si.created_at', 'si.no_transaksi', null, null);
    var $column_search_sirkulasi = array('si.created_at', 'si.no_transaksi');
    var $order_sirkulasi = array('si.no_transaksi' => 'DESC');

    private function _get_datatables_query_sirkulasi($periode = null)
    {
        $this->db->select('si.*');
        $this->db->from('sirkulasi as si');
        $this->db->where('si.status_sirkulasi', '1');
        if ($periode != null) {
            $this->db->like('si.created_at', "$periode");
        }
        // $this->db->order_by('si.created_at', 'DESC');
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

    function get_datatables($table, $data_online_lesson = null, $periode = null, $teacher = null)
    {
        if ($table == "parent") {
            $this->_get_datatables_query_parent();
        }
        if ($table == "student") {
            $this->_get_datatables_query_student();
        }
        if ($table == "teacher") {
            $this->_get_datatables_query_teacher();
        }
        if ($table == "offline_lesson") {
            $this->_get_datatables_query_offline_lesson();
        }
        if ($table == "list_package_offline") {
            $this->_get_datatables_query_list_package_offline();
        }
        if ($table == "list_package") {
            $this->_get_datatables_query_online_pratical($data_online_lesson);
        }
        if ($table == "online_theory") {
            $this->_get_datatables_query_online_theory();
        }
        if ($table == "book") {
            $this->_get_datatables_query_book();
        }
        if ($table == "order_book") {
            $this->_get_datatables_query_order_book();
        }
        if ($table == "book_purchase") {
            $this->_get_datatables_query_book_purchase();
        }
        if ($table == "data_event") {
            $this->_get_datatables_query_event();
        }
        if ($table == "event_teacher") {
            $this->_get_datatables_query_event_teacher();
        }

        if ($table == "register_event") {
            if ($teacher != null) {
                $this->_get_datatables_query_event_teacher_new();
            } else {
                $this->_get_datatables_query_event_student();
            }
        }
        if ($table == "paket") {
            $this->_get_datatables_query_paket();
        }
        if ($table == "sirkulasi") {
            $this->_get_datatables_query_sirkulasi($periode);
        }
        if (@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($table, $data_online_lesson = null, $periode = null, $teacher = null)
    {
        if ($table == "parent") {
            $this->_get_datatables_query_parent();
        }
        if ($table == "student") {
            $this->_get_datatables_query_student();
        }
        if ($table == "teacher") {
            $this->_get_datatables_query_teacher();
        }
        if ($table == "offline_lesson") {
            $this->_get_datatables_query_offline_lesson();
        }
        if ($table == "list_package_offline") {
            $this->_get_datatables_query_list_package_offline();
        }
        if ($table == "list_package") {
            $this->_get_datatables_query_online_pratical($data_online_lesson);
        }
        if ($table == "online_theory") {
            $this->_get_datatables_query_online_theory();
        }
        if ($table == "book") {
            $this->_get_datatables_query_book();
        }
        if ($table == "order_book") {
            $this->_get_datatables_query_order_book();
        }
        if ($table == "book_purchase") {
            $this->_get_datatables_query_book_purchase();
        }
        if ($table == "data_event") {
            $this->_get_datatables_query_event();
        }
        if ($table == "event_teacher") {
            $this->_get_datatables_query_event_teacher();
        }
        if ($table == "register_event") {
            if ($teacher != null) {
                $this->_get_datatables_query_event_teacher_new();
            } else {
                $this->_get_datatables_query_event_student();
            }
        }
        if ($table == "paket") {
            $this->_get_datatables_query_paket();
        }
        if ($table == "sirkulasi") {
            $this->_get_datatables_query_sirkulasi($periode);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all($table, $data_online_lesson = null, $periode = null, $teacher = null)
    {
        if ($table == 'parent') {
            $this->db->distinct();
            $this->db->select('id_parent, parent_student');
            $this->db->where('status', '1');
            $this->db->from('student');
        } else {
            $this->db->from($table);
        }
        if ($table == "list_package") {
            $this->db->where('status', '1');
            if ($data_online_lesson != null) {
                if ($data_online_lesson == 'data_all') {
                    $this->db->where('status_pack_practical', '1');
                    $this->db->where('status_pack_theory', '1');
                }
                if ($data_online_lesson == 'data_practice') {
                    $this->db->where('status_pack_practical', '1');
                    $this->db->where('status_pack_theory', '0');
                }
                if ($data_online_lesson == 'data_theory') {
                    $this->db->where('status_pack_practical', '0');
                    $this->db->where('status_pack_theory', '1');
                }
            }
        }
        if ($table == "student") {
            $this->db->where('status', '1');
        }
        if ($table == "offline_lesson") {
            $this->db->where('status', '1');
        }
        if ($table == "list_package_offline") {
            $this->db->where('status', '1');
        }
        if ($table == "online_theory") {
            $this->db->where('status', '1');
        }
        if ($table == "teacher") {
            $this->db->where('status', '1');
        }
        if ($table == "book") {
            $this->db->where('status', '1');
        }
        if ($table == "data_event") {
            $this->db->where('status', '1');
        }
        if ($table == "event_teacher") {
            $this->db->where('status', '1');
        }
        if ($table == "register_event") {
            $this->db->where('status', '1');
            if ($teacher != null) {
                $this->db->where('tipe_user', '2');
            } else {
                $this->db->where('tipe_user', '1');
            }
        }
        if ($table == "paket") {
            $this->db->where('status', '1');
        }
        if ($table == "sirkulasi") {
            $this->db->where('status_sirkulasi', '1');
            if ($periode != null) {
                $this->db->like('created_at', "$periode");
            }
        }
        return $this->db->count_all_results();
    }

    public function getLastStudent($id_parent = null)
    {
        $this->db->from('student');
        if ($id_parent != null) {
            $this->db->where('id_parent', $id_parent);
        }
        $this->db->order_by('id_student', 'DESC');
        $this->db->limit(1);
        $data = $this->db->get();
        return $data->result_array();
    }

    public function insertDataParent()
    {
        $user = $this->getLastStudent();
        if (count($user) < 1) {
            $id_parent  = "100001";
            $id_student = "1000011";
        } else {
            $id_parent  =  intval($user[0]['id_parent']) + 1;
            $id_student =  intval($user[0]['id_parent']) + 1 . "1";
        }

        $username_parent =  $this->input->post('username_parent');
        $password_parent =  $this->input->post('password_parent');

        $parent_student =  $this->input->post('parent_student');
        $phone_parent_1 = $this->input->post('phone_parent_1');
        $phone_parent_2 = $this->input->post('phone_parent_2');
        $email_parent_1 = $this->input->post('email_parent_1');
        $ig_parent_1 = $this->input->post('ig_parent_1');

        $address_parent = $this->input->post('address_parent');
        $kelurahan_parent = $this->input->post('kelurahan_parent');
        $kecamatan_parent = $this->input->post('kecamatan_parent');
        $kota_parent = $this->input->post('kota_parent');
        $provinsi_parent = $this->input->post('provinsi_parent');
        $zip_parent = $this->input->post('zip_parent');
        $country_parent = $this->input->post('country_parent');

        $data =  [
            'id_parent' => $id_parent,
            'id_student' => $id_student,
            'username_parent' => $username_parent,
            'password_parent' => $password_parent,
            'parent_student' => $parent_student,
            'address_parent' => $address_parent,
            'kelurahan_parent' => $kelurahan_parent,
            'kecamatan_parent' => $kecamatan_parent,
            'kota_parent' => $kota_parent,
            'provinsi_parent' => $provinsi_parent,
            'zip_parent' => $zip_parent,
            'country_parent' => $country_parent,

            'phone_parent_1' => $phone_parent_1,
            'phone_parent_2' => $phone_parent_2,
            'email_parent_1' => $email_parent_1,
            'ig_parent_1' => $ig_parent_1,
        ];
        $this->db->insert('student', $data);
    }

    public function insertDataStudent()
    {
        $total_student = $this->input->post('total_student');

        $temp = $this->input->post('id_parent');
        $temp_id_parent = substr($temp, 0, 6);
        $user = $this->getLastStudent($temp_id_parent);
        $id_parent  =  $user[0]['id_parent'];
        $id_student =  intval($user[0]['id_student']) + 1;

        $username_parent =  $user[0]['username_parent'];
        $password_parent =  $user[0]['password_parent'];

        $parent_student =  $user[0]['parent_student'];
        $parent_student_2 =  $user[0]['parent_student_2'];
        $phone_parent_1 = $user[0]['phone_parent_1'];
        $phone_parent_2 = $user[0]['phone_parent_2'];
        $email_parent_1 = $user[0]['email_parent_1'];
        $ig_parent_1 = $user[0]['ig_parent_1'];

        $address_parent = $user[0]['address_parent'];
        $kelurahan_parent = $user[0]['kelurahan_parent'];
        $kecamatan_parent = $user[0]['kecamatan_parent'];
        $kota_parent = $user[0]['kota_parent'];
        $provinsi_parent = $user[0]['provinsi_parent'];
        $zip_parent = $user[0]['zip_parent'];
        $country_parent = $user[0]['country_parent'];

        $status_parent_1 = $user[0]['status_parent_1'];
        $status_parent_2 = $user[0]['status_parent_2'];
        $email_parent_2 = "-";
        $ig_parent_2 = "-";

        if ($this->input->post('check_address') == 1) {
            $address_student = $user[0]['address_parent'];
            $kelurahan = $user[0]['kelurahan_parent'];
            $kecamatan = $user[0]['kecamatan_parent'];
            $kota = $user[0]['kota_parent'];
            $provinsi = $user[0]['provinsi_parent'];
            $zip = $user[0]['zip_parent'];
            $country = $user[0]['country_parent'];
        } else {
            $address_student = $this->input->post('address_student');
            $kelurahan = $this->input->post('kelurahan');
            $kecamatan = $this->input->post('kecamatan');
            $kota = $this->input->post('kota');
            $provinsi = $this->input->post('provinsi');
            $zip = $this->input->post('zip');
            $country = $this->input->post('country');
        }

        for ($i = 1; $i <= $total_student; $i++) {

            $id_parent_temp = $id_parent;
            $id_student_temp = $id_student;

            if ($i > 1) {
                $id_parent = $id_parent_temp;
                $id_student = intval($id_student_temp + 1);
            }

            $name_student = "name_student" . $i;
            $nickname_student = "nickname_student" . $i;
            $gender_student = "gender_student" . $i;
            $tempat_dob = "tempat_dob" . $i;
            $tanggal_dob = "tanggal_dob" . $i;
            $pict_student_ava = "pict_student" . $i;

            $this->load->library('upload');
            //upload Picture
            $pict_student = "";

            $config['upload_path'] = './assets/img/pict_student';
            $config['allowed_types'] = 'pdf|PDF|jpg|JPG|jpeg|JPEG|png|PNG';
            $new_name = "pict_" . $this->input->post($name_student);
            $config['file_name'] = $new_name;

            $this->upload->initialize($config);

            if (!$this->upload->do_upload($pict_student_ava)) {
                $this->session->set_flashdata('warning', $this->upload->display_errors());
                if ($this->input->post('from_form') == "add_student_parent") {
                    redirect('portal/profile-parent/' . $username_parent);
                }
                if ($this->input->post('from_form') == "register_signup") {
                    redirect('portal/user-register');
                }
                if ($this->input->post('from_form') == "add_parent_admin") {
                    redirect('portal/data_parent');
                }
                if ($this->input->post('from_form') == "add_student_admin") {
                    redirect('portal/data_student');
                }
            } else {
                $upload_data_team = $this->upload->data(); // added this..
                //get the uploaded file name
                $pict_student = $upload_data_team['file_name']; // changed this..
            }
            $data =  [
                'id_parent' => $id_parent,
                'id_student' => $id_student,
                'username_parent' => $username_parent,
                'password_parent' => $password_parent,
                'parent_student' => $parent_student,
                'name_student' => $this->input->post($name_student),
                'nickname_student' => $this->input->post($nickname_student),
                // 'dob_student' => $this->input->post($dob_student),
                'gender_student' => $this->input->post($gender_student),

                'pict_student' => $pict_student,
                'address_student' => $address_student,
                'kelurahan' => $kelurahan,
                'kecamatan' => $kecamatan,
                'kota' => $kota,
                'provinsi' => $provinsi,
                'zip' => $zip,
                'country' => $country,
                'address_parent' => $address_parent,
                'kelurahan_parent' => $kelurahan_parent,
                'kecamatan_parent' => $kecamatan_parent,
                'kota_parent' => $kota_parent,
                'provinsi_parent' => $provinsi_parent,
                'zip_parent' => $zip_parent,
                'country_parent' => $country_parent,

                'status_parent_1' => $status_parent_1,
                'status_parent_2' => $status_parent_2,
                'phone_parent_1' => $phone_parent_1,
                'phone_parent_2' => $phone_parent_2,
                'email_parent_1' => $email_parent_1,
                'email_parent_2' => $email_parent_2,
                'ig_parent_1' => $ig_parent_1,
                'ig_parent_2' => $ig_parent_2,
            ];
            $this->db->insert('student', $data);
        }
        return true;
    }

    public function insertDataStudent2()
    {
        $username_parent = "";
        $password_parent = "";

        $id_parent = "";
        $id_student = "";
        $parent_student = "";
        $kelurahan = "";
        $kecamatan = "";
        $kota = "";
        $provinsi = "";
        $zip = "";
        $country = "";
        $currency = "";
        $phone_parent_1 = "";
        $phone_parent_2 = "";
        $kat = "";

        $address_parent = "";
        $kelurahan_parent = "";
        $kecamatan_parent = "";
        $kota_parent = "";
        $provinsi_parent = "";
        $zip_parent = "";
        $country_parent = "";

        $status_parent_1 = "-";
        $status_parent_2 = "-";
        $phone_parent_1 = "-";
        $phone_parent_2 = "-";
        $email_parent_1 = "-";
        $email_parent_2 = "-";
        $ig_parent_1 = "-";
        $ig_parent_2 = "-";

        $total_student = $this->input->post('total_student');

        if ($this->input->post('id_parent') != "") {
            $user = $this->getLastStudent($this->input->post('id_parent'));
            $id_parent  =  $user[0]['id_parent'];
            $id_student =  intval($user[0]['id_student']) + 1;
            $username_parent  =  $user[0]['username_parent'];
            $password_parent  =  $user[0]['password_parent'];
            $parent_student  =  $user[0]['parent_student'];
            $parent_student_2  =  $user[0]['parent_student_2'];
            $status_parent_1 = $user[0]['status_parent_1'];
            $status_parent_2 = $user[0]['status_parent_2'];
            $phone_parent_1 = $user[0]['phone_parent_1'];
            $phone_parent_2 = $user[0]['phone_parent_2'];
            $email_parent_1 = $user[0]['email_parent_1'];
            $email_parent_2 = $user[0]['email_parent_2'];
            $ig_parent_1 = $user[0]['ig_parent_1'];
            $ig_parent_2 = $user[0]['ig_parent_2'];

            $address_parent = $user[0]['address_parent'];
            $kelurahan_parent = $user[0]['kelurahan_parent'];
            $kecamatan_parent = $user[0]['kecamatan_parent'];
            $kota_parent = $user[0]['kota_parent'];
            $provinsi_parent = $user[0]['provinsi_parent'];
            $zip_parent = $user[0]['zip_parent'];
            $country_parent = $user[0]['country_parent'];
        } else {
            $user = $this->getLastStudent();
            if (count($user) < 1) {
                $id_parent  = "100001";
                $id_student = "1000011";
            } else {
                $id_parent  =  intval($user[0]['id_parent']) + 1;
                $id_student =  intval($user[0]['id_parent']) + 1 . "1";
            }

            $username_parent =  $this->input->post('username_parent');
            $password_parent =  $this->input->post('password_parent');

            $parent_student =  $this->input->post('parent_student');
            $parent_student_2 =  $this->input->post('parent_student_2');
            $phone_parent_1 = $this->input->post('phone_parent_1');
            $phone_parent_2 = $this->input->post('phone_parent_2');
            $email_parent_1 = $this->input->post('email_parent_1');
            $ig_parent_1 = $this->input->post('ig_parent_1');
            $status_parent_1 =  $this->input->post('status_parent_1');
            $status_parent_2 =  $this->input->post('status_parent_2');

            $address_parent = $this->input->post('address_parent');
            $kelurahan_parent = $this->input->post('kelurahan_parent');
            $kecamatan_parent = $this->input->post('kecamatan_parent');
            $kota_parent = $this->input->post('kota_parent');
            $provinsi_parent = $this->input->post('provinsi_parent');
            $zip_parent = $this->input->post('zip_parent');
            $country_parent = $this->input->post('country_parent');
        }

        $instrument = '';
        for ($i = 1; $i <= $total_student; $i++) {

            $id_parent_temp = $id_parent;
            $id_student_temp = $id_student;

            if ($i > 1) {
                $id_parent = $id_parent_temp;
                $id_student = intval($id_student_temp + 1);
            }

            $name_student = "name_student" . $i;
            $nickname_student = "nickname_student" . $i;
            $gender_student = "gender_student" . $i;
            $tempat_dob = "tempat_dob" . $i;
            $tanggal_dob = "tanggal_dob" . $i;
            $pict_student_ava = "pict_student" . $i;
            $name_picture = strtolower($username_parent) . "_" . $i . "_1";

            $ubah_pict = "ubah-pict" . $i;
            $ubah = $this->input->post($ubah_pict);

            $pict_student = "";
            if ($ubah == "ya") {
                $this->load->library('upload');
                //upload Picture

                $config['upload_path'] = './assets/img/pict_student';
                $config['allowed_types'] = 'pdf|PDF|jpg|JPG|jpeg|JPEG|png|PNG';
                $new_name = "pict_" . $name_picture;
                $config['file_name'] = $new_name;

                $this->upload->initialize($config);


                if (!$this->upload->do_upload($pict_student_ava)) {
                    $this->session->set_flashdata('warning', $this->upload->display_errors());
                    if ($this->input->post('from_form') == "register_signup") {
                        redirect('portal/user-register');
                    }
                    if ($this->input->post('from_form') == "add_parent_admin") {
                        redirect('portal/data_parent');
                    }
                    if ($this->input->post('from_form') == "add_student_parent") {
                        redirect('portal/profile-parent' . $username_parent);
                    }
                } else {
                    $upload_data_team = $this->upload->data(); // added this..
                    $pict_student = $upload_data_team['file_name']; // changed this..
                }
            } else {
                $pict_student = 'avatar.png';
            }

            if ($this->input->post('check_address') == 1) {
                $address_student = $address_parent;
                $kelurahan = $kelurahan_parent;
                $kecamatan = $kecamatan_parent;
                $kota = $kota_parent;
                $provinsi = $provinsi_parent;
                $zip = $zip_parent;
                $country = $country_parent;
            } else {
                $address_student = $this->input->post('address_student');
                $kelurahan = $this->input->post('kelurahan');
                $kecamatan = $this->input->post('kecamatan');
                $kota = $this->input->post('kota');
                $provinsi = $this->input->post('provinsi');
                $zip = $this->input->post('zip');
                $country = $this->input->post('country');
            }

            $data =  [
                'id_parent' => $id_parent,
                'id_student' => $id_student,
                'username_parent' => $username_parent,
                'password_parent' => $password_parent,
                'parent_student' => $parent_student,
                'parent_student_2' => $parent_student_2,
                'name_student' => $this->input->post($name_student),
                'nickname_student' => $this->input->post($nickname_student),
                'dob_student' => $this->input->post($tempat_dob) . ", " . $this->input->post($tanggal_dob),
                'gender_student' => $this->input->post($gender_student),

                'pict_student' => $pict_student,
                'address_student' => $address_student,
                'kelurahan' => $kelurahan,
                'kecamatan' => $kecamatan,
                'kota' => $kota,
                'provinsi' => $provinsi,
                'zip' => $zip,
                'country' => $country,
                'address_parent' => $address_parent,
                'kelurahan_parent' => $kelurahan_parent,
                'kecamatan_parent' => $kecamatan_parent,
                'kota_parent' => $kota_parent,
                'provinsi_parent' => $provinsi_parent,
                'zip_parent' => $zip_parent,
                'country_parent' => $country_parent,

                'status_parent_1' => $status_parent_1,
                'status_parent_2' => $status_parent_2,
                'phone_parent_1' => $phone_parent_1,
                'phone_parent_2' => $phone_parent_2,
                'email_parent_1' => $email_parent_1,
                'email_parent_2' => $email_parent_2,
                'ig_parent_1' => $ig_parent_1,
                'ig_parent_2' => $ig_parent_2,
            ];
            $this->db->insert('student', $data);
        }
        if ($this->input->post('from_form') == "register_signup") {
            $session_data = array(
                'login_user' => true,
                'username' => $username_parent,
                'name'     => $parent_student,
                'id'     => $id_parent,
            );
            $this->session->set_userdata($session_data);
            $this->session->set_flashdata('success', 'Login Berhasi! hallo ' . $username_parent);
            redirect('portal', $session_data);
        }
        return true;
    }

    public function updateDataStudent2()
    {
        $id_student = $this->input->post('id_student');
        $id_parent = $this->input->post('id_parent');
        $instrument = $this->input->post('instrument');
        if ($instrument == "Others") {
            $instrument = "Others|" . $this->input->post('others');
        }
        $pict_student = "";
        $ubah = $_POST['ubah-pict'];
        if ($ubah == "ya") {
            $this->load->library('upload');
            $config['upload_path'] = './assets/img/pict_student';
            $config['allowed_types'] = 'pdf|PDF|jpg|JPG|jpeg|JPEG|png|PNG';
            $new_name = "pict_" . $this->input->post('name_student');
            $config['file_name'] = $new_name;

            if ($_POST['pict_lama'] != "avatar.png") {
                $filename = './assets/img/pict_student/' . $_POST['pict_lama'];
                if (file_exists($filename)) {
                    unlink($filename);
                }
            }

            $this->upload->initialize($config);
            if (!$this->upload->do_upload('pict')) {
                $this->session->set_flashdata('warning', $this->upload->display_errors());
                redirect('portal/data_student/detail/' . $this->input->post('id_student'));
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
            'dob_student' => $this->input->post('tempat_dob') . ", " . $this->input->post('tanggal_dob'),
            'school_student' => "-",
            'phone_student' => "-",
            'gender_student' => $this->input->post('gender_student'),
            'instrument' => $instrument,
            'email_student' => "-",
            'ig_student' => "-",
            'address_student' => $this->input->post('address_student'),
            'kelurahan' => $this->input->post('kelurahan'),
            'kecamatan' => $this->input->post('kecamatan'),
            'kota' => $this->input->post('kota'),
            'provinsi' => $this->input->post('provinsi'),
            'zip' => $this->input->post('zip'),
            'country' => $this->input->post('country'),
            'teacher_percentage' => $this->input->post('teacher_percentage'),
            'currency' => $this->input->post('currency'),
            'pict_student' => $pict_student,
            'link_repository' => $this->input->post('link_repository'),
        ];

        $this->db->update('student', $data, ['id_student' => $id_student]);

        $data2 = [
            'currency' => $this->input->post('currency'),
        ];
        $this->db->update('student', $data2, ['id_parent' => $id_parent]);

        $paketArr = $this->input->post('paket');
        $this->db->delete('student_package', ['id_student' => $id_student]);
        for ($i = 0; $i < count($paketArr); $i++) {
            $dataPaket = [
                'id_student' =>  $id_student,
                'id_paket' =>  $paketArr[$i],
            ];
            $this->db->insert('student_package', $dataPaket);
        }
        return true;
    }

    public function updateDataStudent()
    {
        $id_student = $this->input->post('id_student');
        $id_parent = $this->input->post('id_parent');
        $data =  [
            'name_student' => $this->input->post('name_student'),
            'parent_student' => $this->input->post('parent_student'),
            'instrument' => $this->input->post('instrument'),
            'dob_student' => $this->input->post('dob_student'),
        ];

        $this->db->update('student', $data, ['id_student' => $id_student]);

        $data2 = [

            'address_student' => $this->input->post('address_student'),
            'kelurahan' => $this->input->post('kelurahan'),
            'kecamatan' => $this->input->post('kecamatan'),
            'kota' => $this->input->post('kota'),
            'provinsi' => $this->input->post('provinsi'),
            'zip' => $this->input->post('zip'),
            'country' => $this->input->post('country'),
            'phone_student_1' => $this->input->post('phone_student_1'),
            'phone_student_2' => $this->input->post('phone_student_2'),
            'currency' => $this->input->post('currency'),
        ];
        $this->db->update('student', $data2, ['id_parent' => $id_parent]);

        return true;
    }

    public function deleteDataParent($id_parent)
    {
        $data =  [
            'status' => '2'
        ];

        $this->db->update('student', $data, ['id_parent' => $id_parent]);
        return true;
    }

    public function deleteDataStudent($id_student)
    {
        $data =  [
            'status' => '2'
        ];

        $this->db->update('student', $data, ['id_student' => $id_student]);
        return true;
    }

    public function deleteDataTeacher($id_teacher)
    {
        $data =  [
            'status' => '2'
        ];

        $this->db->update('teacher', $data, ['id_teacher' => $id_teacher]);
        return true;
    }

    public function insertDataPaket()
    {
        $type_of_class = 0;
        $data =  [
            'name' => $this->input->post('name'),
            'detail' => $this->input->post('detail'),
            // 'description' => $this->input->post('description'),
            'tipe' => $this->input->post('tipe'),
            'tipe_cat' => $this->input->post('tipe_cat'),
            'tipe_sub' => $this->input->post('tipe_sub'),
            'tipe_detail' => $this->input->post('tipe_detail'),
            'type_of_class' => $type_of_class,
            'duration' => $this->input->post('duration'),
            'status_pack_practical' => $this->input->post('status_pack_practical'),
            'status_pack_theory' => $this->input->post('status_pack_theory'),
            'price_idr' => $this->input->post('price_idr'),
            'price_euro' => $this->input->post('price_euro'),
            'price_dollar' => $this->input->post('price_dollar'),
        ];
        $this->db->insert('paket', $data);
        return true;
    }

    public function updateDataPaket()
    {
        $id = $this->input->post('id');
        $type_of_class = 0;

        $data =  [
            'name' => $this->input->post('name'),
            'detail' => $this->input->post('detail'),
            // 'description' => $this->input->post('description'),
            'tipe' => $this->input->post('tipe'),
            'tipe_cat' => $this->input->post('tipe_cat'),
            'tipe_sub' => $this->input->post('tipe_sub'),
            'tipe_detail' => $this->input->post('tipe_detail'),
            'type_of_class' => $type_of_class,
            'duration' => $this->input->post('duration'),
            'status_pack_practical' => $this->input->post('status_pack_practical'),
            'status_pack_theory' => $this->input->post('status_pack_theory'),
            'price_idr' => $this->input->post('price_idr'),
            'price_euro' => $this->input->post('price_euro'),
            'price_dollar' => $this->input->post('price_dollar'),
        ];

        $this->db->update('paket', $data, ['id' => $id]);
        return true;
    }

    public function deleteDataPaket($id)
    {
        $data =  [
            'status' => '2'
        ];

        $this->db->update('paket', $data, ['id' => $id]);
        return true;
    }

    public function deleteDataSirkulasi($id_sirkulasi)
    {
        $data =  [
            'status_sirkulasi' => '2'
        ];

        $this->db->update('sirkulasi', $data, ['id_sirkulasi' => $id_sirkulasi]);
        return true;
    }

    public function insertDataOfflineLesson()
    {
        $instrument = $this->input->post('instrument');
        $Others_temp1 = "Others1";
        $others1 = "others1";
        if ($instrument == $Others_temp1) {
            $instrument = "Others|" . $this->input->post($others1);
        }

        $rate = $this->input->post('rate');
        $Others_temp2 = "Others2";
        $others2 = "others2";
        if ($rate == $Others_temp2) {
            $rate = "Others|" . $this->input->post($others2);
        }
        $data =  [
            'id_student' => $this->input->post('id_student'),
            'id_teacher' => $this->input->post('id_teacher'),
            'instrument' => $instrument,
            'id_paket' => $this->input->post('id_paket'),
            'duration' => $this->input->post('duration'),
            'rate' => $rate,
        ];
        $this->db->insert('offline_lesson', $data);
        return true;
    }

    public function insertDataOfflineLesson2()
    {
        date_default_timezone_set("Asia/Jakarta");
        // $today = date("Y-m-d");
        $today = $this->input->post('created_at');
        $startdate = strtotime($today);
        $enddate = strtotime("+3 months", $startdate);
        $temp_date =  date("Y-m-d", $enddate);

        $id_teacher = $this->input->post('id_teacher');
        $total_package = $this->input->post('total_package');

        $instrument = $this->input->post('instrument');
        $Others_temp1 = "Others1";
        $others1 = "others1";
        if ($instrument == $Others_temp1) {
            $instrument = "Others|" . $this->input->post($others1);
        }

        //nomor transaksi package
        //POF/210629/0041/001
        $temp_date_sirkulasi =  date("ymd", $startdate);
        $temp_id_student = substr($this->input->post('id_student'), 3);
        $no_transaksi_package = "POF/" . $temp_date_sirkulasi . "/" . $temp_id_student;
        $data_transaksi_package = $this->getData_transaksi_package_offline($no_transaksi_package);
        $z = 0;
        if (count($data_transaksi_package) == 0) {
            $z = "001";
        } else {
            if (count($data_transaksi_package) < 10) {
                $z = "00" . (count($data_transaksi_package) + 1);
            } else if (count($data_transaksi_package) < 100) {
                $z = "0" . (count($data_transaksi_package) + 1);
            } else {
                $z = (count($data_transaksi_package) + 1);
            }
        }

        $price_paket = $this->input->post('rate_package') / $total_package;
        $discount_price_paket = $price_paket - ($price_paket * $this->input->post('discount') / 100);

        $data =  [
            'no_transaksi_package_offline' => $no_transaksi_package . "/" . $z,
            'id_student' => $this->input->post('id_student'),
            'id_teacher' => $id_teacher,
            'instrument' =>  $instrument,
            'paket' => $this->input->post('temp_paket'),
            'price_paket' => $discount_price_paket,
            'total_package' => $total_package,
            'rate_dollar' => $this->input->post('rate_dollar'),
            'rate' => $this->input->post('rate'),
            'discount' => $this->input->post('discount'),
            'rate_package' => $this->input->post('rate_package'),
            'total_discount_rate' => $this->input->post('total_discount_rate'),
            'created_at' => $today,
            'end_at' => $temp_date,
            'created_by' => $this->session->userdata('id'),
            'teacher_percentage' => $this->input->post('teacher_percentage'),
        ];

        // echo var_dump($data);
        // die();
        $this->db->insert('list_package_offline', $data);

        //nomor invoice
        //INV/210629/004/001
        $temp_id_parent = substr($this->input->post('id_student'), 3, -1);
        $no_transaksi = "INV001/" . $temp_date_sirkulasi . "/" . $temp_id_parent;
        $data_sirkulasi = $this->getData_sirkulasi(null, $no_transaksi, $today);

        //cek transaksi hari ini
        $counter = $this->getData_sirkulasi_new(null, null, substr($today, 0, 7));
        sort($counter);
        $data2 = [];
        $data3 = [];
        if (count($data_sirkulasi) == 0) {
            if (count($counter) == 0) {
                $data2 =  [
                    'no_transaksi' => $no_transaksi . "/001",
                    'is_id_parent' => substr($this->input->post('id_student'), 0, -1),
                    'created_at' => $today,
                    'created_by' => $this->session->userdata('id'),
                    'rate' => $this->input->post('rate'),
                    'total_rate' => $this->input->post('rate')
                ];
                $data3 = [
                    'no_transaksi' => $no_transaksi . "/001",
                    'is_id_parent' => substr($this->input->post('id_student'), 0, -1),
                    'id_barang' => $no_transaksi_package . "/" . $z,
                    'tipe_barang' => '5',
                    'price' => $this->input->post('rate'),
                ];
            } else {
                $temp_last3digits = substr($counter[count($counter) - 1]['no_transaksi'], -3);
                $temp_number = 1;
                if (substr($temp_last3digits, 0, 1) == 0) {
                    if (substr($temp_last3digits, 1, 1) == 0) {
                        $temp_number = substr($temp_last3digits, 2, 1);
                    } else {
                        $temp_number = substr($temp_last3digits, 1, 2);
                    }
                } else {
                    $temp_number = $temp_last3digits;
                }
                $x = 0;
                $temp_count = 1 + $temp_number;
                if ($temp_count < 10) {
                    $x = "00" . $temp_count;
                } else if ($temp_count < 100) {
                    $x = "0" . $temp_count;
                } else {
                    $x = $temp_count;
                }
                $data2 =  [
                    'no_transaksi' => $no_transaksi . "/" . $x,
                    'is_id_parent' => substr($this->input->post('id_student'), 0, -1),
                    'created_at' => $today,
                    'created_by' => $this->session->userdata('id'),
                    'rate' => $this->input->post('rate'),
                    'total_rate' => $this->input->post('rate')
                ];
                $data3 = [
                    'no_transaksi' => $no_transaksi . "/" . $x,
                    'is_id_parent' => substr($this->input->post('id_student'), 0, -1),
                    'id_barang' => $no_transaksi_package . "/" . $z,
                    'tipe_barang' => '5',
                    'price' => $this->input->post('rate'),
                ];
            }
            $this->db->insert('sirkulasi', $data2);
            $this->db->insert('sirkulasi_transaksi', $data3);
        } else {
            $data2 =  [
                'rate' => intval($data_sirkulasi[0]['rate']) + intval($this->input->post('rate')),
                'total_rate' => intval($data_sirkulasi[0]['rate']) + intval($this->input->post('rate'))
            ];
            $this->db->update('sirkulasi', $data2, ['id_sirkulasi' => $data_sirkulasi[0]['id_sirkulasi']]);
            $data3 = [
                'no_transaksi' => $data_sirkulasi[0]['no_transaksi'],
                'is_id_parent' => $data_sirkulasi[0]['is_id_parent'],
                'id_barang' => $no_transaksi_package . "/" . $z,
                'tipe_barang' => '5',
                'price' => $this->input->post('rate'),
            ];
            $this->db->insert('sirkulasi_transaksi', $data3);
        }

        return true;
    }

    public function updateDataOfflineLesson()
    {

        $id_offline_lesson = $this->input->post('id_offline_lesson');
        $instrument = $this->input->post('instrument');
        $Others_temp1 = "Others";
        $others1 = "others1";
        if ($instrument == $Others_temp1) {
            $instrument = "Others|" . $this->input->post($others1);
        }

        $rate = $this->input->post('rate');
        $Others_temp2 = "Others";
        $others2 = "others2";
        if ($rate == $Others_temp2) {
            $rate = "Others|" . $this->input->post($others2);
        }
        $data =  [
            'id_student' => $this->input->post('id_student'),
            'id_teacher' => $this->input->post('id_teacher'),
            'instrument' => $instrument,
            'id_paket' => $this->input->post('id_paket'),
            'duration' => $this->input->post('duration'),
            'rate' => $rate,
        ];

        $this->db->update('offline_lesson', $data, ['id_offline_lesson' => $id_offline_lesson]);
        return true;
    }

    public function deleteDataOfflineLesson($id_offline_lesson)
    {
        $data =  [
            'status' => '2'
        ];

        $this->db->update('offline_lesson', $data, ['id_offline_lesson' => $id_offline_lesson]);
        return true;
    }

    public function insertDataOnlinePratical()
    {
        $data =  [
            'id_student' => $this->input->post('id_student'),
            'id_teacher' => $this->input->post('id_teacher'),
            'instrument' => $this->input->post('instrument'),
            'duration' => $this->input->post('duration'),
            'total_lesson' => $this->input->post('total_lesson'),
            'rate' => $this->input->post('rate'),
        ];
        $this->db->insert('online_pratical', $data);
        return true;
    }

    public function getData_pack_online($id_pack = null, $id_parent = null, $periode = null)
    {
        $this->db->select('op.*, s.name_student, s.id_student, s.id_parent, s.parent_student, t.name_teacher, t.id_teacher');
        $this->db->from('pack_online as op');
        $this->db->join('student as s', 'op.id_student = s.id_student', 'left');
        $this->db->join('teacher as t', 'op.id_teacher = t.id_teacher', 'left');
        $this->db->where('op.status', '1');
        $this->db->where('s.status', '1');
        if ($id_pack != null) {
            $this->db->where('id_pack', $id_pack);
        }
        if ($id_parent != null) {
            $this->db->where('s.id_parent', $id_parent);
        }
        if ($periode != null) {
            $temp_period = $periode . "-05";
            $this->db->where('op.date_order <=', "$temp_period");

            $startdate = strtotime("$periode");
            $enddate = strtotime("-1 months", $startdate);

            $temp_date =  date("Y-m-05", $enddate);
            $this->db->where('op.date_order >', "$temp_date");
        }
        return $this->db->get()->result_array();
    }

    public function getData_list_pack($id_list_pack = null, $id_parent = null, $periode = null, $periode_end = null, $status_pack_practical = null, $status_pack_theory = null)
    {
        $this->db->select('op.*, s.name_student, s.id_parent, s.parent_student, t.name_teacher, t2.name_teacher as name_teacher2, p.price_idr, p.price_dollar, p.price_euro, p.name, s.teacher_percentage, s.is_new');
        $this->db->from('list_package as op');
        $this->db->join('paket as p', 'op.paket = p.id', 'left');
        $this->db->join('student as s', 'op.id_student = s.id_student', 'left');
        $this->db->join('teacher as t', 'op.id_teacher_practical = t.id_teacher', 'left');
        $this->db->join('teacher as t2', 'op.id_teacher_theory = t2.id_teacher', 'left');
        $this->db->where('op.status', '1');
        $this->db->where('s.status', '1');
        if ($id_list_pack != null) {
            $this->db->where('id_list_pack', $id_list_pack);
        }
        if ($status_pack_practical != null) {
            $this->db->where('op.status_pack_practical', $status_pack_practical);
        }
        if ($status_pack_theory != null) {
            $this->db->where('op.status_pack_theory', $status_pack_theory);
        }
        if ($id_parent != null) {
            $this->db->where('s.id_parent', $id_parent);
        }
        if ($periode != null) {
            $temp_period = $periode . "-05";
            $this->db->where('op.created_at <=', "$temp_period");

            $startdate = strtotime("$periode");
            $enddate = strtotime("-1 months", $startdate);

            $temp_date =  date("Y-m-05", $enddate);
            $this->db->where('op.created_at >', "$temp_date");
        }
        if ($periode_end != null) {
            $temp_period = $periode_end . "-05";
            $this->db->where('op.end_at <=', "$temp_period");

            $startdate = strtotime("$periode_end");
            $enddate = strtotime("-1 months", $startdate);

            $temp_date =  date("Y-m-05", $enddate);
            $this->db->where('op.end_at >', "$temp_date");
        }
        return $this->db->get()->result_array();
    }

    public function getData_list_package_offline($id_list_package_offline = null, $id_parent = null, $periode = null, $periode_end = null)
    {
        $this->db->select('op.*, s.name_student, s.id_parent, s.parent_student, t.name_teacher, p.name as name_paket, p.price_idr as price_idr_paket, p.price_dollar, p.price_euro, p.name, s.teacher_percentage, s.is_new');
        $this->db->from('list_package_offline as op');
        $this->db->join('paket as p', 'op.paket = p.id', 'left');
        $this->db->join('student as s', 'op.id_student = s.id_student', 'left');
        $this->db->join('teacher as t', 'op.id_teacher = t.id_teacher', 'left');
        $this->db->where('op.status', '1');
        $this->db->where('s.status', '1');
        if ($id_list_package_offline != null) {
            $this->db->where('id_list_package_offline', $id_list_package_offline);
        }
        if ($id_parent != null) {
            $this->db->where('s.id_parent', $id_parent);
        }
        if ($periode != null) {
            $temp_period = $periode . "-05";
            $this->db->where('op.created_at <=', "$temp_period");

            $startdate = strtotime("$periode");
            $enddate = strtotime("-1 months", $startdate);

            $temp_date =  date("Y-m-05", $enddate);
            $this->db->where('op.created_at >', "$temp_date");
        }
        if ($periode_end != null) {
            $temp_period = $periode_end . "-05";
            $this->db->where('op.end_at <=', "$temp_period");

            $startdate = strtotime("$periode_end");
            $enddate = strtotime("-1 months", $startdate);

            $temp_date =  date("Y-m-05", $enddate);
            $this->db->where('op.end_at >', "$temp_date");
        }
        return $this->db->get()->result_array();
    }

    public function getData_schedule_package_offline($id_schedule_package_offline = null, $id_list_package_offline = null, $not_in = null, $id_student = null, $status = null, $periode = null, $id_teacher = null)
    {
        $this->db->select('so.*, s.name_student, s.id_parent, s.parent_student, t.name_teacher,');
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
        if ($not_in != null) {
            $this->db->where('so.status !=', $not_in);
        }
        if ($status != null) {
            $this->db->where('so.status', $status);
        }
        if ($id_student != null) {
            $this->db->where('so.id_student', $id_student);
        }
        if ($id_teacher != null) {
            $this->db->where('so.id_teacher', $id_teacher);
        }
        if ($periode != null) {
            $temp_period = $periode . "-05";
            $this->db->where('so.date_schedule <=', "$temp_period");

            $startdate = strtotime("$periode");
            $enddate = strtotime("-1 months", $startdate);

            $temp_date =  date("Y-m-05", $enddate);
            $this->db->where('so.date_schedule >', "$temp_date");
        }
        return $this->db->get()->result_array();
    }

    public function getData_schedule_package($id_schedule_package = null, $id_list_pack = null, $not_in = null, $id_student = null, $status = null, $periode = null, $id_teacher = null)
    {
        $this->db->select('so.*, s.name_student, s.id_parent, s.parent_student, t.name_teacher,');
        $this->db->from('schedule_package as so');
        $this->db->join('student as s', 'so.id_student = s.id_student', 'left');
        $this->db->join('teacher as t', 'so.id_teacher = t.id_teacher', 'left');
        $this->db->join('list_package as op', 'so.id_list_pack = op.id_list_pack', 'left');
        // $this->db->where('so.status', '1');
        if ($id_schedule_package != null) {
            $this->db->where('so.id_schedule_package', $id_schedule_package);
        }
        if ($id_list_pack != null) {
            $this->db->where('so.id_list_pack', $id_list_pack);
        }
        if ($not_in != null) {
            $this->db->where('so.status !=', $not_in);
        }
        if ($status != null) {
            $this->db->where('so.status', $status);
        }
        if ($id_student != null) {
            $this->db->where('so.id_student', $id_student);
        }
        if ($id_teacher != null) {
            $this->db->where('so.id_teacher', $id_teacher);
        }
        if ($periode != null) {
            $temp_period = $periode . "-05";
            $this->db->where('so.date_schedule <=', "$temp_period");

            $startdate = strtotime("$periode");
            $enddate = strtotime("-1 months", $startdate);

            $temp_date =  date("Y-m-05", $enddate);
            $this->db->where('so.date_schedule >', "$temp_date");
        }
        return $this->db->get()->result_array();
    }

    public function getData_schedule_package_invoice($id_schedule_package = null, $id_list_pack = null, $not_in = null, $id_student = null, $status = null, $periode = null, $id_teacher = null, $jenis = null)
    {
        $this->db->select('so.*, s.name_student, s.id_parent, s.parent_student, t.name_teacher,');
        $this->db->from('schedule_package as so');
        $this->db->join('student as s', 'so.id_student = s.id_student', 'left');
        $this->db->join('teacher as t', 'so.id_teacher = t.id_teacher', 'left');
        $this->db->join('list_package as op', 'so.id_list_pack = op.id_list_pack', 'left');
        // $this->db->where('so.status', '1');
        if ($id_schedule_package != null) {
            $this->db->where('so.id_schedule_package', $id_schedule_package);
        }
        if ($id_list_pack != null) {
            $this->db->where('so.id_list_pack', $id_list_pack);
        }
        if ($not_in != null) {
            $this->db->where('so.status !=', $not_in);
        }
        if ($status != null) {
            $this->db->where('so.status', $status);
        }
        if ($jenis != null) {
            $this->db->where('so.jenis', $jenis);
        }
        if ($id_student != null) {
            $this->db->where('so.id_student', $id_student);
        }
        if ($id_teacher != null) {
            $this->db->where('so.id_teacher', $id_teacher);
        }
        if ($periode != null) {
            $temp_period = $periode . "-05";
            $this->db->where('so.date_schedule <=', "$temp_period");

            $startdate = strtotime("$periode");
            $enddate = strtotime("-1 months", $startdate);

            $temp_date =  date("Y-m-05", $enddate);
            $this->db->where('so.date_schedule >', "$temp_date");
        }
        $this->db->order_by('so.date_schedule', 'ASC');
        return $this->db->get()->result_array();
    }

    public function getData_schedule_online($id_schedule_online = null, $id_pack = null, $not_in = null, $id_student = null)
    {
        $this->db->select('so.*, s.name_student, s.id_student, s.parent_student, t.name_teacher, t.id_teacher,');
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
        if ($not_in != null) {
            $this->db->where('so.status !=', $not_in);
        }
        if ($id_student != null) {
            $this->db->where('so.id_student', $id_student);
        }
        return $this->db->get()->result_array();
    }

    public function insertDataPackage()
    {
        date_default_timezone_set("Asia/Jakarta");
        // $today = date("Y-m-d");
        $today = $this->input->post('created_at');
        $startdate = strtotime($today);
        $enddate = strtotime("+3 months", $startdate);
        $temp_date =  date("Y-m-d", $enddate);

        $id_teacher_practical = NULL;
        $id_teacher_theory = NULL;
        $total_pack_practical = 0;
        $total_pack_theory = 0;
        $total_package = 0;

        //Practical
        $status_pack_practical = $this->input->post('status_pack_practical');
        if ($status_pack_practical == '1') {
            $id_teacher_practical = $this->input->post('id_teacher_practical');
            $total_pack_practical = $this->input->post('pack_pratical');
            $total_package = $this->input->post('total_package');
        }
        //Theory
        $status_pack_theory = $this->input->post('status_pack_theory');
        if ($status_pack_theory == '1') {
            if ($status_pack_practical == '0') {
                $total_package = $this->input->post('total_pack_theory');
            }
            $id_teacher_theory = $this->input->post('id_teacher_theory');
            $total_pack_theory = $this->input->post('total_pack_theory');
        }

        $instrument = $this->input->post('instrument');
        $Others_temp1 = "Others1";
        $others1 = "others1";
        if ($instrument == $Others_temp1) {
            $instrument = "Others|" . $this->input->post($others1);
        }

        //nomor transaksi package
        //PAC/210629/0041/001
        $temp_date_sirkulasi =  date("ymd", $startdate);
        $temp_id_student = substr($this->input->post('id_student'), 3);
        $no_transaksi_package = "PAC/" . $temp_date_sirkulasi . "/" . $temp_id_student;
        $data_transaksi_package = $this->getData_transaksi_package($no_transaksi_package);
        $z = 0;
        if (count($data_transaksi_package) == 0) {
            $z = "001";
        } else {
            if (count($data_transaksi_package) < 10) {
                $z = "00" . (count($data_transaksi_package) + 1);
            } else if (count($data_transaksi_package) < 100) {
                $z = "0" . (count($data_transaksi_package) + 1);
            } else {
                $z = (count($data_transaksi_package) + 1);
            }
        }

        $price_paket = $this->input->post('rate_package') / $total_package;
        $price_paket_theory = 0;
        $price_paket_pratical = 0;
        if ($status_pack_practical == '1') {
            if ($status_pack_theory == '1') {
                $price_paket = $price_paket - 100000;
                $price_paket_theory = 100000 - (100000 * $this->input->post('discount') / 100);
            }
            $price_paket_pratical = $price_paket - ($price_paket * $this->input->post('discount') / 100);
        } else {
            if ($status_pack_theory == '1') {
                $price_paket_theory = $price_paket - ($price_paket * $this->input->post('discount') / 100);
            }
        }

        $data =  [
            'no_transaksi_package' => $no_transaksi_package . "/" . $z,
            'id_student' => $this->input->post('id_student'),
            'id_teacher_practical' => $id_teacher_practical,
            'status_pack_practical' => $status_pack_practical,
            'id_teacher_theory' => $id_teacher_theory,
            'status_pack_theory' => $status_pack_theory,
            'instrument' =>  $instrument,
            'paket' => $this->input->post('temp_paket'),
            'price_paket_pratical' => $price_paket_pratical,
            'price_paket_theory' => $price_paket_theory,
            'total_discount_rate' => $this->input->post('total_discount_rate'),
            'total_package' => $total_package,
            'total_pack_practical' => $total_pack_practical,
            'total_pack_theory' => $total_pack_theory,
            'rate_dollar' => $this->input->post('rate_dollar'),
            'rate' => $this->input->post('rate'),
            'discount' => $this->input->post('discount'),
            'rate_package' => $this->input->post('rate_package'),
            'created_at' => $today,
            'end_at' => $temp_date,
            'created_by' => $this->session->userdata('id'),
            'teacher_percentage' => $this->input->post('teacher_percentage'),
        ];

        $this->db->insert('list_package', $data);

        //nomor invoice
        //INV001/210629/004/001
        $temp_id_parent = substr($this->input->post('id_student'), 3, -1);
        $no_transaksi = "INV001/" . $temp_date_sirkulasi . "/" . $temp_id_parent;
        $data_sirkulasi = $this->getData_sirkulasi(null, $no_transaksi);

        //cek transaksi hari ini
        $temp_counter = "INV001/" . $temp_date_sirkulasi;
        // $counter = $this->getData_sirkulasi(null, $temp_counter);
        $counter = $this->getData_sirkulasi_new(null, null, substr($today, 0, 7));
        sort($counter);
        $data2 = [];
        $data3 = [];
        if (count($data_sirkulasi) == 0) {
            if (count($counter) == 0) {
                $data2 =  [
                    'no_transaksi' => $no_transaksi . "/001",
                    'is_id_parent' => substr($this->input->post('id_student'), 0, -1),
                    'created_at' => $today,
                    'created_by' => $this->session->userdata('id'),
                    'rate' => $this->input->post('rate'),
                    'total_rate' => $this->input->post('rate')
                ];
                $data3 = [
                    'no_transaksi' => $no_transaksi . "/001",
                    'is_id_parent' => substr($this->input->post('id_student'), 0, -1),
                    'id_barang' => $no_transaksi_package . "/" . $z,
                    'tipe_barang' => '1',
                    'price' => $this->input->post('rate'),
                ];
            } else {
                $temp_last3digits = substr($counter[count($counter) - 1]['no_transaksi'], -3);
                $temp_number = 1;
                if (substr($temp_last3digits, 0, 1) == 0) {
                    if (substr($temp_last3digits, 1, 1) == 0) {
                        $temp_number = substr($temp_last3digits, 2, 1);
                    } else {
                        $temp_number = substr($temp_last3digits, 1, 2);
                    }
                } else {
                    $temp_number = $temp_last3digits;
                }
                $x = 0;
                $temp_count = 1 + $temp_number;
                if ($temp_count < 10) {
                    $x = "00" . $temp_count;
                } else if ($temp_count < 100) {
                    $x = "0" . $temp_count;
                } else {
                    $x = $temp_count;
                }
                $data2 =  [
                    'no_transaksi' => $no_transaksi . "/" . $x,
                    'is_id_parent' => substr($this->input->post('id_student'), 0, -1),
                    'created_at' => $today,
                    'created_by' => $this->session->userdata('id'),
                    'rate' => $this->input->post('rate'),
                    'total_rate' => $this->input->post('rate')
                ];
                $data3 = [
                    'no_transaksi' => $no_transaksi . "/" . $x,
                    'is_id_parent' => substr($this->input->post('id_student'), 0, -1),
                    'id_barang' => $no_transaksi_package . "/" . $z,
                    'tipe_barang' => '1',
                    'price' => $this->input->post('rate'),
                ];
            }
            $this->db->insert('sirkulasi', $data2);
            $this->db->insert('sirkulasi_transaksi', $data3);
        } else {
            $data2 =  [
                'rate' => intval($data_sirkulasi[0]['rate']) + intval($this->input->post('rate')),
                'total_rate' => intval($data_sirkulasi[0]['rate']) + intval($this->input->post('rate'))
            ];
            $this->db->update('sirkulasi', $data2, ['id_sirkulasi' => $data_sirkulasi[0]['id_sirkulasi']]);
            $data3 = [
                'no_transaksi' => $data_sirkulasi[0]['no_transaksi'],
                'is_id_parent' => $data_sirkulasi[0]['is_id_parent'],
                'id_barang' => $no_transaksi_package . "/" . $z,
                'tipe_barang' => '1',
                'price' => $this->input->post('rate'),
            ];
            $this->db->insert('sirkulasi_transaksi', $data3);
        }

        return true;
    }

    public function getData_transaksi_event($no_transaksi_event = null)
    {
        $this->db->select('s.id_transaksi, s.no_transaksi_event, st.name_student, s.total_price, s.discount, s.price, s.parent_event');
        $this->db->from('register_event as s');
        $this->db->join('student as st', 's.id_user = st.id_student', 'left');
        if ($no_transaksi_event != null) {
            $this->db->like('no_transaksi_event', $no_transaksi_event);
        }
        return $this->db->get()->result_array();
    }

    public function getData_transaksi_event_detail($no_transaksi_event = null)
    {
        $this->db->select('s.*, p.event_name, st.name_student');
        $this->db->from('register_event_detail as s');
        $this->db->join('event as p', 's.id_event = p.id_event', 'left');
        $this->db->join('student as st', 's.id_user = st.id_student', 'left');
        if ($no_transaksi_event != null) {
            $this->db->like('no_transaksi_event', $no_transaksi_event);
        }
        return $this->db->get()->result_array();
    }

    public function getData_transaksi_package_offline($no_transaksi_package_offline = null)
    {
        $this->db->select('lp.id_list_package_offline, lp.total_package, lp.rate_dollar, lp.rate, lp.id_student, lp.discount, s.name_student, p.name, p.price_idr, p.price_dollar, p.price_euro, p.duration, t.name_teacher, lp.no_transaksi_package_offline, s.currency, lp.rate_package, lp.created_at, lp.end_at');
        $this->db->from('list_package_offline as lp');
        $this->db->join('paket as p', 'lp.paket = p.id', 'left');
        $this->db->join('student as s', 'lp.id_student = s.id_student', 'left');
        $this->db->join('teacher as t', 'lp.id_teacher = t.id_teacher', 'left');
        if ($no_transaksi_package_offline != null) {
            $this->db->like('no_transaksi_package_offline', $no_transaksi_package_offline);
        }
        return $this->db->get()->result_array();
    }

    public function getData_transaksi_package($no_transaksi_package = null)
    {
        $this->db->select('lp.id_list_pack, lp.total_package, lp.rate_dollar, lp.rate, lp.id_student, lp.total_pack_practical, lp.total_pack_theory, lp.discount, s.name_student, p.name, p.price_idr, p.price_dollar, p.price_euro, p.status_pack_theory, p.status_pack_practical, t.name_teacher as teacher_pratical, tt.name_teacher as teacher_teory, lp.no_transaksi_package, s.currency, lp.rate_package, lp.created_at, lp.end_at');
        $this->db->from('list_package as lp');
        $this->db->join('paket as p', 'lp.paket = p.id', 'left');
        $this->db->join('student as s', 'lp.id_student = s.id_student', 'left');
        $this->db->join('teacher as t', 'lp.id_teacher_practical = t.id_teacher', 'left');
        $this->db->join('teacher as tt', 'lp.id_teacher_theory = tt.id_teacher', 'left');
        if ($no_transaksi_package != null) {
            $this->db->like('no_transaksi_package', $no_transaksi_package);
        }
        return $this->db->get()->result_array();
    }

    public function getData_sirkulasi_new($id_sirkulasi = null, $no_transaksi = null, $periode = null)
    {
        $this->db->select('s.id_sirkulasi, s.no_transaksi');
        $this->db->from('sirkulasi as s');
        $this->db->where('s.status_sirkulasi', '1');
        if ($id_sirkulasi != null) {
            $this->db->where('id_sirkulasi', $id_sirkulasi);
        }
        if ($no_transaksi != null) {
            $this->db->like('no_transaksi', $no_transaksi);
        }
        if ($periode != null) {
            $this->db->like('created_at', $periode);
        }
        return $this->db->get()->result_array();
    }

    public function getData_sirkulasi($id_sirkulasi = null, $no_transaksi = null, $periode = null)
    {
        $this->db->select('s.*, st.name_student, st.parent_student');
        $this->db->from('sirkulasi as s');
        $this->db->join('student as st', 's.is_id_parent = st.id_parent', 'left');
        $this->db->where('s.status_sirkulasi', '1');
        if ($id_sirkulasi != null) {
            $this->db->where('id_sirkulasi', $id_sirkulasi);
        }
        if ($no_transaksi != null) {
            $this->db->like('no_transaksi', $no_transaksi);
        }
        if ($periode != null) {
            $this->db->like('created_at', $periode);
        }
        return $this->db->get()->result_array();
    }

    public function getData_sirkulasi_transaksi($no_transaksi = null, $id_barang = null)
    {
        $this->db->select('s.*');
        $this->db->from('sirkulasi_transaksi as s');

        if ($no_transaksi != null) {
            $this->db->like('s.no_transaksi', $no_transaksi);
        }

        if ($id_barang != null) {
            $this->db->like('s.id_barang', $id_barang);
        }
        return $this->db->get()->result_array();
    }

    public function updateDataPackage()
    {
        $status_pack = 1;
        $id_teacher_theory = $this->input->post('id_teacher_theory');
        if ($this->input->post('status_pack_theory') === 0) {
            $status_pack = 0;
            $id_teacher_theory = NULL;
        }

        $instrument = $this->input->post('instrument');
        $Others_temp1 = "Others1";
        $others1 = "others1";
        if ($instrument == $Others_temp1) {
            $instrument = "Others|" . $this->input->post($others1);
        }

        // $id_teacher_theory = NULL;
        // if ($this->input->post('cek_pack') == 1) {
        //     $id_teacher_theory = $this->input->post('id_teacher_theory');
        // }

        $id_list_pack = $this->input->post('id_list_pack');

        $data =  [
            'id_student' => $this->input->post('id_student'),
            'id_teacher_practical' => $this->input->post('id_teacher_practical'),
            'status_pack_theory' => $status_pack,
            'id_teacher_theory' => $id_teacher_theory,
            'instrument' =>  $instrument,

            // 'status_pack_theory' => $this->input->post('cek_pack'),
            // 'id_teacher_theory' => $id_teacher_theory,
            // 'instrument' => $this->input->post('instrument'),

            'paket' => $this->input->post('temp_paket'),
            'total_package' => $this->input->post('total_package'),
            'total_pack_practical' => $this->input->post('pack_pratical'),
            'total_pack_theory' => $this->input->post('total_pack_theory'),

            // 'total_pack_practical' => $this->input->post('pack_pratical'),
            // 'total_pack_theory' => $this->input->post('pack_theory'),

            'rate_dollar' => $this->input->post('rate_dollar'),
            'rate' => $this->input->post('rate'),
            'discount' => $this->input->post('discount'),
            'rate_package' => $this->input->post('rate_package'),
            'created_by' => $this->session->userdata('id'),
        ];
        $this->db->update('list_package', $data, ['id_list_pack' => $id_list_pack]);
        return true;
    }

    public function deleteDataPackageOffline($id_list_package_offline, $no_transaksi_package)
    {
        $no_transaksi_pack = $this->getData_sirkulasi_transaksi(null, $no_transaksi_package);
        $count_transaksi_sirkulasi = $this->getData_sirkulasi_transaksi($no_transaksi_pack[0]['no_transaksi']);
        $no_transaksi = $this->getData_sirkulasi(null, $no_transaksi_pack[0]['no_transaksi']);

        if (count($count_transaksi_sirkulasi) <= 1) {
            $this->db->delete('sirkulasi_transaksi', ['id_barang' => $no_transaksi_package]);
            $this->db->delete('sirkulasi', ['no_transaksi' => $no_transaksi_pack[0]['no_transaksi']]);
        } else {
            $rate = intval($no_transaksi[0]['rate']) - intval($no_transaksi_pack[0]['price']);
            $total_rate = $rate - $no_transaksi[0]['discount'];
            $data =  [
                'rate' => $rate,
                'total_rate' => $total_rate,
            ];
            $this->db->delete('sirkulasi_transaksi', ['id' => $no_transaksi_pack[0]['id']]);
            $this->db->update('sirkulasi', $data, ['no_transaksi' => $no_transaksi_pack[0]['no_transaksi']]);
        };

        $no_transaksi_fee = $this->getData_sirkulasi_feereport_detail(null, null, 3, $no_transaksi_package);
        $count_transaksi_fee = $this->getData_sirkulasi_feereport_detail(null, $no_transaksi_fee[0]['no_sirkulasi_feereport']);
        $no_feereport = $this->getData_sirkulasi_feereport(null, $no_transaksi_fee[0]['no_sirkulasi_feereport']);

        if (count($count_transaksi_fee) <= 1) {
            $this->db->delete('sirkulasi_feereport_detail', ['id_barang' => $no_transaksi_package]);
            $this->db->delete('sirkulasi_feereport', ['no_sirkulasi_feereport' => $no_transaksi_fee[0]['no_sirkulasi_feereport']]);
        } else {
            $rate = intval($no_feereport[0]['price']) - intval($no_transaksi_fee[0]['price']);
            $total_rate = $rate - $no_feereport[0]['discount'];
            $data =  [
                'price' => $rate,
                'total_price' => $total_rate,
            ];
            $this->db->delete('sirkulasi_feereport_detail', ['id_barang' => $no_transaksi_package]);
            $this->db->update('sirkulasi_feereport', $data, ['no_sirkulasi_feereport' => $no_transaksi_fee[0]['no_sirkulasi_feereport']]);
        };

        $this->db->delete('sirkulasi_lesson', ['id_list_package_offline' => $id_list_package_offline]);
        $this->db->delete('sirkulasi_lesson_detail', ['id_list_package_offline' => $id_list_package_offline]);
        $this->db->delete('list_package_offline', ['id_list_package_offline' => $id_list_package_offline]);
        $this->db->delete('schedule_package_offline', ['id_list_package_offline' => $id_list_package_offline]);
        return true;
    }

    public function deleteDataPackage($id_list_pack, $no_transaksi_package)
    {
        $no_transaksi_pack = $this->getData_sirkulasi_transaksi(null, $no_transaksi_package);
        $count_transaksi_sirkulasi = $this->getData_sirkulasi_transaksi($no_transaksi_pack[0]['no_transaksi']);
        $no_transaksi = $this->getData_sirkulasi(null, $no_transaksi_pack[0]['no_transaksi']);

        if (count($count_transaksi_sirkulasi) <= 1) {
            $this->db->delete('sirkulasi_transaksi', ['id_barang' => $no_transaksi_package]);
            $this->db->delete('sirkulasi', ['no_transaksi' => $no_transaksi_pack[0]['no_transaksi']]);
        } else {
            $rate = intval($no_transaksi[0]['rate']) - intval($no_transaksi_pack[0]['price']);
            $total_rate = $rate - $no_transaksi[0]['discount'];
            $data =  [
                'rate' => $rate,
                'total_rate' => $total_rate,
            ];
            $this->db->update('sirkulasi', $data, ['no_transaksi' => $no_transaksi_pack[0]['no_transaksi']]);
            $this->db->delete('sirkulasi_transaksi', ['id' => $no_transaksi_pack[0]['id']]);
        }

        $no_transaksi_fee = $this->getData_sirkulasi_feereport_detail(null, null, 1, $no_transaksi_package);
        $count_transaksi_fee = $this->getData_sirkulasi_feereport_detail(null, $no_transaksi_fee[0]['no_sirkulasi_feereport']);
        $no_feereport = $this->getData_sirkulasi_feereport(null, $no_transaksi_fee[0]['no_sirkulasi_feereport']);

        if (count($count_transaksi_fee) <= 1) {
            $this->db->delete('sirkulasi_feereport_detail', ['id_barang' => $no_transaksi_package]);
            $this->db->delete('sirkulasi_feereport', ['no_sirkulasi_feereport' => $no_transaksi_fee[0]['no_sirkulasi_feereport']]);
        } else {
            $rate = intval($no_feereport[0]['price']) - intval($no_transaksi_fee[0]['price']);
            $total_rate = $rate - $no_feereport[0]['discount'];
            $data =  [
                'price' => $rate,
                'total_price' => $total_rate,
            ];
            $this->db->delete('sirkulasi_feereport_detail', ['id_barang' => $no_transaksi_package]);
            $this->db->update('sirkulasi_feereport', $data, ['no_sirkulasi_feereport' => $no_transaksi_fee[0]['no_sirkulasi_feereport']]);
        };

        $this->db->delete('sirkulasi_lesson', ['id_list_pack' => $id_list_pack]);
        $this->db->delete('sirkulasi_lesson_detail', ['id_list_pack' => $id_list_pack]);
        $this->db->delete('list_package', ['id_list_pack' => $id_list_pack]);
        $this->db->delete('schedule_package', ['id_list_pack' => $id_list_pack]);
        return true;
    }

    public function updateDataOnlinePratical()
    {

        $id_online_pratical = $this->input->post('id_online_pratical');
        $data =  [
            'id_student' => $this->input->post('id_student'),
            'id_teacher' => $this->input->post('id_teacher'),
            'instrument' => $this->input->post('instrument'),
            'duration' => $this->input->post('duration'),
            'total_lesson' => $this->input->post('total_lesson'),
            'rate' => $this->input->post('rate')
        ];

        $this->db->update('online_pratical', $data, ['id_online_pratical' => $id_online_pratical]);
        return true;
    }

    public function deleteDataOnlinePratical($id_online_pratical)
    {
        $data =  [
            'status' => '2'
        ];

        $this->db->update('online_pratical', $data, ['id_online_pratical' => $id_online_pratical]);
        return true;
    }

    public function insertDataOnlineTheory()
    {
        $instrument = $this->input->post('instrument');
        $Others_temp1 = "Others1";
        $others1 = "others1";
        if ($instrument == $Others_temp1) {
            $instrument = "Others|" . $this->input->post($others1);
        }
        $data =  [
            'id_student' => $this->input->post('id_student'),
            'id_teacher' => $this->input->post('id_teacher'),
            'instrument' => $instrument,
            'duration' => $this->input->post('duration'),
            'rate' => $this->input->post('rate'),
        ];
        $this->db->insert('online_theory', $data);
        return true;
    }

    public function updateDataOnlineTheory()
    {
        $instrument = $this->input->post('instrument');
        if ($instrument == "Others") {
            $instrument = "Others|" . $this->input->post('others');
        }
        $id_online_theory = $this->input->post('id_online_theory');
        $data =  [
            'id_student' => $this->input->post('id_student'),
            'id_teacher' => $this->input->post('id_teacher'),
            'instrument' => $instrument,
            'duration' => $this->input->post('duration'),
            'rate' => $this->input->post('rate')
        ];

        $this->db->update('online_theory', $data, ['id_online_theory' => $id_online_theory]);
        return true;
    }

    public function deleteDataOnlineTheory($id_online_theory)
    {
        $data =  [
            'status' => '2'
        ];

        $this->db->update('online_theory', $data, ['id_online_theory' => $id_online_theory]);
        return true;
    }

    public function updateData()
    {
        $id_jenis = $this->input->post('id_jenis');
        $data =  [
            'nama_jenis' => $this->input->post('nama_jenis'),
        ];

        $this->db->update('jenis_akses', $data, ['id_jenis' => $id_jenis]);
        return true;
    }

    public function deleteData($id_jenis)
    {
        $this->db->delete('jenis_akses', ['id_jenis' => $id_jenis]);
        return true;
    }

    public function getLastTeacher()
    {
        $this->db->from('teacher');
        $this->db->order_by('id_teacher', 'DESC');
        $this->db->limit(1);
        $data = $this->db->get();
        return $data->result_array();
    }

    public function getData_student_package($id_student = null, $id_paket = null, $tipe = null)
    {
        $this->db->select('s.*, p.name as name_paket, p.price_idr, p.price_dollar, p.price_euro, p.duration, p.status_pack_theory, p.status_pack_practical');
        $this->db->from('student_package as s');
        $this->db->join('paket as p', 's.id_paket = p.id', 'left');
        if ($id_student != null) {
            $this->db->where('id_student', $id_student);
        }
        if ($id_paket != null) {
            $this->db->where('id_paket', $id_paket);
        }
        if ($tipe != null) {
            $this->db->where('p.tipe', $tipe);
        }
        return $this->db->get()->result_array();
    }

    public function getData_student($id_student = null, $id_parent = null)
    {
        $this->db->select('s.*');
        $this->db->from('student as s');
        $this->db->where('s.status', '1');
        if ($id_student != null) {
            $this->db->where('s.id_student', $id_student);
        }
        if ($id_parent != null) {
            $this->db->where('s.id_parent', $id_parent);
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

    public function getData_paket_online($id = null)
    {
        $this->db->select('t.*');
        $this->db->from('paket as t');
        $this->db->where('t.status', '1');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $where = "type_of_class='1' OR type_of_class='3'";
        $this->db->where($where);
        return $this->db->get()->result_array();
    }

    public function getData_paket($id = null, $type_of_class = null)
    {
        $this->db->select('t.*');
        $this->db->from('paket as t');
        $this->db->where('t.status', '1');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        if ($type_of_class != null) {
            $this->db->where('type_of_class', $type_of_class);
        }
        return $this->db->get()->result_array();
    }

    public function getData_offline_lesson($id_offline_lesson = null)
    {
        $this->db->select('ol.*, s.name_student, s.id_student, t.name_teacher, t.id_teacher, p.name as name_paket');
        $this->db->from('offline_lesson as ol');
        $this->db->join('student as s', 'ol.id_student = s.id_student', 'left');
        $this->db->join('teacher as t', 'ol.id_teacher = t.id_teacher', 'left');
        $this->db->join('paket as p', 'ol.id_paket = p.id', 'left');
        $this->db->where('ol.status', '1');
        if ($id_offline_lesson != null) {
            $this->db->where('id_offline_lesson', $id_offline_lesson);
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
    public function getData_note($id_note = null, $periode = null, $id_teacher = null)
    {
        $this->db->select('n.*, s.name_student, t.name_teacher');
        $this->db->from('note as n');
        $this->db->join('student as s', 'n.id_student = s.id_student', 'left');
        $this->db->join('teacher as t', 'n.id_teacher = t.id_teacher', 'left');
        if ($id_note != null) {
            $this->db->where('id_note', $id_note);
        }
        if ($periode != null) {
            $this->db->like('n.date', "$periode");
        }
        if ($id_teacher != null) {
            $this->db->where('n.id_teacher', $id_teacher);
        }
        return $this->db->get()->result_array();
    }

    public function getData_schedule($id_schedule = null, $periode = null, $id_teacher = null, $id_course = null)
    {
        $this->db->select('sc.*, s.name_student, s.parent_student, s.id_parent, t.name_teacher');
        $this->db->from('schedule as sc');
        $this->db->join('student as s', 'sc.id_student = s.id_student', 'left');
        $this->db->join('teacher as t', 'sc.id_teacher = t.id_teacher', 'left');
        $this->db->where('s.status', '1');
        if ($id_schedule != null) {
            $this->db->where('id_schedule', $id_schedule);
        }
        if ($periode != null) {
            $this->db->like('sc.date', "$periode");
        }
        if ($id_teacher != null) {
            $this->db->where('sc.id_teacher', $id_teacher);
        }
        if ($id_course != null) {
            $this->db->where('sc.id_course', $id_course);
        }
        return $this->db->get()->result_array();
    }



    public function getData_offline_trial($id_offline_trial = null, $periode = null, $id_teacher = null)
    {
        $this->db->select('ot.*, t.name_teacher');
        $this->db->from('offline_trial as ot');
        $this->db->join('teacher as t', 'ot.id_teacher = t.id_teacher', 'left');
        if ($id_offline_trial != null) {
            $this->db->where('id_offline_trial', $id_offline_trial);
        }
        if ($periode != null) {
            $this->db->like('ot.date', "$periode");
        }
        if ($id_teacher != null) {
            $this->db->where('ot.id_teacher', $id_teacher);
        }
        return $this->db->get()->result_array();
    }



    public function getData_schedule_idcourse($id_teacher, $periode)
    {
        $this->db->select('sc.*, s.name_student');
        $this->db->from('schedule as sc');
        $this->db->join('student as s', 'sc.id_student = s.id_student', 'left');
        $this->db->where('sc.id_teacher', $id_teacher);
        $this->db->like('sc.date', "$periode");
        $this->db->order_by('id_course', 'ASC');
        $this->db->order_by('date', 'ASC');
        return $this->db->get()->result_array();
    }

    public function getData_schedule_idcourse_before($id_course, $periode)
    {
        $temp = $periode . "-01";
        $this->db->select('sc.*, s.name_student');
        $this->db->from('schedule as sc');
        $this->db->join('student as s', 'sc.id_student = s.id_student', 'left');
        $this->db->where('sc.id_course', $id_course);
        $this->db->where('sc.date <', "$temp");
        return $this->db->get()->result_array();
    }

    public function getData_summary_feereport_schedule($id_teacher, $periode)
    {
        $this->db->select('sc.id_schedule,sc.instrument,s.name_student');
        $this->db->from('teacher as t');
        $this->db->join('schedule as sc', 't.id_teacher = sc.id_teacher', 'left');
        $this->db->join('student as s', 'sc.id_student = s.id_student', 'left');
        if ($id_teacher != null) {
            $this->db->where('t.id_teacher', $id_teacher);
        }
        if ($periode != null) {
            $this->db->like('sc.date', "$periode");
        }
        return $this->db->get()->result_array();
    }
    public function getData_summary_feereport_offline_trial($id_teacher, $periode)
    {
        $this->db->select('ot.name_student, ot.date');
        $this->db->from('teacher as t');
        $this->db->join('offline_trial as ot', 't.id_teacher = ot.id_teacher', 'left');
        if ($id_teacher != null) {
            $this->db->where('t.id_teacher', $id_teacher);
        }
        if ($periode != null) {
            $this->db->like('ot.date', "$periode");
        }
        return $this->db->get()->result_array();
    }

    public function getData_summary_invoice($id_parent = null, $periode = null, $id_course = null)
    {
        $this->db->select('sc.*, s.name_student, s.parent_student, s.id_parent, t.name_teacher, p.name as name_paket, ol.rate');
        $this->db->from('schedule as sc');
        $this->db->join('student as s', 'sc.id_student = s.id_student', 'left');
        $this->db->join('teacher as t', 'sc.id_teacher = t.id_teacher', 'left');

        $this->db->join('offline_lesson as ol', 'sc.id_course = ol.id_offline_lesson', 'left');

        $this->db->join('paket as p', 'ol.id_paket = p.id', 'left');

        if ($id_parent != null) {
            $this->db->where('s.id_parent', $id_parent);
        }
        if ($periode != null) {
            $this->db->like('sc.date', "$periode");
        }
        if ($id_course != null) {
            $this->db->where('sc.id_course', $id_course);
        }
        $this->db->order_by('id_course', 'ASC');
        $this->db->order_by('date', 'ASC');
        return $this->db->get()->result_array();
    }

    public function getData_summary_feereport($id_teacher, $periode)
    {
        $this->db->select('sc.*, s.name_student, s.parent_student, t.name_teacher');
        $this->db->from('schedule as sc');
        $this->db->join('student as s', 'sc.id_student = s.id_student', 'left');
        $this->db->join('teacher as t', 'sc.id_teacher = t.id_teacher', 'left');
        $this->db->where('sc.id_teacher', $id_teacher);
        $this->db->like('sc.date', "$periode");
        $this->db->order_by('id_course', 'ASC');
        $this->db->order_by('date', 'ASC');
        return $this->db->get()->result_array();
    }

    public function getData_other_invoice($id_parent = null, $periode)
    {
        $this->db->select('oi.*');
        $this->db->from('other_invoice as oi');
        // $this->db->join('student as s', 'oi.id_parent = s.id_parent', 'right');
        if ($id_parent != null) {
            $this->db->where('oi.id_parent', $id_parent);
        }
        $this->db->like('oi.periode', "$periode");
        return $this->db->get()->result_array();
    }

    public function getData_other_invoice_online($id_parent = null, $periode = null, $no_transaksi = null)
    {
        $this->db->select('oi.*');
        $this->db->from('other_invoice_online as oi');
        if ($id_parent != null) {
            $this->db->where('oi.id_parent', $id_parent);
        }
        if ($no_transaksi != null) {
            $this->db->where('oi.no_transaksi', $no_transaksi);
        }
        if ($periode != null) {
            $this->db->like('oi.periode', "$periode");
        }
        return $this->db->get()->result_array();
    }

    public function insertDataOtherInvoice()
    {
        $total_other = $this->input->post('total_other');
        for ($i = 1; $i <= $total_other; $i++) {

            $other_category = "other_category" . $i;
            $other_note = "other_note" . $i;
            $other_price = "other_price" . $i;

            $data =  [
                'id_parent' => $this->input->post('id_parent'),
                'periode' => $this->input->post('periode'),
                'other_category' => $this->input->post($other_category),
                'other_note' => $this->input->post($other_note),
                'other_price' => $this->input->post($other_price),
            ];
            $this->db->insert('other_invoice', $data);
        }
        return true;
    }

    public function updateDataSirkulasi($id_sirkulasi, $discount, $total_rate)
    {
        $data =  [
            "discount" => $discount,
            "total_rate" => $total_rate
        ];

        $this->db->update('sirkulasi', $data, ['id_sirkulasi' => $id_sirkulasi]);
        return true;
    }

    public function updateDataOtherInvoice($id_other_invoice, $dataa, $value)
    {
        $data =  [
            "$dataa" => "$value",
        ];

        $this->db->update('other_invoice', $data, ['id_other_invoice' => $id_other_invoice]);
        return true;
    }

    public function deleteDataOtherInvoice($id_other_invoice)
    {
        $this->db->delete('other_invoice', ['id_other_invoice' => $id_other_invoice]);
        return true;
    }

    public function updateDataOtherInvoiceOnline($id_other_invoice, $dataa, $value)
    {
        $data =  [
            "$dataa" => "$value",
        ];

        $this->db->update('other_invoice_online', $data, ['id_other_invoice' => $id_other_invoice]);
        return true;
    }

    public function deleteDataOtherInvoiceOnline($id_other_invoice)
    {
        $this->db->delete('other_invoice_online', ['id_other_invoice' => $id_other_invoice]);
        return true;
    }

    public function getData_other_feereport($id_teacher = null, $periode)
    {
        $this->db->select('oi.*');
        $this->db->from('other_feereport as oi');
        if ($id_teacher != null) {
            $this->db->where('oi.id_teacher', $id_teacher);
        }
        $this->db->like('oi.periode', "$periode");
        return $this->db->get()->result_array();
    }

    public function insertDataOtherFeereport()
    {
        $total_other = $this->input->post('total_other');
        for ($i = 1; $i <= $total_other; $i++) {

            $other_category = "other_category" . $i;
            $other_note = "other_note" . $i;
            $other_price = "other_price" . $i;

            $data =  [
                'id_teacher' => $this->input->post('id_teacher'),
                'periode' => $this->input->post('periode'),
                'other_category' => $this->input->post($other_category),
                'other_note' => $this->input->post($other_note),
                'other_price' => $this->input->post($other_price),
            ];
            $this->db->insert('other_feereport', $data);
        }
        return true;
    }

    public function updateDataOtherFeereport($id_other_feereport, $dataa, $value)
    {
        $data =  [
            "$dataa" => "$value",
        ];

        $this->db->update('other_feereport', $data, ['id_other_feereport' => $id_other_feereport]);
        return true;
    }

    public function deleteDataOtherFeereport($id_other_feereport)
    {
        $this->db->delete('other_feereport', ['id_other_feereport' => $id_other_feereport]);
        return true;
    }


    public function getData_book($id_book = null, $qty = null)
    {
        $this->db->select('*');
        $this->db->from('book');
        if ($id_book != null) {
            $this->db->where('id_book', $id_book);
        }
        if ($qty != null) {
            $this->db->where('qty >', '0');
        }
        $this->db->where('status', '1');
        $this->db->order_by('title', 'asc');
        return $this->db->get()->result_array();
    }

    public function getData_book2($id_book = null, $qty = null)
    {
        $this->db->select('*');
        $this->db->from('book');
        if ($id_book != null) {
            $this->db->where('id_book', $id_book);
        }
        if ($qty != null) {
            $this->db->where('qty >', '0');
        }
        $this->db->order_by('title', 'asc');
        return $this->db->get()->result_array();
    }

    public function getData_booksame($title = null, $publisher = null, $distributor = null, $distributor_price = null, $selling_price = null, $shipping_rate = null)
    {
        $this->db->select('*');
        $this->db->from('book');
        if ($title != null) {
            $this->db->where('title', $title);
        }
        if ($publisher != null) {
            $this->db->where('publisher', $publisher);
        }
        if ($distributor != null) {
            $this->db->where('distributor', $distributor);
        }
        if ($distributor_price != null) {
            $this->db->where('distributor_price', $distributor_price);
        }
        if ($selling_price != null) {
            $this->db->where('selling_price', $selling_price);
        }
        if ($shipping_rate != null) {
            $this->db->where('shipping_rate', $shipping_rate);
        }

        $this->db->where('status', '1');
        return $this->db->get()->result_array();
    }

    public function insertDataBook()
    {
        $distributor = '';
        $distributor_temp = "distributor";
        $distributor = $this->input->post($distributor_temp);
        $Others_temp = "Others";
        $others = "others";
        if ($distributor == $Others_temp) {
            $distributor = "Others|" . $this->input->post($others);
        }

        $title = $this->input->post('title');
        $publisher = $this->input->post('publisher');
        $qty = $this->input->post('qty');
        // $distributor = $this->input->post('distributor');
        $distributor_price = $this->input->post('distributor_price');
        $selling_price = $this->input->post('selling_price');
        $shipping_rate = $this->input->post('shipping_rate');

        $cek = $this->getData_booksame($title, $publisher, $distributor, $distributor_price, $selling_price, $shipping_rate);

        if (count($cek) > 0) {
            $temp_qty = intval($cek[0]['qty']) + intval($qty);
            $data =  [
                'qty' => $temp_qty,
            ];
            $this->db->update('book', $data, ['id_book' => $cek[0]['id_book']]);
        } else {
            $data =  [
                'title' => $title,
                'publisher' => $publisher,
                'qty' => $qty,
                'distributor' => $distributor,
                'distributor_price' => $distributor_price,
                'selling_price' => $selling_price,
                'shipping_rate' => $shipping_rate,
            ];
            $this->db->insert('book', $data);
        }
        return true;
    }

    public function updateDataBook()
    {
        $id_book = $this->input->post('id_book');
        $data =  [
            'title' => $this->input->post('title'),
            'publisher' => $this->input->post('publisher'),
            'qty' => $this->input->post('qty'),
            'distributor' => $this->input->post('distributor'),
            'distributor_price' => $this->input->post('distributor_price'),
        ];

        $this->db->update('book', $data, ['id_book' => $id_book]);
        return true;
    }

    public function deleteDataBook($id_book)
    {
        $data =  [
            'status' => '2'
        ];

        $this->db->update('book', $data, ['id_book' => $id_book]);
        return true;
    }

    public function getData_order_book($id_order = null, $id_parent = null, $periode = null)
    {
        $this->db->select('ob.*, s.id_parent, s.parent_student, s.name_student, b.title');
        $this->db->from('order_book as ob');
        $this->db->join('book as b', 'ob.id_book = b.id_book', 'left');
        $this->db->join('student as s', 'ob.id_student = s.id_student', 'left');
        $this->db->where('s.status', '1');
        if ($id_order != null) {
            $this->db->where('ob.id_order', $id_order);
        }
        if ($id_parent != null) {
            $this->db->where('s.id_parent', $id_parent);
        }
        if ($periode != null) {
            $this->db->where('ob.status', '3');

            if (substr('ob.tgl_terima', 0, 10) != "0000-00-00") {
                $temp_period = $periode . "-05";
                $this->db->where('ob.tgl_terima <=', "$temp_period");

                $startdate = strtotime("$periode");
                $enddate = strtotime("-1 months", $startdate);

                $temp_date =  date("Y-m-05", $enddate);
                $this->db->where('ob.tgl_terima >', "$temp_date");
            }
        }
        return $this->db->get()->result_array();
    }

    public function getData_transaksi_book($no_transaksi_book = null)
    {
        $this->db->select('s.id_order, s.no_transaksi_book, st.name_student, s.price, b.title, s.tgl_order, s.selling_price, s.shipping_price, s.discount');
        $this->db->from('order_book as s');
        $this->db->join('student as st', 's.id_student = st.id_student', 'left');
        $this->db->join('book as b', 's.id_book = b.id_book', 'left');
        if ($no_transaksi_book != null) {
            $this->db->like('no_transaksi_book', $no_transaksi_book);
        }
        return $this->db->get()->result_array();
    }

    public function insertDataBookOrder()
    {
        //BOK/210714/0151/001
        $created_at = date("Y-m-d");
        $startdate = strtotime($created_at);
        $temp_date_sirkulasi =  date("ymd", $startdate);

        $temp_id_student = substr($this->input->post('id_student'), 3);
        $no_transaksi_book = "BOK/" . $temp_date_sirkulasi . "/" . $temp_id_student;
        $data_transaksi_book = $this->getData_transaksi_book($no_transaksi_book);
        $z = 0;
        if (count($data_transaksi_book) == 0) {
            $z = "001";
        } else {
            if (count($data_transaksi_book) < 10) {
                $z = "00" . (count($data_transaksi_book) + 1);
            } else if (count($data_transaksi_book) < 100) {
                $z = "0" . (count($data_transaksi_book) + 1);
            } else {
                $z = (count($data_transaksi_book) + 1);
            }
        }
        // echo var_dump($temp_id_student);
        // echo var_dump($no_transaksi_book);
        // echo var_dump($data_transaksi_book);
        // echo var_dump($no_transaksi_book . "/" . $z);
        // die();

        $data =  [
            'no_transaksi_book' => $no_transaksi_book . "/" . $z,
            'id_student' => $this->input->post('id_student'),
            'id_book' => $this->input->post('id_book'),
            'qty' => $this->input->post('qty'),
            'tgl_order' => $this->input->post('tgl_order'),
            'distributor_price' => $this->input->post('distributor_price'),
            'selling_price' => $this->input->post('selling_price'),
            'shipping_price' => $this->input->post('shipping_price'),
            'discount' => $this->input->post('discount'),
            'price' => $this->input->post('price'),
        ];

        $this->db->insert('order_book', $data);

        $total_price = $this->input->post('price');
        //nomor invoice
        //INV002/210629/004/001
        $temp_id_parent = substr($this->input->post('id_student'), 3, -1);
        $no_transaksi = "INV002/" . $temp_date_sirkulasi . "/" . $temp_id_parent;
        $data_sirkulasi = $this->getData_sirkulasi(null, $no_transaksi, $created_at);

        //cek transaksi hari ini
        $counter = $this->getData_sirkulasi_new(null, null, substr($created_at, 0, 7));
        sort($counter);
        $data2 = [];
        $data3 = [];
        if (count($data_sirkulasi) == 0) {
            if (count($counter) == 0) {
                $data2 =  [
                    'no_transaksi' => $no_transaksi . "/001",
                    'is_id_parent' => substr($this->input->post('id_student'), 0, -1),
                    'created_at' => $created_at,
                    'created_by' => $this->session->userdata('id'),
                    'rate' => $total_price,
                    'total_rate' => $total_price
                ];
                $data3 = [
                    'no_transaksi' => $no_transaksi . "/001",
                    'is_id_parent' => substr($this->input->post('id_student'), 0, -1),
                    'id_barang' => $no_transaksi_book . "/" . $z,
                    'tipe_barang' => '3',
                    'price' => $total_price,
                ];
            } else {
                $temp_last3digits = substr($counter[count($counter) - 1]['no_transaksi'], -3);
                $temp_number = 1;
                if (substr($temp_last3digits, 0, 1) == 0) {
                    if (substr($temp_last3digits, 1, 1) == 0) {
                        $temp_number = substr($temp_last3digits, 2, 1);
                    } else {
                        $temp_number = substr($temp_last3digits, 1, 2);
                    }
                } else {
                    $temp_number = $temp_last3digits;
                }
                $x = 0;
                $temp_count = 1 + $temp_number;
                if ($temp_count < 10) {
                    $x = "00" . $temp_count;
                } else if ($temp_count < 100) {
                    $x = "0" . $temp_count;
                } else {
                    $x = $temp_count;
                }
                $data2 =  [
                    'no_transaksi' => $no_transaksi . "/" . $x,
                    'is_id_parent' => substr($this->input->post('id_student'), 0, -1),
                    'created_at' => $created_at,
                    'created_by' => $this->session->userdata('id'),
                    'rate' => $total_price,
                    'total_rate' => $total_price
                ];
                $data3 = [
                    'no_transaksi' => $no_transaksi . "/" . $x,
                    'is_id_parent' => substr($this->input->post('id_student'), 0, -1),
                    'id_barang' => $no_transaksi_book . "/" . $z,
                    'tipe_barang' => '3',
                    'price' => $total_price,
                ];
            }

            $this->db->insert('sirkulasi', $data2);
            $this->db->insert('sirkulasi_transaksi', $data3);
        } else {
            $data2 =  [
                'rate' => intval($data_sirkulasi[0]['rate']) + intval($total_price),
                'total_rate' => intval($data_sirkulasi[0]['rate']) + intval($total_price)
            ];
            $this->db->update('sirkulasi', $data2, ['id_sirkulasi' => $data_sirkulasi[0]['id_sirkulasi']]);
            $data3 = [
                'no_transaksi' => $data_sirkulasi[0]['no_transaksi'],
                'is_id_parent' => $data_sirkulasi[0]['is_id_parent'],
                'id_barang' => $no_transaksi_book . "/" . $z,
                'tipe_barang' => '3',
                'price' => $total_price,
            ];
            $this->db->insert('sirkulasi_transaksi', $data3);
        }
        return true;
    }

    public function updateDataStockBook()
    {
        $id_book = $this->input->post('id_book');
        $temp_qty = intval($this->input->post('qty_before')) - intval($this->input->post('qty'));

        if ($temp_qty != 0) {
            $data =  [
                'qty' => $temp_qty,
            ];
            $this->db->update('book', $data, ['id_book' => $id_book]);
        } else {
            $data =  [
                'status' => '2',
                'qty' => '0',
            ];
            $this->db->update('book', $data, ['id_book' => $id_book]);
        }
        return true;
    }

    public function updateDataBookOrder()
    {
        $id_order = $this->input->post('id_order');
        $data =  [
            'status' => $this->input->post('status'),
            'tgl_send' => $this->input->post('tgl_send'),
            'tgl_terima' => $this->input->post('tgl_terima'),
            'penerima' => $this->input->post('penerima'),
        ];
        $this->db->update('order_book', $data, ['id_order' => $id_order]);
        return true;
    }

    public function deleteDataBookOrder($id_order, $id_book = null, $qty, $no_transaksi_book)
    {
        $no_transaksi_pack = $this->getData_sirkulasi_transaksi(null, $no_transaksi_book);
        $count_transaksi_sirkulasi = $this->getData_sirkulasi_transaksi($no_transaksi_pack[0]['no_transaksi']);
        $no_transaksi = $this->getData_sirkulasi(null, $no_transaksi_pack[0]['no_transaksi']);

        $temp_price = 0;
        if (count($count_transaksi_sirkulasi) <= 1) {
            $this->db->delete('sirkulasi_transaksi', ['id_barang' => $no_transaksi_book]);
            $this->db->delete('sirkulasi', ['no_transaksi' => $no_transaksi_pack[0]['no_transaksi']]);
        } else {
            $rate = intval($no_transaksi[0]['rate']) - intval($no_transaksi_pack[0]['price']);
            $total_rate = $rate - $no_transaksi[0]['discount'];
            $data =  [
                'rate' => $rate,
                'total_rate' => $total_rate,
            ];
            $this->db->delete('sirkulasi_transaksi', ['id' => $no_transaksi_pack[0]['id']]);
            $this->db->update('sirkulasi', $data, ['no_transaksi' => $no_transaksi_pack[0]['no_transaksi']]);
        }
        if ($id_book != "-") {
            $book = $this->getData_book($id_book);
            $temp_qty = intval($book[0]['qty']) + $qty;
            $data =  [
                'qty' => $temp_qty,
                'status' => '1'
            ];
            $this->db->update('book', $data, ['id_book' => $id_book]);
        }
        $this->db->delete('order_book', ['id_order' => $id_order]);
        return true;
    }

    public function getData_book_purchase($id_purchase = null)
    {
        $this->db->select('*');
        $this->db->from('book_purchase');
        if ($id_purchase != null) {
            $this->db->where('id_purchase', $id_purchase);
        }
        return $this->db->get()->result_array();
    }

    public function insertDataBookPurchase()
    {
        $distributor = '';
        $distributor_temp = "distributor";
        $distributor = $this->input->post($distributor_temp);
        $Others_temp = "Others";
        $others = "others";
        if ($distributor == $Others_temp) {
            $distributor = "Others|" . $this->input->post($others);
        }

        $data =  [
            'date' => $this->input->post('date'),
            'title' => $this->input->post('title'),
            'publisher' => $this->input->post('publisher'),
            'qty' => $this->input->post('qty'),
            'distributor' => $distributor,
            'distributor_price' => $this->input->post('distributor_price'),
            'selling_price' => $this->input->post('selling_price'),
            'shipping_rate' => $this->input->post('shipping_rate'),
        ];
        $this->db->insert('book_purchase', $data);
        return true;
    }

    public function updateDataBookPurchase()
    {
        $distributor = '';
        $distributor_temp = "distributor";
        $distributor = $this->input->post($distributor_temp);
        $Others_temp = "Others";
        $others = "others";
        if ($distributor == $Others_temp) {
            $distributor = "Others|" . $this->input->post($others);
        }

        $id_purchase = $this->input->post('id_purchase');
        $title = $this->input->post('title');
        $publisher = $this->input->post('publisher');
        $distributor_price = $this->input->post('distributor_price');
        $selling_price = $this->input->post('selling_price');
        $shipping_rate = $this->input->post('shipping_rate');
        $qty = $this->input->post('qty');
        $qty_before = $this->input->post('qty_before');

        $data =  [
            'title' => $title,
            'publisher' => $publisher,
            'qty' => $qty,
            'distributor' => $distributor,
            'distributor_price' => $distributor_price,
            'selling_price' => $selling_price,
            'shipping_rate' => $shipping_rate,
            'receive' => $this->input->post('receive'),
        ];

        $this->db->update('book_purchase', $data, ['id_purchase' => $id_purchase]);

        $id_book = $this->input->post('id_book');
        $qty_stock = $this->input->post('qty_stock');
        $title_stock = $this->input->post('title_stock');
        $publisher_stock = $this->input->post('publisher_stock');
        $distributor_stock = $this->input->post('distributor_stock');
        $distributor_price_stock = $this->input->post('distributor_price_stock');
        $selling_price_stock = $this->input->post('selling_price_stock');
        $shipping_rate_stock = $this->input->post('shipping_rate_stock');

        if (($title == $title_stock) && ($publisher == $publisher_stock) && ($distributor == $distributor_stock) && ($distributor_price == $distributor_price_stock) && ($selling_price == $selling_price_stock)) {
            $data2 =  [
                'title' => $title,
                'publisher' => $publisher,
                'qty' => intval($qty_stock) + intval($qty) - intval($qty_before),
                'distributor' => $distributor,
                'distributor_price' => $distributor_price,
                'selling_price' => $selling_price,
            ];
            $this->db->update('book', $data2, ['id_book' => $id_book]);
        } else {
            $count_temp = intval($qty_stock) - intval($qty_before);
            if ($count_temp > 0) {
                $data2 =  [
                    'qty' => $count_temp,
                ];
                $this->db->update('book', $data2, ['id_book' => $id_book]);
            } else {
                $this->db->delete('book', ['id_book' => $id_book]);
            }
            $cek = $this->M_Admin->getData_booksame($title, $publisher, $distributor, $distributor_price, $selling_price);
            if (count($cek) > 0) {
                $data3 =  [
                    'qty' => intval($qty) + intval($cek[0]['qty']),
                ];
                $this->db->update('book', $data3, ['id_book' => $cek[0]['id_book']]);
            } else {
                $data3 =  [
                    'title' => $title,
                    'publisher' => $publisher,
                    'qty' => $qty,
                    'distributor' => $distributor,
                    'distributor_price' => $distributor_price,
                    'selling_price' => $selling_price,
                ];
                $this->db->insert('book', $data3);
            }
        }
        return true;
    }

    public function deleteDataBookPurchase($id_purchase)
    {
        $temp_book = $this->getData_book_purchase($id_purchase);
        $getQty = $this->getData_booksame($temp_book[0]['title'], $temp_book[0]['publisher'], $temp_book[0]['distributor'], $temp_book[0]['distributor_price'], $temp_book[0]['selling_price'], $temp_book[0]['shipping_rate']);

        $countQty = $getQty[0]['qty'] - $temp_book[0]['qty'];
        if ($countQty > 0) {
            $data =  [
                'qty' => $countQty,
            ];
            $this->db->where('title', $temp_book[0]['title']);
            $this->db->where('publisher', $temp_book[0]['publisher']);
            $this->db->where('distributor', $temp_book[0]['distributor']);
            $this->db->where('distributor_price', $temp_book[0]['distributor_price']);
            $this->db->where('selling_price', $temp_book[0]['selling_price']);
            $this->db->where('shipping_rate', $temp_book[0]['shipping_rate']);
            $this->db->update('book', $data);
        } else {
            $this->db->where('title', $temp_book[0]['title']);
            $this->db->where('publisher', $temp_book[0]['publisher']);
            $this->db->where('distributor', $temp_book[0]['distributor']);
            $this->db->where('distributor_price', $temp_book[0]['distributor_price']);
            $this->db->where('selling_price', $temp_book[0]['selling_price']);
            $this->db->where('shipping_rate', $temp_book[0]['shipping_rate']);
            $this->db->delete('book');
        }
        $this->db->delete('book_purchase', ['id_purchase' => $id_purchase]);
        return true;
    }

    public function getData_event($id_event = null, $member = null, $parent_event = null)
    {
        $this->db->select('*');
        $this->db->from('event');
        $this->db->where('status', '1');
        if ($id_event != null) {
            $this->db->where('id_event', $id_event);
        }
        if ($parent_event != null) {
            $this->db->where('parent_event', $parent_event);
        }
        if ($member != null) {
            $this->db->where('member', $member);
        }
        return $this->db->get()->result_array();
    }

    public function getData_event_($id_event = null, $member = null, $parent_event = null)
    {
        $this->db->select('*');
        $this->db->from('event');
        if ($id_event != null) {
            $this->db->where('id_event', $id_event);
        }
        if ($parent_event != null) {
            $this->db->where('parent_event', $parent_event);
        }
        if ($member != null) {
            $this->db->where('member', $member);
        }
        return $this->db->get()->result_array();
    }

    public function getLastData_event($id_event = null, $member = null)
    {
        $this->db->select('*');
        $this->db->from('event');
        if ($id_event != null) {
            $this->db->where('id_event', $id_event);
        }
        if ($member != null) {
            $this->db->where('member', $member);
        }
        $this->db->order_by('id_event', 'DESC');
        $this->db->limit(1);
        return $this->db->get()->result_array();
    }
    public function getFirstEvent($id_event = null, $member = null)
    {
        $this->db->select('*');
        $this->db->from('event');
        if ($id_event != null) {
            $this->db->where('id_event', $id_event);
        }
        if ($member != null) {
            $this->db->where('member', $member);
        }
        $this->db->order_by('id_event', 'DESC');
        $this->db->limit(1);
        return $this->db->get()->result_array();
    }

    public function getRegisterEvent($id_transaksi = null, $no_transaksi_event = null, $parent_event = null)
    {
        $this->db->select('*');
        $this->db->from('register_event');
        if ($id_transaksi != null) {
            $this->db->where('id_transaksi', $id_transaksi);
        }
        if ($no_transaksi_event != null) {
            $this->db->where('no_transaksi_event', $no_transaksi_event);
        }
        if ($parent_event != null) {
            $this->db->where('parent_event', $parent_event);
        }
        return $this->db->get()->result_array();
    }

    public function getRegisterEventDetail($id_detail = null, $no_transaksi_event = null)
    {
        $this->db->select('*');
        $this->db->from('register_event_detail');
        if ($id_detail != null) {
            $this->db->where('id_detail', $id_detail);
        }
        if ($no_transaksi_event != null) {
            $this->db->where('no_transaksi_event', $no_transaksi_event);
        }
        return $this->db->get()->result_array();
    }

    public function getEventByParent($parent_event = null, $not_in = null)
    {
        $this->db->select('*');
        $this->db->from('event');
        $this->db->where('status', '1');

        if ($parent_event != null) {
            $this->db->where('parent_event', $parent_event);
        }
        $not_in_ex = explode('-', $not_in);
        if ($not_in != null) {
            $this->db->where_not_in('id_event', $not_in_ex);
        }
        return $this->db->get()->result_array();
    }

    public function getEventByParent_($parent_event = null, $not_in = null)
    {
        $this->db->select('*');
        $this->db->from('event');

        if ($parent_event != null) {
            $this->db->where('parent_event', $parent_event);
        }
        $not_in_ex = explode('-', $not_in);
        if ($not_in != null) {
            $this->db->where_not_in('id_event', $not_in_ex);
        }
        return $this->db->get()->result_array();
    }


    public function insertDataEvent()
    {
        $total_event_date = $this->input->post('total_event_date');
        $user = $this->getLastData_event();
        $parent_event = "";
        $id_event = "";
        if (count($user) < 1) {
            $parent_event  = "500001";
            $id_event = "5000011";
        } else {
            $parent_event  =  intval($user[0]['parent_event']) + 1;
            $id_event =  intval($user[0]['parent_event']) + 1 . "1";
        }
        for ($i = 1; $i <= $total_event_date; $i++) {
            $parent_event_temp = $parent_event;
            $id_event_temp = $id_event;

            if ($i > 1) {
                $parent_event = $parent_event_temp;
                $id_event = intval($id_event_temp + 1);
            }
            $event_date = "event_date" . $i;
            $price = "price" . $i;
            $data =  [
                'id_event' => $id_event,
                'event_name' => $this->input->post('event_name'),
                'parent_event' => $parent_event,
                'member' => $this->input->post('member'),
                'event_date' => $this->input->post($event_date),
                'price' => $this->input->post($price),
            ];
            $this->db->insert('event', $data);
        }
        $data2 =  [
            'parent_event' => $parent_event,
        ];
        $this->db->insert('data_event', $data2);

        return true;
    }

    public function updateDataEvent()
    {
        $parent_event = $this->input->post('parent_event');
        $temp_parent = $this->getEventByParent($parent_event);
        foreach ($temp_parent as $e) {
            $event_date = 'event_date-' . $e['id_event'];
            $price = 'price-' . $e['id_event'];
            $data =  [
                'event_name' => $this->input->post('event_name'),
                'member' => $this->input->post('member'),
                'event_date' => $this->input->post($event_date),
                'price' => $this->input->post($price),
            ];

            $this->db->update('event', $data, ['id_event' => $e['id_event']]);
        }
        return true;
    }

    public function deleteDataEvent($parent_event)
    {
        $data =  [
            'status' => '2'
        ];
        $this->db->update('data_event', $data, ['parent_event' => $parent_event]);
        $this->db->update('event', $data, ['parent_event' => $parent_event]);


        return true;
    }

    public function deleteDataEventDetail($id_event)
    {
        $data =  [
            'status' => '2'
        ];
        $this->db->update('event', $data, ['id_event' => $id_event]);

        return true;
    }

    public function getData_detail_event_student($id_event_student = null, $id_parent = null, $periode = null)
    {
        $this->db->select('es.*, s.id_parent, s.parent_student, s.name_student, b.event_date,b.event_name');
        $this->db->from('register_event_detail as es');
        $this->db->join('event as b', 'es.id_event = b.id_event', 'left');
        $this->db->join('student as s', 'es.id_user = s.id_student', 'left');
        $this->db->where('s.status', '1');
        // $this->db->where('es.status', '1');
        if ($id_event_student != null) {
            $this->db->where('id_event_student', $id_event_student);
        }
        if ($id_parent != null) {
            $this->db->where('s.id_parent', $id_parent);
        }
        if ($periode != null) {
            $temp_period = $periode . "-05";
            $this->db->where('b.event_date <=', "$temp_period");

            $startdate = strtotime("$periode");
            $enddate = strtotime("-1 months", $startdate);

            $temp_date =  date("Y-m-05", $enddate);
            $this->db->where('b.event_date >', "$temp_date");
        }
        return $this->db->get()->result_array();
    }

    public function getData_event_student($id_event_student = null, $id_parent = null, $periode = null)
    {
        $this->db->select('es.*, s.id_parent, s.parent_student, s.name_student, b.event_date,b.event_name');
        $this->db->from('event_student as es');
        $this->db->join('event as b', 'es.id_event = b.id_event', 'left');
        $this->db->join('student as s', 'es.id_student = s.id_student', 'left');
        $this->db->where('s.status', '1');
        $this->db->where('es.status', '1');
        if ($id_event_student != null) {
            $this->db->where('id_event_student', $id_event_student);
        }
        if ($id_parent != null) {
            $this->db->where('s.id_parent', $id_parent);
        }
        if ($periode != null) {
            $temp_period = $periode . "-05";
            $this->db->where('b.event_date <=', "$temp_period");

            $startdate = strtotime("$periode");
            $enddate = strtotime("-1 months", $startdate);

            $temp_date =  date("Y-m-05", $enddate);
            $this->db->where('b.event_date >', "$temp_date");
        }
        return $this->db->get()->result_array();
    }

    public function getData_event_teacher($id_event_teacher = null, $id_teacher = null, $periode = null)
    {
        $this->db->select('es.*, s.id_teacher, s.name_teacher, b.event_date,b.event_name');
        $this->db->from('event_teacher as es');
        $this->db->join('event as b', 'es.id_event = b.id_event', 'left');
        $this->db->join('teacher as s', 'es.id_teacher = s.id_teacher', 'left');
        $this->db->where('es.status', '1');
        if ($id_event_teacher != null) {
            $this->db->where('id_event_teacher', $id_event_teacher);
        }
        if ($id_teacher != null) {
            $this->db->where('s.id_teacher', $id_teacher);
        }
        if ($periode != null) {
            $temp_period = $periode . "-05";
            $this->db->where('b.event_date <=', "$temp_period");

            $startdate = strtotime("$periode");
            $enddate = strtotime("-1 months", $startdate);

            $temp_date =  date("Y-m-05", $enddate);
            $this->db->where('b.event_date >', "$temp_date");
        }
        return $this->db->get()->result_array();
    }

    public function getData_event_filter($id_event = null, $today)
    {
        $this->db->select('*');
        $this->db->from('event');
        $this->db->where('status', '1');
        $this->db->where('member', '2');
        $startdate = strtotime("$today");
        $enddate = strtotime("+3 days", $startdate);
        $temp_date =  date("Y-m-d", $enddate);
        $this->db->where('event_date >=', $temp_date);
        $id_event_ex = explode('-', $id_event);
        if ($id_event != null) {
            $this->db->where_not_in('id_event', $id_event_ex);
        }
        return $this->db->get()->result_array();
    }

    public function insertDataEventStudent()
    {
        $id_user = $this->input->post('id_student');
        $tipe_user = '1';
        $created_at = date("Y-m-d");
        $created_by = $this->session->userdata('id');
        $price = $this->input->post('total_price');
        $discount = $this->input->post('discount');
        $total_price = $this->input->post('rate');

        $dateChar = preg_replace("/[^a-zA-Z0-9]/", "", $created_at);
        $randomChar = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5);
        $no_transaksi = $dateChar . '' . $randomChar;


        //nomor transaksi event
        //EVN/210629/0041/001
        $startdate = strtotime($created_at);
        $temp_date_sirkulasi =  date("ymd", $startdate);
        // echo var_dump($created_at);
        // echo "<br>";
        // echo $temp_date_sirkulasi;
        // die();
        $temp_id_student = substr($this->input->post('id_student'), 3);
        $no_transaksi_event = "EVN/" . $temp_date_sirkulasi . "/" . $temp_id_student;
        $data_transaksi_event = $this->getData_transaksi_event($no_transaksi_event);
        $z = 0;
        if (count($data_transaksi_event) == 0) {
            $z = "001";
        } else {
            if (count($data_transaksi_event) < 10) {
                $z = "00" . (count($data_transaksi_event) + 1);
            } else if (count($data_transaksi_event) < 100) {
                $z = "0" . (count($data_transaksi_event) + 1);
            } else {
                $z = (count($data_transaksi_event) + 1);
            }
        }

        // echo var_dump($data_transaksi_event);
        // echo var_dump($no_transaksi_event);
        // echo var_dump($z);
        // echo $no_transaksi_event . "/" . $z;
        // die();

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

        // $counter = $this->input->post('total_event');
        $counter = 1;
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

        //nomor invoice
        //INV003/210629/004/001
        $temp_id_parent = substr($this->input->post('id_student'), 3, -1);
        $no_transaksi = "INV003/" . $temp_date_sirkulasi . "/" . $temp_id_parent;
        $data_sirkulasi = $this->getData_sirkulasi(null, $no_transaksi, $created_at);

        //cek transaksi hari ini
        $counter = $this->getData_sirkulasi_new(null, null, substr($created_at, 0, 7));
        sort($counter);
        $data2 = [];
        $data3 = [];
        if (count($data_sirkulasi) == 0) {
            if (count($counter) == 0) {
                $data2 =  [
                    'no_transaksi' => $no_transaksi . "/001",
                    'is_id_parent' => substr($this->input->post('id_student'), 0, -1),
                    'created_at' => $created_at,
                    'created_by' => $this->session->userdata('id'),
                    'rate' => $total_price,
                    'total_rate' => $total_price
                ];
                $data3 = [
                    'no_transaksi' => $no_transaksi . "/001",
                    'is_id_parent' => substr($this->input->post('id_student'), 0, -1),
                    'id_barang' => $no_transaksi_event . "/" . $z,
                    'tipe_barang' => '2',
                    'price' => $total_price,
                ];
            } else {
                $temp_last3digits = substr($counter[count($counter) - 1]['no_transaksi'], -3);
                $temp_number = 1;
                if (substr($temp_last3digits, 0, 1) == 0) {
                    if (substr($temp_last3digits, 1, 1) == 0) {
                        $temp_number = substr($temp_last3digits, 2, 1);
                    } else {
                        $temp_number = substr($temp_last3digits, 1, 2);
                    }
                } else {
                    $temp_number = $temp_last3digits;
                }
                $x = 0;
                $temp_count = 1 + $temp_number;
                if ($temp_count < 10) {
                    $x = "00" . $temp_count;
                } else if ($temp_count < 100) {
                    $x = "0" . $temp_count;
                } else {
                    $x = $temp_count;
                }
                $data2 =  [
                    'no_transaksi' => $no_transaksi . "/" . $x,
                    'is_id_parent' => substr($this->input->post('id_student'), 0, -1),
                    'created_at' => $created_at,
                    'created_by' => $this->session->userdata('id'),
                    'rate' => $total_price,
                    'total_rate' => $total_price
                ];
                $data3 = [
                    'no_transaksi' => $no_transaksi . "/" . $x,
                    'is_id_parent' => substr($this->input->post('id_student'), 0, -1),
                    'id_barang' => $no_transaksi_event . "/" . $z,
                    'tipe_barang' => '2',
                    'price' => $total_price,
                ];
            }
            $this->db->insert('sirkulasi', $data2);
            $this->db->insert('sirkulasi_transaksi', $data3);
        } else {
            $data2 =  [
                'rate' => intval($data_sirkulasi[0]['rate']) + intval($total_price),
                'total_rate' => intval($data_sirkulasi[0]['rate']) + intval($total_price)
            ];
            $this->db->update('sirkulasi', $data2, ['id_sirkulasi' => $data_sirkulasi[0]['id_sirkulasi']]);
            $data3 = [
                'no_transaksi' => $data_sirkulasi[0]['no_transaksi'],
                'is_id_parent' => $data_sirkulasi[0]['is_id_parent'],
                'id_barang' => $no_transaksi_event . "/" . $z,
                'tipe_barang' => '2',
                'price' => $total_price,
            ];
            $this->db->insert('sirkulasi_transaksi', $data3);
        }
        return true;
    }

    public function updateDataEventStudent()
    {
        $id_transaksi = $this->input->post('id_transaksi');   
        $no_transaksi_event = $this->input->post('no_transaksi_event');   
        
        $price = $this->input->post('total_price');
        $discount = $this->input->post('discount');
        $total_price = $this->input->post('rate');

        $temp = $this->getData_sirkulasi_transaksi(null, $no_transaksi_event);
        $before_price = $temp[0]['price'];
        $temp_sirkulasi = $this->getData_sirkulasi(null, $temp[0]['no_transaksi']);
        $rate = $temp_sirkulasi[0]['rate'];
        $discount_sirkulasi = $temp_sirkulasi[0]['discount'];
        if($before_price > $total_price){
            $after_price = $before_price - $total_price;
            $rate -= $after_price;
        }
        if($before_price < $total_price){
            $after_price = $total_price - $before_price;
            $rate += $after_price;
        }

        $data = [
            'discount' => $discount,
            'total_price' => $total_price,
        ];
        $this->db->update('register_event', $data, ['id_transaksi' => $id_transaksi]);
        $data2 = [
            'price' => $total_price
        ];
        $this->db->update('sirkulasi_transaksi', $data2, ['id_barang' => $no_transaksi_event]);
        $data3 = [
            'rate' => $rate,
            'total_rate' => $rate - $discount_sirkulasi
        ];
        $this->db->update('sirkulasi', $data3, ['no_transaksi' => $temp[0]['no_transaksi']]);
        
        return true;
    }

    public function updateDataEventTeacherDiscount()
    {
        $no_transaksi_event = $this->input->post('no_transaksi_event');
        $data =  [
            'discount' => $this->input->post('discount'),
            'total_price' => ($this->input->post('total_price') - $this->input->post('discount')),
        ];

        $this->db->update('register_event', $data, ['no_transaksi_event' => $no_transaksi_event]);
        return true;
    }

    public function deleteDataEventStudent($no_transaksi_event)
    {
        $no_transaksi_pack = $this->getData_sirkulasi_transaksi(null, $no_transaksi_event);
        $count_transaksi_sirkulasi = $this->getData_sirkulasi_transaksi($no_transaksi_pack[0]['no_transaksi']);
        $no_transaksi = $this->getData_sirkulasi(null, $no_transaksi_pack[0]['no_transaksi']);

        $temp_price = 0;
        if (count($count_transaksi_sirkulasi) <= 1) {
            $this->db->delete('sirkulasi_transaksi', ['id_barang' => $no_transaksi_event]);
            $this->db->delete('sirkulasi', ['no_transaksi' => $no_transaksi_pack[0]['no_transaksi']]);
        } else {
            $rate = intval($no_transaksi[0]['rate']) - intval($no_transaksi_pack[0]['price']);
            $total_rate = $rate - $no_transaksi[0]['discount'];
            $data =  [
                'rate' => $rate,
                'total_rate' => $total_rate,
            ];
            $this->db->delete('sirkulasi_transaksi', ['id' => $no_transaksi_pack[0]['id']]);
            $this->db->update('sirkulasi', $data, ['no_transaksi' => $no_transaksi_pack[0]['no_transaksi']]);
        }
        $this->db->delete('register_event_detail', ['no_transaksi_event' => $no_transaksi_event]);
        $this->db->delete('register_event', ['no_transaksi_event' => $no_transaksi_event]);
        return true;
    }

    function fetch_all_package_offline($id_list_package_offline)
    {
        $this->db->select('sc.*, s.name_student');
        $this->db->from('schedule_package_offline as sc');
        $this->db->join('student as s', 'sc.id_student = s.id_student', 'left');
        $this->db->where('sc.id_list_package_offline', $id_list_package_offline);
        $this->db->order_by("id_schedule_package_offline", "ASC");
        return $this->db->get();
    }

    function fetch_all_package($id_list_pack)
    {
        $this->db->select('sc.*, s.name_student');
        $this->db->from('schedule_package as sc');
        $this->db->join('student as s', 'sc.id_student = s.id_student', 'left');
        $this->db->where('sc.id_list_pack', $id_list_pack);
        $this->db->order_by("id_schedule_pack", "ASC");
        return $this->db->get();
    }

    function insert_event_schedule_package_offline($data)
    {
        $this->db->insert('schedule_package_offline', $data);
    }

    function update_event_schedule_package_offline($id_schedule_package_offline, $status)
    {
        $data =  [
            'status' => $status,
        ];
        $this->db->update('schedule_package_offline', $data, ['id_schedule_package_offline' => $id_schedule_package_offline]);
    }

    function delete_event_schedule_package_offline($id_schedule_package)
    {
        $this->db->where('id_schedule_package_offline', $id_schedule_package);
        $this->db->delete('schedule_package_offline');
    }

    function insert_event_schedule_package($data)
    {
        $this->db->insert('schedule_package', $data);
    }

    function update_event_schedule_package($data, $id_schedule_package)
    {
        $this->db->where('id_schedule_pack', $id_schedule_package);
        $this->db->update('schedule_package', $data);
    }

    function delete_event_schedule_package($id_schedule_package)
    {
        $this->db->where('id_schedule_pack', $id_schedule_package);
        $this->db->delete('schedule_package');
    }

    public function getData_schedule_theory($id_schedule_theory = null, $id_parent = null, $periode = null, $id_student = null, $id_teacher = null)
    {
        $this->db->select('sc.*, s.name_student, s.parent_student, s.id_parent, t.name_teacher');
        $this->db->from('schedule_theory as sc');
        $this->db->join('student as s', 'sc.id_student = s.id_student', 'left');
        $this->db->join('teacher as t', 'sc.id_teacher = t.id_teacher', 'left');
        $this->db->where('s.status', '1');
        if ($id_schedule_theory != null) {
            $this->db->where('id_schedule_theory', $id_schedule_theory);
        }
        if ($id_parent != null) {
            $this->db->where('s.id_parent', $id_parent);
        }
        if ($periode != null) {
            $this->db->like('sc.date', "$periode");
        }
        if ($id_student != null) {
            $this->db->where('sc.id_student', "$id_student");
        }
        if ($id_teacher != null) {
            $this->db->where('sc.id_teacher', $id_teacher);
        }
        return $this->db->get()->result_array();
    }

    public function getData_schedule_theory_idcourse($id_teacher, $periode)
    {
        $this->db->select('sc.*, s.name_student');
        $this->db->from('schedule_theory as sc');
        $this->db->join('student as s', 'sc.id_student = s.id_student', 'left');
        $this->db->where('sc.id_teacher', $id_teacher);
        $this->db->like('sc.date', "$periode");
        $this->db->order_by('id_course', 'ASC');
        $this->db->order_by('date', 'ASC');
        return $this->db->get()->result_array();
    }

    public function getData_schedule_theory_idcourse_before($id_course, $periode)
    {
        $temp = $periode . "-01";
        $this->db->select('sc.*, s.name_student');
        $this->db->from('schedule_theory as sc');
        $this->db->join('student as s', 'sc.id_student = s.id_student', 'left');
        $this->db->where('sc.id_course', $id_course);
        $this->db->where('sc.date <', "$temp");
        return $this->db->get()->result_array();
    }

    public function getData_schedule_pratical($id_schedule_online = null, $id_parent = null, $periode = null, $id_student = null, $id_teacher = null)
    {
        $this->db->select('sc.*, s.name_student, s.parent_student, s.id_parent, t.name_teacher');
        $this->db->from('schedule_online as sc');
        $this->db->join('student as s', 'sc.id_student = s.id_student', 'left');
        $this->db->join('teacher as t', 'sc.id_teacher = t.id_teacher', 'left');
        $this->db->where('sc.status', '2');
        if ($id_schedule_online != null) {
            $this->db->where('id_schedule_online', $id_schedule_online);
        }
        if ($id_parent != null) {
            $this->db->where('s.id_parent', $id_parent);
        }
        if ($periode != null) {
            $this->db->like('sc.date', "$periode");
        }
        if ($id_student != null) {
            $this->db->where('sc.id_student', "$id_student");
        }
        if ($id_teacher != null) {
            $this->db->where('sc.id_teacher', $id_teacher);
        }
        return $this->db->get()->result_array();
    }

    public function getData_schedule_pratical_idcourse($id_teacher, $periode)
    {
        $this->db->select('sc.*, s.name_student, op.rate, op.instrument');
        $this->db->from('schedule_online as sc');
        $this->db->join('student as s', 'sc.id_student = s.id_student', 'left');
        $this->db->join('pack_online as op', 'sc.id_pack = op.id_pack', 'left');
        $this->db->where('sc.id_teacher', $id_teacher);
        $this->db->where('sc.status', '2');
        $this->db->like('sc.date', "$periode");
        $this->db->order_by('id_pack', 'ASC');
        $this->db->order_by('date', 'ASC');
        return $this->db->get()->result_array();
    }

    public function getData_schedule_pratical_idcourse_before($id_pack = null, $periode, $jenis, $id_teacher = null, $id_student = null)
    {
        $temp = $periode . "-01";
        $this->db->select('sc.*, s.name_student');
        $this->db->from('schedule_online as sc');
        $this->db->join('student as s', 'sc.id_student = s.id_student', 'left');
        $this->db->where('sc.status', '2');
        $this->db->where('sc.jenis', $jenis);
        if ($id_pack != null) {
            $this->db->where('sc.id_pack', $id_pack);
        }
        if ($id_teacher != null) {
            $this->db->where('sc.id_teacher', $id_teacher);
        }
        if ($id_student != null) {
            $this->db->where('sc.id_student', $id_student);
        }
        $this->db->where('sc.date <', "$temp");
        return $this->db->get()->result_array();
    }

    public function getData_schedule_package_teacher($id_schedule_pack = null, $id_parent = null, $periode = null, $id_student = null, $id_teacher = null, $status = null, $jenis = null)
    {
        $this->db->select('sc.*, s.name_student, s.parent_student, s.id_parent, t.name_teacher');
        $this->db->from('schedule_package as sc');
        $this->db->join('student as s', 'sc.id_student = s.id_student', 'left');
        $this->db->join('teacher as t', 'sc.id_teacher = t.id_teacher', 'left');
        if ($id_schedule_pack != null) {
            $this->db->where('id_schedule_pack', $id_schedule_pack);
        }
        if ($id_parent != null) {
            $this->db->where('s.id_parent', $id_parent);
        }
        if ($periode != null) {
            if ($status == 2 || $status == 4) {
                $this->db->like('sc.date_schedule', "$periode");
            }
            if ($status == 3) {
                $this->db->like('sc.date_update_cancel', "$periode");
            }
        }
        if ($status != null) {
            $this->db->where('sc.status', $status);
        }
        if ($id_student != null) {
            $this->db->where('sc.id_student', "$id_student");
        }
        if ($id_teacher != null) {
            $this->db->where('sc.id_teacher', $id_teacher);
        }
        if ($jenis != null) {
            $this->db->where('sc.jenis', $jenis);
        }
        return $this->db->get()->result_array();
    }

    public function getData_schedule_package_idcourse($id_teacher, $periode, $status = null)
    {
        $this->db->select('sc.*, s.name_student, op.rate, op.rate_dollar, op.instrument');
        $this->db->from('schedule_package as sc');
        $this->db->join('student as s', 'sc.id_student = s.id_student', 'left');
        $this->db->join('list_package as op', 'sc.id_list_pack = op.id_list_pack', 'left');
        $this->db->where('sc.id_teacher', $id_teacher);
        if ($status != null) {
            $this->db->where('sc.status', $status);
            if ($status == 2 || $status == 4) {
                $this->db->like('sc.date_schedule', "$periode");
                $this->db->order_by('date_schedule', 'ASC');
            }
            if ($status == 3) {
                $this->db->like('sc.date_update_cancel', "$periode");
                $this->db->order_by('date_update_cancel', 'ASC');
            }
        }
        // $this->db->where('sc.status', '2');
        // $this->db->like('sc.date', "$periode");
        $this->db->order_by('id_list_pack', 'ASC');

        return $this->db->get()->result_array();
    }

    public function getData_schedule_package_idcourse_before($id_pack = null, $periode, $jenis, $id_teacher = null, $id_student = null)
    {
        $temp = $periode . "-01";
        $this->db->select('sc.*, s.name_student');
        $this->db->from('schedule_package as sc');
        $this->db->join('student as s', 'sc.id_student = s.id_student', 'left');
        $this->db->where('sc.status', '2');
        $this->db->where('sc.jenis', $jenis);
        if ($id_pack != null) {
            $this->db->where('sc.id_pack', $id_pack);
        }
        if ($id_teacher != null) {
            $this->db->where('sc.id_teacher', $id_teacher);
        }
        if ($id_student != null) {
            $this->db->where('sc.id_student', $id_student);
        }
        $this->db->where('sc.date <', "$temp");
        return $this->db->get()->result_array();
    }

    public function getData_payment_date($periode = null, $id_parent = null, $tipe = null, $no_sirkulasi = null)
    {
        $this->db->select('*');
        $this->db->from('payment_date');
        if ($periode != null) {
            $this->db->where('periode', $periode);
        }
        if ($id_parent != null) {
            $this->db->where('id_parent', $id_parent);
        }
        if ($tipe != null) {
            $this->db->where('tipe', $tipe);
        }
        if ($no_sirkulasi != null) {
            $this->db->where('no_sirkulasi', $no_sirkulasi);
        }
        return $this->db->get()->result_array();
    }

    public function addDataDatePayment($periode, $id_parent, $date)
    {
        $data =  [
            'periode' => $periode,
            'id_parent' => $id_parent,
            'date' => $date,
        ];
        $this->db->insert('payment_date', $data);
        return true;
    }

    public function updateDataDatePayment($id_payment, $date)
    {
        $data =  [
            'date' => $date,
        ];

        $this->db->update('payment_date', $data, ['id_payment' => $id_payment]);
        return true;
    }

    public function getData_ConvertDollar($id = null, $periode = null)
    {
        $this->db->from('convert_dollar');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        if ($periode != null) {
            $this->db->where('use_to', $periode);
        }
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $data = $this->db->get();
        return $data->result_array();
    }

    public function getData_ConvertEuro($id = null, $periode = null)
    {
        $this->db->from('convert_euro');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        if ($periode != null) {
            $this->db->where('use_to', $periode);
        }
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $data = $this->db->get();
        return $data->result_array();
    }

    public function updateDataConvert($db)
    {
        $name_db = "convert_" . $db;
        $created_at = date("Y-m-d");
        $end_at = NULL;

        $temp = [];
        if ($db == "dollar") {
            $temp = $this->getData_ConvertDollar(null, $this->input->post('periode'));
        } else {
            $temp = $this->getData_ConvertEuro(null, $this->input->post('periode'));
        }
        if (count($temp) > 0) {
            $data =  [
                'end_at' => $created_at,
                'updated_by' => $this->session->userdata('id'),
            ];
            $this->db->update($name_db, $data, ['id' => $temp[0]['id']]);
        }

        $data =  [
            'value' => $this->input->post('value'),
            'use_to' => $this->input->post('periode'),
            'created_at' => $created_at,
            'end_at' => $end_at,
            'created_by' => $this->session->userdata('id'),
        ];
        $this->db->insert($name_db, $data);


        return true;
    }

    public function updateCurrencyParent()
    {
        $data =  [
            'currency' => $this->input->post('currency'),
        ];
        $this->db->update('student', $data, ['id_parent' => $this->input->post('id_parent')]);
        return true;
    }

    public function getData_sirkulasi_lesson($id_sirkulasi_lesson = null, $no_sirkulasi_lesson = null, $id_teacher = null, $tipe = null)
    {
        $this->db->from('sirkulasi_lesson as sl');
        if ($id_sirkulasi_lesson != null) {
            $this->db->where('id_sirkulasi_lesson', $id_sirkulasi_lesson);
        }
        if ($no_sirkulasi_lesson != null) {
            $this->db->where('no_sirkulasi_lesson', $no_sirkulasi_lesson);
        }
        if ($id_teacher != null) {
            $this->db->where('t.status', '1');
            $this->db->where('t.id_teacher', $id_teacher);
        }
        if ($tipe != null) {
            $this->db->where('sl.tipe', $tipe);
        }
        return $this->db->get()->result_array();
    }

    public function getData_sirkulasi_lesson_detail($id_sirkulasi_lesson_detail = null, $no_sirkulasi_lesson = null, $id_teacher = null, $id_student = null, $tipe = null, $periode = null, $rate = null, $id_list_pack = null, $id_list_package_offline = null)
    {
        if ($id_list_pack != null) {
            $this->db->select('sl.*, t.name_teacher, s.name_student, p.name as name_paket,  s.teacher_percentage, s.is_new, lp.rate_dollar, p.price_idr, p.status_pack_theory, p.status_pack_practical');
            $this->db->join('list_package as lp', 'sl.id_list_pack = lp.id_list_pack', 'left');
            $this->db->where('sl.id_list_pack', $id_list_pack);
        } else {
            $this->db->select('sl.*, t.name_teacher, s.name_student, p.name as name_paket,  s.teacher_percentage, s.is_new, p.price_idr, p.status_pack_theory, p.status_pack_practical');
        }


        $this->db->from('sirkulasi_lesson_detail as sl');

        $this->db->join('student as s', 'sl.id_student = s.id_student', 'left');
        $this->db->join('teacher as t', 'sl.id_teacher = t.id_teacher', 'left');
        $this->db->join('paket as p', 'sl.paket = p.id', 'left');


        if ($id_sirkulasi_lesson_detail != null) {
            $this->db->where('id_sirkulasi_lesson_detail', $id_sirkulasi_lesson_detail);
        }

        if ($no_sirkulasi_lesson != null) {
            $this->db->where('no_sirkulasi_lesson', $no_sirkulasi_lesson);
        }

        if ($tipe != null) {
            $this->db->where('sl.tipe', $tipe);
        }
        if ($rate != null) {
            $this->db->where('sl.rate', $rate);
        }

        if ($id_list_package_offline != null) {
            $this->db->where('sl.id_list_package_offline', $id_list_package_offline);
        }

        if ($periode != null) {
            $this->db->like('sl.lesson_date', "$periode");
        }

        if ($id_student != null) {
            $this->db->where('s.id_student', $id_student);
            $this->db->where('s.status', '1');
        }

        if ($id_teacher != null) {
            $this->db->where('t.status', '1');
            $this->db->where('t.id_teacher', $id_teacher);
        }

        $this->db->order_by('sl.lesson_date', 'ASC');
        return $this->db->get()->result_array();
    }

    public function getData_sirkulasi_lesson_detail_before_periode($id_sirkulasi_lesson_detail = null, $no_sirkulasi_lesson = null, $id_teacher = null, $id_student = null, $tipe = null, $periode = null, $rate = null, $id_list_pack = null, $id_list_package_offline = null)
    {
        $this->db->select('sl.*, t.name_teacher, s.name_student, p.name as name_paket ,  s.teacher_percentage');

        $this->db->from('sirkulasi_lesson_detail as sl');
        $this->db->join('student as s', 'sl.id_student = s.id_student', 'left');
        $this->db->join('teacher as t', 'sl.id_teacher = t.id_teacher', 'left');
        $this->db->join('paket as p', 'sl.paket = p.id', 'left');

        if ($id_sirkulasi_lesson_detail != null) {
            $this->db->where('id_sirkulasi_lesson_detail', $id_sirkulasi_lesson_detail);
        }

        if ($no_sirkulasi_lesson != null) {
            $this->db->where('no_sirkulasi_lesson', $no_sirkulasi_lesson);
        }

        if ($tipe != null) {
            $this->db->where('sl.tipe', $tipe);
        }
        if ($rate != null) {
            $this->db->where('sl.rate', $rate);
        }
        if ($id_list_pack != null) {
            $this->db->where('sl.id_list_pack', $id_list_pack);
        }
        if ($id_list_package_offline != null) {
            $this->db->where('sl.id_list_package_offline', $id_list_package_offline);
        }

        if ($periode != null) {
            if (substr('sl.lesson_date', 0, 10) != "0000-00-00") {
                $temp_period = $periode . "-01";
                $this->db->where('sl.lesson_date <', "$temp_period");
            }
        }

        if ($id_student != null) {
            $this->db->where('s.id_student', $id_student);
            $this->db->where('s.status', '1');
        }

        if ($id_teacher != null) {
            $this->db->where('t.status', '1');
            $this->db->where('t.id_teacher', $id_teacher);
        }

        $this->db->order_by('sl.lesson_date', 'ASC');
        return $this->db->get()->result_array();
    }

    public function getData_sirkulasi_feereport($id_sirkulasi_feereport = null, $no_sirkulasi_feereport = null, $status_approved = null, $periode = null, $id_teacher = null)
    {
        $this->db->select('s.*, t.name_teacher, t.instrument');
        $this->db->from('sirkulasi_feereport as s');
        $this->db->join('teacher as t', 's.id_teacher = t.id_teacher', 'left');
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
        if ($periode != null) {
            $this->db->like('created_at', $periode);
        }
        if ($id_teacher != null) {
            $this->db->where('s.id_teacher', $id_teacher);
        }
        return $this->db->get()->result_array();
    }

    public function getData_sirkulasi_feereport_detail($id = null, $no_sirkulasi_feereport = null, $tipe = null, $id_barang = null)
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
        if ($id_barang != null) {
            $this->db->like('id_barang', $id_barang);
        }
        return $this->db->get()->result_array();
    }

    public function insertDataOtherFeereportNew()
    {
        $counter = $this->input->post('counter');
        $data =  [
            'id_teacher' => $this->input->post('id_teacher'),
            'periode' => $this->input->post('periode'),
            'other_category' => '',
            'other_note' => '',
            'other_price' => '0',
        ];
        $this->db->insert('other_feereport', $data);
        return true;
    }

    public function getData_discount($id_discount = null, $for_discount = null)
    {
        $this->db->select('*');
        $this->db->from('discount_coupon');
        if ($id_discount != null) {
            $this->db->where('id_discount', $id_discount);
        }
        if ($for_discount != null) {
            $this->db->where('for_discount', $for_discount);
        }
        $this->db->where('status', 1);
        $data = $this->db->get();
        return $data->result_array();
    }

    public function getData_ohter_offline_lesson_discount($id = null, $no_transaksi = null, $id_parent = null, $periode = null)
    {
        $this->db->select('*, dc.detail_discount, dc.value_discount, dc.jenis_discount');
        $this->db->from('other_offline_lesson_discount as od');
        $this->db->join('discount_coupon as dc', 'od.id_discount = dc.id_discount', 'left');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        if ($no_transaksi != null) {
            $this->db->where('no_transaksi', $no_transaksi);
        }
        if ($id_parent != null) {
            $this->db->where('id_parent', $id_parent);
        }
        if ($periode != null) {
            $this->db->where('periode', $periode);
        }
        $data = $this->db->get();
        return $data->result_array();
    }

    public function insertDataDiscount()
    {
        $detail_jenis = "percentage";
        if ($this->input->post('jenis_discount') == "2") {
            $detail_jenis = "nominal";
        }
        $data =  [
            'name_discount' => $this->input->post('name_discount'),
            'for_discount' => $this->input->post('for_discount'),
            'jenis_discount' => $this->input->post('jenis_discount'),
            'detail_jenis' => $detail_jenis,
            'value_discount' => $this->input->post('value_discount'),
            'detail_discount' => $this->input->post('detail_discount'),
        ];
        $this->db->insert('discount_coupon', $data);

        return true;
    }

    public function deleteDataFeeReport($no_sirkulasi)
    {
        $this->db->delete('sirkulasi_feereport_detail', ['no_sirkulasi_feereport' => $no_sirkulasi]);
        $this->db->delete('sirkulasi_feereport', ['no_sirkulasi_feereport' => $no_sirkulasi]);
        return true;
    }
}
