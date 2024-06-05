<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SwitchType extends Model
{
    use HasFactory;

    protected $table = 'switch_types';

    protected $primaryKey = 'switch_type_id';

    protected $fillable = [
        'switch_type_id',
        'switch_type_name',
    ];
}

