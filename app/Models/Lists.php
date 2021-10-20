<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

/**
 * @property int    $id
 * @property string $list_name
 * @property int    $created_by
 */
class Lists extends Model
{
    use HasFactory;

    protected $fillable = [
        'list_name',
        'created_by'
    ];

    /**
     * Get the user that owns the Lists
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get all of the items for the Lists
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(Items::class, 'list_id', 'id');
    }

    /**
     * Scope a query to find an item based on authenticated user
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int                                   $id
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFindItemByAuthenticatedUser(Builder $query, int $id): Builder
    {
        return $this->scopeByAuthenticatedUser($query)
            ->where('id', $id);
    }

    /**
     * Scope a query to only include the currently authenticated user
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByAuthenticatedUser(Builder $query): Builder
    {
        return $query->where('created_by', Auth::id());
    }
}
