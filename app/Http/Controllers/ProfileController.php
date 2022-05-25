<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function show($id)
    {
        $user = User::findOrFail($id);

        $data = compact([
            'user'
        ]);

        return view('profile.show', $data);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        $data = compact([
            'user'
        ]);

        return view('profile.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user_detail = UserDetail::findOrFail($user->user_detail->id);

        $user_detail->update($request->all());

        // $req->validate([
        //     'file' => 'required|mimes:csv,txt,xlx,xls,pdf|max:2048'
        // ]);

        if($request->has('file')) {
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');

            $file = new File([
                'name' => $fileName,
                'file_path' => $filePath
            ]);

            $user->files()->save($file);
        }

        return redirect()->route('profile.show', $id)->with('success','Editted successfully!');
    }
    
    public function change_image(Request $request, $id)
    {
        $fileName = time().'_'.$request->image->getClientOriginalName();
        $request->file('image')->storeAs('images', $fileName, 'public');

        $user = User::findOrFail($id);
        $user_detail = UserDetail::findOrFail($user->user_detail->id);
        $user_detail->files = $fileName;
        $user_detail->save();

        return back();
    }

    public function download($id)
    {
        $file = File::find($id);

        return Storage::disk('public')->download($file->file_path);
    }

    public function delete($id)
    {
        $file = File::find($id);
        
        Storage::disk('public')->delete($file->file_path);
        $file->delete();

        return back();
    }
}