<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class SalesTest extends TestCase
{
   /**
    * A basic feature test example.
    */
   public function test_checkout(): void
   {
      Artisan::call('migrate:fresh');

      $user = User::factory()->create();

      $product1 = Product::factory()->create(['price' => 100, 'cuantity' => 10]);
      $product2 = Product::factory()->create(['price' => 200, 'cuantity' => 5]);

      session()->put('cart', [
         $product1->id => ['cuantity' => 2],
         $product2->id => ['cuantity' => 1]
      ]);

      $response = $this->actingAs($user)->post('/checkout', [
         'products' => [
            $product1->id => ['cuantity' => 2],
            $product2->id => ['cuantity' => 1]
         ]
      ]);

      $response->assertStatus(302);
   }
}
