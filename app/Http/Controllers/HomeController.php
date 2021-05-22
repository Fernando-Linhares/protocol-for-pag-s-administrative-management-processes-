<?php
namespace App\Http\Controllers;

use App\Models\Historic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Storage;
use App\Http\Requests\{
    DocumentSendRequest,
    DocumentCreateRequest,
    AceptDocumentRequest
};
use App\Repository\Contracts\DocumentSendRepositoryInterface;

class HomeController extends Controller
{
    public function __construct(
        private Storage $storage,
        private Historic $historic,
        private User $user,
        private DocumentSendRepositoryInterface $document_repository
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
            $this->document_repository->transferDocument($user_id,$document_id);  
        }
        return redirect()->route('dashboard');
    }

    public function entryPoint()
    {
        $storage = $this->storage
        ->where('user_id',Auth::user()->id)
        ->where('ondashboard',false)->get();
        return view('entry')->with('documents',$storage);
    }

    public function aceptDocument(AceptDocumentRequest $request)
    {
        foreach($request->id as $document){
            $user = Auth::user()->id;;    
            $this->document_repository->aceptDocument($user,$document);
        }
        return redirect()->route('entry')->with('message','Documento(s) aceito(s) com sucesso');
    }

    public function searchFrom(Request $request)
    {
        $request->validate(['number'=>'required']);
        $document = $this->storage->where('number',$request->number)->first();
        $historics = $this->historic->where('doc_id',$document->id)->get();
        return view('historic')->with('historics',$historics);
    }

    public function createDocument()
    {
        return view('new');
    }

    public function updateDocument(DocumentCreateRequest $request)
    {
        $doc = $request->except('token');
        $this->document_repository->newDocument(Auth::user()->id,$doc);
        return redirect()->route('create')->with('message','documento criado com sucesso!');
    }
}
