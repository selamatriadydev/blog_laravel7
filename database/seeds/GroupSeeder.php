<?php

use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group = [
            ['id'=> 4,'name' => 'Admin', 'is_published' => 1],
            ['id'=> 5,'name' => 'Penulis', 'is_published' => 1],
        ];
        foreach ($group as $menu) {
            App\Group::Create($menu);
        }
    }
}
