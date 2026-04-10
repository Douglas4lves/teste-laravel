<x-base-layout>
    <div class="p-6 bg-gray-100 min-h-screen">

        {{-- Cabeçalho --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Usuários</h1>
            <a href="{{ route('users.create') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Novo Usuário
            </a>
        </div>
        @if($errors->any())
            @foreach($errors->all() as $error)
            <p class="text-red-500">{{$error}}</p>
            @endforeach
        @endif
        <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-3">
            @csrf

            <input
                type="file"
                name="csv_file"
                accept=".csv"
                class="block text-sm text-gray-700 border border-gray-300 rounded-lg bg-gray-50 
                    file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-50 file:text-blue-700
                    hover:file:bg-blue-100"
            >

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition"
            >
                Importar
            </button>

        </form>

        {{-- Barra de pesquisa --}}
        <div class="mb-4">
            <form>
                <div class="flex">
                    <input type="text" name="search" placeholder="Pesquisar usuário..."
                        class="flex-1 p-2 border border-gray-300 rounded-l focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    <div class="flex gap-1">
                        <button type="submit" class="bg-blue-600 border rounded text-white">
                            <span>Pesquisar</span>
                        </button>
                        <a href="{{route('users.index')}}" class="bg-yellow-400 border rounded">
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
            <div class="p-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-base-layout>