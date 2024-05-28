<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Agregar esta línea para importar la clase Log
use App\Models\Offer;
use App\Models\PromotionalCode;

class OfferController extends Controller
{
    public function index()
    {
        Log::debug('Solicitud GET a /api/offers recibida'); 
        $offers = Offer::all();
        return response()->json($offers);
    }

    public function generate(Request $request, $offerId)
    {
        $offer = Offer::findOrFail($offerId);
        $promoCode = $this->generateUniquePromoCode();
        $user = $request->user();
        $user->promotionalCodes()->create([
            'offer_id' => $offer->id,
            'code' => $promoCode,
            'status' => 'generated',
        ]);
        return response()->json(['message' => 'Código promocional generado exitosamente', 'code' => $promoCode]);
    }

    private function generateUniquePromoCode()
    {
        do {
            $code = strtoupper(substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 6)), 0, 6));
        } while (PromotionalCode::where('code', $code)->exists());
        return $code;
    }
}
