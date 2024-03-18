<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name', 'location', 'start_time', 'end_time'];
    public function users()
{
    return $this->belongsToMany(User::class, 'attendances', 'event_id', 'user_id');
}
protected $dates = ['start_time', 'end_time'];

// Hoặc

protected $casts = [
    'start_time' => 'datetime',
    'end_time' => 'datetime',
];

}
