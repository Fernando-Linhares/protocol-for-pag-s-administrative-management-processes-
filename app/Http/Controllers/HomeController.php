<?php
namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Historic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Storage;

class HomeController extends Controller
{
    public function __construct(
        private Storage $storage
        ){}

    public function index()
    {
        $storage = $this->storage->where('user_id',Auth::user()->id)
        ->where('ondashboard',true)->get();
        return view('dashboard')->with('documents',$storage);
    }

    public function store(Request $request)
    {
        foreach($request->id as $document_id){
            $user_name = $request->user;
            $user_id = User::where('name',$user_name)->get();
            $user_id = $user_id[0]->id;
    
            $historic = new Historic;
            $historic->user_id = $user_id;
            $historic->doc_id = $document_id;
            $historic->acept = false;
            $historic->save();
    
            $storage = $this->storage->where('doc_id',$document_id)->first();
            $storage->ondashboard=false;
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
    
            $historic = new Historic;
            $historic->user_id = $user_id;
            $historic->doc_id = $document_id;
            $historic->acept = true;
            $historic->save();
    
            $storage = $this->storage->where('doc_id',$document_id)->first();
            $storage->ondashboard=true;
            $storage->user_id = $user_id;
            $storage->save();
        }
        return redirect()->route('entry');
    }

    public function searchFrom(Request $request)
    {
        $document = Document::where('number',$request->number)->first();
    
        $historics = Historic::where('doc_id',$document->id)->get();
        
        return view('historic')->with('historics',$historics);
    }

    public function createDocument()
    {
        return view('new');
    }

    public function updateDocument(Request $request)
    {
        $doc = Document::create($request->except('token'));
        Historic::create(['id'=>null,'doc_id'=>$doc->id,'user_id'=>Auth::user()->id,'acept'=>true]);
        Storage::create(['id'=>null,'doc_id'=>$doc->id,'user_id'=>Auth::user()->id,'ondashboard'=>true]);
        return redirect()->route('create');
    }
}
