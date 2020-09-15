<?php

namespace Tests\Feature;

use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostControllerTest extends TestCase
{
    public function testGetAllDatabasePostsWithPaginateExpectsIsOk()
    {
        $response = $this->get('/api/v1/posts');

        $response->assertOk();

        $response->assertJsonStructure([
            "current_page",
            "data" => [
                [
                    "id",
                    "title",
                    "subtitle",
                    "content",
                    "created_id",
                    "modified_id",
                    "created_at",
                    "updated_at",
                ],
            ],
            "first_page_url",
            "from",
            "last_page",
            "last_page_url",
            "next_page_url",
            "path",
            "per_page",
            "prev_page_url",
            "to",
            "total",
        ]);
    }

    public function testGetAnPostDatabaseByIdExpectsIsOk()
    {
        $response = $this->get('/api/v1/posts/' . random_int(1, 2));

        $response->assertOk();

        $response->assertJsonStructure([
            "id",
            "title",
            "subtitle",
            "content",
            "created_id",
            "modified_id",
            "created_at",
            "updated_at",
        ]);
    }

    public function testCreateNewPostInApiExpectingUnauthorized()
    {
        $faker = Factory::create("pt_BR");

        $data = [
            "title"        => $faker->title,
            "subtitle"     => $faker->text(20),
            "content"      => $faker->text(255),
            "created_id"   => 1,
            "modified_id"  => 1,
            "created_at"   => $faker->date('Y-m-d'),
            "updated_at"   => $faker->date('Y-m-d'),
        ];

        $headers = [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
        ];

        $response = $this->post('/api/v1/posts/', $data, $headers);

        $response->assertStatus(401);
    }
}