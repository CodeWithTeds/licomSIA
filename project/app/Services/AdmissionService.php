<?php

namespace App\Services;

use App\Models\Admission;
use App\Models\Student;
use App\Models\User;
use App\Mail\StudentAccountCreated;
use App\Repositories\AdmissionRepository;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdmissionService
{
    protected $admissionRepository;

    public function __construct(AdmissionRepository $admissionRepository)
    {
        $this->admissionRepository = $admissionRepository;
    }

    public function createAdmission(array $data): Admission
    {
        return $this->admissionRepository->create($data);
    }

    public function getAllAdmissions($programId = null)
    {
        return $this->admissionRepository->getAll($programId);
    }

    public function approveAdmission(Admission $admission)
    {
        try {
            $admission->application_status = 'approved';
            $admission->save();

            // Check if user already exists with this email
            $user = User::where('email', $admission->email)->first();
            $generatedPassword = null;
            
            if (!$user) {
                // Create a new user only if one doesn't exist
                $generatedPassword = str()->password(10);
                $user = User::create([
                    'name' => $admission->first_name . ' ' . $admission->last_name,
                    'email' => $admission->email,
                    'password' => Hash::make($generatedPassword),
                    'role' => 'student',
                ]);
            }

            // Generate a new password for the student account
            $generatedPassword = str()->password(10);
            
            // Create or update user account
            if (!$user) {
                $user = User::create([
                    'name' => $admission->first_name . ' ' . $admission->last_name,
                    'email' => $admission->email,
                    'password' => Hash::make($generatedPassword),
                    'role' => 'student',
                ]);
            } else {
                // Update existing user's password
                $user->update([
                    'password' => Hash::make($generatedPassword),
                    'role' => 'student'
                ]);
            }

            // Send the account details email first
            Mail::to($admission->email)->send(new StudentAccountCreated($user, $generatedPassword));
            Log::info('Sent account details to: ' . $admission->email);

            // Then send the qualification email
            $admission->sendQualificationEmail();
            Log::info('Sent qualification email to: ' . $admission->email);

            // Check if student record already exists
            $studentExists = Student::where('user_id', $user->id)->exists();
            
            if (!$studentExists) {
                // Generate a unique student number
                $studentNumber = date('Y') . '-' . str_pad($admission->admission_id, 4, '0', STR_PAD_LEFT);

                // Create a new student record
                Student::create([
                    'user_id' => $user->id,
                    'student_number' => $studentNumber,
                    'first_name' => $admission->first_name,
                    'last_name' => $admission->last_name,
                    'email' => $admission->email,
                    'program_id' => $admission->program_id,
                    'year_level' => 1, // Default to 1st year
                ]);
            }

            return $admission;
        } catch (\Throwable $e) {
            Log::error('Failed in admission approval process: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            throw new \Exception('Failed to process admission approval. Error: ' . $e->getMessage());
        }
    }

    public function rejectAdmission(Admission $admission)
    {
        $admission->application_status = 'rejected';
        $admission->save();

        return $admission;
    }
} 