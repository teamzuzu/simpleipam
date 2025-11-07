<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CI_Controller {

	/**
	 * Reference to the CI singleton
	 *
	 * @var	object
	 */
	private static $instance;

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		self::$instance =& $this;

		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');
		$this->load->initialize();
	}

	/**
	 * Get the CI singleton
	 *
	 * @return	object
	 */
	public static function &get_instance()
	{
		return self::$instance;
	}

}
