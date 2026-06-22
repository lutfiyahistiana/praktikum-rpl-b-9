<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Task;
use App\Models\Material;
use App\Models\Division;
use App\Models\Team;
use Tests\TestCase;

class ModelConfigurationTest extends TestCase
{
    // User Model

    public function test_user_uses_id_user_as_primary_key()
    {
        // Arrange
        $user = new User();

        // Act
        $primaryKey = $user->getKeyName();

        // Assert
        $this->assertEquals('id_user', $primaryKey);
    }

    public function test_user_uses_users_as_table_name()
    {
        // Arrange
        $user = new User();

        // Act
        $table = $user->getTable();

        // Assert
        $this->assertEquals('users', $table);
    }

    public function test_user_fillable_contains_nim()
    {
        // Arrange
        $user = new User();

        // Act
        $fillable = $user->getFillable();

        // Assert — nim adalah field identitas wajib user di proyek ini
        $this->assertContains('nim', $fillable);
    }

    public function test_user_hidden_contains_password()
    {
        // Arrange
        $user = new User();

        // Act
        $hidden = $user->getHidden();

        // Assert — password harus tersembunyi dari serialisasi JSON
        $this->assertContains('password', $hidden);
    }

    // Task Model

    public function test_task_uses_id_task_as_primary_key()
    {
        // Arrange
        $task = new Task();

        // Act
        $primaryKey = $task->getKeyName();

        // Assert
        $this->assertEquals('id_task', $primaryKey);
    }

    public function test_task_fillable_contains_title()
    {
        // Arrange
        $task = new Task();

        // Act
        $fillable = $task->getFillable();

        // Assert
        $this->assertContains('title', $fillable);
    }

    public function test_task_fillable_contains_assigned_to()
    {
        // Arrange
        $task = new Task();

        // Act
        $fillable = $task->getFillable();

        // Assert
        $this->assertContains('assigned_to', $fillable);
    }

    public function test_task_fillable_contains_status()
    {
        // Arrange
        $task = new Task();

        // Act
        $fillable = $task->getFillable();

        // Assert
        $this->assertContains('status', $fillable);
    }

    public function test_task_fillable_contains_deadline()
    {
        // Arrange
        $task = new Task();

        // Act
        $fillable = $task->getFillable();

        // Assert
        $this->assertContains('deadline', $fillable);
    }

    // Material Model

    public function test_material_fillable_contains_title()
    {
        // Arrange
        $material = new Material();

        // Act
        $fillable = $material->getFillable();

        // Assert
        $this->assertContains('title', $fillable);
    }

    public function test_material_fillable_contains_division_id()
    {
        // Arrange
        $material = new Material();

        // Act
        $fillable = $material->getFillable();

        // Assert
        $this->assertContains('division_id', $fillable);
    }

    // Division & Team Model Primary Key

    public function test_division_uses_id_division_as_primary_key()
    {
        // Arrange
        $division = new Division();

        // Act
        $primaryKey = $division->getKeyName();

        // Assert
        $this->assertEquals('id_division', $primaryKey);
    }

    public function test_team_uses_id_team_as_primary_key()
    {
        // Arrange
        $team = new Team();

        // Act
        $primaryKey = $team->getKeyName();

        // Assert
        $this->assertEquals('id_team', $primaryKey);
    }
}