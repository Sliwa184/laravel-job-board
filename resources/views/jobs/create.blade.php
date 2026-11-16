<x-layout>
    <x-page-heading>Nowa Praca</x-page-heading>

    <x-forms.form method="POST" action="/jobs">
        <x-forms.input label="Nazwa" name="title" placeholder="CEO" />
        <x-forms.input label="Wypłata" name="salary" placeholder="50 000 PLN" />
        <x-forms.input label="Lokalizacja" name="location" placeholder="Wrocław" />

        <x-forms.select label="Tryb pracy" name="schedule">
            <option>Full Time</option>
            <option>Part Time</option>
        </x-forms.select>

        <x-forms.input label="URL" name="url" placeholder="https://twojastrona.com/praca/stanowisko" />
        <x-forms.checkbox label="Wyróżnienie (Płatne)" name="featured" />

        <x-forms.divider />

        <x-forms.input label="Tagi (oddzielone przecinkiem)" name="tags" placeholder="IT, video, Edukacja" />

        <x-forms.button>Dodaj</x-forms.button>
    </x-forms.form>
</x-layout>
