<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    // Laravel ko batayen ke in columns mein data save kiya ja sakta hai
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'status'
    ];

    // Relation: Ek Sub Category kisi ek Main Category ka hissa hoti hai
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}