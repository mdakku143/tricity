<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\CityModel;
use App\Models\ReporterModel;
use App\Models\State;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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

    public function index(Request $request)
    {
        $data = $this->reporters->with('states', 'cities')
            ->select('id', 'name', 'state', 'city', 'email', 'contact', 'status')
            ->get()->reverse();
        // dd($data);
        return view('admin.reporters.index', compact('data'));
    }

    public function reporterForm()
    {
        $stateData = $this->state->get();
        $cityData = $this->city->get();
        return view('admin.reporters.create', compact('stateData', 'cityData'));
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
            'upload_aadhaar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'address' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()
                ->with('danger', $validator->errors()->first());
        }

        try {
            DB::beginTransaction();

            $data = new ReporterModel();
            $data->name = $request->input('name');
            $data->email = $request->input('email');
            $data->contact = $request->input('contact');
            $data->password = Hash::make($request->input('password'));
            $data->aadhaar_no = $request->input('aadhaar_no');
            $data->x_id = $request->input('x_id');
            $data->facebook_id = $request->input('facebook_id');
            $data->state = $request->input('state');
            $data->city = $request->input('city');
            $data->is_verified = $request->input('is_verified');
            $data->status = $request->input('status');
            $data->address = $request->input('address');

            // Handle file upload
            if ($request->hasFile('upload_aadhaar')) {
                $file = $request->file('upload_aadhaar');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('admin/assets/images/reporters'), $fileName);
                $data->upload_aadhaar = $fileName;
            }

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('admin/assets/images/reporters'), $fileName);
                $data->image = $fileName;
            }

            $data->save();

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

    public function update(Request $request)
    {
        $reporter = ReporterModel::findOrFail($request->id);
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

            if ($request->hasFile('upload_aadhaar')) {
                $file = $request->file('upload_aadhaar');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('admin/assets/images/reporters'), $fileName);
                $aadharImage =  $fileName;
            } else {
                $aadharImage = $reporter->upload_aadhaar;
            }

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('admin/assets/images/reporters'), $fileName);
                $ImageData =  $fileName;
            } else {
                $ImageData = $reporter->image;
            }

            $reporter->upload_aadhaar = $aadharImage;
            $reporter->image = $ImageData;
            $reporter->save();

            DB::commit();

            return redirect()->route('admin.reporters')->with('success', 'Data updated successfully.');
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('danger', 'Oops! Something went wrong. Please try again.');
        }
    }


    public function toggleStatus(Request $request)
    {
        try {
            $id = $request->input('id');
            $status = $request->input('status');

            $array = [
                'status' => $status
            ];

            DB::beginTransaction();
            $data = $this->reporters->where('id', $id)->update($array);
            DB::commit();
            if ($data) {
                return response()->json(['success' => true, 'data' => $data, 'message' => 'Status Updated Successfully.']);
            } else {
                return response()->json(['success' => false, 'message' => 'Failed to update status.']);
            }
        } catch (\Exception $th) {
            DB::rollBack();
            dd($th->getMessage());
            return response()->json(['success' => false, 'message' => 'Oops ! something went wrong.']);
        }
    }

    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->reporters->where('id', $request->id)->delete();
            DB::commit();
            return response()->json(['success' => true,  'message' => 'Record Deleted Successfully.']);
        } catch (\Exception $th) {
            DB::rollBack();
            dd($th->getMessage());
            return response()->json(['success' => false, 'message' => 'Oops ! something went wrong.']);
        }
    }
}
