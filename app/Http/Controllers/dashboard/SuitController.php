<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Suit;
use App\Models\Size;
use Illuminate\Support\Facades\Storage;

class SuitController extends Controller
{
    public function index()
    {
        $suits = Suit::with('sizes')->get();
        return view('dashboard.suit.rent-suit', compact('suits'));
    }

    public function show(Suit $suit)
    {
        $suit->load('sizes'); // تحميل المقاسات المرتبطة بالبدلة
        return view('dashboard.booking_suit', compact('suit'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('suits', 'public');
        }

        Suit::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'color' => $request->color,
            'type' => $request->gender,
            'product_type' => $request->product_type,
            'is_active' => $request->is_active,
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'تم إضافة البدلة بنجاح');
    }


    public function update(Request $request, Suit $suit)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إذا كانت موجودة
            if ($suit->image) {
                Storage::disk('public')->delete($suit->image);
            }
            $imagePath = $request->file('image')->store('suits', 'public');
            $suit->image = $imagePath;
        }

        $suit->update($request->only(['name', 'description', 'price', 'color', 'type', 'product_type', 'is_active']));

        return redirect()->back()->with('success', 'تم تعديل البدلة بنجاح');
    }

    public function destroy(Suit $suit)
    {
        if ($suit->image) {
            Storage::disk('public')->delete($suit->image);
        }

        $suit->delete();
        return redirect()->back()->with('success', 'تم حذف البدلة بنجاح');
    }
    public function addSize(Request $request, Suit $suit)
    {
        foreach ($request->sizes as $size) {
            Size::create([
                'suit_id' => $suit->id,
                'size' => $size,
                'is_available' => true,
            ]);
        }
        return redirect()->back()->with('success', 'Sizes added successfully');
    }
}
