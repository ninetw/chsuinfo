<?php
include_once("class.php");
include_once("config.php");

//��������� ��������� ������
$pars=new Parsesr_html($dbhost,$dbuser,$dbpas);



//C�������� �������� �� ������� �������� � ���� ��� ��, ������� �� � ����
if ($html=$pars->download_html($http_prepod, false, ''))
{
	if($pars->verify_html($html))
	{
		$pars->truncate('lecturer');
		$pars->pars_html($html, 'lecturer', 'name_lecturer');
	}
}
else
{
	echo "������ �������� ������ ��������<br/>";
}

//C�������� �������� �� ������� ���� � ���� ��� ��, ������� �� � ����
if ($html=$pars->download_html($http_rasp, false, ''))
{
	if($pars->verify_html($html))
	{
		$pars->truncate('grup');
		$pars->pars_html($html ,'grup','title_grup');
	}
}
else
{
	echo "������ �������� ������ �����<br/>";
}
$array_pr=$pars->pr_gr('lecturer','name_lecturer');
$array_gr=$pars->pr_gr('grup','title_grup');

//�������
for ($semestr=1;$semestr<=2;$semestr++)
{




foreach($array_gr as $value) 
{
	//��������� �������� ���� �� ����������� �� �������� false
	$html=$pars->download_html($http_rasp, true, "&gr=$value&ss=$semestr&mode=���������� �������");
	$vh=$pars->verify_html($html);	
	if ($html && $vh)
	{
		
		$pars->delete('schedule_gr',$value,$semestr);
		$pars->parser_rasp($html,'schedule_gr',$value,$semestr);
		
	}
	else
	{
		echo "�� ������� ��������� ���������� ��� ".$value."<br/>";
	}
}
	
foreach($array_pr as $value)
{
	$html=$pars->download_html($http_prepod, true, "&pr=$value&sss=$semestr&mode=���������� �������");
	$vh=$pars->verify_html($html);	
	if ($html && $vh)
	{
		$pars->delete('schedule_pr',$value,$semestr);
		$pars->parser_rasp($html,'schedule_pr',$value,$semestr);
		
	}
	else
	{
		echo "�� ������� ��������� ���������� ��� ".$value."<br/>";
	}
}

}

	echo "End....";
?>