<?php
$data = array(200,210,199,230,210,198);
$data2 = array(-88.67,-174.67,70.33,469.33,-211.67,-64.67);
$month = array('Januari','February','Maret','April','Mei','Juni');
function acf($data){
  $i = 0;
  $sum = 0;
  $sum_d = 0;
  $r = array();
  $count_d = count($data);
  $acf = array();
  foreach($data as $d){
	$sum += $d;
  }
  $sum = $sum/$count_d;
  foreach($data as $d){
	$temp;
	$temp_sum = 0;
	if($i>$count_d-2){
		$data[6]=0;
	}
	$sum_d+=pow($data[$i]-$sum,2);
	for($j=0;$j<$count_d;$j++){
	  for($k=$j;$k<$count_d-1;$k++){
		  $temp = (($data[$k]-$sum)*($data[$k+1]-$sum));
		  if($k==0){
			  $sum_c[$i]=0;
		  }
		  $temp_sum += $temp;
	  }
	  $r[$j]=$temp_sum;
	  $temp_sum = 0;
	}
	$i++;
  }
  foreach($r as $i){
	  $acf[] = $i/$sum_d;
  }
  return $acf;
}

function r($data){
  $temp;
  $temp_sum = 0;
  $r = array();
  $count_d = count($data);
  $sum = 0;
  foreach($data as $d){
	$sum += $d;
  }
  $sum = $sum/$count_d;
  for($j=0;$j<$count_d-1;$j++){
	for($k=$j;$k<$count_d-1;$k++){
		$temp = (($data[$k]-$sum)*($data[$k+1]-$sum));
		$temp_sum += $temp;
	}
	$r[$j]=$temp_sum;
	$temp_sum = 0;
  }
  return $r;
}
function sacf($dt,$acf){
	$sacf = array();
	$sum = 0;
	foreach($dt as $q){
		$sum += $q;
	}
	$i = 0;
	foreach($dt as $q){
		if($i>0 && $i<count($dt)-1){
			$sacf[$i] = pow(1+(2*pow($sum,2)+pow($acf[$i],2)),0.5)/(pow((count($dt)-1+1),0.5));
		}else{
			$sacf[$i] = pow(1+(2*pow($sum,2)),0.5)/(pow((count($dt)-1+1),0.5));
		}
		$i++;
	}
	return $sacf;
}

function pacf($data,$r){
	$t21 = array();
	$sr = 1/pow((6+1-1),0.5);
	foreach($data as $i => $d){
		if($i<count($data)){
			if($i==0){
				$t21[] = $r[$i];
			}elseif($i==1){
				$t21[] = $r[$i]-($t21[$i-1]*$r[$i-1])/(1-($t21[$i-1]*$r[$i-1]));
			}else{
				$r21 = $r[$i-2]-($t21[$i-1]*$r[$i-2]);
				$t21[] = $r[$i]-(($r21*$r[$i-1])+($t21[$i-1]*$r[$i-2]))/(1-(($r21*$r[$i-1])+($t21[$i-1]*$r[$i-2])));
			}
		}
	}
	return $t21;
}

function acf_awal($data){
  $sum = 0;
  $acf_akhir = array();
  foreach($data as $d){
	  $sum += $d;
  }
  $acf_awal = $sum/count($data);
  foreach($data as $d){
	  $acf_akhir[] = $d-$acf_awal;
  }
  return $acf_akhir;
}

function array_1($data){
  $m1 = array();
  for($i=0;$i<2;$i++){
	for($j=0;$j<count($data)-1;$j++){
	  if($i==0){
		$m1[$i][]=1;
	  }else{
		 $m1[$i][]=$data[$j];
	  }
	}
  }
  return $m1;
}

function array_y($data){
  $m1 = array();
  for($i=0;$i<count($data)-1;$i++){
    $m1[$i][] = $data[$i+1];
  }
  return $m1;
}

function array_2($data){
  $m1 = array();
  for($i=0;$i<count($data)-1;$i++){
	$m1[$i]=array(1,$data[$i]);
  }
  return($m1);
}

function accent($data){
  $temp = array();
  $i = 0;
  $matriks = $data[0][0]*$data[1][1] - $data[0][1]*$data[1][0];
  $accen = array();
  if($matriks != 0){
	foreach($data as $j => $value){
	  foreach($value as $a){
		if($i == 1 || $i == 2){
		  $accen[$j][] = -1*$a/$matriks;
		}else{
		  $accen[$j][] = $a/$matriks;
		}
		$i++;
	  }
	} 
  }
  return arraySwap($accen,0,1);
}

function arraySwap($arr, $src, $dst){
	$tmp = $arr[1][$dst];
	$arr[1][$dst] = $arr[0][$src];
	$arr[0][$src] = $tmp;
	return $arr; 
}

function perkalian_matriks($data,$data2){
  $d = array();
  for($i=0;$i<sizeof($data);$i++){
     for($j=0;$j<sizeof($data2[0]);$j++){
         $d[$i][$j] = 0;
         for($k=0;$k<sizeof($data[0]);$k++){
             // echo $data[$i][$j]." x ".$data2[$k][$j]." = ".$data[$i][$k]*$data2[$k][$j]."<br>";
             $d[$i][$j] += $data[$i][$k]*$data2[$k][$j];
         }
     }
  }
  return $d;
}

function data_ma($data){
    $data_ma = array();
    for($i=0;$i<count($data)-1;$i++){
        $data_ma[]=$data[$i]-$data[$i+1];
        // echo $data[$i]."-".$data[$i+1]."=".$data_ma[$i]."<br/>";
    }
    return $data_ma;
}
// echo "<pre>";
// print_r(array_1($data));
// print_r(array_2($data));
// print_r(array_y($data));
// print_r(array_2(data_ma($data)));
// $zz1_ar = perkalian_matriks(array_1($data),array_2($data));
// $z1y_ar = perkalian_matriks(array_1($data),array_y($data));
// $ar = perkalian_matriks(accent($zz1_ar),$z1y_ar);
// print_r($ar);
// $zz1_ma = perkalian_matriks(array_1(data_ma($data)),array_2(data_ma($data)));
// print_r(accent($zz1_ma));
// $z1y_ma = perkalian_matriks(array_1(data_ma($data)), array_y(data_ma($data)));
// print_r($z1y_ma);
// $ma = perkalian_matriks(accent($zz1_ma),$z1y_ma);
// print_r($ma);
//print_r(pacf($data,acf($data)));
//print_r(acf($data));
//print_r(sacf($data2,acf($data)));
//$sacf = sacf($data2,acf($data));
//foreach(acf($data) as $i => $d){
//	echo $d/$sacf[$i].",";
//}
//=(1+(2*(C10^2))^0.5)/((6-1+1)^0.5)
// echo "</pre>";
?>