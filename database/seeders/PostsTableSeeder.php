<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class PostsTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        $faker = Faker::create();

        foreach (range(1,100) as $index) {
            \App\Models\Post::create([
                'title' => $faker->words(6, true),
                'content' => $faker->paragraph(),
                'creator_id' => $faker->numberBetween(1, 3),
                'voucher_enable' => $faker->boolean(),
                'voucher_quantity' => $faker->numberBetween(1, 5),
            ]);
        }
    }
}
