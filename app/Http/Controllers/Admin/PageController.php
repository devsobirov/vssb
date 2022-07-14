<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::select(['id','title','published','created_at','location'])
            ->location()
            ->orderBy('id', 'desc')
            ->paginate(15);
        return view('admin.pages.index', compact('pages'));
    }

    public function form($pageId = null)
    {
        $page = Page::getOrCreatePage($pageId);
        return view('admin.pages.form', compact('page'));
    }

    public function save(Request $request, $pageId = null)
    {
        $page = Page::getOrCreatePage($pageId);

        if ($request->generalData) {
            $page->published = boolval($request->published);
            $page->location = !empty($request->location) ? strtolower($request->location) : null;
        }
        if ($lang = $request->lang) {
            $this->handleTranslation($page, $lang, $request->$lang);
        }

        $result = $page->save();
        if ($result) {
            return redirect()->route('pages.form', $page->id)->with(['success' => "Muvaffaqiyatli saqlandi!"]);
        }
        return redirect()->back()->withErrors(['msg' => "No'malum xatolik, qayta urinib ko'ring"]);
    }

    private function handleTranslation($page,string $lang, array $data) : void
    {
        foreach ($data as $property => $value) {
            $page->setTranslation($property, $lang, $value);
        }
    }
}
