<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CityModel;
use App\Models\ReporterModel;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReporterController extends Controller
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

    public function registrationForm()
    {
        $stateData = $this->state->get();
        $cityData = $this->city->get();
        return view('website.reporter.registration', compact('stateData', 'cityData'));
    }

    public function getCity(Request $request)
    {
        // dd($request->all());
        $stateId = $request->id;
        $cityName = $this->city->select('id', 'name')
            ->where('state_id', $stateId)
            ->get();
        // Return deptName as JSON response
        if (count($cityName) > 0) {
            return response()->json(['success' => true, 'data' => $cityName, 'message' => 'Status Updated Successfully.']);
        } else {
            return response()->json(['success' => false, 'message' => 'No City available for this state.']);
        }
    }

    public function store(Request $request)
    {
        dd($request->all());
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
            $reporter->is_verified = $request->input('is_verified');
            $reporter->status = $request->input('status');
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

            // Notify admin for approval
            Mail::to('admin@example.com')->send(new ReporterPendingApproval($reporter));

            DB::commit();

            return redirect()->route('admin.reporters')->with('success', 'Data stored successfully.');
        } catch (\Exception $th) {
            DB::rollBack();
            dd($th->getMessage());
            return redirect()->back()->with('danger', 'Oops! Something went wrong. Please try again.');
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $data = $this->reporters->where('id', $id)->first();
            $stateData = $this->state->get();
            $cityData = $this->city->get();

            DB::commit();
            return view('admin.reporters.edit', compact('data', 'stateData', 'cityData'));
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to Fetch record']);
        }
    }

    public function update(Request $request, $id)
    {

        $reporter = ReporterModel::findOrFail($id);
        // Validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('reporters')->ignore($reporter->id),
            ],
            'contact' => [
                'required',
                'string',
                'max:15',
                Rule::unique('reporters')->ignore($reporter->id),
            ],
            // 'password' => 'nullable|string|min:8',
            'aadhaar_no' => 'required|string|max:12',
            'x_id' => 'required|string|max:255',
            'facebook_id' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'address' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()
                ->with('danger', $validator->errors()->first());
        }

        try {
            DB::beginTransaction();

            $reporter->name = $request->input('name');
            $reporter->email = $request->input('email');
            $reporter->contact = $request->input('contact');
            $reporter->aadhaar_no = $request->input('aadhaar_no');
            $reporter->x_id = $request->input('x_id');
            $reporter->facebook_id = $request->input('facebook_id');
            $reporter->state = $request->input('state');
            $reporter->city = $request->input('city');
            $reporter->is_verified = $request->input('is_verified');
            $reporter->status = $request->input('status');
            $reporter->address = $request->input('address');
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('admin/assets/images/reporters'), $fileName);
                $ImageData =  $fileName;
            } else {
                $ImageData = $reporter->image;
            }
            $reporter->address = $ImageData;
            $reporter->save();

            DB::commit();

            return redirect()->route('admin.reporters')->with('success', 'Data updated successfully.');
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('danger', 'Oops! Something went wrong. Please try again.');
        }
    }

    public function loginForm()
    {
        return view('website.reporter.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $reporter = ReporterModel::where('email', $request->email)->first();

        if ($reporter && $reporter->is_verified) {
            if (Auth::guard('reporter')->attempt($request->only('email', 'password'))) {
                return redirect()->route('reporter-dashboard');
            }

            return back()->withErrors(['email' => 'Invalid credentials.']);
        }

        return back()->withErrors(['email' => 'Account not approved or does not exist.']);
    }

    // Logout
    public function logout()
    {
        Auth::guard('reporter')->logout();
        return redirect()->route('reporter-login');
    }

    // Show reporter dashboard
    public function dashboard()
    {
        dd('Logged in');
        return view('reporter-dashboard');
    }
}
