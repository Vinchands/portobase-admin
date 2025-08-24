<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Project;

class Image extends Model
{
    use HasUuids;
    
    protected $fillable = [
        'project_id',
        'title',
        'url',
    ];
    
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
