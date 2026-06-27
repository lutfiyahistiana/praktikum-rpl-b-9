<?php

namespace Tests\Unit;

use App\Models\Team;
use App\Models\User;
use App\Models\TeamMember;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class TeamModelTest extends TestCase
{
    // Konfigurasi Model

    public function test_team_uses_id_team_as_primary_key()
    {
        // Arrange
        $team = new Team();

        // Act
        $primaryKey = $team->getKeyName();

        // Assert
        $this->assertEquals('id_team', $primaryKey);
    }

    public function test_team_uses_teams_as_table_name()
    {
        // Arrange
        $team = new Team();

        // Act
        $table = $team->getTable();

        // Assert
        $this->assertEquals('teams', $table);
    }

    public function test_team_fillable_contains_team_name()
    {
        // Arrange
        $team = new Team();

        // Act
        $fillable = $team->getFillable();

        // Assert
        $this->assertContains('team_name', $fillable);
    }

    public function test_team_fillable_contains_ketua_team_id()
    {
        // Arrange
        $team = new Team();

        // Act
        $fillable = $team->getFillable();

        // Assert
        $this->assertContains('ketua_team_id', $fillable);
    }

    // Relasi Eloquent — Happy Cases

    public function test_team_has_ketua_belongs_to_relationship()
    {
        // Arrange
        $team = new Team();

        // Act
        $relation = $team->ketua();

        // Assert — team dipimpin oleh satu user (BelongsTo)
        $this->assertInstanceOf(BelongsTo::class, $relation);
    }

    public function test_team_ketua_relationship_points_to_user_model()
    {
        // Arrange
        $team = new Team();

        // Act
        $relation = $team->ketua();

        // Assert
        $this->assertInstanceOf(User::class, $relation->getRelated());
    }

    public function test_team_has_members_has_many_relationship()
    {
        // Arrange
        $team = new Team();

        // Act
        $relation = $team->members();

        // Assert: satu team bisa punya banyak anggota (HasMany)
        $this->assertInstanceOf(HasMany::class, $relation);
    }

    public function test_team_members_relationship_points_to_team_member_model()
    {
        // Arrange
        $team = new Team();

        // Act
        $relation = $team->members();

        // Assert
        $this->assertInstanceOf(TeamMember::class, $relation->getRelated());
    }

    // Edge Cases

    public function test_new_team_instance_has_null_team_name_by_default()
    {
        // Arrange & Act
        $team = new Team();

        // Assert — tim baru tanpa data tidak punya nama
        $this->assertNull($team->team_name);
    }

    public function test_two_team_instances_are_independent_objects()
    {
        // Arrange
        $teamA = new Team();
        $teamB = new Team();

        // Act
        $teamA->team_name = 'Tim Alpha';

        // Assert: perubahan pada satu instance tidak memengaruhi instance lain
        $this->assertNull($teamB->team_name);
        $this->assertNotSame($teamA, $teamB);
    }
}