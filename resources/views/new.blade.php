<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Novo Documento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                        <form action="{{route('update')}}" method="post">
                            @csrf
                            <h4 class="flex justify-center">Título</h4>
                            <div class="flex justify-center">
                                <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="title" id="">
                            </div>
                            <br>
                            <h4 class="flex justify-center">Assunto</h4>
                            <div class="flex justify-center">
                                <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="content" id="">
                            </div>
                            <br>
                            <h4 class="flex justify-center">Número de protocolo de unidade</h4>
                            <div class="flex justify-center">
                                <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="number" name="unit" id="">
                            </div>
                            <br>
                            <h4 class="flex justify-center">Número do documento</h4>
                            <div class="flex justify-center">
                                <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="number" name="number" id="">
                            </div>
                            <br>
                            <h4 class="flex justify-center">Volume</h4>
                            <div class="flex justify-center">
                                <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="number" name="vol" id="">
                            </div>
                            <br>
                            <div class="flex justify-center">
                                <button class="p-3 bg-blue-500 text-white rounded" type="submit">salvar</button>
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
