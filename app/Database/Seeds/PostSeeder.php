<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    public function run()
    {
        $model = new Post();
        $model->insertBatch([
            [
                'title' => 'First Post',
                'body'  => 'This is the body of the first post'
            ],
            [
                'title' => 'Second Post',
                'body'  => 'This is the body of the second post'
            ],
        ]);
    }
}
