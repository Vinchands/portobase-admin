<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use App\Models\User as Author;
use App\Models\Project;

class Tag extends Model
{
    use HasUuids;
    
    protected $fillable = [
      'user_id',
      'name',
    ];
    
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }
    
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class);
    }
}
