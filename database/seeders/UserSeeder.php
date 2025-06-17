<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = [
            ['name' => 'Agus Rustoyo', 'email' => '17220723@bsi.ac.id', 'password' => '17220723'],
            ['name' => 'Alferiza Muhammad Shadiq', 'email' => '17220157@bsi.ac.id', 'password' => '17220157'],
            ['name' => 'Alief Kurniawan', 'email' => '17220954@bsi.ac.id', 'password' => '17220954'],
            ['name' => 'Axal Oxynawa', 'email' => '17220026@bsi.ac.id', 'password' => '17220026'],
            ['name' => 'Azwar Rambe', 'email' => '17220664@bsi.ac.id', 'password' => '17220664'],
            ['name' => 'Bagas Alrizky Tella', 'email' => '17220889@bsi.ac.id', 'password' => '17220889'],
            ['name' => 'Bhima Malik Al-Fauzi', 'email' => '17220483@bsi.ac.id', 'password' => '17220483'],
            ['name' => 'Dafa Ramadhan', 'email' => '17220857@bsi.ac.id', 'password' => '17220857'],
            ['name' => 'Daniel Obraido Napitupulu', 'email' => '17220970@bsi.ac.id', 'password' => '17220970'],
            ['name' => 'Febbryandi', 'email' => '17220435@bsi.ac.id', 'password' => '17220435'],
            ['name' => 'Kaisar Wachid', 'email' => '17221212@bsi.ac.id', 'password' => '17221212'],
            ['name' => 'Lastiur Purba', 'email' => '17220238@bsi.ac.id', 'password' => '17220238'],
            ['name' => 'Mochammad Daud Ilham', 'email' => '17220266@bsi.ac.id', 'password' => '17220266'],
            ['name' => 'Muh Irfan Andika Akbar', 'email' => '17220013@bsi.ac.id', 'password' => '17220013'],
            ['name' => 'Muhammad Andriyansyah', 'email' => '17220597@bsi.ac.id', 'password' => '17220597'],
            ['name' => 'Muhamad Fajar Saputra', 'email' => '17220694@bsi.ac.id', 'password' => '17220694'],
            ['name' => 'Neren Lamfied', 'email' => '17220520@bsi.ac.id', 'password' => '17220520'],
            ['name' => 'Nova Nurachman', 'email' => '17220288@bsi.ac.id', 'password' => '17220288'],
            ['name' => 'Nurman Aditya', 'email' => '17221116@bsi.ac.id', 'password' => '17221116'],
            ['name' => 'Rifki Haekal', 'email' => '17220495@bsi.ac.id', 'password' => '17220495'],
            ['name' => 'Rully Sabrina Adiska', 'email' => '17220592@bsi.ac.id', 'password' => '17220592'],
            ['name' => 'Sapta Putra Damar', 'email' => '17220178@bsi.ac.id', 'password' => '17220178'],
            ['name' => 'Utiya Nur Azizah', 'email' => '17221068@bsi.ac.id', 'password' => '17221068'],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'name'     => $user['name'],
                    'email'    => $user['email'],
                    'password' => Hash::make($user['password']),
                    'role'     => 'voter', // atau sesuai default role
                ]
            );
        }
    }
}
