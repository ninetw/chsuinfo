<?php
include_once('controller/C_Base.php');
//
// ����������� �������� ������������� ������.
//
class C_Restore extends C_Base {
	
	protected $mReg;  
    protected $mSms;
  	

	//
    // �����������.
    //
    function __construct() {
		parent::__construct();
		// ���������.
		$this->mReg = M_Reg::Instance();
		$this->mSms = M_Sms::Instance();

    }

	
    //
    // ����������� ���������� �������.
    //	
    protected function OnInput(){
        
		// C_Base.
		parent::OnInput();

        // ��������� �������� �����.
		if ($this->IsPost())
		{
			//������� ��������� ���� � ����������
			$this->phone_number = $_POST['phone_number'];
			
			
			//��������� � ��������������� �� ������������ ������
			if(!($this->mReg->verUser($this->phone_number))){
				$this->alert="��������, �� ������������ � ������� <b>$this->phone_number</b> ��� �� ���������������! �������� ��������� �����������";
				return;
			}
			//��������� ������� ��������� ��� ���������� ������������
			if(($this->mSms->getCountSmsDate(date("H-m-d"), "7".$this->phone_number))==2){
				$this->alert="��������, �� ������� �� ��������� ����� �������� SMS �� chsu, ���������� ����������� ������ ������.";
				return;
			}
		
			//���������� ����� ������		  
			$password=$this->mReg->getCode();
			
			//���������� ��� ���������
			$arr[] = array( 'to' => "7".$this->phone_number, 'text' =>iconv("CP1251","utf8","��� ����� ������ �� ����� chsuinfo.ru ".$password));
			if($this->mSms->sendArraySms( $arr)){
				//��������� ������������ � ����
				$vars = array('password'=>md5($password));
				$this->mReg->recovUser($vars, $this->phone_number);
					
				$this->alert="������ ������� ������������. � ������� 1-2 ����� �� ��� ����� $this->phone_number ������� ��� ��������� � �������.";
			}
			else{
				$this->alert="��������� ������ ���������� ��� ���.";
			}	
		}
	}

    //
    // ����������� ��������� HTML.
    //
    protected function OnOutput(){
		
        // ��������� ����������� ��������
    	$vars = array('alert'=>$this->alert);
    	
    	$this->content = $this->View('tpl_restore.php', $vars);

		// C_Base.
        parent::OnOutput();
    }
		
}