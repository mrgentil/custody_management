@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Statistiques de Google Analytics</h1>

        <table class="table">
            <thead>
            <tr>
                <th>Date</th>
                <th>Pageviews</th>
            </tr>
            </thead>
            <tbody>
            @foreach($analyticsData['rows'] as $row)
                <tr>
                    <td>{{ $row[0] }}</td>
                    <td>{{ $row[1] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
