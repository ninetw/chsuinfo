<?php
include_once('controller/C_Base.php');
//
// ����������� �������� ���������� ����������.
//
class C_Starosta extends C_Base 
{
		
	protected $mStar;
	protected $all_odnogrup;


	//
    // �����������.
    //
    function __construct() 
    {
    	parent::__construct();
    	$this->needLogin = true; // ����������������, ����� ������� ���������������� ������ � ��������
		$this->mSms = M_Sms::Instance();
		$this->mStar = M_Starosta::Instance();
		
    }

    //
    // ����������� ���������� �������.
    //
    protected function OnInput(){
		
			// C_Base.
			parent::OnInput();
			if($this->mUsers->Can('send_sms_group')){	
			$this->all_odnogrup=$this->mStar->all_odnogrup($this->user[starosta]);
			if ((15-($this->mStar->count_not($this->user[starosta])))<=0){
						$this->alert="�� ��������� �������� ����� �������� ����������";
						return false;
					}
				
			// ��������� �������� �����.
			if ($this->IsPost()){
					
					
					$text=$_POST[text]."\n�������� ".$this->user[starosta];
					$sendAll=$_POST[sendAll];
					$mas_number=$_POST[mas_number];
					
					if (($sendAll!="true") && !isset($mas_number)){
						$this->alert="�������� ������ ��������";
						return;
					}
				
					
					
					//��������� ������ ��� ��������	
					if (isset($sendAll) && ($sendAll=="true")){
						foreach ($this->all_odnogrup as $value){
							$arraySms[] = array('to' =>"7".$value[phone_number], 'text' => iconv("CP1251","utf8",$text));
							$all=1;
						}
						
					}
					else{
						
						foreach ($mas_number as $value){
							$arraySms[] = array('to' =>"7".$value, 'text' => iconv("CP1251","utf8",$text));
						}
						$all=0;
					}
					
					$vars = array('grup'=>$this->user[starosta],
									'send_date'=>date('Y-m-d'),
									'text'=>$text,
									'send_all'=>$all); 
									
					
					
					if (!$this->mSms->sendArraySms($arraySms)){
						$this->alert="��� �������� ��������� ������, ���������� ��������� ��� ���.";
						return false;
					}
					
					
					if (!$this->mStar->add_notif($vars)){
						$this->alert="��� �������� ��������� ������, ���������� ��������� ��� ���.";
						return false;
					}
							
					$this->alert="SMS ������� ����������";	
						
					
				
				
			}	

		
    
}
}
    //
    // ����������� ��������� HTML.
    //
    protected function OnOutput() {
		
	
		
				
		
		
     // ��������� ����������� ��������.
    	$vars = array(
					'all_notif'=>$this->mStar->all_notif($this->user[starosta]),
					'count_not'=>15-$this->mStar->count_not($this->user[starosta]),
					'alert'=>$this->alert,
					'all_odnogrup'=>$this->all_odnogrup
						);
    	
    	$this->content = $this->View('tpl_starosta.php', $vars);

		// C_Base.
        parent::OnOutput();
    
	}
}