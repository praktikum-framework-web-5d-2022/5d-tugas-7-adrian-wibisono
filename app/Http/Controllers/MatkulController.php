<?php

namespace App\Http\Controllers;

use App\Models\Matkul;
use Illuminate\Http\Request;

class MatkulController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search')){
            $matkuls= Matkul::with('dosens')->where('nama','LIKE','%' .$request->search.'%')
            ->paginate(3);
        }else {
                $matkuls = Matkul::with('dosens')->paginate(3);  
            }

        return view('matkuls.index',compact('matkuls'));
    }

    public function create(Request $request)
    {
        return view('matkuls.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'nama'=>'required',
        ]);
        $matkul = Matkul::create([
            'nama' => $request->nama
        ]);
        if($matkul){
            return redirect()->route('matkul.index')->with(['success' => 'Successfully Added Data Mata Kuliah']);
        }else{
            return redirect()->route('matkul.update')->with('error');
        }
    }

    public function show(Matkul $matkul)
    {
        //
    }
    
    public function edit(matkul $matkul)
    {

        return view('matkuls.edit',[
            'matkul' => $matkul
        ]);
    }

    public function update(Request $request,Matkul $matkul)
    {
        $validate = $this->validate($request,[
            'nama'=>'required',
        ]);
        Matkul::where('id', $matkul->id)->update($validate);
        if($matkul){
            return redirect()->route('matkul.index')->with(['success' => 'Changed Successfully Data Mata Kuliah']);
        }else{
            return redirect()->route('matkul.edit')->with('error');
        }
    }

    public function destroy(Matkul $matkul)
    {
        $matkul->delete();

        return redirect()->route('matkul.index')->with('success',"Deleted Successfully Data Mata Kuliah");
    }
}
