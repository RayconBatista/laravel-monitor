<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Site extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['url', 'user_id', 'status'];

    protected $casts = [
        'status' => 'boolean'
    ];

    protected static function booted()
    {
        static::addGlobalScope('user', function (Builder $builder) {
            if (!app()->runningInConsole()) {
                $builder->where('user_id', auth()->user()->id);
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function endpoints(): HasMany
    {
        return $this->hasMany(Endpoint::class)->with('checks');
    }
}
