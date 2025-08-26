<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function verify($certificate_number)
    {
        $certificate = Certificate::where('certificate_number', $certificate_number)->first();
        
        if (!$certificate) {
            return view('certificates.verify', ['valid' => false]);
        }
        
        return view('certificates.verify', [
            'valid' => true,
            'certificate' => $certificate
        ]);
    }
}
