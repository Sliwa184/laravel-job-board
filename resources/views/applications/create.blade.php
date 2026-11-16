<x-layout>
    <x-page-heading>Aplikuj na: {{ $job->title }}</x-page-heading>

    <x-forms.form method="POST" action="{{ route('applications.store', $job) }}" enctype="multipart/form-data">
        <x-forms.input label="Imię" name="first_name"/>
        <x-forms.input label="Nazwisko" name="last_name"/>

        <x-forms.divider/>

        <x-forms.input label="CV (PDF)" type="file" name="cv" accept="application/pdf"/>

        <x-forms.button>Wyślij aplikację</x-forms.button>
    </x-forms.form>
</x-layout>
