<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'message', 'attachment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
