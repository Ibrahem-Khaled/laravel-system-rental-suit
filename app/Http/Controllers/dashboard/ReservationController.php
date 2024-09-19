<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Size;
use Illuminate\Http\Request;

class ReservationController extends Controller
{

    public function index()
    {
        // جلب الحجوزات من الأحدث إلى الأقدم
        $reservations = Reservation::with(['suit', 'size'])->orderBy('created_at', 'desc')->get();

        return view('dashboard.reservations', compact('reservations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'suit_id' => 'required|exists:suits,id',
            'size_id' => 'required|exists:sizes,id',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'reservation_date' => 'required|date',
            'return_date' => 'required|date',
            'price' => 'required|numeric',
        ]);

        // حفظ بيانات الحجز
        $reservation = Reservation::create([
            'suit_id' => $request->suit_id,
            'size_id' => $request->size_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'include_pants' => $request->has('include_pants'),
            'include_shirt' => $request->has('include_shirt'),
            'shirt_size' => $request->shirt_size,
            'shirt_color' => $request->shirt_color,
            'include_brooch' => $request->has('include_brooch'),
            'pants_size' => $request->pants_size,
            'pants_color' => $request->pants_color,
            'pants_type' => $request->pants_type,
            'include_vest' => $request->has('include_vest'),
            'include_tie' => $request->has('include_tie'),
            'include_bow_tie' => $request->has('include_bow_tie'),
            'include_pocket_square' => $request->has('include_pocket_square'),
            'reservation_date' => $request->reservation_date,
            'return_date' => $request->return_date,
            'height' => $request->height,
            'waist' => $request->waist,
            'thighs' => $request->thighs,
            'calves' => $request->calves,
            'slim' => $request->slim,
            'notes' => $request->notes,
            'price' => $request->price,
        ]);

        // تحديث حالة المقاس إلى غير متاح
        $size = Size::find($request->size_id);
        $size->is_available = false;
        $size->save();

        return redirect()->back()->with('success', 'تم حجز البدلة بنجاح');
    }

    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'reservation_date' => 'required|date',
            'return_date' => 'required|date',
            'price' => 'required|numeric',
        ]);

        // تحديث بيانات الحجز
        $reservation->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'include_pants' => $request->has('include_pants'),
            'include_vest' => $request->has('include_vest'),
            'include_tie' => $request->has('include_tie'),
            'include_bow_tie' => $request->has('include_bow_tie'),
            'include_pocket_square' => $request->has('include_pocket_square'),
            'reservation_date' => $request->reservation_date,
            'return_date' => $request->return_date,
            'height' => $request->height,
            'waist' => $request->waist,
            'thighs' => $request->thighs,
            'calves' => $request->calves,
            'slim' => $request->slim,
            'notes' => $request->notes,
            'price' => $request->price,
        ]);

        return redirect()->back()->with('success', 'تم تحديث الحجز بنجاح');
    }

    public function destroy(Reservation $reservation)
    {
        // إعادة تعيين حالة المقاس إلى متاح عند حذف الحجز
        $size = Size::find($reservation->size_id);
        if ($size) {
            $size->is_available = true;
            $size->save();
        }

        // حذف الحجز
        $reservation->delete();

        return redirect()->back()->with('success', 'تم حذف الحجز بنجاح');
    }
}
