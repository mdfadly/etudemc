<?php
defined('BASEPATH') or exit('No direct script access allowed');

//portal
$route['portal'] = 'portal/C_Portal/index';
$route['portal/user-logout'] = 'portal/C_Portal/logout';
$route['portal/user-login'] = 'portal/C_Portal/login';
$route['portal/user-forgotPassword'] = 'portal/C_Portal/forgot_password';
$route['portal/user-register'] = 'portal/C_Portal/register';

//Teacher
$route['portal/profile/(:any)'] = 'portal/C_Teacher/profile/$1';
$route['portal/profile/edit/(:any)'] = 'portal/C_Teacher/edit_profile/$1';

$route['portal/offline_lesson'] = 'portal/C_Teacher/offline_lesson';
// $route['portal/offline_lesson/attendance/(:any)'] = 'portal/C_Teacher/attendance_offline_lesson/$1';
$route['portal/offline_lesson/note/(:any)'] = 'portal/C_Teacher/note/$1';
$route['portal/offline_lesson/note/add/(:any)'] = 'portal/C_Teacher/addnote/$1';
$route['portal/offline_lesson/note/update/(:any)'] = 'portal/C_Teacher/updatenote/$1';
$route['portal/offline_lesson/attendance/(:any)'] = 'portal/C_Teacher/attendance_offline_lesson_package/$1';

$route['portal/online_pratical'] = 'portal/C_Teacher/online_pratical';
$route['portal/online_pratical/attendance/(:any)/(:any)'] = 'portal/C_Teacher/attendance_online_pratical/$1/$2';
$route['portal/online_pratical/note/(:any)'] = 'portal/C_Teacher/note/$1';
$route['portal/online_pratical/note/add/(:any)'] = 'portal/C_Teacher/addnote/$1';
$route['portal/online_pratical/note/update/(:any)'] = 'portal/C_Teacher/updatenote/$1';

$route['portal/online_theory'] = 'portal/C_Teacher/online_theory';
$route['portal/online_theory/attendance/(:any)'] = 'portal/C_Teacher/attendance_online_theory/$1';
$route['portal/online_theory/attendance/(:any)/(:any)'] = 'portal/C_Teacher/attendance_online_pratical/$1/$2';
$route['portal/online_theory/note/(:any)'] = 'portal/C_Teacher/note/$1';
$route['portal/online_theory/note/add/(:any)'] = 'portal/C_Teacher/addnote/$1';
$route['portal/online_theory/note/update/(:any)'] = 'portal/C_Teacher/updatenote/$1';

$route['portal/offline_trial'] = 'portal/C_Teacher/offline_trial';

$route['portal/attendance_summary'] = 'portal/C_Teacher/attendance_summary';

$route['portal/fee_report/(:any)'] = 'portal/C_Teacher/fee_report/$1';

$route['portal/event_teacher'] = 'portal/C_Teacher/event';
$route['portal/event_teacher/add/(:any)'] = 'portal/C_Teacher/add_event/$1';
$route['portal/event_teacher/edit/(:any)'] = 'portal/C_Teacher/edit_event/$1';

//Admin
$route['portal/discount'] = 'portal/C_Admin/data_discount';
$route['portal/discount/add'] = 'portal/C_Admin/add_discount';

$route['portal/data_parent'] = 'portal/C_Admin/data_parent';
$route['portal/data_parent/detail/(:any)'] = 'portal/C_Admin/detail_parent/$1';
$route['portal/data_parent/add'] = 'portal/C_Admin/add_parent';

$route['portal/data_student'] = 'portal/C_Admin/data_student';
$route['portal/data_student/detail/(:any)'] = 'portal/C_Admin/detail_student/$1';
$route['portal/data_student/add/(:any)'] = 'portal/C_Admin/add_student/$1';
$route['portal/data_student/edit/(:any)'] = 'portal/C_Admin/edit_student/$1';

$route['portal/data_teacher'] = 'portal/C_Admin/data_teacher';

$route['portal/data_paket'] = 'portal/C_Admin/data_paket';
$route['portal/data_paket/add'] = 'portal/C_Admin/add_paket';
$route['portal/data_paket/edit/(:any)'] = 'portal/C_Admin/edit_paket/$1';

$route['portal/data_offline_lesson'] = 'portal/C_Admin/data_offline_lesson';
$route['portal/data_offline_lesson/add'] = 'portal/C_Admin/add_offline_lesson';
$route['portal/data_offline_lesson/edit/(:any)'] = 'portal/C_Admin/edit_offline_lesson/$1';
$route['portal/data_offline_lesson/package/calendar/(:any)'] = 'portal/C_Admin/package_calendar_offline/$1';

$route['portal/data_online_lesson'] = 'portal/C_Admin/data_online_pratical';
$route['portal/data_online_lesson/add'] = 'portal/C_Admin/add_online_pratical';
$route['portal/data_online_lesson/edit/(:any)'] = 'portal/C_Admin/edit_online_pratical/$1';
$route['portal/data_online_lesson/package/calendar/(:any)'] = 'portal/C_Admin/package_calendar/$1';

// $route['portal/data_online_lesson/package'] = 'portal/C_Admin/data_online_pratical_package';

$route['portal/data_theory_lesson'] = 'portal/C_Admin/data_online_theory';
$route['portal/data_theory_lesson/add'] = 'portal/C_Admin/add_online_theory';
$route['portal/data_theory_lesson/edit/(:any)'] = 'portal/C_Admin/edit_online_theory/$1';

$route['portal/book'] = 'portal/C_Admin/book';
$route['portal/book/add'] = 'portal/C_Admin/add_book';
$route['portal/book/edit/(:any)'] = 'portal/C_Admin/edit_book/$1';
$route['portal/book/sell'] = 'portal/C_Admin/book_order';
$route['portal/book/sell/add'] = 'portal/C_Admin/add_book_order';
$route['portal/book/sell/edit/(:any)'] = 'portal/C_Admin/edit_book_order/$1';
$route['portal/book/input'] = 'portal/C_Admin/book_purchase';
$route['portal/book/input/add'] = 'portal/C_Admin/add_book_purchase';
$route['portal/book/input/edit/(:any)'] = 'portal/C_Admin/edit_book_purchase/$1';

$route['portal/note'] = 'portal/C_Admin/note';
$route['portal/note/(:any)'] = 'portal/C_Admin/note_periode/$1';
$route['portal/note/(:any)/(:any)'] = 'portal/C_Admin/note_teacher/$1/$2';

// $route['portal/invoice'] = 'portal/C_Admin/data_invoice';
$route['portal/invoice'] = 'portal/C_Admin/data_invoice_purchase';
$route['portal/invoice/parent/(:any)'] = 'portal/C_Admin/data_invoice_periode/$1';
$route['portal/invoice/view/(:any)/(:any)'] = 'portal/C_Admin/data_invoice_view/$1/$2';
$route['portal/invoice/etude/(:any)/(:any)'] = 'portal/C_Admin/data_invoice_view_parent/$1/$2';
$route['portal/invoice/summary/(:any)'] = 'portal/C_Admin/data_invoice_summary/$1';

$route['portal/invoice/purchase/etude/(:any)'] = 'portal/C_Admin/detail_invoice_purchase_parent/$1';
$route['portal/invoice/periode/(:any)/(:any)'] = 'portal/C_Admin/detail_invoice_periode_transaksi_parent/$1/$2';

// $route['portal/invoice/offline'] = 'portal/C_Admin/data_invoice_offline';
// $route['portal/invoice/summary/offline/(:any)'] = 'portal/C_Admin/data_invoice_summary_offline/$1';

// $route['portal/invoice/online'] = 'portal/C_Admin/data_invoice_online';
// $route['portal/invoice/summary/online/(:any)'] = 'portal/C_Admin/data_invoice_summary_online/$1';

$route['portal/feereport'] = 'portal/C_Admin/data_feereport_new';
$route['portal/feereport/teacher/(:any)'] = 'portal/C_Admin/data_feereport_periode_new/$1';
$route['portal/feereport/view/(:any)/(:any)'] = 'portal/C_Admin/data_feereport_view_new/$1/$2';
$route['portal/feereport/summary/(:any)'] = 'portal/C_Admin/data_feereport_summary/$1';

// $route['portal/feereport/offline'] = 'portal/C_Admin/data_feereport_offline';
// $route['portal/feereport/summary/offline/(:any)'] = 'portal/C_Admin/data_feereport_summary_offline/$1';

// $route['portal/feereport/online'] = 'portal/C_Admin/data_feereport_online';
// $route['portal/feereport/summary/online/(:any)'] = 'portal/C_Admin/data_feereport_summary_online/$1';

$route['portal/event'] = 'portal/C_Admin/event';
$route['portal/event/add'] = 'portal/C_Admin/add_event';
$route['portal/event/edit/(:any)'] = 'portal/C_Admin/edit_event/$1';

$route['portal/event/teacher'] = 'portal/C_Admin/event_teacher';
$route['portal/event/teacher/add'] = 'portal/C_Admin/add_event_teacher';

$route['portal/event/student'] = 'portal/C_Admin/event_student';
// $route['portal/event/student/add'] = 'portal/C_Admin/add_event_student';
$route['portal/event/student/add/(:any)'] = 'portal/C_Admin/add_event_student/$1';
$route['portal/event/student/edit/(:any)'] = 'portal/C_Admin/edit_event_student/$1';

$route['portal/convert'] = 'portal/C_Admin/convert';

$route['portal/islogout/(:any)/(:any)'] = 'portal/C_Portal/change_status_login/$1/$2';

$route['portal/profile-parent/(:any)'] = 'portal/C_Parent/profile/$1';
$route['portal/profile-parent/detail/(:any)'] = 'portal/C_Parent/detail_parent/$1';
$route['portal/profile-parent/edit/(:any)'] = 'portal/C_Parent/edit_parent/$1';
$route['portal/profile-parent/student/(:any)'] = 'portal/C_Parent/detail_student/$1';
$route['portal/profile-parent/student/edit/(:any)'] = 'portal/C_Parent/edit_student/$1';
$route['portal/profile-parent/student/add/(:any)'] = 'portal/C_Parent/add_student/$1';

$route['portal/offline-lesson'] = 'portal/C_Parent/offline_lesson';
$route['portal/offline-lesson/list/(:any)'] = 'portal/C_Parent/offline_lesson_list/$1';
$route['portal/offline-lesson/calendar/(:any)'] = 'portal/C_Parent/offline_lesson_calendar/$1';

$route['portal/online-pratical'] = 'portal/C_Parent/online_pratical';
$route['portal/online-pratical/list/(:any)'] = 'portal/C_Parent/online_pratical_list/$1';
$route['portal/online-pratical/calendar/(:any)/(:any)'] = 'portal/C_Parent/online_pratical_calendar/$1/$2';

$route['portal/online-theory'] = 'portal/C_Parent/online_theory';
$route['portal/online-theory/list/(:any)'] = 'portal/C_Parent/online_theory_list/$1';
$route['portal/online-theory/calendar/(:any)/(:any)'] = 'portal/C_Parent/online_pratical_calendar/$1/$2';

$route['portal/invoice-student'] = 'portal/C_Parent/data_invoice';
$route['portal/invoice-student/list/(:any)'] = 'portal/C_Parent/data_invoice_list/$1';

$route['portal/repository-student'] = 'portal/C_Parent/data_repository';

$route['portal/order-book'] = 'portal/C_Parent/notfound';
// $route['portal/order-book'] = 'portal/C_Parent/data_book';
$route['portal/order-book/student'] = 'portal/C_Parent/data_order_book';
$route['portal/join-event'] = 'portal/C_Parent/notfound';
// $route['portal/join-event'] = 'portal/C_Parent/data_event';
$route['portal/join-event/student'] = 'portal/C_Parent/data_event_student';
$route['portal/join-event/student/regist'] = 'portal/C_Parent/add_event_student';

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
