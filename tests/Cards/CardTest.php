<?php
use Cards\Card as Card;
use Cards\Suit as Suit;


class CardTest extends PHPUnit_Framework_TestCase {


	protected $Card;


	public function setUp()
	{

		$this->Card = new Card( new Suit( Suit::HEART), 9);
	}



	/**
	*	@expectedException PHPUnit_Framework_Error
	*/
	public function testConstructErrorIfFirstArgNotInstanceOfSuit()
	{

		$Card = new Card( Suit::HEART, 0);
	}


	/**
	*	@expectedException InvalidArgumentException
	*/
	public function testConstructThrowsExceptionIfSecondArgIsLessThan1()
	{

		$Card = new Card( new Suit( Suit::HEART), 0);
	}


	/**
	*	@expectedException InvalidArgumentException
	*/
	public function testConstructThrowsExceptionIfSecondArgIsHigherThan13()
	{

		$Card = new Card(new Suit( Suit::HEART), 14);
	}

	
	public function testGetSuitReturnsSuitAsString()
	{

		$Card = new Card(new Suit( Suit::DIAMOND), 1);
		$this->assertSame('Diamond', $Card->getSuit());
	}


	public function testGetValueReturnsValue()
	{
		$value = 13;
		$Card = new Card(new Suit( Suit::HEART), $value);
		$value = $Card->getValue();
		$this->assertSame($value, $Card->getValue());
	}
}