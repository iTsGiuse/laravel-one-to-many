<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10; $i++){
            $newType= new Type();
            $newType->name = $faker->jobTitle();
            $newType->slug = Str::slug($newType->name, '-');
            $newType->save();
        }
    }
}
