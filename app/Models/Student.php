<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'student_id',
        'title',
        'first_name',
        'last_name',
        'phone',
        'section',
        'registration_status',
        'company_name',
        'job_position',
        'job_description',
        'company_address',
        'company_phone',
        'coordinator_name',
        'coordinator_position',
        'coordinator_phone',
        'authorized_person_name',
        'authorized_person_position',
        'google_map_coords',
        'photo_path',
        'major_subjects_passed',
        'pre_internship_grade',
        'criteria_evidence_file',
        'absent_days',
        'late_days',
        'leave_days',
        'total_hours',
        'hours_evidence_file',
    ];

    protected $casts = [
        'major_subjects_passed' => 'integer',
        'absent_days' => 'integer',
        'late_days' => 'integer',
        'leave_days' => 'integer',
        'total_hours' => 'integer',
    ];

    /**
     * Get the user that owns the student profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
