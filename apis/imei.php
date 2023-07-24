<?php

include('config.php');
$cons="select access_t from token where id=1";
$res=mysqli_query($mysqli,$cons);
if($row=mysqli_fetch_array($res)){
	$token=$row['access_t'];
	//$cs=$row['c_secret'];
	//$token="lA3TpXx3AHTOxLyh5BGAtL1Ymj8d";
	
}
//$token="lA3TpXx3AHTOxLyh5BGAtL1Ymj8d";
$imei=$_GET['imei'];
//$imei="357098100477705";
//$dn='2214615904';


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://altanredes-prod.apigee.net/ac/v1/imeis/".$imei."/status",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_HTTPHEADER => array(
    "authorization: Bearer ".$token,
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
     $response;
}

$obj=json_decode($response,true);
//var_dump($obj);
if(isset($obj['errorCode'])){
	echo 'No Existe Imei';
}

else{
//var_dump($obj);echo "<br>";echo "<br>";echo "<br>";
/*echo "imei: ".$obj['imei']['imei'];echo "<br>";
echo "Homologado:".$obj['imei']['homologated'];echo "<br>";
echo "bloqueado: ".$obj['imei']['blocked'];echo "<br>";
echo "Volte Compatible: ".$obj['deviceFeatures']['volteCapable'];echo "<br>";
echo "Banda 28: ".$obj['deviceFeatures']['band28'];echo "<br>";
echo "Modelo: ".$obj['deviceFeatures']['model'];echo "<br>";
echo "Marca: ".$obj['deviceFeatures']['brand'];echo "<br>";	*/
$data = array("imei" => $obj['imei']['imei'], "Homologado"=>$obj['imei']['homologated'], "Bloqueado" => $obj['imei']['blocked'],"Volte Compatible"=>$obj['deviceFeatures']['volteCapable'],"Banda 28"=>$obj['deviceFeatures']['band28'],"Modelo"=>$obj['deviceFeatures']['model'],"Marca"=>$obj['deviceFeatures']['brand']);
echo json_encode($data);
}
?>