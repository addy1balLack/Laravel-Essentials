@extends('layouts.app')
@section('buttons')
    <a href="{{ route('bookings.create') }}" class="btn btn-primary">Add New Booking</a>
@endsection
@section('content')

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Room</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Reservation?</th>
            <th>Paid?</th>
            <th>Started?</th>
            <th>Passed?</th>
            <th>Created</th>
            <th class="Actions">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->id }}</td>
                <td>{{ $booking->room_id }}</td>
                <td>{{ date('F d, Y', strtotime($booking->start)) }}</td>
                <td>{{ date('F d, Y', strtotime($booking->end)) }}</td>
                <td>{{ $booking->is_reservation ? 'Yes' : 'No' }}</td>
                <td>{{ $booking->is_paid ? 'Yes' : 'No' }}</td>
                <td>{{ (strtotime($booking->start) < time()) ? 'Yes' : 'No' }}</td>
                <td>{{ (strtotime($booking->end) < time()) ? 'Yes' : 'No' }}</td>
                <td>{{ date('F d, Y', strtotime($booking->created_at)) }}</td>

                <td class="actions">
                    <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
