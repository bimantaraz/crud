<?php

namespace App\Http\Controllers;

use App\Http\Requests\mahasiswaRequest;
use Illuminate\Http\Request;
use App\Models\mahasiswa;

class mahasiswaConttroller extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  */
    // public function index(Request $request)
    // {
    //     $katakunci = $request->katakunci;
    //     $jumlahbaris = 4;
    //     if (strlen($katakunci)){
    //         $data = mahasiswa::where("nim","like","%$katakunci%")
    //         ->orWhere('nama', 'like', "%$katakunci%")
    //         ->orWhere('jurusan', 'like', "%$katakunci%")
    //         ->paginate();
    //     } else {
    //         $data = mahasiswa::orderBy("nim","desc")->paginate(5);
    //     }

    //     return view('mahasiswa.index')->with('data', $data);
    // }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $mahasiswa = mahasiswa::query();

        if ($katakunci) {
            $mahasiswa->where("nim","like","%$katakunci%")
                ->orWhere('nama', 'like', "%$katakunci%")
                ->orWhere('jurusan', 'like', "%$katakunci%");
        }

        $data = $mahasiswa->orderBy("nim", "desc")->paginate(5);

        return view('mahasiswa.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     Session::flash('nim', $request->nim);
    //     Session::flash('nama',$request->nama);
    //     Session::flash('jurusan',$request->jurusan);

    //     $request->validate([
    //         'nim'=>'required|numeric|unique:mahasiswa,nim',
    //         'nama'=>'required',
    //         'jurusan'=>'required',
    //     ], [
    //         'nim.required'=>'NIM wajib diisi',
    //         'nim.numberic'=> 'NIM wajib dalam angka',
    //         'nim.unique'=> 'NIM yang diisikan sudah ada dalam database',
    //         'nama.required'=> 'Nama wajib diisi',
    //         'jurusan.required'=> 'Jurusan wajib diisi',
    //     ]);
    //     $data = [
    //         'nim'=> $request->nim,
    //         'nama'=> $request->nama,
    //         'jurusan'=> $request->jurusan,
    //     ];
    //     mahasiswa::create($data);
    //     return redirect()->to('mahasiswa')->with('success','Berhasil menambahkan data');
    // }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(mahasiswaRequest $request)
    {
        mahasiswa::create($request->only(['nim', 'nama', 'jurusan']));

        return redirect()->to('mahasiswa')->with('success','Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $id)
    // {
    //     $data = mahasiswa::where('nim', $id)->first();
    //     return view('mahasiswa.edit')->with('data', $data);
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit')->with('data', $mahasiswa);
    }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, string $id)
    // {
    //     $request->validate([
    //         'nama'=>'required',
    //         'jurusan'=>'required',
    //     ], [
    //         'nama.required'=> 'Nama wajib diisi',
    //         'jurusan.required'=> 'Jurusan wajib diisi',
    //     ]);
    //     $data = [
    //         'nama'=> $request->nama,
    //         'jurusan'=> $request->jurusan,
    //     ];
    //     mahasiswa::where('nim',$id)->update($data);
    //     return redirect()->to('mahasiswa')->with('success','Berhasil menambahkan data');
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(mahasiswaRequest $request, mahasiswa $mahasiswa)
    {
        $mahasiswa->update($request->only(['nama', 'jurusan']));

        return redirect()->to('mahasiswa')->with('success','Berhasil menambahkan data');
    }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(string $id)
    // {
    //     mahasiswa::where('nim', $id)->delete();
    //     return redirect()->to('mahasiswa')->with('success','Berhasil melakukan delete data');
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect()->to('mahasiswa')->with('success','Berhasil melakukan delete data');
    }
}
