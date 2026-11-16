@props(['job'])

<x-panel class="flex gap-x-6">
    <div>
        <x-employer-logo :employer="$job->employer" />
    </div>

    <div class="flex-1">
        <a href="#" class="self-start text-sm text-gray-400 transition-colors duration-300">{{ $job->employer->name }}</a>

            <h3 class="font-bold text-xl mt-3 transition-colors group-hover:text-blue-800">
                <a href="{{ $job->url }}" target="_blank">
                    {{ $job->title }}
                </a>
            </h3>

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

            <p class="text-sm text-gray-400 mt-auto">{{ $job->salary }}</p>
    </div>

    <div>
        @foreach($job->tags as $tag)
            <x-tag :$tag />
        @endforeach
    </div>
</x-panel>
