<?php
include_once("class_exam.php");
include_once("config.php");

//��������� ��������� ������
$pars=new Parsesr_html($dbhost,$dbuser,$dbpas);



//C�������� �������� �� ������� �������� � ���� ��� ��, ������� �� � ����
if ($html=$pars->download_html($http_prepod, false, '')){
	$pars->truncate('lecturer');
	$pars->pars_html($html, 'lecturer', 'name_lecturer');
}
else{
	echo "������ �������� ������ ��������<br/>";
}

//C�������� �������� �� ������� ���� � ���� ��� ��, ������� �� � ����
if ($html=$pars->download_html($http_rasp, false, '')){
	$pars->truncate('grup');
	$pars->pars_html($html ,'grup','title_grup');
}
else{
	echo "������ �������� ������ �����<br/>";
}
$array_pr=$pars->pr_gr('lecturer','name_lecturer');
$array_gr=$pars->pr_gr('grup','title_grup');

//�������
$i=1;
$r=0;


foreach($array_pr as $value) 
	{

		if ($html=$pars->download_html($http_prepod, true, "&pr=$value&sss=$i&mode=���������� ���������"))
		{
			$pars->delete('exam_lecturer',$value);
			$pars->parser_exam($html,'exam_lecturer',$value);
		}
		else
		{
			echo "�� ������� ��������� ���������� ��� ".$value."<br/>";
		}
		
	}

foreach($array_gr as $value) 
	{
		
		if ($html=$pars->download_html($http_rasp, true, "&gr=$value&ss=$i&mode=���������� ���������"))
		{
			$pars->delete('exam_students',$value);
			$pars->parser_exam($html,'exam_students',$value);
		}
		else
		{
			echo "�� ������� ��������� ���������� ��� ".$value."<br/>";
		}
		
	}





	

	




	echo "End1....";
?>