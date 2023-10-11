<?php

namespace App\Http\Controllers\Web;

use App\Helpers\UserActivity;
use Illuminate\Http\Request;
use App\Models\EvidencePhoto;
use App\Http\Controllers\Controller;
use App\Models\Evidence;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EvidencePhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $evidence = Evidence::find($id);

        $photos = $evidence->evidence_photo()->latest()->get();

        return view('admin-panel.pages.evidence.photo', compact('evidence', 'photos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $rules = [
            'avatar'    => 'image|mimes:jpeg,png,jpg',
        ];

        $messages = [
            'avatar.image'          => 'Avatar harus berupa gambar',
            'avatar.mimes'          => 'Avatar harus berformat gambar (jpeg, png atau jpg)',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $evidence = Evidence::find($id);
        $data = $request->all();
        $data['evidence_id'] = $evidence->id;

        if($request->has('image')) {
            $image = $request->file('image');
            $filename = time(). '.jpg';
            $upload_filepath = 'public/evidence_photos';
            $path = $image->storeAs($upload_filepath, $filename);
            unset($data['image']);
            $data['image'] = Storage::url($path);
        }

        $photo = EvidencePhoto::create($data);

        UserActivity::addToLog('Menambahkan foto baru pada BB ' . $evidence->name);

        return redirect()->back()->with('success', 'Data Foto BB berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $photo = EvidencePhoto::find($id);

        UserActivity::addToLog('Menghapus foto pada BB : ' . $photo->evidence->name);

        // Construct the full storage path
        $filePath = public_path($photo->image);

        // Check if the file exists
        if (file_exists($filePath)) {
            // Delete the file
            File::delete($filePath);
        } 

        $photo->delete();

        return back()->with('success', 'Foto BB berhasil dihapus');
                
    }
}
