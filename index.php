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
//print_r($groups, null );

//Export token response in a survey.
//$response = $lsJSONRPCClient->export_responses($sessionKey,$survey_id,'csv', null,'complete', 'short',$aFields = null);
//var_dump($surveys);


//respon jadi
$response = $lsJSONRPCClient->list_participants($sessionKey,$survey_id, 0, 1000,true, true, $aConditions = array());
//var_dump($surveys);


//loop cek array
if(is_array($response)){
    echo json_encode($response);
    
    // print_r(base64_decode($idnya), null );
    // echo($idnya);
} else {
    print_r(base64_decode($response), null );
}

//kira2 array

function build_table($response){
    // start table
    $html = '<table>';
    // header row
    $html .= '<tr>';
    foreach($response[0] as $key=>$value){
            $html .= '<th>' . htmlspecialchars($key) . '</th>';
        }
    $html .= '</tr>';

    // data rows
    foreach( $response as $key=>$value){
        $html .= '<tr>';
        foreach($value as $key2=>$value2){
            $html .= '<td>' . htmlspecialchars($value2) . '</td>';
        }
        $html .= '</tr>';
    }

    // finish table and return it

    $html .= '</table>';
    return $html;
}

// $array = array(
//     array('first'=>'tom', 'last'=>'smith', 'email'=>'tom@example.org', 'company'=>'example ltd'),
//     array('first'=>'hugh', 'last'=>'blogs', 'email'=>'hugh@example.org', 'company'=>'example ltd'),
//     array('first'=>'steph', 'last'=>'brown', 'email'=>'steph@example.org', 'company'=>'example ltd')
// );

echo build_table($response);
//~ release the session key
$lsJSONRPCClient->release_session_key( $sessionKey );
 ?>
</body>
</html>