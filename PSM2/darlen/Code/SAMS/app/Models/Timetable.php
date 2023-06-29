<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;

    public function hour1Subject()
{
    return $this->belongsTo(Subject::class, 'hour_1_subject_id');
}

public function hour2Subject()
{
    return $this->belongsTo(Subject::class, 'hour_2_subject_id');
}
public function hour3Subject()
{
    return $this->belongsTo(Subject::class, 'hour_3_subject_id');
}
public function hour4Subject()
{
    return $this->belongsTo(Subject::class, 'hour_4_subject_id');
}
public function hour5Subject()
{
    return $this->belongsTo(Subject::class, 'hour_5_subject_id');
}
public function hour6Subject()
{
    return $this->belongsTo(Subject::class, 'hour_6_subject_id');
}
public function hour7Subject()
{
    return $this->belongsTo(Subject::class, 'hour_7_subject_id');
}
public function hour8Subject()
{
    return $this->belongsTo(Subject::class, 'hour_8_subject_id');
}
// ... repeat for each hour

}
