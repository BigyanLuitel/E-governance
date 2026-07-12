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
        'file_validation',
        'officer_remarks',
        'processed_at',
        'reference_number',
        'issued_letter_path',
        'letter_issued_at',
    ];

    protected function casts(): array
    {
        return [
            'form_data' => 'array',
            'processed_at' => 'datetime',
            'file_validation' => 'array',
            'letter_issued_at' => 'datetime',
        ];
    }
    public function generateReferenceNumber(): string
    {
        $year = now()->format('Y');
        $sequence = str_pad($this->id, 6, '0', STR_PAD_LEFT);

        return "WO-{$year}-{$sequence}";
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
    public function updateStatus(string $newStatus, User $changedBy, ?string $remarks = null): void
    {
        $oldStatus = $this->status;

        $this->update([

            'status' => $newStatus,
            'officer_remarks' => $remarks ?? $this->officer_remarks,
            'processed_at' => in_array($newStatus, ['approved', 'rejected']) ? now() : $this->processed_at,
        ]);

        $this->statusLogs()->create([
            'old_status' => $oldStatus,
            'new_status' => $newStatus,
            'changed_by' => $changedBy->id,
            'remarks' => $remarks,
        ]);
    }
}

