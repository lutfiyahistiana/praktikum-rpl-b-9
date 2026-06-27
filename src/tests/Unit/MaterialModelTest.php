<?php

namespace Tests\Unit;

use App\Models\Material;
use App\Models\Division;
use App\Models\User;
use App\Models\MaterialFile;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class MaterialModelTest extends TestCase
{
    // Konfigurasi Model

    public function test_material_uses_id_material_as_primary_key()
    {
        // Arrange
        $material = new Material();

        // Act
        $primaryKey = $material->getKeyName();

        // Assert
        $this->assertEquals('id_material', $primaryKey);
    }

    public function test_material_uses_materials_as_table_name()
    {
        // Arrange
        $material = new Material();

        // Act
        $table = $material->getTable();

        // Assert
        $this->assertEquals('materials', $table);
    }

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

    public function test_material_fillable_contains_uploaded_by()
    {
        // Arrange
        $material = new Material();

        // Act
        $fillable = $material->getFillable();

        // Assert
        $this->assertContains('uploaded_by', $fillable);
    }

    // Relasi Eloquent

    public function test_material_has_division_belongs_to_relationship()
    {
        // Arrange
        $material = new Material();

        // Act
        $relation = $material->division();

        // Assert — material milik satu division (BelongsTo)
        $this->assertInstanceOf(BelongsTo::class, $relation);
    }

    public function test_material_division_relationship_points_to_division_model()
    {
        // Arrange
        $material = new Material();

        // Act
        $relation = $material->division();

        // Assert
        $this->assertInstanceOf(Division::class, $relation->getRelated());
    }

    public function test_material_has_uploader_belongs_to_relationship()
    {
        // Arrange
        $material = new Material();

        // Act
        $relation = $material->uploader();

        // Assert — material diunggah oleh satu user (BelongsTo)
        $this->assertInstanceOf(BelongsTo::class, $relation);
    }

    public function test_material_uploader_relationship_points_to_user_model()
    {
        // Arrange
        $material = new Material();

        // Act
        $relation = $material->uploader();

        // Assert
        $this->assertInstanceOf(User::class, $relation->getRelated());
    }

    public function test_material_has_files_has_many_relationship()
    {
        // Arrange
        $material = new Material();

        // Act
        $relation = $material->files();

        // Assert — satu material bisa punya banyak file (HasMany)
        $this->assertInstanceOf(HasMany::class, $relation);
    }

    public function test_material_files_relationship_points_to_material_file_model()
    {
        // Arrange
        $material = new Material();

        // Act
        $relation = $material->files();

        // Assert
        $this->assertInstanceOf(MaterialFile::class, $relation->getRelated());
    }

    // Edge Cases

    public function test_new_material_instance_has_null_title_by_default()
    {
        // Arrange & Act
        $material = new Material();

        // Assert — material baru tanpa data tidak punya judul
        $this->assertNull($material->title);
    }
}