<?php
include_once('controller/C_Base.php');
//
// ����������� �������� ������ ����������.
//
class C_Rasp extends C_Base {
	private $sel_week;             // ��������� ������
	private $sel_grup;             // ��������� ������
	private $sel_lecturer;         // ��������� �������������
	private $person;           		// (������������� ��� ������)
	private $mas_rasp;	           // ���������
	protected $mRasp;              //

	//
    // �����������.
    //
    function __construct()
	{        
        parent::__construct();
		// ���������� �������� ������ � �����������.
        $this->mRasp = M_Rasp::Instance();
		$this->mUsers = M_Users::Instance();	
    }

    //
    // ����������� ���������� �������.
    //
    protected function OnInput()
	{
        
		// C_Base.
		parent::OnInput();
		
        // ��������� �������� �����.
		if (($this->IsGet()))
		{
			if($_GET[week]=='forward')
			{		
				$expire = time() + 3600 * 24 * 100;
				$this->sel_week = $_COOKIE['sel_week']+1;		
				$_COOKIE['sel_week']=$this->sel_week;
				setcookie("sel_week",$this->sel_week,time()+$expire);
			}
			if ($_GET[week]=='back')
			{
				$expire = time() + 3600 * 24 * 100;
				$this->sel_week = $_COOKIE['sel_week']-1;		
				$_COOKIE['sel_week']=$this->sel_week;
				setcookie("sel_week",$this->sel_week,time()+$expire);			
			}
			
		}
		
		
		if (($this->IsPost()))
		{
			$expire = time() + 3600 * 24 * 100;
			$this->sel_grup = $_POST['sel_grup'];
			$this->sel_lecturer = $_POST['sel_lecturer'];
			$this->sel_week = $_POST['sel_week'];
			$this->person = $_POST['person'];
    

			$_COOKIE['person']=$this->person;
			$_COOKIE['sel_week']=$this->sel_week;
			$_COOKIE['sel_grup']=$this->sel_grup;
			$_COOKIE['sel_lecturer']=$this->sel_lecturer;
		  
			setcookie("sel_grup",$this->sel_grup,time()+$expire);
			setcookie("sel_lecturer",$this->sel_lecturer,time()+$expire);
			setcookie("sel_week",$this->sel_week,time()+$expire);
			setcookie("person",$this->person,time()+$expire);
		}
	}

    //
    // ����������� ��������� HTML.
    //
    protected function OnOutput()
	{
		if($_COOKIE['person']=='lecturer')
		{
			$type=$_COOKIE['sel_lecturer'];
		}
		else
		{
			$type=$_COOKIE['sel_grup'];
		}
		 
		$this->mas_rasp=$this->mRasp->rasp($_COOKIE['sel_week'], 'week', $_COOKIE['person'], $type);
		
		//��������� 5 ������������
		$arrComments = $this->mRasp->get_comments();
		$reverseAC = array_reverse($arrComments);
		//$ttest = var_dump($arrComments);
		foreach($reverseAC as $comment){
			$user = $this->mUsers->Get($comment['author_id']);
			$comment_body = iconv("UTF-8", "WINDOWS-1251", $comment['body']);
			$extLinks = '';
			if(strlen($comment_body) >= 125){
				$extLinks = '<a href="#" class="panLink" onclick="extComment(this); return false;"><img src="/view'.THEME.'/images/ext.png"></a>
							<a href="#" class="panLink" onclick="extCommentHide(this); return false;" style="display:none"><img src="/view'.THEME.'/images/extn.png"></a>';
			}
			
			$this->user = $this->mUsers->Get();
			if($this->user['id_role'] == 4)
				$delOrtw = '<a href="#" class="panLink"><img src="/view'.THEME.'/images/del.png"></a><br>';
			else
				$delOrtw = '<a href="#" class="panLink"><img src="/view'.THEME.'/images/tw.png"></a><br>';
				
			$htmlComments .= '<div class="commVk">
													<div class="img-comm"><img width="50" src="'.$user['photo_200'].'"></div>
													<div class="comm-text">
														<div class="comm-name">'.$user['first_name'].' '.$user['last_name'].'</div>
														<div class="commentVk">'.$comment_body.'</div>
													</div>
													<div class="commentPanel">
														'.$delOrtw.'
														<a href="#" class="panLink"><img src="/view'.THEME.'/images/vk_c.png"></a><br>
														'.$extLinks.'
													</div>
												</div>';
		}
		
		
		// ��������� ����������� �������� Rasp.
      
    	$vars = array(
			'html_comments'=>$htmlComments,
			'comments'=>$this->mRasp->get_comments(),
			'grup'=>$this->mRasp->all_grup(),
			'lecturer'=>$this->mRasp->all_lecturer(),
			'rasp'=>$this->mas_rasp,
            'day1'=>$this->day1,            
			'week'=>52,
			'now_week'=>$this->mRasp->get_num_edu_week(date("d-m-Y")),
            );
		
			$this->content = $this->View(THEME.'/tpl_rasp.php', $vars);

		
	
		parent::OnOutput();
    }
}