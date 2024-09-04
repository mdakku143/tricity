<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MainMenuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MainMenuController extends Controller
{
    protected $category;

    public function __construct(MainMenuModel $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $data = $this->category->select('id', 'name', 'status')
            ->latest()->get();
        return view('admin.menu.main.index', compact('data'));
    }

    public function mainMenuForm()
    {
        return view('admin.menu.main.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()
                ->with('danger', $validator->errors()->first());
        }

        try {
            DB::beginTransaction();
            $data = new MainMenuModel();
            $data->name = $request->input('name');
            $data->slug = $request->input('slug');
            $data->status = $request->input('status');
            $data->save();
            DB::commit();

            return redirect()->route('admin.main-menu')->with('success', 'Data Store SuccessFully..');
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

            $data = $this->category->select('id', 'name', 'slug', 'status')
                ->where('id', $id)
                ->first();

            DB::commit();
            return view('admin.menu.main.edit', compact('data'));
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
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()
                ->with('danger', $validator->errors()->first());
        }

        $id = $request->input('id');

        $array = [
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'status' => $request->input('status'),
        ];

        try {
            DB::beginTransaction();
            $data = $this->category->where('id', $id)->update($array);
            DB::commit();

            return redirect()->route('admin.main-menu')->with('success', 'Data Store SuccessFully..');
        } catch (\Exception $th) {
            DB::rollBack();
            dd($th->getMessage());
            return redirect()->back()->with('danger', 'Oops ! something went wrong');
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
            $data = $this->category->where('id', $id)->update($array);
            DB::commit();
            if ($data) {
                return response()->json(['success' => true, 'data' => $data, 'message' => 'status Updated Successfully.']);
            } else {
                return response()->json(['success' => false, 'message' => 'Failed to update status.']);
            }
        } catch (\Exception $th) {
            DB::rollBack();
            dd($th->getMessage());
            return response()->json(['success' => false, 'message' => 'Oops ! something went wrong.']);
        }
    }

    public function sortable(Request $request)
    {
        try {
            DB::beginTransaction();

            $order = $request->order;

            foreach ($order as $item) {
                $category = $this->category->find($item['id']);
                if ($category) {
                    $this->category->where('id', $item['id'])->update(['position' => $item['position']]);
                }
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Update Successfully.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Update Failed. Error: ' . $e->getMessage(),
            ]);
        }
    }

    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->category->where('id', $request->id)->delete();
            DB::commit();
            return response()->json(['success' => true,  'message' => 'Record Deleted Successfully.']);
        } catch (\Exception $th) {
            DB::rollBack();
            dd($th->getMessage());
            return response()->json(['success' => false, 'message' => 'Oops ! something went wrong.']);
        }
    }
}
