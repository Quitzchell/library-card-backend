<?php

namespace Database\Seeders;

use App\Enums\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        $regions = ['NL', 'BE', 'UK/EU', 'DE', 'World'];
        $teams = [Team::Bookings->value, Team::Management->value, Team::Promotion->value];

        $sortByTeam = [];
        $rows = [];

        foreach ($teams as $team) {
            $count = fake()->numberBetween(1, 3);

            for ($i = 0; $i < $count; $i++) {
                $sortByTeam[$team] = ($sortByTeam[$team] ?? 0) + 1;

                $rows[] = [
                    'first_name' => fake()->firstName(),
                    'last_name' => fake()->lastName(),
                    'region' => fake()->randomElement($regions),
                    'organization' => fake()->company(),
                    'email' => fake()->unique()->safeEmail(),
                    'team' => $team,
                    'sort' => $sortByTeam[$team],
                ];
            }
        }

        DB::table('team_members')->insert($rows);
    }
}