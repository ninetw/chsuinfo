
	<h2>����������� ������� ���������� ���</h2>
	

		<?if (isset($alert)):?>
		<p class='alert'><b>��������!:</b> <?=$alert?></p>
	<?endif?>
	<?if ((isset($this->user[id_user]))&& ($_GET[act]!="edit")):?>
		<p class='alert'>���������� �����-�� �����������, �� �� ������, ��� �������� �� ���� ����� ������������?<br/>
		�� ������ ��������� �� ������� � ����?<br/>
		���������� ������ �������� ������ "����������� ������� ���"!<br/>
		��������� ��� ���� �������� ������� 1000 �������������, ��������� <a href='index.php?c=events&act=edit'>����������� �����</a>,  ��� ����� ����� �������� ������ ���� ������� � ����� ���� ����������� ������ � ���!</p>
	<?elseif (!isset($this->user[id_user])):?>
		<p class='alert'>������ ������������������ ������������ ����� ��������� �������.</p>
	<?endif?>

	<?if ((isset($this->user[id_user])) && ($_GET[act]=="edit")):?>
	
	<div style="padding:10px; border: 1px solid #30AAD8; border-radius: 8px">

		<div style='background-color:#F9F6E7; padding:8px; border:1px solid #D9E0E7;border-radius: 8px'>
		������� ���������� �������:
			<ul>
				<li  type="square">����������� ���������� ����������, ������� �������� ���������� ��� ������������, �������� ����������� �������.</li>
				<li  type="square">����������� ���������� ����������, ������� �������������� ���������� ������������ ��� �������� ������, ���������� ��� ����������� �� ���������� ���������� ��������</li>
				<li  type="square">����������� ������������ �����������, ���������� ����� ������������ ����������, � ����� ����� ���������� � �������.</li>
				<li  type="square">��� ���������� ����������� ������ ���������� �� ����������� ���������� � ����������� ������� ������.</li>
				<li  type="square">��� ������� �������� ������������ ���������.</li>	
			</ul>
		</div>
		<br/>
		<form enctype="multipart/form-data" action="index.php?c=events"  method="post" >
		��������:<br/> 
		<input name="inst" size="" maxlength="50" value='<?=$event[inst]?>' required/><br/>
		�������� �������<br/> 
		<input name="title" size="50" maxlength="50" value='<?=$event[title]?>' required/><br/>
		���� ����������:<br/> 
		<input name="date_event" value='<?=$event[date_event]?>' required type="date"/><br/>
		����� ������:<br/> 
		<input name="time_event" value='<?=$event[time_event]?>' required type="time"/><br/>
		������ �� �������� �������:<br/> 
		<input name="url_event" size="50" maxlength="50" type='url' value='<?=$event[url_event]?>'required/><br/>
		��������:<br/> 
		<textarea name="text" required cols="50" maxlength="500"  rows="6"><?=$event[text]?></textarea><br/>
		�����������:<br/> 
		<input name="picture"  type='file' required/><br/>
		<br/>
		<?if(isset($event)):?>
		<input type='hidden' name='id_event'value="<?=$event[id]?>" />
		<input name='edit_event'value="��������������" type="submit"/>		
		<?else:?>
		<input name='add_event'value="���������" type="submit"/>	
		<?endif?>
		</form>
	</div>
	<br/>
	<?endif?>
	
	
	
    <?foreach ($allEvent as $value){ 
		
		echo "<div style='padding:10px; border: 1px solid #30AAD8; border-radius: 8px'>
			<img src='img_event/".$value[picture]."' align='left' vspace='2' hspace='10' alt='".$value[title]."'>
		<h2>".
			$value[title]."</h2>
			
			<b>��������: </b>".
			$value[inst].
			"<br/><b>���� ����������: </b> ".
			$value[date_event].
			"<br/><b>����� ������: </b> ".
			$value[time_event].
			"<br/><b>��������� �� <a href='".$value[url_event]."' target='_blank'>".$value[url_event]."</a></b><br/>
			
			<b>��������: </b><br/>".
			$value[text].
			"			
			</div><br/>	";
	}?>
	<?if (isset($userEvent[0])):?>
	<h2>������ ����� ������ </h2> 
	
	<?foreach ($userEvent as $value){ 
		
		echo "<div style='padding:10px; border: 1px solid #30AAD8; border-radius: 8px'>
			<img src='img_event/".$value[picture]."' align='left' vspace='2' hspace='10' alt='".$value[title]."'>
		<h2>".
			$value[title]."</h2> 
			<b>������:</b> ".$value[status]."
			<br/><b>��������: </b>".
			$value[inst].
			"<br/><b>���� ����������: </b> ".
			$value[date_event].
			"<br/><b>����� ������: </b> ".
			$value[time_event].
			"<br/><b>��������� �� <a href='".$value[url_event]."' target='_blank'>".$value[url_event]."</a></b><br/>
			
			<b>��������: </b><br/>".
			$value[text].
			"
			
			
			<br/><a href='index.php?c=events&act=edit&id=".$value[id]."'>�������������</a>
			<a href='index.php?c=events&act=delete&id=".$value[id]."'>�������</a>
			</div><br/>	";
	}?>
	<?endif?>
	



