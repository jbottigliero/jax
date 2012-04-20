<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('postAuth')){
    function postAuth($payload, $JAXL){
        $response = array(
            'jid' => $JAXL->jid,
            'sid' => $JAXL->bosh['sid'],
            'rid' => $JAXL->bosh['rid']+1
        );

        $CI = &get_instance();

        // Store XMPP data in CI Session
        $CI->session->set_userdata('jid',$JAXL->jid);
        $CI->session->set_userdata('rid',$JAXL->bosh['rid']+1);
        $CI->session->set_userdata('sid',$JAXL->bosh['sid']);

        $JAXL->JAXL0206('out', $response);
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