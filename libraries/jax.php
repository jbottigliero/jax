<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'jaxl-2.1.2-rc1/core/jaxl.class.php';
require_once 'jaxl-2.1.2-rc1/env/jaxl.ini'; // The core settings file.

class Jax {
	
	private $JAXL;
	private $CI;

	function __construct(){
		$this->CI =& get_instance();
		$this->CI->JAXL = $this->JAXL;
	}

	public function bind($settings = array()){
		$this->JAXL = new JAXL($settings);

		$this->JAXL->requires(array(
            'JAXL0206'  // XMPP over Bosh
		));

		// Simplified postAuth for prebinding...
		function postAuth($payload, $JAXL){
			$CI = &get_instance();

        	// Store XMPP data in CI Session
       		$CI->session->set_userdata('jid', $JAXL->jid);
        	$CI->session->set_userdata('rid', ($JAXL->bosh['rid'] + 1));
        	$CI->session->set_userdata('sid', $JAXL->bosh['sid']);
		}

		// We don't need to do anything on disconnect since we'll be binding back to this stream.
		function postDisconnect($payload, $JAXL){
			// ==
		}

		$this->_connect_bosh();
	}

	private function _connect_bosh() {
		// Load in the default callback functions
		$this->CI->load->helper('jax');
		
		// Get RID, SID, JID after successful auth 
		$this->JAXL->addPlugin('jaxl_post_auth', 'postAuth');
		// Detect auth failure
		$this->JAXL->addPlugin('jaxl_post_auth_failure','postAuthFailure');

		$this->JAXL->addPlugin('jaxl_post_disconnect', 'postDisconnect');

		// Start up the core...
		$this->JAXL->startCore('bosh');
	}

}