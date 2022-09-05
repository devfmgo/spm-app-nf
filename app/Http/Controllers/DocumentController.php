<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Unit;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Document;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::all();
        $types = Type::all();
        $countDocument = Document::all();
        $limit = 8;
        // filter all data 
        if ($countDocument) {
            $documents = Document::with('unit', 'type')->paginate($limit);
        }
        // filter berdasarkan unit 
        if (request('uid') > 1) {
            $documents = Document::with('unit', 'type')->where('unit_id', request('uid'))->paginate($limit);
        }

        // filter berdasarkan unit dan type 
        if (request('type') > 0) {
            $documents = Document::with('unit', 'type')->where('type_id', request('type'))->paginate($limit);
        }
        // filter berdasarkan unit dan type 
        if (request('uid') > 1 && request('type') > 0) {
            $documents = Document::with('unit', 'type')->where('unit_id', request('uid'))->where('type_id', request('type'))->paginate($limit);
        }

        // filter berdasarkan search
        if (request('search')) {
            $documents = Document::with('unit', 'type')->where('title', 'LIKE', '%' . request('search') . '%')->paginate($limit);
        }

        return view('pages.document.index', compact('documents', 'units', 'types'));
    }
    /**
     * Data Document
     * **/
    public function document_data()
    {
        $documents = Document::with('unit', 'type')->get();
        return view('pages.document.data-document', compact('documents'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $units = Unit::all();
        $types = Type::all();

        return view('pages.document.add-document', compact('units', 'types'));
    }
    // function set folder 
    public function folder($type)
    {
        if ($type == 1) {
            return 'Pedoman';
        }
        if ($type == 2) {
            return 'Panduan';
        }
        if ($type == 3) {
            return 'Prosedur';
        }
        if ($type == 4) {
            return 'IK';
        }
        if ($type == 5) {
            return 'Format';
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:1000',
            'title' => 'required',
            'unit_id' => 'required',
            'type_id' => 'required'
        ]);

        $uploadedFile = $request->file;
        $filename = $request->unit_id . "_" . $request->type_id . "_" . date('Y-m-d H:i:s') . "_" . $request->file('file')->getClientOriginalName();
        $simpan = $uploadedFile->storeAs('public/' . $this->folder($request->type_id), $filename);
        $data = new Document();
        $data->title = $request->title;
        $data->unit_id = $request->unit_id;
        $data->type_id = $request->type_id;
        $data->slug = Str::slug($request->title);
        $data->file_doc = $filename;
        if ($data->save()) {
            return redirect('document');
        }
        return back();
        // dd($request->unit_id . "_" . $request->type_id . "_" . date('Y-m-d') . "_" . $request->file('file')->getClientOriginalName());
    }

    /**
     * Display the specified resource. *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $documents = Document::where('slug', $slug)->first();
        return view('pages.document.view-document', compact('documents'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $units = Unit::all();
        $types = Type::all();
        $document = Document::findOrFail($id);
        return view('pages.document.edit-document', compact('document', 'units', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
