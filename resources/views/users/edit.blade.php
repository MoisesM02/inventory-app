<x-layout>
    <x-slot:header>Editing User</x-slot:header>

    <div class="m-auto max-w-7xl">
        <x-form.form method="POST" id="edit-form" class="md:w-[50vw] sm:w-[80vw]" action="/users/{{ $user->id }}">
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
        </x-form.form>
        <div class="flex flex-row justify-between my-4 md:w-[50vw] sm:w-[80vw] m-auto">
            <x-form.modal-confirm
                method="DELETE"
                :action="route('users.destroy', $user)"
            >
                <x-form.button :delete="true">Delete</x-form.button>
            </x-form.modal-confirm>
            <x-form.button form="edit-form">Save Changes</x-form.button>
        </div>
    </div>
    <x-flash-message/>
</x-layout>
