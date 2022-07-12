@extends('layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center justify-content-between">
            <div class="title mb-30">
                <h2>{{ $person->name }}ning qabul kunlari</h2>
            </div>
            <div class="mb-30">
                <a href="{{ route('person.index') }}" class="btn primary-btn btn-hover">
                    <i class="lni lni-arrow-left"></i> Rahbariyat
                </a>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->

    <div class="card-styles">
        <div class="card-style-3 mb-30">
            <div class="card-content">
                <form action="{{ route('appointments.save') }}" method="POST"
                      class="w-100 d-flex justify-content-start align-items-center">
                    <input type="hidden" name="person_id" value="{{$person->id}}">
                    @csrf
                    @foreach(array_reverse(config('laravellocalization.supportedLocales')) as $locale => $data)
                        <div class="input-style-1 px-1">
                            <label >Hafta kun(lar)i - {{ $locale }}</label>
                            <input required type="text" name="weekday[{{$locale}}]"
                                   value="{{ old('weekday.'.$locale) }}" placeholder="Majburiy maydon: DU-SH, ПН-СБ">
                        </div>
                    @endforeach
                    <div class="input-style-1 px-1">
                        <label >Soat</label>
                        <input required type="text" name="time" placeholder="Majburiy maydon: 09:00 - 18:00">
                    </div>
                    <button class="btn btn-lg btn-success">Kiritsh</button>
                </form>

                <div class="table-wrapper table-responsive">
                    <table class="table striped-table">
                        <thead>
                        <tr>
                            <th width="5%">№</th>
                            <th width="90%">Hafta kuni / Soat: dan - gacha</th>
                            <th width="5%"></th>
                        </tr>
                        <!-- end table row-->
                        </thead>
                        <tbody>
                        @forelse($appointments as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td class="w-100">
                                    <form action="{{ route('appointments.save', $item->id) }}" method="POST"
                                          class="w-100 d-flex justify-content-start align-items-center">
                                        @csrf
                                        @foreach(array_reverse(config('laravellocalization.supportedLocales')) as $locale => $data)
                                        <div class="input-style-1 px-1">
                                            <label >Hafta kun(lar)i - {{ $locale }}</label>
                                            <input required type="text" name="weekday[{{$locale}}]"
                                                   value="{{$item->getTranslation('weekday',$locale, false)}}" placeholder="Majburiy maydon">
                                        </div>
                                        @endforeach
                                        <div class="input-style-1 px-1">
                                            <label >Soat</label>
                                            <input required type="text" name="time"
                                                   value="{{$item->time}}" placeholder="Majburiy maydon: 09:00 - 18:00">
                                        </div>
                                        <button class="btn btn-lg btn-success"><i class="lni lni-save"></i></button>
                                    </form>
                                </td>
                                <td>
                                    <div class="action">
                                        <form action="{{ route('appointments.delete', $item->id) }}" method="POST">
                                            @method('DELETE') @csrf
                                            <button class="text-danger mx-2" onclick="return confirm('Haqiqatdan xam o\'chirishni xoxlaysizmi?')">
                                                <i class="lni lni-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Qabul kunlari topilmadi</td>
                            </tr>
                        @endforelse
                        <!-- end table row -->
                        </tbody>
                    </table>
                    <!-- end table -->
                </div>

            </div>
        </div>
    </div>
@endsection
