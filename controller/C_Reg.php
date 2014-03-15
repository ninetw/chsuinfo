<?php
include_once('controller/C_Base.php');
//
// ����������� �������� �����������.
//
class C_Reg extends C_Base 
{

	private $phone_number;		// ����� ������������
	private $mReg;				// �������� �����������
	private $mSms;
	

	//
    // �����������.
    //
    function __construct() 
    {
    	parent::__construct();
		//���������
			$this->mReg = M_Reg::Instance();
			$this->mSms = M_Sms::Instance();
			//$this->needLogin = true; // ����������������, ����� ������� ���������������� ������ � ��������
    }

    //
    // ����������� ���������� �������.
    //
    protected function OnInput(){
	
		// C_Base.
		parent::OnInput();
		
		
		// ��������� �������� �����.
		if ($this->IsPost()){	
		
			//������� ������ � ���������� ������� �������
			$this->phone_number = trim($_POST['phone_number']);
			
			
			//��������� ���� �� ������ ����
			if($this->phone_number==''){
				$this->alert="����������, ������� ��� ����� ���������� ��������";
				return;
			}
			
			//��������� ��������� �� ������������ ���� �����
			if ($this->mReg->verPhone($this->phone_number)){
				$this->alert="�� ����������� ������� ����� ��������. ������� ���� ����� � ������������ � ��������. <b>������: 9115148679</b>";
				return;
			}
			
			//��������� ����� ������������ � ���� ������� ��� ���������������
			if($this->mReg->verUser($this->phone_number)){
				$this->alert="��������, �� ������������ � ������� $this->phone_number ��� ���������������! ���� �� ������ ������ �� ������ ��������������� ������ ������������� ������";
				return;
			}
			
			//���������� ������		  
			$password=$this->mReg->getCode();
			
		$arr[] = array( 'to' => "7".$this->phone_number, 'text' => iconv("CP1251","utf8","�� ������������������ �� ����� chsuinfo.ru ��� ����� ������ ".$password));
			//���������� ��� ���������
			if($this->mSms->sendArraySms( $arr)) {  
	
				// ��������� ������������ � ����
				$vars = array('phone_number'=>$this->phone_number,
							'password'=>md5($password),
							'id_role'=>'1');
				$this->mReg->addUser($vars);
			
				$this->alert="�� ������� ����������������. � ������� 1-2 ����� �� ��� ����� $this->number ������� ��� ��������� � �������.";
			 } 
			else{
				$this->alert="��������� ������ ���������� ��� ���.";
			}
		}
	}

    //
    // ����������� ��������� HTML.
    //
    protected function OnOutput() {

        // ��������� ����������� �������� Rasp.
    	$vars = array('alert'=>$this->alert);
							
			                	
    	$this->content = $this->View('tpl_reg.php', $vars);

		// C_Base.
        parent::OnOutput();
    }
}