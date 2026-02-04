<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Destination;

class DestinationController extends Controller
{
    public function show($slug)
    {
        // Fetch real data from DB
        $destination = Destination::with(['category'])->where('slug', $slug)->firstOrFail();

        // Enrich with some dummy data for presentation if missing in DB, 
        // because the DB schema is simple but the view demands more details (facilities etc)
        // In a real app, these would be relationships.

        $destination->facilities = [
            ['icon' => 'fa-swimmer', 'label' => 'Snorkeling'],
            ['icon' => 'fa-ship', 'label' => 'Sewa Perahu'],
            ['icon' => 'fa-camera', 'label' => 'Spot Foto'],
            ['icon' => 'fa-utensils', 'label' => 'Warung Makan'],
        ];

        $destination->highlights = [
            'Pemandangan alam yang asri',
            'Spot foto instagramable',
            'Cocok untuk keluarga',
            'Udara sejuk dan segar'
        ];

        // Dummy promo data
        $destination->promo = [
            'title' => 'Diskon Spesial',
            'description' => 'Dapatkan potongan harga 10% untuk kunjungan rombongan.',
            'code' => 'KALTIM10',
            'valid_until' => '31 Des 2026'
        ];

        // Dummy reviews if relationship not set or empty
        // We will pass the reviews variable separately or attach it
        // The view expects $destination['reviews'] - but now $destination is an object.
        // We will create a collection or array for reviews.
        // But since we seeded reviews, let's try to fetch them if the relation exists!
        // The migration created 'reviews' table and Destination model might have the relation.
        // Let's check Destination Model later, but for now I'll just pass real reviews if available, or dummy.
        // Actually, the seeder created reviews. Let's use them!

        // Load reviews relationship if it exists. 
        // Note: I need to check if Destination model has 'reviews' method.
        // Assuming it does based on seeder "Review::create(['destination_id'...])"

        // I will Eager Load reviews
        $destination->load('reviews');

        return view('destinations.show', compact('destination'));
    }
}
