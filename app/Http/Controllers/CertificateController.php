<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::latest()->paginate(10);
        return view('admin.certificates.index', compact('certificates'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:180'],
            'organization' => ['required', 'string', 'max:180'],
            'issued_at' => ['nullable', 'date'],
            'verification_url' => ['nullable', 'url'],
            'image' => ['nullable', 'file', 'max:2048'],
            'pdf' => ['nullable', 'file', 'max:4096'],
        ]);
        
        // Validate image extension manually
        if ($request->hasFile('image')) {
            $allowedImageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            $imageExtension = strtolower($request->file('image')->getClientOriginalExtension());
            if (!in_array($imageExtension, $allowedImageExtensions)) {
                return back()->withErrors(['image' => "L'image doit être un fichier jpg, jpeg, png, gif ou webp."])->withInput();
            }
        }
        
        // Validate pdf extension manually
        if ($request->hasFile('pdf')) {
            $allowedPdfExtensions = ['pdf'];
            $pdfExtension = strtolower($request->file('pdf')->getClientOriginalExtension());
            if (!in_array($pdfExtension, $allowedPdfExtensions)) {
                return back()->withErrors(['pdf' => 'Le fichier doit être un PDF.'])->withInput();
            }
        }
        if ($request->hasFile('image')) {
            $fileName = uniqid() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/certificates'), $fileName);
            $data['image_path'] = 'certificates/' . $fileName;
        }
        if ($request->hasFile('pdf')) {
            $fileName = uniqid() . '_' . $request->file('pdf')->getClientOriginalName();
            $request->file('pdf')->move(public_path('storage/certificates'), $fileName);
            $data['file_path'] = 'certificates/' . $fileName;
        }
        unset($data['image'], $data['pdf']);

        Certificate::create($data);
        return back()->with('success', 'Certificat ajoute.');
    }

    public function update(Request $request, Certificate $certificate)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:180'],
            'organization' => ['required', 'string', 'max:180'],
            'issued_at' => ['nullable', 'date'],
            'verification_url' => ['nullable', 'url'],
            'image' => ['nullable', 'file', 'max:2048'],
            'pdf' => ['nullable', 'file', 'max:4096'],
        ]);
        
        // Validate image extension manually
        if ($request->hasFile('image')) {
            $allowedImageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            $imageExtension = strtolower($request->file('image')->getClientOriginalExtension());
            if (!in_array($imageExtension, $allowedImageExtensions)) {
                return back()->withErrors(['image' => 'L\'image doit être un fichier jpg, jpeg, png, gif ou webp.'])->withInput();
            }
        }
        
        // Validate pdf extension manually
        if ($request->hasFile('pdf')) {
            $allowedPdfExtensions = ['pdf'];
            $pdfExtension = strtolower($request->file('pdf')->getClientOriginalExtension());
            if (!in_array($pdfExtension, $allowedPdfExtensions)) {
                return back()->withErrors(['pdf' => 'Le fichier doit être un PDF.'])->withInput();
            }
        }
        if ($request->hasFile('image')) {
            $fileName = uniqid() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/certificates'), $fileName);
            $data['image_path'] = 'certificates/' . $fileName;
        }
        if ($request->hasFile('pdf')) {
            $fileName = uniqid() . '_' . $request->file('pdf')->getClientOriginalName();
            $request->file('pdf')->move(public_path('storage/certificates'), $fileName);
            $data['file_path'] = 'certificates/' . $fileName;
        }
        unset($data['image'], $data['pdf']);

        $certificate->update($data);
        return back()->with('success', 'Certificat mis a jour.');
    }

    public function edit(Certificate $certificate)
    {
        return view('admin.certificates.edit', compact('certificate'));
    }

    public function destroy(Certificate $certificate)
    {
        $certificate->delete();
        return back()->with('success', 'Certificat supprime.');
    }
}
