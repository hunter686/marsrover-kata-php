<?php

namespace MarsRovers;


class ObsTackle
{
	private $point;

	/**
	 * ObsTackle constructor.
	 * @param Point $param
	 */
	public function __construct(Point $point)
	{
		$this->setPoint($point);
	}

	/**
	 * @return Point
	 */
	public function getPoint()
	{
		return $this->point;
	}

	/**
	 * @param Point $point
	 */
	public function setPoint(Point $point)
	{
		$this->point = $point;
	}


}