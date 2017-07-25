<?php

namespace App\Http\Controllers;

use App\Reddit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RedditController extends Controller
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
		$ch = curl_init('https://www.reddit.com/r/EarthPorn/top/.json?limit=1');
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		$js = json_decode($result);
		$children = $js->data->children;
		$items = array();
		
		foreach ($children as $child) {
			$reddit = Reddit::firstOrNew(['reddit_id' => $child->data->id]);
			dd($child->data->id);
			if (isset($child->data->preview->images)) {
				$images = $child->data->preview->images;
				foreach ($images as $image) {
					$items[] = $image->source->url;
					$reddit->image_url = $image->source->url;
				}
			}
			else {
				dd($child->data);
			}
			$reddit->subreddit = $child->subreddit;
			$reddit->selftext = $child->selftext;
			$reddit->nsfw = $child->nsfw;
			$reddit->ups = $child->ups;
			$reddit->permalink = $child->permalink;
			$reddit->title = $child->title;
			$reddit->save();
		}
		
		return view('reddit.show', compact('items'));
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
	
	public function getRedditImages()
	{
	
	}
}
