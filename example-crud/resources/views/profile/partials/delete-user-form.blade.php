<section >
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Delete Account') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <!-- Button to trigger modal -->
    <button id="deleteAccountButton" class="btn btn-danger font-bold py-2 px-4 rounded cursor-pointer">
        {{ __('Delete Account') }}
    </button>

      {{-- Modal HTML --> --}}
    <div id="deleteAccountModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg p-6 space-y-6">
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                <div class="mt-6">
                    <label for="password" class="sr-only">{{ __('Password') }}</label>
                    <input type="password" id="password" name="password" class="mt-1 block w-3/4" placeholder="{{ __('Password') }}">
                    @error('password')
                        <div class="mt-2 text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="button" onclick="closeModal()" class="bg-gray-500 hover:bg-gray-600 text-black font-bold py-2 px-4 rounded">
                        {{ __('Cancel') }}
                    </button>
                    <button type="submit" class="ml-3 bg-red-600 hover:bg-red-700 text-black font-bold py-2 px-4 rounded">
                        {{ __('Delete Account') }}
                    </button>
                </div>
            </form>
        </div>
    </div> 

    <!-- Inline JavaScript for Modal -->
    <script>
        document.getElementById('deleteAccountButton').addEventListener('click', function() {
            document.getElementById('deleteAccountModal').style.display = 'flex';
        });

        function closeModal() {
            document.getElementById('deleteAccountModal').style.display = 'none';
        }
    </script>
</section>
