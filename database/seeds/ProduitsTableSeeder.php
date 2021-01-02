<?php

use App\Produit;
use Illuminate\Database\Seeder;

class ProduitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    $faker = Faker\Factory::create();

        for ($i=0; $i < 30; $i++) { 
           Produit::create([
            'title' => $faker->sentence(2),
            'slug' => $faker->slug,
            'subtitle' => $faker->sentence(9),
            'description' => $faker->text,
           'price' => $faker->numberBetween(10, 300) * 100,
           'image' => 'https://via.placeholder.com/200x250'

           ]);

        }
    }
}
