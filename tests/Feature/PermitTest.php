<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PermitTest extends TestCase
{
    protected $url = '/api/permits';

    use RefreshDatabase,WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetAll()
    {
        $response = $this->get($this->url);

        $response->assertStatus(200)->assertSee('data');
    }

    public function testGetID()
    {
        $rand = rand(1, 10);
        $response = $this->get($this->url.'/'.$rand);

        $response->assertStatus(200)->assertSee("data");
    }

    public function testGetWrongID()
    {
        $id = 10000;
        $response = $this->get($this->url.'/'.$id);
        $response->assertStatus(400);
    }

    public function testCreatePermit()
    {
        $data = [
            'user_id' => rand(1,10),
            "submission_date" => $this->faker->date(),
            "reason" => $this->faker->realText(rand(10,100)),
        ];

        $response = $this->post($this->url, $data);

        $response->assertStatus(201)->assertSee("data");

        $this->assertDatabaseHas('permits', $data);
    }

    public function testCreatePermitWrongUserID()
    {
        $data = [
            'user_id' => "aaaa",
            "submission_date" => $this->faker->date(),
            "reason" => $this->faker->realText(rand(10,100)),
        ];

        $response = $this->post($this->url, $data);

        $response->assertStatus(422)->assertSee("error");
    }

    public function testCreatePermitWrongSubmissionDate()
    {
        $data = [
            'user_id' => rand(1,10),
            "submission_date" => "aaa",
            "reason" => $this->faker->realText(rand(10,100)),
        ];

        $response = $this->post($this->url, $data);

        $response->assertStatus(422)->assertSee("error");
    }

    public function testCreatePermitEmptyReason()
    {
        $data = [
            'user_id' => rand(1,10),
            "submission_date" => $this->faker->date(),
            // "reason" => $this->faker->realText(rand(10,100)),
        ];

        $response = $this->post($this->url, $data);

        $response->assertStatus(422)->assertSee("error");
    }

    public function testWithPagination()
    {
        $response = $this->get($this->url."?limit=10&page=1");

        $response->assertStatus(200)->assertSee('meta')->assertSee('data');
    }

    public function testWithPaginationNullLimit()
    {
        $response = $this->get($this->url."?limit=&page=");

        $response->assertStatus(200)->assertDontSee('meta')->assertSee('data');
    }

    public function testWithPaginationWrongLimit()
    {
        $response = $this->get($this->url."?limit=aaaa&page=1");

        $response->assertStatus(422)->assertSee('error');
    }

    public function testWithPaginationWrongPage()
    {
        $response = $this->get($this->url."?limit=1&page=asda1");

        $response->assertStatus(422)->assertSee('error');
    }
}
