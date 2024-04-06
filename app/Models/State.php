<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Country;
use App\Models\Employee;

class State extends Model
{
    use HasFactory;
    
    /**
     * Get the country that owns the state.
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
    
    /**
     * Get the employees for the state.
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
