<?php

namespace MarsRovers;


class Direction
{
	CONST NORTH = 'N';
	CONST EST = 'E';
	CONST SOUTH = 'S';
	CONST WEST = 'W';
	CONST SHORT_NAME_LIST = ['N', 'E', 'S', 'W'];

	private $shortName;

	/**
	 * @param string $shortName
	 */
	public function setShortName($shortName)
	{
		$this->shortName = $shortName;
	}

	/**
	 * Direction constructor.
	 * @param string $string
	 */
	public function __construct($directionShortName)
	{
		if (!in_array($directionShortName, self::SHORT_NAME_LIST)) {
			throw new \Exception('try to create direction with a invalid short name');
		}

		$this->setShortName($directionShortName);
	}

	public function turnLeft()
	{
		$key = array_search($this->shortName, self::SHORT_NAME_LIST);
		if ($key === 0) {
			$newKey = 3;
		} else {
			$newKey = $key - 1;
		}
		$this->shortName = self::SHORT_NAME_LIST[$newKey];
	}

	public function turnRight()
	{
		$key = array_search($this->shortName, self::SHORT_NAME_LIST);
		$newKey = ($key + 1) % 4;
		$this->shortName = self::SHORT_NAME_LIST[$newKey];
	}

	public function turnBack()
	{
		$key = array_search($this->shortName, self::SHORT_NAME_LIST);
		$newKey = ($key + 2) % 4;
		$this->shortName = self::SHORT_NAME_LIST[$newKey];
	}

	/**
	 * @return string
	 */
	public function getShortName()
	{
		return $this->shortName;
	}
}