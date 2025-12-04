<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'action',
        'message',
        'icon',
        'related_id',
        'related_type',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'created_at' => 'datetime',
    ];

    // Scope untuk filter notifikasi order (envelope)
    public function scopeOrderNotifications($query)
    {
        return $query->where('type', 'order')->latest();
    }

    // Scope untuk filter notifikasi sistem (bell)
    public function scopeSystemNotifications($query)
    {
        return $query->where('type', 'system')->latest();
    }

    // Scope untuk notifikasi yang belum dibaca
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    // Tandai sebagai sudah dibaca
    public function markAsRead()
    {
        $this->update(['is_read' => true]);
    }
}
