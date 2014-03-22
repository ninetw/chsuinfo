<?php

class Comment
{
	private $data = array();
	
	public function __construct($row)
	{
		/*
		/	�����������
		*/
		
		$this->data = $row;
	}
	
	//������������� ������ �����������
	public function setData($data){
		$this->data = $data;
	}
	
	public function markup()
	{//error_reporting(E_ALL);
		/*
		/	������ ����� ������� �������� XHTML ��� �����������
		*/
		
		// ������������� ���������, ����� �� ������ ������ ��� $this->data:
		$d = &$this->data;
		
		//���������� � ��������
		$twitterText = urlencode(iconv("WINDOWS-1251", "UTF-8", $d['body']));
		//���������� ��������� ���������
		$vkText = urlencode(iconv("WINDOWS-1251","UTF-8",$d['body']));
		
		if(strlen($d['body']) > 91)
			$twitterText = urlencode(iconv("WINDOWS-1251", "UTF-8", substr($d['body'], 0, 91).'...'));
		
		$extLinks = '';
		if(strlen($d['body']) >= 125){
			$extLinks = '<a href="#" class="panLink" onclick="extComment(this); return false;" title="���������� �����������"><img src="/view'.THEME.'/images/ext.png"></a>
														<a href="#" class="panLink" onclick="extCommentHide(this); return false;" style="display:none" title="�������� �����������"><img src="/view'.THEME.'/images/extn.png"></a>';
		}
					
		if($d['id_role'] == 4){
			$delOrtw = '<a href="#" onclick="delComment(this,'.$d['id'].'); return false;" class="panLink" title="������� �����������"><img src="/view'.THEME.'/images/del.png"></a><br>';
			$chAdmin = '<img style="padding-left:5px;vertical-align:middle" src="/view'.THEME.'/images/adm.png">';
		}else{
			$delOrtw = '<a href="https://twitter.com/intent/tweet?hashtags=chsuinfo,'.urlencode(iconv("WINDOWS-1251","UTF-8","�����������")).'&text='.$twitterText.'&url=http://chsuinfo.ru/" target="_blank" class="panLink" title="��������� � �������"><img src="/view'.THEME.'/images/tw.png"></a><br>';
		}
		
		return '
				<div class="commVk">
					<div class="img-comm"><a href="http://vk.com/id'.$d['id_vk'].'" target="_blank"><img width="50" src="'.$d['photo'].'"></a></div>
					<div class="comm-text">
						<div class="comm-name">'.$d['full_name'].$chAdmin.'</div>
						<div class="commentVk">'.$d['body'].'<a href="#"></a></div>
					</div>
					<div class="commentPanel">
						'.$delOrtw.'
						<a href="http://vk.com/share.php?title='.urlencode(iconv("WINDOWS-1251","UTF-8","����������� ��")).' chsuinfo.ru&url=http://chsuinfo.ru&description='.$vkText.'" target="_blank" class="panLink"><img src="/view'.THEME.'/images/vk_c.png"></a><br>
						'.$extLinks.'
					</div>
				</div>
		';
	}
	
	public static function validate(&$arr)
	{
		/*
		/	������ ����� ������������ ��� �������� ������ ������������ ����� AJAX.
		/
		/	�� ���������� true/false � ����������� �� ������������ ������, � ���������
		/	������ $arr, ������� �������� ��� �������� ���� ������� ���� ���������� �� ������.
		*/
		
		$errors = array();
		$data	= array();
		
		// ���������� ������ � ���������� ��������:
		
		if(!($data['body'] = filter_input(INPUT_POST,'comment',FILTER_CALLBACK,array('options'=>'Comment::validate_text'))))
		{
			$errors['body'] = iconv("WINDOWS-1251", "UTF-8",'����������, ������� ����� �����������.');
		}
		
		if(!empty($errors)){
			
			// ���� ���� ������, �������� ������ $errors � $arr:
			
			$arr = $errors;
			return false;
		}
		
		// ���� ������ ������� ���������, ��������� ������ � �������� �� � $arr:
		
		foreach($data as $k=>$v){
			$arr[$k] = mysql_real_escape_string($v);
		}
		return true;
		
	}

	private static function validate_text($str)
	{
		/*
		/	������ ����� ������������ ��� FILTER_CALLBACK
		*/
		
		if(mb_strlen($str,'utf8')<1)
			return false;
		
		// �������� ��� ����������� ������� html (<, >, ", & .. etc) � �����������
		// ������ ����� ������ � ��� <br>:
		
		$str = nl2br(htmlspecialchars($str));
		
		// ������� ��� ���������� ������� ����� ������
		$str = str_replace(array(chr(10),chr(13)),'',$str);
		
		return $str;
	}

}

?>