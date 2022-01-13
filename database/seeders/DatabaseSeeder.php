<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Storage::deleteDirectory('public/images');
        // Storage::makeDirectory('public/images');
        $folder ='public/storage/images';// public_path('images');
        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0755, true, true);
        } else {
            File::deleteDirectory($folder);
            File::makeDirectory($folder, 0755, true, true);
        }
        // \App\Models\User::factory(10)->create();

        $this->call([
            // $permissions = PermissionSeeder::class,
            $roles = RoleSeeder::class,
            UserSeeder::class,
            // CommentSeeder::class,

        ]);
        \App\Models\Empleado::factory(100)->create();
    }
}
