<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = request()->get('order') ?? '';
        $search = request()->get('search') ?? '';
        $quantityPaginate = request()->get('p') ? request()->get('p') : 10;
        if ($search) {
            $users = User::where('name', 'like', '%'. $search. '%')
                ->orWhere('name', 'like', $search. '%')
                ->orWhere('email', 'like', $search. '%')
                ->orWhere('email', 'like', '%'. $search. '%');
        } else {
            $users = User::query();
        }
        if ($order) {
            $segments = Str::of($order)->split('/-/');
            $descOrAsc = $segments[1] === 'up' ? 'desc' : 'asc';
            $users = $users->orderBy($segments[0], $descOrAsc)->paginate($quantityPaginate);
        } else {
            $users = $users->paginate($quantityPaginate);
        }
        return view('users/index',
            [
                'users' => $users,
                'quantityPaginate' => $quantityPaginate,
                'search' => $search
            ]
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function json()
    {
        $users = User::all();
        return response()->json(
            [
                'users' => $users
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validated();
        User::create($validated);
        return to_route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return response()->json([
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();
        if ($validated['password'] == null) {
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->save();
        } else {
            $user->update($validated);
        }
        return to_route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['success' => true]);
    }
}
