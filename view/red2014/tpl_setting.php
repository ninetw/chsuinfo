<div id="content">
		<div id="content_c">
			<div class="profile-ava">
				<div class="big-ava" style="margin-bottom:10px;">
					<img src="<?=$user[photo_200]?>">
				</div>
				<form action='index.php?c=login' method='post'>
					<input class="customButton" type='submit' name='logout' value="����� �� �������"/>
				</form>
				
			</div>
			<form action="index.php?c=setting"  method="post">
			<div class="profile-data">
				<div class="lineProfile">���� ���: <b><?=$user[first_name]." ".$user[last_name]?></b></div>
				<div class="lineProfile">��� ����� ��������: <b><?=$user[phone_number]?></b></div>
				<div class="lineProfile">�� ������� (�������������): <b><?=$user[person]?></b></div>
				<br>
				<a href="<?=$linkAuthVk?>" class="dot-link">��������� ������ �� ������� ���������</a>
				<div class="message-grey" style="margin-top: 20px;">���� �� ������� �������� ���������� �� �������� ����� ������, ������� ���� ��� (�������) � ������ � ������� �� ����������. </div>
				<div class="stInput">
					<div class="lineInput">
						<span>���</span>
						<input name='firstName' type="text" value='<?=$user[first_name]?>'>
					</div> 
					
					<div class="lineInput">
						<span>�������</span>
						<input name='lastName' type="text" value='<?=$user[last_name]?>'>
					</div>
					
					<div class="lineInput">
						<span>����� ��������</span>
						<input name='phoneNumber' type="text" value='<?=$user[phone_number]?>'>
					</div>
					
					<div class="lineInput" id="prepodSelectSet" style="display:none">
						<span>���</span><br>
						<select name='lecturer'>
							 <? foreach ($lecturer as $value)
							 {		
								if  (isset($this->user['person']) && ($this->user['person']==$value[name_lecturer]))
								{		
									echo "<option selected>   ".$value[name_lecturer]." </option>";  
								}
								else
								{
									echo "<option >   ".$value[name_lecturer]." </option>";
								}
							}
							?>
						</select>
					</div>
					
					<div class="lineInput" id="groupSelectSet">
						<span>������</span><br>
						<select name='grup'>
							 <? foreach ($grup as $value)
							 {
								if  (isset($this->user['person']) && ($this->user['person']==$value[title_grup]))
								{		
									echo "<option selected>   ".$value[title_grup]." </option>";  
								}
								else
								{
									echo "<option >   ".$value[title_grup]." </option>";
								}
							}
							?>
						</select>
					</div>
					<div class="lineInput">
						<input name="type" id="lecturerSet" type="radio" value="lecturer"> � ������������� <br> 
						<input name="type" id="studentSet" type="radio" value="grup" checked> � �������
					</div>
					<input class="customButton" type="submit" value="���������"></a>
				</div>
			</div>
			</form>
		</div>	
	</div>