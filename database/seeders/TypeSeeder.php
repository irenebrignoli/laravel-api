<?php

namespace Database\Seeders;

use App\Models\Type;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str; 

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'One-page layout',
            'Login authentication',  
            'Product landing page', 
            'Giphy with a unique API',
            'JavaScript quiz game',
            'To-do list',
            'SEO-friendly website',
            'JavaScript drawing',
            'Search engine result page',
            'Google home page lookalike',
            'Tribute page',
            'Survey form'
        ];

        foreach($types as $type){
            $newType = new Type();
            $newType->name = $type;
            $newType->slug = Str::slug($type, '-');
            $newType->save();

        }
    }
}
