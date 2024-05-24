<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;
use Illuminate\Support\Str;

class UrlController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        $request->validate([
            'original_url' => ['required', 'url', 'regex:/^(https?:\/\/)?([\w\d\-]+\.)+[\w\d]{2,}(\/.*)?$/']
        ]);

        $existingUrl = Url::where('original_url', $request->original_url)->first();
        if ($existingUrl) {
            return redirect('/')->with('short_url', url($existingUrl->short_code));
        }

        $shortCode = $this->generateShortCode();
        Url::create([
            'original_url' => $request->original_url,
            'short_code' => $shortCode,
        ]);

        return redirect('/')->with('short_url', url($shortCode));
    }

    public function show($shortCode)
    {
        $url = Url::where('short_code', $shortCode)->firstOrFail();
        return redirect($url->original_url);
    }

    private function generateShortCode()
    {
        do {
            $shortCode = $this->randomString(12);
        } while (Url::where('short_code', $shortCode)->exists());

        return $shortCode;
    }

    private function randomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
