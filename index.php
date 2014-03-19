<?php
include_once('model/startup.php');
include_once('controller/C_Login.php');
include_once('controller/C_Reg.php');
include_once('controller/C_Restore.php');
include_once('controller/C_VKSmsRasp.php');//
include_once('controller/C_Setting.php');//
include_once('controller/C_Rasp.php');//
include_once('controller/C_EditBlog.php');
include_once('controller/C_Blog.php');
include_once('controller/C_Starosta.php');
include_once('controller/C_Sender.php');
include_once('controller/C_IncMes.php');
include_once('controller/C_NotifAll.php');
include_once('controller/C_Events.php');
include_once('controller/C_VK.php');
include_once('controller/C_Comment.php');
error_reporting(0);
// �������������.
startup();

// ����� �����������.
switch ($_GET['c'])
{
//����������� ������������
case 'login':
	$controller = new C_Login();
	break;
//����������� ������������
case 'reg':
	$controller = new C_Reg();
	break;
//���������� �������
case 'rasp':
	$controller = new C_Rasp();
	break;
//������������� ������
case 'restore':
	$controller = new C_Restore();
	break;
//������� ������������
case 'setting':
	$controller = new C_Setting();
	break;
	//������� ������������
case 'starosta':
	$controller = new C_Starosta();
	break;
case 'sms_vk_rasp':
	$controller = new C_VKSmsRasp();
	break;
case 'edit_blog':
	$controller = new C_EditBlog();
	break;
case 'blog':
	$controller = new C_Blog();
	break;
case 'mailing':
	$controller = new C_Sender();
	break;
case 'inc_mes':
	$controller = new C_IncMes();
	break;
case 'notif_all':
	$controller = new C_NotifAll();
	break;
case 'events':
	$controller = new C_Events();
	break;
case 'vk_mailing':
	$controller = new C_VK();
	break;
case 'comment':
	$controller = new C_Comment();
	break;
default:
	$controller = new C_Rasp();
}

// ��������� �������.
$controller->Request();
