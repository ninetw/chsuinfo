<?phpinclude_once('MSQL.php');//// �������� ��� �������//class M_Rasp{	private static $instance; 	// ������ �� ��������� ������	public $msql; 				// ������� ��		public $grup;			// ������ �����	public $_year;		// ������� ���	public $_month;		// ������� �����	public $num_week_1sept;	// ����� ������ 1 �������� ������������ ������ ����    public $num_week;	// ����� ������� ������ ������������ ������ ����	public $count_week_year; //���-�� ���. � ���� ������ ��������    	//	// ��������� ������������� ���������� (��������)	//	public static function Instance()	{		if (self::$instance == null)			self::$instance = new M_Rasp();				return self::$instance;	}	//	// �����������	//	public function __construct()	{		$this->msql = MSQL::Instance();  		$this->_year=date("Y");		$this->_month=date("n");	}		//	// ������� ��������� ������� ���� �����.	//	public function all_grup()	{		return $this->msql->Select("SELECT * FROM `grup`");	}		//	// ������� ��������� ������� ���� ��������������.	//	public function all_lecturer()	{		return $this->msql->Select("SELECT name_lecturer FROM `lecturer`");	}		//	// ������� ��������� ������� ������������.	//	public function get_comments($lim = 5)	{		return $this->msql->Select("SELECT * FROM `comments` order by `id` DESC limit {$lim}");	}        	//	// ������� ����������� ������ ��� ������ �� �����	//    public function get_num_day($date)	{        switch(date("D", strtotime("$date")))		{            case 'Thu': return 4; break;            case 'Mon': return 1; break;            case 'Tue': return 2; break;            case 'Wed': return 3; break;            case 'Fri': return 5; break;            case 'Sat': return 6; break;            case 'Sun': return 7; break;        }    }			//	// ������� ����������� �������� ��� �� ������ ���	//    public function name_day($num_day)	{        switch($num_day)		{             case 1: return "�����������"; break;            case 2: return "�������"; 	break;            case 3: return "�����";		break;            case 4: return "�������";	 	break;	        case 5: return "�������";		break;	        case 6: return "�������";	break;	        case 7: return "�����������" ;break;        }    }    	//	// ������� ����������� �������� ������	//	public function get_parity($num_week)	{	   if (fmod($num_week,2))	   {	       return "�����";	   }	   else	   {	       return "���";	   }		}		//	// ������� ����������� ������ ���� �� �������	//	public function para($time)	{		switch($time)		{			case "08-30 - 10-00": $par=1; break;			case "10-10 - 11-40": $par=2; 	break;			case "10-40 - 12-40": $par=2; 	break;// ���� ���-��������			case "11-50 - 13-20": $par=3; 	break;			case "13-30 - 15-00": $par=4; 	break;			case "15-10 - 16-40": $par=5; 	break;			case "16-50 - 18-20": $par=6; 	break;			case "18-30 - 20-00": $par=7; 	break;			case "18-00 - 19-30": $par=7; 	break;	//�������� 				case "19-40 - 21-10": $par=8; 	break;					}		return $par;	}		//	// ������� ����������� ���� �� ������ ������ � �������� ���(�����������, �������....)	//	public function date_of_week($num_of_week, $num_of_day)	{		if ($this->_month<=8)		{					$year=$this->_year;			 $year."</br>";		}		else		{			$year=$this->_year-1;		}								if($this->get_count_week_year($year)-$this->num_week_1sept<$num_of_week)		{			$num_of_week-=$this->get_num_edu_week("1 January $year");			 "1 January ";		}		else		{			$num_of_week+=$this->get_num_edu_week("1 September $year");			$year=$this->_year-1;		}						   strftime('%d.%m.%Y',strtotime($year."-W".$num_of_week."-".$num_of_day));	}				//	// ������� ����������� ���������� ������ � ���� 	//	public function get_count_week_year($year)	{		$day_31Dec=date("D", strtotime("31 December $year"));				if (($day_31Dec=="Mon") || ($day_31Dec=="Sun") ||($day_31Dec=="Sat") ||($day_31Dec=="Tue") ||($day_31Dec=="Wed"))		 {			return 52;		 }		 else		 {			return 53;		 }	}			//	// ������� ����������� ������ ������� ������ �� ����	//	public function get_num_edu_week($date)	{		if ($this->month<=8)		{			$year=$this->_year-1;		}		else		{			$year=$this->_year;		}		         $this->num_week_1sept=date("W", strtotime("1 September $year"));				$day_1sept=date("D", strtotime("1 September $year"));        		if ($day_1sept=="Mon"){            $numb_1sept=1;         }         else{            $numb_1sept=0;         }                  if (date("n", strtotime("$date"))<=8)		{			return $this->get_count_week_year($year)-$this->num_week_1sept+$numb_1sept+date("W", strtotime("$date"));		}		else		{			return date("W", strtotime("$date"))-$this->num_week_1sept+$numb_1sept;		}	}			//    //������� ��������� �������� �������� �� ��������� �����    //	public function dali($string)	{		$i=1;		$tok = strtok($string, " ");				while($tok){			$mas[$i]=$tok;			$i++;			$tok = strtok(" ");		}		return $mas;	}		//    //������� ���������� �����    //	public function sokrat($mas)	{		$len=6;		$vowel=array('�','�','�','�','�','�','�','�','�','�','�','�');		$out_string='';		foreach($mas as $string){			$len_str=strlen($string);			if($len<=$len_str){				$str=substr($string,0,$len);				foreach($vowel as $value){					if($str[$len-1]==$value){						$str=substr($string,0,$len+1);					}										}				$out_string.=$str." ";			}			else{				$out_string.=$string." ";			}		}		return $out_string;	}		    function rasp($dw,$param,$person,$type)	{		if ($param=='date'){			//���������� ����� ������� ������			$week=$this->get_num_edu_week($dw);			//���������� ��������			$parity=$this->get_parity($week);			//���������� ����� ��� ������			$day=$this->get_num_day($dw);			//�������� �� ����� ������� ����� ��������			if ($person=='lecturer'){				$table='schedule_pr';			}			else{				$table='schedule_gr';			}			//������ � ����			$mas=$this->msql->Select("SElECT * FROM  $table WHERE day=$day and grup='$type' and (parity='$parity' or parity='����') and n_week<='$week' and k_week>='$week'");			//���������� ������		}		else{			//���������� ��������			$parity=$this->get_parity($dw);					//�������� �� ����� ������� ����� ��������			if ($person=='lecturer'){				$table='schedule_pr';			}			else{				$table='schedule_gr';			}					//������ � ����			$mas=$this->msql->Select("SElECT * FROM  $table WHERE grup='$type' and (parity='$parity' or parity='����') and n_week<='$dw' and k_week>='$dw'");		}				//���������� ������ �� ����		for ($i=0;$i<count($mas);$i++){		for ($j=0;$j<count($mas);$j++){			if ($mas[$j][day]>$mas[$i][day]){							$bufer=$mas[$i];				$mas[$i]=$mas[$j];				$mas[$j]=$bufer;				}			elseif($mas[$j][day]==$mas[$i][day]){				if (($this->para($mas[$j][time]))>($this->para($mas[$i][time]))){					$bufer=$mas[$i];					$mas[$i]=$mas[$j];					$mas[$j]=$bufer;				}			}					}		}			                  //��������� ������������� ������        for ($i=0;$i<count($mas);$i++)		{			$k=$this->para($mas[$i][time]);			if($k>$f)			{				$f=$k;			}			if($mas[$i][day]==1)			{								$ponedelnik[$k]=array(								'start_time'=>$mas[$i][start_time], 								'end_time'=>$mas[$i][end_time], 								'para'=>$this->para($mas[$i][time]), 								'discip'=>$this->sokrat($this->dali($mas[$i][discip])), 								'n_week'=>$mas[$i][n_week], 								'k_week'=>$mas[$i][k_week], 								'parity'=>$mas[$i][parity], 								'lecturer' => $mas[$i][lecturer], 								'address'=>$mas[$i][address], 								'grup' => $rasp[$i][grup], 								'date'=>$this->date_of_week($dw, $mas[$i][day])								);															}			if($mas[$i][day]==2)			{				$vtornik[$k]=array(								'start_time'=>$mas[$i][start_time], 								'end_time'=>$mas[$i][end_time], 								'para'=>$this->para($mas[$i][time]), 								'discip'=>$this->sokrat($this->dali($mas[$i][discip])),								'n_week'=>$mas[$i][n_week], 								'k_week'=>$mas[$i][k_week], 								'parity'=>$mas[$i][parity], 								'lecturer' => $mas[$i][lecturer], 								'address'=>$mas[$i][address], 								'grup' => $rasp[$i][grup], 								'date'=>$this->date_of_week($dw, $mas[$i][day])								);			}			if($mas[$i][day]==3)			{				$sreda[$k]=array(								'start_time'=>$mas[$i][start_time], 								'end_time'=>$mas[$i][end_time], 								'para'=>$this->para($mas[$i][time]), 								'discip'=>$this->sokrat($this->dali($mas[$i][discip])),								'n_week'=>$mas[$i][n_week], 								'k_week'=>$mas[$i][k_week], 								'parity'=>$mas[$i][parity], 								'lecturer' => $mas[$i][lecturer], 								'address'=>$mas[$i][address], 								'grup' => $rasp[$i][grup], 								'date'=>$this->date_of_week($dw, $mas[$i][day])								);			}			if($mas[$i][day]==4)			{				$chetverg[$k]=array(								'start_time'=>$mas[$i][start_time], 								'end_time'=>$mas[$i][end_time], 								'para'=>$this->para($mas[$i][time]), 								'discip'=>$this->sokrat($this->dali($mas[$i][discip])),								'n_week'=>$mas[$i][n_week], 								'k_week'=>$mas[$i][k_week], 								'parity'=>$mas[$i][parity], 								'lecturer' => $mas[$i][lecturer], 								'address'=>$mas[$i][address], 								'grup' => $rasp[$i][grup], 								'date'=>$this->date_of_week($dw, $mas[$i][day])								);			}			if($mas[$i][day]==5)			{				$pyatnica[$k]=array(								'start_time'=>$mas[$i][start_time], 								'end_time'=>$mas[$i][end_time], 								'para'=>$this->para($mas[$i][time]), 								'discip'=>$this->sokrat($this->dali($mas[$i][discip])),								'n_week'=>$mas[$i][n_week], 								'k_week'=>$mas[$i][k_week], 								'parity'=>$mas[$i][parity], 								'lecturer' => $mas[$i][lecturer], 								'address'=>$mas[$i][address], 								'grup' => $rasp[$i][grup], 								'date'=>$this->date_of_week($dw, $mas[$i][day])								);			}			if($mas[$i][day]==6)			{				$subbota[$k]=array(								'start_time'=>$mas[$i][start_time], 								'end_time'=>$mas[$i][end_time], 								'para'=>$this->para($mas[$i][time]), 								'discip'=>$this->sokrat($this->dali($mas[$i][discip])),								'n_week'=>$mas[$i][n_week], 								'k_week'=>$mas[$i][k_week], 								'parity'=>$mas[$i][parity], 								'lecturer' => $mas[$i][lecturer], 								'address'=>$mas[$i][address], 								'grup' => $rasp[$i][grup], 								'date'=>$this->date_of_week($dw, $mas[$i][day])								);			}					}        $mas_rasp2 = array( '1'=>$ponedelnik, 								'2'=>$vtornik, 								'3'=>$sreda, 								'4'=>$chetverg, 								'5'=>$pyatnica, 								'6'=>$subbota,								'max'=>$f								);		return $mas_rasp2;                }          	}