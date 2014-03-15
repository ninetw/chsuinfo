<?php
include_once('controller/C_Base.php');

//
// ���������� �������� �����������
//
class C_Login extends C_Base
{
	private $phoneNumber;	// ������� ������������
	
	//
	// �����������.
	//
	public function __construct() 
	{
		parent::__construct();			
		$this->phoneNumber = '';
		//���������
		$this->mReg = M_Reg::Instance(); 
	}
	
	//
    // ����������� ���������� �������.
    //
    protected function OnInput() 
    {
		// ����� �� ������� ������������.        
		$this->mUsers->Logout();
        
		// C_Base.
        parent::OnInput();
        
		// ��������� �������� �����.
		if ($this->IsGet()){
			
			// �������� �������� code, ������ ���� ����� ���������
			if($_REQUEST['code'])
			{			
				// �������� access_token
				$resp = file_get_contents('https://oauth.vk.com/access_token?client_id='.CLIENT_ID.'&code='.$_REQUEST['code'].'&client_secret='.SECRET.'&redirect_uri='.PATH.OAUTH_CALLBACK);
				$data = json_decode($resp, true);
				if($data['access_token'])
				{				
					//��������� ���� �� ���� ������������
					if($this->mUsers->GetByidVk($data['user_id']))
					{
						if ($this->mUsers->LoginVk($data['user_id'], true))
						{
							header('Location: index.php');
							die();
						}
					
						
					}
					else
					{
						$this->alert="� ����� �������� �� ��������� �� ���� ������� ������";
					}
					//���������
				
				}
    }
}
		
		
        if ($this->IsPost())
        {
		
			
			$this->phoneNumber = $_POST['phoneNumber'];
			
	        if ($this->mUsers->Login($this->phoneNumber,$_POST['password'],true))
			{
			
				header('Location: index.php');
				die();
			}
			if($this->phoneNumber=='')
			{
				header('Location: index.php?c=blog');
				die();
			
			}
			else
			{
				$this->alert="�� ����� ������������ ���������� ����� ��� ������. �� ������ ������������ ������� ������ � ����� ����";
				sleep(5);
			}
			
			
        }
    }

    //
    // ����������� ��������� HTML.
    //
    protected function OnOutput() 
    {    
		// ��������� ����������� ����� �����.
        $vars = array('phoneNumber' => $this->phoneNumber,
					 'alert' =>$this->alert);        
    	$this->content = $this->View('tpl_restore.php', $vars);
		
		// C_Base.
        parent::OnOutput();
    }
}