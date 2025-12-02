<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UlidTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that User model uses ULID.
     */
    public function test_user_model_uses_ulid(): void
    {
        $user = User::factory()->create();
        
        $this->assertIsString($user->id);
        $this->assertEquals(26, strlen($user->id));
        $this->assertMatchesRegularExpression('/^[0-9a-hjkmnp-tv-z]{26}$/', $user->id);
    }

    /**
     * Test that Task model uses ULID.
     */
    public function test_task_model_uses_ulid(): void
    {
        $task = Task::factory()->create();
        
        $this->assertIsString($task->id);
        $this->assertEquals(26, strlen($task->id));
        $this->assertMatchesRegularExpression('/^[0-9a-hjkmnp-tv-z]{26}$/', $task->id);
    }

    /**
     * Test that Task's user_id foreign key uses ULID.
     */
    public function test_task_user_relationship_uses_ulid(): void
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id]);
        
        $this->assertIsString($task->user_id);
        $this->assertEquals(26, strlen($task->user_id));
        $this->assertEquals($user->id, $task->user_id);
        $this->assertEquals($user->id, $task->user->id);
    }

    /**
     * Test that ULIDs are lexicographically sortable.
     */
    public function test_ulids_are_sortable(): void
    {
        $user1 = User::factory()->create();
        sleep(1);
        $user2 = User::factory()->create();
        
        // ULIDs are designed to be sortable, so the second one should be "greater"
        $this->assertGreaterThan($user1->id, $user2->id);
    }

    /**
     * Test that ULIDs are unique.
     */
    public function test_ulids_are_unique(): void
    {
        $users = User::factory()->count(10)->create();
        
        $ids = $users->pluck('id')->toArray();
        $uniqueIds = array_unique($ids);
        
        $this->assertCount(10, $uniqueIds);
    }
}
