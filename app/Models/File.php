<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    public $fillable  = [
        "user_id",
        "post_id",
        "link",
        "type",
    ];
    public $timestamps = false;

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->user_id = auth()->user()->id;
        });
    }
}
