<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Events extends Model
{
    use HasFactory;
    
    protected $table = 'events'; 

    protected $fillable = [
    'event_name',
    'event_date',
    'event_address',
    ];

    public function participants() 
    {

    return $this->hasMany(Participant::class);

    }
    
    public function registrations() {

    return $this->hasMany(Registration::class);

    }  
}
