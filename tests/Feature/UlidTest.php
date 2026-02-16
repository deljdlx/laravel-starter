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
     * ULID regex pattern (26 lowercase alphanumeric characters, Crockford's Base32).
     */
    private const ULID_PATTERN = '/^[0-9a-hjkmnp-tv-z]{26}$/';

    /**
     * Test that User model uses ULID.
     */
    public function test_user_model_uses_ulid(): void
    {
        $user = User::factory()->create();

        /** @var mixed $id */
        $id = $user->getKey();
        static::assertIsString($id);
        static::assertEquals(26, strlen($id));
        static::assertMatchesRegularExpression(self::ULID_PATTERN, $id);
    }

    /**
     * Test that Task model uses ULID.
     */
    public function test_task_model_uses_ulid(): void
    {
        $task = Task::factory()->create();

        /** @var mixed $id */
        $id = $task->getKey();
        static::assertIsString($id);
        static::assertEquals(26, strlen($id));
        static::assertMatchesRegularExpression(self::ULID_PATTERN, $id);
    }

    /**
     * Test that Task's user_id foreign key uses ULID.
     */
    public function test_task_user_relationship_uses_ulid(): void
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id]);

        /** @var mixed $userId */
        $userId = $task->getAttribute('user_id');
        static::assertIsString($userId);
        static::assertEquals(26, strlen($userId));
        static::assertEquals($user->id, $task->user_id);

        $taskUser = $task->user;
        static::assertNotNull($taskUser);
        static::assertEquals($user->id, $taskUser->id);
    }

    /**
     * Test that ULIDs are lexicographically sortable.
     */
    public function test_ulids_are_sortable(): void
    {
        $user1 = User::factory()->create();
        usleep(1000);
        $user2 = User::factory()->create();

        // ULIDs are designed to be sortable, so the second one should be "greater"
        static::assertGreaterThan($user1->id, $user2->id);
    }

    /**
     * Test that ULIDs are unique.
     */
    public function test_ulids_are_unique(): void
    {
        $users = User::factory()->count(10)->create();

        $ids = $users->pluck('id')->toArray();
        $uniqueIds = array_unique($ids);

        static::assertCount(10, $uniqueIds);
    }
}
