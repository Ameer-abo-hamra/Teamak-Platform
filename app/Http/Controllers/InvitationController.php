<?php

namespace App\Http\Controllers;

use App\Notifications\EmployeeInvitation;
use Illuminate\Http\Request;
use Log;
use Notification;
use Illuminate\Support\Str;
use App\Models\Invitation;
class InvitationController extends Controller
{




    public function store(Request $request)
    {
        try {

            // 1. Validation
            $request->validate([
                'employee_email' => 'required|email',
                'job_title' => 'nullable|string',
                'role' => 'nullable|string',
                'description' => 'nullable|string',
            ]);

            $email = $request->employee_email;

            $company = auth('company')->user();

            // 2. Generate unique token (64 chars)
            $token = Str::random(64);

            // 3. Save invitation in DB
            $invitation = Invitation::create([
                'company_id' => $company->id,
                'employee_email' => $email,
                'job_title' => $request->job_title,
                'description' => $request->description,
                'invitation_token' => $token,
            ]);

            // 4. Create invitation link
            $invitationLink = url('/accept-invitation/' . $token);



            // 5. Send Notification
            Notification::route('mail', $email)
                ->notify(new EmployeeInvitation(
                    $invitationLink,
                    $company->Company_name,
                    $request->job_title,
                    $request->department_id
                    ,
                    $request->description ?? "" , 
                ));

            Log::info('Invitation email sent', [
                'email' => $email,
            ]);

            return response()->json([
                'message' => 'Invitation sent successfully',
                'type' => 'success'
            ], 200);

        } catch (\Exception $e) {

            Log::error('Invitation failed', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
            ]);

            return response()->json([
                'message' => 'Something went wrong',
                'type' => 'error'
            ], 500);
        }
    }
}
