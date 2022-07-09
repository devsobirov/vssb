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
                    <h2>Rahbariyat @if($person->exists) - {{ $person->name }}@endif</h2>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6>{{$person->exists ? 'Tahrirlash' :'Yangi hodim kiritish'}}</h6>
        <a href="{{ route('person.index') }}" class="btn primary-btn btn-hover">
            <i class="lni lni-arrow-left"></i> Barcha hodimlar
        </a>
    </div>

    <form class="row" action="{{ route('person.save', $person->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="generalData" value="generalData">
        <div class="card-style settings-card-2 mb-30">
            <h2 class="mb-3">Umumiy ma'lumotlar</h2>
            @php $col = $person->exists ? 'col-6' : 'col-12'; @endphp
            @php $col2 = !$person->exists ? 'col-6' : 'col-12'; @endphp
            <div class="row align-items-start">
                @if($person->exists)
                    <div class="{{$col}}">
                        <div class="input-style-1 p-3">
                            <img class="mw-100 shadow-sm" src="{{ asset($person->image_path()) }}">
                        </div>
                    </div>
                @endif
                <div class="{{$col}}">
                    <div class="col-12">
                        <div class="input-style-1">
                            <label >Familiya Ism Otasining ismi</label>
                            <input required type="text" name="name" value="{{$person->exists ? $person->name : old('name')}}" placeholder="Majburiy maydon">
                        </div>
                    </div>
                    @foreach(array_reverse(config('laravellocalization.supportedLocales')) as $locale => $data)
                        <div class="col-12">
                            <div class="input-style-1">
                                <label >Lavozimi - {{ $locale }}</label>
                                <input required type="text" name="lang[{{$locale}}][position]"
                                       value="{{$person->exists ? $person->getTranslation('position', $locale, false) : old('lang.'.$locale.'.position')}}" placeholder="Majburiy maydon">
                            </div>
                        </div>
                    @endforeach
                    <div class="row">
                        <div class="{{ $col2 }}">
                            <div class="input-style-1">
                                <label>{{ $person->exists ? 'Yangi rasm' : 'Rasm' }} tanlash< 300Kb</label>
                                <input type="file" name="image" accept="image/*">
                            </div>
                        </div>
                        @if(!$person->exists)
                        <div class="{{ $col2 }}">
                            <div class="input-style-1">
                                <label >Prioritet</label>
                                <input required type="number" name="priority" value="{{$person->exists ? $person->priority : old('priority')}}" placeholder="Majburiy maydon">
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                @if($person->exists)
                    <div class="col-2">
                        <div class="input-style-1">
                            <label >Prioritet</label>
                            <input required type="number" name="priority" value="{{$person->exists ? $person->priority : old('priority')}}" placeholder="Majburiy maydon">
                        </div>
                    </div>
                @endif
                <div class="col-{{$person->exists ? '5' : '6'}}">
                    <div class="input-style-1">
                        <label >Tel</label>
                        <input type="text" name="phone" value="{{$person->exists ? $person->phone : old('phone')}}" placeholder="Ixtiyoriy maydon">
                    </div>
                </div>
                <div class="col-{{$person->exists ? '5' : '6'}}">
                    <div class="input-style-1">
                        <label >Email</label>
                        <input type="email" name="email" value="{{$person->exists ? $person->email : old('email')}}" placeholder="Ixtiyoriy maydon">
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

    @if($person->exists)
        @foreach(array_reverse(config('laravellocalization.supportedLocales')) as $locale => $data)
        <form class="col-lg-12" action="{{ route('person.save', $person->id) }}" method="POST">
            @csrf @method('PATCH')
            <div class="card-style settings-card-2 mb-30">
                <h2 class="mb-2">Biografiya - {{$locale}}</h2>

                <div class="col-12">
                    <div class="input-style-1">
                        <label>To'liq ma'lumot - {{ $locale }}</label>
                        <textarea name="lang[{{$locale}}][info]" class="summernote" required placeholder="Yangilik matni" rows="10">{{$person->getTranslation('info', $locale, false)}}</textarea>
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
