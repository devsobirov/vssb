<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PersonController extends Controller
{
    public function index()
    {
        $persons = Person::orderByDesc('priority')->paginate(15);
        return view('admin.person.index', compact('persons'));
    }

    public function form($id = null)
    {
        $person = Person::getOrCreatePerson($id);
        return view('admin.person.form', compact('person'));
    }

    public function save(Request $request, $id = null)
    {
        $person = Person::getOrCreatePerson($id);
        $locales = $request->lang;

        if ($request->generalData) {
            $person->name = $request->name;
            $person->priority = $request->priority;
            $person->phone = $request->phone;
            $person->email = $request->email;
            if ($img = $request->image) {
                $person->image = $this->handleIfUploadedImage($img);
            }
        }

        foreach ($locales as $lang => $data) {
            $this->handleTranslation($person, $lang, $data);
        }

        $result = $person->save();
        if ($result) {
            return redirect()->route('person.form', $person->id)->with(['success' => "Muvaffaqiyatli saqlandi!"]);
        }
        return redirect()->back()->withErrors(['msg' => "No'malum xatolik, qayta urinib ko'ring"]);
    }

    public function delete(Person $person)
    {
        //TODO:: delete appointment time relations if added
        $img = $person->image;
        $person->delete();
        if ($img && File::exists(public_path($img))) {
            File::delete(public_path($img));
        }
        return redirect()->back()->with(['success' => "Muvaffaqiyatli o'chirildi!"]);
    }

    private function handleIfUploadedImage($img) : ?string
    {
        $imagePath = null;
        if (!empty($img)) {
            $filename = time().'_'.$img->getClientOriginalName();
            $base_path = Person::IMAGE_BASE_DIR;

            $img->move(public_path($base_path), $filename);
            $imagePath = $base_path. '/'.$filename;
        }
        return $imagePath;
    }

    private function handleTranslation($model,string $lang, array $data) : void
    {
        foreach ($data as $property => $value) {
            $model->setTranslation($property, $lang, $value);
        }
    }
}
