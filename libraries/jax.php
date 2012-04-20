<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'jaxl-2.1.2-rc1/core/jaxl.class.php';
require_once 'jaxl-2.1.2-rc1/env/jaxl.ini'; // The core settings file.

class Jax {
	
	private $JAXL;
	private $CI;

	function __construct(){
		$this->CI =& get_instance();
	}

	public function bind($settings = array()){
		$this->JAXL = new JAXL($settings);

		$this->JAXL->requires(array(
            'JAXL0206'  // XMPP over Bosh
		));

		// Simplified postAuth for prebinding...
		function postAuth($payload, $JAXL){
			$response = array(
				'jid' => $JAXL->jid,
				'sid' => $JAXL->bosh['sid'],
				'rid' => $JAXL->bosh['rid']+1
			);

        	$JAXL->JAXL0206('out', $response);
		}

		$this->_connect_bosh();
		
	}

	private function _connect_bosh() {
		// Load in the default callback functions
		$this->CI->load->helper('jax');

		// for performing preferred auth mechanism (optional if auth mech already configured via Jaxl constructor)
		$this->JAXL->addPlugin('jaxl_get_auth_mech', 'doAuth');
		// Get RID, SID, JID after successful auth 
		$this->JAXL->addPlugin('jaxl_post_auth', 'postAuth');
		// Detect auth failure
		$this->JAXL->addPlugin('jaxl_post_auth_failure','postAuthFailure');

		$this->JAXL->addPlugin('jaxl_post_disconnect', '');

		// Start up the core...
		$this->JAXL->startCore('bosh');
	}


}

