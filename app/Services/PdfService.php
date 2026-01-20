<?php

namespace App\Services;

use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class PdfService
{
    /**
     * Generate internship application document
     */
    public function generateInternshipApplication(Student $student)
    {
        $student->load('user');

        $data = [
            'student' => $student,
            'generated_date' => now()->format('d/m/Y'),
        ];

        $pdf = Pdf::loadView('pdf.internship-application', $data);

        $filename = 'internship_application_' . $student->student_id . '_' . time() . '.pdf';
        $path = 'documents/applications/' . $filename;

        Storage::disk('public')->put($path, $pdf->output());

        return [
            'path' => $path,
            'url' => Storage::url($path),
            'filename' => $filename
        ];
    }

    /**
     * Generate criteria verification document
     */
    public function generateCriteriaDocument(Student $student)
    {
        $student->load('user');

        $data = [
            'student' => $student,
            'generated_date' => now()->format('d/m/Y'),
        ];

        $pdf = Pdf::loadView('pdf.criteria-verification', $data);

        $filename = 'criteria_verification_' . $student->student_id . '_' . time() . '.pdf';
        $path = 'documents/criteria/' . $filename;

        Storage::disk('public')->put($path, $pdf->output());

        return [
            'path' => $path,
            'url' => Storage::url($path),
            'filename' => $filename
        ];
    }

    /**
     * Generate hours verification document
     */
    public function generateHoursDocument(Student $student)
    {
        $student->load('user');

        $data = [
            'student' => $student,
            'generated_date' => now()->format('d/m/Y'),
        ];

        $pdf = Pdf::loadView('pdf.hours-verification', $data);

        $filename = 'hours_verification_' . $student->student_id . '_' . time() . '.pdf';
        $path = 'documents/hours/' . $filename;

        Storage::disk('public')->put($path, $pdf->output());

        return [
            'path' => $path,
            'url' => Storage::url($path),
            'filename' => $filename
        ];
    }

    /**
     * Generate company information document
     */
    public function generateCompanyDocument(Student $student)
    {
        $student->load('user');

        $data = [
            'student' => $student,
            'generated_date' => now()->format('d/m/Y'),
        ];

        $pdf = Pdf::loadView('pdf.company-information', $data);

        $filename = 'company_info_' . $student->student_id . '_' . time() . '.pdf';
        $path = 'documents/company/' . $filename;

        Storage::disk('public')->put($path, $pdf->output());

        return [
            'path' => $path,
            'url' => Storage::url($path),
            'filename' => $filename
        ];
    }

    /**
     * Generate complete internship report
     */
    public function generateCompleteReport(Student $student)
    {
        $student->load('user');

        $data = [
            'student' => $student,
            'generated_date' => now()->format('d/m/Y'),
        ];

        $pdf = Pdf::loadView('pdf.complete-report', $data);

        $filename = 'complete_report_' . $student->student_id . '_' . time() . '.pdf';
        $path = 'documents/reports/' . $filename;

        Storage::disk('public')->put($path, $pdf->output());

        return [
            'path' => $path,
            'url' => Storage::url($path),
            'filename' => $filename
        ];
    }

    /**
     * Download PDF directly
     */
    public function downloadPdf(Student $student, string $type = 'complete')
    {
        $student->load('user');

        $data = [
            'student' => $student,
            'generated_date' => now()->format('d/m/Y'),
        ];

        $viewName = match ($type) {
            'application' => 'pdf.internship-application',
            'criteria' => 'pdf.criteria-verification',
            'hours' => 'pdf.hours-verification',
            'company' => 'pdf.company-information',
            default => 'pdf.complete-report',
        };

        $filename = $type . '_' . $student->student_id . '.pdf';

        return Pdf::loadView($viewName, $data)->download($filename);
    }
}
