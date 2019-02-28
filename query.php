<?php
/*
The MIT License (MIT)

Copyright (c) 2019 pon & ont eth port monitor

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

$pw = "public"; // Set your snmp read community string here


//error_reporting(E_ALL);
//ini_set('display_errors', 1);


$type = $_GET["type"];
$ont_type = $_GET["ont_type"];
$node = $_GET["node"]; 
$shelf = $_GET["shelf"];
$slot = $_GET["slot"];
$pon = $_GET["pon"];
$ont = $_GET["ont"];
$ethport = $_GET["ethport"];

$failure = "$type $ont_type FAILURES: ";

switch($type)
{
	case "pon":
		$pon_mib = "30".(($shelf-1)*2)+$slot."0".$pon;

		$start_mib = ".1.3.6.1.2.1.31.1.1.1.10.";
		$in_mib = $start_mib.$pon_mib;
		
		$start_mib = ".1.3.6.1.2.1.31.1.1.1.6.";
		$out_mib = $start_mib.$pon_mib;
		break;
	case "eth":
		$ont_mib = (($ont - 1) * 32) + $ethport + 100000;;
		
		$start_mib = ".1.3.6.1.2.1.31.1.1.1.10.";
		$in_mib = $start_mib.$ont_mib;
		
		$start_mib = ".1.3.6.1.2.1.31.1.1.1.6.";
		$out_mib = $start_mib.$ont_mib;
		//$failure.=$in_mib." ";
		break;
	
}
function errorHandler($errno, $errstr, $errfile, $errline) {
    throw new Exception($errstr, $errno);
}
set_error_handler('errorHandler');


try 
{
	$y_in_a = str_replace("Counter64: ","",snmp2_get($node,$pw,$in_mib,1000000));
}
catch (Exception $e) 
{
	$y_in_a = false;
	$failure.="in_a | ";
}
try 
{
	$y_out_a = str_replace("Counter64: ","",snmp2_get($node,$pw,$out_mib,1000000));
}
catch (Exception $e) 
{
	$y_out_a = false;
	$failure.="out_a | ";
}


sleep(3);
try
{
	$y_in_b = str_replace("Counter64: ","",snmp2_get($node,$pw,$in_mib,1000000));
}	
catch (Exception $e) 
{
	$y_in_b = false;
	$failure.="in_b | ";
}

try
{
	$y_out_b = str_replace("Counter64: ","",snmp2_get($node,$pw,$out_mib,1000000));
}	
catch (Exception $e) 
{
	$y_out_b = false;
	$failure.="out_b | ";
}




if(($y_in_a !== false && $y_in_b !== false) || ($y_in_a > $y_in_b))
{
	if($type == "pon")
		$ydown = ((($y_in_b - $y_in_a) / 3 ) / 125000);
	elseif($type == "eth" && $ont_type == "halfer")
		$ydown = ((($y_in_b - $y_in_a) / 3 ) / 250000);
	else
		$ydown = ((($y_in_b - $y_in_a) / 3 ) / 125000);

	if ($ydown > 0 && $ydown < 1) $ydown=1;
	else $ydown = round($ydown);
}
else
	$ydown = 0;

if(($y_out_a !== false && $y_out_b !== false) || ($y_out_a > $y_out_b))
{
	if($type == "pon")
		$yup = ((($y_out_b - $y_out_a) / 3 ) / 125000);
	elseif($type == "eth" && $ont_type == "halfer")
		$yup = ((($y_out_b - $y_out_a) / 3 ) / 250000);
	else
		$yup = ((($y_out_b - $y_out_a) / 3 ) / 125000);

	if ($yup > 0 && $yup < 1) $yup=1;
	else $yup = round($yup);
}
else
	$yup = 0;

if($yup < 0)
	$yup = 0;
if($ydown < 0)
	$ydown = 0;

header("Content-type: text/json");
// The x value is the current JavaScript time, which is the Unix time multiplied by 1000.
$x = time() * 1000;
// Create a PHP array and echo it as JSON
$ret = array(array($x, $ydown),array($x,$yup));
echo json_encode($ret);

// to watch logging, touch log.txt then chmod 777 log.txt then uncomment these bottom two lines
//$file = "./log.txt";
//file_put_contents($file,$type." ".json_encode($ret)."\n"."$failure"."\n\n", FILE_APPEND);
?>
