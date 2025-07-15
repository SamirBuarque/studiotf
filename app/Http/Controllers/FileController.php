<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\File;
use App\Models\EventRecord;

class FileController extends Controller
{
    public function upload(Request $request, EventRecord $eventRecord)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,png,pdf,doc,docx|max:5120',
        ]);

        $uploadedFile = $request->file('file');
        $extension = $uploadedFile->getClientOriginalExtension();
        $originalFileName = $uploadedFile->getClientOriginalName();

        $directory = 'uploads/' . date('Y-m-d');
        $filename = Str::uuid() . '.' . $extension;
        $path = "$directory/$filename";

        try {
            Storage::disk('backblaze')->put(
                $path,
                file_get_contents($uploadedFile->getRealPath())
            );

            $file = File::create([
                'path' => $path,
                'original_name' => $originalFileName,
                'mime_type' => $uploadedFile->getMimeType(),
                'size' => $uploadedFile->getSize(),
                'extension' => $extension,
                'event_record_id' => $eventRecord->id,
                'disk' => 'backblaze'
            ]);

            $tempUrl = Storage::disk('backblaze')->temporaryUrl(
                $path,
                now()->addMinutes(30)
            );
            return back()->with(['success' => 'Arquivo enviado com sucesso']);

        } catch (\Exception $e) {
            return back()->with(['error' => 'Erro ao enviar arquivo' . $e->getMessage()]);
        }

    }

    public function download($fileId)
    {
        //
    }

    public function view(EventRecord $eventRecord, $fileId)
    {
        try {
            $file = File::findOrFail($fileId);

            $viewableTypes = ['image/jpeg', 'image/png', 'application/pdf'];

            if (!in_array($file->mime_type, $viewableTypes)) {
                return $this->download($fileId);
            }

            $url = Storage::disk('backblaze')->temporaryUrl(
                $file->path,
                now()->addMinutes(30)
            );

            return view('files.view', [
                'url' => $url,
                'file' => $file
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function destroy(EventRecord $eventRecord, File $file)
    {
        try {
            Storage::disk('backblaze')->delete($file->path);
            $file->delete();
            return back()->with('success', 'Arquivo excluído com sucesso');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao excluir arquivo: ' . $e->getMessage());
        }
    }


}
