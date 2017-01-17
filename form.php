<?php

error_reporting(E_ALL);

define("ZDAPIKEY", "qzbtxC9pQI5f9skuVke7oV0y6mRdXV4WqFCVEefM");
define("ZDUSER", "rachel@steelhouse.com");
define("ZDURL", "https://steelhouse.zendesk.com/api/v2");

 //File upload
 function curlUpload(){
 	print_r($_FILES);
	 $i = 0;

	 while (is_uploaded_file($_FILES['file_' . $i]['tmp_name'])){
		 $file = fopen(($_FILES['file_' . $i]['tmp_name']), 'r');
		 $filename = ($_FILES['file_' . $i]['name']);
		 $size = ($_FILES['file_' . $i]['size']);

		 $params = fread($file,$size);
		 $ch = curl_init();

		 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		 curl_setopt($ch, CURLOPT_MAXREDIRS, 10 );
		 curl_setopt($ch, CURLOPT_URL, ZDURL.'/uploads.json?filename='.urlencode($filename));
		 curl_setopt($ch, CURLOPT_USERPWD, ZDUSER."/token:".ZDAPIKEY);
		 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		 curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		 curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/binary'));
		 curl_setopt($ch, CURLOPT_POST, true);
		 curl_setopt($ch, CURLOPT_INFILE, $file);
		 curl_setopt($ch, CURLOPT_INFILESIZE, $size);
		 curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Linux; Ripple Zendesk Ticket File Uploader v1.0)");
		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		 curl_setopt($ch, CURLOPT_TIMEOUT, 1000);

		 $output = curl_exec($ch);
		 curl_close($ch);
		 $decoded[$i] = json_decode($output);

		 $i++;

		 if($i == count($_FILES)){
		 	return $decoded;
		 }
	 }
 }

 function curlWrap($url, $json){
	 $ch = curl_init();

	 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
	 curl_setopt($ch, CURLOPT_MAXREDIRS, 10 );
	 curl_setopt($ch, CURLOPT_URL, ZDURL.$url);
	 curl_setopt($ch, CURLOPT_USERPWD, ZDUSER."/token:".ZDAPIKEY);
	 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	 curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
	 curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
	 curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	 curl_setopt($ch, CURLOPT_TIMEOUT, 10);

	 $output = curl_exec($ch);
	 curl_close($ch);
	 $decoded = json_decode($output);
	 return $decoded;
 }

 $arr = array();

foreach($_POST as $key => $value){
	if(preg_match('/^z_/i',$key)){
		$arr[strip_tags($key)] = strip_tags($value);
	}
}


 $files = curlUpload();
 print_r($files);

 $token = array();

 for($i =0; $i < count($files); $i++){
 	$token[$i] = $files[$i]->upload->token;
 }


// JSON data array
$create = json_encode(array(
	'ticket' => array(
		'subject' => $arr['z_subject'],
    "tags" => ['Freemium'],
		'comment' => array(
		"value" => $arr['z_description'],
		'uploads' => $token
		),
		'requester' => array(
			'name' => $arr['z_name'],
			'email' => $arr['z_requester']
			)
		)
	)
);

  $ticket = json_encode($create);
  $return = curlWrap("/tickets.json", $create);

 ?>
