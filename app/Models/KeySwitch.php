<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeySwitch extends Model
{
    use HasFactory;
    protected $table = 'switches';
    protected $primaryKey = 'switch_id';
    protected $fillable = [
        'switch_id',
        'switch_name',
        'switch_type',
        'company_id',
        'activation_pressure',
        'bottom_out_force'
    ];

    public function switchType()
    {
        return $this->belongsTo(SwitchType::class, 'switch_type', 'switch_type_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'company_id');
    }
}
