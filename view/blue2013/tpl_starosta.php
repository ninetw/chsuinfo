<?if (($this->mUsers->Can('send_sms_group'))):?>
	<h2>������� �������� ������ <?=$this->user[starosta]?></h2> 
		<?if (isset($alert)):?>
			<p class='alert'><b>��������!:</b> <?=$alert?></p>
		<?endif?>
		
    <div style="padding:10px; border: 1px solid #30AAD8; border-radius: 8px">	
		<form action='index.php?c=starosta' method='post'>	 
			<div >��������� ��� ������ (� ���� ������ �������� <?=$count_not?> ���������) </div>
			<textarea   name='text' maxlength='130' cols='50' rows='7' wrap='hard' required></textarea>
			<br/>
			<br/>
			��������
			<br/>
			<select  style='width:70%'  size=10  multiple name="mas_number[]">
				<?
					foreach($all_odnogrup as $value){
						echo "<option value='$value[phone_number]'> 7".$value[phone_number]." - ".$value[first_name]." ".$value[last_name]."</option>";
					}
				?>
			</select>
			<br>
			* ��� ���� ����� ������� ��������� ����������� ����������� ������� Ctrl.
			<br/>
			<input name='sendAll' type="checkbox"  value="true" />��������� ��������� ���� ��������������, ����� ��������� ��� �������������� ��������� � ����� ����� �����. ��� ���������� �������� ��������� � ����� � ���� �� �����������.</p>
			<input type="submit"  value="���������" /></p>
		</form>	
		<?foreach ($all_notif as $value){
			echo $value['send_date']." ".$value['text']."</br>";
		}
		?>

	</div>
	<?else:?>
		<h2>������� ��������</h2>
		<div style="padding:10px; border: 1px solid #30AAD8; border-radius: 8px">
			���� �� ��������, �� ���� ������ ���������� ��� ���. ����� �� ����� ������� ���������� �������������� � �����-���� ������� � ���� SMS ���������. ��� �� ���� ����������� ��������� SMS ������ ��� ���������� ��������������. ��� ����, ����� �������� ������ � �������� ��������, ��������� �� ����������� ����� <b>vizavil@ya.ru</b> ���������� ��� ���� ������������� �������� � ����� ��������, ������� �� ������������ ��� ����������� �� �����.
		</div>
	<?endif?>