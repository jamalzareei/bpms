@forelse ($filesPi as $file)
    <div class="row row-upload-1 border-bottom border-3 py-25" id="item-row-'{{$file->id}}">
        
        <div class="col-5">
            <label>{{$file->title}}</label>
        </div>
        <div class="col-5">
            <a href="{{ route('pages.pi.download.file', ['id'=>$file->id]) }}">
                <i class="fas fa-eye"></i>
            </a>
        </div>
        <div class="col-2">
            <i class="fas fa-minus text-danger" onclick="deleteRow('{{ route('pages.pi.upload.file', ['id' => $file->id]) }}', $file->id)"></i>
        </div>
    </div>
@empty
    
@endforelse