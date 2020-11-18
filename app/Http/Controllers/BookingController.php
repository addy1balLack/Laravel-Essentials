<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = DB::table('bookings')->get();
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = DB::table('users')->get()->pluck('name','id')->prepend('None');
        $rooms = DB::table('rooms')->get()->pluck('number','id');
        return view('bookings.create')->with('users', $users)->with('rooms',$rooms);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = DB::table('bookings')->insertGetId([
           'room_id' => $request->room_id,
           'start' => $request->start,
            'end' => $request->end,
            'is_reservation' => $request->input('is_reservation',false),
            'is_paid' => $request->input('is_paid', false),
            'notes' => $request->notes
        ]);

        DB::table('bookings_users')->insert([
            'booking_id' => $id,
            'user_id' => $request->user_id
        ]);

        return redirect()->route('bookings.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        return view('bookings.show')->with('booking',$booking);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {

        $users = DB::table('users')->get()->pluck('name','id')->prepend('None');
        $rooms = DB::table('rooms')->get()->pluck('number','id');
        $bookingUser = DB::table('bookings_users')->where('booking_id',$booking->id)->first();
        return view('bookings.edit')
            ->with('booking',$booking)
            ->with('users', $users)
            ->with('rooms',$rooms)
            ->with('booking_user', $bookingUser);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        DB::table('bookings')
            ->where('id', $booking->id)
            ->update([
            'room_id' => $request->room_id,
            'start' => $request->start,
            'end' => $request->end,
            'is_reservation' => $request->input('is_reservation',false),
            'is_paid' => $request->input('is_paid', false),
            'notes' => $request->notes
        ]);

        DB::table('bookings_users')
            ->where('booking_id', $booking->id)
            ->update([
            'user_id' => $request->user_id
        ]);

        return redirect()->route('bookings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        DB::table('bookings_users')->where('booking_id', $booking->id)->delete();
        $booking->delete();

        return redirect()->route('bookings.index')->with('success','Booking Deleted');

    }
}
