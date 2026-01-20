<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the students.
     */
    public function index(Request $request)
    {
        $query = Student::with('user');

        // Filter by student_id if provided
        if ($request->has('student_id')) {
            $query->where('student_id', 'like', '%' . $request->student_id . '%');
        }

        // Filter by section if provided
        if ($request->has('section')) {
            $query->where('section', $request->section);
        }

        // Pagination
        $perPage = $request->get('per_page', 15);
        $students = $query->paginate($perPage);

        return response()->json($students);
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id|unique:students,user_id',
            'student_id' => 'required|string|unique:students,student_id',
            'title' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string',
            'section' => 'nullable|string',
            'registration_status' => 'nullable|string',
            'company_name' => 'nullable|string',
            'job_position' => 'nullable|string',
            'job_description' => 'nullable|string',
            'company_address' => 'nullable|string',
            'company_phone' => 'nullable|string',
            'coordinator_name' => 'nullable|string',
            'coordinator_position' => 'nullable|string',
            'coordinator_phone' => 'nullable|string',
            'authorized_person_name' => 'nullable|string',
            'authorized_person_position' => 'nullable|string',
            'google_map_coords' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'major_subjects_passed' => 'nullable|integer',
            'pre_internship_grade' => 'nullable|string',
            'criteria_evidence' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'absent_days' => 'nullable|integer|min:0',
            'late_days' => 'nullable|integer|min:0',
            'leave_days' => 'nullable|integer|min:0',
            'total_hours' => 'nullable|integer|min:0',
            'hours_evidence' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->except(['photo', 'criteria_evidence', 'hours_evidence']);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('students/photos', 'public');
            $data['photo_path'] = $photoPath;
        }

        // Handle criteria evidence upload
        if ($request->hasFile('criteria_evidence')) {
            $criteriaPath = $request->file('criteria_evidence')->store('students/criteria', 'public');
            $data['criteria_evidence_file'] = $criteriaPath;
        }

        // Handle hours evidence upload
        if ($request->hasFile('hours_evidence')) {
            $hoursPath = $request->file('hours_evidence')->store('students/hours', 'public');
            $data['hours_evidence_file'] = $hoursPath;
        }

        $student = Student::create($data);

        return response()->json([
            'message' => 'Student created successfully',
            'student' => $student->load('user')
        ], 201);
    }

    /**
     * Display the specified student.
     */
    public function show($id)
    {
        $student = Student::with('user')->findOrFail($id);
        return response()->json($student);
    }

    /**
     * Update the specified student in storage.
     */
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'student_id' => 'sometimes|string|unique:students,student_id,' . $id,
            'title' => 'sometimes|string',
            'first_name' => 'sometimes|string',
            'last_name' => 'sometimes|string',
            'phone' => 'sometimes|string',
            'section' => 'nullable|string',
            'registration_status' => 'nullable|string',
            'company_name' => 'nullable|string',
            'job_position' => 'nullable|string',
            'job_description' => 'nullable|string',
            'company_address' => 'nullable|string',
            'company_phone' => 'nullable|string',
            'coordinator_name' => 'nullable|string',
            'coordinator_position' => 'nullable|string',
            'coordinator_phone' => 'nullable|string',
            'authorized_person_name' => 'nullable|string',
            'authorized_person_position' => 'nullable|string',
            'google_map_coords' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'major_subjects_passed' => 'nullable|integer',
            'pre_internship_grade' => 'nullable|string',
            'criteria_evidence' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'absent_days' => 'nullable|integer|min:0',
            'late_days' => 'nullable|integer|min:0',
            'leave_days' => 'nullable|integer|min:0',
            'total_hours' => 'nullable|integer|min:0',
            'hours_evidence' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->except(['photo', 'criteria_evidence', 'hours_evidence']);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($student->photo_path) {
                Storage::disk('public')->delete($student->photo_path);
            }
            $photoPath = $request->file('photo')->store('students/photos', 'public');
            $data['photo_path'] = $photoPath;
        }

        // Handle criteria evidence upload
        if ($request->hasFile('criteria_evidence')) {
            // Delete old file if exists
            if ($student->criteria_evidence_file) {
                Storage::disk('public')->delete($student->criteria_evidence_file);
            }
            $criteriaPath = $request->file('criteria_evidence')->store('students/criteria', 'public');
            $data['criteria_evidence_file'] = $criteriaPath;
        }

        // Handle hours evidence upload
        if ($request->hasFile('hours_evidence')) {
            // Delete old file if exists
            if ($student->hours_evidence_file) {
                Storage::disk('public')->delete($student->hours_evidence_file);
            }
            $hoursPath = $request->file('hours_evidence')->store('students/hours', 'public');
            $data['hours_evidence_file'] = $hoursPath;
        }

        $student->update($data);

        return response()->json([
            'message' => 'Student updated successfully',
            'student' => $student->load('user')
        ]);
    }

    /**
     * Remove the specified student from storage.
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);

        // Delete associated files
        if ($student->photo_path) {
            Storage::disk('public')->delete($student->photo_path);
        }
        if ($student->criteria_evidence_file) {
            Storage::disk('public')->delete($student->criteria_evidence_file);
        }
        if ($student->hours_evidence_file) {
            Storage::disk('public')->delete($student->hours_evidence_file);
        }

        $student->delete();

        return response()->json([
            'message' => 'Student deleted successfully'
        ]);
    }

    /**
     * Get student by user_id
     */
    public function getByUserId($userId)
    {
        $student = Student::with('user')->where('user_id', $userId)->firstOrFail();
        return response()->json($student);
    }
}
