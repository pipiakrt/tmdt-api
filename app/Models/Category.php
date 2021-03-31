<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory, Filterable, Cachable;
    protected $fillable = [
        'title',
        'slug',
        'status',
        'type',
        'icon',
        'employee_id',
        'parent_id'
    ];
    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_products');
    }
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // recursive, loads all descendants
    public function recursiveChildren()
    {
        return $this->children()->with('recursiveChildren');
    }
    public function getParentsAttribute()
    {
        $parents = collect([]);

        $parent = $this->parent_id;

        while(!is_null($parent)) {
            $parents->push($parent);
            $parent = $parent->parent;
        }

        return $parents;
    }

    public function getUrlAttribute($value) {
        return Storage::url($value);
    }
}
