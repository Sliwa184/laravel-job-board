@props(['job'])

<x-panel class="flex flex-col text-center">
    <div class="self-start">{{ $job->employer->name }}</div>
    <div class="py-8">
        <h3 class="group-hover:text-blue-800 text-xl font-bold transition-colors  duration-400">
            <a href="{{ $job->url }}" target="_blank">
                {{ $job->title }}
            </a>
        </h3>
        <p class="text-sm mt-2">{{ $job->salary }}</p>
        @auth
            @if(auth()->user()->role === 'candidate')
                <a href="{{ route('applications.create', $job) }}" class="btn btn-primary">
                    <x-forms.button>Aplikuj</x-forms.button>
                </a>
            @endif

                @if(auth()->user()->role === 'employer' && auth()->user()->employer->id === $job->employer_id)

                    <div class="mt-6 flex justify-center items-center gap-4">

                        <a href="{{ route('jobs.edit', $job) }}">
                            <x-forms.button
                                class="bg-blue-500 hover:bg-blue-600 transition duration-200 hover:scale-105 shadow-sm hover:shadow-md">
                                Edytuj
                            </x-forms.button>
                        </a>

                        <form action="{{ route('jobs.destroy', $job) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <x-forms.button
                                type="submit"
                                onclick="return confirm('Na pewno usunąć ofertę?')"
                                class="bg-red-500 hover:bg-red-600 transition duration-200 hover:scale-105 shadow-sm hover:shadow-md">
                                Usuń
                            </x-forms.button>
                        </form>

                    </div>
                @endif

        @endauth
    </div>

    <div class="flex justify-between items-center mt-auto">
        <div>
            @foreach($job->tags as $tag)
                <x-tag :$tag size="small"/>
            @endforeach
        </div>

        <x-employer-logo :employer="$job->employer" :width="42"/>
    </div>
</x-panel>
