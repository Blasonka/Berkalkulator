<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    // Tabel properties
    protected $table = 'shifts';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'start_time',
        'end_time',
        'hourly_wage',
        'worked_hours'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
