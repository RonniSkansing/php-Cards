<?php
namespace Cards;


class CardStack implements StackManipulator {

	/**
	*	Current position in stack
	*/
	protected $position = 0;
	
	/**
	*	Array of Card
	*/
	protected $stack;


	/**
	*	Takes an array of Card. First Card is top of stack
	*
	*	@param array $cards
	*/
	public function __construct( array $cards = [] )
	{
		// throws \InvalidArgumentException 
		if(is_array($cards) === false)
			if(count($cards) === 0)
				return [];

		$this->validateIsArrayOfCards($cards);
		$this->stack = $cards;
	}


	/**
	*	Returns an instance of CardStack with a complete 52 Deck (French deck).
	*
	*	@return CardStack
	*/
	public static function createDeck()
	{

		$suits = [ Suit::HEART, Suit::CLUB, Suit::DIAMOND, Suit::SPADE ];
		$cards = [];
		foreach( $suits as $suit )
			for($i = 1; $i <= 13; ++$i)
				$cards[] = new FrenchCard( new Suit($suit), $i);

		return new CardStack($cards);
	}


	/**
	*	Check if there is a available card
	*
	*	@return bool
	*/
	protected function hasAvailableCard()
	{
		return ($this->count() !== 0);
	}


	/**
	*	Validates that each element is instance of Card
	*	
	*	@param array	Array of Card Instances.
	*	@throws \InvalidArgumentException
	*	@return void
	*/
	protected function validateIsArrayOfCards( $cards )
	{
		foreach($cards as $Card) 
			if( $Card instanceof FrenchCard === false )
				throw new \InvalidArgumentException(	'Each element of the array must be an instance of Card. Given ' 
													. gettype($Card));
	}


	/**
	* 	Validates that the quantity is a valid number
	*
	*	@param	int
	*	@throws \InvalidArgumentException
	*	@return void
	*/
	protected function validateQuantity($quantity)
	{
		if(is_int($quantity) === false)
			throw new \InvalidArgumentException('Quantity must be integer, given ' 
												. gettype($quantity));

		if($quantity <= 0)
			throw new \InvalidArgumentException('Quantity must be greater than 0');
	}


	/**
	*	Adds a card to the top
	*
	*	@param Card $Card
	*	@return void
	*/
	public function addOnTop( FrenchCard $Card )
	{
		array_unshift($this->stack, $Card);
	}


	/**
	*	Adds a card to the bottom
	*
	* 	@param Card $Card
	*	@return void
	*/
	public function addToBottom( FrenchCard $Card )
	{
		$this->stack[] = $Card;
	}


	/**
	*	Adds a CardStack on top. Removes the Cards from the CardStack given.
	*
	*	@param	CardStack
	*	@return bool
	*/
	public function addStackOnTop( StackManipulator $CardStack )
	{	
		if( count($CardStack) === 0 ) 
			return false;

		while( $Card = $CardStack->getBottom())
			$this->addOnTop($Card);

		return true;
	}


	/**
	*	Adds CardStack to the bottom of the deck. Removes the Cards from the CardStack given.
	*
	*	@param	CardStack
	*	@return bool
	*/
	public function addStackToBottom( StackManipulator $CardStack )
	{
		if( count($CardStack) === 0 ) 
			return false;

		while( $Card = $CardStack->getTop())
			$this->addToBottom($Card);

		return true;
	}


	/**
	*	Returns the number of cards in stack
	*
	* 	@return int 
	*/
	public function count()
	{
		return count($this->stack);
	}


	/**
	*	Returns the current card.
	*
	*	Returns null if nomore cards else it returns the Card.
	*	@return Card|null
	*/
	public function current(){
		if($this->valid() === false)
			return null;

		return $this->stack[$this->position];
	}


	/**
	*	Returns and removes the top card
	*
	*	@return Card|null 
	*/
	public function getTop()
	{
		if( $this->hasAvailableCard() === false ) 
			return null;

		return array_shift($this->stack);
	}


	/**
	*	Returns CardStack with quantity of cards and removes from top
	*
	*	@param int $quantity
	*	@throws InvalidArguementException
	*	@return CardStack
	*/
	public function getTopStack( $quantity )
	{
		// throws \InvalidArgumentException
		$this->validateQuantity($quantity);
		
		if($this->hasAvailableCard() === false)
			return new CardStack;

		$cards = [];
		for($i = 1; $i <= $quantity && ( $Card = $this->getTop() ) !== null; ++$i) 
			$cards[] = $Card; 

		return new CardStack($cards);
	}


	/**
	*	Return and remove the bottom card
	*
	*	@return Card|null
	*/
	public function getBottom()
	{
		if($this->hasAvailableCard() === false)
			return null;

		return array_pop($this->stack);
	}


	/**
	*	Returns CardStack with quantity of cards and removes from the bottom.
	*	
	*	@param int $quantity
	*	@throws \InvalidArgumentException
	*	@return CardStack
	*/
	public function getBottomStack( $quantity )
	{
		// throws \InvalidArgumentException
		$this->validateQuantity($quantity);

		if($this->hasAvailableCard() === false)
			return new CardStack;

		$cards = [];
		for($i = 1; $i <= $quantity && ( $Card = $this->getBottom() ) !== null; ++$i) 
			$cards[] = $Card; 

		return new CardStack($cards);
	}


	/**
	*	Returns the value of the current position.
	*
	*	@return int
	*/
	public function key()
	{
		return $this->position;
	}


	/**
	*	Moves to the next position, even if it does not exists.
	*
	*	@return void
	*/
	public function next()
	{
		++$this->position;
	}


	/**
	*	Returns a Card in a specific offset
	*
	*	@param int	$offset
	*	@return Card|null		returns null if the offset is nonexistent.
	*/
	public function offsetGet( $offset ) 
	{
		if($this->offsetExists($offset) === false)
			return null;

		return $this->stack[$offset];
	}


	/**
	*	Checks if a specific offset exists
	* 
	*	@param int 	$offset
	*	@return bool
	*/
	public function offsetExists( $offset )
	{
		return isset($this->stack[$offset]);
	}


	/**
	*	Throws Exception if used.
	*
	*	@throws Exception
	*	@param  înt
	*	@param 	int
	*	@return void
	*/
	public function offsetSet( $offset, $value )
	{
		throw new \Exception('The Cards are readonly.');
	}


	/**
	*	Removes a specific index from the stack
	*	And reindexes the array
	*
	*	@param int $offset
	*	@return void
	*/
	public function offsetUnset( $offset ) 
	{
		if($this->offsetExists($offset) === false)
			return;

		unset($this->stack[$offset]);

		if($this->hasAvailableCard())
			$this->stack = array_values($this->stack);
	}


	/**
	*	Reverses the stack of card.
	*
	*	@return bool
	*/
	public function reverse()
	{
		if($this->count() <= 1)
			return false;		

		$this->stack = array_reverse($this->stack);
		return true;
	}


	/**
	*	Shuffles the cards
	*
	*	@return bool
	*/
	public function shuffle()
	{
		if($this->count() <= 1)
			return false;		

		shuffle($this->stack);
		return true;
	}


	/**
	*	Splits the stack
	*
	* 	Returns a CardStack with half the stack, from top, to the middle, 
	*	If the number of cards is unequal, it picks the lesser of the to
	*	numbers. Example 15 cards, gives a stack of 7 cards. 
	*	Returns null if one or no cards left in stack.
	*	@return CardStack|null
	*/
	public function split()
	{
		$count = $this->count();
		$larger_half = ( floor($count / 2) ) + ( $count % 2);
		$cards = [];
		for($i = 1; $i <= $larger_half && ( $Card = $this->getTop() ) !== null; ++$i) 
			$cards[] = $Card; 		

		return new CardStack($cards);
	}


	/**
	*	Rewinds the stack
	*
	*	@return void
	*/
	public function rewind()
	{
		$this->position = 0;
	}


	/** 
	*	Checks if the current position is valid
	*
	*	@return bool
	*/
	public function valid()
	{
		return isset($this->stack[$this->position]);
	}
}