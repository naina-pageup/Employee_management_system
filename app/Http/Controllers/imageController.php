<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class imageController extends Controller
{
    public function create()
    {
        return view('image_upload.upload_image_form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->move(public_path('images/profile'), $name);

                image::create([

                    'path' => 'images/profile/' . $name,
                ]);
            }
        }

        return redirect('/images')->with('success', 'Images uploaded successfully');
    }
    public function index()
    {
        $dbImages = image::all();

        $directory = public_path('images/profile');
        $fileSystemImages = File::files($directory);
        $dbImagePaths = [];
        $fileSystemImagePaths = [];

        foreach ($dbImages as $image) {
            $dbImagePaths[] = $image->path;
        }
        foreach ($fileSystemImages as $file) {
            $relativePath = 'images/profile/' . $file->getFilename();
            $fileSystemImagePaths[] = $relativePath;
        }

        $nonDbImages = array_diff($fileSystemImagePaths, $dbImagePaths);

        return view('image_upload.index', compact('dbImagePaths', 'nonDbImages'));
    }
    public function delete(Request $request)
    {
        $request->validate([
            'path' => 'required|string',
        ]);

        $path = public_path($request->path);

        if (File::exists($path)) {
            File::delete($path);
            return redirect()->back()->with('success', 'Image deleted successfully.');
        }

        return redirect()->back()->with('error', 'Failed to delete the image.');
    }
}
