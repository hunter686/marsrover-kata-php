<?php

namespace MarsRovers;


class Surface
{
	private $obsTackles;
	private $xMaxLocation;
	private $yMaxLocation;

	/**
	 * @return int
	 */
	public function getXMaxLocation()
	{
		return $this->xMaxLocation;
	}

	/**
	 * @param int|string $xMaxLocation
	 */
	public function setXMaxLocation($xMaxLocation)
	{
		if (!is_int($xMaxLocation)) {
			throw new \Exception('try to set a invalid x range');
		}
		$this->xMaxLocation = $xMaxLocation;
	}

	/**
	 * @return int
	 */
	public function getYMaxLocation()
	{
		return $this->yMaxLocation;
	}

	/**
	 * @param int|string $yMaxLocation
	 */
	public function setYMaxLocation($yMaxLocation)
	{
		if (!is_int($yMaxLocation)) {
			throw new \Exception('try to set a invalid y range');
		}
		$this->yMaxLocation = $yMaxLocation;
	}

	/**
	 * Surface constructor.
	 * @param int $xMaxLocation
	 * @param int $yMaxLocation
	 */
	public function __construct($xMaxLocation, $yMaxLocation, $ObsTackles = [])
	{
		$this->setXMaxLocation($xMaxLocation);
		$this->setYMaxLocation($yMaxLocation);
		$this->setObsTackles($ObsTackles);
	}

	/**
	 * @param  array $obsTackles
	 */
	public function setObsTackles($obsTackles)
	{
		$this->obsTackles = $obsTackles;
	}

	/**
	 * @return array ObsTackle
	 */
	public function getObsTackles()
	{
		return $this->obsTackles;
	}

	/**
	 * @param ObsTackle $ObsTackle
	 */
	public function addObstacle(ObsTackle $ObsTackle)
	{
		$this->obsTackles[] = $ObsTackle;
	}

	public function checkOnePointIsAObstacle(Point $p)
	{
		foreach ($this->getObsTackles() as $obsTackle) {
			if ($obsTackle->getPoint()->getLocationY() === $p->getLocationY() && $obsTackle->getPoint()->getLocationX() === $p->getLocationX()) {
				return true;
			}
		}

		return false;
	}

	public function getPointByPosition($locationX, $locationY)
	{
		if ($locationX === $this->getXMaxLocation()) {
			$locationX = 0;
		}

		if ($locationY === $this->getYMaxLocation()) {
			$locationY = 0;
		}

		return new Point($locationX, $locationY);
	}
}