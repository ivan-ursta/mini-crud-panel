<?php

// app/Http/Controllers/UserController.php
namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $authUser;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->authUser = Auth::user();
            return $next($request);
        });
    }

    public function index()
    {
        if ($this->authUser->role == 'admin') {
            $users = User::where('id', '!=', $this->authUser->id)->get();
        } elseif ($this->authUser->role == 'team_lead') {
            $users = $this->authUser->mentees;
        } elseif ($this->authUser->role === 'buyer') {
            $entities = $this->authUser->entities;
            return view('users.buyer', compact('entities'));
        } else {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $user = $this->authUser;
        return view('users.create', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:' . ($this->authUser->role === 'admin' ? 'team_lead' : 'buyer'),
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role = $request->input('role');
        $user->mentor_id = $this->authUser->id;
        $user->save();

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        $mentees = $user->role === 'team_lead' ? $user->mentees : null;
        $entities = $user->role === 'buyer' ? $user->entities : null;
        return view('users.show', compact('user', 'mentees', 'entities'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'))->with('authUser', $this->authUser);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'mentor_id' => 'nullable|exists:users,id',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->input('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->mentor_id = $request->input('mentor_id');
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User has been deleted.');
    }
}

