<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of properties.
     */
    public function index()
    {
        $properties = Property::with(['photos' => function($query) {
            $query->where('is_cover', true);
        }])->get();

        return view('admin.properties.index', compact('properties'));
    }

    /**
     * Display the specified property.
     */
    public function show(Property $property)
    {
        $property->load(['photos', 'amenities', 'bookings']);

        return view('admin.properties.show', compact('property'));
    }
}
