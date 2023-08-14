<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Variant;
use App\Models\Product;
use App\Models\Order;
use App\Models\Option;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Variant::factory()->create([
            'title' => 't-shirt',
            'product_id' => 10,
            'skuid' => 'uiuyf89yw',

        ]);

        Variant::factory()->create([
            'title' => 'short',
            'skuid' => 'uiuyf899yw',
            'product_id' => 8,
            'option2' => 'blue',
            'price' => 40,

        ]);

        $option1 = Option::factory()->create([
            'name' => 'size',
            'values' => ['small', 'medium', 'large'],
        ]);
        $option2 = Option::factory()->create([
            'name' => 'color',
            'values' => ['white', 'blue', 'orange'],
        ]);
        $product = Product::factory()->create([
            'average_rating'=>5,
        ]);
       
        $product->options()->attach($option1->id,[
            'option_idx' => 0,
        ]);

        $product->options()->attach($option2->id,[
            'option_idx' => 1,
        ]);
        

        $product2 = Product::factory()->create([
            'average_rating'=>2,
        ]);

        $user = User::find(1)->first();
        $user->favorites()->attach([$product->id, $product2->id]);

        Variant::factory()->create([
            'title' => 'short',
            'product_id' => $product->id,
            'skuid' => 'uiuyf8589yw',
            'option1' => 'small',
            'option2' => 'orange',
            'price' => 30,

        ]);

        Variant::factory()->create([
            'title' => 'short',
            'skuid' => 'uiuyf859yw',
            'product_id' => $product2->id,
            'option1' => 'medium',
            'option2' => 'white',
            'price' => 70,

        ]);

        Variant::factory()->create([
            'title' => 'short',
            'skuid' => 'uiuyf759yw',
            'product_id' => $product2->id,
            'option1' => 'large',
            'option2' => 'blue',
            'price' => 20,

        ]);

        Product::factory(2)->create();
        

        Variant::factory()->create([
            'title' => 'short',
            'product_id' => 5,
            'skuid' => 'uiuyf899yiw',
            'option1' => 'medium',
            'option2' => 'red',

        ]);

        $user = User::find(1)->first();
        
        Order::factory()->create([
            'user_id' => $user->id,
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
