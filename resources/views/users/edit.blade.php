<x-layout>
    <x-slot:header>Editing User</x-slot:header>

    <div class="flex m-auto">
        <x-form.form method="POST" class="md:w-[50vw] sm:w-[80vw]" action="/users/{{ $user->id }}">
            @csrf
            @method('PATCH')
            <x-form.field class="">
                <x-form.label class="mb-1 font-bold" for="username">Username</x-form.label>
                <x-form.input  name="username" value="{{ $user->username }}" required/>
                <x-form.error name="username" />
            </x-form.field>
            <x-form.field class="">
                <x-form.label class="mb-1 font-bold" for="password">New Password</x-form.label>
                <x-form.input  name="password" type="password" />
                <x-form.error name="password" />
            </x-form.field>
            <x-form.field class="">
                <x-form.label class="mb-1 font-bold" for="username">Confirm Password</x-form.label>
                <x-form.input  name="password_confirmation" type="password"/>
                <x-form.error name="password_confirmation" />
            </x-form.field>
            <x-form.field>
                <x-form.label class="mb-1 font-bold" for="role">User Role</x-form.label>
                <x-form.select name="role">
                    @foreach(\App\Enums\UserRoles::cases() as $role)
                            <option value="{{ $role->value }}" {{ $role == $user->role ? 'selected' : '' }}> {{ $role->label() }} </option>
                    @endforeach
                </x-form.select>
                <x-form.error name="role" />
            </x-form.field>
            <div class="mt-4 flex justify-end">
                <x-form.button>Save Changes</x-form.button>
            </div>
        </x-form.form>
    </div>
    <x-flash-message/>
</x-layout>
