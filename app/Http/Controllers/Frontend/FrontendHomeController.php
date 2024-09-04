<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CityModel;
use App\Models\MainMenuModel;
use App\Models\NewsModel;
use Illuminate\Http\Request;

class FrontendHomeController extends Controller
{

    protected $news;

    public function __construct(
        NewsModel $news
    ) {
        $this->news = $news;
    }

    public function index(Request $request, $slug = null)
    {
        if (isset($slug)) {
            $category = $slug;
            $categoryData = MainMenuModel::select('id',)->where('slug', $category)->first();
        }

        $newsQuery = $this->news->with('states', 'cities', 'reporter', 'newsCategory')
            ->select('id', 'title', 'sub_title', 'news_detail', 'reporter_name', 'category', 'image', 'slug', 'state', 'city', 'created_at')
            ->whereNotNull('slug')
            ->where('status', '1')
            ->where('is_verified', '1');

        // Apply the category condition only if slug is present
        if ($slug) {
            $newsQuery->where('category', $categoryData->id);
        }

        // Get the latest news
        $latestNewsQuery = clone $newsQuery;

        $latestNews = $latestNewsQuery->latest()->first();
        $news = $newsQuery->where('id', '!=', $latestNews->id)
            ->latest()
            ->get();
        return view('website.home.index', compact('slug', 'latestNews', 'news'));
    }

    public function categoryDetailNews(Request $request)
    {
        $city = $request->city;
        $slug = $request->slug;

        $cityData = CityModel::select('id')->where('slug', $city)->first();
        if (isset($slug)) {
            $categoryData = MainMenuModel::select('id',)->where('slug', $slug)->first();
        }

        $newsQuery = $this->news->with('states', 'cities', 'reporter', 'newsCategory')
            ->select('id', 'title', 'sub_title', 'news_detail', 'reporter_name', 'category', 'image', 'slug', 'state', 'city', 'created_at')
            ->whereNotNull('slug')
            ->where('status', '1')
            ->where('is_verified', '1');

        // Apply the category condition only if slug is present
        // if ($slug) {
        //     $newsQuery->where('category', $categoryData->id);
        // }

        // Get the latest news
        $latestNewsQuery = clone $newsQuery;

        $latestNews = $latestNewsQuery
            ->where('slug', $slug)
            ->where('city', $cityData->id)
            ->first();
        // dd($latestNews);

        $news = $newsQuery->where('id', '!=', $latestNews->id)
            ->where('city', $cityData->id)
            ->latest()
            ->get();
        return view('website.home.category_wise_news', compact('slug', 'latestNews', 'news'));
    }
}
