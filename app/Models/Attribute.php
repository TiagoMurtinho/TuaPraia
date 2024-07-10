<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Attribute extends Model
{
    use HasFactory;

    protected $table = 'attributes';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name' => 'string',
    ];

    public function local(): BelongsToMany
    {
        return $this->belongsToMany(Local::class, 'locals_has_attributes')->using(LocalAttribute::class);
    }
}
