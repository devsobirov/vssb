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
                    <h2>Statik sahifalar @if($page->exists) {{ $page->getTranslation('title', 'uz', false) }} @endif</h2>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6>{{ $page->exists ? 'Tahrirlash' : 'Yangi yaratish' }}</h6>
        <a href="{{ route('pages.index') }}" class="btn primary-btn btn-hover">
            <i class="lni lni-arrow-left"></i> Barcha sahifalar
        </a>
    </div>

    <form class="row" action="{{ route('pages.save', $page->id) }}" method="POST">
        @csrf
        <input type="hidden" name="generalData" value="generalData">

        <div class="card-style settings-card-2 mb-30">
            <h2 class="mb-3">Umumiy ma'lumotlar</h2>
            <div class="col-12 select-style-2 input-style-1">
                <label>Yangilik menu bo'limi</label>
                <div class="select-position">
                    <select name="location">
                        <option value="">Mavjud emas</option>
                        @if($page->exists)
                            <option value="" disabled>Joriy - {{$page->location ? $page->location : 'Mavjud emas'}}</option>
                        @endif
                        @foreach(\App\Helpers\MenuHelper::pageSections() as $key => $info)
                            <option @selected($key == $page->location) value="{{$key}}">{{ucfirst($key)}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12">
                <div class="form-check checkbox-style mb-20">
                    <input class="form-check-input" @checked($page->published) type="checkbox" value="1" id="checkbox-1" name="published">
                    <label class="form-check-label" for="checkbox-1">
                        Chop etilgan @if($page->exists) (Joriy - {{ $page->published ? 'Xa' : 'Yo\'q'}}) @endif</label>
                </div>
            </div>

            @if(!$page->exists)
                @php $locale = 'uz'; @endphp
                <h2 class="my-3">Tarjimalar - {{$locale}}</h2>
                <input type="hidden" name="lang" value="{{ $locale }}">
                <div class="col-12">
                    <div class="input-style-1">
                        <label >Sarlavha - {{ $locale }}</label>
                        <input required type="text" name="{{$locale}}[title]" value="{{old($locale.'.title')}}" placeholder="Majburiy maydon">
                    </div>
                </div>

                <div class="col-12">
                    <div class="input-style-1">
                        <label>Sahifa matni - {{ $locale }}</label>
                        <textarea name="{{$locale}}[body]" class="summernote" required placeholder="Sarlavha matni" rows="10">{{old($locale.'.body')}}</textarea>
                    </div>
                </div>
            @endif
            <div class="col-12 my-3 d-flex justify-content-end">
                <button type="submit" class="main-btn primary-btn btn-hover">
                    Saqlash
                </button>
            </div>
        </div>
        <!-- end card -->
    </form>

    @if($page->exists)
        @foreach(array_reverse(config('laravellocalization.supportedLocales')) as $locale => $data)
            <form class="col-lg-12" action="{{ route('pages.save', $page->id) }}" method="POST">
                @csrf
                <input type="hidden" name="lang" value="{{ $locale }}">
                <div class="card-style settings-card-2 mb-30">
                    <h2 class="mb-2">Tarjimalar - {{$locale}}</h2>
                    <div class="col-12">
                        <div class="input-style-1">
                            <label >Sarlavha - {{ $locale }}</label>
                            <input required type="text" name="{{$locale}}[title]" value="{{$page->getTranslation('title', $locale, false)}}" placeholder="Majburiy maydon">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="input-style-1">
                            <label>Sahifa matni - {{ $locale }}</label>
                            <textarea name="{{$locale}}[body]" class="summernote" required rows="10">{{$page->getTranslation('body', $locale, false)}}</textarea>
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
    @endif
@endsection

@section('scripts')
    @include('vendor.summernote._init_script')
@endsection
