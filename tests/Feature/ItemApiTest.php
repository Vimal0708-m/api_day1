<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_items_can_be_created_and_listed(): void
    {
        $createResponse = $this->postJson('/api/items', [
            'name' => 'Test from Bruno',
            'description' => 'First API item',
        ]);

        $createResponse
            ->assertCreated()
            ->assertJsonPath('data.name', 'Test from Bruno')
            ->assertJsonPath('data.completed', false);

        $this->getJson('/api/items')
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.name', 'Test from Bruno');
    }

    public function test_items_can_be_updated_and_deleted(): void
    {
        $itemId = $this->postJson('/api/items', [
            'name' => 'Draft item',
        ])->json('data.id');

        $this->patchJson("/api/items/{$itemId}", [
            'completed' => true,
        ])
            ->assertOk()
            ->assertJsonPath('data.completed', true);

        $this->deleteJson("/api/items/{$itemId}")
            ->assertNoContent();

        $this->getJson("/api/items/{$itemId}")
            ->assertNotFound();
    }
}
