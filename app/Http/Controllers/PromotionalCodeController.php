<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\PromotionalCode;
use App\Models\Offer;

class PromotionalCodeController extends Controller
{

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'offer_id' => 'required|integer',
            'code' => 'required|string|unique:promotional_codes',
            'status' => 'required|in:generated,exchanged',
        ]);

        $promotionalCode = PromotionalCode::create($validatedData);

        return response()->json($promotionalCode, 201);
    }



    
    public function index(Request $request)
    {

        /* dd('Pasé por aquí'); */

        return response()->json([
            'message' => 'Acabo de pasar por la funcion 001 ',
        ]);
        

        $promotionalCodes = $request->user()->promotionalCodes;
        return response()->json($promotionalCodes);
    }

    public function generate(Request $request, $offerId)
    {

                // return response()->json([
                //     'message' => 'Después de obtener la oferta',
                //     'request' => $request->all(),
                //     'csrf_token' => $request->header('X-CSRF-TOKEN'),
                // ]);

                $tokenSent = $request->header('X-CSRF-TOKEN');
                $tokenFromSession = $request->session()->token();
                /* $tokenSent = $request->header(); */
                /* $tokenFromSession = csrf_token(); */
                /* $tokenFromSession = csrf_token(); */
        
                return response()->json([
                    'message' => 'Después de obtener la oferta',
                    'request' => $request->all(),
                    'token_sent' => $tokenSent,
                    'token_from_session' => $tokenFromSession,
                ]);


        $offer = Offer::findOrFail($offerId);
                // return response()->json([
                //     'message' => 'Después de obtener la oferta',
                //     'offer' => $offer,
                // ]);



        $promoCode = $this->generateUniquePromoCode();
        $user = $request->user();
        
/*             return response()->json([
                'message' => 'Después de obtener el usuario',
                'user' => $user,
            ]); */

        $user->promotionalCodes()->create([
            'offer_id' => $offer->id,
            'code' => $promoCode,
        ]);
        return response()->json(['message' => 'Código promocional generado exitosamente', 'code' => $promoCode]);
    }

    public function exchange(Request $request, $code)
    {

        /* dd('Pasé por aquí'); */

        return response()->json([
            'message' => 'Acabo de pasar por la funcion 003 ',
        ]);

        $promotionalCode = PromotionalCode::where('code', $code)->firstOrFail();
        $promotionalCode->status = 'exchanged';
        $promotionalCode->save();
        return response()->json(['message' => 'Código canjeado exitosamente']);
    }

    private function generateUniquePromoCode()
    {

        /* dd('Pasé por aquí'); */

        return response()->json([
            'message' => 'Acabo de pasar por la funcion 004 ',
        ]);

        do {
            $code = Str::random(8);
        } while (PromotionalCode::where('code', $code)->exists());
        return $code;
    }
}
