<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TuitionStatus;


class TuitionRecord extends Model
{
    use HasFactory;
protected $fillable = ['paymentDate', 'paymentAmount', 'paymentProof', 'tuitionStatus_id'];

    public function tuitionStatus()
    {
        return $this->belongsTo(TuitionStatus::class);
    }
}
