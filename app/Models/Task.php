<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory,softDeletes;

    protected $fillable = ['user_id','name','date','time','description'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
