<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
{
    // Create the admin user
    $admin = \App\Models\User::factory()->create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'email_verified_at' => now(),
        'password' => bcrypt('password'),
        'role' => 'admin',
    ]);

    // Create the team leads and assign the admin as their mentor
    $teamLeads = \App\Models\User::factory(5)->create([
        'role' => 'team_lead',
    ]);

    foreach ($teamLeads as $teamLead) {
        $teamLead->mentor_id = $admin->id;
        $teamLead->save();
    }

    // Create the buyers and assign them random team leads as their mentors
    $buyers = \App\Models\User::factory(25)->create([
        'role' => 'buyer',
    ]);

    foreach ($buyers as $buyer) {
        $buyer->mentor_id = $teamLeads->random()->id;
        $buyer->save();
    }

    // Create entities and associate them with random users
    \App\Models\Entity::factory(50)->create();
}

}
