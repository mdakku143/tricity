<?php

namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;

use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StateController extends Controller
{
    protected $states;
    protected $countries;

    public function __construct(
        State $states,
        Country $countries
    ) {
        $this->states = $states;
        $this->countries = $countries;
    }

    public function index()
    {
        $data = $this->states->with('countries')->orderByDesc('id')->get();
        // dd($data);
        return view('admin.menu.states.index', compact('data'));
    }

    public function stateForm()
    {
        $countries = $this->countries->get();
        return view('admin.menu.states.create', compact('countries'));
    }

    public function checkState(Request $request)
    {
        $id = $request->input('id');
        $stateName = $request->input('name');

        if ($id) {
            $exists = State::where('name', $stateName)
                ->where('id', '!=', $id)
                ->exists();
        } else {
            $exists = State::where('name', $stateName)->exists();
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
            $data = $this->states->where('id', $id)->update($array);
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
            'country_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()
                ->with('danger', $validator->errors()->first());
        }

        try {
            DB::beginTransaction();
            $data = new State();
            $data->country_id = $request->input('country_id');
            $data->name = $request->input('name');
            $data->slug = $request->input('slug');
            $data->status = $request->input('status');
            $data->save();
            DB::commit();

            // $allData = $this->countries->get();
            return redirect()->route('admin.states')->with('success', 'Data Store SuccessFully..');
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

            $data = State::where('id', $id)->first();
            $countries = $this->countries->get();

            DB::commit();
            return view('admin.menu.states.edit', compact('data', 'countries'));
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
            'country_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()
                ->with('danger', $validator->errors()->first());
        }

        try {
            $id = $request->input('id');
            $country_id = $request->input('country_id');
            $name = $request->input('name');
            $slug = $request->input('slug');
            $status = $request->input('status');

            DB::beginTransaction();
            $data = State::where('id', $id)->update([
                'country_id' => $country_id,
                'name' => $name,
                'slug' => $slug,
                'status' => $status
            ]);
            DB::commit();

            return redirect()->route('admin.states')->with('success', 'Data Updated SuccessFully..');
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
            State::where('id', $request->id)->delete();
            DB::commit();
            return response()->json(['success' => true,  'message' => 'Record Deleted Successfully.']);
        } catch (\Exception $th) {
            DB::rollBack();
            dd($th->getMessage());
            return response()->json(['success' => false, 'message' => 'Oops ! something went wrong.']);
        }
    }
}
