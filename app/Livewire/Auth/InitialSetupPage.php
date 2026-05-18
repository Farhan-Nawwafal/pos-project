<?php

namespace App\Livewire\Auth;

use App\Models\Cabang;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class InitialSetupPage extends Component
{
    public string $title = 'Setup Awal';

    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $passwordConfirmation = '';

    public function mount(): mixed
    {
        if (User::exists()) {
            return redirect()->route('signin');
        }

        return null;
    }

    // public function setup(): mixed
    // {
    //     if (User::exists()) {
    //         return redirect()->route('signin');
    //     }

    //     $validated = $this->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'email', 'max:255', 'unique:users,email'],
    //         'password' => ['required', 'string', 'min:8', 'max:255', 'same:passwordConfirmation'],
    //         // 'passwordConfirmation' => ['required', 'string'],
    //     ]);

    //     DB::transaction(function () {

    //     });

    //     $user = User::query()->create([
    //         'name' => $validated['name'],
    //         'email' => $validated['email'],
    //         'password' => Hash::make($validated['password']),
    //         'role' => 'owner',
    //         'is_active' => true,
    //         'last_login_at' => now(),
    //     ]);

    //     Auth::login($user);
    //     request()->session()->regenerate();

    //     return redirect()->route('dashboard');
    // }

    public function setup()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|same:passwordConfirmation',
        ]);

        DB::transaction(function () {
            $cabang = Cabang::create([
                'name' => 'Kantor Pusat',
                'address' => 'Alamat Pusat',
                'is_active' => 'active',
            ]);

            $user = User::create([
                'cabang_id' => $cabang->id,
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'role' => 'owner',
                'is_active' => true,
                'last_login_at' => now(),
            ]);

            // 3. Beri Role Spatie (jika kamu pakai Spatie)
            $user->assignRole('owner');

            // Login otomatis setelah sukses
            auth()->login($user);
        });

        return redirect()->route('dashboard'); // Atau ke halaman manapun setelah login
    }

    public function render(): View
    {
        return view('livewire.auth.initial-setup-page')
            ->layout('layouts.fullscreen-layout', ['title' => $this->title]);
    }
}
