<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestStatusLog extends Model
{
    protected $fillable = [
        'document_request_id',
        'old_status',
        'new_status',
        'changed_by',
        'remarks',
    ];

    public function documentRequest()
    {
        return $this->belongsTo(DocumentRequest::class);
    }

    public function changedBy()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
