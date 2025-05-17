@props(['project'])

<x-card class="h-full hover:bg-white">
    <div class="flex flex-row items-center justify-between h-full w-full">
        {{-- Project Information --}}
        <div class="flex flex-col justify-between h-full w-4/5">
            {{-- Title --}}
            <span class="text-lg font-bold truncate w-full block">{{ $project->title }}</span>

            {{-- Stacks --}}
            <div>
                @foreach ($project->stacksArray as $stack)
                    <span class="inline-block bg-blue-600 text-white text-xs px-2 py-0.5 rounded">
                        {{ $stack }}
                    </span>
                @endforeach
            </div>
        </div>

        {{-- Order Position --}}
        <div class="w-1/5 flex justify-end">
            <span class="text-2xl font-bold bg-primary text-white p-3 rounded-full">
                #{{ $project->order }}
            </span>
        </div>
    </div>
</x-card>
