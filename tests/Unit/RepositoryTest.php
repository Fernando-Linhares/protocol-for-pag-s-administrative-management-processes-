<?php

namespace Tests\Unit;

use Tests\TestCase;

class RepositoryTest extends TestCase
{
    /**
     * A basic unit test example.
     * @test
     * @return void
     */
    public function acept_document(): void
    {
        \App\Models\Document::factory(1)->create();
        $app = new \App\Repository\DocumentSendRepository;
        $transfer = $app->aceptDocument("fernando",1);

        $this->assertTrue($transfer);
    }

    /**
     * @test
     * @return void
     */
    public function send_document(): void
    {

        $app = new \App\Repository\DocumentSendRepository;
        $transfer = $app->sendDocument("fernando",1);
        $this->assertTrue($transfer);
    }

    /**
     * @test
     * @return void
     */
    public function new_document(): void
    {
        $document = [
            'title'=>'example',
            'content'=>'example',
            'unit'=>67221,
            'number'=>1231,
            'vol'=>21
        ];
        $app = new \App\Repository\DocumentSendRepository;
        $transfer = $app->newDocument("fernando",$document);

        $this->assertTrue($transfer);
    }
}
