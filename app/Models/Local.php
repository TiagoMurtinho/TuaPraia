<?php

namespace App\Models;

use http\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Local extends Model
{
    use HasFactory;

    protected $table = 'locals';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'description',
        'coordinates',
        'type'
    ];

    public const LOCALTYPES = [
        'beach',
        'fluvial',
        'cascade'
    ];

    public function attribute(): BelongsToMany
    {
        return $this->belongsToMany(Local::class, 'locals_has_attributes')->using(LocalAttribute::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'districts_id');
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'regions_id');
    }

    //Puts an exception if we use a different type.

    public function setTypeAttribute($value)
    {
        if (!in_array($value, self::LOCALTYPES)) {
            throw new InvalidArgumentException("Invalid type: $value");
        }

        $this->attributes['type'] = $value;
    }
}
