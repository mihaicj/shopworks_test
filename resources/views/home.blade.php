@extends ('layouts.app')

@section('content')
    <h1 class="page-header">Dashboard</h1>

    <h2 class="sub-header">Shift Data Table</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Employee</th>
                @for ($i = 1; $i <= 7; $i++)
                    <th>Day #{{ $i }}</th>
                @endfor
            </tr>
            </thead>
            <tbody>
            @foreach ($employees->getRows() as $id => $row)
                <tr>
                    <td>{{ $id }}</td>
                    @foreach ($row->getCells() as $cell)
                        <td>{{ $cell }}</td>
                    @endforeach
                </tr>
            @endforeach
            <tr>
                <td><b>TOTAL</b></td>
                @for ($i = 0; $i < 7; $i++)
                    <td>{{ $employees->getTotalForDay($i) }}</td>
                @endfor
            </tr>
            <tr>
                <td><b>ALONE TIMES</b></td>
                @for ($i = 0; $i < 7; $i++)
                    <td>{{ $aloneTimes[$i] }}</td>
                @endfor
            </tr>
            </tbody>
        </table>
    </div>
@endsection

