<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('postAuth')){
    function postAuth($payload, $JAXL){
        // Default postAuth handler
    }   
}

if(!function_exists('postAuthFailure')){
    function postAuthFailure($payload, $JAXL){
        $response = array('jaxl' => 'authFailed');
        $JAXL->JAXL0206('out', $response);
    }
}

if(!function_exists('doAuth')){
    function doAuth($payload, $JAXL){
        $JAXL->auth('DIGEST-MD5');
    }
}

if(!function_exists('postDisconnect')){
    function postDisconnect($payload, $JAXL){
        exit;
    }
}