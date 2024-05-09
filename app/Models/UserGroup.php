<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\QueryScope;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserGroup extends Model
{
    use HasFactory, QueryScope, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'is_disabled'
    ];
    protected $dates = ['deleted_at'];
    public function users() {
        return $this->hasMany(User::class, 'user_group_id', 'id');
    }
}
