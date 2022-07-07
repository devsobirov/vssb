@extends('layouts.app')

@section('styles')
    @include('vendor.summernote._init_links')
@endsection

@section('content')

    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Yangiliklar - {{ $post->getTranslation('title', 'uz', false) }}</h2>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6>Tahrirlash</h6>
        <a href="{{ route('posts.index') }}" class="btn primary-btn btn-hover">
            <i class="lni lni-arrow-left"></i> Barcha yangiliklar
        </a>
    </div>

    <form class="row" action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PATCH')
        <input type="hidden" name="generalData" value="generalData">

        <div class="card-style settings-card-2 mb-30">
            <h2 class="mb-2">Umumiy ma'lumotlar</h2>
            <div class="row align-items-center">
                <div class="col-6">
                    <div class="input-style-1 p-3">
                        <img class="mw-100 shadow-sm" src="{{ asset($post->image_path()) }}">
                    </div>
                </div>
                <div class="col-6">
                    <div class="col-12 select-style-2 input-style-1">
                        <label>Yangilik kategoriyasi</label>
                        <div class="select-position">
                            <select required name="category_id">
                                <option value="" selected disabled>Joriy - {{$post->category->name}}</option>
                                @foreach($g_categories as $category)
                                    <option @selected($category->id == $post->category_id) value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-style-1">
                            <label>Yangi rasm tanlash< 300Kb</label>
                            <input type="file" name="image" accept="image/*">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-check checkbox-style mb-20">
                            <input class="form-check-input" @checked($post->published) type="checkbox" value="1" id="checkbox-1" name="published">
                            <label class="form-check-label" for="checkbox-1">
                                Chop etilgan (Joriy - {{ $post->published ? 'Xa' : 'Yo\'q'}})</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 my-3 d-flex justify-content-end">
                <button type="submit" class="main-btn primary-btn btn-hover">
                    Saqlash
                </button>
            </div>
        </div>
        <!-- end card -->
    </form>

    @foreach(array_reverse(config('laravellocalization.supportedLocales')) as $locale => $data)
        <form class="col-lg-12" action="{{ route('posts.update', $post->id) }}" method="POST">
            @csrf @method('PATCH')
            <input type="hidden" name="lang" value="{{ $locale }}">
            <div class="card-style settings-card-2 mb-30">
                <h2 class="mb-2">Tarjimalar - {{$locale}}</h2>
                <div class="col-12">
                    <div class="input-style-1">
                        <label >Sarlavha - {{ $locale }}</label>
                        <input required type="text" name="{{$locale}}[title]" value="{{$post->getTranslation('title', $locale, false)}}" placeholder="Majburiy maydon">
                    </div>
                </div>

                <div class="col-12">
                    <div class="input-style-1">
                        <label>Yangilik matni - {{ $locale }}</label>
                        <textarea name="{{$locale}}[body]" class="summernote" required placeholder="Yangilik matni" rows="10">{{$post->getTranslation('body', $locale, false)}}</textarea>
                    </div>
                </div>

                <div class="col-12 my-3 d-flex justify-content-end">
                    <button type="submit" class="main-btn primary-btn btn-hover">
                        Saqlash
                    </button>
                </div>
            </div>
        </form>
    @endforeach
@endsection

@section('scripts')
    @include('vendor.summernote._init_script')
@endsection
