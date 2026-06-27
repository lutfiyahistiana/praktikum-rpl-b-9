<?php

namespace Tests\Unit;

use App\Models\Task;
use App\Models\User;
use App\Models\TaskProgress;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class TaskModelTest extends TestCase
{
    // Konfigurasi Model

    public function test_task_uses_id_task_as_primary_key()
    {
        // Arrange
        $task = new Task();

        // Act
        $primaryKey = $task->getKeyName();

        // Assert
        $this->assertEquals('id_task', $primaryKey);
    }

    public function test_task_uses_task_as_table_name()
    {
        // Arrange
        $task = new Task();

        // Act
        $table = $task->getTable();

        // Assert
        $this->assertEquals('task', $table);
    }

    public function test_task_fillable_contains_title_and_status()
    {
        // Arrange
        $task = new Task();

        // Act
        $fillable = $task->getFillable();

        // Assert — dua field wajib ada untuk pembuatan task
        $this->assertContains('title', $fillable);
        $this->assertContains('status', $fillable);
    }

    // Relasi Eloquent — Happy Cases

    public function test_task_has_assigned_to_belongs_to_relationship()
    {
        // Arrange
        $task = new Task();

        // Act
        $relation = $task->assignedTo();

        // Assert — task ditugaskan ke satu user (BelongsTo)
        $this->assertInstanceOf(BelongsTo::class, $relation);
    }

    public function test_task_assigned_to_relationship_points_to_user_model()
    {
        // Arrange
        $task = new Task();

        // Act
        $relation = $task->assignedTo();

        // Assert
        $this->assertInstanceOf(User::class, $relation->getRelated());
    }

    public function test_task_has_assigned_by_belongs_to_relationship()
    {
        // Arrange
        $task = new Task();

        // Act
        $relation = $task->assignedBy();

        // Assert — task dibuat oleh satu user (BelongsTo)
        $this->assertInstanceOf(BelongsTo::class, $relation);
    }

    public function test_task_assigned_by_relationship_points_to_user_model()
    {
        // Arrange
        $task = new Task();

        // Act
        $relation = $task->assignedBy();

        // Assert
        $this->assertInstanceOf(User::class, $relation->getRelated());
    }

    public function test_task_has_progresses_has_many_relationship()
    {
        // Arrange
        $task = new Task();

        // Act
        $relation = $task->progresses();

        // Assert — satu task bisa punya banyak progress update (HasMany)
        $this->assertInstanceOf(HasMany::class, $relation);
    }

    public function test_task_progresses_relationship_points_to_task_progress_model()
    {
        // Arrange
        $task = new Task();

        // Act
        $relation = $task->progresses();

        // Assert
        $this->assertInstanceOf(TaskProgress::class, $relation->getRelated());
    }

    // Relasi Alias

    public function test_task_has_assignee_alias_belongs_to_relationship()
    {
        // Arrange
        $task = new Task();

        // Act — 'assignee' adalah alias dari 'assignedTo'
        $relation = $task->assignee();

        // Assert
        $this->assertInstanceOf(BelongsTo::class, $relation);
    }

    public function test_task_has_assigner_alias_belongs_to_relationship()
    {
        // Arrange
        $task = new Task();

        // Act — 'assigner' adalah alias dari 'assignedBy'
        $relation = $task->assigner();

        // Assert
        $this->assertInstanceOf(BelongsTo::class, $relation);
    }

    // Edge Cases

    public function test_new_task_instance_has_null_title_and_status_by_default()
    {
        // Arrange & Act
        $task = new Task();

        // Assert — task baru tanpa data tidak memiliki nilai atribut
        $this->assertNull($task->title);
        $this->assertNull($task->status);
    }
}