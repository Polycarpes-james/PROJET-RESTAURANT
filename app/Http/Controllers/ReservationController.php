<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestReservation;
use App\Models\Panier;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        $total_number = 0;
        $reservation = null;

        if(Auth::user()){
            $total_number = Panier::where('user_id', Auth::id())->with('panierPlats')->first()->panierPlats->pluck('quantite')->sum();
            $reservation = Reservation::where('user_id', Auth::id())->first();
        } else {
            $panier = session()->get('panier_invite');          
            if($panier){
                $total_number = array_sum(array_column($panier, 'quantite'));
            }
        }

        return view('reservation.index', [
            'total' => $total_number,
            'reservation' => $reservation
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestReservation $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'guests' => 'required|integer|min:1|max:20',
            'reservation_date' => 'required|date',
            'reservation_time' => 'required',
            'message' => 'nullable|string|max:1000',
        ]);

        $reservation = Reservation::where('user_id', Auth::id())->first();
        $requests = [
                'user_id' => Auth::id(),
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'guests' => $request->guests,
                'reservation_date' => $request->reservation_date,
                'reservation_time' => $request->reservation_time,
                'message' => $request->message,
            ];

        if ($reservation) { 
            $reservation->update($requests);
        } else {
            Reservation::create($requests);
        }
        
        return back()->with(
            'success',
            'Réservation envoyée avec succès'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
