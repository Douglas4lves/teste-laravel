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
            <div class="ml-4 flex items-center md:ml-6 gap-1">
                <a href="{{route('users.index')}}" class="flex items-center rounded-full p-1 px-4 gap-2 bg-gray-200">
                    <div class="bg-gray-300 rounded-full p-1">
                        <x-icons.user/>
                    </div>
                    <span class="text-gray-700 font-medium mr-2">
                    {{ auth()->user()?->name ?? 'Visitante' }}
                    </span>
                </a>
                               
                {{-- Dropdown / Logout --}}
                <form method="POST" action="{{ route('auth.logout') }}">
                    @csrf
                    <button type="submit" class="hover:bg-red-400 text-gray-600 hover:text-white p-1 rounded-full cursor-pointer">
                        <x-icons.logout/>
                    </button>
                </form>

            </div>

        </div>
    </div>
</header>