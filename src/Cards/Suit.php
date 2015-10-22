<?php
namespace Cards;

class Suit {
    const CLUB = 'Club';
    const DIAMOND = 'Diamond';
    const HEART = 'Heart';
    const SPADE = 'Spade';

    /**
    *   Contains the suit.
    *   @param string $suit
    */
    private $suit;

    /**
    *   Creates a Suit.
    *
    *   @param string $suit     MUST be Club, Diamond, Heart or Spade.
    */
    public function __construct( $suit )
    {
        if( $this->isValidSuit($suit) === false) {
            throw new \InvalidArgumentException('The suit is not a valid string.');
        }

        $this->suit = $suit;
    }

    /**
    *   Check if the Suit is a valid type.
    *
    *   @param  string $suit
    *   @return bool
    */
    protected function isValidSuit($suit)
    {
		$validSuits = array(self::CLUB, self::DIAMOND, self::HEART, self::SPADE);
		return in_array($suit, $validSuits, true);
    }

    /**
    *   Gets the suit as a string
    *
    *   @return string
    */
    public function getSuit()
    {
        return $this->suit;
    }
}
