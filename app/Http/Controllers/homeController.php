<?php

namespace App\Http\Controllers;
use App\User;
use App\Properties;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ($request->user()->authorizeRoles(['user']))
            return view('Lot');
        else
            return view('Lot'); //redirect('/logout');
    }

    public function home(Request $request)
    {
        if ($request->user()->authorizeRoles(['user']))
            return view('Lot');
        else
            return redirect('/logout');
    }

    public function location(Request $request)
    {
        if ($request->user()->authorizeRoles(['user']))
            return view('location');
        else
            return view('Lot');
    }

    public function VacantProperties(Request $request)
    {
        if ($request->user()->authorizeRoles(['user']))
            return view('VacantProperties');
        else
            return redirect('/logout');
    }
    public function ShowSave(Request $request)
    {
        if ($request->user()->authorizeRoles(['user'])) {
            $getPropertiesCount = User::find($request->user()->id)->properties;
            if(count($getPropertiesCount) > 0)
            {
                $getLastProperty = $getPropertiesCount->last();
                $getTime = strtotime($getLastProperty->created_at->toDateString()." + ".$request->user()->resttime." days");
                if($getTime < time())
                {
                    $u = User::find($request->user()->id);
                    $u->savedcount = 0;
                    $u->save();
                }
            }
            $Currentuser = User::find($request->user()->id);
            $propertiesList = $Currentuser->properties;


            return view('SaveProperties')->with('propertiesList',$propertiesList)-> with("Rcout",10-$Currentuser->savedcount);
        }
        else
            return redirect('/logout');
    }
    public function person(Request $request)
    {
        if ($request->user()->authorizeRoles(['user'])) {
            return view('personsearch');
        }
        else
            return redirect('/logout');
    }
    public function deletesaveproperty(Request $request,$id)
    {
        if ($request->user()->authorizeRoles(['user'])) {
            $property = Properties::find($id);
            $property->delete();
            $u = User::find($request->user()->id);
            if($u->savedcount > 0) {
                $u->savedcount = $u->savedcount - 1;
                $u->save();
            }
            return redirect('/savedproperties');
        }
        else
            return redirect('/logout');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

}
