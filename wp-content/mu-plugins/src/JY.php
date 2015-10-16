<?php

class JY extends App {

	protected static $SITE_PREFIX = 'jy_';
	
	protected function siteInit() {
		$this->registerPostType('testimonials', '', '', array(), array('menu_icon' => 'dashicons-format-quote'));
	}

}
