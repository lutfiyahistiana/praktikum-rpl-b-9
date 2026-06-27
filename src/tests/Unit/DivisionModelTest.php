<?php

namespace Tests\Unit;

use App\Models\Division;
use App\Models\User;
use App\Models\Material;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class DivisionModelTest extends TestCase
{
    // Konfigurasi Model

    public function test_division_uses_id_division_as_primary_key()
    {
        $division = new Division(); // Arrange

        // Act
        $primaryKey = $division->getKeyName();

        // Assert
        $this->assertEquals('id_division', $primaryKey);
    }

    public function test_division_uses_divisions_as_table_name()
    {
        // Arrange
        $division = new Division();

        // Act
        $table = $division->getTable();

        // Assert
        $this->assertEquals('divisions', $table);
    }

    public function test_division_fillable_contains_division_name()
    {
        // Arrange
        $division = new Division();

        // Act
        $fillable = $division->getFillable();

        // Assert
        $this->assertContains('division_name', $fillable);
    }

    public function test_division_fillable_contains_ketua_division_id()
    {
        // Arrange
        $division = new Division();

        // Act
        $fillable = $division->getFillable();

        // Assert
        $this->assertContains('ketua_division_id', $fillable);
    }

    // Relasi Eloquent

    public function test_division_has_ketua_belongs_to_relationship()
    {
        // Arrange
        $division = new Division();

        // Act
        $relation = $division->ketua();

        // Assert — relasi ke User (ketua division) harus BelongsTo
        $this->assertInstanceOf(BelongsTo::class, $relation);
    }

    public function test_division_ketua_relationship_points_to_user_model()
    {
        // Arrange
        $division = new Division();

        // Act
        $relation = $division->ketua();

        // Assert
        $this->assertInstanceOf(User::class, $relation->getRelated());
    }

    public function test_division_has_materials_has_many_relationship()
    {
        // Arrange
        $division = new Division();

        // Act
        $relation = $division->materials();

        // Assert — satu division bisa punya banyak material
        $this->assertInstanceOf(HasMany::class, $relation);
    }

    public function test_division_materials_relationship_points_to_material_model()
    {
        // Arrange
        $division = new Division();

        // Act
        $relation = $division->materials();

        // Assert
        $this->assertInstanceOf(Material::class, $relation->getRelated());
    }

    // Edge Cases

    public function test_new_division_instance_has_null_attributes_by_default()
    {
        // Arrange & Act
        $division = new Division();

        // Assert — model baru tanpa data tidak boleh punya nilai atribut
        $this->assertNull($division->division_name);
        $this->assertNull($division->ketua_division_id);
    }

    public function test_division_can_be_instantiated_without_arguments()
    {
        // Arrange & Act
        $division = new Division();

        // Assert — konstruksi dasar harus sukses tanpa exception
        $this->assertInstanceOf(Division::class, $division);
    }
}