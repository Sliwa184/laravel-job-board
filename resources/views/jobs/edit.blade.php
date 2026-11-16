<x-layout>

    <x-page-heading>Edytuj ofertę</x-page-heading>

    <x-forms.form method="POST" action="{{ route('jobs.update', $job) }}">
        @csrf
        @method('PATCH')

        <x-forms.input label="Tytuł" name="title" :value="$job->title" />
        <x-forms.input label="Wynagrodzenie" name="salary" :value="$job->salary" />
        <x-forms.input label="Lokalizacja" name="location" :value="$job->location" />
        <x-forms.input label="Tryb pracy" name="schedule" :value="$job->schedule" />
        <x-forms.input label="Link aplikacyjny" name="url" :value="$job->url" />

        <x-forms.button>Zapisz zmiany</x-forms.button>
    </x-forms.form>

</x-layout>
