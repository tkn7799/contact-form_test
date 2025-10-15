<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contacts;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
    ];

    public function contacts()
    {
        return $this->hasMany(Contacts::class, 'category_id', 'id');
    }
}
