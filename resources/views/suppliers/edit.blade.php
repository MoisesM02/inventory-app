<x-layout>
    <x-slot:header>Edit supplier info</x-slot:header>

    <div class="m-auto">
        <x-form.form method="POST" class="md:w-[50vw] sm:w-[80vw]" action="{{ route('suppliers.update', $supplier) }}">
            <x-form.field>
                <x-form.label for="name">Supplier Name</x-form.label>
                <x-form.input name="name" placeholder="Factory Inc." value="{{ $supplier->name }}"/>
                <x-form.error name="name"/>
            </x-form.field>
            <x-form.field>
                <x-form.label for="address">Address</x-form.label>
                <x-form.input name="address" placeholder="Av. Evergreen #22, Springfield" value="{{ $supplier->address }}"/>
                <x-form.error name="address"/>
            </x-form.field>
            <x-form.field>
                <x-form.label for="contact_person">Contact person</x-form.label>
                <x-form.input name="contact_person" placeholder="John Doe" value="{{ $supplier->contact_person }}"/>
                <x-form.error name="contact_person"/>
            </x-form.field>
            <x-form.field>
                <x-form.label for="email">Contact E-mail</x-form.label>
                <x-form.input name="email" placeholder="factory@inc.com" value="{{ $supplier->email }}"/>
                <x-form.error name="email"/>
            </x-form.field>
            <x-form.field>
                <x-form.label for="phone">Contact number</x-form.label>
                <x-form.input name="phone" placeholder="+5037777555" value="{{ $supplier->phone }}"/>
                <x-form.error name="phone"/>
            </x-form.field>
            <div class="flex flex-row justify-between my-4">
                <x-form.modal-confirm
                    title="Do you really want to delete this supplier?"
                    :action="route('suppliers.destroy', $supplier)"
                    method="DELETE"
                >
                <x-form.button form="delete-form" :delete="true">Delete</x-form.button>
                </x-form.modal-confirm>
                <x-form.button>Save changes</x-form.button>
            </div>
        </x-form.form>
    </div>




</x-layout>
