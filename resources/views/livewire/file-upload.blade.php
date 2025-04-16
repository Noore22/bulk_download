<div>
    <h2>Upload and View Files</h2>

    @if (session()->has('message'))
        <div style="color: green;">{{ session('message') }}</div>
    @endif

    <input type="file" wire:model="file">
    <button wire:click="upload">Upload</button>

    <h3>Uploaded Files:</h3>
    <ul>
        @foreach ($files as $file)
            <li>
                @php $filePath = asset('storage/' . $file); @endphp
                @if (Str::endsWith($file, ['jpg', 'jpeg', 'png']))
                    <img src="{{ $filePath }}" width="100">
                @elseif (Str::endsWith($file, 'pdf'))
                    <a href="{{ $filePath }}" target="_blank">View PDF</a>
                @endif
            </li>
        @endforeach
    </ul>
</div>
