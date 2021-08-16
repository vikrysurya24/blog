<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'thumbnail', 'description', 'parent_id'];

    public function scopeOnlyParent($query)
    {
        return $query->whereNull('parent_id');
    }

    public function child()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function inheritance()
    {
        return $this->child()->with('inheritance');
    }

    public function parent()
    {
        return $this->belongsTo(self::class);
    }

    public function scopeSearch($query, $title)
    {
        return $query->where('title', 'LIKE', "%{$title}%");
    }

    public function root()
    {
        return $this->parent ? $this->parent->root() : $this;
    }
}
