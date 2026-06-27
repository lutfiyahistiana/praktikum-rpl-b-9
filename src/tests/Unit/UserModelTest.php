<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Task;
use App\Models\Material;
use App\Models\TaskProgress;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tests\TestCase;


class UserModelTest extends TestCase
{
    // Konfigurasi Model

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

    public function test_user_fillable_contains_name_and_email()
    {
        // Arrange
        $user = new User();

        // Act
        $fillable = $user->getFillable();

        // Assert — field dasar identitas user harus mass-assignable
        $this->assertContains('name', $fillable);
        $this->assertContains('email', $fillable);
    }

    public function test_user_hidden_contains_password_for_security()
    {
        // Arrange
        $user = new User();

        // Act
        $hidden = $user->getHidden();

        // Assert — password tidak boleh terekspos saat serialisasi (keamanan)
        $this->assertContains('password', $hidden);
    }

    // Relasi Eloquent — Happy Cases

    public function test_user_has_roles_belongs_to_many_relationship()
    {
        // Arrange
        $user = new User();

        // Act
        $relation = $user->roles();

        // Assert: user bisa punya banyak role (BelongsToMany via pivot user_roles)
        $this->assertInstanceOf(BelongsToMany::class, $relation);
    }

    public function test_user_has_assigned_tasks_has_many_relationship()
    {
        // Arrange
        $user = new User();

        // Act
        $relation = $user->assignedTasks();

        // Assert: user bisa menerima banyak task (HasMany)
        $this->assertInstanceOf(HasMany::class, $relation);
    }

    public function test_user_assigned_tasks_relationship_points_to_task_model()
    {
        // Arrange
        $user = new User();

        // Act
        $relation = $user->assignedTasks();

        // Assert
        $this->assertInstanceOf(Task::class, $relation->getRelated());
    }

    public function test_user_has_created_tasks_has_many_relationship()
    {
        // Arrange
        $user = new User();

        // Act
        $relation = $user->createdTasks();

        // Assert: user bisa membuat/menugaskan banyak task (HasMany)
        $this->assertInstanceOf(HasMany::class, $relation);
    }

    public function test_user_created_tasks_relationship_points_to_task_model()
    {
        // Arrange
        $user = new User();

        // Act
        $relation = $user->createdTasks();

        // Assert
        $this->assertInstanceOf(Task::class, $relation->getRelated());
    }

    public function test_user_has_uploaded_materials_has_many_relationship()
    {
        // Arrange
        $user = new User();

        // Act
        $relation = $user->uploadedMaterials();

        // Assert: user bisa mengunggah banyak material (HasMany)
        $this->assertInstanceOf(HasMany::class, $relation);
    }

    public function test_user_uploaded_materials_relationship_points_to_material_model()
    {
        // Arrange
        $user = new User();

        // Act
        $relation = $user->uploadedMaterials();

        // Assert
        $this->assertInstanceOf(Material::class, $relation->getRelated());
    }

    public function test_user_has_task_progresses_has_many_relationship()
    {
        // Arrange
        $user = new User();

        // Act
        $relation = $user->taskProgresses();

        // Assert: user bisa punya banyak catatan task progress (HasMany)
        $this->assertInstanceOf(HasMany::class, $relation);
    }

    public function test_user_has_creator_belongs_to_relationship()
    {
        // Arrange
        $user = new User();

        // Act
        $relation = $user->creator();

        // Assert: user bisa dibuat oleh user lain (self-referential BelongsTo)
        $this->assertInstanceOf(BelongsTo::class, $relation);
    }

    // Edge Cases

    public function test_new_user_instance_has_null_email_by_default()
    {
        // Arrange & Act
        $user = new User();

        // Assert — user baru tanpa data tidak memiliki email
        $this->assertNull($user->email);
    }

    public function test_new_user_password_is_not_exposed_via_attribute()
    {
        // Arrange
        $user = new User();

        // Act
        $array = $user->toArray();

        // Assert — password tidak boleh muncul dalam representasi array (hidden)
        $this->assertArrayNotHasKey('password', $array);
    }
}