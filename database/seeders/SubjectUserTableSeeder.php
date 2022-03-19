<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubjectUser;

class SubjectUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubjectUser::factory()->count(15)->create();
    }
}
