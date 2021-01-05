<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class PostController extends Controller
{
    public function addUser(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'birthdate' => 'required|date|before:today',
            'report_subject' => 'required|string',
            'country' => 'required|string',
            'phone' => 'required',
            'email' => 'required|email',
        ]);
        $user = new Member;
        foreach ($request->all() as $field => $value) {
            $user->$field = $value;
        }
        $user->save();
        $request->session()->put('user-id', $user->id);
        return response()->json([
            'code' => 200
        ]);
    }

    public function addInfo(Request $request)
    {
        $size = $this->uploadMaxFilesize()['sizeInt'];
        $userId = $request->session()->get('user-id');
        $this->validate($request, [
            'company' => 'nullable|string',
            'position' => 'nullable|string',
            'about' => 'nullable|string',
            'photo' => "nullable|file|mimes:jpeg,jpg,png,gif|max:$size",
        ]);
        $fileName = 'default.png';  
        if ($request->file('photo')) {
            $file = $request->file('photo');
            $fileName = date('Y-m-d_H-i_') . $file->getClientOriginalName();
            $file->move('images', $fileName);
        }
        Member::where('id', $userId)->update([
            'company' => $request->company,
            'position' => $request->position,
            'about' => $request->about,
            'photo' => $fileName
        ]);
        return response()->json([
            'code' => 200
        ]);
    }

    public function changeMembersVisible(Request $request)
    {
        Member::changeVisible($request->id, $request->visible);
    }
}
