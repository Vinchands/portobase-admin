<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Project;

class Image extends Model
{
    use HasUuid;
    
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
