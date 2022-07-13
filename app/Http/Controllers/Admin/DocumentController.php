<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class DocumentController extends Controller
{
    public function list($category)
    {
        $docs = Document::where('category', $category)->paginate();
        return view('admin.documents.list', compact('category', 'docs'));
    }

    public function save(Request $request, $id = null)
    {
        $document = Document::getOrCreate($id);
        $document->name = $request->name;
        if ($file = $request->file('document')) {
            $document->path = $this->handleUploadedFile($file);
            $document->size = $this->getFileSize($file);
        }
        if ($category = $request->category) $document->category = $category;
        $result = $document->save();
        if ($result) {
            return redirect()->back()->with(['success' => 'Muvaffaqiyatli saqlandi!']);
        }
        return redirect()->back()->withErrors(['msg' => 'Noma\'lum xatolik, qayta urinib ko\'ring']);
    }

    public function delete(Document $document)
    {
        $file = $document->path;
        $document->delete();
        if (\File::exists(public_path($file))) {
            \File::delete(public_path($file));
        }
        return redirect()->back()->with(['success' => 'Muvaffaqiyatli o\'chirildi!']);
    }

    public function download(Document $document)
    {
        $document->downloaded++;
        $document->save();

        return response()->download(public_path($document->path));
    }

    private function handleUploadedFile(UploadedFile $file): string
    {
        $dir = Document::BASE_DIR. '/'. date('Y-m');
        $filename = time().'_.'.$file->getClientOriginalExtension();
        $file->move(public_path($dir), $filename);

        return $dir. '/'. $filename;
    }

    private function getFileSize(UploadedFile $file) : string
    {
        $kb = round($file->getSize() / 1024, 2);
        if ($kb < 1024) return $kb. ' Kb';
        return round($kb / 1024, 3) . 'Mb';
    }
}
