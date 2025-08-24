<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\User as Author;
use App\Models\Project;

class Category extends Model
{
    use HasUuids;
    
    protected $fillable = [
      'user_id',
      'name',
    ];
    
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
    
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }
}
