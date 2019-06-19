<?php

namespace App\Http\Controllers;
use App\User;
use App\Properties;
use Auth;
use Illuminate\Http\Request;
use DateTime;

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
        if ($request->user()->authorizeRoles(['user'])) {

            $Currentuser = User::find($request->user()->id);
            $date1 = new DateTime("now");
            $getTime = strtotime($Currentuser->HistoricFirstDate ." + ".$request->user()->Historicresttime." days");
            $time = date("Y-m-d H:i:s",$getTime);
            $date2 = new DateTime($time);
            $interval = date_diff( $date1,$date2);
            $TimediffFormated = $interval->format('%a days %h hours %i Mins %s Sec remaining');

            return view('Lot')->with("Rcout",$Currentuser->Historicsavedcount)->with('timeExceed',$TimediffFormated);
        }else
            return view('Lot'); //redirect('/logout');
    }

    public function home(Request $request)
    {
        if ($request->user()->authorizeRoles(['user'])) {

            $Currentuser = User::find($request->user()->id);
            $date1 = new DateTime("now");  $getTime = strtotime($Currentuser->HistoricFirstDate ." + ".$request->user()->Historicresttime." days");
            $time = date("Y-m-d H:i:s",$getTime);
            $date2 = new DateTime($time);
            $interval = date_diff( $date1,$date2);
            $TimediffFormated = $interval->format('%a days %h hours %i Mins %s Sec remaining');

            return view('Lot')->with("Rcout",$Currentuser->Historicsavedcount)->with('timeExceed',$TimediffFormated);
        }else
            return redirect('/logout');
    }

    public function location(Request $request)
    {
        if ($request->user()->authorizeRoles(['user'])) {

            $Currentuser = User::find($request->user()->id);
            $TimediffFormated = null;
            if(!$Currentuser->IsAddressRest) {
                $date1 = new DateTime("now");
                $getTime = strtotime($Currentuser->AddressFirstDate . " + " . $request->user()->Addressresttime . " days");
                $time = date("Y-m-d H:i:s", $getTime);
                $date2 = new DateTime($time);
                $interval = date_diff($date1, $date2);
                $TimediffFormated = $interval->format('%a days %h hours %i Mins %s Sec remaining');
            }
            return view('location')->with("Rcout",$Currentuser->Addresssavedcount)->with('timeExceed',$TimediffFormated);
        }else
            return  redirect('/logout');
    }

    public function VacantProperties(Request $request)
    {
        if ($request->user()->authorizeRoles(['user'])) {

            $Currentuser = User::find($request->user()->id);
            $TimediffFormated = null;
            if(!$Currentuser->IsVacantRest) {
                $date1 = new DateTime("now");
                $getTime = strtotime($Currentuser->VacantFirstDate . " + " . $request->user()->Vacantresttime . " days");
                $time = date("Y-m-d H:i:s", $getTime);
                $date2 = new DateTime($time);
                $interval = date_diff($date1, $date2);
                $TimediffFormated = $interval->format('%a days %h hours %i Mins %s Sec remaining');
                }
            return view('VacantProperties')->with("Rcout",$Currentuser->Vacantsavedcount)->with('timeExceed',$TimediffFormated);
        }else
            return redirect('/logout');
    }
    public function ShowSave(Request $request)
    {
        if ($request->user()->authorizeRoles(['user'])) {

            $Currentuser = User::find($request->user()->id);
            $date1 = new DateTime("now");
            $getTime = strtotime($Currentuser->SavedPropertyFirstDate ." + ".$request->user()->resttime." days");
            $time = date("Y-m-d H:i:s",$getTime);
            $date2 = new DateTime($time);
            $interval = date_diff( $date1,$date2);
            $TimediffFormated = $interval->format('%a days %h hours %i Mins %s Sec remaining');
            $propertiesList = $Currentuser->properties;

            return view('SaveProperties')->with('propertiesList',$propertiesList)->with("Rcout",$Currentuser->savedcount)->with('timeExceed',$TimediffFormated);
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
