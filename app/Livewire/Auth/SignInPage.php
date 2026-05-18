<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class SignInPage extends Component
{
    public string $title = 'Sign In';

    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    public function mount(): mixed
    {
        // Jika belum ada user → redirect ke setup
        if (!User::exists()) {
            return redirect()->route('setup');
        }

        return null;
    }

    public function signIn(): mixed
    {
        $validated = $this->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
            'remember' => ['boolean'],
        ]);

        $user = User::query()->where('email', $validated['email'])->first();

        // ❌ Akun tidak aktif
        if ($user && !$user->is_active) {
            $msg = 'Akun dinonaktifkan.';
            throw ValidationException::withMessages([
                'email' => $msg,
                'password' => $msg,
            ]);
        }

        $ok = false;

        try {
            $ok = Auth::attempt(
                [
                    'email' => $validated['email'],
                    'password' => $validated['password'],
                ],
                (bool) $validated['remember'],
            );
        } catch (\Throwable) {
            $ok = false;
        }

        // 🔄 Handle password lama (plain text → auto hash)
        if (!$ok && $user) {
            $stored = (string) $user->password;
            $input = (string) $validated['password'];

            if (!str_starts_with($stored, '$') && hash_equals($stored, $input)) {
                $user->password = Hash::make($input);
                $user->save();

                Auth::login($user, (bool) $validated['remember']);
                $ok = true;
            }
        }

        // ❌ Login gagal
        if (!$ok) {
            $msg = 'Email atau password salah.';
            throw ValidationException::withMessages([
                'email' => $msg,
                'password' => $msg,
            ]);
        }

        // ✅ Sukses login
        request()->session()->regenerate();

        User::query()
            ->whereKey(Auth::id())
            ->update(['last_login_at' => now()]);

        return redirect()->intended(route('dashboard'));
    }

    public function render(): View
    {
        return view('livewire.auth.sign-in-page')
            ->layout('layouts.fullscreen-layout', ['title' => $this->title]);
    }
}
