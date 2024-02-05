<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'role_id',
        'avatar',
        'title',
        'telphone',
        'noti_email',
        'mode_dark',
        'is_online',
        'time_online',
    ];
}
