<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Petition;
use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

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
            'category_id' => 'required',
            'file' => 'required'
        ]);

        $input = $request->all();
        try {
            $category = Category::findOrFail($input['category_id']);
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


            $filename = $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move('petitions', $filename);

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

    public function edit($id)
    {
        $petition = Petition::findOrFail($id);
        $this->authorize('update', $petition);
        $categories = Category::all();
        return view('petitions.edit-add', compact('petition', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $petition = Petition::findOrFail($id);

        $this->authorize('update', $petition);

        $petition->update([
            'title'       => $request->input('title'),
            'description' => $request->input('description'),
            'destinatary' => $request->input('destinatary'),
            'category_id' => $request->input('category_id'),
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('petitions'), $filename);

            $fileModel = $petition->files()->first();

            if ($fileModel) {
                // CASO 1: Ya existía foto, actualizamos
                $fileModel->file_path = $filename;
                $fileModel->name      = $filename;
                $fileModel->save();
            } else {
                // CASO 2: No tenía foto, creamos una nueva
                $newFile = new File();
                $newFile->petition_id = $petition->id;
                $newFile->file_path   = $filename;
                $newFile->name        = $filename;
                $newFile->save();
            }
        }

        return redirect()->route('petitions.mine')
            ->with('success', 'Petición actualizada correctamente.');
    }

    public function destroy($id)
    {
        $petition = Petition::findOrFail($id);

        $this->authorize('delete', $petition);

        if ($petition->signeds > 0) {
            return redirect()->back()->with('error', 'No puedes borrar una petición que ya tiene firmas.');
        }

        foreach($petition->files as $file) {
            $ruta = public_path('petitions/' . $file->file_path);
            if(file_exists($ruta)) unlink($ruta);
            $file->delete();
        }

        $petition->delete();

        return redirect()->back()->with('success', 'Petición eliminada.');
    }

}
