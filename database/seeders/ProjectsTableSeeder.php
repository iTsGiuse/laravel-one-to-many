<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            $new_project= new Project();
            $new_project->name = $faker->company();
            $new_project->slug = Str::slug($new_project->name, '-');
            $new_project->client_name = $faker->name();
            $new_project->summary = $faker->paragraph();
            $new_project->save();
        }
    }
}
