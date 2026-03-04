@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
<x-core::card>
    <x-core::card.header>
        <h4>Import Report</h4>
    </x-core::card.header>

    <x-core::card.body>

        <div class="alert alert-info">
            <strong>Total Rows:</strong> {{ $total }} <br>
            <strong>Successful:</strong> {{ $success }} <br>
            <strong>Failed:</strong> {{ count($failed) }}
        </div>

        @if(count($failed))
      
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Row</th>
                        <th>Error</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($failed as $fail)
                        <tr>
                            <td>{{ $fail['row'] }}</td>
                            <td>{{ $fail['error'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

    </x-core::card.body>
</x-core::card>
@endsection

