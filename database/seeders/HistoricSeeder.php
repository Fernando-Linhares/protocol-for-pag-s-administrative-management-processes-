<?php

namespace Database\Seeders;

use App\Models\Historic;
use Illuminate\Database\Seeder;

class HistoricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<21;$i++):
            Historic::create(['id'=>null,'user_id'=>1,'doc_id'=>$i,'acept'=>true]);
        endfor;
    }
}
