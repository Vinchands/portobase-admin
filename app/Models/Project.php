<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use App\Models\User as Author;
use App\Models\Image as Preview;
use App\Models\Category;
use App\Models\Tag;

class Project extends Model
{
    use HasUuids;
    
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'status',
        'repo_url',
        'project_url',
    ];
    
    public function images(): HasMany
    {
        return $this->hasMany(Preview::class);
    }
    
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }
    
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
