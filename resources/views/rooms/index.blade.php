@extends('layouts.app')
@section('content')

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Room No.</th>
            <th scope="col">Type</th>
        </tr>
        </thead>
        <tbody>
        @foreach($rooms as $key => $room)
            <tr>
                <th scope="row">{{ $key+1 }}</th>
                <td>{{ $room->number }}</td>
                <td>{{ $room->room_type_id }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
