<?php 
//strating persian date class "jdf"
class pdate{
	function jdate($format,$timestamp='',$none='',$time_zone='Asia/Tehran',$tr_num='fa'){
		
	$T_sec=0;
	if($time_zone!='local')date_default_timezone_set(($time_zone=='')?'Asia/Tehran':$time_zone);
 	$ts=$T_sec+(($timestamp=='' or $timestamp=='now')?time():tr_num($timestamp));
 	$date=explode('_',date('H_i_j_n_O_P_s_w_Y',$ts));
	
 	list($j_y,$j_m,$j_d)=$this->gregorian_to_jalali($date[8],$date[3],$date[2]);
	 $doy=($j_m<7)?(($j_m-1)*31)+$j_d-1:(($j_m-7)*30)+$j_d+185;
 	$kab=($j_y%33%4-1==(int)($j_y%33*.05))?1:0;
 	$sl=strlen($format);
 	$out='';
	
 	for($i=0; $i<$sl; $i++){
  	$sub=substr($format,$i,1);
  	if($sub=='\\'){
	$out.=substr($format,++$i,1);
	continue;
  	}
	
  	switch($sub){

		case'B':
		case'e':
		case'g':
		case'G':
		case'h':
		case'I':
		case'T':
		case'u':
		case'Z':
		$out.=date($sub,$ts);
		break;
	
		case'a':
		$out.=($date[0]<12)?'ق.ظ':'ب.ظ';
		break;
	
		case'A':
		$out.=($date[0]<12)?'قبل از ظهر':'بعد از ظهر';
		break;
	
		case'b':
		$out.=(int)($j_m/3.1)+1;
		break;
	
		case'c':
		$out.=$j_y.'/'.$j_m.'/'.$j_d.' ،'.$date[0].':'.$date[1].':'.$date[6].' '.$date[5];
		break;
	
		case'C':
		$out.=(int)(($j_y+99)/100);
		break;
	
		case'd':
		$out.=($j_d<10)?'0'.$j_d:$j_d;
		break;
	
		case'D':
		$out.=$this->jdate_words(array('kh'=>$date[7]),' ');
		break;
	
		case'f':
		$out.=$this->jdate_words(array('ff'=>$j_m),' ');
		break;
	
		case'F':
		$out.=$this->jdate_words(array('mm'=>$j_m),' ');
		break;
	
		case'H':
		$out.=$date[0];
		break;
	
		case'i':
		$out.=$date[1];
		break;
	
		case'j':
		$out.=$j_d;
		break;
	
		case'J':
		$out.=$this->jdate_words(array('rr'=>$j_d),' ');
		break;
	
		case'k';
		$out.=$this->tr_num(100-(int)($doy/($kab+365)*1000)/10,$tr_num);
		break;
	
		case'K':
		$out.=$this->tr_num((int)($doy/($kab+365)*1000)/10,$tr_num);
		break;
	
		case'l':
		$out.=$this->jdate_words(array('rh'=>$date[7]),' ');
		break;
	
		case'L':
		$out.=$kab;
		break;
	
		case'm':
		$out.=($j_m>9)?$j_m:'0'.$j_m;
		break;
	
		case'M':
		$out.=$this->jdate_words(array('km'=>$j_m),' ');
		break;
	
		case'n':
		$out.=$j_m;
		break;
	
		case'N':
		$out.=$date[7]+1;
		break;
	
		case'o':
		$jdw=($date[7]==6)?0:$date[7]+1;
		$dny=364+$kab-$doy;
		$out.=($jdw>($doy+3) and $doy<3)?$j_y-1:(((3-$dny)>$jdw and $dny<3)?$j_y+1:$j_y);
		break;
	
		case'O':
		$out.=$date[4];
		break;
	
		case'p':
		$out.=$this->jdate_words(array('mb'=>$j_m),' ');
		break;
	
		case'P':
		$out.=$date[5];
		break;
	
		case'q':
		$out.=$this->jdate_words(array('sh'=>$j_y),' ');
		break;
	
		case'Q':
		$out.=$kab+364-$doy;
		break;
	
		case'r':
		$key=$this->jdate_words(array('rh'=>$date[7],'mm'=>$j_m));
		$out.=$date[0].':'.$date[1].':'.$date[6].' '.$date[4]
		.' '.$key['rh'].'، '.$j_d.' '.$key['mm'].' '.$j_y;
		break;
	
		case's':
		$out.=$date[6];
		break;
	
		case'S':
		$out.='ام';
		break;
	
		case't':
		$out.=($j_m!=12)?(31-(int)($j_m/6.5)):($kab+29);
		break;
	
		case'U':
		$out.=$ts;
		break;
	
		case'v':
		 $out.=$this->jdate_words(array('ss'=>substr($j_y,2,2)),' ');
		break;
	
		case'V':
		$out.=$this->jdate_words(array('ss'=>$j_y),' ');
		break;
	
		case'w':
		$out.=($date[7]==6)?0:$date[7]+1;
		break;
	
		case'W':
		$avs=(($date[7]==6)?0:$date[7]+1)-($doy%7);
		if($avs<0)$avs+=7;
		$num=(int)(($doy+$avs)/7);
		if($avs<4){
		 $num++;
		}elseif($num<1){
		 $num=($avs==4 or $avs==(($j_y%33%4-2==(int)($j_y%33*.05))?5:4))?53:52;
		}
		$aks=$avs+$kab;
		if($aks==7)$aks=0;
		$out.=(($kab+363-$doy)<$aks and $aks<3)?'01':(($num<10)?'0'.$num:$num);
		break;
	
		case'y':
		$out.=substr($j_y,2,2);
		break;
	
		case'Y':
		$out.=$j_y;
		break;
	
		case'z':
		$out.=$doy;
		break;
	
		default:$out.=$sub;
	  }
	 }
 		return($tr_num!='en')?$this->tr_num($out,'fa','.'):$out;
	}



	function jmktime($h='',$m='',$s='',$jm='',$jd='',$jy='',$is_dst=-1){
	 		$h=$this->tr_num($h);
			$m=$this->tr_num($m);
			$s=$this->tr_num($s);
			$jm=$this->tr_num($jm);
			$jd=$this->tr_num($jd);
			$jy=$this->tr_num($jy);
	 	if($h=='' and $m=='' and $s=='' and $jm=='' and $jd=='' and $jy==''){
		return mktime();
	 }else{
		list($year,$month,$day)=$this->jalali_to_gregorian($jy,$jm,$jd);
		return mktime($h,$m,$s,$month,$day,$year,$is_dst);
	 }
	}
	
	
	function tr_num($str,$mod='en',$mf='٫'){
	 $num_a=array('0','1','2','3','4','5','6','7','8','9','.');
	 $key_a=array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹',$mf);
	 return($mod=='fa')?str_replace($num_a,$key_a,$str):str_replace($key_a,$num_a,$str);
	}
	
	
	function jdate_words($array,$mod=''){
	 foreach($array as $type=>$num){
	  $num=(int)$this->tr_num($num);
	  switch($type){
	
		case'ss':
		$sl=strlen($num);
		$xy3=substr($num,2-$sl,1);
		$h3=$h34=$h4='';
		if($xy3==1){
		 $p34='';
		 $k34=array('ده','یازده','دوازده','سیزده','چهارده','پانزده','شانزده','هفده','هجده','نوزده');
		 $h34=$k34[substr($num,2-$sl,2)-10];
		}else{
		 $xy4=substr($num,3-$sl,1);
		 $p34=($xy3==0 or $xy4==0)?'':' و ';
		 $k3=array('','','بیست','سی','چهل','پنجاه','شصت','هفتاد','هشتاد','نود');
		 $h3=$k3[$xy3];
		 $k4=array('','یک','دو','سه','چهار','پنج','شش','هفت','هشت','نه');
		 $h4=$k4[$xy4];
		}
		$array[$type]=(($num>99)?str_ireplace(array('12','13','14','19','20')
		,array('هزار و دویست','هزار و سیصد','هزار و چهارصد','هزار و نهصد','دوهزار')
		,substr($num,0,2)).((substr($num,2,2)=='00')?'':' و '):'').$h3.$p34.$h34.$h4;
		break;
	
		case'mm':
		$key=array
		('فروردین','اردیبهشت','خرداد','تیر','مرداد','شهریور','مهر','آبان','آذر','دی','بهمن','اسفند');
		$array[$type]=$key[$num-1];
		break;
	
		case'rr':
		$key=array('یک','دو','سه','چهار','پنج','شش','هفت','هشت','نه','ده','یازده','دوازده','سیزده',
		'چهارده','پانزده','شانزده','هفده','هجده','نوزده','بیست','بیست و یک','بیست و دو','بیست و سه',
		'بیست و چهار','بیست و پنج','بیست و شش','بیست و هفت','بیست و هشت','بیست و نه','سی','سی و یک');
		$array[$type]=$key[$num-1];
		break;
	
		case'rh':
		$key=array('یکشنبه','دوشنبه','سه شنبه','چهارشنبه','پنجشنبه','جمعه','شنبه');
		$array[$type]=$key[$num];
		break;
	
		case'sh':
		$key=array('مار','اسب','گوسفند','میمون','مرغ','سگ','خوک','موش','گاو','پلنگ','خرگوش','نهنگ');
		$array[$type]=$key[$num%12];
		break;
	
		case'mb':
		$key=array('حمل','ثور','جوزا','سرطان','اسد','سنبله','میزان','عقرب','قوس','جدی','دلو','حوت');
		$array[$type]=$key[$num-1];
		break;
	
		case'ff':
		$key=array('بهار','تابستان','پاییز','زمستان');
		$array[$type]=$key[(int)($num/3.1)];
		break;
	
		case'km':
		$key=array('فر','ار','خر','تی‍','مر','شه‍','مه‍','آب‍','آذ','دی','به‍','اس‍');
		$array[$type]=$key[$num-1];
		break;
	
		case'kh':
		$key=array('ی','د','س','چ','پ','ج','ش');
		$array[$type]=$key[$num];
		break;
	
		default:$array[$type]=$num;
	  }
	 }
	 return($mod=='')?$array:implode($mod,$array);
	}
//convert gregorian_to_jalali

	function gregorian_to_jalali($g_y,$g_m,$g_d,$mod=''){
	 //$g_y=tr_num($g_y); $g_m=tr_num($g_m); $g_d=tr_num($g_d);/* <= :اين سطر ، جزء تابع اصلي نيست */
 	 $d_4=$g_y%4;
	 $g_a=array(0,0,31,59,90,120,151,181,212,243,273,304,334);
	 $doy_g=$g_a[(int)$g_m]+$g_d;
	 if($d_4==0 and $g_m>2)$doy_g++;
	 $d_33=(int)((($g_y-16)%132)*.0305);
	 $a=($d_33==3 or $d_33<($d_4-1) or $d_4==0)?286:287;
	 $b=(($d_33==1 or $d_33==2) and ($d_33==$d_4 or $d_4==1))?78:(($d_33==3 and $d_4==0)?80:79);
	 if((int)(($g_y-10)/63)==30){$a--;$b++;}
	 if($doy_g>$b){
	  $jy=$g_y-621; $doy_j=$doy_g-$b;
	 }else{
	  $jy=$g_y-622; $doy_j=$doy_g+$a;
	 }
	 if($doy_j<187){
	  $jm=(int)(($doy_j-1)/31); $jd=$doy_j-(31*$jm++);
	 }else{
	  $jm=(int)(($doy_j-187)/30); $jd=$doy_j-186-($jm*30); $jm+=7;
	 }
	 return($mod=='')?array($jy,$jm,$jd):$jy.$mod.$jm.$mod.$jd;
	}



}