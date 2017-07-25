<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class SlackController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
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
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
	
	public function concerta(Request $request, Carbon $carbon)
	{
		/* This sets the $time variable to the current hour in the 24 hour clock format */
		$time = date("H");
		/* Set the $timezone variable to become the current timezone */
		$timezone = date("e");
		$time = $time + 2;
		/* If the time is less than 1200 hours, show good morning */
		if ($time < "12" && $time > "8") {
			$data = "token=xoxp-30836193671-45627712308-215394430341-cb87e25205d20f6d3d58cc27d76ad347&channel=D1BK36GV8&text=Remember to take your concerta!!!";
			$ch = curl_init('https://slack.com/api/chat.postMessage');
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/x-www-form-urlencoded'
			));
			$result = curl_exec($ch);
			curl_close($ch);
			
			return $result;
		} else {
			return 'not needed';
		}
	}
	
	public function postChangeStatus(Request $request, Carbon $carbon)
	{
		$status_text = urlencode($request->status_text);
		$status_emoji = urlencode($request->status_emoji);
		$data = "token=xoxp-30836193671-45627712308-215394430341-cb87e25205d20f6d3d58cc27d76ad347&profile=%7B%22status_text%22%3A%22$status_text%22%2C%22status_emoji%22%3A%22%3A$status_emoji%3A%22%7D";
		$ch = curl_init('https://slack.com/api/users.profile.set');
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/x-www-form-urlencoded'
		));
		$result = curl_exec($ch);
		curl_close($ch);
		
		return redirect()->back()->with('message', 'Slack status updated');
	}
	
	public function getChangeStatus()
	{
		return view('slack.create');
	}
}
