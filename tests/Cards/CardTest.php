<?php

class CardTest extends PHPUnit_Framework_TestCase {
	
	public function testExists() {
		$Card = $this->getMockForAbstractClass('Cards\Card');
	}
}