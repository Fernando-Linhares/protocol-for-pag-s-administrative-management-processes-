<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Document;

class DocumentModelTest extends TestCase
{
    /**
     * @test
     */
    public function scope_must_return_all_not_acepted(): void
    {
        $document = new Document([
            'title'=>'example',
            'content'=>'example',
            'unit'=>rand(1000,4000),
            'number'=>rand(2000,3000),
            'vol'=>rand(10,20),
            'user_id'=>rand(1,30),
            'acepted'=>false
        ]);
        $document->save();
        $acepted = $document->notAcepted()->first();
        $this->assertNotEmpty($acepted);
    }
}
