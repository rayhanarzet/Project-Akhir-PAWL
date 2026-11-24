<div class="flex gap-3 flex-wrap">
@foreach($submission->photos as $photo)
    @php
        $isBase64 = str_starts_with($photo->file_path, 'data:image/');
        $src = $isBase64 ? $photo->file_path : route('photos.show', $photo);
    @endphp
    <a href="{{ $src }}" target="_blank" rel="noopener" class="block w-24 h-24 rounded-xl overflow-hidden border border-line hover:opacity-90 transition-opacity">
        <img src="{{ $src }}" loading="lazy" class="w-full h-full object-cover" alt="Bukti kegiatan, foto {{ $loop->iteration }}">
    </a>
@endforeach
</div>
