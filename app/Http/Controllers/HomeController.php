<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DocumentSendRequest;
use App\Http\Requests\DocumentCreateRequest;
use App\Http\Requests\AceptDocumentRequest;
use App\Models\Historic;
use App\Models\Document;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $documents = Auth::user()->documents->where('acepted',true);
        return view('dashboard')->with('documents',$documents);
    }

    public function store(DocumentSendRequest $request)
    {
        $user_id = User::where('name', $request->user)->first()->id;
        foreach($request->id as $document_id){
            Historic::create(['user_id'=>$user_id, 'doc_id'=>$document_id]);
            $document = Document::find($document_id);
            $document->user_id = $user_id;
            $document->acepted = false;
            $document->save();
            unset($document);
        }
        return redirect()->route('dashboard');
    }

    public function entryPoint()
    {
        $documents = Auth::user()->documents->where('acepted',false);
        return view('entry')->with('documents',$documents);
    }

    public function aceptDocument(AceptDocumentRequest $request)
    {
        $user_id = Auth::user()->id;
        foreach($request->id as $document_id){
            Historic::create(['user_id'=>$user_id, 'doc_id'=>$document_id]);
            $document = Document::find($document_id);
            $document->acepted = true;
            $document->save();
            unset($document);
        }
        return redirect()->route('entry')->with('message','Documento(s) aceito(s) com sucesso');
    }

    public function searchFrom(Request $request)
    {
        $request->validate(['number'=>'required'],['number.required'=>'nenhum item encontrado']);
        $historics = new Historic;
        $document = Document::where('number',$request->number)->first();
        $records = $historics->getCronogram($document->id);
        return view('historic')->with('historics', $records);
    }

    public function createDocument()
    {
        return view('new');
    }

    public function updateDocument(DocumentCreateRequest $request)
    {
        $document = $request->except('token');
        $user_id = Auth::user()->id;
        $document['user_id']=$user_id;
        $document['acepted']=true;

        if(Document::create($document)){
            return redirect()->route('create')->with('message','documento criado com sucesso!');
            Historic::create(['user_id'=>$user_id,'doc_id'=>$document['id']]);
        }

        return redirect()->back()->with('error', 'documento inválido');
    }
}
