<?php
namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder {
    public function run(): void {
        $categories = [
            ['name' => 'Web Development'],
            ['name' => 'Mobile Development'],
            ['name' => 'Data Science'],
            ['name' => 'UI/UX Design'],
        ];

        foreach ( $categories as $category ) {
            Category::create( $category );
        }
    }
}