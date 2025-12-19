<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource (Read All).
     * Using paginate(10) instead of all() to improve performance.
     */
    public function index()
    {
        return Contact::paginate(10);
    }

    /**
     * Store a newly created resource in storage (Create).
     */
    public function store(Request $request)
    {
        // Validation ensures the data is clean before saving
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:contacts,email',
            'phone_number' => 'required|string|max:20',
        ]);

        $contact = Contact::create($validatedData);

        return response()->json($contact, 201);
    }

    /**
     * Display the specified resource (Read One).
     */
    public function show(Contact $contact)
    {
        return $contact;
    }

    /**
     * Update the specified resource in storage (Update).
     */
    public function update(Request $request, Contact $contact)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:contacts,email,' . $contact->id,
            'phone_number' => 'sometimes|required|string|max:20',
        ]);

        $contact->update($validatedData);

        return response()->json($contact, 200);
    }

    /**
     * Remove the specified resource from storage (Delete).
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return response()->json(['message' => 'Contact deleted successfully'], 200);
    }
}