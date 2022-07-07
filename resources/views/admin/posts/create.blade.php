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
                    <h2>Yangiliklar</h2>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6>Yangi yangilik kiritish</h6>
        <a href="{{ route('posts.index') }}" class="btn primary-btn btn-hover">
            <i class="lni lni-arrow-left"></i> Barcha yangiliklar
        </a>
    </div>

    <form class="row" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="lang" value="uz">

        <div class="col-lg-12">
            <div class="card-style settings-card-2 mb-30">
                <div class="col-12 select-style-2 input-style-1">
                    <label>Yangilik kategoriyasi</label>
                    <div class="select-position">
                        <select required name="category_id">
                            <option value="">Tanlang</option>
                            @foreach($g_categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-12">
                    <div class="input-style-1">
                        <label >Sarlavha - UZ</label>
                        <input required type="text" name="uz[title]" value="{{old('uz.title')}}" placeholder="O'zbekcha - majburiy maydon">
                    </div>
                </div>

                <div class="col-12">
                    <div class="input-style-1">
                        <label>Yangilik uchun fon rasm < 300Kb</label>
                        <input type="file" name="image" accept="image/*">
                    </div>
                </div>
                <div class="col-12">
                    <div class="input-style-1">
                        <label>Yangilik matni - UZ</label>
                        <textarea name="uz[body]" class="summernote" required placeholder="O'zbekcha - yangilik matni" rows="10">{{ old('uz.body') }}</textarea>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-check checkbox-style mb-20">
                        <input class="form-check-input" type="checkbox" value="1" name="published" id="checkbox-1">
                        <label class="form-check-label" for="checkbox-1">
                            Chop etish</label>
                    </div>
                </div>

                <div class="col-12 my-3 d-flex justify-content-end">
                    <button type="submit" class="main-btn primary-btn btn-hover">
                        Saqlash
                    </button>
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end card -->
    </form>

@endsection

@section('scripts')
    @include('vendor.summernote._init_script')
@endsection
