<?php
require_once __DIR__ . '/vendor/autoload.php';
use App\Manager\Game;
use App\Model\Player;

$redId = 'red_player';
$blueId = 'blue_player';
//创建游戏控制器
$game = new Game();
//添加玩家
$game->createPlayer($redId,6,1);
$game->createPlayer($blueId,6,10);
//$game->printGameMap();
//return;
$index = 0;
//
//玩家移动
while(1){
    usleep(200000);
    $direction = rand(0,3);
    $game->playerMove($redId, Player::DIRECTION[$direction]);
    $direction = rand(0, 3);
    $game->playerMove($blueId, Player::DIRECTION[$direction]);
    //打印地图
    $game->printGameMap();
    $index++;
    if($game->isGameOver()){

        echo PHP_EOL;
        echo '----------------🎮🔚------------------';
        echo '一共走了'.$index.'步';
        echo PHP_EOL;
        return;
    }
        

}

