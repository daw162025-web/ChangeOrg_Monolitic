<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Petition;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class AdminPetitionsController extends Controller
{
    public function index()
    {
        $petitions = Petition::all();
        return view('admin.petitions.index', compact('petitions'));
    }

    public function edit($id)
    {
        $petition = Petition::findOrFail($id);
        $categories = Category::all();
        return view('admin.petitions.edit-add', compact('petition', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $petition = Petition::findOrFail($id);
        $petition->update([
            'title'       => $request->input('title'),
            'description' => $request->input('description'),
            'destinatary' => $request->input('destinatary'),
            'category_id' => $request->input('category_id'),
            'status'      => $request->input('status'),
        ]);

        // imagenes
        if ($request->hasFile('file')) {

            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('petitions'), $filename);

            $fileModel = $petition->files()->first();

            if ($fileModel) {
                $fileModel->file_path = $filename;
                $fileModel->name      = $filename;
                $fileModel->save();
            } else {
                // sino tenía imagen, creamos un registro nuevo
                $newFile = new File();
                $newFile->petition_id = $petition->id;
                $newFile->file_path   = $filename;
                $newFile->name        = $filename;
                $newFile->save();
            }
        }

        return redirect()->route('admin.petitions.index')
            ->with('success', 'Petición actualizada correctamente');
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.petitions.edit-add', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id(); // El dueño es el usuario actual (Admin)
        $data['signeds'] = 0;          // Empieza con 0 firmas

        $petition = Petition::create($data);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('petitions'), $filename);

            $newFile = new File();
            $newFile->petition_id = $petition->id;
            $newFile->file_path   = $filename;
            $newFile->name        = $filename;
            $newFile->save();
        }

        return redirect()->route('admin.petitions.index')
            ->with('success', 'Petición creada correctamente');
    }

    public function delete($id)
    {
        $petition = Petition::findOrFail($id);
        if ($petition->signeds > 0) {
            return redirect()->back()
                ->with('error', '¡ERROR! No puedes borrar una petición que ya ha sido firmada.');
        }

        foreach($petition->files as $file) {
            $rutaArchivo = public_path('petitions/' . $file->file_path);
            if (file_exists($rutaArchivo)) {
                unlink($rutaArchivo);
            }
            $file->delete();
        }

        $petition->delete();

        return redirect()->back()->with('success', 'Petición eliminada correctamente.');
    }
}
