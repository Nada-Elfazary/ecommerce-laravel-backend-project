<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Variant;
use App\Models\Product;

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

        $product = Product::factory()->create([
            'average_rating'=>5,
        ]);
        $product2 = Product::factory()->create([
            'average_rating'=>2,
        ]);

        Variant::factory()->create([
            'title' => 'short',
            'product_id' => $product->id,
            'skuid' => 'uiuyf8589yw',
            'option1' => 'casual',
            'option2' => 'orange',
            'price' => 30,

        ]);

        Variant::factory()->create([
            'title' => 'short',
            'skuid' => 'uiuyf859yw',
            'product_id' => $product2->id,
            'option1' => 'formal',
            'option2' => 'white',
            'price' => 70,

        ]);

        Product::factory(2)->create();
        

        Variant::factory()->create([
            'title' => 'short',
            'product_id' => 5,
            'skuid' => 'uiuyf899yiw',
            'option1' => 'casual',
            'option2' => 'medium',

        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
