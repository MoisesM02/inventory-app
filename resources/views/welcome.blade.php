<x-layout>
    <x-slot:header>Main Page</x-slot:header>

    <x-grid-layout>
        @can('viewAny', App\Models\User::class)
            <x-card title="Users" :value="$usersCount">
                <x-slot:footer>
                    <x-link href="/users">Manage users</x-link>
                </x-slot:footer>
            </x-card>
        @endcan

    </x-grid-layout>
</x-layout>
