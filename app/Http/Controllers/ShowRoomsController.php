<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShowRoomsController extends Controller
{
    public function __invoke(Request $request)
    {
        $rooms = DB::table('rooms')->get();

        $id = $request->query('id');

        if ($id !== null){
            $rooms = $rooms->where('room_type_id',$id);
        }

        return view('rooms.index', compact('rooms'));
    }
}
