<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShowRoomsController extends Controller
{
    public function __invoke(Request $request, $roomType = null)
    {
        $rooms = Room::byType($roomType)->get();
        return view('rooms.index', compact('rooms'));
    }
}
