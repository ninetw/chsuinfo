<?php
include_once('controller/C_Base.php');
//
// ����������� ��������-�������.
//
class C_Inc_mes extends C_Base {
	private $num;		       // ��������� �����
	private $phoneNumber;            // ����� ��������
	private $message;          // ���������� ��������� (� ��������� UTF-8)

	protected $mRasp;              //

	//
    // �����������.
    //
    function __construct() {
        
        parent::__construct();
		// ���������.
        $this->mInc_mes = M_Inc_mes::Instance();
		$this->mStar = M_Starosta::Instance();
		$this->mSms = M_Sms::Instance();
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
			if (!$this->mInc_mes->getRegisterPhone($this->phoneNumber)){
				return;
			}
			
			//������� ��� ����� ������������
			$this->mSms->send( 9535231282, ($this->mInc_mes->verifySms($this->message)));
		}
		//if($this->mInc_mes->phone_starosta($_POST['phone']))
		
	}

    //
    // ����������� ��������� HTML.
    //
    protected function OnOutput() {
	
	
    
    // ��������� ����������� �������� Rasp.
      
    	
 parent::OnOutput();
		
    }
}