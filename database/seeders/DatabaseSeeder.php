<?php

namespace Database\Seeders;

use App\Models\Certificate;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin Portfolio',
            'email' => 'admin@portfolio.test',
            'password' => Hash::make('password'),
        ]);

        Project::factory(8)->create();
        Certificate::factory(6)->create();
        Testimonial::factory(6)->create();
        Skill::factory(10)->create();
        Experience::factory(4)->create();
        Service::factory(4)->create();
    }
}
