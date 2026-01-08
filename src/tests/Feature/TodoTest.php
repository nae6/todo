<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Todo;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    public function testTodo()
    {
        // user
        $user = User::factory()->create();
        // このuserのtodo
        $todo = Todo::factory()->create([
            'user_id' => $user->id,
            'content' => 'テスト用Todo',
        ]);
        // login-top
        $response = $this->actingAs($user)->get('/');
        // status
        $response->assertStatus(200);
        // todo表示確認
        $response->assertSee('テスト用Todo');

        $response = $this->get('/no_route');
        $response->assertStatus(404);
    }
}
