<?php

namespace App\Http\Controllers;

use App\Models\Timeline;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $timelines = Timeline::all();
        return view('admin', compact('timelines'));
    }
    
    

    
    public function show($id)
{
    // Ambil satu data berdasarkan id
    $timeline = Timeline::findOrFail($id);

    // Kirim ke view
    return view('admin', compact('timeline'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('timeline.create'); // Create view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul_timeline' => 'required|string|max:255',
            'tanggal_timeline_awal' => 'required|date',
            'tanggal_timeline_akhir' => 'required|date',
        ]);
    
        $timeline = new Timeline();
        $timeline->judul_timeline = $request->judul_timeline;
        $timeline->tanggal_timeline_awal = $request->tanggal_timeline_awal;
        $timeline->tanggal_timeline_akhir = $request->tanggal_timeline_akhir;
        $timeline->save();
    
        return redirect()->route('timelines.index')->with('success', 'Timeline added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */

     public function edit($id)
     {
         $timeline = Timeline::findOrFail($id);
         return view('timeline.edit', compact('timeline'));
     }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_timeline' => 'required|string|max:255',
            'tanggal_timeline_awal' => 'required|date',
            'tanggal_timeline_akhir' => 'required|date',
        ]);
    
        $timeline = Timeline::findOrFail($id);
        $timeline->judul_timeline = $request->judul_timeline;
        $timeline->tanggal_timeline_awal = $request->tanggal_timeline_awal;
        $timeline->tanggal_timeline_akhir = $request->tanggal_timeline_akhir;
        $timeline->save();
    
        return redirect()->route('timelines.index')->with('success', 'Timeline updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the timeline by ID
        $timeline = Timeline::findOrFail($id);
    
        // Delete the timeline
        $timeline->delete();
    
        // Redirect back to the timeline list with a success message
        return redirect()->route('timelines.index')->with('success', 'Timeline deleted successfully.');
    }

    public function showTimeline($id)
    {
        // Menampilkan satu timeline berdasarkan ID
        $timeline = Timeline::findOrFail($id);  // Mengambil timeline berdasarkan ID

        // Mengirim data ke view
        return view('namaViewAnda', compact('timeline'));
    }

    
}