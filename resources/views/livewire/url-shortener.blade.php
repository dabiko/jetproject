<div>
    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
        <x-application-logo class="block h-12 w-auto" />

        <h1 class="mt-8 text-2xl font-medium text-gray-900">
            URL Shortener list
        </h1>
        @if (session()->has('message'))
        <div class="w-1/2 mb-0 mt-3 ml-80 content-center border bg-blue-500 text-white px-4 py-3 rounded relative" role="alert" x-data="{show: true}" x-show="show">
            <strong class="font-bold">{{ session('message')}}</strong>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg @click="show = false" class="fill-current h-6 w-6 text-white-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <title>Close</title>
                    <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                </svg>
            </span>
        </div>
        @endif
        <p class="mt-6 text-gray-500 leading-relaxed">
            Care about people's approval and you will be their prisoner.
        </p>


        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="block mb-5">
                <x-info-button wire:click="confirmUrlAdd">
                    <x-add-icon /> {{ __('Shorten Url') }}
                </x-info-button>
            </div>
        </div>

        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 w-full">
                            <thead>
                                <tr>
                                    <th scope="col" width="50" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">

                                        <button wire:click="">ID</button>
                                    </th>

                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">

                                        <button wire:click="">
                                            ORIGINAL URL
                                        </button>
                                    </th>

                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">

                                        <button wire:click="">
                                            SHORTEN URL
                                        </button>
                                    </th>

                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">

                                        <button wire:click="">
                                            VIEWS
                                        </button>
                                    </th>


                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        CREATE DATE
                                    </th>


                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        UPDATE DATE
                                    </th>

                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ACTION
                                    </th>

                                    </th>
                                </tr>
                            </thead>


                            <!-- @if($urls['total'] == 0)
                            <x-empty-table/>
                            @endif -->

                            <tbody class="bg-white divide-y divide-gray-200 text-center">
                                @foreach ($urls as $url)

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $url->id }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-left text-gray-900">
                                    {{ $url->original_url }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-left text-gray-900">
                                    {{ $url->shorten_url }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $url->clicks }}
                                </td>


                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $url->created_at }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $url->updated_at }}
                                </td>



                                <td class=" flex px-6 py-4 whitespace-nowrap text-sm font-medium">

                                    <x-info-button wire:click="confirmUrlView( {{ $url->id }} )">
                                        <x-view-icon />
                                    </x-info-button>

                                    <x-info-button wire:click="confirmUrlUpdate( {{ $url->id }} )">
                                        <x-edit-icon />
                                    </x-info-button>

                                    <x-delete-button wire:click="confirmUrlDelete( {{ $url->id }} )">
                                        <x-delete-icon />
                                    </x-delete-button>

                                </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-5">{{ $urls->links() }}</div>
                </div>
            </div>
        </div>

        <!-- Add URL Confirmation Modal -->
        <x-dialog-modal wire:model="confirmingUrlAdd">
            <x-slot name="title">
                {{ ('Shorten your Url')}}
            </x-slot>

            <x-slot name="content">
                <!-- Item Name -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="original_url" value="{{ __('URL') }}" />
                    <x-input id="original_url" type="url" class="mt-1 block w-full" wire:model.defer="original_url" />
                    <x-input-error for="original_url" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingUrlAdd')" wire:loading.attr="disabled">
                    <x-cancel-icon /> {{ __('Cancel') }}
                </x-secondary-button>

                <x-button class="ml-3" wire:click="store()" wire:loading.attr="disabled">
                    <x-add-icon /> {{ __('Add') }}
                </x-button>
            </x-slot>
        </x-dialog-modal>

        <!-- View URL Confirmation Modal -->
        <x-dialog-modal wire:model="confirmingUrlView">
            <x-slot name="title">
                {{ ('View  Url')}}
            </x-slot>

            <x-slot name="content">
                <!--  Url -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="url_id" value="{{ __('URL ID') }}" />
                    <x-input disabled="true" id="url_id" type="url" class="mt-1 block w-full" wire:model.defer="url_id" />
                    <x-input-error for="url_id" class="mt-2" />
                </div>

                <!--  ORI Url -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="original_url" value="{{ __('ORIGINAL URL') }}" />
                    <x-input disabled="true" id="original_url" type="url" class="mt-1 block w-full" wire:model.defer="original_url" />
                    <x-input-error for="original_url" class="mt-2" />
                </div>

                <!-- SHORT  Url -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="shorten_url" value="{{ __('SHORTEN URL') }}" />
                    <x-input disabled="true" id="shorten_url" type="url" class="mt-1 block w-full" wire:model.defer="shorten_url" />
                    <x-input-error for="shorten_url" class="mt-2" />
                </div>


            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingUrlView')" wire:loading.attr="disabled">
                    <x-cancel-icon /> {{ __('Cancel') }}
                </x-secondary-button>


            </x-slot>
        </x-dialog-modal>

        <!-- Update URL Confirmation Modal -->
        <x-dialog-modal wire:model="confirmingUrlUpdate">
            <x-slot name="title">
                {{ ('Update  Url')}}
            </x-slot>

            <x-slot name="content">
                <!--  Url -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="original_url" value="{{ __('URL') }}" />
                    <x-input id="original_url" type="url" class="mt-1 block w-full" wire:model.defer="original_url" />
                    <x-input-error for="original_url" class="mt-2" />
                </div>

            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingUrlUpdate')" wire:loading.attr="disabled">
                    <x-cancel-icon /> {{ __('Cancel') }}
                </x-secondary-button>

                <x-button class="ml-3" wire:click="update( {{ $confirmingUrlUpdate }})" wire:loading.attr="disabled">
                    <x-update-icon /> {{ __('Update') }}
                </x-button>
            </x-slot>
        </x-dialog-modal>

        <!-- Delete URL Confirmation Modal -->
        <x-confirmation-modal wire:model="confirmingUrlDelete">
            <x-slot name="title">
                {{ ('Delete Url')}}
            </x-slot>

            <x-slot name="content">
                <!-- Item Name -->
                {{ ('Are you sure you want to delete this URL?')}}
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingUrlDelete')" wire:loading.attr="disabled">
                    <x-cancel-icon /> {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3" wire:click="destroy({{ $confirmingUrlDelete }})" wire:loading.attr="disabled">
                    <x-delete-icon /> {{ __('Delete') }}
                </x-danger-button>
            </x-slot>
        </x-confirmation-modal>


    </div>
</div>