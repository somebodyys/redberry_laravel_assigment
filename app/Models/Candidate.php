<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Candidate extends Model
{
    use HasFactory, LogsActivity;

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
     * Only the `updated` event will get logged automatically
     *
     * @var array
     */
    protected static $recordEvents = [ 'updated' ];

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

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['status_id'])
            ->useLogName('Timeline')
            ->setDescriptionForEvent(
                fn (string $eventName) => "Status has been $eventName"
            );
    }
}
