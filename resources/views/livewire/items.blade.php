<div>
    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
        <x-application-logo class="block h-12 w-auto" />

        <h1 class="mt-8 text-2xl font-medium text-gray-900">
            Items table list
        </h1>

        <p class="mt-6 text-gray-500 leading-relaxed">
            Explain......
        </p>
    </div>

    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="block mb-5">
            <x-info-button wire:click="confirmItemAddition">
                {{ __('Add Item') }}
            </x-info-button>
        </div>

        <div class="block mt-1 mb-4">
            <label for="active_only" class="flex items-center">
                <x-checkbox wire:model="active" class="ml-90" id="active" name="active" />
                <span class="ml-2 text-sm text-gray-600">{{ __('Active Only') }}</span>
            </label>
        </div>

        <form>
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <x-search-icon />
                <input wire:model.debounce.500ms="search" type="search" id="search" class="block mb-8 w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 white:bg-gray-700 white:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Names and Price...">
            </div>
        </form>


        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 w-full">
                            <thead>
                                <tr>
                                    <th scope="col" width="50" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <x-sort-icon sortField="id" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                                        <button wire:click="sortBy('id')">ID</button>
                                    </th>

                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <x-sort-icon sortField="name" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                                        <button wire:click="sortBy('name')">
                                            NAME
                                        </button>
                                    </th>

                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <x-sort-icon sortField="price" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                                        <button wire:click="sortBy('price')">
                                            PRICE
                                        </button>
                                    </th>

                                    @if(!$active)
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        STATUS
                                    </th>
                                    @endif

                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ACTION
                                    </th>

                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 text-center">
                                @foreach ($items as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $item->id }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $item->name }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $item->price }}
                                    </td>

                                    @if(!$active)
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $item->status ? 'Active' : 'Not Active' }}
                                    </td>
                                    @endif

                                    <td class=" flex px-6 py-4 whitespace-nowrap text-sm font-medium">

                                        <x-info-button>
                                            <x-view-icon />
                                        </x-info-button>

                                        <x-info-button>
                                            <x-edit-icon />
                                        </x-info-button>

                                        <x-delete-button wire:click="confirmItemDeletion( {{ $item->id }} )">
                                            <x-delete-icon />
                                        </x-delete-button>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-5">{{ $items->links() }}</div>
                </div>
            </div>
        </div>
    </div>


    <!-- Add Item Confirmation Modal -->
    <x-dialog-modal wire:model="confirmingItemAddition">
        <x-slot name="title">
            {{ __('Add New Item') }}
        </x-slot>

        <x-slot name="content">
            <!-- Item Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" />
                <x-input-error for="name" class="mt-2" />
            </div>

            <!-- Price -->
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-label for="price" value="{{ __('Price') }}" />
                <x-input id="price" type="text" class="mt-1 block w-full" wire:model.defer="price" />
                <x-input-error for="price" class="mt-2" />
            </div>

            <!-- Status -->
            <div class="block mt-4">
                <label for="active_only" class="flex items-center">
                    <x-checkbox value="0" wire:model.defer="status" class="ml-90" id="status" name="status" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Status') }}</span>
                    <x-input-error for="status" class="mt-2" />
                </label>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingItemAddition')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-3" wire:click="saveItem()" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>



    <!-- Delete Item Confirmation Modal -->
    <x-dialog-modal wire:model="confirmingItemDeletion">
        <x-slot name="title">
            {{ __('Delete Item') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this item? ') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingItemDeletion')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ml-3" wire:click="deleteItem( {{ $confirmingItemDeletion }} )" wire:loading.attr="disabled">
                {{ __('Delete Item') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>

</div>