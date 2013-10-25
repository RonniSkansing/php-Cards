<?php
require 'vendor/autoload.php';
use Cards\CardStack as CardStack;
use Cards\FrenchCard as Card;
use Cards\Suit as Suit;

// Create some cards.
$H9 = new Card( new Suit( Suit::HEART), 9);
$H10 = new Card( new Suit( Suit::HEART), 10);

// Create a CardDeck
$smallCardStack = new CardStack([$H10]);

// Add card on top of deck.
$smallCardStack->addOnTop($H9);

// create a 52 deck.
$Deck = CardStack::createDeck();

// shuffle...
$Deck->shuffle();

// add a stack on a stack
$Deck->addStackOnTop($smallCardStack);

echo count($smallCardStack); // empty now...
