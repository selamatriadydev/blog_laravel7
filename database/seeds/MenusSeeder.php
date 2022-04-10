<?php

use Illuminate\Database\Seeder;

class MenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            ['title' => 'Dashboard', 'parent_id' => 0, 'sort' => 1, 'link' => '/'],
            ['title' => 'Aticle', 'parent_id' => 0, 'sort' => 2, 'link' => '#'],
            ['title' => 'New Article', 'parent_id' => 2, 'sort' => 3, 'link' => 'admin/posts/create'],
            ['title' => 'All Article', 'parent_id' => 2, 'sort' => 4, 'link' => 'admin/posts'],
            ['title' => 'Comment', 'parent_id' => 2, 'sort' => 5, 'link' => 'admin/comments'],

            ['title' => 'Portofolio', 'parent_id' => 0, 'sort' => 6, 'link' => '#'],
            ['title' => 'Banner', 'parent_id' => 6, 'sort' => 7, 'link' => 'admin/banner'],
            ['title' => 'Skill', 'parent_id' => 6, 'sort' => 8, 'link' => 'admin/skill'],
            ['title' => 'Sub Skill', 'parent_id' => 6, 'sort' => 9, 'link' => 'admin/sub_skill'],
            ['title' => 'Project', 'parent_id' => 6, 'sort' => 10, 'link' => 'admin/project'],

            ['title' => 'Parameter Article', 'parent_id' => 0, 'sort' => 11, 'link' => '#'],
            ['title' => 'Tags', 'parent_id' => 11, 'sort' => 12, 'link' => 'admin/tags'],
            ['title' => 'Category', 'parent_id' => 11, 'sort' => 13, 'link' => 'admin/categories'],

            ['title' => 'Parameter Portofolio', 'parent_id' => 0, 'sort' => 14, 'link' => '#'],
            ['title' => 'Category', 'parent_id' => 14, 'sort' => 15, 'link' => 'admin/category_project'],

            ['title' => 'Parameter App', 'parent_id' => 0, 'sort' => 16, 'link' => '#'],
            ['title' => 'Menus', 'parent_id' => 16, 'sort' => 17, 'link' => 'admin/menus'],
            ['title' => 'Group', 'parent_id' => 16, 'sort' => 18, 'link' => 'admin/group'],
        ];
        foreach ($menus as $menu) {
            App\Menus::Create($menu);
        }
    }
}
