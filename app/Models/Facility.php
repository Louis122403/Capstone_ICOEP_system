<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Facility extends Model
{
    protected $fillable = ['name', 'location', 'description', 'capacity', 'image', 'status'];

    public function reservations(): HasMany
    {
        return $this->hasMany(FacilityReservation::class);
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    /**
     * Order facilities naturally: specialized venues first alphabetically,
     * followed by numbered rooms in proper numerical order (e.g. Room 2 before Room 13).
     */
    public function scopeOrderNaturally($query)
    {
        return $query->orderByRaw("
            CASE
                WHEN name REGEXP '^Room [0-9]+' THEN 1
                ELSE 0
            END ASC,
            CASE
                WHEN name NOT REGEXP '^Room [0-9]+' THEN name
                ELSE ''
            END ASC,
            CASE
                WHEN name REGEXP '^Room [0-9]+' THEN CAST(SUBSTRING(name, 6) AS UNSIGNED)
                ELSE 0
            END ASC
        ");
    }

    /** The approved booking occupying this facility right now, or null if it's open. */
    public function currentBooking(): ?FacilityReservation
    {
        return $this->reservations()->ongoing()->with('user')->first();
    }

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) return null;
        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://') || str_starts_with($this->image, '/')) {
            return $this->image;
        }
        return asset('storage/' . $this->image);
    }
}
