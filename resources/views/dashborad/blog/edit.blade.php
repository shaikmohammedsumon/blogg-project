@extends('layouts.dashboradmaster')

@section('content')
<x-breadcum sumon="Edit Blog Page" > </x-breadcum>

<h1>Edit Blog</h1>

<div class="row">
    <div class="col-11">
        <div class="card">
            <div class="cord-head p-3">
                <h3>Blog Insert</h3>
            </div>
            <div class="cord-body p-3">
                <form role="form" action="{{route('blog.update',$blogs->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Blog Category</label>
                        <div class="col-sm-9">
                            <select class="form-control" data-toggle="select2" name="category_id">
                                
                                <optgroup label="{{env('APP_SLOGON')}}">
                                    @foreach ($categorys as $category)
                                    <option {{ ($category->id == $blogs->category_id) ? 'selected' : '' }} value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                </optgroup>
                                
                            </select>
                            @error('category_id')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Blog Title</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="inputEmail3" placeholder="title" name="title" value="{{$blogs->title}}">
                            @error('title')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Blog Slug</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="slug" name="slug"  value="{{$blogs->slug}}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Blog Thumbnail</label>
                        <div class="col-sm-9">
                            <picture>
                                <img id="port_image" src="{{asset('uploads/blog')}}/{{$blogs->thumbnail}}" alt="" style="width:100%; height: 200px; object-fit:contain;">
                            </picture>

                            <input onchange="document.getElementById('port_image').src =window.URL.createObjectURL(this.files[0])" type="file" class="form-control @error('thumbnail') is-invalid @enderror" id="inputEmail3" placeholder="thumbnail" name="thumbnail">
                            @error('thumbnail')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Blog Short Descprition</label>
                        <div class="col-sm-9">
                            <textarea type="file" class="form-control @error('short_descripion') is-invalid @enderror" id="short_descprition" name="short_descripion" rows="5">  {{$blogs->short_descripion}}</textarea>
                            @error('short_descripion')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    

                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Blog Descprition</label>
                        <div class="col-sm-9">
                            <textarea type="file" class="form-control @error('descripion') is-invalid @enderror" id="descprition" name="long_descripion" rows="10"> {{$blogs->long_descripion}} </textarea>
                            @error('descripion')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    


                    <div class="justify-content-end row">
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    
@endsection



@section('script')

<script>
    tinymce.init({
      selector: '#short_descprition',
      plugins: [
        // Core editing features
        'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
        // Your account includes a free trial of TinyMCE premium features
        // Try the most popular premium features until Oct 23, 2024:
        'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown',
      ],
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ],
      ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
    });

</script>


<script>
    tinymce.init({
      selector: '#descprition',
      plugins: [
        // Core editing features
        'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
        // Your account includes a free trial of TinyMCE premium features
        // Try the most popular premium features until Oct 23, 2024:
        'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown',
      ],
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ],
      ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
    });

</script>

@endsection