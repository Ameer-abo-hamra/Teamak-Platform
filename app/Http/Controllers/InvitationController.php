<?php

namespace App\Http\Controllers;

use App\Notifications\EmployeeInvitation;
use Illuminate\Http\Request;
use Log;
use Mail;
use Notification;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Models\Invitation;
class InvitationController extends Controller
{




    public function store(Request $request)
    {
        try {


            $request->validate([
                'employee_email' => 'required|email',
                'job_title' => 'required|string',
                'role' => 'nullable|string',
                'description' => 'nullable|string',
            ]);

            $email = $request->employee_email;

            $company = auth('company')->user();


            $token = Str::random(64);


            $invitation = Invitation::create([
                'company_id' => $company->id,
                'employee_email' => $email,
                'job_title' => $request->job_title,
                'description' => $request->description,
                'invitation_token' => $token,
            ]);


            $invitationLink = route('accept', $token);



            Notification::route('mail', $email)
                ->notify(new EmployeeInvitation(
                    $invitationLink,
                    $company->Company_name,
                    $request->job_title,
                    $request->department_id,
                    $request->description ?? "",
                ));
            Log::info('Invitation email sent', [
                'email' => $email,
            ]);

            return response()->json([
                'message' => 'Invitation sent successfully',
                'type' => 'success'
            ], 200);

        } catch (ValidationException $e) {

            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
                'type' => 'validation_error'
            ], 422);

        } catch (\Exception $e) {



            return response()->json([
                'message' => $e->getMessage(),
                'type' => 'error'
            ], 500);
        }
    }
}
