<?php

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
$survey_id=	848579;

// instantiate a new client
// $myJSONRPCClient = new \jsonrpcphp\JsonRPCClient( LS_BASEURL.'/admin/remotecontrol' );
$lsJSONRPCClient = new \org\jsonrpcphp\jsonRPCClient($rpcUrl);

// receive session key
$sessionKey= $lsJSONRPCClient->get_session_key( LS_USER, LS_PASSWORD );

// receive surveys list current user can read
$groups = $lsJSONRPCClient->list_surveys( $sessionKey );
print_r($groups, null );

// release the session key
$lsJSONRPCClient->release_session_key( $sessionKey );