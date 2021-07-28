<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DocumentSendRequest;
use App\Http\Requests\DocumentCreateRequest;
use App\Http\Requests\AceptDocumentRequest;
use App\Repository\Contracts\DocumentSendRepositoryInterface;
use App\Services\Contracts\DisplayInterface;

class HomeController extends Controller
{

    private DocumentSendRepositoryInterface $repository;
    private DisplayInterface $historic;

    public function __construct(
        DocumentSendRepositoryInterface $repository,
        DisplayInterface $historic
        )
    {
        $this->historic = $historic;
        $this->repository = $repository;
    }

    public function index()
    {
        $documents = $this->repository->getDocumentsOf(Auth::user(), false);
        return view('dashboard')->with('documents',$documents);
    }

    public function store(DocumentSendRequest $request)
    {
        $user_name = $request->user;
        foreach($request->id as $document_id){
            $this->repository->sendDocument($user_name, $document_id);
        }
        return redirect()->route('dashboard');
    }

    public function entryPoint()
    {
        $documents = $this->repository->getDocumentsOf(Auth::user(),true);
        return view('entry')->with('documents',$documents);
    }

    public function aceptDocument(AceptDocumentRequest $request)
    {
        $user = Auth::user()->name;
        foreach($request->id as $document){
            $this->repository->aceptDocument($user,$document);
        }
        return redirect()->route('entry')->with('message','Documento(s) aceito(s) com sucesso');
    }

    public function searchFrom(Request $request)
    {
        $request->validate(['number'=>'required'],['number.required'=>'nenhum item encontrado']);
        $historics = $this->historic->getCronogram($request->number);
        return view('historic')->with('historics',$historics);
    }

    public function createDocument()
    {
        return view('new');
    }

    public function updateDocument(DocumentCreateRequest $request)
    {
        $doc = $request->except('token');
        $user = Auth::user()->name;
        $this->repository->newDocument($user, $doc);
        return redirect()->route('create')->with('message','documento criado com sucesso!');
    }
}
