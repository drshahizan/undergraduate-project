<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'semester',
        'academicYear',
        'name',
        'parentName',
        'parentPhoneNum',
        'address',
        'dob',
        'gender',
        'nis',
        'nisn',
        'peminatan',
        'classroom_id',
    ];

    /**
     * Get the user associated with the admin.
     */
    public function user(): BelongsTo
{
    return $this->belongsTo(User::class, 'user_id');
}

public function classroom() : BelongsTo
{
    return $this->belongsTo(Classroom::class);
}

}
