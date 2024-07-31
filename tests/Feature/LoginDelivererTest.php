<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class LoginDelivererTest extends TestCase
{
   /**
    * A basic feature test example.
    */
   public function test_deliverer(): void
   {
      Artisan::call('migrate:fresh');

      $response = $this->post('/register', [
         'name' => 'Test User',
         'email' => 'test@example.com',
         'password' => 'password',
         'password_confirmation' => 'password',
         'username' => 'testuser',
         'role' => 1,
      ]);

      $response->assertStatus(302)->assertRedirect(route('delivery.index'));
   }
}
