<?php
include_once('MSQL.php');


//
// �������� ���������� ��������� ��������
//
class M_Starosta
{
	private static $instance; 	// ������ �� ��������� ������
	private $msql; 				// ������� ��	
		
	//
	// ��������� ������������� ���������� (��������)
	//
	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new M_Starosta();
		
		return self::$instance;
	}

	//
	// �����������
	//
	public function __construct()
	{
		$this->msql   = MSQL::Instance();
	}
	
	//
	// ������� ������� ��������������
	//
	public function all_odnogrup($starosta){
		return  $this->msql->Select("SELECT * FROM users WHERE person='$starosta'");
	}
	
	//
	// ������� �������� ���������� ������������ ����������
	//
	public function count_not($grup){
		return  count($this->msql->Select("SELECT * FROM starosta_notification WHERE grup='$grup'"));
	}
  
	//
	// ������� ������� ���x ������������ ���������
	//
	public function all_notif($grup){
		return  $this->msql->Select("SELECT * FROM starosta_notification WHERE grup='$grup'");
 
	}
	
    //
	// ������� ���������� �������� � ��.
	//
	public function add_notif($object) {
	  
		if($this->msql->Insert('starosta_notification',$object)){
			return true;
		}
		else{
			return false;
		};
	}

	
}
