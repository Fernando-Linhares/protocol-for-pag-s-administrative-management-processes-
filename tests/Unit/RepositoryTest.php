<?php

namespace Tests\Unit;

use stdClass;
use Tests\TestCase;

class RepositoryTest extends TestCase
{
    /**
     * A basic unit test example.
     * @test
     * @return void
     */
    public function document_must_be_acepted(): void
    {
        $user = \App\Models\User::factory(1)->create()->first();

        \App\Models\Document::factory(1)->create();
        $app = new \App\Repository\DocumentSendRepository;
        $transfer = $app->aceptDocument($user->name, 1);

        $this->assertTrue($transfer);
    }

    /**
     * @test
     * @return void
     */
    public function document_must_be_sended(): void
    {
        $user = \App\Models\User::factory(1)->create()->first();
        $app = new \App\Repository\DocumentSendRepository;
        $transfer = $app->sendDocument($user->name, 1);
        $this->assertTrue($transfer);
    }

    /**
     * @test
     * @return void
     */
    public function new_document_must_be_created(): void
    {
        $user = \App\Models\User::factory(1)->create()->first();
        $document = [
            'title'=>'example',
            'content'=>'example',
            'unit'=>67221,
            'number'=>1231,
            'vol'=>21
        ];
        $app = new \App\Repository\DocumentSendRepository;
        $transfer = $app->newDocument($user->name, $document);

        $this->assertTrue($transfer);
    }

    /**
     * @test
     * @return void
     */
    public function documents_of_must_get_some_document(): void
    {

        $users = \App\Models\User::factory(1)->create();
        $app = new \App\Repository\DocumentSendRepository;

        $user = $users->first();
        $document = [
            'title'=>'example',
            'content'=>'example',
            'unit'=>67221,
            'number'=>1231,
            'vol'=>21
        ];

        $app->newDocument($user->name, $document);

        $documents = $app->getDocumentsOf($user, true);

        $this->assertCount(1, $documents);
    }
}
