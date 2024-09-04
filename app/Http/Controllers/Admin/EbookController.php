<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EbookModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EbookController extends Controller
{
    protected $ebooks;

    public function __construct(
        EbookModel $ebooks
    ) {
        $this->ebooks = $ebooks;
    }

    public function index()
    {
        $data = $this->ebooks->orderByDesc('id')->get();
        // dd($data);
        return view('admin.ebooks.index', compact('data'));
    }

    public function ebookForm()
    {
        return view('admin.ebooks.create');
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
            $data = $this->ebooks->where('id', $id)->update($array);
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
            'file' => 'required|file|mimes:pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()
                ->with('danger', $validator->errors()->first());
        }

        try {
            DB::beginTransaction();
            $data = new EbookModel();
            $data->name = $request->input('name');
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('admin/assets/images/ebooks'), $fileName);
                $data->file = $fileName;
            }

            $data->status = $request->input('status');
            $data->save();

            DB::commit();

            // $allData = $this->countries->get();
            return redirect()->route('admin.ebooks')->with('success', 'Data Store SuccessFully..');
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

            $data = $this->ebooks->where('id', $id)->first();

            DB::commit();
            return view('admin.ebooks.edit', compact('data'));
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to Fetch record']);
        }
    }

    public function update(Request $request)
    {
        $ebooks = EbookModel::findOrFail($request->id);

        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()
                ->with('danger', $validator->errors()->first());
        }

        try {
            DB::beginTransaction();

            $ebooks->name = $request->input('name');
            $ebooks->status = $request->input('status');

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('admin/assets/images/ebooks'), $fileName);
                $ebookFile =  $fileName;
            } else {
                $ebookFile = $ebooks->file;
            }

            $ebooks->file = $ebookFile;
            $ebooks->save();

            DB::commit();

            return redirect()->route('admin.ebooks')->with('success', 'Data Updated SuccessFully..');
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
            EbookModel::where('id', $request->id)->delete();
            DB::commit();
            return response()->json(['success' => true,  'message' => 'Record Deleted Successfully.']);
        } catch (\Exception $th) {
            DB::rollBack();
            dd($th->getMessage());
            return response()->json(['success' => false, 'message' => 'Oops ! something went wrong.']);
        }
    }
}
