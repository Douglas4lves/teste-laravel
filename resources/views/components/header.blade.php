<header>
    <div class="bg-white shadow mb-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between p-4">

            {{-- Logo / Nome do App --}}
            <div class="flex items-center gap-2">
                
                {{-- {{ route('dashboard') }} --}}
                <a href="{{route('home')}}" class="flex items-center gap-1 text-xl font-bold text-gray-800">
                    <span class="bg-gray-800 border rounded">
                        <x-icons.users/>
                    </span>
                    {{ config('app.name') }}
                </a>
            </div>

            {{-- Usuário logado --}}
            <div class="ml-4 flex items-center md:ml-6">
                <span class="text-gray-700 font-medium mr-2">
                    {{ auth()->user()?->name ?? 'Visitante' }}
                </span>

                
                {{-- Dropdown / Logout --}}
                <form method="POST" action="{{ route('auth.logout') }}">
                    @csrf
                    <button type="submit" class="hover:bg-red-400 text-gray-600 hover:text-white px-3 py-1 rounded-lg">
                        <x-icons.logout/>
                    </button>
                </form>

            </div>

        </div>
    </div>
</header>