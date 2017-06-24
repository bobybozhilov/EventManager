<?php

namespace App\Http\Controllers;

use App\Event;
use DateTime;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $events = Event ::all();

        return view('event\index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $event = new Event();

        return view('event\create', ['event' => $event]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $event = new Event();
        $event -> timestamps = false; // timestamps not used in the DB

        $this -> validate($request, [
            'name'      => 'required',
            'location'  => 'required',
            'startDate' => 'required',
            'startTime' => 'required',
            'endDate'   => 'required|date|after_or_equal:startDate',
        ]);
        if ($request -> startDate == $request -> endDate) {
            $this -> validate($request, [
                'endTime' => 'after:startTime',
            ]);
        }

        $event -> name = $request -> name;
        $event -> location = $request -> location;
        $event -> startDateTime = EventController ::mergeDateTime($request -> startDate, $request -> startTime);
        $event -> endDateTime = EventController ::mergeDateTime($request -> endDate, $request -> endTime);

        $event -> save();

        return redirect() -> action('EventController@index');
    }

    /**
     * Display the specified resource. NOT used in this Program
     *
     * @param  \App\Event $event
     *
     * @return \Illuminate\Http\Response
     *
    public function show(Event $event)
    {
        //
    }*/

    /**
     * Merge the date and time from the form. This method adds $time to the $date object.
     *
     * @param $inputDate
     * @param $inputTime
     *
     * @return DateTime
     */
    public function mergeDateTime($inputDate, $inputTime) {
        $date = new DateTime($inputDate);
        $time = new DateTime($inputTime);
        $date -> setTime($time -> format('H'), $time -> format('i')/*, $time->format('s')*/);
        $date -> format('Y-m-d H:i:s'); // Outputs '2017-03-14 13:37:42

        return $date;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id - the id of the event
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $event = Event ::findOrFail($id);

        return view('event\edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param                           $id - the id of the event
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $event = Event ::findOrFail($id);
        $event -> timestamps = false;// timestamps not used in the DB

        $this -> validate($request, [
            'name'      => 'required',
            'location'  => 'required',
            'startDate' => 'required',
            'startTime' => 'required',
            'endDate'   => 'required|date|after_or_equal:startDate',
        ]);
        if ($request -> startDate == $request -> endDate) {
            $this -> validate($request, [
                'endTime' => 'after:startTime',
            ]);
        }

        $event -> name = $request -> name;
        $event -> location = $request -> location;
        $event -> startDateTime = EventController ::mergeDateTime($request -> startDate, $request -> startTime);
        $event -> endDateTime = EventController ::mergeDateTime($request -> endDate, $request -> endTime);

        $event -> update();

        return redirect() -> action('EventController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id - the id of the event
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $event = new Event();
        $event -> whereId($id) -> delete();

        return redirect() -> action('EventController@index');
    }
}