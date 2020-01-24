<?php


header("Content-type: application/json");
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
$survey_id=	865133;

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

//Export responses in base64 encoded string
$response = $lsJSONRPCClient->list_participants($sessionKey,$survey_id, 0, 1000,true, true, $aConditions = array());
//var_dump($surveys);


//~ For big array : base64 encoded
if(is_array($response)){
    echo json_encode($response);
    
    // print_r(base64_decode($idnya), null );
    // echo($idnya);
} else {
    print_r(base64_decode($response), null );
}
//~ release the session key
$lsJSONRPCClient->release_session_key( $sessionKey );
 ?>
