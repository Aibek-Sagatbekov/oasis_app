<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AddAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            (object)[
                'name'          => 'ZmeyGAR',
                'email'         => 'lagutin1991@gmail.com',
                'password'      => '0305894795',
            ],
            (object)[
                'name'          => 'info@kazteleradio.kz',
                'email'         => 'info@kazteleradio.kz',
                'password'      => 'Aa1234',
            ],
            (object)[
                'name'          => 'v.dmitriyeva@kazteleradio.kz',
                'email'         => 'v.dmitriyeva@kazteleradio.kz',
                'password'      => 'Aa1234',
            ],
            (object)[
                'name'          => 'd.atygaev@kazteleradio.kz',
                'email'         => 'd.atygaev@kazteleradio.kz',
                'password'      => 'Aa1234',
            ],
        ];

        foreach ($users as $user) {
            $user = User::firstOrCreate([
                'name' => $user->name,
                'email' => $user->email,
            ], [
                'password' => Hash::make($user->password),
            ]);
        }
    }
}
