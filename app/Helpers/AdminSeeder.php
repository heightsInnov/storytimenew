<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Models\User;

class AdminSeeder
{
public static function admin()
    {
        $admins = [
            [
                'name' => 'admin',
                'email'    => 'admin@storytime.com',
                'password' => bcrypt('Admin_story#2021'),
                'is_approved' => 1,
                'is_verified' => 1,
                'is_activated' => 1,
                'is_admin' => 1,
                'code'  => uniqid(),
            ],
        ];

        // Seed Users (admin) table into the DB
        foreach ($admins as $admin) {
            $newUser = User::where('name', '=', $admin['name'])->first();
            if ($newUser === null) {
                User::create([
                    'name' => $admin['name'],
                    'email' => $admin['email'],
                    'password' => $admin['password'],
                    'is_approved' => $admin['is_approved'],
                    'is_verified' => $admin['is_verified'],
                    'is_activated' => $admin['is_activated'],
                    'is_admin' => $admin['is_admin'],
                    'code' => $admin['code'],
                ]);
            }
        }
    }
}
