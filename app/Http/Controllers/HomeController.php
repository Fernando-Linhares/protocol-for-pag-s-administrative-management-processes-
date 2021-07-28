<?php
namespace App\Http\Controllers;
/**
 * code under maintenance
 */
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
use App\Models\Document;
use App\Repository\Contracts\DocumentSendRepositoryInterface;

class HomeController extends Controller
{
    private Storage $storage;
    private Historic $historic;
    private Document $document;
    private DocumentSendRepositoryInterface $document_repository;

    public function __construct(
         Storage $storage,
         Historic $historic,
         Document $document,
         DocumentSendRepositoryInterface $document_repository
        ){
            $this->storage = $storage;
            $this->historic = $historic;
            $this->document = $document;
            $this->document_repository = $document_repository;
        }

        //usando storage
    public function index()
    {
        $storage = $this->storage
        ->where('user_id',Auth::user()->id)
        ->where('ondashboard',true)->get();
        return view('dashboard')->with('documents',$storage);
    }


    public function store(DocumentSendRequest $request)
    {
        $user_name = $request->user;
        foreach($request->id as $document_id){
            $this->document_repository->sendDocument($user_name,$document_id);
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
        $request->validate(['number'=>'required'],['number.required'=>'nenhum item encontrado']);
        $document = $this->document->where('number',$request->number)->first();
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
