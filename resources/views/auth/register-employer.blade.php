<x-layout>
    <x-page-heading>Rejestracja pracodawcy</x-page-heading>

    <x-forms.form method="POST" action="/register/employer" enctype="multipart/form-data">
        <x-forms.input label="Twoje imie" name="name" />
        <x-forms.input label="Email" name="email" type="email" />
        <x-forms.input label="Hasło" name="password" type="password" />
        <x-forms.input label="Powtórz hasło" name="password_confirmation" type="password" />

        <x-forms.divider/>

        <x-forms.input label="Nazwa pracodawcy" name="company_name" />
        <x-forms.input label="Logo pracodawcy" name="logo" type="file" />

        <x-forms.button>Utwórz konto</x-forms.button>
    </x-forms.form>
</x-layout>

