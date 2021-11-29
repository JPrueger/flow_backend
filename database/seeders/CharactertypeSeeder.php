<?php

namespace Database\Seeders;

use App\Models\Charactertype;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CharactertypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Charactertype::insert([
            [
                'name' => 'Dragon',
                'video_start' => 'https://www.google.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Ghost',
                'video_start' => 'https://www.google.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
