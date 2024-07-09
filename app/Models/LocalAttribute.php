<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalAttribute extends Model
{
    use HasFactory;

    protected $table = 'locals_has_attributes';

    protected $primaryKey = 'id';
}
