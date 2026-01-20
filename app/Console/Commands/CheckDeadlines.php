<?php

namespace App\Console\Commands;

use App\Models\Student;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckDeadlines extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'students:check-deadlines';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check student deadlines and send notifications';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking student deadlines...');

        // Example: Check for students who haven't submitted criteria evidence
        $studentsWithoutCriteria = Student::whereNull('criteria_evidence_file')
            ->whereNotNull('company_name')
            ->get();

        foreach ($studentsWithoutCriteria as $student) {
            // Send notification (implement your notification logic here)
            Log::info("Student {$student->student_id} has not submitted criteria evidence");

            // You can integrate with email, SMS, or push notifications here
            // Example: Mail::to($student->user->email)->send(new CriteriaReminderMail($student));
        }

        // Check for students who haven't submitted hours evidence
        $studentsWithoutHours = Student::whereNull('hours_evidence_file')
            ->whereNotNull('company_name')
            ->get();

        foreach ($studentsWithoutHours as $student) {
            Log::info("Student {$student->student_id} has not submitted hours evidence");
        }

        // Check for students with insufficient hours
        $studentsInsufficientHours = Student::where('total_hours', '<', 320)
            ->whereNotNull('company_name')
            ->get();

        foreach ($studentsInsufficientHours as $student) {
            Log::info("Student {$student->student_id} has insufficient hours: {$student->total_hours}/320");
        }

        $this->info('Deadline check completed!');
        $this->info("Students without criteria: {$studentsWithoutCriteria->count()}");
        $this->info("Students without hours: {$studentsWithoutHours->count()}");
        $this->info("Students with insufficient hours: {$studentsInsufficientHours->count()}");

        return Command::SUCCESS;
    }
}
