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

        return $this->success($contacts);
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

        return $this->created(
            ['id' => $contact->id],
            'Thank you for your message. We will get back to you soon!'
        );
    }

    public function show(string $id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return $this->notFound('Contact');
        }

        return $this->success($contact);
    }

    public function update(Request $request, string $id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return $this->notFound('Contact');
        }

        $contact->update([
            'status' => $request->status ?? 'new',
        ]);

        return $this->updated();
    }

    public function destroy(string $id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return $this->notFound('Contact');
        }

        $contact->delete();

        return $this->deleted();
    }
}
