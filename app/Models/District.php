<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class District extends Model
{
    use HasFactory;

    protected $table = 'districts';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name' => 'string',
    ];

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'regions_id');
    }
}
