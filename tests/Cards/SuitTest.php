<?php
use Cards\Suit as Suit;

class SuitTest extends PHPUnit_Framework_TestCase {

    public function testStaticHeartIsTheStringHeart()
    {
        $this->assertSame('Heart', Suit::HEART);
    }

    public function testStaticSpadeIsTheStringSpade()
    {
        $this->assertSame('Spade', Suit::SPADE);
    }


    public function testStaticDiamondIsTheStringDiamond()
    {
        $this->assertSame('Diamond', Suit::DIAMOND);
    }


    public function testStaticClubIsTheStringClub()
    {
        $this->assertSame('Club', Suit::CLUB);
    }

    /**
    *   @expectedException InvalidArgumentException
    */
    public function testConstuctThrowsExceptionIfFirstArgIsInvalidSuit()
    {
        $Card = new Suit('Duck');
    }

    public function testGetSuitReturnsSuitAsString()
    {
        $Suit = new Suit( Suit::CLUB );
        $this->assertSame('Club', $Suit->getSuit());
    }
}
