<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Country;
use App\Models\State;

class Employee extends Model
{
    use HasFactory;
    
    /**
     * Get the country that owns the employee.
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    
    /**
     * Get the state that owns the employee.
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
