<x-layout>
    <x-slot:header>Create new supplier</x-slot:header>

    <div class="m-auto">
        <x-form.form method="POST" class="md:w-[50vw] sm:w-[80vw]" action="/suppliers">
            @csrf
            <x-form.field>
                <x-form.label for="name">Supplier Name</x-form.label>
                <x-form.input name="name" placeholder="Factory Inc." value="{{ old('name') }}"/>
                <x-form.error name="name"/>
            </x-form.field>
            <x-form.field>
                <x-form.label for="address">Address</x-form.label>
                <x-form.input name="address" placeholder="Av. Evergreen #22, Springfield" value="{{ old('address') }}"/>
                <x-form.error name="address"/>
            </x-form.field>
            <x-form.field>
                <x-form.label for="contact_person">Contact person</x-form.label>
                <x-form.input name="contact_person" placeholder="John Doe" value="{{ old('contact_person') }}"/>
                <x-form.error name="contact_person"/>
            </x-form.field>
            <x-form.field>
                <x-form.label for="email">Contact E-mail</x-form.label>
                <x-form.input name="email" placeholder="factory@inc.com" value="{{ old('email') }}"/>
                <x-form.error name="email"/>
            </x-form.field>
            <x-form.field>
                <x-form.label for="phone">Contact number</x-form.label>
                <x-form.input name="phone" placeholder="+5037777555" value="{{ old('phone') }}"/>
                <x-form.error name="phone"/>
            </x-form.field>

            <div class="flex flex-row justify-end my-4">
                <x-form.button>Save</x-form.button>
            </div>
        </x-form.form>
    </div>




</x-layout>
