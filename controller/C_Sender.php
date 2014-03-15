<?php
include_once('controller/C_Base.php');

class C_Sender extends C_Base {
	//
    // �����������.
    //
    function __construct() 
	{
		parent::__construct();
		// ���������.
        $this->mSender = M_Sender::Instance();
		$this->mSms = M_Sms::Instance();
		$this->mRasp = M_Rasp::Instance();
		$this->mVK = M_VK::Instance();
    }


    protected function OnOutput()
	{
		//���� ������� ������� �� �������� �� ����������� �� �����������
		if (date("D")=="Sat"){
			echo "������ ��������";
			return false;
		}
		
		//�������� ���������� ����
		$date=date('Y-m-d',mktime(0, 0, 0, date("m"), date("d")+1, date("Y")));
		
		//������� ���������� ��������
		$this->mSender->clear();
		
		//�������� ������ ��������  �� ������� ���
		$mas=$this->mSender->mailing_list();
	
		//����� �� ������� ��������
		foreach ($mas as $value)
		{
			$user=$this->mUsers->Get($value[id_user]);
			
			//�������� ���������� ���������� ���������
			$sms='';
			
			//�������� ���������� ��� ���������� �� ������
			$rasp_day=$this->mRasp->rasp($date,"date",$user['type'],$user['person']);
		
			//��������� ���� �� ���� ���� ���� ��������� ���������
			if(count($rasp_day)!=0)
			{
				$sms="������� �� ".date('j',mktime(0, 0, 0, date("m"), date("d")+1, date("Y")))." �����, ".$user[person]."\n"; 
				
				foreach($rasp_day as $value2)
				{					
					if($value[message_type]=="vk")
					{
						$discip=$value2[discip];
					}
					else
					{	
						$mas_word=$this->mSender->dali($value2[discip]);
						$discip=$this->mSender->sokrat($mas_word);	
					}
					
					$address=implode("",$this->mSender->dali($value2[address]));
					$time=implode("",$this->mSender->dali($value2[time]));
					$sms=$sms."$time\n $discip\n $address\n ";
				}
			}
			else
			{	
				if($value[message_type]=="vk")
				{			
					$sms= "������� �� ".date('j',mktime(0, 0, 0, date("m"), date("d")+1, date("Y")))." ����� �� �������\n";
				}
			}			
	
						
			//���� ��������� �� ������ �� ���������� ���
			if($sms!='')
			{
				if($value[message_type]=="vk")
				{
					
					$arrayVK[] = array('id_vk' =>$user[id_vk], 'message' => $sms, 'time'=>$value['time']);
				}
				else
				{			
					$arraySms[] = array('to' => '7'.$user['phone_number'], 'text' => iconv("CP1251","utf8",$sms));
				}
			}
		}
		
		if(count($arrayVK))
		{	
			$fr=false;
			//�������� ������ �����
			$friend=$this->mVK->FriendGet($this->mVK->token);
			
			foreach ($arrayVK as $val)
			{
				foreach($friend[response] as $val2)
				{
					if($val[id_vk]==$val2)
					{
						$fr=true;
						break;
					}
					
				}
				
				if(!$fr)
				{	
					$val[message] = "����� �������� ���������� � ���������, ������� ���� � ������, ��� ������� � ���, ��� ���� ��������� ��������� ����� ���������, ������������ �����, ������� �� ��������� � ������ ������.";
				}
		
				$response = $this->mVK->MsgToUser($val[id_vk], $val[message].  $this->mVK->link, '',"����������_��_������", $this->mVK->token);
				sleep(5); 
		
				if($response=="ok") 
				{
					echo "</br>".$val[id_vk]." ".$val2."</br>";
				}
				else
				{
					$vars = array('id_vk'=>$val[id_vk],
							'message'=>"error",
							'time'=>1);
							
				 
					$this->mSender->AddVKMailing($vars);
					echo "</br>".$val[id_vk]." error</br>";
				}
			
			}	
		
				
			
		}else{
			echo "� ������� ��� �������";	
		}
			
		if(count($arraySms)){
			//�������� ������ ��� ���������
			$this->mSms->sendArraySms($arraySms);
		}
		

		// C_Base.
        //parent::OnOutput();
	
    }
}