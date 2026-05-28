<?php

namespace Database\Seeders;

// use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        DB::table('settings')->insert([
            ['key' => 'exam_status', 'value' => 'waiting'],
            ['key' => 'current_token', 'value' => 'UJIAN123'],
            ['key' => 'token_expired_at', 'value' => now()->addMinutes(120)->format('Y-m-d H:i:s')],
            ['key' => 'exam_duration', 'value' => '1800'],
        ]);

    }
}
