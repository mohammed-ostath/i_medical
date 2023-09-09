<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'image'];

    public function doctor()
    {
        return $this->hasMany(Doctor::class);
    }
}
