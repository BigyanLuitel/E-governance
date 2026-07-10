<x-guest-layout>
    <div class="max-w-md mx-auto mt-10 bg-white border border-gray-200 sm:rounded-md p-8">

        <div class="flex items-center gap-3 mb-6 pb-6 border-b border-gray-100">
            <div class="w-10 h-10 rounded-full border-2 border-navy-900 flex items-center justify-center shrink-0">
                <span class="font-bold text-navy-900 text-xs">WO</span>
            </div>
            <div>
                <p class="font-bold text-navy-900 leading-tight">Ward Office Portal</p>
                <p class="text-ink-600 text-xs leading-tight">Register as a citizen</p>
            </div>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-ink-900 mb-1">Full Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}"
                    class="block w-full rounded-md border-gray-300 text-sm" required autofocus autocomplete="name">
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-ink-900 mb-1">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                    class="block w-full rounded-md border-gray-300 text-sm" required autocomplete="username">
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-ink-900 mb-1">Password</label>
                <input id="password" type="password" name="password"
                    class="block w-full rounded-md border-gray-300 text-sm" required autocomplete="new-password">
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-ink-900 mb-1">Confirm
                    Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation"
                    class="block w-full rounded-md border-gray-300 text-sm" required autocomplete="new-password">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
            </div>

            <button type="submit"
                class="w-full bg-navy-900 text-white px-4 py-2.5 text-sm font-medium hover:bg-navy-800">
                Create Account
            </button>
        </form>

        <p class="text-sm text-ink-600 mt-6 pt-6 border-t border-gray-100 text-center">
            Already registered?
            <a href="{{ route('login') }}" class="text-navy-700 font-medium hover:underline">Sign in here</a>
        </p>
    </div>
</x-guest-layout>