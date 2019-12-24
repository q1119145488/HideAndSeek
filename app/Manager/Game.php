<?php
namespace App\Manager;

use App\Model\Map;
use App\Model\Player;

class Game{
    private $gameMap = [];
    private $players = [];

    function __construct()
    {
        $this->gameMap = new Map(12, 12);
    }
    function createPlayer($playerId,$x,$y){
        $player = new Player($playerId,$x,$y);
        if(!empty($this->players)){
            $player->setType(Player::PLAYER_TYPE_HIDE);
        }
        $this->players[$playerId] = $player;
    }
    function playerMove($playerId, $direction){
        if($this->canMoveDirection($this->players[$playerId],$direction))
            $this->players[$playerId]->{$direction}();
    }
    //是否可以移动
    function canMoveDirection($play,string $direction):bool{
        //获取玩家位置
        $x = $play->getX();
        $y = $play->getY();
        switch ($direction) {
            case 'down':
                $x++;
                break;
            case 'left':
                $y--;
                break;
            case 'right':
                $y++;
                break;
            default:
                $x--;
                break;
        }
        //获取地图信息
        $mapData = $this->gameMap->getMapData();
        //如果移动后的位置是墙，就不动
        if( isset($mapData[$x][$y]) && $mapData[$x][$y] != 0)
            return true;
        else
            return false;
    }
    //打印地图
    function printGameMap(){
        $mapData = $this->gameMap->getMapData();
        $font = [
            2=>'me ',
            3=>'you',
        ];
        foreach ($this->players as  $play) {
            $mapData[$play->getX()][$play->getY()] = $play->getType() +1;
        }
        $xLen = count($mapData);
        foreach ($mapData as $xIndex =>$line) {
            $yLen = count($line);
            foreach ($line as $yIndex => $value) {
                if (empty($value)) {
                    //echo "墙  ";
                    if (
                        ($yIndex == 0 ||$yIndex == ($yLen -1 )) 
                        //&& $xIndex != 0 
                        //&& $xIndex != $xLen - 1 
                    ) {
                        echo "|";
                    }else{
                        echo "---";
                    }
                } else if ($value == 1){
                    echo "   ";
                }else{
                    echo $font[$value];
                }
            }
            echo PHP_EOL;
        }
    }
    function isGameOver():bool{
        $x = -1;
        $y = -1;
        $players = array_values($this->players);
        foreach ($players as $key => $player) {
            if($key == 0){
                $x = $player->getX();
                $y = $player->getY();
            }else if($x == $player->getX() && $y == $player->getY()){
                return true;
            }
        }
        return false;
    }
}
