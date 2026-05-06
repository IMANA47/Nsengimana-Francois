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
            'image' => ['nullable', 'image', 'max:2048'],
            'pdf' => ['nullable', 'file', 'mimes:pdf', 'max:4096'],
        ]);
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('certificates', 'public');
        }
        if ($request->hasFile('pdf')) {
            $data['file_path'] = $request->file('pdf')->store('certificates', 'public');
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
            'image' => ['nullable', 'image', 'max:2048'],
            'pdf' => ['nullable', 'file', 'mimes:pdf', 'max:4096'],
        ]);
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('certificates', 'public');
        }
        if ($request->hasFile('pdf')) {
            $data['file_path'] = $request->file('pdf')->store('certificates', 'public');
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
