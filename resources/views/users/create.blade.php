<x-base-layout>
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white p-6 rounded-2xl shadow">

        <h2 class="text-2xl font-semibold text-center text-gray-700 tracking-tight mb-6">
            Criar Usuário
        </h2>
        @if ($errors->any())
            <div class="bg-red-400 p-3 text-white rounded">
                    {{ $errors->first() }}
                
            </div>
        @endif
    
        <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Nome -->
            <div>
                <label class="block text-sm font-medium mb-1">Nome</label>
                <input type="text" name="name"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-500
                    @error('name') border-red-500 @enderror">
            </div>
            @error('name')
                <div class="text-red-500">
                    {{ $errors->first('name') }}
                </div>
            @enderror

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-500
                    @error('email') border-red-500 @enderror">
            </div>
            @error('email')
                <div class="text-red-500">
                    {{ $errors->first('email') }}
                </div>
            @enderror

            <!-- Senha -->
            <div>
                <label class="block text-sm font-medium mb-1">Senha</label>
                <input type="password" name="password"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-500
                    @error('password') border-red-500 @enderror">
            </div>
            @error('password')
                <div class="text-red-500">
                    {{ $errors->first('password') }}
                </div>
            @enderror

            <!-- Confirmar Senha -->
            <div>
                <label class="block text-sm font-medium mb-1">Confirmar Senha</label>
                <input type="password" name="password_confirmation"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-500
                    @error('password') border-red-500 @enderror">
            </div>
            @error('password')
                <div class="text-red-500">
                    {{ $errors->first('password') }}
                </div>
            @enderror

            <!-- Data de Expiração -->
            <div>
                <label class="block text-sm font-medium mb-1">Data de Expiração</label>
                <input type="date" name="expires_at"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-500">
            </div>

            <!-- Admin -->
            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_admin" value="1"
                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-gray-500">
                <label class="text-sm">Administrador</label>
            </div>

            <!-- Botão -->
            <button type="submit" class="w-full gap-2 bg-gray-700 text-white p-2 rounded hover:bg-gray-900 cursor-pointer">
                Criar Usuário
            </button>
            <!-- Cancelar -->
            <a href="{{route('users.index')}}" class="block  text-center w-full bg-white text-gray-600 border border-gray-600 p-2 rounded hover:text-red-600 hover:bg-red-300 hover:border-red-300 ">
                Cancelar
            </a>   

        </form>
    </div>
</div>
</x-base-layout>