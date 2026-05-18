<div class="relative flex min-h-screen w-full flex-col bg-white" style="background-color: #ECECEC">
    <header
        class="top-0 right-0 z-10 flex justify-end items-center gap-6 p-6 text-sm font-medium text-gray-500 bg-white shadow-md">
        <div class="flex items-center gap-2">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
            </span>
            <span class="text-gray-700">Online</span>
        </div>

        <div class="text-gray-400">
            Versi 1.33.1
        </div>

        <div class="text-gray-900 border-l border-gray-200 pl-6">
            ESB Order
        </div>
    </header>

    <div class="flex flex-1 flex-col lg:flex-row">
        <div class="flex w-full flex-1 flex-col lg:w-1/2">
            <div class="mx-auto flex w-full max-w-md flex-1 flex-col justify-center p-6">

                <div class="w-full rounded-3xl border border-gray-100 bg-white p-8 shadow-2xl shadow-black/50 sm:p-12">

                    <div class="mb-10 flex flex-col items-center">
                        <div class="mb-6">
                            <img src="{{ url('./assets/images/esb-removebg.png') }}" class="h-14 w-auto object-contain">
                        </div>
                        <h1 class="mb-2 text-center text-2xl font-bold tracking-tight text-gray-900">
                            Selamat Datang
                        </h1>
                        <p class="text-center text-sm text-gray-500">
                            Silakan masuk ke akun anda
                        </p>
                    </div>

                    <form wire:submit="signIn" class="space-y-6">

                        {{-- EMAIL --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-gray-700">
                                Email Address
                            </label>
                            <input 
                                wire:model.live="email" 
                                type="email"
                                class="h-12 w-full rounded-xl border px-4 text-sm transition-all focus:ring-4
                                @error('email') border-red-500 focus:ring-red-500/20 @else border-gray-200 focus:border-brand-500 focus:ring-brand-500/10 @enderror"
                                style="background-color: #F5F5F5"
                                placeholder="nama@toko.com" 
                            />

                            @error('email')
                                <p class="text-red-500 text-xs mt-2 flex items-center gap-1">
                                    ⚠ {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- PASSWORD --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-gray-700">
                                Password
                            </label>

                            <div x-data="{ showPassword: false }" class="relative">
                                <input 
                                    wire:model.live="password"
                                    :type="showPassword ? 'text' : 'password'"
                                    class="h-12 w-full rounded-xl border px-4 text-sm transition-all focus:ring-4
                                    @error('password') border-red-500 focus:ring-red-500/20 @else border-gray-200 focus:border-brand-500 focus:ring-brand-500/10 @enderror"
                                    style="background-color: #F5F5F5"
                                    placeholder="Masukkan password"
                                />

                                <button type="button" @click="showPassword = !showPassword"
                                    class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-brand-500">
                                    <span class="text-xs font-bold uppercase tracking-widest"
                                        x-text="showPassword ? 'Hide' : 'Show'"></span>
                                </button>
                            </div>

                            @error('password')
                                <p class="text-red-500 text-xs mt-2 flex items-center gap-1">
                                    ⚠ {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- BUTTON --}}
                        <button type="submit"
                            class="group relative flex h-12 w-full items-center justify-center overflow-hidden rounded-xl font-semibold text-white transition-all hover:opacity-90 active:scale-[0.98]"
                            style="background-color: #0B2F9F">
                            <span>Masuk</span>
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>