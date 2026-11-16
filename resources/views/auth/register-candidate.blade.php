<x-layout>
    <x-page-heading>Rejestracja kandydata</x-page-heading>

    <x-forms.form method="POST" action="/register/candidate">
        <x-forms.input label="Imię" name="first_name" />
        <x-forms.input label="Nazwisko" name="last_name" />
        <x-forms.input label="Numer telefonu" name="phone" />

        <x-forms.divider />

        <x-forms.input label="Email" name="email" type="email" />
        <x-forms.input label="Hasło" name="password" type="password" />
        <x-forms.input label="Powtórz hasło" name="password_confirmation" type="password" />

        <x-forms.button>Utwórz konto</x-forms.button>
    </x-forms.form>
</x-layout>
