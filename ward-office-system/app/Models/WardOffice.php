<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WardOffice extends Model
{
    protected $fillable = [
        'ward_number',
        'municipality',
        'district',
        'contact_phone',
        'address',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function documentRequests()
    {
        return $this->hasMany(DocumentRequest::class);
    }
}
