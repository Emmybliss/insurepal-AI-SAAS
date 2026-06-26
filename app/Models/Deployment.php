<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Deployment extends Model
{
    /** @use HasFactory<\Database\Factories\DeploymentFactory> */
    use HasFactory;

    protected $fillable = [
        'commit_hash',
        'deployed_at',
        'status',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'deployed_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
