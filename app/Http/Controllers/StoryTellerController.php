<?php

namespace App\Http\Controllers;

use App\Models\StorySeeker;
use App\Models\StoryTeller;
use App\Models\User;
use Validator, DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class StoryTellerController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tellerDashboard()
    {
        $allStory = StoryTeller::simplePaginate(10);

        return view('tellers', compact('allStory'));
    }

    /**
     * Logout a teller
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendStory(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            //'genre' => ['required', 'string', 'max:255'],
            'story' => ['required', 'string', 'max:255'],
            // 'story' => ["required|mimetypes:application/pdf,doc,docx|max:250"], //Max 250KB
        ]);

        // $file = $request->story->getClientOriginalExtension();
        // $storeFile = $request->story->move(public_path('assets/story'), $file);

        $story  = new StoryTeller;
        $story->title = $request->title;
        $story->genre = $request->genre;
        $story->story = $request->story;
        // $story->story = $file;
        $story->DateCreated = Carbon::now();
        if($story->save()){
            return redirect()->back()->with('success', 'Story posted successfully');
        }else{
            return redirect()->back()->withErrors('Story could not be posted');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StoryTeller  $storyTeller
     * @return \Illuminate\Http\Response
     */
    public function show(StoryTeller $storyTeller)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StorySeeker  $storySeeker
     * @return \Illuminate\Http\Response
     */
    public function seeProfile(Request $request, $id)
    {
        $user = User::find($id);

        if($user){
            return view('user', compact('user'));
        }else{
            return redirect()->back()->withErrors('User could not be found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StorySeeker  $storySeeker
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request, $id)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'mobile_no'=>['required','string', 'min:8', 'max:15'],
            //'gender' => ['required', 'string', 'max:15'],
            'date_of_birth' => ['required', 'string', 'max:15'],
            'location' => ['required', 'string', 'max:255'],
            'writing_preference' => ['required', 'string', 'max:255'],
            'profile_image' => ['nullable', 'image','mimes:jpeg,png,jpg,svg|max:250'], //Max 250KB
        ]);

        $user = User::find($id);
        if ($request->hasFile('profile_image')) {
            $fileExt = $request->profile_image->getClientOriginalExtension();
            $name = $request->profile_image.'_'. date("Y-m-d").'_'.time().'.'.$fileExt;
            $imageName = config('app.url').'/assets/avatars/'.$name;
            $storeFile = $request->profile_image->move(public_path('assets/avatars'), $imageName);
        } else {
            $imageName = $user->profile_image;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile_no = $request->mobile_no;
        $user->gender = $request->gender;
        $user->date_of_birth = $request->date_of_birth;
        $user->location = $request->location;
        $user->writing_preference = $request->writing_preference;
        $user->profile_image = $imageName;
        if($user->update()){
            return redirect()->back()->with('success', 'Account updated successfully');
        }else{
            return redirect()->back()->withErrors('Your account could not be updated at this time.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StoryTeller  $storyTeller
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoryTeller $storyTeller)
    {
        //
    }
}
