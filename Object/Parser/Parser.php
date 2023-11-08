<?php

namespace Object\Parser;


use Clue\React\Buzz\Browser;
use React\EventLoop\Factory;
use React\EventLoop\LoopInterface;
use Symfony\Component\Panther\PantherTestCase as PantherTestCaseAlias;



class Parser extends PantherTestCaseAlias  {
    /**
     * @var Browser
     */
    private $client;
    private $data = [];
    private $loop;

    public function __construct(Browser $client,LoopInterface $loop)
    {
        $this->client = $client;
        $this->loop = $loop;
    }

    public function parse(array $urls = [], $timeout = 5)
    {

        foreach ($urls as $url) {
            $promise = $this->client->get($url)->then(
                function (\Psr\Http\Message\ResponseInterface $response) {
                    $this->data[] = $this->parseDOM((string) $response->getBody());
                });

            $this->loop->addTimer($timeout, function() use ($promise) {
                $promise->cancel();
            });
        }
    }

    private function parseDOM(string $html)
    {
        $lines = explode("\n", $html);
        $substring = "tsargradtv";
// Проходим по каждой строке и извлекаем данные
        foreach ($lines as $index => $string) {
            if (strpos($string, $substring) !== false) {
                // Элемент содержит подстроку "tsargradtv"
                echo "Наше место: $index, Элемент: $string";
                // Вы можете выполнить другие действия с этим элементом, если необходимо
            }
        }
    $chanels = $lines;
//    var_dump($chanels);
       return [
            'chanels'  => $chanels,
        ];
    }

    public function getData()
    {
        return $this->data;
    }
}


