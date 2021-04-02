<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(PermissionTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(CategoriaPostTableSeeder::class);
        $this->call(ContentTypeTableSeeder::class);
        $this->call(LanguageTableSeeder::class);
        $this->call(CalificacionPostTableSeeder::class);
        $this->call(SectionPageTableSeeder::class);
        $this->call(ServiceTableSeeder::class);
        $this->call(PortfolioTableSeeder::class);
        $this->call(PaketTypeTableSeeder::class);
        $this->call(FunctionIncludedTableSeeder::class);
        $this->call(PaketTableSeeder::class);
        $this->call(ContactTableSeeder::class);
        $this->call(ChatTypeMessageTableSeeder::class);
        $this->call(ChatTypeRoomTableSeeder::class);
        $this->call(ChatRoomTableSeeder::class);
    }
}
