<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class RegisterTest extends TestCase
{

   public function test_register(): void
   {
      Artisan::call('migrate:fresh');

      $response = $this->post('/register', [
         'name' => 'Test User',
         'email' => 'test@example.com',
         'password' => 'password',
         'password_confirmation' => 'password',
         'username' => 'testuser',
         'role' => 0,
      ]);

      $response->assertStatus(302)->assertRedirect(route('shop'));
   }
}
