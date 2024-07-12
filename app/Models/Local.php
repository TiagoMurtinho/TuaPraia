<?php

namespace App\Models;

//use http\Exception\InvalidArgumentException;
use InvalidArgumentException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Local extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'locals';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'description',
        'coordinates',
        'type',
        'districts_id',
        'regions_id',
    ];

    public const LOCALTYPES = [
        'beach',
        'fluvial',
        'cascade'
    ];

    public function attribute(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class, 'locals_has_attributes')->using(LocalAttribute::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'districts_id', 'id');
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'regions_id', 'id');
    }

    //Puts an exception if we use a different type.

    public function setTypeAttribute($value)
    {
        if (!in_array($value, self::LOCALTYPES)) {
            throw new InvalidArgumentException("Invalid type: $value");
        }

        $this->attributes['type'] = $value;
    }

    public function getMediaUrl(): ?string
    {
        $url = $this->getFirstMediaUrl('locals');
        return $url ? str_replace('http://localhost', 'http://localhost:8000', $url) : null;
    }
}
