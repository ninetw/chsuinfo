<?php
include_once('controller/C_Base.php');

class C_VK extends C_Base {
	
	public $mVK;
	public $token;
	
	
	//
    // �����������.
    //
    function __construct()
	{
		parent::__construct();
		// ���������.
        $this->mVK = M_VK::Instance();
		$this->token = $this->mVK->OAuth(LOGIN, PASSWORD);
		
    }

	
    //
    // ����������� ��������� HTML.
    //
    protected function OnOutput()
	{	
		//�������� ������ �����
		$friend=$this->mVK->FriendGet($this->token);
		
		$message=$this->mVK->getMessage();
		
		for ($i=0;$i<count($message);$i++)
		{$f=false;
		
		foreach($friend[response] as $value)
		{	
			if($value==$message[$i][id_vk])
			{
				$f=true;
			}
			else
			{
				
			}
		}
	
		
		if ($f)
			{
			
				//���������� ���������
				 echo $response = $this->mVK->MsgToUser($message[$i][id_vk], $message[$i][message].  $this->mVK->link, '',"����������_��_������", $this->token);
				if ($response == "ok")
				{
					$this->mVK->SetStatusSend($message[$i][id]);
				
				} 
				else 
				{
					
					$this->mVK->SetStatusError($message[$i][id]);
			
				}
				
			}
			else
			{
				$response = $this->mVK->MsgToUser($message[$i][id_vk], "��� �� �������� ���������� � ��������� ������� ���� � ������, ��� ������� � ��� ��� ��������� ���������� ����� ��������� ������������ �����, ������� �� ��������� � ������ ������".  $this->mVK->link, '',"������_��������", $this->token);
				
				if ($response == "ok")
				{
					$this->mVK->SetStatusSend($message[$i][id]);
	
				} 
				else 
				{
					
					$this->mVK->SetStatusError($message[$i][id]);
					echo "error";
	
				}
			}
		
		
		
	sleep(5);
	}

		// C_Base.
        //parent::OnOutput();
	
    }
}