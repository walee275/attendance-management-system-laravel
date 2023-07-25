<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'reason',
        'status',
    ];

    protected $dates = [
        'date',
    ];

    public function student(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
