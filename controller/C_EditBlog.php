<?php
include_once('controller/C_Base.php');
//
// ����������� �������� ���������� ������.
//
class C_EditBlog extends C_Base 
{
	private $title;		// ����� ��� ��������������
	private $text;		// ����� ��� ��������������
	private $author;		// ����� ��� ��������������
	private $date_post;		// ����� ��� ��������������
	
	private $mEditBlog;
	

	//
    // �����������.
    //
    function __construct() 
    {
    	parent::__construct();
    	//$this->needLogin = true; // ����������������, ����� ������� ���������������� ������ � ��������
		// ���������.
		$this->mEditBlog = M_EditBlog::Instance();
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
		if ($this->IsPost())
		{
			$this->title = $_POST['title'];
			$this->text = $_POST['text'];
			$this->author = $_POST['author'];
			$this->date_post = $_POST['date_post'];
			
			//��������� ���������� ������������
			if (!$this->mUsers->Can('edit_blog')){
				return false;
			}
			
			// ��������� ������������ � ����
			$vars = array('title'=>$this->title,
						'text'=>$this->text,
						'author'=>$this->author,
						'date_post'=>$this->date_post);
						
			if ($this->mEditBlog->addPost($vars)){
				$this->alert="������ ������� ���������.";
			}
			else{
				$this->alert="������ �� ���������.";
			}
		}
    }

    //
    // ����������� ��������� HTML.
    //
    protected function OnOutput() 
    {   	
	
        // ��������� ����������� �������� Welcome.
    	$vars = array(
			'alert' => $this->alert);
    	
    	$this->content = $this->View('tpl_edit_blog.php', $vars);

		// C_Base.
        parent::OnOutput();
    }
}