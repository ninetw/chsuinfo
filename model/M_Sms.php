<?php
include_once('MSQL.php');

//
// �������� �������� ��� ���������
//
class M_Sms
{
	private static $instance; 	// ������ �� ��������� ������
	private $msql; 				// ������� ��
	
	//
	// ��������� ������������� ���������� (��������)
	//
	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new M_Sms();
		
		return self::$instance;
	}

	//
	// �����������
	//
	public function __construct(){
		$this->msql   = MSQL::Instance();
	}
    
	//
	// ������� ������� ���
	///
	public function sendArraySms($arraySms){
		$apikey = 'V5MT4Y7HF55N5SJ2QV926QT8JKE7RI02K8SR1U2X1NFAU995JQ345LXJQI1TS89A'; // �������� �� ����!
		$send = array(
				'apikey' => $apikey,
				'send' => $arraySms
		);
		$result = file_get_contents('http://smspilot.ru/api2.php', false, stream_context_create(array(
		'http' => array(
			'method' => 'POST',
			'header' => "Content-Type: application/json\r\n",
			'content' => json_encode( $send ),
		),
		)));
		//$result=iconv("utf-8","cp1251_general_ci",$result);
		$report=json_decode( $result, true );
		//$report=iconv("utf-8","cp1251_general_ci",$report);
		foreach($report[send] as $value){
		//$value=iconv("utf-8","cp1251_general_ci",$value);
		$vars = array('server_id'=>$value[server_id],
							'from_sms'=>$value[from],
							'to_sms'=>$value[to],
							'text'=>iconv("utf-8","cp1251",$value[text]),
							'zone'=>$value[zone],
							'parts'=>$value[parts],
							'credits'=>$value[credits],
							'status'=>$value[status],
							'error'=>$value[error],
							'server_packet_id'=>$report[server_packet_id],
							'balance'=>$report[balance],
							'send_date'=>date("H-m-d"),
							'country'=>$value[country]);
							
				$this->addReport($vars);
				
		}
		if ($report[send][status]==0)
			return true;
		else
			return false;
		
	}
	
	//
	// ������� ���������� ���������� ���������� ��� �� ����
	//
	
	public function getCountSmsDate($date, $phone_number){

		return count($this->msql->Select("SELECT * FROM sms_report WHERE send_date='$date' AND to_sms='$phone_number'"));
	
	}
   
   
	
	
	//
	// ������� ���������� ������ ������� � ��.
	//
	private function addReport($object){

		$this->msql->Insert('sms_report',$object);	
	}
   
   }
		
    
?>
