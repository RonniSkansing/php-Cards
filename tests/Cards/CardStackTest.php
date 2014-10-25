<?php
use Cards\FrenchCard as FrenchCard;
use Cards\Suit as Suit;
use Cards\CardStack as CardStack;

class CardStackTest extends PHPUnit_Framework_TestCase {

    protected $CardStack;

    public function setUp()
    {
        $cards = [];
        for($i = 1; $i <= 13; ++$i) {
            $cards[] = new FrenchCard( new Suit(Suit::SPADE), $i);
        }

        $this->CardStack = new CardStack($cards);
    }

    private function getCardStack()
    {
        $cards = [];
        for($i = 1; $i < 5; ++$i) {
            $cards[] = new FrenchCard( new Suit(Suit::CLUB), $i);
        }

        return new CardStack($cards);
    }

    public function testConstructWithNoArgs()
    {
        $CardStack = new CardStack;
    }

    /**
    *   @expectedException PHPUnit_Framework_Error
    */
    public function testConstructErrorIfFirstArgNotTypeArray()
    {
        $CardStack = new CardStack('string');
    }


    /**
    *   @expectedException InvalidArgumentException
    */
    public function testConstructThrowsExceptionIfArgArrayElementsNotInstanceOfSuit()
    {
        $CardStack = new CardStack( ['string'] );
    }


    public function testCountableInterfaceIsImplemented()
    {
        $stack_count = $this->CardStack->count();
        $count = count($this->CardStack);
        $this->assertEquals($stack_count, $count);
    }

    public function testCountReturnsNumberOfCards()
    {
        $cards = [];
        for($i = 1; $i <= 10; $i *= 2) {
            $cards[] = new FrenchCard( new Suit( Suit::SPADE), $i);
        }

        $CardStack = new CardStack($cards);

        $this->assertEquals(count($cards), $CardStack->count());
    }

    public function testCountReturns0IfNoCardsOrNull()
    {
        $CardStack = new CardStack;
        $this->assertSame(0, $CardStack->count());
    }

    /**
    *   @expectedException PHPUnit_Framework_Error
    */
    public function testAddOnTopErrorIfArgNotInstanceOfCard()
    {
        $this->CardStack->addOnTop('Heart');
    }

    public function testAddOnTopAddsACard()
    {
        $count = $this->CardStack->count();
        $this->CardStack->addOnTop( new FrenchCard( new Suit( Suit::SPADE), 13) );
        $this->assertGreaterThan($count, $this->CardStack->count());
    }

    public function testAddOnTopAddsToTheTop()
    {
        $Card = new FrenchCard( new Suit(Suit::SPADE), 6);
        $this->CardStack->addOnTop($Card);
        $this->AssertSame($Card, $this->CardStack->getTop());
    }

    public function testGetTopReturnNullIfNoCardLeft()
    {
        $CardStack = new CardStack;
        $this->assertNull($CardStack->getTop());
    }

    public function testGetTopReturnInstanceOfCard()
    {
        $Card = $this->CardStack->getTop();
        $this->assertInstanceOf('Cards\FrenchCard', $Card);
    }

    public function testgetTopReindexStack()
    {
        $Card = $this->CardStack[1];
        $Card2 = $this->CardStack->getTop();
        $this->assertEquals($Card->getValue(), $this->CardStack[0]->getValue());
    }

    public function testgetBottomReturnNullIfNoCardLeft()
    {
        $CardStack = new CardStack;
        $this->assertNull($CardStack->getTop());
    }

    public function getBottomReturnInstanceOfCard()
    {
        $Card = $this->CardStack->getBottom();
        $this->assertInstanceOf('\Cards\FrenchCard', $Card);
    }

    /**
    *   @expectedException PHPUnit_Framework_Error
    */
    public function testAddToBottomErrorIfArgNotInstaceOfCard()
    {
        $this->CardStack->addToBottom('Heart');
    }

    public function testAddToBottomAddsCard()
    {
        $count = $this->CardStack->count();
        $this->CardStack->addToBottom( new FrenchCard( new Suit( Suit::HEART), 11));
        $this->assertGreaterThan($count, $this->CardStack->count());
    }

    public function testAddToBottomAddsToTheBottom()
    {
        $Card = new FrenchCard( new Suit( Suit::CLUB), 2);
        $this->CardStack->AddToBottom($Card);
        $this->assertSame( $Card, $this->CardStack->getBottom());
    }

    /**
    *   @expectedException InvalidArgumentException
    */
    public function testGetTopStackThrowsExceptionIfArgNotInt()
    {
        $this->CardStack->getTopStack('string');
    }

    /**
    *   @expectedException InvalidArgumentException
    */
    public function testGetTopStackThrowsExceptionIfArgNotPositiveNumber()
    {
        $this->CardStack->getTopStack(0);
    }

    public function testGetTopStackReturnInstanceOfCardStackIfNoCardsLeft()
    {
        $CardStack = new CardStack;
        $emptyCardStack = $CardStack->getTopStack(10);

        $this->assertInstanceOf('Cards\CardStack', $emptyCardStack);
    }

    public function testGetTopStackReturnInstaceOfCardStack()
    {
        $this->assertInstanceOf('Cards\CardStack', $this->CardStack->getTopStack(5));
    }

    public function testGetTopStackReturnCorrectNumberOfCards()
    {
        $this->assertSame(5, $this->CardStack->getTopStack(5)->count());
    }

    public function testGetTopStackRemovesCards()
    {
        $number_of_cards = 5;
        $count = $this->CardStack->count();
        $this->CardStack->getTopStack($number_of_cards);
        $this->assertSame($this->CardStack->count(), $count - $number_of_cards);
    }

    public function testGetTopStackReturnRestOfCardIfLowerThanQuantity()
    {
        $number = 5;
        $cards = [];
        for($i = 1; $i <= $number; ++$i) {
            $cards[] = new FrenchCard( new Suit( Suit::SPADE), $i);
        }
        $CardStack = new CardStack($cards);
        $myCardStack = $CardStack->getTopStack(5);
        $this->assertSame($number, $myCardStack->count());
    }

    /**
    *   @expectedException InvalidArgumentException
    */
    public function testGetBottomStackThrowsExceptionIfArgNotInt()
    {
        $this->CardStack->getBottomStack('string');
    }

    /**
    *   @expectedException InvalidArgumentException
    */
    public function testGetBottomStackThrowsExceptionIfArgNotPositiveNumber()
    {
        $this->CardStack->getBottomStack(0);
    }

    public function testGetBottomStackReturnInstanceOfCardStackIfNoCardsLeft()
    {
        $CardStack = new CardStack;
        $emptyCardStack = $CardStack->getBottomStack(10);

        $this->assertInstanceOf('Cards\CardStack', $emptyCardStack);
    }

    public function testGetBottomStackReturnInstaceOfCardStack()
    {
        $this->assertInstanceOf('Cards\CardStack', $this->CardStack->getBottomStack(5));
    }

    public function testGetBottomStackReturnCorrectNumberOfCards()
    {
        $this->assertSame(5, $this->CardStack->getBottomStack(5)->count());
    }

    public function testGetBottomStackRemovesCards()
    {
        $number_of_cards = 5;
        $count = $this->CardStack->count();
        $this->CardStack->getBottomStack($number_of_cards);
        $this->assertSame($this->CardStack->count(), $count - $number_of_cards);
    }

    public function testShuffleReturnFalseIfNoCardLeft()
    {
        $CardStack = new CardStack;
        $is_shuffled = $CardStack->shuffle();
        $this->assertFalse($is_shuffled);
    }


    public function testShuffleReturnFalseIf1CardLeft()
    {
        $CardStack = new CardStack( [ new FrenchCard( new Suit( Suit::HEART), 13) ]);
        $is_shuffled = $CardStack->shuffle();
        $this->assertFalse($is_shuffled);
    }

    public function testShuffleReturnTrueAfterShuffling()
    {
        $this->assertTrue($this->CardStack->shuffle());
    }

    public function testReverseReturnsFalseIf1CardLeft()
    {
        $CardStack = new CardStack( [ new FrenchCard( new Suit( Suit::HEART), 13) ]) ;
        $false = $CardStack->reverse();
        $this->assertFalse($false);
    }

    public function testReverseReturnsFalseIfNoCardLeft()
    {
        $CardStack = new CardStack;
        $false = $CardStack->shuffle();
        $this->assertFalse($false);
    }

    public function testReveseTurnsStackAround()
    {
        $Card = new FrenchCard( new Suit( Suit::HEART), 13);
        $this->CardStack->addOnTop($Card);
        $this->CardStack->reverse();
        $sameCard = $this->CardStack->getBottom();
        $this->assertSame($Card->getValue(), $sameCard->getValue());
        $this->assertSame($Card->getSuit(), $sameCard->getSuit());
    }

    public function testSplitReturnInstaceOfCardStack()
    {
        $CardStack = $this->CardStack->split();
        $this->assertInstanceOf('Cards\CardStack', $CardStack);
    }

    public function testSplitRemovesCards()
    {
        $count = $this->CardStack->count();
        $CardStack = $this->CardStack->split();
        $this->assertEquals($count, ( $CardStack->count() + $this->CardStack->count()));
    }

    public function testSplitTakesTheLesserOfHalfOfCards()
    {
        $count = $this->CardStack->count(); // 13
        $lesser_half = ( floor($count / 2) ) + ( $count % 2);
        $CardStack = $this->CardStack->split();
        $this->assertEquals($lesser_half, $CardStack->count());
    }

    /**
    *   @expectedException PHPUnit_Framework_Error
    */
    public function testAddStackOnTopErrorIfInstanceOfNotCardStack()
    {
        $this->CardStack->AddStackOnTop('string');
    }

    public function testAddStackOnTopReturnTrueOnSucces()
    {
        $this->assertTrue(
            $this->CardStack->AddStackOnTop( new CardStack( [ new FrenchCard( new Suit( Suit::HEART), 9)]))
        );
    }

    public function testAddStackOnTopReturnFalseIfNoCardsToAdd()
    {
        $this->assertFalse($this->CardStack->AddStackOnTop( new CardStack ));
    }

    public function testAddStackOnTopEmptiesTheStack()
    {
        $cards = [];
        for($i = 1; $i < 5; ++$i) {
            $cards[] = new FrenchCard( new Suit(Suit::CLUB), $i);
        }
        $CardStack = new CardStack($cards);
        $this->CardStack->AddStackOnTop($CardStack);
        $this->assertEquals(0, $CardStack->count());
    }

    public function testAddStackOnTopAddsCards()
    {
        $cards = [];
        for($i = 1; $i < 5; ++$i) {
            $cards[] = new FrenchCard( new Suit(Suit::CLUB), $i);
        }
        $CardStack = new CardStack($cards);
        $added = $CardStack->count() + $this->CardStack->count();
        $this->CardStack->AddStackOnTop($CardStack);
        $this->assertEquals($this->CardStack->count(), $added);
    }

    public function testAddStackOnTopAddsToTop()
    {
        $cards = [];
        $value_top_card = 1;
        for($i = $value_top_card; $i < 5; ++$i) {
            $cards[] = new FrenchCard( new Suit(Suit::CLUB), $i);
        }
        $CardStack = new CardStack($cards);
        $added = $CardStack->count() + $this->CardStack->count();
        $this->CardStack->AddStackOnTop($CardStack);
        $this->assertEquals($value_top_card, $this->CardStack->getTop()->getValue());
    }

    /**
    *   @expectedException PHPUnit_Framework_Error
    */
    public function testAddStackToBottomErrorIfInstanceOfNotCardStack()
    {
        $this->CardStack->AddStackToBottom('string');
    }

    public function testAddStackToBottomReturnTrueOnSucces()
    {
        $this->assertTrue(
            $this->CardStack->AddStackToBottom( new CardStack( [ new FrenchCard( new Suit( Suit::HEART), 9)]))
        );
    }

    public function testAddStackToBottomReturnFalseIfNoCardsToAdd()
    {
        $this->assertFalse($this->CardStack->AddStackToBottom( new CardStack ));
    }


    public function testAddStackToBottomEmptiesTheStack()
    {
        $cards = [];
        for($i = 1; $i < 5; ++$i) {
            $cards[] = new FrenchCard( new Suit(Suit::CLUB), $i);
        }
        $CardStack = new CardStack($cards);
        $this->CardStack->AddStackToBottom($CardStack);
        $this->assertEquals(0, $CardStack->count());
    }

    public function testAddStackToBottomAddsCards()
    {
        $cards = [];
        for($i = 1; $i < 5; ++$i) {
            $cards[] = new FrenchCard( new Suit(Suit::CLUB), $i);
        }
        $CardStack = new CardStack($cards);
        $added = $CardStack->count() + $this->CardStack->count();
        $this->CardStack->AddStackToBottom($CardStack);
        $this->assertEquals($this->CardStack->count(), $added);
    }

    public function testAddStackToBottomAddsToBottom()
    {
        $cards = [];
        for($i = 1; $i < 5; ++$i) {
            $cards[] = new FrenchCard( new Suit(Suit::CLUB), $i);
        }
        $bottom_card_value = $i - 1;
        $CardStack = new CardStack($cards);
        $added = $CardStack->count() + $this->CardStack->count();
        $this->CardStack->AddStackToBottom($CardStack);
        $this->assertEquals($bottom_card_value, $this->CardStack->getBottom()->getValue());
    }

    // iterator interface
    public function testCurrentReturnsInstanceOfCard()
    {
        $this->assertInstanceOf('Cards\FrenchCard',$this->CardStack->current());
    }

    // iterator interface
    public function testCurrentReturnCurrentCard()
    {
        $cards = [];
        for($i = 1; $i < 5; ++$i) {
            $cards[] = new FrenchCard( new Suit(Suit::CLUB), $i);
        }
        $CardStack = new CardStack($cards);
        $this->assertEquals(1, $CardStack->current()->getValue());
    }

    public function testCurrentIs0ByDefault()
    {
        $CardStack = new CardStack;
        $this->assertEquals(0, $CardStack->Current());
    }

    // iterator interface
    public function testNextReturnInstaceOfCard()
    {
        $this->assertInstanceOf('Cards\FrenchCard', $this->CardStack->current());
    }

    // iterator interface
    public function testNextMovesToNextCard()
    {
        $cards = [];
        for($i = 1; $i < 5; ++$i) {
            $cards[] = new FrenchCard( new Suit(Suit::CLUB), $i);
        }
        $CardStack = new CardStack($cards);
        $CardStack->next();
        $this->assertEquals(2, $CardStack->current()->getValue());
    }

    // iterator interface
    public function testRewindSetsPositionToTop()
    {
        $cards = [];
        for($i = 1; $i < 5; ++$i) {
            $cards[] = new FrenchCard( new Suit(Suit::CLUB), $i);
        }
        $CardStack = new CardStack($cards);
        $CardStack->next();
        $CardStack->next();
        $CardStack->next();
        $CardStack->rewind();
        $this->assertEquals(1, $CardStack->current()->getValue());
    }

    // iterator interface
    public function testKeyReturnInt()
    {
        $this->assertInternalType('int', $this->CardStack->key());
    }

    // iterator interface
    public function testValidReturnBool()
    {
        $this->assertInternalType('bool', $this->CardStack->valid());
    }

    public function testValidReturnFalseIfInvalid()
    {
        $CardStack = new CardStack;
        $this->assertFalse($CardStack->valid());
    }

    public function testValidReturnTrueIfValid()
    {
        $CardStack = new CardStack( [new FrenchCard( new Suit( Suit::SPADE), 13)] );
        $this->assertTrue($CardStack->valid());
    }

    public function testImplementsIterator()
    {
        $cards = [];
        for($i = 1; $i < 5; ++$i) {
            $cards[] = new FrenchCard( new Suit(Suit::CLUB), $i);
        }
        $CardStack = new CardStack($cards);
        $count = $CardStack->count();
        $j = 0;
        foreach($CardStack as $Card) {
            ++$j;
        }

        $this->assertEquals($count, $j);
    }

    // arrayaccess interface
    public function testOffsetExistsReturnBool()
    {
        $this->assertInternalType('bool', $this->CardStack->offsetExists(1) );
    }

    public function testOffsetExistsReturnTrueIfExists()
    {
        $CardStack = new CardStack( [new FrenchCard( new Suit( Suit::SPADE), 13)] );
        $this->assertTrue($CardStack->offsetExists(0));
    }

    public function testOffsetExistsReturnFalseIfNotExists()
    {
        $CardStack = new CardStack;
        $this->assertFalse($CardStack->offsetExists(0));
    }

    public function testOffsetGetReturnInstaceOfCard()
    {
        $CardStack = new CardStack( [new FrenchCard( new Suit( Suit::SPADE), 13)] );
        $this->assertInstanceOf('Cards\FrenchCard', $CardStack->offsetGet(0));
    }

    public function testOffsetGetReturnNullIfInvalid()
    {
        $CardStack = new CardStack;
        $this->assertNull($CardStack->offsetGet(0));
    }

    /**
    *   @expectedException Exception
    */
    public function testOffsetSetTakes2Args()
    {
        $this->CardStack->offsetSet(null, null);
    }

    /**
    *   @expectedException Exception
    */
    public function testOffsetSetThrowsExceptionIfUsed()
    {
        $this->CardStack->offsetSet(null, null);
    }

    public function testOffsetUnsetRemovesCard()
    {
        $CardStack = new CardStack( [new FrenchCard( new Suit( Suit::SPADE), 13)] );
        $CardStack->offsetUnset(0);
        $this->assertNull($CardStack->offsetGet(0)); // nomore cards
    }

    public function testOffsetRebuildsOffset()
    {
        $cards = [];
        for($i = 1; $i < 5; ++$i) {
            $cards[] = new FrenchCard( new Suit(Suit::CLUB), $i);
        }
        $CardStack = new CardStack($cards);
        $Card = $CardStack[2];
        unset($CardStack[1]);
        $this->assertSame($Card->getValue(), $CardStack[1]->getValue());
    }

    public function testImplementsArrayAcces()
    {
        $cards = [];
        for($i = 1; $i < 5; ++$i) {
            $cards[] = new FrenchCard( new Suit(Suit::CLUB), $i);
        }
        $CardStack = new CardStack($cards);
        $this->assertEquals(2, $CardStack[1]->getValue());
    }

    public function testStaticGenerateCompleteDeckReturns52Cards()
    {
        $CardStack = CardStack::createDeck();
        $this->assertEquals(52, $CardStack->count());
    }
}
