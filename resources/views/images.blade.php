<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Images') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <input type="file" name="image" id="image" accept="image/*" multiple>
                    <hr>

                    <div class="p-6 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-5">
                        @forelse($images as $image)
                            <div class="rounded overflow-visible shadow-lg relative">
                                <div class="hidden sm:flex sm:items-center sm:ml-6 absolute right-2 top-2">
                                    <x-dropdown align="left" width="48">
                                        <x-slot name="trigger">
                                            <button class="flex items-center text-sm font-medium text-gray-100 hover:text-gray-300 hover:border-gray-300 focus:outline-none focus:text-gray-400 focus:border-gray-300 transition duration-150 ease-in-out">
                                                <div class="ml-1">
                                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                                    </svg>
                                                </div>
                                            </button>
                                        </x-slot>
                    
                                        <x-slot name="content">
                                            <!-- Make Image Public/Private -->
                                            <form method="POST" action="{{ route('images.update', $image -> id) }}">
                                                @csrf
                                                @method('patch')
                                                
                                                <input type="hidden" name="public" value="{{$image -> public ? 0 : 1}}">

                                                <x-dropdown-link :href="route('images.update', $image -> id)"
                                                        onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                                    {{ __($image -> public ? 'Make Private' : 'Make Public') }}
                                                </x-dropdown-link>
                                            </form>

                                            <!-- Delete Image -->
                                            <form method="POST" action="{{ route('images.destroy', $image -> id) }}">
                                                @csrf
                                                @method('delete')
                                                
                                                <x-dropdown-link class="text-red-500" :href="route('images.destroy', $image -> id)"
                                                        onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                                    {{ __('Delete') }}
                                                </x-dropdown-link>
                                            </form>
                                        </x-slot>
                                    </x-dropdown>
                                </div>

                                <img class="object-cover h-52 w-full rounded-t bg-gradient-to-r from-gray-400 via-gray-500 to-gray-500" onerror="this.src = this.src;" onmousedown="return false" src="{{route('images.show', $image -> id)}}" alt="" />

                                {{-- <x-modal title="Delete Image" confirm="Delete Image">Are you sure you want to permanently delete this image? This action is irreversible.</x-modal> --}}
                                
                                <div class="px-6 pt-4 pb-2">
                                    <span class="inline-block bg-gray-200 rounded-full px-2 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{$image -> public ? "Public" : "Private"}}</span>
                                    <span class="inline-block bg-gray-200 rounded-full px-2 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{$image -> created_at -> diffForHumans()}}</span>
                                </div>
                            </div>
                        @empty
                            <div class="rounded overflow-hidden border-2 col-start-1 col-end-6">
                                <div class="px-6 pt-4 pb-2 text-center">
                                    You haven't uploaded any images yet.
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('scripts')
        <script>
            FilePond.registerPlugin(FilePondPluginFileValidateType);

            const pond = FilePond.create(document.querySelector('input[id="image"]'));
            const ponda = document.querySelector('.filepond--root');

            pond.setOptions({
                onprocessfiles: () => {
                    window.location.reload();
                },
                acceptedFileTypes: ['image/*'],
                    
                server: {
                    url: '/images',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
            });
        </script>
    @endsection
</x-app-layout>

