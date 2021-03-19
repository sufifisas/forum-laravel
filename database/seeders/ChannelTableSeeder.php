<?php

namespace Database\Seeders;

use App\Models\Channel;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ChannelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Channel::create([
            'name' => 'Laravel 5.8',
            'slug' => Str::slug('Laravel 5.8')
        ]);

        Channel::create([
            'name' => 'Vue js 3',
            'slug' => Str::slug('Vue js 3')
        ]);

        Channel::create([
            'name' => 'Angular js 7',
            'slug' => Str::slug('Angular js 7')
        ]);
    }
}
