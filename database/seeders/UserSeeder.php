<?php

    namespace Database\Seeders;

    use App\Models\User;
    use Illuminate\Database\Seeder;

    class UserSeeder extends Seeder {

        public function run(): void
        {
            User::create([
                'name'=>'Admin',
                'password' => 'password',
                'email' => 'admin@admin.com',
                         ]);
        }
    }
