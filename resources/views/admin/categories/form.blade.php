@extends('layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Yangilik kategoriyalari</h2>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6 class="mb-10">
            {{!$category->exists ? 'Yangi kategoriya yaratish'
                                : "'".$category->getTranslation('name', 'uz', false). "' kategoriyasini tahrirlash"}}
        </h6>
        <a href="{{ route('categories.index') }}" class="btn primary-btn btn-hover">
            <i class="lni lni-arrow-left"></i> Barcha kategoriyalar
        </a>
    </div>

    <form class="row" action="{{ route('categories.save', $category->id) }}" method="POST">
        @csrf
        <div class="col-lg-12">
            <div class="card-style settings-card-2 mb-30">
                <div class="title mb-30">
                    <h6>Kategoriya nomi</h6>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="input-style-1">
                            <label>O'zbekcha <img src="{{ asset('images/general/lang/UZ.png') }}" height="20px"></label>
                            <input required type="text" name="name[uz]"
                                   value="{{ $category->exists ? $category->getTranslation('name', 'uz', false) : old('name.uz')  }}"
                                   placeholder="O'zbekcha - majburiy maydon">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-style-1">
                            <label>Ruscha <img src="{{ asset('images/general/lang/RU.png') }}" height="20px"></label>
                            <input type="text" name="name[ru]"
                                   value="{{ $category->exists ? $category->getTranslation('name', 'ru', false) : old('name.ru') }}"
                                   placeholder="Ruscha - majburiy maydon">
                        </div>
                    </div>
                    <div class="col-12 select-style-2 input-style-1">
                        <label>Kategoriya uchun menu bo'limini tanlang</label>
                        <div class="select-position">
                            <select name="location">
                                <option value="">Tanlang</option>
                                @foreach(\App\Helpers\MenuHelper::categorySections() as $location => $info)
                                    <option @selected($location == $category->location) value="{{$location}}">{{ ucfirst($location) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <label>Kategoriya uchun URL (slug)</label>
                        <div class="input-style-1">
                            <input type="text" name="slug" value="{{ $category->exists ? $category->slug : old('slug')}}" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-style-1">
                            <label > Qo'shimcha ma'lumot</label>
                            <textarea placeholder="Izoh - o'zingiz uchun (ixtiyoriy maydaon)" rows="2" name="description">{{ $category->exists ? $category->description : old('description')}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div>

        <div class="col-12 my-3">
            <button type="submit" class="main-btn primary-btn btn-hover">
                Saqlash
            </button>
        </div>
    </form>

@endsection
