<?php

/*
 * This file is part of the GameLife package.
 * (c) Fco Javier Núñez Berrocoso <javiernuber@gmail.com>
 */

namespace GameLife;

/**
 * Class Universe
 * Implemetacion the game of life through an array containing the universe.
 *
 * @package GameLife
 * @author Fco Javier Núñez Berrocoso <javiernuber@gmail.com>
 */
class Universe
{
    private $dimension;
    private $array_universe;

    public function __construct($dimension)
    {
        $this->dimension = $dimension;
    }

    public function getArrayUniverse()
    {
        return $this->array_universe;
    }

    public function setArrayUniverse($array_universe)
    {
        $this->array_universe = $array_universe;
    }

    public function buildRandomUniverse()
    {
        $this->array_universe = array();
        for ($i = 0; $i < $this->dimension; $i++){
            $this->array_universe[] = array();
            for ($j = 0; $j < $this->dimension; $j++){
                $this->array_universe[$i][$j] = rand(0,1);
            }
        }
    }

    public function outsideBoard($x, $y)
    {
        return ($x < 0 || $y < 0 || $x >= $this->dimension || $y >= $this->dimension);
    }

    public function getNumNeighbors($x, $y)
    {
        $neighbors_distance = array(array(-1,-1), array(-1,0), array(-1,1), array(0,-1), array(0,1), array(1,-1), array(1,0), array(1,1));
        $neighbors = 0;

        foreach ($neighbors_distance as $distance) {
            $x_neighbor = $distance[0] + $x;
            $y_neighbor = $distance[1] + $y;
            if (!$this->outsideBoard($x_neighbor, $y_neighbor)){
                if($this->array_universe[$x_neighbor][$y_neighbor]){
                    $neighbors ++;
                }
            }
        }

        return $neighbors;
    }

    public function envolve()
    {
        $aux_universe = $this->array_universe;
        for ($row = 0; $row < $this->dimension; $row++){
            for ($col = 0; $col < $this->dimension; $col++){
                $neighbor = $this->getNumNeighbors($row, $col);
                if ($neighbor < 2 || $neighbor > 3){
                    $aux_universe[$row][$col] = 0; //Dies or is dead
                }elseif ($neighbor == 3){
                    $aux_universe[$row][$col] = 1; //Born or still alive
                }
            }
        }
        $this->array_universe = $aux_universe;
    }

    public function paint()
    {
        $game_print = '';
        foreach ($this->array_universe as $row) {
            foreach ($row as $cell) {
                if ($cell){
                    $game_print .= '■ ';
                }else{
                    $game_print .= '. ';
                }
            }
            $game_print .= PHP_EOL;
        }
        return $game_print;
    }
}