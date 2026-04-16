<x-base-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
        {{-- Cabeçalho --}}
        <div class="flex flex-col mb-6">
            <h1 class="text-3xl font-semibold text-gray-800 tracking-tight mb-2">Usuários</h1>
            {{-- barra vertical --}}
            <div class="w-50 h-1 bg-blue-600"></div>
        </div>
        <div class="flex justify-between">
            {{-- Importação CSV --}}
            <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-3">
                @csrf
                <input type="file" name="csv_file" accept=".csv" class="block text-sm text-gray-700 border border-gray-300 rounded-lg bg-gray-50 
                        file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold
                        file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 cursor-pointer">
                    Importar
                </button>
            </form>

            {{-- Criar novo usuário --}}
            <a href="{{ route('users.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Novo Usuário
            </a>
        </div>

        @if(session('success'))
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-2 shadow-mds mb-4">
                <p>{{session('success')}}</p>
            </div>  
        @endif
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative toast">
                    <strong>Error:</strong>
                    <span class="block sm:inline"> {{$error}}</span>
                </div>
            @endforeach
        @endif

        {{-- Barra de pesquisa --}}
        <div class="mb-4 mt-4">
            <form>
                <div class="flex">
                    <input type="text" name="search" class="flex-1 p-2 border border-gray-300 rounded-l focus:outline-none 
                    focus:ring-2 focus:ring-blue-500" placeholder="Pesquisar usuário...">
                    <div class="flex gap-1">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 cursor-pointer">
                            <span>Pesquisar</span>
                        </button>
                        <a href="{{route('users.index')}}" class="bg-yellow-400 text-white px-4 py-2 rounded hover:bg-yellow-700">
                            <span>Limpar</span>
                        </a>

                    </div>
                </div>
            </form>
        </div>

        {{-- Tabela --}}
        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nome</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Expiração</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Editar</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Apagar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $user->name }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            {{ $user->expires_at ? $user->expires_at->format('d/m/Y') : 'Sem expiração' }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('users.edit', $user->id) }}" 
                               class="text-blue-600 hover:text-blue-800">Editar</a>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <form action="{{ route('users.destroy', $user) }}" method="POST" 
                            onsubmit="return confirm('Você tem certeza que deseja deletar o usuário {{$user->name}}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">Apagar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Paginação --}}
            <div class="p-4 ">
                {{ $users->links() }}               
            </div>
        </div>
    </div>
</x-base-layout>