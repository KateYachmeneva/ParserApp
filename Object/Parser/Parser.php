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
        $document = new \DiDom\Document($html);
        $title = $document->first('div.footer-text')->text();

//        $alternativeHeadline = $document->first('div.result-logo');
//        $tableRows = $document->find('table.info tr');
//        $year = $tableRows[0]->first('a')->text(); // 2019
//        $country = $tableRows[1]->first('a')->text(); // США


        return [
            'title'             => $title,
//            'alternative_title' => $alternativeHeadline,
//            'year'              => $year,
//            'country'           => $country,
//            'time'              => $time,
//            'rating'            => $rating,
        ];
    }

    public function getData()
    {
        return $this->data;
    }
}


