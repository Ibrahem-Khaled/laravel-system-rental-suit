<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Suit;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // جلب بيانات الحجوزات الغير مكتملة
        $incompleteReservations = Reservation::where('status', 'incomplete')->count();

        // جلب بيانات البدل المكتملة
        $completedSuits = Reservation::where('status', 'completed')->count();

        // جلب بيانات البدل المطلوب استلامها من العميل
        $toBeCollectedSuits = Reservation::where('status', 'to_collect')->count();

        // جلب بيانات الهالك للبدل
        $damagedSuits = Suit::where('status', 'damaged')->count();

        return view('home',[
            'incompleteReservations' => $incompleteReservations,
            'completedSuits' => $completedSuits,
            'toBeCollectedSuits' => $toBeCollectedSuits,
            'damagedSuits' => $damagedSuits
        ]);
    }
}
