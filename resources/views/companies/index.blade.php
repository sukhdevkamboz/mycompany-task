<x-app-layout>
    <style>
        table, th, td {
          border: 1px solid black;
          border-collapse: collapse;
          margin:50px;
        }
        th, td {
          padding: 15px;
          text-align: left;
        }
        table#t01 {
          width: 100%;    
          background-color: #f1f1c1;
        }
    </style>

    <h2 style="margin:50px">Company List 
        <a style="margin-left:50p;color:green" href="{{ route('companies.create') }}" >
            {{ __("Add company") }}
        </a>
    </h2> 
    
    <table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Address</th>
        <th>Industry</th>
        <th>Active Status</th>
        <th>Action</th>
    </tr>
    @foreach ($companies as $company)
    <tr>
        <td>{{ $company->id }}</td>
        <td>{{ $company->name }}</td>
        <td>{{ $company->address }}</td>
        <td>{{ $company->industry }}</td>
        <td>{{ isset($company->userActiveCompany) && !empty($company->userActiveCompany) ? 'Active' : 'De-active' }}</td>
        
        <td>
               <form method="POST" action="{{ route('companies.update',['company' => $company]) }}">
                    @csrf
                    @method('DELETE')
                
                        <x-primary-button>
                            {{ __('Delete') }}
                        </x-primary-button>
                
                </form>
                <a href="{{ route('companies.edit',['company' => $company]) }}" class="p-6 text-gray-900">
                    {{ __("Edit") }}

        </td>
     
    </tr>
    @endforeach
    </table>
</x-app-layout>