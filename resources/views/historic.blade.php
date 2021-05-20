<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mesa de trabalho') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="/dashboard/acept" method="post">
                        @csrf

                            <div class="flex flex-col">
                                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <td>#</td>
                                                <td>nome</td>
                                                <td>aceito</td>
                                                <td>data</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($historics as $historic)
                                            <tr>
                                                <td>
                                                    {{$historic->id}}
                                                </td>
                                                <td>
                                                    {{$historic->user->name}}
                                                </td>
                                                <td>
                                                    {{$historic->acept?'recebido':'não recebido'}}                                                </td>
                                                <td>
                                                    {{str_replace('-','/',$historic->created_at)}}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
