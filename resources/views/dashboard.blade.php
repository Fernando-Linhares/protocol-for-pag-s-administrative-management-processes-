<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mesa de trabalho') }}
        </h2>
    </x-slot>

    @foreach ($errors->all() as $error)
    <div class="bg-red-400 p-4 flex justify-center text-white">
        {{$error}}
    </div>
    @endforeach
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                   
                    <form action="/dashboard/send" method="post">
                        @csrf
                            <div class="flex flex-col">
                                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <td>#</td>
                                                <td>documento</td>
                                                <td>assunto</td>
                                                <td>----</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($documents as $document)
                                            <tr>
                                                <td>
                                                    {{$document->doc->id}}
                                                </td>
                                                <td>
                                                    {{$document->doc->unit}}.{{$document->doc->number}}/{{$document->doc->date}}-{{$document->doc->vol}}
                                                </td>
                                                <td>
                                                    {{$document->doc->title}}
                                                </td>
                                                <td>
                                                    <input type="checkbox" value="{{$document->doc->id}}" name="id[]">
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <br>
                                    <hr>
                                    <br>
                                    <div class="p-3">
                                        <input type="text" name="user">
                                        <button type="submit" class="bg-blue-500 text-white p-2 rounded">Enviar</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
