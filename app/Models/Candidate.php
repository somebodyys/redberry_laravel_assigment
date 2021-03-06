<?php

namespace App\Models;

use App\Http\Resources\TimelineResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class Candidate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'position_id',
        'status_id',
        'min_salary',
        'max_salary',
        'linkedin_url',
        'cv'
    ];

    /**
     * The skills that belong to the candidate.
     */
    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }

    /**
     * Get the status that owns the candidate.
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Get the position that owns the candidate.
     */
    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    /**
     * Get the candidate timeline.
     */
    public function timeline(){

        return TimelineResource::collection(
            Activity::where([
                ['subject_id', $this->id],
                ['subject_type', Candidate::class],
                ['log_name', 'Timeline']
            ])->get()
        );
    }

}
