<?php
include_once('MSQL.php');

//
// �������� ��� �������
//
class M_Sender
{
	private static $instance; 	// ������ �� ��������� ������
	private $msql; 				// ������� ��
	
	//
	// ��������� ������������� ���������� (��������)
	//
	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new M_Sender();
		
		return self::$instance;
	}

	//
	// �����������
	//
	public function __construct(){
		$this->msql   = MSQL::Instance();
	}
    
	//
	// ������� ���������� �������� ���������� � VK 
	//
	public function AddVKMailing($object)
	{
	  
		$this->msql->Insert('vk_mailing',$object);
		
	}
	
	
    //
    //������� �������� ������������� �� SMS �������� � ������� �������� ���� ��������
    //
    function clear()
	{
		$now_day=date('Y-m-d');
		$this->msql->Delete("mailing", "message_type='sms' AND mailing_end<'$now_day'");
		
	}
	
    //
    //�������� ������ ����������� ��� �������� �� ������� ��� 
    //
    function mailing_list()
	{
        $now_hour=date('H');
        $now_day=date('Y-m-d');
		return $this->msql->Select("SELECT * FROM mailing WHERE (time='$now_hour')");
    }
    
    //
    //������� ��������� �������� �������� �� ��������� �����
    //
	public function dali($string)
	{
		$i=1;
		$tok = strtok($string, " ");
		while($tok){
			$mas[$i]=$tok;
			$i++;
			$tok = strtok(" ");
		}
		return $mas;
	}
	//
    //������� ���������� �����
    //
	public function sokrat($mas)
	{
		$len=4;
		$vowel=array('�','�','�','�','�','�','�','�','�','�','�','�');
		$out_string='';
		foreach($mas as $string){
			$len_str=strlen($string);
			if($len<=$len_str){
				$str=substr($string,0,$len);
				foreach($vowel as $value){
					if($str[$len-1]==$value){
						$str=substr($string,0,$len+1);
					}
						
				}
				$out_string.=$str." ";
			}
			else{
				$out_string.=$string." ";
			}
		}
		return $out_string;
	}	
		

    
}
