<header>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            {{-- Logo / Nome do App --}}
            <div class="flex-shrink-0">
                {{-- {{ route('dashboard') }} --}}
                <a href="#" class="text-xl font-bold text-gray-800">
                    {{ config('app.name') }}
                </a>
            </div>

            {{-- Espaço para links, se necessário --}}
            <nav class="hidden md:flex space-x-4">
                <!-- Links adicionais podem ser colocados aqui -->
            </nav>

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