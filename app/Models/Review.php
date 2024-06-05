<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    protected $primaryKey = 'review_id';

    protected $fillable = [
        'review_id',
        'switch_id',
        'user_id',
        'title',
        'review_comment',
        'rate_star',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function switch()
    {
        return $this->belongsTo(KeySwitch::class, 'switch_id', 'switch_id');
    }
}
