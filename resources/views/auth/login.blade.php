<x-layout :use-nav="false">
    <x-slot:header>Sign in</x-slot:header>

    <div class="flex justify-center items-center min-h-[50vh]">
        <div class="w-4/5 lg:w-2/3">

            <x-form.form method="POST" action="/login">
                @csrf
                <div class="border-b border-gray-900/10 pb-8">
                    <h2 class="text-xl font-semibold text-gray-900 text-center mb-6">Log in to our application</h2>

                    <div class="flex flex-col gap-y-6">

                        <x-form.field>
                            <x-form.label for="username">Username</x-form.label>
                            <div class="mt-2">
                                <x-form.input name="username" id="username" class="w-full" required/>
                                <x-form.error name="username"/>
                            </div>
                        </x-form.field>

                        <x-form.field>
                            <x-form.label for="password">Password</x-form.label>
                            <div class="mt-2">
                                <x-form.input type="password" name="password" id="password" class="w-full" required/>
                                <x-form.error name="password"/>
                            </div>
                        </x-form.field>

                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end">
                    <x-form.button class="w-full sm:w-auto">
                        {{ __('Log In') }}
                    </x-form.button>
                </div>
            </x-form.form>

        </div>
    </div>

</x-layout>
