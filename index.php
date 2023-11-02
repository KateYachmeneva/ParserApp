<?php
include_once __DIR__ . './ini.php';
require __DIR__ . '/vendor/autoload.php';
include_once __DIR__ . './autoload.php';


use Clue\React\Buzz\Browser;
use  Object\Parser\Parser as Parser;


$loop = React\EventLoop\Factory::create();


$client = new Browser($loop);

$parser = new Parser($client,$loop);
//https://astrology-online.ru/
//https://www.liveinternet.ru/rating/#geo=ru;group=media
$parser->parse([
    'https://www.liveinternet.ru/rating/#geo=ru;group=media',
  ],10);
\React\Promise\all($parser->getData())->then(function () use ($parser) {
    var_dump($parser->getData());
})->otherwise(function ($error) {
    echo "Ошибка: " . $error->getMessage() . PHP_EOL;
});

$loop->run();

var_dump($parser->getData());





