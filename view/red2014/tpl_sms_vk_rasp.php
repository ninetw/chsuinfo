<div id="content">
		<div id="content_c">
			<?
			if (isset($alertOk))
			{
				include_once ("tpl_alert_ok.php");
			}
			elseif(isset($alertFail))
			{
				include_once ("tpl_alert_fail.php");
			}
			elseif(isset($alertNotif))
			{
				include_once ("tpl_alert_notif.php");
			}
			?>
			<h1>SMS INFORMER</h1>
			������ SMS �������� ������������ ����� ���������� �������� ���������� ������� �� ���������� ����.<br>
��������, ������ ��������� ���� ���� �� ���, ��-�� ����, ��� �� ���� � �������. � �����, ���� ��������, ��� �� ���� ������� 10 �������, ����� ������, � ����� ������� ����.<br>
��� SMS ������ �������� ��� ��������. � ����� �������� �� ������ ������ ����� ���� �� ������.<br>
�������� ���� �������� �� ��, ��� SMS �������� ��������� ��������� � �� ��������������!
			<? if (!isset($sms)):?>
			
			<form action="index.php?c=sms_vk_rasp"  method="post">
					<h3>�������� SMS �������� �������� ���������� ��� :<?=$person?> </h3>
	
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
					:00 �����</br> 
					
					<input type="checkbox"> � ���� �������� ���������� SMS ���������� � ��������� ������������ ������������ 
					<br>
					<input class="customButton" type="submit" name="sms" value="���������� SMS ��������" style="margin-top:10px;">
					<p class="hr"></p>
				</form>	
				
			<?endif?>	
			
			<?if(isset($sms)):?>
				<div class="message-green" style="margin-top:10px;" >
				<?="�� ��������� �� �������� SMS ���������� � <b>".$sms[time]."</b> ���(��). <a href='index.php?c=sms_vk_rasp&mailing=delete&id_mailing=".$sms[id_mailing]."' class=\"red-link\">[����������]</a>"?>
				</div>
			<?endif?>		
			
			
			<h1>VK INFORMER (�������� �����)</h1>
			������ VK �������� ������������ ����� ���������� �������� ���������� ������� �� ���������� ���� � ���������� ���� ���������.<br>
������ �������� �������� � ���������� ����� ����� �������, ��������� �������� �� ��������� � ��������. ������� ���������� ������, � �����, � �� ������ ������ ������� ������ ����� �� ���������. 
			
			
			
			<? if ( !isset($vk)):?>
				<form action="index.php?c=sms_vk_rasp"  method="post">
					<h3>�������� �������� �������� ���������� �� ������� "���������" ��� : <?=$person?></h3>

					�������� ��������� � 			
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
					:00 ����� <br>
					
					<input type="checkbox"> � ���� �������� ���������� ���������� � ��������� ������������ ������������ �� ���� ������� "���������"  
					<br>
					<input name='vk' class="blueButton" type="submit" value="���������� VK ��������" style="margin-top:10px;">
				</form>
		<?endif?>	
		
		<?if(isset($vk)):?>
		
			<div class="message-green" style="margin-top:10px;" >
			<?="�� ��������� �� �������� ���������� <b>".$user[person]."</b> � ���������� ���� <b>\"���������\"</b> �� ������� <a href='http://vk.com/id".$user[id_vk]."'  class=\"red-link\">vk.com/id".$user[id_vk]."</a>. ����� �������� <b>".$vk[time]."</b> ���(��). <a href='index.php?c=sms_vk_rasp&mailing=delete&id_mailing=".$vk[id_mailing]."'  class=\"red-link\">[����������]</a>"?>
			</div>
		<?endif?>
			
		
			
			
			
			
			
		</div>	
	</div>