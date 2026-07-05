<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{

    protected $fillable = [
        'name',
        'slug',
        'description',
        'required_fields',
        'is_active',
    ];
    protected function casts(): array
    {
        return [
            'required_fields' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function documentRequests()
    {
        return $this->hasMany(DocumentRequest::class);
    }
}
