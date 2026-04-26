<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Participant extends Model
{   
    use HasFactory;
    public $timestamps = false;

    protected $table = 'participants'; 

    protected $fillable = [
    'participant_name',
    'event_id',
    ];

    public function event()
    {
    return $this->belongsTo(Events::class);
    }

    public function registrations()
    {
    return $this->hasMany(Registration::class);
    }

}
