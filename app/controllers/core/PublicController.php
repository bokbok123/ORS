<?php

class PublicController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	public $theme;

	public function __construct() {

		//change theme if user is logged
		if(Auth::check()){
			$this->theme = Theme::uses('dashboard')->layout('default');
		}else {
			$this->theme = Theme::uses('default')->layout('default');
		}
        
    }
	
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}


}
