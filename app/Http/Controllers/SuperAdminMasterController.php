<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use \Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApprovedRegistration;
use App\Mail\RejectRegistration;

class SuperAdminMasterController extends Controller
{
    public function getAllRequest()
    {
        $registration_request = User::all()->where('status', 'Pannding')->where('role', 1);
        return view('super_admin_master.manage_registration_request', compact('registration_request'));
    }

    public function approvedOrRejectRequest($id, $status)
    {

        if ($status == "Approved") {
            User::find(Crypt::decrypt($id))->update([
                'status' => "Approved",
                'updated_by' => auth()->id(),
                'updated_at' => Carbon::now(),
            ]);
            $user_details = User::findOrFail(Crypt::decrypt($id));
            $approved_registration = [
                'title' => 'Approved Your Registration Request',
                'body' => 'You have to login',
                'name' => $user_details->name,
                'email' => $user_details->email,
            ];
            Mail::to($user_details->email)->send(new ApprovedRegistration($approved_registration));
            return redirect("admin/registration/requests");
        }
        if ($status == "Rejected") {
            User::find(Crypt::decrypt($id))->update([
                'status' => "Rejected",
                'updated_by' => auth()->id(),
                'updated_at' => Carbon::now(),
            ]);
            $user_details = User::findOrFail(Crypt::decrypt($id));
            $reject_registration = [
                'title' => 'Reject Your Registration Request',
                'body' => 'You cannot able to login',
                'name' => $user_details->name,
                'email' => $user_details->email,
            ];
            Mail::to($user_details->email)->send(new RejectRegistration($reject_registration));

            return redirect("admin/registration/requests");
        }
    }
}
