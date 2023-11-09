<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Delete Account
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
        </p>
    </header>

    <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">Delete Account</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="POST" action="{{ route('profile.destroy') }}" class="p-6 space-y-4">
            @csrf
            @method('DELETE')

            <div class="space-y-1">

                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Are you sure you want to delete your account?
                </h2>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
                </p>
            </div>

            <x-text-field label="Password" id="password" name="password" type="password" placeholder="Password" :errors="$errors->userDeletion->get('password')" />

            <div class="flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')" type="button">
                    Cancel
                </x-secondary-button>

                <x-danger-button type="submit" class="ml-3">
                    Delete Account
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>