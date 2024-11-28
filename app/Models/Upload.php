<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'category_id', 'file_path', 'author'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
