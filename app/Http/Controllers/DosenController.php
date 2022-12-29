<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Matkul;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search')){
            $dosens= Dosen::with('matkuls')->where('nama','LIKE','%' .$request->search.'%')->orWhere('prodi','LIKE','%' .$request->search.'%')
            ->paginate(3);
        }else {
                $dosens = Dosen::with('matkuls')->paginate(3);  
            }

        return view('dosens.index',compact('dosens'));
    }

    public function create(Dosen $dosen)
    {
        $matkuls = Matkul::get();
        return view('dosens.create',[
            'dosen' => $dosen,
            'matkuls' => $matkuls,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'nim'=>'required|max:10',
            'nama'=>'required',
            'prodi' => 'required',
            'nama' => 'required',
        ]);

        $dosen = Dosen::create([
            'nim' => $request['nim'],
            'nama' =>$request['nama'],
            'prodi' => $request['prodi'],
        ]);

        $matkuls= Matkul::find($request->matkul_id);
        $dosen->matkuls()->sync($matkuls);
        
        if($dosen){
            return redirect()->route('dosen.index')->with(['success' => 'Successfully Added Data Dosen']);
        }else{
            return redirect()->route('dosen.update')->with('error');
        }
    }

    public function show(Dosen $dosen)
    {
        $dosens = Dosen::get();
        return view('welcome',compact('dosens'));
    }
    
    public function edit(Dosen $dosen)
    {

        $matkuls = Matkul::get();
        return view('dosens.edit',[
            'dosen' => $dosen,
            'matkuls' => $matkuls,
        ]);
    }

    public function update(Request $request,Dosen $dosen)
    {
        $validated = $request->validate([
            'nim'=>'required|max:10',
            'nama'=>'required',
            'prodi' => 'required',
            'nama' => 'required',
        ]);

        $dosen = Dosen::update([
            'nim' => $validated['nim'],
            'nama' =>$validated['nama'],
            'prodi' => $validated['prodi'],
        ]);

        $matkuls= Matkul::find($request->matkul_id);
        $dosen->matkuls()->sync($matkuls);
        
        if($dosen){
            return redirect()->route('dosen.index')->with(['success' => 'Successfully Added Data Dosen']);
        }else{
            return redirect()->route('dosen.update')->with('error');
        }
    }

    public function destroy(Dosen $dosen)
    {
        $dosen->delete();
        return redirect()->route('dosen.index')->with('success',"Deleted Successfully Data Dosen");
    }
}
