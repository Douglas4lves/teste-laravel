<x-auth-layout>
        <div class="min-h-screen flex items-center justify-center bg-gray-100">

        <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-md">
            <div class="flex justify-center mb-6">
                <div class="bg-blue-500 text-white rounded-lg p-4 text-xl font-bold">
                    <x-icons.login/>
                </div>
            </div>

            <div class=" text-center mb-6">
                <h2 class="text-4xl font-bold">
                    Bem-vindo
                </h2>
                <p>
                    Acesse sua conta para continuar
                </p>

            </div>
            

            @error('msg')
                <div class="text-red-700 bg-red-300 text-center toast">
                    {{ $errors->first('msg') }} 
                </div>       
            @enderror

            <form method="POST" action="{{route('auth.login')}}" class="space-y-4">
                @csrf

                <!-- Email -->
                <div>
                    <label class="block text-sm text-gray-600 mb-1 ">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        placeholder="your@gmail.com"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500
                        @error('email') border-red-500 @enderror"
                        required
                    >
                    @error('email')
                        <div class="text-red-500">
                            {{ $errors->first('email') }}
                        </div>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Senha</label>
                    <input 
                        type="password" 
                        name="password" 
                        placeholder="******"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500
                        @error('password') border-red-500 @enderror"
                        required
                    >
                    @error('password')
                        <div class="text-red-500">
                            {{ $errors->first('password') }}
                        </div>
                    @enderror
                </div>

                <button 
                    type="submit"
                    class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition"
                >
                    Entrar
                </button>
            </form>

        </div>
    </div>
</x-auth-layout>
