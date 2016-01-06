<?php

class AdminController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	public $theme;

	public function __construct() {
        $this->theme = Theme::uses('admin')->layout('default');
    }
	
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
