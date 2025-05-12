<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_id', 'to_role', 'to_id', 'message',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'from_id');
    }
}
