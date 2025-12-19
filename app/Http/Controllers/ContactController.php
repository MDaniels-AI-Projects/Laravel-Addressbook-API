<?php

namespace App\Http\Controllers;

use App\Models\Contact; // This is the crucial link to your database
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // This will return all contacts in the database
        return Contact::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validate the incoming data
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:contacts,email',
            'phone_number' => 'required|string|max:20',
        ]);

        // 2. Save the data to the MySQL table
        $contact = Contact::create($validated);

        // 3. Send back a success response
        return response()->json([
            'message' => 'Contact saved successfully!',
            'contact' => $contact
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return $contact;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'name'         => 'sometimes|string|max:255',
            'email'        => 'sometimes|email|unique:contacts,email,' . $contact->id,
            'phone_number' => 'sometimes|string|max:20',
        ]);

        $contact->update($validated);

        return response()->json([
            'message' => 'Contact updated successfully!',
            'contact' => $contact
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return response()->json([
            'message' => 'Contact deleted successfully!'
        ]);
    }
}