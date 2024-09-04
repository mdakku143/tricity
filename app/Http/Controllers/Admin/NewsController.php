<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CityModel;
use App\Models\LiveNews;
use App\Models\MainMenuModel;
use App\Models\NewsModel;
use App\Models\ReporterModel;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    protected $news;
    protected $state;
    protected $city;
    protected $reporter;

    public function __construct(
        NewsModel $news,
        State $state,
        CityModel $city,
        ReporterModel $reporter
    ) {
        $this->news = $news;
        $this->state = $state;
        $this->city = $city;
        $this->reporter = $reporter;
    }

    public function index(Request $request)
    {
        $newsData =  $this->news->with('cities', 'states', 'reporter')
            ->orderByDesc('id')
            ->get();
        return view('admin.news.index', compact('newsData'));
    }

    public function newsForm()
    {
        $stateData =  $this->state->select('id', 'name', 'slug')
            ->where('slug', '!=', '')
            ->where('status', '1')
            ->get();
        $category = MainMenuModel::select('id', 'name', 'slug')
            ->where('slug', '!=', '')
            // ->where('status', '1')
            ->latest()->get();
        $reporterData =  $this->reporter->select('id', 'name', 'state', 'city')->get();
        return view('admin.news.create', compact('stateData', 'reporterData', 'category'));
    }

    public function getCity(Request $request)
    {
        // dd($request->all());
        $stateId = $request->id;
        $cityName = $this->city->select('id', 'name')
            ->where('slug', '!=', '')
            ->where('state_id', $stateId)
            ->where('status', '1')
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
        $rules = [
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'reporter_name' => 'required|exists:reporters,id',
            'state' => 'required|exists:states,id',
            'city' => 'required|exists:cities,id',
            'meta_seo' => 'required|string|max:255',
            'meta_desc' => 'required|string|max:255',
            'meta_keyword' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'news_detail' => 'required',
            'type' => 'required|in:1,2',
        ];

        if ($request->input('type') == 2) {
            $rules['times'] = 'required|array';
            $rules['times.*'] = 'required|string';
            $rules['headings'] = 'required|array';
            $rules['headings.*'] = 'required|string';
            $rules['sub_headings'] = 'required|array';
            $rules['sub_headings.*'] = 'required|string';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('danger', $validator->errors()->first());
        }

        try {
            DB::beginTransaction();
            $data = new NewsModel();
            $data->title = $request->input('title');
            $data->sub_title = $request->input('sub_title');
            $data->slug = $request->input('slug');
            $data->type = $request->input('type');
            $data->category = $request->input('category');
            $data->reporter_name = $request->input('reporter_name');
            $data->state = $request->input('state');
            $data->city = $request->input('city');
            $data->meta_seo = $request->input('meta_seo');
            $data->meta_desc = $request->input('meta_desc');
            $data->meta_keyword = $request->input('meta_keyword');

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('admin/assets/images/news'), $filename);
                $data->image = $filename;
            }

            $data->is_verified = $request->input('is_verified');
            $data->status = $request->input('status');
            $data->news_detail = $request->input('news_detail');
            $data->save();

            // Save live news updates if type is 2 (Live News)
            if ($request->input('type') == 2) {
                $times = $request->input('times');
                $headings = $request->input('headings');
                $sub_headings = $request->input('sub_headings');
                foreach ($times as $index => $time) {
                    LiveNews::insert([
                        'news_id' => $data->id,
                        'time' => $time,
                        'headings' => $headings[$index],
                        'sub_headings' => $sub_headings[$index],
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('admin.news')->with('success', 'Data stored successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->with('danger', 'Oops! Something went wrong.')->withInput();
        }
    }


    public function edit(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $data = $this->news->with('liveNews')
                ->where('id', $id)->first();

            // $newsDetails = LiveNews::where('news_id', $id)
            //     ->where('status', '1')
            //     ->get();

            $category = MainMenuModel::select('id', 'name', 'slug')
                ->where('slug', '!=', '')
                ->where('status', '1')
                ->latest()->get();
            $stateData =  $this->state
                ->select('id', 'name', 'slug')
                ->where('slug', '!=', '')
                ->where('status', '1')
                ->get();
            $cityData =  $this->city
                ->select('id', 'name', 'slug')
                ->where('slug', '!=', '')
                ->where('status', '1')
                ->get();
            $reporterData =  $this->reporter->get();

            DB::commit();
            return view('admin.news.edit', compact('data', 'stateData', 'cityData', 'category', 'reporterData'));
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to Fetch record']);
        }
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $rules = [
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'reporter_name' => 'required|exists:reporters,id',
            'state' => 'required|exists:states,id',
            'city' => 'required|exists:cities,id',
            'meta_seo' => 'required|string|max:255',
            'meta_desc' => 'required|string|max:255',
            'meta_keyword' => 'required|string|max:255',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'news_detail' => 'required',
            'type' => 'required|in:1,2',
        ];

        if ($request->input('type') == 2) {
            $rules['times'] = 'required|array';
            $rules['times.*'] = 'required|string';
            $rules['headings'] = 'required|array';
            $rules['headings.*'] = 'required|string';
            $rules['sub_headings'] = 'required|array';
            $rules['sub_headings.*'] = 'required|string';
        }

        $validator = Validator::make($request->all(), $rules);


        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()->with('danger', $validator->errors()->first());
        }

        try {
            DB::beginTransaction();
            $data = NewsModel::findOrFail($request->id);
            $data->title = $request->input('title');
            $data->sub_title = $request->input('sub_title');
            $data->slug = $request->input('slug');
            $data->type = $request->input('type');
            $data->category = $request->input('category');
            $data->reporter_name = $request->input('reporter_name');
            $data->state = $request->input('state');
            $data->city = $request->input('city');
            $data->meta_seo = $request->input('meta_seo');
            $data->meta_desc = $request->input('meta_desc');
            $data->meta_keyword = $request->input('meta_keyword');

            if ($request->hasFile('image')) {
                // Delete old image
                if ($data->image && file_exists(public_path('admin/assets/images/news/' . $data->image))) {
                    unlink(public_path('admin/assets/images/news/' . $data->image));
                }

                // Upload new image
                $file = $request->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('admin/assets/images/news'), $filename);
                $data->image = $filename;
            }

            $data->is_verified = $request->input('is_verified');
            $data->status = $request->input('status');
            $data->news_detail = $request->input('news_detail');
            $data->save();

            // Handle live news updates if type is 2
            if ($request->input('type') == '2') {
                LiveNews::where('news_id', $data->id)->delete(); // Clear old live news entries

                $times = $request->input('times', []);
                $headings = $request->input('headings', []);
                $sub_headings = $request->input('sub_headings', []);

                foreach ($times as $index => $time) {
                    LiveNews::insert([
                        'news_id' => $data->id,
                        'time' => $time,
                        'headings' => $headings[$index],
                        'sub_headings' => $sub_headings[$index],
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('admin.news')->with('success', 'Data updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->with('danger', 'Oops! Something went wrong.')->withInput();
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
            $data = $this->news->where('id', $id)->update($array);
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
            $this->news->where('id', $request->id)->delete();
            DB::commit();
            return response()->json(['success' => true,  'message' => 'Record Deleted Successfully.']);
        } catch (\Exception $th) {
            DB::rollBack();
            dd($th->getMessage());
            return response()->json(['success' => false, 'message' => 'Oops ! something went wrong.']);
        }
    }
}
