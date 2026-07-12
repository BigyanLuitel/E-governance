<x-guest-layout>
    <div class="bg-white border border-gray-200 sm:rounded-md p-8">

        <h2 class="font-bold text-navy-900 text-lg mb-6">Sign In</h2>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-ink-900 mb-1">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                    class="block w-full rounded-md border-gray-300 text-sm" required autofocus autocomplete="username">
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-ink-900 mb-1">Password</label>
                <input id="password" type="password" name="password"
                    class="block w-full rounded-md border-gray-300 text-sm" required autocomplete="current-password">
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center text-sm text-ink-600">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 me-2">
                    Remember me
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-navy-700 hover:underline">
                        Forgot password?
                    </a>
                @endif
            </div>

            <button type="submit"
                class="w-full bg-navy-900 text-white px-4 py-2.5 text-sm font-medium hover:bg-navy-800">
                Sign In
            </button>
        </form>

        @if (Route::has('register'))
            <p class="text-sm text-ink-600 mt-6 pt-6 border-t border-gray-100 text-center">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-navy-700 font-medium hover:underline">Register here</a>
            </p>
        @endif
    </div>
</x-guest-layout>