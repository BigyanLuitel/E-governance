<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentRequest extends Model
{
    protected $fillable = [
        'citizen_id',
        'document_type_id',
        'ward_office_id',
        'officer_id',
        'status',
        'purpose',
        'form_data',
        'uploaded_file_path',
        'officer_remarks',
        'processed_at',
    ];

    protected function casts(): array
    {
        return [
            'form_data' => 'array',
            'processed_at' => 'datetime',
        ];
    }

    public function citizen()
    {
        return $this->belongsTo(User::class, 'citizen_id');
    }

    public function officer()
    {
        return $this->belongsTo(User::class, 'officer_id');
    }

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function wardOffice()
    {
        return $this->belongsTo(WardOffice::class);
    }

    public function statusLogs()
    {
        return $this->hasMany(RequestStatusLog::class);
    }
}

