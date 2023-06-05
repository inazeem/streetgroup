<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fileupload;
use Carbon\Carbon;

class FileuploadController extends Controller
{
    //

    public function index(){

        $files =  Fileupload::all();

        return view('files.index', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('files.create');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'file-upload' => 'required|mimes:csv',
        ]);

        // Get filename with the extension
        $filenameWithExt = $request->file('file-upload')->getClientOriginalName();
        //Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $request->file('file-upload')->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        // Upload Image
        $path = $request->file('file-upload')->storeAs('public/files',$fileNameToStore);

        $fileupload = new Fileupload;
        $fileupload->name = $fileNameToStore;
        $fileupload->is_parsed = 0;

        $fileupload->save();

        return redirect('fileupload');


        
    }
}
