<?php

namespace App\Http\Controllers\Reporter\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

namespace App\Http\Controllers\Reporter\Auth;

use App\Models\Reporter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\CityModel;
use App\Models\ReporterModel;
use App\Models\State;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class ReporterAuthController extends Controller
{

    protected $reporters;
    protected $state;
    protected $city;

    public function __construct(
        ReporterModel $reporters,
        State $state,
        CityModel $city,
    ) {
        $this->reporters = $reporters;
        $this->state = $state;
        $this->city = $city;
    }

    public function dashboard(Request $request)
    {
        $auth = Auth::guard('reporter')->user();
        if (Auth::guard('reporter')->user()) {
            if ($auth->is_verified == 0) {
                return redirect()->route('reporter.verification.notice');
            } elseif ($auth->status == 0) {
                dd('Admin');
            } else {
                return view('reporter.dashboard');
            }
        } else {
            dd('Bye');
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('reporter')->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('reporter.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function registrationForm()
    {
        $stateData = $this->state->get();
        $cityData = $this->city->get();
        return view('reporter.auth.register', compact('stateData', 'cityData'));
    }


    public function register(Request $request)
    {
        // dd($request->all());
        // Validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:reporters,email',
            'contact' => 'required|numeric|digits_between:1,15|unique:reporters,contact',
            'password' => 'required|string|min:8',
            'aadhaar_no' => 'required|string|max:12',
            'x_id' => 'required|string|max:255',
            'facebook_id' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'address' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()
                ->with('danger', $validator->errors()->first());
        }

        try {
            DB::beginTransaction();

            $reporter = new ReporterModel();
            $reporter->name = $request->input('name');
            $reporter->email = $request->input('email');
            $reporter->contact = $request->input('contact');
            $reporter->password = Hash::make($request->input('password'));
            $reporter->aadhaar_no = $request->input('aadhaar_no');
            $reporter->x_id = $request->input('x_id');
            $reporter->facebook_id = $request->input('facebook_id');
            $reporter->state = $request->input('state');
            $reporter->city = $request->input('city');
            $reporter->address = $request->input('address');

            // Handle file upload
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('admin/assets/images/reporters'), $fileName);
                $reporter->image = $fileName;
            }

            $reporter->save();

            // Send email verification notification
            event(new Registered($reporter));
            DB::commit();

            Auth::guard('reporter')->login($reporter);

            return redirect()->route('reporter.verification.notice');

            // return redirect()->route('reporter-login')->with('success', 'Your have Registered successfully. Please verify your email.');
        } catch (\Exception $th) {
            DB::rollBack();
            dd($th->getMessage());
            return redirect()->back()->with('danger', 'Oops! Something went wrong. Please try again.');
        }
    }

    public function logout(Request $request)
    {
        // dd($request->all());
        Auth::guard('reporter')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('reporter.login');
    }
}
