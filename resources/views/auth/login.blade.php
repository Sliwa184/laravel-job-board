<x-layout>
    <x-page-heading>Logowanie</x-page-heading>

    <x-forms.form method="POST" action="/login">
        <x-forms.input label="Email" name="email" type="email" />
        <x-forms.input label="Hasło" name="password" type="password" />

        <x-forms.button>Zaloguj się</x-forms.button>
    </x-forms.form>
</x-layout>
