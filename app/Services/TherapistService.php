<?php

namespace App\Services;

use App\Models\Therapist;
use App\Models\User;
use Yajra\DataTables\DataTables;

class TherapistService
{
    public function all_therapist_thru_spa($therapist)
    {
        return DataTables::of($therapist)
            ->editColumn('created_at',function($therapist){
                return $therapist->created_at->format('M d, Y');
            })
            ->addColumn('fullname',function ($therapist){
                if(auth()->user()->can('view therapist'))
                {
                    return '<a href="'.route('therapists.profile',['id' => $therapist->id]).'" title="View">'.$therapist->firstname.' '.$therapist->lastname.'</a>&nbsp;';
                } else {
                    return $therapist->firstname.' '.$therapist->lastname;
                }
            })
            ->editColumn('date_of_birth',function($therapist){
                return $therapist->created_at->format('F d, Y');
            })
            ->addColumn('mobile_number',function ($therapist){
                return $therapist->mobile_number;
            })
            ->addColumn('email',function ($therapist){
                return $therapist->email;
            })
            ->addColumn('gender',function ($therapist){
                return $therapist->gender;
            })
            ->addColumn('action', function($therapist){
                $action = "";
                if(auth()->user()->can('view therapist'))
                {
                    $action .= '<a href="'.route('therapists.profile',['id' => $therapist->id]).'" class="btn btn-sm btn-outline-success" title="View"><i class="fas fa-eye"></i></a>&nbsp;';
                }
                if(auth()->user()->can('edit therapist'))
                {
                    $user = $this->get_therapist_user_id($therapist->mobile_number, $therapist->email);
                    $user_id = '';
                    if (!empty($user)) {
                        $user_id = $user->id;
                    }
                    $action .= '<a href="#" class="btn btn-sm btn-outline-primary edit-therapist-btn" id="'.$therapist->id.'" data-user_id="'.$user_id.'"><i class="fa fa-edit"></i></a>&nbsp;';
                }
                if(auth()->user()->can('delete therapist'))
                {
                    $action .= '<a href="#" class="btn btn-sm btn-outline-danger delete-therapist-btn" id="'.$therapist->id.'"><i class="fa fa-trash"></i></a>&nbsp;';
                }
                return $action;
            })
            ->rawColumns(['action','fullname'])
            ->make(true);
    }



    private function get_therapist_user_id($mobile, $email)
    {
        $user = User::where([
            'mobile_number' => $mobile,
            'email' => $email,
        ])->first();

        return $user;
    }

    public function get_therapist_by_id($therapist_id)
    {
        return Therapist::findOrfail($therapist_id);
    }
}
