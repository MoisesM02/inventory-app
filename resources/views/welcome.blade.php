<x-layout>
    <x-slot:header>Main Page</x-slot:header>
    <h1>Hello world!</h1>
    <x-grid-layout>
        @can('viewAny', App\Models\User::class)
            <x-card title="Users" :value="$usersCount">
                <x-slot:footer>
                    <x-link href="/users">Ver usuarios</x-link>
                </x-slot:footer>
            </x-card>
        @endcan
        
    </x-grid-layout>
</x-layout>
