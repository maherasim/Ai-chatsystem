<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'groups';

    protected $fillable = [
        'name',
        'team_id',
        'admin_id',
        'member_ids',
        'description',
        'avatar',
        'created_by',
    ];

    protected $casts = [
        'member_ids' => 'array',
    ];

    /**
     * Relationship: Admin user
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id', '_id');
    }

    /**
     * Relationship: Team
     */
    public function team()
    {
        return $this->belongsTo(Teams::class, 'team_id', '_id');
    }

    /**
     * Relationship: Creator user
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', '_id');
    }

    /**
     * Get all members (users)
     */
    public function members()
    {
        if (empty($this->member_ids)) {
            return collect([]);
        }

        return User::whereIn('_id', $this->member_ids)->get();
    }

    /**
     * Check if user is a member
     */
    public function isMember($userId)
    {
        $userId = (string)$userId;
        $memberIds = array_map('strval', $this->member_ids ?? []);
        return in_array($userId, $memberIds) || $this->admin_id === $userId;
    }

    /**
     * Check if user is admin
     */
    public function isAdmin($userId)
    {
        return (string)$this->admin_id === (string)$userId;
    }

    /**
     * Add member to group
     */
    public function addMember($userId)
    {
        $userId = (string)$userId;
        $memberIds = array_map('strval', $this->member_ids ?? []);
        
        if (!in_array($userId, $memberIds) && $this->admin_id !== $userId) {
            $memberIds[] = $userId;
            $this->member_ids = array_values(array_unique($memberIds));
            $this->save();
        }
    }

    /**
     * Remove member from group
     */
    public function removeMember($userId)
    {
        $userId = (string)$userId;
        $memberIds = array_map('strval', $this->member_ids ?? []);
        
        $memberIds = array_filter($memberIds, function($id) use ($userId) {
            return $id !== $userId;
        });
        
        $this->member_ids = array_values($memberIds);
        $this->save();
    }
}

