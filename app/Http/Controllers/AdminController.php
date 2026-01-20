<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Services\PdfService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Get all students with filtering and pagination
     */
    public function getAllStudents(Request $request)
    {
        $query = Student::with('user');

        // Filter by student_id
        if ($request->has('student_id')) {
            $query->where('student_id', 'like', '%' . $request->student_id . '%');
        }

        // Filter by name
        if ($request->has('name')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->name . '%')
                    ->orWhere('last_name', 'like', '%' . $request->name . '%');
            });
        }

        // Filter by section
        if ($request->has('section')) {
            $query->where('section', $request->section);
        }

        // Filter by registration status
        if ($request->has('registration_status')) {
            $query->where('registration_status', $request->registration_status);
        }

        // Filter by company
        if ($request->has('company_name')) {
            $query->where('company_name', 'like', '%' . $request->company_name . '%');
        }

        // Sort options
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        // Pagination
        $perPage = $request->get('per_page', 15);
        $students = $query->paginate($perPage);

        return response()->json($students);
    }

    /**
     * Get student details by ID
     */
    public function getStudentDetails($id)
    {
        $student = Student::with('user')->findOrFail($id);
        return response()->json($student);
    }

    /**
     * Update student status or verification
     */
    public function updateStudentStatus(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'registration_status' => 'nullable|string',
            'admin_notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $student->update($request->only(['registration_status']));

        return response()->json([
            'message' => 'Student status updated successfully',
            'student' => $student->load('user')
        ]);
    }

    /**
     * Upload template/form files for students to download
     */
    public function uploadTemplate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:pdf,doc,docx|max:10240',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $filePath = $request->file('file')->store('templates', 'public');

        // You might want to create a Template model to store this info
        // For now, just return the file path
        return response()->json([
            'message' => 'Template uploaded successfully',
            'file_path' => $filePath,
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'url' => Storage::url($filePath)
        ], 201);
    }

    /**
     * Get statistics/dashboard data
     */
    public function getDashboardStats()
    {
        $totalStudents = Student::count();
        $registeredStudents = Student::whereNotNull('registration_status')->count();
        $studentsWithCompany = Student::whereNotNull('company_name')->count();
        $completedHours = Student::where('total_hours', '>=', 320)->count(); // Assuming 320 hours minimum

        return response()->json([
            'total_students' => $totalStudents,
            'registered_students' => $registeredStudents,
            'students_with_company' => $studentsWithCompany,
            'completed_hours' => $completedHours,
        ]);
    }

    /**
     * Export students data (CSV/Excel)
     */
    public function exportStudents(Request $request)
    {
        $students = Student::with('user')->get();

        // Convert to array for export
        $data = $students->map(function ($student) {
            return [
                'student_id' => $student->student_id,
                'email' => $student->user->email ?? '',
                'title' => $student->title,
                'first_name' => $student->first_name,
                'last_name' => $student->last_name,
                'phone' => $student->phone,
                'section' => $student->section,
                'registration_status' => $student->registration_status,
                'company_name' => $student->company_name,
                'job_position' => $student->job_position,
                'total_hours' => $student->total_hours,
                'absent_days' => $student->absent_days,
                'late_days' => $student->late_days,
                'leave_days' => $student->leave_days,
            ];
        });

        return response()->json([
            'message' => 'Students data exported',
            'data' => $data
        ]);
    }

    /**
     * Generate PDF document for student
     */
    public function generatePdf(Request $request, $id, PdfService $pdfService)
    {
        $student = Student::with('user')->findOrFail($id);

        $type = $request->get('type', 'complete');

        $result = match ($type) {
            'application' => $pdfService->generateInternshipApplication($student),
            'criteria' => $pdfService->generateCriteriaDocument($student),
            'hours' => $pdfService->generateHoursDocument($student),
            'company' => $pdfService->generateCompanyDocument($student),
            default => $pdfService->generateCompleteReport($student),
        };

        return response()->json([
            'message' => 'PDF generated successfully',
            'file' => $result
        ]);
    }

    /**
     * Download PDF document for student
     */
    public function downloadPdf($id, Request $request, PdfService $pdfService)
    {
        $student = Student::with('user')->findOrFail($id);
        $type = $request->get('type', 'complete');

        return $pdfService->downloadPdf($student, $type);
    }
}
