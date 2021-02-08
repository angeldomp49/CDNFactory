    <x-header>
        <x-slot name="pageTitle">
            new-file
        </x-slot>
    </x-header>
    <div class="container">
        <div class="empty-space h-5em"></div>
        <div class="form-container col-8 offset-2">
            <form action="{{ route( 'new-cdn' ) }}" method="post" enctype="multipart/form-data" >
                @csrf 
                
                <div class="form-outline mb-4">
                    <label class="form-label"   for="upload-content">Select a file</label>
                    <input class="form-control" type="file" name="upload-content" id="upload-content">
                </div>
                @error( 'upload-content' ) 
                    <div class="form-outline mb-4">
                        <div class="alert alert-danger">
                            <label for=""> file-bad </label>   
                        </div>
                    </div>
                @enderror
                
                <button class="btn btn-primary" type="submit">Subir</button>
            </form>
        </div>
        <div class="empty-space h-5em"></div>
    </div>
<x-footer/>