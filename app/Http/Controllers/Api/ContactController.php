<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $contacts = $query->orderBy('created_at', 'DESC')->get();

        return response()->json($contacts);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:500',
            'message' => 'required|string',
            'phone' => 'nullable|string|max:50',
        ]);

        $contact = Contact::create($validated);

        return response()->json([
            'success' => true,
            'id' => $contact->id,
            'message' => 'Thank you for your message. We will get back to you soon!',
        ], 201);
    }

    public function show(string $id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return response()->json(['error' => 'Contact not found'], 404);
        }

        return response()->json($contact);
    }

    public function update(Request $request, string $id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return response()->json(['error' => 'Contact not found'], 404);
        }

        $contact->update([
            'status' => $request->status ?? 'new',
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy(string $id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return response()->json(['error' => 'Contact not found'], 404);
        }

        $contact->delete();

        return response()->json(['success' => true]);
    }
}
