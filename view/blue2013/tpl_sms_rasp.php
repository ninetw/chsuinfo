
	
		<?if (isset($alert)):?>
			<?include_once ("tpl_alert.php");?>
		<?endif?>

		
			<h2>SMS informer</h2>	
		<div style="padding:10px; border: 1px solid #30AAD8; border-radius: 8px">
			<p>������ SMS �������� ������������ ����� ���������� �������� ���������� ������� �� ���������� ����.
			<p>��������, ������ ��������� ���� ���� �� ���, ��-�� ����, ��� �� ���� � �������. � �����, ���� ��������, ��� �� ���� ������� 10 �������, ����� ������, � ����� ������� ����.
			<p>��� SMS ������ �������� ��� ��������. � ����� �������� �� ������ ������ ����� ���� �� ������.
			<p>�������� ���� �������� �� ��, ��� SMS �������� ��������� ��������� � �� ��������������!!!
			<br />
		
		
		
		<? if (!isset($sms)):?>
			<div style="padding:10px; border: 1px solid #30AAD8; border-radius: 8px">
				<form action="index.php?c=sms_rasp"  method="post">
					<b>�������� SMS �������� �������� ���������� ��� : <?=$person?></b>
					<br />
					�������� �������� ��  
					<select  name="count_day" id="count_day"> 
						<option>10</option>
						<option>15</option>
						<option>20</option>
					</select>  
					���� � �������� SMS ��������� � 
			
					<select  name="time">
						<option>08</option>
						<option>09</option>
						<option>10</option>
						<option>11</option>
						<option>12</option>
						<option>13</option>
						<option>14</option>
						<option>15</option>
						<option>16</option>
						<option>17</option>
						<option>18</option>
						<option>19</option>
						<option>20</option>
						<option>21</option>
						<option>22</option>
						<option>23</option>
					</select>
					<b>:00</b> �����
					<br />
					<br />
					<input name='notification' value='1' type='checkbox' checked>� ���� �������� ���������� SMS ���������� � ��������� ������������ ������������</input>
					<br />
					<input  type="submit" name="sms" value="��������" /></p>
				</form>
			</div>
			
			<br/>
			<?endif?>
			<?if(isset($sms)):?>
		
			<div style="padding:10px; border: 1px solid #00ff00; border-radius: 8px" >
			<?="�� ��������� �� �������� SMS ���������� � <b>".$sms[time]."</b> ���(��). <a href='index.php?c=sms_rasp&mailing=delete&id_mailing=".$sms[id_mailing]."' class=\"red-link\">[����������]</a>"?>
			</div>
		<?endif?>
			
		</div>
		</br>
			<h2>VK informer (�������� �����)</h2>
		
			<div style="padding:10px; border: 1px solid #30AAD8; border-radius: 8px">
				<p>������ VK �������� ������������ ����� ���������� �������� ���������� ������� �� ���������� ���� � ���������� ���� ���������.
				<p>������ �������� �������� � ���������� ����� ����� �������, ��������� �������� �� ��������� � ��������. ������� ���������� ������, � �����, � �� ������ ������ ������� ������ ����� �� ���������.
				<br />
			
		</br>
			<? if ( !isset($vk)):?>
			<div style="padding:10px; border: 1px solid #30AAD8; border-radius: 8px">
				<form action="index.php?c=sms_rasp"  method="post">
					<b>�������� �������� �������� ���������� �� ������� "���������" ��� : <?=$person?></b>
					<br />
					 �������� �������� ��  
					<select  name="count_day" id="count_day"> 
						<option>10</option>
						<option>15</option>
						<option>20</option>
					</select>  
					���� � �������� ��������� � 
			
					<select  name="time">
						<option>08</option>
						<option>09</option>
						<option>10</option>
						<option>11</option>
						<option>12</option>
						<option>13</option>
						<option>14</option>
						<option>15</option>
						<option>16</option>
						<option>17</option>
						<option>18</option>
						<option>19</option>
						<option>20</option>
						<option>21</option>
						<option>22</option>
						<option>23</option>
					</select>
					<b>:00</b> �����
					<br />
					<br />
					<input name='notification' value='1' type='checkbox' checked>� ���� �������� ����������  ���������� � ��������� ������������ ������������ �� ���� ������� "���������"</input>
					<br />
					<input  type="submit" name="vk" value="��������" /></p>
				</form>
			</div>
		<?endif?>	
		
		<?if(isset($vk)):?>
		
			<div style="padding:10px; border: 1px solid #00ff00; border-radius: 8px" >
			<?="�� ��������� �� �������� ���������� <b>".$user[person]."</b> � ���������� ���� <b>\"���������\"</b> �� ������� <a href='http://vk.com/id".$user[id_vk]."' class=\"red-link\">vk.com/id".$user[id_vk]."</a>. ����� �������� <b>".$vk[time]."</b> ���(��). <a href='index.php?c=sms_rasp&mailing=delete&id_mailing=".$vk[id_mailing]."' class=\"red-link\">[����������]</a>"?>
			</div>
		<?endif?>
		</div>
		</br>
		
		
		
