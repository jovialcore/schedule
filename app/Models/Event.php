<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;


    protected $fillable = [
        'name',
        'start_at',
        'end_at',
        'max_num_of_participants',
        'owner_id',
    ];

    protected function casts() : array 
    {
        return [
            'start_at' => 'date',
            'end_at' => 'date'
        ];
    }


    public function participants()
    {
        return $this->belongsToMany(User::class, 'events_participants' ,'event_id');
    }

    public function owner()
    {
        return $this->belongs(User::class, 'owner_id');
    }
}
