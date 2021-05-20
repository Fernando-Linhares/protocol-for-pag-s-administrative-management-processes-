<?php
namespace App\Http\Controllers;

use App\Models\Historic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Storage;
use App\Http\Requests\DocumentSendRequest;
use App\Models\Document;

class HomeController extends Controller
{
    public function __construct(
        private Storage $storage,
        private Historic $historic,
        private User $user,
        private Document $document
        ){}

    public function index()
    {
        $storage = $this->storage
        ->where('user_id',Auth::user()->id)
        ->where('ondashboard',true)->get();
        return view('dashboard')->with('documents',$storage);
    }

    public function store(DocumentSendRequest $request)
    {
        foreach($request->id as $document_id){
            $user_name = $request->user;
            $user_id = $this->user->where('name',$user_name)->first()->id;

            $this->historic->user_id = $user_id;
            $this->historic->doc_id = $document_id;
            $this->historic->acept = false;
            $this->historic->save();

            $storage = $this->storage->where('doc_id',$document_id)->first();
            $storage->ondashboard = false;
            $storage->user_id = $user_id;
            $storage->save();
        }
        return redirect()->route('dashboard');
    }

    public function entryPoint()
    {
        $storage = $this->storage->where('user_id',Auth::user()->id)
        ->where('ondashboard',false)->get();
        return view('entry')->with('documents',$storage);
    }

    public function aceptDocument(Request $request)
    {
        foreach($request->id as $document_id){
            $user_id = Auth::user()->id;;
    
            $this->historic->user_id = $user_id;
            $this->historic->doc_id = $document_id;
            $this->historic->acept = true;
            $this->historic->save();
    
            $this->storage = $this->storage->where('doc_id',$document_id)->first();
            $this->storage->ondashboard = true;
            $this->storage->user_id = $user_id;
            $this->storage->save();
        }
        return redirect()->route('entry');
    }

    public function searchFrom(Request $request)
    {
        $document = $this->storage->where('number',$request->number)->first();
        $historics = $this->historic->where('doc_id',$document->id)->get();
        return view('historic')->with('historics',$historics);
    }

    public function createDocument()
    {
        return view('new');
    }

    public function updateDocument(Request $request)
    {
        $doc = $this->document->create($request->except('token'));
        $this->historic->create([
            'id'=>null,
            'doc_id'=>$doc->id,
            'user_id'=>Auth::user()->id,
            'acept'=>true
            ]);
        $this->storage->create([
            'id'=>null,
            'doc_id'=>$doc->id,
            'user_id'=>Auth::user()->id,
            'ondashboard'=>true
            ]);
        return redirect()->route('create');
    }
}
