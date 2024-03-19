<?php

namespace App\Models;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Specialist extends Model
{
    use HasUuids, SoftDeletes, HasFactory;
    protected $table = 'specialists';
    protected $fillable = ['specialist_name'];


    public function doctors(): HasMany
    {
        return $this->hasMany(Doctor::class, 'specialist_id', 'id');
    }
}
