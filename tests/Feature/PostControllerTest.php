<?php

namespace Tests\Feature;

use App\Model\User;
use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

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

        $email = $faker->email;
        $password = $faker->password(8);

        $userData = [
            "email" => $email,
            "password" => bcrypt($password)
        ];
        
        $user = factory(User::class)->create($userData);

        $client = DB::table("oauth_clients")->where("password_client", 1)->first();
        
        $dataLogin = [
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => $email,
            'password' => $password,
            'scope' => ''
        ];

        $responseLogin = $this->post('/oauth/token', $dataLogin)->assertJsonStructure([
            "access_token",
            "refresh_token"
        ]);

        $login = json_decode($responseLogin->getContent());

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
            "headers" => [
                "Content-Type" => "application/json",
                "Accept" => "application/json",
                "Authorization" => "Bearer {$login->access_token}",
            ]
        ];

        $response = $this->post('/api/v1/posts/', $data, $headers);

        // TODO: Corrigir teste e adicionar assert do status da resposta.
    }
}