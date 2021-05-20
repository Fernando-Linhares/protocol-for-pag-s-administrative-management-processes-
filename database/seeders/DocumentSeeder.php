<?php

namespace Database\Seeders;

use App\Models\Document;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<20; $i++):
            Document::create([
                'id'=>null,
                'title'=>'Contrato De Empresa',
                'content'=>'Contrato de empresa de limpeza para unidade',
                'unit'=>67221,
                'number'=>rand(3000,4000),
                'vol'=>rand(1,99)
                ]);
        endfor;
    }
}
