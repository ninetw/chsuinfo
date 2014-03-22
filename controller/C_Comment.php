<?php
include_once('controller/C_Base.php');
include_once('lib/comment.class.php');

class C_Comment extends C_Base {
	private $arr;
	private $validates;
	private $code_msg;
	protected $mRasp;
	
    function __construct()
	{        
        parent::__construct();
        $this->needLogin = true;
		$this->mRasp = M_Rasp::Instance();
        $this->mUsers = M_Users::Instance();	
		$this->mComm = M_Comment::Instance();
    }

    protected function OnInput()
	{	
		
		$this->user = $this->mUsers->Get();
		
		if(isset($_POST['page'])){
			$page = addslashes($_POST['page']);
			//���������
			$cur_page = $page;
			$page -= 1;
			$per_page = 5;
			$previous_btn = true;
			$next_btn = true;
			$first_btn = true;
			$last_btn = true;
			$start = $page * $per_page;
			
			//����� 5�� ������������
			$arrComments = $this->mRasp->get_comments($start, $per_page);
			//$reverseAC = array_reverse($arrComments);
			$insertedComment = new Comment();
			foreach($arrComments as $comment){
				$user = $this->mUsers->Get($comment['author_id']);
				$comment_body = iconv("UTF-8", "WINDOWS-1251", $comment['body']);
				
				$commentData = array(
									"body"=>$comment_body,
									"id"=>$comment['id'],
									"id_role"=>$this->user['id_role'],
									"id_vk"=>$user['id_vk'],
									"photo"=>$user['photo_200'],
									"full_name"=>$user['first_name'].' '.$user['last_name']
									);
				$insertedComment->setData($commentData);		
				$htmlComments .= $insertedComment->markup();				
			}
				
			//���������� ���������
			$query_pag_num = "SELECT COUNT(*) AS count FROM comments";
			$result_pag_num = mysql_query($query_pag_num);
			$row = mysql_fetch_array($result_pag_num);
			$count = $row['count'];
			$no_of_paginations = ceil($count / $per_page);
				
				/* ---------------������� ������ � ����� ����----------------------------------- */
			if ($cur_page >= 7) {
				$start_loop = $cur_page - 3;
				if ($no_of_paginations > $cur_page + 3)
					$end_loop = $cur_page + 3;
				else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
					$start_loop = $no_of_paginations - 6;
					$end_loop = $no_of_paginations;
				} else {
					$end_loop = $no_of_paginations;
				}
			} else {
				$start_loop = 1;
				if ($no_of_paginations > 7)
					$end_loop = 7;
				else
					$end_loop = $no_of_paginations;
			}
			/* ----------------------------------------------------------------------------------------------------------- */
				
			$htmlComments .= "<div class=\"paginationComms\">";

			// ������ ������ ������
			if ($first_btn && $cur_page > 1) {
				$htmlComments .= "<a href='#' p='1' class='active'><<</a>";
			}

			// ������ ���������� ������
			if ($previous_btn && $cur_page > 1) {
				$pre = $cur_page - 1;
				$htmlComments .= "<a href='#' p='$pre' class='active'>�����</a>";
			}
			
			for ($i = $start_loop; $i <= $end_loop; $i++) {
				if ($cur_page == $i)
					$htmlComments .= "<span class=\"page active\">{$i}</span>";
				else
					$htmlComments .= "<a href='#' p='$i' class='active'>{$i}</a>";
			}
				
				
			// ������ ������ ���������
			if ($next_btn && $cur_page < $no_of_paginations) {
				$nex = $cur_page + 1;
				$htmlComments .= "<a href='#' p='$nex' class='active'>������</a>";
			}

			// ������ ������ ���������
			if ($last_btn && $cur_page < $no_of_paginations) {
				$htmlComments .= "<a href='#' p='$no_of_paginations' class='active'>>></a>";
			}
			//$goto = "<input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:60px;'/><input type='button' id='go_btn' class='go_button' value='Go'/>";
			//$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
			//$msg = $msg . "</ul>" . $goto . $total_string . "</div>";  // Content for pagination
				
				
			$htmlComments .= '<div class="loader">
								<img src="/view'.THEME.'/images/loader.gif">
							</div>
							</div>
							';
			$htmlComments = iconv("WINDOWS-1251", "UTF-8", $htmlComments);
			//����� �������� ������������ � ���� ��������
			$this->code_msg = $htmlComments;
		}else{
			if($this->user !== null){
			
				if (isset($_POST['comment'])){
					$this->arr = array();
					$this->arr['body'] = $_POST['comment'];
					$this->validates = Comment::validate($this->arr);
					$this->code_msg = '';
					
					if($this->validates){
						/* ��� � �������, ��������� ������ � ����: */
						$this->mComm->addComment($this->user['id_user'], $this->arr['body']);
						
						$this->arr['dt'] = date('r',time());
						$this->arr['id'] = mysql_insert_id();
						$this->arr['photo'] = $this->user['photo_200'];
						$this->arr['full_name'] = iconv("WINDOWS-1251", "UTF-8", $this->user['first_name'].' '.$this->user['last_name']);
						/*
						/	������ � $arr ������������ ��� ������� mysql,
						/	�� ��� ����� ������ ����� �� �����, ������� 
						/	������� ��� �������� � �������:
						/*/
						
						$this->arr = array_map('stripslashes',$this->arr);
						$commentData = array(
											"body"=>$this->arr['body'],
											"id"=>$this->arr['id'],
											"id_vk"=>$this->user['id_vk'],
											"id_role"=>$this->user['id_role'],
											"photo"=>$this->arr['photo'],
											"full_name"=>$this->arr['full_name']
											);
						
						$insertedComment = new Comment($commentData);
						$htmlComment = $insertedComment->markup();
						
						$htmlComment = iconv("WINDOWS-1251","UTF-8", $htmlComment);
						/* ����� �������� ������-��� ������������ �����������: */
						$this->code_msg = json_encode(array('status'=>1,'html'=>$htmlComment));

					}
					else
					{
						/* ����� ��������� �� ������ */
						$this->code_msg =  '{"status":0,"errors":'.json_encode($this->arr).'}';
					}
				}else if(isset($_POST['delete'])){
					if($this->user['id_role'] == 4)
						if ($_POST['delete'] !== 'all'){
							$this->mComm->removeComment($_POST['delete']);
							$this->code_msg = '{"status":1}';
						}else if($_POST['delete'] == 'all'){
							$this->mComm->removeAllComments();
							$this->code_msg = '{"status":1}';
						}
				}
			}else{
				$this->code_msg = '{"status":0,"errors":{"body":"'.iconv("WINDOWS-1251", "UTF-8",'���������������, ����� ��������� �����������.').'"}}';	
			}
		}
	}

    //
    // Ae?ooaeuiue aaia?aoi? HTML.
    //
    protected function OnOutput()
	{
		echo $this->code_msg;
    }
}