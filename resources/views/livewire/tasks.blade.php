    <div>
         <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
              <div class="block mb-8">
                   <x-info-button>
                        {{ __('Add Task') }}
                   </x-info-button>
              </div>
              <div class="flex flex-col">
                   <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                             <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                  <table class="min-w-full divide-y divide-gray-200 w-full">
                                       <thead>
                                            <tr>
                                                 <th scope="col" width="50" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                      ID
                                                 </th>
                                                 <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                      Description
                                                 </th>

                                                 <th scope="col" width="200" class="px-6 py-3 bg-gray-50">

                                                 </th>
                                            </tr>
                                       </thead>
                                       <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($tasks as $task)
                                            <tr>
                                                 <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                      {{ $task->id }}
                                                 </td>

                                                 <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                      {{ $task->description }}
                                                 </td>

                                                 <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">

                                                      <a href="" class="text-blue-600 hover:text-blue-900 mb-2 mr-2">
                                                           <x-view-icon />
                                                      </a>

                                                      <a href="" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">
                                                           <x-edit-icon />
                                                      </a>

                                                      <a href="" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">
                                                           <x-delete-icon />
                                                      </a>

                                                      <!-- <form class="inline-block" action="" method="POST" onsubmit="return confirm('Are you sure?');">
                                                           <input type="hidden" name="_method" value="DELETE">
                                                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                           <input type="submit" class="text-red-600 hover:text-red-900 mb-2 mr-2" value="Delete">
                                                      </form> -->
                                                 </td>
                                            </tr>
                                            @endforeach
                                       </tbody>
                                  </table>
                             </div>
                        </div>
                   </div>
              </div>

         </div>
    </div>