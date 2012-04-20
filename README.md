jax
===

A CodeIgniter &quot;Package&quot; for working with JAXL

## Usage

Create a `jax` folder in `applications/third_party/` and copy this repository's contents

```php

	// Include the third_party package
	$this->load->add_package_path(APPPATH.'/third_party/jax');
	$this->load->library('jax');

	// Pre-bind to BOSH
	$this->jax->bind(array(
		'user' => 'jbottigliero', 
		'pass' => 'secret',
		'resource' => 'jax'
	));

```

At the moment there is only the single helper function to bind to a BOSH connection. More will come, but the structure alone should be a great start for any project working to integrate JAXL.

## Why no CodeIgniter config/jax.php?!

JAXL already has a pretty well organized configuration structure.
To set constant, default vaules check out the `/libraries/jaxl-[VERSION]/env/jaxl.ini` these values will be used when no parameters are passed to a method which invokes a new `JAXL` instance.

#### NOTE: `/libraries/jaxl-[VERSION]/` is the same* code from @abhinavsingh JAXL library. This contains examples, for those looking to clear up some clutter.
*The only changes made are to the `/libraries/jaxl-[VERSION]/env/jaxl.ini` log paths, to allow for logging out of the box.