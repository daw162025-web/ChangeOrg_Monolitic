<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Petition;
use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetitionController extends Controller
{
    public function index(){
        $petitions = Petition::all();
        return view('petitions.index', compact('petitions'));
    }
    public function show(Request $request, $id){
        $petition = Petition::findorFail($id);
        return view('petitions.show', compact('petition'));
    }

    public function listMine(Request $request){
        try {
            $user = Auth::user();
            $petitions = Petition::where('user_id',$user->id)->paginate(5);

        }catch (\Exception $e){
            return back()->withErrors($e->getMessage())->withInput();
        }
        return view('petitions.index', compact('petitions'));
    }

    public function create(){
        $categories = Category::all();
        return view('petitions.edit-add', compact('categories'));
    }

    public function store(Request $request){
        $request->validate([
           'title' => 'required|max:255',
           'description' => 'required',
           'destinatary' => 'required',
            'category' => 'required',
            'file' => 'required'
        ]);

        $input = $request->all();
        try {
            $category = Category::findOrFail($input['category']);
            $user = Auth::user();
            $petition = new Petition($input);
            $petition->category()->associate($category);
            $petition->user()->associate($user);

            $petition->signeds = 0;
            $petition->status = 'pending';

            $res = $petition->save();

            if ($res){
                $res_file = $this->fileUpload($request, $petition->id);
                if ($res_file){
                    return redirect('/mypetitions');
                }else {
                    return back()->withErrors('Error al subir el archivo')->withInput();
                }
            }
        }catch (\Exception $e){
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function fileUpload(Request $req, $petition_id = null)
    {
        $file = $req->file('file');
        $fileModel = new File;
        $fileModel->petition_id = $petition_id;
        if ($req->file('file')) {
            //return $req->file('file');

            $filename = $fileName = time() . '_' . $file->getClientOriginalName();
            //      Storage::put($filename, file_get_contents($req->file('file')->getRealPath()));
            $file->move('petitions', $filename);

            //  Storage::put($filename, file_get_contents($request->file('file')->getRealPath()));
            //   $file->move('storage/', $name);


            //$filePath = $req->file('file')->storeAs('/peticiones', $fileName, 'local');
            //    $filePath = $req->file('file')->storeAs('/peticiones', $fileName, 'local');
            // return $filePath;
            $fileModel->name = $filename;
            $fileModel->file_path = $filename;
            $res = $fileModel->save();
            return $fileModel;

        }
        return 1;
    }

    public function sign(Request $request, $id)
    {
        try {
            $petition = Petition::findOrFail($id);
            $user = Auth::user();

            if ($petition->userSigners()->where('user_id', $user->id)->exists()) {
                return back()->with('error', 'Ya has firmado esta petición anteriormente.');
            }

            $petition->userSigners()->attach($user->id);

            $petition->signeds = $petition->signeds + 1;
            $petition->save();

            return back()->with('success', '¡Gracias por firmar!');

        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function petitionsSigned(Request $request)
    {
        $id = Auth::id();
        $user = User::findOrFail($id);
        $petitions = $user->signedPetition;
        return view('petitions.index', compact('petitions'));
    }
}
