<!DOCTYPE html>
<html>
<head>
	<title>LimeSurvey</title>
        <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<center><h1>LimeSurvey</h1></center>
	<?php


//header("Content-type: application/json");
// without composer this line can be used
// require_once 'path/to/your/rpcclient/jsonRPCClient.php';
require_once './jsonrpcphp/jsonRPCClient.php';
// with composer support just add the autoloader
// include_once 'vendor/autoload.php';

// define( 'LS_BASEURL', 'https://survey.stsn-nci.ac.id/index.php/');  // adjust this one to your actual LimeSurvey URL
$rpcUrl="https://survey.stsn-nci.ac.id/index.php/admin/remotecontrol";
define( 'LS_USER', 'kelompok1' );
define( 'LS_PASSWORD', 'l0l1t4c4nt1k' );

// the survey to process
$survey_id= 865133;

// instantiate a new client
// $myJSONRPCClient = new \jsonrpcphp\JsonRPCClient( LS_BASEURL.'/admin/remotecontrol' );
$lsJSONRPCClient = new \org\jsonrpcphp\jsonRPCClient($rpcUrl);

// receive session key
$sessionKey= $lsJSONRPCClient->get_session_key( LS_USER, LS_PASSWORD );

// receive surveys list current user can read
$groups = $lsJSONRPCClient->list_surveys( $sessionKey );


//API list_participants
$response = $lsJSONRPCClient->list_participants($sessionKey,$survey_id, 0, 1000,true, true, $aConditions = array());

//loop cek array
if(is_array($response)){
//    echo json_encode($response);
    
} else {
    print_r(base64_decode($response), null );
}




function build_table($response){
    // membuat tabel
    $html = '<table>';
    // mengisi header tabel
    $html .= '<tr>';
    foreach($response[0] as $key=>$value){
            $html .= '<th>' . htmlspecialchars($key) . '</th>';
        }
    $html .= '</tr>';

    for ($i=0; $i < sizeof($response); $i++) { 
        $html .= '<tr>';
        //menampilkan isi tid
        $html .= '<td>' . $response[$i]["tid"]  . '</td>';
        //menampilkan isi token
        $html .= '<td>' . $response[$i]["token"]  . '</td>';
        //menampilkan isi participant_info
        $html .= '<td>' . $response[$i]["participant_info"]["firstname"]  . '</td>';
        $html .= '</tr>';
    }

    // selesai membuat tabel

    $html .= '</table>';
    return $html;
}


echo build_table($response);

//~ release the session key
$lsJSONRPCClient->release_session_key( $sessionKey );
 ?>
</body>
</html>
