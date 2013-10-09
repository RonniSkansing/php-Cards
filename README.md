php-Cards
======================
Small package when in need of french playing cards 
and stacks to manage them.


Card
------------------------

Create a Card
```php
$Card = new Card( new Suit::Heart), 1);
```
Get suit of Card
```php
$suit = $Card->getSuit();
```
Get value of Card
```php
$int = $Card->getValue();
```

CardStack
------------------------

**Creating a CardStack**

A CardStack is constructed from an array of Card instances.
```php
$cards = [];
for($i = 1; $i <= 13; ++$i)
  $cards[] = new Card( new Suit(Suit::SPADE), $i);
  
$CardStack = new CardStack($cards);
```

A CardStack can also be constructed without args.
```php
$CardStack = new CardStack; // empty CardStack
```

A complete playing 52 deck can be created via a static method.
```php
$CardStack = CardStack::createDeck; // empty CardStack
```


**Iterating Card's in CardStack, viewing Card.**

A CardStack can be used pretty much as a array.
```php
// single Card
echo $CardStack[3]->getSuit();
// iterate
foreach($CardStack as $Card){
  echo $Card->getSuit(), ' ', $Card->getValue();
}
```

The number of Cards in available in CardStack
```php
$count = count($CardStack); // or $CardStack->count()
```


**Manipulating CardStack**
To get and *remove a Card* from the CardStack.
```php
$Card = $CardStack->getTopCard();
$Card2 = $CardStack->getBottomCard();
```

To get and *remove a CardStack* from the stack.
```php
$CardStack2 = $CardStack->getTopStack(3); // get and remove 3 cards
$CardStack3 = $CardStack->getBottomStack(5); // get and remove 3 cards
```

To add a Card to the top or bottom of the CardStack
```php
$CardStack->addOnTop($Card);
$CardStack->addToBottomTop($Card);
```

To add a CardStack to the top or bottom of another CardStack.
The CardStack used as argument will have all of it's Card instances
removed and left empty after the merge.
```php
$CardStack->addStackOnTop($CardStack2); // CardStack2 is now empty
$CardStack->addStackToBottom($CardStack3); // CardStack3 is now empty
```

Split the CardStack in half. The CardStack returned will be the bigger
of the two if unequal. 
```php
$CardStack2 = $CardStack->split(); // 15 Cards
$CardStack2->count(); // would return 8
```

Shuffle the stack.
```php
$CardStack->shuffle();
```

Deleting a Card.
```php
unset($CardStack[1]);
```