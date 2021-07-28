<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function index_dashboard_status_must_be_ok(): void
    {
        $user = \App\Models\User::factory()->create();
        $response = $this->be($user)->get('/dashboard');

        $response->assertStatus(200);
    }

    /**
     * @test
     * @return void
     */
    public function entry_on_dashboard_status_must_be_ok(): void
    {
        $user = \App\Models\User::factory()->create();
        $response = $this->be($user)->get('/dashboard/entry');

        $response->assertStatus(200);
    }

    /**
     * @test
     * @return void
     */
    public function shows_document_form_status_must_be_ok(): void
    {
        $user = \App\Models\User::factory()->create();
        $response = $this->be($user)->get('/dashboard/newx');

        $response->assertStatus(200);
    }
}
