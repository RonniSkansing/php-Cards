<?php
require 'vendor/autoload.php';
use Cards\CardStack as CardStack;
use Cards\Card as Card;
use Cards\Suit as Suit;

$x = new CardStack();
var_dump(count($x));
$x->addOnTop(new Card( new Suit( Suit::HEART), 9));
var_dump(count($x));
