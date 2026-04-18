<x-base-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
        <div class="flex justify-between">
            <div class="flex flex-col mb-6">
                <h1 class="text-3xl font-semibold text-gray-700 tracking-tight mb-2">Usuários</h1>
                <p class="text-gray-700 opacity-60">Gerencie os membros da sua organização</p>
            </div>
            <div class="flex items-center gap-3">
                {{-- Importação CSV --}}
                <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data" class="flex ">
                    @csrf
                    <label class="flex items-center gap-2 cursor-pointer bg-white text-gray-600 border border-gray-600 px-4 py-2 rounded hover:bg-gray-200">
                        <span>
                            <x-icons.upload/>
                        </span>
                        Importar CSV
                        <input type="file" name="csv_file" class="hidden" onchange="this.form.submit()">
                    </label>
                </form>

                {{-- Criar novo usuário --}}
                <a href="{{ route('users.create') }}" class="flex items-center gap-2 bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-900">
                    <span>
                        <x-icons.plus/>
                    </span>
                    Novo Usuário
                </a>
            </div>
        </div>
        @if(session('success'))
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-2 shadow-mds mb-4 toast">
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
            <form method="GET" action="{{ route('users.index') }}">
                <div class="flex">
                    <input 
                        type="text" 
                        name="search" 
                        class="flex-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Pesquisar usuário..."
                    >
                    <a href="{{route('users.index')}}" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-900">
                            <span>Limpar</span>
                    </a>
                </div>
            </form>
        </div>

        {{-- Tabela --}}
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nome</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Expiração</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Ações</th>
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
                        <td class=" flex justify-center gap-2 p-4">
                            <a href="{{ route('users.edit', $user->id) }}" class="hover:bg-gray-300 text-gray-700 hover:text-gray-900 p-1 rounded-full">
                                <x-icons.edit/>
                            </a>
                            
                            <form action="{{ route('users.destroy', $user) }}" method="POST" 
                            onsubmit="return confirm('Você tem certeza que deseja deletar o usuário {{$user->name}}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="hover:bg-red-300 text-gray-700 hover:text-red-700 p-1 rounded-full cursor-pointer">
                                    <x-icons.trash/>
                                </button>
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