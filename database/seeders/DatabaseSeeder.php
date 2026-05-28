<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        DB::table('users')->insert([
            'name'      => 'Admin Ujian',
            'email'     => 'admin@ujian.com',
            'password'  => Hash::make('Admin Ujian 321')
        ]);

        DB::table('settings')->insert([
            ['key' => 'exam_status', 'value' => 'waiting'],
            ['key' => 'current_token', 'value' => 'TOKEN123'],
            ['key' => 'token_expired_at', 'value' => now()->addMinutes(120)->format('Y-m-d H:i:s')],
            ['key' => 'exam_duration', 'value' => '1800'],
        ]);

        $this->call([
            QuestionSeeder::class,
        ]);

    }
}
