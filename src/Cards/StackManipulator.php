<?php
namespace Cards;

Interface StackManipulator extends \ArrayAccess, \Countable, \Iterator
{
    public function addOnTop( FrenchCard $Card );
    public function addToBottom( FrenchCard $Card );
    public function addStackOnTop( StackManipulator $CardStack);
    public function addStackToBottom( StackManipulator $CardStack);
    public function getTop();
    public function getTopStack($quantity);
    public function getBottom();
    public function getBottomStack($quantity);
    public function shuffle();
    public function reverse();
    public function split();
}
