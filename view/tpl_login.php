
		<? if (!isset($user)): ?>
			<div class="auth_block">
			<form action='index.php?c=login' method='post'>
				+7 <input  size=13 placeholder=" ����� ��������." required type='text' name='phoneNumber'/>
				<br/>
				<input  size=15 placeholder=" ������" required type='password' name='password'/>
				<input   type='hidden' name='remember' value='true'/>
				<br/>
				<input type='submit' name='submit'/>
			</form>
			<a href='index.php?c=reg'>�����������</a></br>
			<a href='index.php?c=restore'>����� ������</a></br>
		  <a href='<?=$linkAuthVk?>'>����� ����� ���������</a>
			</div>
		<?endif?>
		<? if (isset($user)): ?>
			<div align="center">
			<h3><?=$user[first_name]?> <?=$user[last_name]?></h3>
			<img  width="160" align='bottom' src="<?=$user[photo_200]?>">
			
			<form action='index.php?c=login' method='post'>
			<input type='submit' name='logout' value='�����'>
			</form>
			</div>
		<?endif?>

		<?if (($this->mUsers->Can('edit_blog'))):?>
			<div class="left_block">
				<a href="index.php?c=edit_blog">�������� ������ � ����</a><br/>
				<a href="index.php?c=notif_all">�������� ��������</a><br/>
				<a href="#">������ ��������������</a><br/>
			</div>
		<?endif?>
		<?if (isset($user) && ($user[person]=='')):?>
			<div class='alert'">
				��� ���������� SMS ��������, ������� � <a href="index.php?c=setting">���������� �������</a> ���� ��� � ������.
			</div>
		<?endif?>
		<?if (0):?>
			<div class='alert'">
				������ ����� � ������<a href="index.php?c=setting">���������� �������</a> ���� ��� � ������.
			</div>
		<?endif?>
		<?if (isset($user) && count($all_notif) && $all_notif[0]['send_all']==1):?>
			<div class="starosta_notif_block">
			<h2>�������� <?=$all_notif[0]['grup']?></h2>
				<?=$all_notif[0]['text']?>
			</div>
		<?endif?>	
			
		<!-- VK Widget -->
		<div style="margin-top:15px" id="vk_groups"></div>	
		