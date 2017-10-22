<?php

namespace MarsRovers;


class Rover
{
	const COMMANDS = ['f', 'b', 'l', 'r'];

	private $position;

	private $direction;

	private $surface;

	/**
	 * @return Point
	 */
	public function getPosition()
	{
		return $this->position;
	}

	/**
	 * @param Point $position
	 */
	private function setPosition(Point $position)
	{
		$this->position = $position;
	}

	/**
	 * @return Direction
	 */
	public function getDirection()
	{
		return $this->direction;
	}

	/**
	 * @param Direction $direction
	 */
	private function setDirection(Direction $direction)
	{
		$this->direction = $direction;
	}

	/**
	 * @return Surface
	 */
	public function getSurface()
	{
		return $this->surface;
	}

	/**
	 * @param Surface $surface
	 */
	private function setSurface(Surface $surface)
	{
		$this->surface = $surface;
	}


	/**
	 * Rover constructor.
	 * @param Point $starterPoint
	 * @param Direction $starterDirection
	 * @param Surface $surface
	 */
	public function __construct(Point $starterPoint, Direction $starterDirection, Surface $surface)
	{
		$this->setPosition($starterPoint);
		$this->setDirection($starterDirection);
		$this->setSurface($surface);
	}

	public function moveForward()
	{
		$newLocationX = $this->getPosition()->getLocationX();
		$newLocationY = $this->getPosition()->getLocationY();
		if ($this->getDirection()->getShortName() === Direction::NORTH || $this->getDirection()->getShortName() === Direction::SOUTH) {
			if ($this->getDirection()->getShortName() === Direction::NORTH) {
				$newLocationY++;
			} else {
				$newLocationY--;
			}
		} elseif ($this->getDirection()->getShortName() === Direction::WEST || $this->getDirection()->getShortName() === Direction::EST) {
			if ($this->getDirection()->getShortName() === Direction::EST) {
				$newLocationX++;
			} else {
				$newLocationX--;
			}
		}

		if ($newLocationX === $this->getPosition()->getLocationX() && $newLocationY === $this->getPosition()->getLocationY()) {
			throw new \Exception('something is wrong with direction of rover');
		}

		$destinationPoint = $this->getSurface()->getPointByPosition($newLocationX, $newLocationY);
		if ($this->getSurface()->checkOnePointIsAObstacle($destinationPoint)) {
			throw new \Exception('rover will encounter a obstacle if continue, abort the rest of commands, detect obstacle at point (' . $destinationPoint->getLocationX() . ',' . $destinationPoint->getLocationY() . '), current position at point (' . $this->getPosition()->getLocationX() . ',' . $this->getPosition()->getLocationY() . ')');
		}
		$this->setPosition($destinationPoint);
	}

	public function moveBackWard()
	{
		$newLocationX = $this->getPosition()->getLocationX();
		$newLocationY = $this->getPosition()->getLocationY();
		if ($this->getDirection()->getShortName() === Direction::NORTH || $this->getDirection()->getShortName() === Direction::SOUTH) {
			if ($this->getDirection()->getShortName() === Direction::NORTH) {
				$newLocationY--;
			} else {
				$newLocationY++;
			}
		} elseif ($this->getDirection()->getShortName() === Direction::WEST || $this->getDirection()->getShortName() === Direction::EST) {
			if ($this->getDirection()->getShortName() === Direction::EST) {
				$newLocationX--;
			} else {
				$newLocationX++;
			}
		}

		if ($newLocationX === $this->getPosition()->getLocationX() && $newLocationY === $this->getPosition()->getLocationY()) {
			throw new \Exception('something is wrong with direction of rover');
		}

		$destinationPoint = new Point($newLocationX, $newLocationY);
		if ($this->getSurface()->checkOnePointIsAObstacle($destinationPoint)) {
			throw new \Exception('rover will encounter a obstacle if continue, abort the rest of commands, detect obstacle at point (' . $destinationPoint->getLocationX() . ',' . $destinationPoint->getLocationY() . '), current position at point (' . $this->getPosition()->getLocationX() . ',' . $this->getPosition()->getLocationY() . ')');
		}
		$this->setPosition($destinationPoint);
	}

	public function turnLeft()
	{
		$this->getDirection()->turnLeft();
	}

	public function turnRight()
	{
		$this->getDirection()->turnRight();
	}

	public function receiveCommands($commands)
	{
		$commands = trim($commands);
		$index = 0;
		while (isset($commands[$index])) {
			if (!in_array($commands[$index], self::COMMANDS)) {
				throw new \Exception('receive a command with a strange character, abort');
			}
			try {
				if ($commands[$index] === 'f') {
					$this->moveForward();
				} elseif ($commands[$index] === 'b') {
					$this->moveBackWard();
				} elseif ($commands[$index] === 'l') {
					$this->turnLeft();
				} elseif ($commands[$index] === 'r') {
					$this->turnRight();
				}
			} catch (\Exception $e) {
				echo $e->getMessage();
				break;
			}

			$index++;
		}
	}


}