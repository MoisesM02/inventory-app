<x-layout>

    <x-table.layout
        title="Users"
        description="Manage all users in the platforms and their roles"
    >
        <x-slot:button>
            <x-modals.trigger name="create-user">
                Add user
            </x-modals.trigger>
        </x-slot:button>

    </x-table.layout>
    <x-modals.form action="/users" name="create-user" title="Create new user">
        <x-form.field>
            <x-form.label for="username">Username</x-form.label>
            <div class="mt-2">
                <x-form.input name="username" placeholder="JD001" required/>
                <x-form.error name="username"/>
            </div>
        </x-form.field>
        <x-form.field>
            <x-form.label for="password">Password</x-form.label>
            <div class="mt-2">
                <x-form.input name="password" type="password" required/>
                <x-form.error name="password"/>
            </div>
        </x-form.field>
        <x-form.field>
            <x-form.label for="password_confirmation">Password Confirmation</x-form.label>
            <div class="mt-2">
                <x-form.input name="password_confirmation" type="password" required/>
                <x-form.error name="password_confirmation"/>
            </div>
        </x-form.field>
        <x-form.field>
            <x-form.label for="role">User Role</x-form.label>
            <div class="mt-2">
                <x-form.select name="role">
                    @foreach (\App\Enums\UserRoles::cases() as $role)
                        <option value="{{ $role->value }}"> {{ $role->label() }} </option>
                    @endforeach
                </x-form.select>
                <x-form.error name="role"/>
            </div>
        </x-form.field>
    </x-modals.form>
    <x-flash-message />
</x-layout>