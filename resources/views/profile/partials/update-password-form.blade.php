<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <x-text-field label="Current Password" id="current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" placeholder="Current Password" :errors="$errors->get('current_password')" />
        <x-text-field label="New Password" id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" placeholder="New Password" :errors="$errors->get('password')" />
        <x-text-field label="Password Confirmation" id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" placeholder="Password Confirmation" :errors="$errors->get('password_confirmation')" />

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

        </div>
    </form>
</section>
@if (session('status') === 'password-updated')
<script>
    swal("Password Updated", "Your password has been successfully updated. please use your new password next time you login.", "success");
</script>
@endif