<?php
namespace Cards;


Interface StackManipulator
{
	public function addOnTop( \Cards\Card $Card );
	public function addToBottom( \Cards\Card $Card );
	public function addStackOnTop( \Cards\CardStack $CardStack);
	public function addStackToBottom( \Cards\CardStack $CardStack);
	public function getTopCard();
	public function getTopStack($quantity);
	public function getBottomCard();
	public function getBottomStack($quantity);
	public function shuffle();
	public function reverse();
	public function split();
}