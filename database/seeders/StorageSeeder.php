<?php

namespace Database\Seeders;

use App\Models\Storage;
use Illuminate\Database\Seeder;

class StorageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<21;$i++):
            Storage::create(['id'=>null,'user_id'=>1,'doc_id'=>$i,'ondashboard'=>true]);
        endfor;
    }
}
