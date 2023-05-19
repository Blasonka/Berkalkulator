<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wage extends Model
{
    use HasFactory;

    // Tabel properties
    protected $table = 'wages';
    protected $primaryKey = 'id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'value'
    ];

    // Connections
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
