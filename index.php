<?php
include_once __DIR__ . './ini.php';
require __DIR__ . '/vendor/autoload.php';
include_once __DIR__ . './autoload.php';


use Clue\React\Buzz\Browser;
use  Object\Parser\Parser as Parser;


$loop = React\EventLoop\Factory::create();


$client = new Browser($loop);

$parser = new Parser($client,$loop);

$parser->parse([
    'https://www.liveinternet.ru/rating/ru/media/today.tsv',
  ],10);

$loop->run();





