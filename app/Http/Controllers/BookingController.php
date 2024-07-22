<?php

namespace App\Http\Controllers;

use App\Enums\BookingStatusEnum;
use App\Exports\BookingsExport;
use App\Http\Resources\BookingResource;
use App\Jobs\GenerateBookingExcel;
use App\Mail\BookingCreated;
use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::query();

        if ($request->has('start_date')) {
            $query->where('booking_date', '>=', $request->start_date);
        }

        if ($request->has('end_date')) {
            $query->where('booking_date', '<=', $request->end_date);
        }

        if($request->has('hotel_name')) {
            $id_hotel = Hotel::where('name', 'like', '%' . $request->hotel_name . '%')->pluck('id');
            //Log::info('Hotel IDs: ', $id_hotel->toArray());
            $query->whereIn('id', $id_hotel);
        }

        if($request->has('tour_name')) {
            $id_tour = Tour::where('name', 'like', '%'.$request->tour_name.'%')->pluck('id');
            //Log::info('Tour IDs: ', $id_tour->toArray());
            $query->whereIn('id', $id_tour);
        }

        if ($request->has('customer_name')) {
            $query->whereHas('customer_name', function($query) use ($request){
                $query->where('customer_name', 'like', '%'.$request->customer_name.'%');
            });
        }

        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('booking_date', [$request->start_date, $request->end_date]);
        }
        
        if($request->has('order_by')) {
            $order_direction = $request->get('order_direction', 'asc');
            $query->orderBy($request->get('order_by'), $order_direction);
        }

        $bookings = $query->paginate(20);

        

        foreach ($bookings as $booking) {
            $booking->tour;
            $booking->hotel;
        }

        return BookingResource::collection($bookings);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'tour_id' => 'required|exists:tours,id',
                'hotel_id' => 'required|exists:hotels,id',
                'customer_name' => 'required|string|max:255',
                'customer_email' => 'required|email|max:255',
                'number_of_people' => 'required|integer|min:1',
                'booking_date' => 'required|date',
            ]);
    
            $booking = Booking::create($validatedData);
    
            Mail::to($booking->customer_email)->send(new BookingCreated($booking));
    
            return response()->json($booking, 201);
        } catch (\Exception $e) {
            return response()->json(['Error' => 'Error al crear la reserva','message' => $e->getMessage()], 500);
        }
        
    }

    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        return new BookingResource($booking);
    }

    public function update(Request $request, Booking $booking)
    {
        $validatedData = $request->validate([
            'tour_id' => 'sometimes|exists:tours,id',
            'hotel_id' => 'sometimes|exists:hotels,id',
            'customer_name' => 'sometimes|string|max:255',
            'customer_email' => 'sometimes|email|max:255',
            'number_of_people' => 'sometimes|integer|min:1',
            'booking_date' => 'sometimes|date',
        ]);

        $booking->update($validatedData);
        return response()->json($booking, 200);
    }

    public function cancel($id) {
        $booking = Booking::findOrFail($id);
        $booking->status = BookingStatusEnum::cancelled->value;
        $booking->save();

        return response()->json($booking, 201);
    }

    public function export() {
        GenerateBookingExcel::dispatch();
        return response()->json(['message' => 'Exportacion realizada'], 201);
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return response()->json(null, 204);
    }
}
