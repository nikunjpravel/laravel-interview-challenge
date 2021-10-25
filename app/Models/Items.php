<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

/**
 * @property int    $id
 * @property string $desc
 * @property bool   $is_completed
 * @property int    $list_id
 */
class Items extends Model
{
    use HasFactory;

    protected $fillable = [
        'desc',
        'is_completed',
        'list_id'
    ];

    /**
     * Get the lists that owns the Items
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function list(): BelongsTo
    {
        return $this->belongsTo(Lists::class, 'list_id');
    }

    /**
     * Scope a query to find an item based on authenticated user
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int                                   $itemId
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFindItemByAuthenticatedUser(Builder $query, int $itemId): Builder
    {
        return $this->scopeByAuthenticatedUser($query)
            ->where('items.id', $itemId);
    }

    /**
     * Scope a query to only include the currently authenticated user
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByAuthenticatedUser(Builder $query): Builder
    {
        return $query
            ->leftJoin('lists', 'lists.id', '=', 'items.list_id')
            ->select('items.*')
            ->where('lists.created_by', Auth::id());
    }
}
