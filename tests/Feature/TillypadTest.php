<?php

namespace Tests\Feature;

use App\Services\Tillypad\TillypadService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TillypadTest extends TestCase
{

    /**
     * Тест проверяет что вернется ошибка, если номера в базе не найдено
     *
     */
    public function testCanCheckClientNull()
    {
        $this->withoutExceptionHandling();
        $service = new TillypadService();

        $check = $service->checkClient('+721331231313');

        $this->assertEquals($check, null);


    }

    /**
     * Тест проверяет, что корректно возвращается ответ, если такой номер в базе тиллипада найден
     */
    public function testCheckPhoneNotNull()
    {
        $this->withoutExceptionHandling();
        $service = new TillypadService();

        $check = $service->checkClient('+79876543210');
        $this->assertNotEmpty($check);
        $this->assertJson(json_encode($check));
        $this->assertArrayHasKey('clnt_ID', $check[0]);
    }


    /**
     * Тест проверяет, что клиент добавится в базу тиллипада
     */
    public function testSaveClient()
    {
        $this->withoutExceptionHandling();
        $service = new TillypadService();

        $check = $service->saveClient('+79876543210', 'jroo@test.ru', 'Тестовый клиент');
        $this->assertNotEmpty($check);
        $this->assertJson(json_encode($check));
        $this->assertArrayHasKey('clnt_ID', $check[0]);
    }
}
