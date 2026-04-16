<header>
    <div class="bg-white shadow mb-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between p-4">

            {{-- Logo / Nome do App --}}
            <div class="flex items-center gap-2">
                
                {{-- {{ route('dashboard') }} --}}
                <a href="{{route('home')}}" class="text-xl font-bold text-gray-800">
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
                    <button type="submit" 
                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                        Sair
                    </button>
                </form>

            </div>

        </div>
    </div>
</header>