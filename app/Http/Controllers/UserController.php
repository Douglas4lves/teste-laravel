<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    use AuthorizesRequests;

    public function index(): View
    {
        $this->authorize('viewAny', User::class);
        $users = User::all();
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

}
