<?php

namespace App\Http\Controllers\FB;

@session_start();

use App\Http\Controllers\Controller;
use App\Services\FacebookService;
use Illuminate\Http\Request;

class FacebookController extends Controller
{
    private $facebook;

    public function __construct(FacebookService $facebook)
    {
        $this->facebook = $facebook;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        \Session::forget('FBRLH_state');
        \Session::forget('pages');
        
        //
        $url = $this->facebook->getUrl();
        return redirect()->away($url);
    }

    /**
     *  facebook login callback.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        \Session::put('FBRLH_state', $request['state']);
        $this->facebook->getAccessToken();
        
        $pages = $this->facebook->getPages();
        
        \Session::put('pages', $pages);
        return redirect()->route('fb.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * subscribe a page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subscribe(Request $request)
    {
        $data = $this->facebook->subscribe($request['page'], $request['app']);
        return view('fb.subscribed', compact('data'));
    }

    /**
     * Display pages
     */
    public function list()
    {
        return view('fb.pages', ['pages' => \Session::get('pages')]);
    }

    /**
     * Display the specified resource.
     *

     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

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
        //
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
    }
}
