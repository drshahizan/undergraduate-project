<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\TuitionRecord;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TuitionStatus extends Model
{
    use HasFactory;

    public function tuitionRecords()
    {
        return $this->hasMany(TuitionRecord::class);
    }
}
