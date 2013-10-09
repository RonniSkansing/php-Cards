<?php
namespace Cards;


Interface StackManipulator
{
	public function addOnTop( Card $Card );
	public function addToBottom( Card $Card );
	public function addStackOnTop( CardStack $CardStack);
	public function addStackToBottom( CardStack $CardStack);
	public function getTopCard();
	public function getTopStack($quantity);
	public function getBottomCard();
	public function getBottomStack($quantity);
	public function shuffle();
	public function reverse();
	public function split();
}