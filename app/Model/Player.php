<?php

namespace App\Model;

class Player
{
    const UP = 'up';
    const DOWN = 'down';
    const LEFT = 'left';
    const RIGHT = 'right';

    const PLAYER_TYPE_SEEK = 1;
    const PLAYER_TYPE_HIDE = 2;

    const DIRECTION = [SELF::UP, SELF::DOWN, SELF::LEFT, SELF::RIGHT];
    private $id;
    private $type = self::PLAYER_TYPE_SEEK;
    private $x;
    private $y;

    public function __construct($id, $x, $y)
    {
        $this->id = $id;
        $this->x = $x;
        $this->y = $y;
    }

    public function setType($type)
    {
        $this->type = $type;
    }
    function getType(){
        return $this->type;
    }
    public function getId()
    {
        return $this->id;
    }
    function up()
    {
        $this->x--;
    }

    function down()
    {
        $this->x++;
    }

    function left()
    {
        $this->y--;
    }

    function right()
    {
        $this->y++;
    }
    function getX(){
        return $this->x;
    }
    function getY(){
        return $this->y;
    }
}
