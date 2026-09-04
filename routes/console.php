<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('admin:create {email=admin@example.com} {password=password} {name=System Admin}', function ($email, $password, $name) {
    $role = \App\Models\Role::firstOrCreate(['name' => 'Admin']);

    $user = \App\Models\User::updateOrCreate(
        ['email' => $email],
        [
            'name' => $name,
            'password' => \Illuminate\Support\Facades\Hash::make($password),
            'role_id' => $role->id,
            'status' => 'active',
            'email_verified_at' => now(),
        ]
    );

    $this->info("Admin user successfully created/updated!");
    $this->table(
        ['Field', 'Value'],
        [
            ['ID', $user->id],
            ['Name', $user->name],
            ['Email', $user->email],
            ['Password', $password],
            ['Role', "{$role->name} (ID: {$role->id})"],
            ['Status', $user->status],
        ]
    );
})->purpose('Create or update an admin user');

Artisan::command('user:list', function () {
    $users = \App\Models\User::with('role')->get();
    $this->table(
        ['ID', 'Name', 'Email', 'Role', 'Status'],
        $users->map(fn($u) => [
            $u->id,
            $u->name,
            $u->email,
            $u->role?->name ?? 'None',
            $u->status ?? 'active',
        ])
    );
})->purpose('List all registered users');
