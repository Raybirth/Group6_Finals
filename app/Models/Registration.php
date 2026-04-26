<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = ['event_id', 'participant_id'];
    
    public $timestamps = true;

    protected $table = 'registrations'; 

    public function event()
    {
    return $this->belongsTo(Events::class);
    }

    public function participant()
    {
    return $this->belongsTo(Participant::class);
    }
}
