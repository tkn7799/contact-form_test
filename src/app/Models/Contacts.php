<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Contacts extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function getGenderNameAttribute()
    {
        $map = [
            1 => '男性',
            2 => '女性',
            3 => 'その他',
        ];

        return $map[$this->gender] ?? '未設定';
    }

    public function getCategoryNameAttribute()
    {
        return $this->category ? $this->category->content : '未設定';
    }
}
