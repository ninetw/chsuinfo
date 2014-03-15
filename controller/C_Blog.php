<?php
include_once('controller/C_Base.php');
//
// ����������� �������� ���������� ������.
//
class C_Blog extends C_Base 
{
	private $title;		// ����� ��� ��������������
	private $text;		// ����� ��� ��������������
	private $author;		// ����� ��� ��������������
	private $date_post;		// ����� ��� ��������������
	private $allPost;
	private $mBlog;
	

	//
    // �����������.
    //
    function __construct() 
    {
    	parent::__construct();
    	//$this->needLogin = true; // ����������������, ����� ������� ���������������� ������ � ��������
		// ���������.
	
		$this->mBlog = M_Blog::Instance();
		
	}

    //
    // ����������� ���������� �������.
    //
    protected function OnInput() 
    {
		// C_Base.
		parent::OnInput();
		
		
		
		
    }

    //
    // ����������� ��������� HTML.
    //
    protected function OnOutput() 
    {   	
		$this->allPost=$this->mBlog->getAllPost();
		
		if(!count($this->allPost)){
			$this->alert="���� ������� � ����� ���";
		}
	
        // ��������� ����������� �������� Welcome.
    	$vars = array(
			'allPost' => $this->allPost,
			'alert' => $this->alert, 
			);
    	
    	$this->content = $this->View('tpl_blog.php', $vars);

		// C_Base.
        parent::OnOutput();
    }
}