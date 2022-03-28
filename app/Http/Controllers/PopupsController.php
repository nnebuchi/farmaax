<?php

namespace App\Http\Controllers;

use App\Http\Requests\PopupRequest;
use App\MailingList;
use App\Popup;
use Illuminate\Http\Request;

class PopUpsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $popups = Popup::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.popups.index')->with('popups', $popups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.popups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PopupRequest $request)
    {

        $data = $request->validated();
        $popup = new Popup();
        $popup->title = $data['title'];
        $popup->message = $data['message'];
        $popup->save();
        return redirect(route('pop-us.show', $popup->id))->with('success', 'Pop-up has been created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $popup  = Popup::findOrFail($id);
        return view('admin.popups.show')->with('popup', $popup);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $popup  = Popup::findOrFail($id);
        return view('admin.popups.edit')->with('popup', $popup);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PopupRequest $request, $id)
    {
        //
        $data = $request->validated();
        $popup = Popup::findOrFail($id);
        $popup->title = $data['title'];
        $popup->message = $data['message'];
        $popup->save();
        return redirect(route('pop-us.show', $popup->id))->with('success', 'Pop-up has been updated successfully');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $deletePopup = Popup::where('id', $id)->delete();
        return redirect(route('pop-us.index'))->with('success', 'Pop-up has been deleted successfully');
    }
    public function subscribe(Request $request)
    {
        $setCookie = setGuestCookie();
        $this->validate($request, [
            'email' => 'required|email'
        ]);
        $findEmail = MailingList::where('email', $request->email)->first();
        if ($findEmail) {
            return redirect()->back()->with('error', 'Your subscription for Farmaax update is received.');
        }
        $mailist = new MailingList();
        $mailist->email  = $request->email;
        $mailist->user_cookie  = $setCookie;
        $mailist->save();
        return redirect()->back()->with('success', 'Your subscription for Farmaax update is received.');
    }
    public function toggleStatus($id)
    {
        $status = '';
        $popup = Popup::findOrFail($id);
        if ($popup->status == 0) {
            $popup->status = 1;
            $popup->save();
            $status = 'on';
        } else {
            $popup->status = 0;
            $popup->save();
            $status = 'off';
        }
        return redirect()->back()->with('success', 'Popup has been successfully turned ' . $status);
    }
}
