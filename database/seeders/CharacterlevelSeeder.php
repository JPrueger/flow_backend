<?php

namespace Database\Seeders;

use App\Models\Characterlevel;
use Illuminate\Database\Seeder;

class CharacterlevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Characterlevel::create([
            'points_upgrade' => '30',
            'video_state' => 'https://www.google.com',
            'video_upgrade' => 'https://www.google.com',
        ]);
    }
}
