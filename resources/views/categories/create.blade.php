<x-layout>
    <x-slot:header>Create New Category</x-slot:header>
    <div class="md:w-[50vw] sm:w-[80vw]  flex-column space-y-3 m-auto">
        <x-form.form>
            <x-form.field>
                <x-form.label for="name">Name</x-form.label>
                <x-form.input name="name"/>
                <x-form.error name="name"/>
            </x-form.field>
        </x-form.form>
        <div class="flex flex-row-reverse">
            <x-form.button>Save</x-form.button>
        </div>
    </div>
</x-layout>
