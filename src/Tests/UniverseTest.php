<?php

/*
 * This file is part of the GameLife package.
 * (c) Fco Javier Núñez Berrocoso <javiernuber@gmail.com>
 */

namespace GameLife\Tests;

use GameLife\Universe;

class UniverseTest extends \PHPUnit_Framework_TestCase
{
    public function testAUniverseIsATwoDimensionalArray()
    {
        //arrange
        $universe = new Universe(10);
        //Act
        $universe->buildRandomUniverse();
        //assert
        $array_universe = $universe->getArrayUniverse();
        $this->assertEquals(count($array_universe), 10);
        $this->assertEquals(count($array_universe[0]), 10);
    }

    public function testOutsideBoardTrue()
    {
        //arrange
        $universe = new Universe(10);
        //Act
        $universe->buildRandomUniverse();
        //assert
        $this->assertTrue($universe->outsideBoard(-1, -1));
    }

    public function testOutsideBoardFalse()
    {
        //arrange
        $universe = new Universe(10);
        //Act
        $universe->buildRandomUniverse();
        //assert
        $this->assertFalse($universe->outsideBoard(1, 1));
    }

    public function testNumNeighbords()
    {
        //arrange
        $universe = new Universe(10);
        //Act
        $universe->buildRandomUniverse();
        //Act
        $array_universe = $universe->getArrayUniverse();
        $num_neighbord = 0;
        $num_neighbord += $array_universe[0][1];
        $num_neighbord += $array_universe[1][1];
        $num_neighbord += $array_universe[1][0];

        //assert
        $this->assertEquals($num_neighbord, $universe->getNumNeighbors(0, 0));
    }

    public function testEnvolveDies()
    {
        //arrange
        $universe = new Universe(3);
        //Act
        $row = array(1, 0, 1);
        $test_universe[] = $row;
        $test_universe[] = $row;
        $test_universe[] = $row;
        $universe->setArrayUniverse($test_universe);
        $universe->envolve();
        //assert
        $array_universe = $universe->getArrayUniverse();
        $this->assertTrue($array_universe[0][0] == 0);
    }
}
