<?php
function myterm($m,$y,$t)
{
	for($i=1;$i<=$t;$i++)
	{
			
			$mydate=date_format(date_create("$y-$m"),"M/Y");
			
			$cdate=date("M/Y");
				if($cdate==$mydate)
				{
					echo "<option value='".$i."' selected>".$mydate."</option>";
				}
				else
				{
					echo "<option value='".$i."'>".$mydate."</option>";
				}
			$m++;
			if($m==13)
			{
				$m=1;
				$y++;
			}
			
			
		
		
	}
}

function setDate($datec) {
    
    $datec=  date_create($datec);
    return date_format($datec,"Y-m-d");
    
}

function getMyDate($datec) {
    
    $datec=  date_create($datec);
    return date_format($datec,"d-m-Y");
    
}


function getIndianCurrency($number)
{
   $no = round($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
  return $result . "Rupees ";
}


function fnameToMname($name)
{
	$name = explode(' ', $name);

 $fname = (isset($name[count($name)-2])) ? $name[count($name)-2] : '';

 $lastName = (isset($name[count($name)-1])) ? $name[count($name)-1] : '';

 return $fname."  ".$lastName ;
}


function smsCreditKlal()
{
  	$username = "caketulstaff@gmail.com";
	$hash = "";
	
	// You shouldn't need to change anything here.	
	$data = "username=".$username."&hash=".$hash;
	$ch = curl_init('http://api.textlocal.in/balance/?');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	  $credits = curl_exec($ch);
	// This is the number of credits you have left	
	// balance['sms'];
	$arr = json_decode($credits, true);
	//print_r($arr);
	echo $arr['balance']['sms'];
	curl_close($ch);



        
}


function sendSms($mobile,$sms) {
    	// Authorisation details.
	$username = "caketulstaff@gmail.com";
	$hash = "";

	// Config variables. Consult http://api.textlocal.in/docs for more info.
	$test = "0";

	// Data for text message. This is the text message data.
	$sender = "CAKETU"; // This is who the message appears to be from.
	$numbers = $mobile; // A single number or a comma-seperated list of numbers
	$message = $sms;
	// 612 chars or less
	// A single number or a comma-seperated list of numbers
	$message = urlencode($message);
	$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
	$ch = curl_init('http://api.textlocal.in/send/?');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch); // This is the result from the API
       // print_r($result);
	curl_close($ch);
	//print_r($result);
	
}
?>
