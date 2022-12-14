<?php

namespace App\Http\Controllers;

use App\Jobs\SendEventEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Event;
use \Yajra\DataTables\DataTables;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Event::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('send.event.to.all.member', $row->id)  . ' "onclick="notificationBeforeSendEvent(event, this)" class="btn text-secondary btn-md" data-toggle="tooltip" data-placement="top" title="Send"> <i class="fa fa-paper-plane" aria-hidden="true"></i></a>';
                    $btn = $btn . '<a href="' . route('events.edit', $row->id) . '" class="btn btn-sm text-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pen"></i></a>';
                    $btn = $btn . ' <a href="' . route('events.show', $row->id) . '" class="btn btn-sm text-warning" data-toggle="tooltip" data-placement="top" title="Lihat"><i class="fas fa-eye
                    "></i></a>';
                    $btn = $btn . ' <a href="' . route('events.destroy', $row->id) . '" class="btn btn-sm text-danger"  onclick="notificationBeforeDelete(event, this)" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash" aria-hidden="true"></i></a>';
                    return $btn;
                })
                ->addColumn('event_start_date', function ($data) {
                    return date('d F Y H:i', strtotime($data->event_start_date));
                })
                ->addColumn('event_end_date', function ($data) {
                    return date('d F Y H:i', strtotime($data->event_end_date));
                })
                ->rawColumns(['action'])

                ->make(true);
        }
        return view('events.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(
            'events.create',
            [
                'title' => 'Create Event'
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_name' => 'required',
            'event_description' => 'required',
            'event_start_date' => 'required',
            'event_end_date' => 'required'
        ]);
        try {
            Event::create([
                'event_name' => $request->event_name,
                'event_description' => $request->event_description,
                'event_start_date' => $request->event_start_date,
                'event_end_date' => $request->event_end_date
            ]);
            return redirect()->route('events.index')->with('success_message', 'Event berhasil Ditambahkan.');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->route('events.index')->with('error_message', 'Event gagal Ditambahkan.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [
            'title' => 'Detail Event',
            'event' => Event::findOrFail($id)
        ];
        return view('events.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $data = Event::find($id);
            return view(
                'events.edit',
                [
                    'title' => 'Edit Event',
                    'event' => $data
                ]
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->route('events.index')->with('error_message', 'Event gagal Diubah.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'event_name' => 'required',
            'event_description' => 'required',
            'event_start_date' => 'required',
            'event_end_date' => 'required'
        ]);
        try {
            Event::find($id)->update([
                'event_name' => $request->event_name,
                'event_description' => $request->event_description,
                'event_start_date' => $request->event_start_date,
                'event_end_date' => $request->event_end_date
            ]);
            return redirect()->route('events.index')->with('success_message', 'Event berhasil Diubah.');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->route('events.index')->with('error_message', 'Event gagal Diubah.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Event::find($id)->delete();
            return redirect()->route('events.index')->with('success_message', 'Event berhasil Dihapus.');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->route('events.index')->with('error_message', 'Event gagal Dihapus.');
        }
    }

    public function sendEventToAllMemberEmail(Request $request)
    {
        try {
            // get data email member from database and send email
            $event = Event::find($request->id);
            dispatch(new SendEventEmail($event));

            return redirect()->route('events.index')->with('success_message', 'Email berhasil dikirim.');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->route('events.index');
        }
    }
}
