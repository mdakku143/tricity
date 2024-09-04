<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\CityModel;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    protected $cities;
    protected $states;

    public function __construct(
        CityModel $cities,
        State $states,
    ) {
        $this->cities = $cities;
        $this->states = $states;
    }

    public function index()
    {
        $data = $this->cities->with('states')->orderByDesc('id')->get();
        // dd($data);
        return view('admin.menu.cities.index', compact('data'));
    }

    public function cityForm()
    {
        $states = $this->states->orderBy('name', 'asc')->get();
        return view('admin.menu.cities.create', compact('states'));
    }

    // public function checkCity(Request $request)
    // {
    //     $cityName = $request->input('name');
    //     $exists = $this->cities->where('name', $cityName)->exists();
    //     return response()->json(['exists' => $exists]);
    // }

    public function checkCity(Request $request)
    {
        $id = $request->input('id');
        $cityName = $request->input('name');

        if ($id) {
            $exists = $this->cities->where('name', $cityName)
                ->where('id', '!=', $id)
                ->exists();
        } else {
            $exists = $this->cities->where('name', $cityName)->exists();
        }

        return response()->json([
            'success' => !$exists,
            'exists' => $exists
        ]);
    }

    public function toggleStatus(Request $request)
    {
        // dd($request->all());
        try {
            $id = $request->input('id');
            $status = $request->input('status');

            $array = [
                'status' => $status
            ];

            DB::beginTransaction();
            $data = $this->cities->where('id', $id)->update($array);
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

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required',
            'state_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()
                ->with('danger', $validator->errors()->first());
        }

        try {
            DB::beginTransaction();
            $data = new CityModel();
            $data->state_id = $request->input('state_id');
            $data->name = $request->input('name');
            $data->slug = $request->input('slug');
            $data->status = $request->input('status');
            $data->save();
            DB::commit();

            // $allData = $this->states->get();
            return redirect()->route('admin.cities')->with('success', 'Data Store SuccessFully..');
        } catch (\Exception $th) {
            DB::rollBack();
            dd($th->getMessage());
            return redirect()->back()->with('danger', 'Oops ! something went wrong');
        }
    }
    public function edit(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $data = $this->cities->where('id', $id)->first();
            $states = $this->states->get();

            DB::commit();
            return view('admin.menu.cities.edit', compact('data', 'states'));
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to Fetch record']);
        }
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required',
            'state_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()
                ->with('danger', $validator->errors()->first());
        }

        try {
            $id = $request->input('id');

            $state_id = $request->input('state_id');
            $name = $request->input('name');
            $status = $request->input('status');
            $slug = $request->input('slug');

            DB::beginTransaction();
            $data = $this->cities->where('id', $id)->update([
                'state_id' => $state_id,
                'name' => $name,
                'slug' => $slug,
                'status' => $status
            ]);
            DB::commit();

            return redirect()->route('admin.cities')->with('success', 'Data Updated SuccessFully..');
        } catch (\Exception $th) {
            DB::rollBack();
            dd($th->getMessage());
            return redirect()->back()->with('danger', 'Oops ! something went wrong');
        }
    }

    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->cities->where('id', $request->id)->delete();
            DB::commit();
            return response()->json(['success' => true,  'message' => 'Record Deleted Successfully.']);
        } catch (\Exception $th) {
            DB::rollBack();
            dd($th->getMessage());
            return response()->json(['success' => false, 'message' => 'Oops ! something went wrong.']);
        }
    }
}
