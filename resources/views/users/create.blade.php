<x-base-layout>
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white p-6 rounded-2xl shadow">

        <h2 class="text-2xl font-semibold text-center mb-6">
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
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500
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
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500
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
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500
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
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500
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
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Admin -->
            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_admin" value="1"
                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <label class="text-sm">Administrador</label>
            </div>

            <!-- Botão -->
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                Criar Usuário
            </button>
            <!-- Cancelar -->
            <a href="{{route('users.index')}}" class="block w-full bg-red-500 rounded-lg text-center text-lg text-white hover:bg-red-700 transition py-1 ">
                Cancelar
            </a>   

        </form>
    </div>
</div>
</x-base-layout>