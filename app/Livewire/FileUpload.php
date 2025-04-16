<?php


namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class FileUpload extends Component
{
    use WithFileUploads;

    public $file;
    public $files = [];

    public function mount()
    {
        $this->loadFiles();
    }

    public function upload()
    {
        $this->validate([
            'file' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        // Store in 'storage/app/public/uploads'
        $path = $this->file->store('uploads', 'public');

        // Refresh file list
        $this->loadFiles();
        $this->file = null;

        session()->flash('message', 'File uploaded successfully!');
    }

    public function loadFiles()
    {
        $this->files = Storage::disk('public')->files('uploads');
    }

    public function render()
    {
        return view('livewire.file-upload');
    }
}
