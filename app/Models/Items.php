<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    
    public function lists(): BelongsTo
    {
        return $this->belongsTo(Lists::class, 'list_id');
    }

}

