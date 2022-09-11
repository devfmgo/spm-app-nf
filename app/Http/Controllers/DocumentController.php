<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Unit;
use App\Models\Document;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        if (request('id') == null) {
            $documents = Document::with('unit', 'type')->paginate(10);
        } elseif (request('id') == "all") {
            $documents = Document::with('unit', 'type')->paginate(10);
        } else {
            $documents = Document::with('unit', 'type')->onlyTrashed()->paginate(10);
        }
        $request = request('id');
        $softDelete = Document::onlyTrashed()->count();

        return view('pages.document.data-document', compact('documents', 'softDelete', 'request'));
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
        $filename = $request->unit_id . "_" . $request->type_id . "_" . $request->title . "." . $request->file('file')->getClientOriginalExtension();
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
        $request->validate([
            'file' => 'required|mimes:pdf|max:1000',
            'title' => 'required',
            'unit_id' => 'required',
            'type_id' => 'required'
        ]);
        $uploadedFile = $request->file;
        $filename = $request->unit_id . "_" . $request->type_id . "_" . $request->title . "." . $request->file('file')->getClientOriginalExtension();
        $simpan = $uploadedFile->storeAs('public/' . $this->folder($request->type_id), $filename);
        $data = new Document();
        $data->title = $request->title;
        $data->unit_id = $request->unit_id;
        $data->type_id = $request->type_id;
        $data->slug = Str::slug($request->title);
        $data->file_doc = $filename;
        if (Document::find($id)->update($request->all())) {
            return redirect('document');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmDelete($id)
    {
        return view('pages.document.confirm-delete', compact('id'));
    }
    public function destroy($id)
    {
        Document::find($id)->delete();
        return redirect()->route('data-document', 'all');
    }
    public function deleteAll($id)
    {
        // script for delete dat with file 
        $document = Document::with('type')->where('id', $id)->first();
        $folder = $document->type->name;
        $file  = $document->file_doc;
        Storage::disk('public')->delete($folder . '/' . $file);
    }

    //  function restore or delete data permanent 
    public function restoreDelete($act, $id)
    {
        if ($act == "restore") {
            Document::withTrashed()->where('id', $id)->restore();
            return redirect()->route('data-document', 'all');
        } else {
            // script for delete dat with file 
            $document = Document::with('type')->where('id', $id)->first();
            $folder = $document->type->name;
            $file  = $document->file_doc;
            Storage::disk('public')->delete($folder . '/' . $file);
            //Delete Permanent
            Document::where('id', $id)->forceDelete();
            return redirect()->route('data-document', 'all');
        }
        return redirect()->route('data-document', 'all');
    }
}
