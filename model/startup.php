<?php

function startup()
{
	// ��������� ����������� � ��.
	$hostname = 'a53069.mysql.mchost.ru';	
	$username = 'a53069_study'; 
	$password = 'studypas';
	$dbName   = 'a53069_study';
	
	// �������� ���������.
	setlocale(LC_ALL, 'ru_RU.CP1251');	
	
	// ����������� � ��.
	mysql_connect($hostname, $username, $password) or die('No connect with data base'); 
	mysql_query('SET NAMES cp1251');
	mysql_select_db($dbName) or die('No data base');
	
	
	
	//��������� ����������� � ��������
	// id ����������
	define("LOGIN", "79517498329");
	// ���������� ����
	define("PASSWORD", "4780sd");
	// id ����������
	define("CLIENT_ID", "4242336");
	// ���������� ����
	define("SECRET", "s8AbTjmmbw7vostF77v4");
	// ���� ������������ ������������ ����� �����������
	define("OAUTH_CALLBACK", "index.php?c=login");
	// ��������� �������
	define("SCOPE", "friends");
	// ���� � ����� �� ���������
	define("PATH", "http://new.chsuinfo.ru/");
	
	
	define("THEME", "/red2014");
	
	

	// �������� ������.
	
	session_start();		
}
