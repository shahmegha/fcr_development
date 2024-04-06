<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\State;
use App\Models\Employee;
class Country extends Model
{
    use HasFactory;
    
    /**
     * Get the states for the country.
     */
    public function states(): HasMany
    {
        return $this->hasMany(State::class);
    }
    
    /**
     * Get the employees for the country.
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
