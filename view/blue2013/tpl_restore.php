
<div>
	<h2>����� ������������� ������</h2> 
	<?if (isset($alert)):?>
		<?include_once ("tpl_alert.php");?>
	<?endif?>
    
	<div style="padding:10px; border: 1px solid #30AAD8; border-radius: 8px">	
		<form action="index.php?c=restore"  method="post">
			<p>��� ������������� ������ ��� ���������� ������� ����� ������ ���������� ��������, �� ������� ����� ������� ���������� SMS ��������� � ����� �������</p>
			<p>����� ���������� �������� � ������� 10 ����.
			<div >+7 <input type="text" placeholder="9115148679" name="phone_number"  required/></div>
			<br />
			
			
			<input  type="submit" value="����������� ������" />
		</form>
</div>	
</div>	