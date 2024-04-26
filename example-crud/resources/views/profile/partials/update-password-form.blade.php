<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="POST" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="update_password_current_password" class="block font-medium text-sm text-gray-700">{{ __('Current Password') }}</label>
            <input type="password" id="update_password_current_password" name="current_password" class="mt-1 block w-full" autocomplete="current-password">
            @error('current_password')
                <div class="mt-2 text-red-600">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div>
            <label for="update_password_password" class="block font-medium text-sm text-gray-700">{{ __('New Password') }}</label>
            <input type="password" id="update_password_password" name="password" class="mt-1 block w-full" autocomplete="new-password">
            @error('password')
                <div class="mt-2 text-red-600">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block font-medium text-sm text-gray-700">{{ __('Confirm Password') }}</label>
            <input type="password" id="update_password_password_confirmation" name="password_confirmation" class="mt-1 block w-full" autocomplete="new-password">
            @error('password_confirmation')
                <div class="mt-2 text-red-600">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{ __('Save') }}</button>

            @if (session('status') == 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
