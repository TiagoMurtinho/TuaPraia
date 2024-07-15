<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    use HasFactory;

    protected $table = 'regions';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name' => 'string'
    ];

    public function districts(): HasMany
    {
        return $this->HasMany(District::class, "regions_id");
    }

    public function local(): HasMany
    {
        return $this->HasMany(Local::class, 'regions_id');
    }
}
