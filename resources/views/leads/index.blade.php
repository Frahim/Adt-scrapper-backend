<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('List') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="container">
      
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table-wrapper border-collapse border min-w-full">
            <thead>
                <tr>
                    <th class="text-left p-4">
                        Photo
                    </th>
                    <th class="text-left p-4">Name</th>
                    <th class="p-4">Email</th>
                    <th class="p-4">Phone</th>
                    <th class="p-4"> <a target="_blank" class="btn" href="/leads/export">Export jason</a></th>
                </tr>
            </thead>
            <tbody>
                @foreach($leads as $lead)
                    <tr>
                        <td class="p-4 border "><img src="{{$lead->photo}}" alt="" style="width: 100px; height:80px;"/></td>
                        <td class="p-4 border ">{{ $lead->name }}</td>
                        <td class="p-4 border  ">{{ $lead->email }}</td>
                        <td class="p-4 border ">{{ $lead->phone }}</td>
                        <td class="p-4 border ">
                            <a href="#">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
</x-app-layout>