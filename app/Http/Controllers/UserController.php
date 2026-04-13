<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Jobs\ImportUserJob;
use App\Jobs\ImportUsersJob;
use App\Models\User;
use Exception;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request): View
    {
        $this->authorize('viewAny', User::class);     
        $search = $request->input('search');
        $users = User::query();

        if($search){
            $users->where(function($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $users->paginate(10)->appends(['search' => $search]);

        return view('users.index', compact('users'));
    }

    public function create(): View
    {
        return view ('users.create');
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $this->authorize('create', User::class);

        try {
            DB::beginTransaction();

            $validated = $request->validated();

            $validated['is_admin'] = $request->boolean('is_admin');
            User::create($validated);

            DB::commit();

            return redirect()
                ->route('users.index')
                ->with('success', 'Usuário criado com sucesso!');

        } catch (\Throwable $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors('Erro ao criar usuário.');
        }
    }

    public function edit(User $user)
    {

        $this->authorize('update', $user);
        return view ('users.edit', compact('user'));


    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $this->authorize('update', $user);

        try {
            DB::beginTransaction();

            $validated = $request->validated();

            $validated['is_admin'] = $request->boolean('is_admin');


            //Não preenche a senha caso estiver vazio
            if(empty($validated['password'])){
                unset($validated['password']);
            }
            $user->update($validated);

            DB::commit();

            return redirect()
                ->route('users.index')
                ->with('success', 'Usuário atualizado com sucesso!');

        } catch (\Throwable $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors('Erro ao criar usuário.');
        }

    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        try{
            DB::beginTransaction();
            $user->delete();
            DB::commit();

            return redirect()
                ->route('users.index')
                ->with('success', 'Usuário removido com sucesso');
        }catch(\Throwable $e){
            return back()
                ->withErrors('Erro ao remover usuário');
        }
        
    }

    public function import(Request $request)
    {
        try{
            $request->validate([
                'csv_file' => 'required|file|mimes:csv,txt|max:10240'
            ]);
            
            $path = $request->file('csv_file')->store('uploads');
            

            ImportUserJob::dispatch($path);
        
            return redirect()
                ->route('users.index')
                ->with('success', "Arquivo enviado e importação iniciada");
        }catch(\Throwable $e){
            return redirect()
                ->back()
                ->withErrors(['csv_file' => 'Erro ao processar arquivo.']);
        }
        

    }
    

}
