<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // Shop
        $this->call(OrderStatusSeeder::class);
        $this->call(VerificationTypeSeeder::class);
        $this->call(PageSystemSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(FaqSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(UserSeeder::class);

        // Manager
        $this->call(ManagerRoleSeeder::class);
        $this->call(ManagerSeeder::class);

        $this->call(ProductSeeder::class);

        Schema::enableForeignKeyConstraints();
    }
}
