<?php
include_once('controller/C_Base.php');
//
// ����������� ��������-�������.
//
class C_IncMes extends C_Base {
	private $num;		       // ��������� �����
	private $phoneNumber;            // ����� ��������
	protected $mRasp;          // ���������� ��������� (� ��������� UTF-8)
	private $message; 
	

	             //

	//
    // �����������.
    //
    function __construct() {
        
        parent::__construct();
		// ���������.
        $this->mIncMes = M_IncMes::Instance();
		$this->mStar = M_Starosta::Instance();
		$this->mSms = M_Sms::Instance();
		$this->mRasp = M_Rasp::Instance();
		$this->mSender = M_Sender::Instance();
		
    }

    //
    // ����������� ���������� �������.
    //
    protected function OnInput(){
        
		// C_Base.
		parent::OnInput();
		
        // ��������� �������� �����.
		if ($this->IsPost()){
		  
			$this->num = $_POST['num'];
			$this->phoneNumber = substr($_POST['phone'],1);
			$this->message = $_POST['message'];
			
			//��������� ��������������� ����� ��� ���
			if (!$this->mIncMes->getRegisterPhone($this->phoneNumber)){
				return;
			}
			
			//������� ��� ����� ������������
			$day=$this->mIncMes->verifySms($this->message);
			
			if($day=="sg"){
				$date=date("d-m-Y");
				$mas_rasp=$this->mRasp->rasp($date, "date", "grup", "1��-311");
			}
			if($day=="zv"){
				$date=date('Y-m-d',mktime(0, 0, 0, date("m"), date("d")+1, date("Y")));
				$mas_rasp=$this->mRasp->rasp($date, "date", "grup", "1��-311");
			}
			if($day="pz"){
				$date=date('Y-m-d',mktime(0, 0, 0, date("m"), date("d")+2, date("Y")));
				$mas_rasp=$this->mRasp->rasp($date, "date", "grup", "1��-311");
			}
			
			if(count($mas_rasp)!=0){
				$sms="������� �� ".$date." �����, ".$value[person]."\n"; 
				foreach($mas_rasp as $value2){
					$mas_word=$this->mSender->dali($value2[discip]);
					$discip=$this->mSender->sokrat($mas_word);
					$address=implode("",$this->mSender->dali($value2[address]));
					$time=implode("",$this->mSender->dali($value2[time]));
					$sms=$sms."$time\n $discip\n $address\n ";
				}
			}
			else{
				
				//$sms= "������� �� ".date('j',mktime(0, 0, 0, date("m"), date("d")+1, date("Y")))." ����� �� �������\n";
			}
			$arr[] = array( 'to' => "7".$this->phoneNumber, 'text' =>iconv("CP1251","utf8",$sms));
			//���������� ��� ���������
			$this->mSms->sendArraySms( $arr);
			
		}
		//if($this->mInc_mes->phone_starosta($_POST['phone']))
		
	}

    //
    // ����������� ��������� HTML.
    //
    protected function OnOutput() {
	
		print_r($this->mRasp->rasp(date("d-m-Y"), "date", "grup", "1��-311"));
			
    
    // ��������� ����������� �������� Rasp.
      
    	
//parent::OnOutput();
		
    }
}