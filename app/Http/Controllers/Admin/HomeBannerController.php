<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HomeBannerController extends Controller
{
    protected $homeBanner;

    public function __construct(
        HomeBanner $homeBanner
    ) {
        $this->homeBanner = $homeBanner;
    }

    public function index(Request $request)
    {
        $homeData = $this->homeBanner->select('id', 'title', 'sub_title', 'image', 'status')
            ->orderByDesc('id')
            ->get();
        // dd($homeData);
        return view('admin.home.banner.index', compact('homeData'));
    }

    public function bannerForm()
    {
        return view('admin.home.banner.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()
                ->with('danger', $validator->errors()->first());
        }

        try {
            DB::beginTransaction();
            $data = new HomeBanner();
            $data->title = $request->input('title');
            $data->sub_title = $request->input('sub_title');

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('admin/assets/images/homebanner'), $fileName);
                $data->image = $fileName;
            }
            $data->status = $request->input('status');
            $data->save();
            DB::commit();

            return redirect()->route('admin.home-banner')->with('success', 'Data Store SuccessFully..');
        } catch (\Exception $th) {
            DB::rollBack();
            // dd($th->getMessage());
            return redirect()->back()->withInput()->with('danger', 'Oops ! something went wrong');
        }
    }
    public function edit(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $data = $this->homeBanner->where('id', $id)->first();
            DB::commit();
            return view('admin.home.banner.edit', compact('data'));
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to Fetch record']);
        }
    }
    public function update(Request $request)
    {
        // dd($request->all());
        // $validator = Validator::make($request->all(), [
        //     'title' => 'required',
        //     'sub_title' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput()
        //         ->with('danger', $validator->errors()->first());
        // }

        try {
            $id = $request->input('id');
            $checkData = $this->homeBanner->where('id', $id)->first();

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('admin/assets/images/homebanner'), $fileName);
                $ImageData = $fileName;
            } else {
                $ImageData = $checkData->image;
            }

            $array = [
                'title' => $request->input('title'),
                'sub_title' => $request->input('sub_title'),
                'image' => $ImageData,
                'status' => $request->input('status'),
            ];

            DB::beginTransaction();
            $data = $this->homeBanner->where('id', $id)->update($array);
            DB::commit();
            return redirect()->route('admin.home-banner')->with('success', 'Data Updated SuccessFully..');
        } catch (\Exception $th) {
            DB::rollBack();
            // dd($th->getMessage());
            return redirect()->back()->withInput()->with('danger', 'Oops ! something went wrong');
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
            $data = $this->homeBanner->where('id', $id)->update($array);
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

    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->homeBanner->where('id', $request->id)->delete();
            DB::commit();
            return response()->json(['success' => true,  'message' => 'Record Deleted Successfully.']);
        } catch (\Exception $th) {
            DB::rollBack();
            dd($th->getMessage());
            return response()->json(['success' => false, 'message' => 'Oops ! something went wrong.']);
        }
    }
}
