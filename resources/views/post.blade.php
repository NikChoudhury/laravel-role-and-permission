<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <x-link-button href="{{ route('admin.post') }}">
                        {{ __('Create') }}
                    </x-link-button>

                    <div class="table py-2">
                        <table class="table-auto" width="100%">
                            <thead style="background-color: rgb(167, 121, 121);">
                              <tr >
                                <th>Sl</th>  
                                <th>Song</th>
                                <th>Artist</th>
                                <th>Year</th>
                              </tr>
                            </thead>
                            <tbody class="border" style="text-align: center">
                              <tr>
                                <td>1</td>
                                <td>The Sliding Mr. Bones (Next Stop, Pottersville)</td>
                                <td>Malcolm Lockyer</td>
                                <td>1961</td>
                              </tr>
                              <tr>
                                <td>2</td>
                                <td>Witchy Woman</td>
                                <td>The Eagles</td>
                                <td>1972</td>
                              </tr>
                              <tr>
                                <td>3</td>
                                <td>Shining Star</td>
                                <td>Earth, Wind, and Fire</td>
                                <td>1975</td>
                              </tr>
                            </tbody>
                          </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
