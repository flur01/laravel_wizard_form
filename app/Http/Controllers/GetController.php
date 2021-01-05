<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;

class GetController extends Controller
{
    public function mainPage()
    {
        $membersAmount = Member::count();
        return view('main-page', [
            'membersAmount' => $membersAmount,
            'uploadMaxFilesize' => $this->uploadMaxFilesize()['sizeText'],
            'twitMessage' => config('app.twitMessage'),
            'facebookUrl' => config('app.facebookUrl')
        ])->render();
    }

    public function allMembers()
    {
        return view('all-members')->render();
    }

    public function getAllMembers()
    {
        $isAdmin = false;
        $members = Member::select('id', 'photo', 'firstname', 'lastname', 'report_subject', 'email', 'visible');
        if (Auth::user()) {
            $isAdmin = true;
            $members = $members->get();
        } else {
            $members = $members->where('visible', 1)->get();
        }
        return response()->json([
            'members' => $members,
            'imageUrl' => url('images'),
            'isAdmin' => $isAdmin
        ]);
    }
}
