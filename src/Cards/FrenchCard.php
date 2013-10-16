<?php
namespace Cards;

class FrenchCard extends Card {
	// min. value for a Card.
	const MIN_VALUE = 1;
	// max. value for a Card.
	const MAX_VALUE = 13;

	protected $Suit;
	protected $value;


	/**
	*	Creates a french Card.
	*
	*	@param	Suit
	*	@param	int
	*/
	public function __construct( Suit $Suit, $value)
	{
		// throws InvalidArgumentException
		$this->isWithinValueRange($value);
			
		$this->Suit = $Suit;
		$this->value = $value;
	}


	/**
	*	Check if Card is within a valid range.
	*
	*	@param int
	*	@throws InvalidArgumentException
	*/
	protected function isWithinValueRange($value)
	{
		if($value < self::MIN_VALUE OR $value > self::MAX_VALUE)
			throw new \InvalidArgumentException('The value must be higer than 0 and less than 14 (1-13) Given ' . $value);
	}


	/**
	*	Returns the suit as a string.
	*
	*	@return string
	*/
	public function getSuit()
	{
		return $this->Suit->getSuit();
	}


	/**
	*	Returns the value of the Card.
	*	@return int
	*/
	public function getValue()
	{
		return $this->value;
	}
}