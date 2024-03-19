<?php

namespace App\Models;

use App\Models\Specialist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    use HasUuids, SoftDeletes, HasFactory;
    protected $table = 'doctors';
    protected $fillable = [
        'doctor_name',
        'doctor_phone',
        'doctor_email',
        'doctor_profile_pict',
        'doctor_address',
        'specialist_id',
        'doctor_specialist_name',
        'sip',
        'id_ihs',
        'nik',
    ];

    public function specialist(): BelongsTo
    {
        return $this->belongsTo(Specialist::class, 'specialist_id', 'id');
    }
}
