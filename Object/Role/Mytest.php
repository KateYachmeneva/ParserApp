<?php

namespace Object\Role;
use Symfony\Component\Panther\PantherTestCase;

class Mytest extends PantherTestCase {
    public function __construct($name = '', array $data = [], $dataName = '') {
        parent::__construct($name, $data, $dataName);
    }
    public function testSomething() {
        // Запустить браузер
        $client = static::createPantherClient();

// Симулировать заход на страницу
        $client->request('GET', 'https://www.liveinternet.ru/rating/#geo=ru;group=media');

    }

// Закрыть браузер
//$client->quit();
}

