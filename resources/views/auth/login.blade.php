<x-layout>
    <x-slot:header>Sign in</x-slot:header>

    <x-form.form method="POST" action="/login">
        @csrf
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Log in into our application</h2>
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <x-form.field>
                        <x-form.label for="name">Username</x-form.label>
                        <div class="mt-2 gap-y-5">
                            <x-form.input name="username" required/>
                            <x-form.error name="username"/>
                        </div>
                    </x-form.field>

                    <x-form.field>
                        <x-form.label for="code">Password</x-form.label>
                        <div class="mt-2">
                            <x-form.input type="password" name="password" required/>
                            <x-form.error name="password"/>
                        </div>
                    </x-form.field>
                </div>
            </div>
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <x-form.button>{{__('Log In')}}</x-form.button>
        </div>
    </x-form.form>

</x-layout>
