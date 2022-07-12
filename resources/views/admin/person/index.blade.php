@extends('layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Rahbariyat</h2>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->

    <div class="card-styles">
        <div class="card-style-3 mb-30">
            <div class="card-content">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="mb-10">Barcha hodimlar</h6>
                    <a href="{{ route('person.form', [], false) }}" class="btn primary-btn btn-hover">Yangi hodim kiritish</a>
                </div>

                <div class="table-wrapper table-responsive">
                    <table class="table striped-table">
                        <thead>
                        <tr>
                            <th>Prioritet</th>
                            <th>FIO, Tel, Email</th>
                            <th>Rasm</th>
                            <th>Lavozim</th>
                            <th>Qabul vaqtlari</th>
                            <th></th>
                        </tr>
                        <!-- end table row-->
                        </thead>
                        <tbody>
                        @forelse($persons as $item)
                            <tr>
                                <td>{{$item->priority}}</td>
                                <td>
                                    <b>{{ $item->name }}</b>
                                    @if($item->email)<br> Email: {{$item->email}} @endif
                                    @if($item->phone)<br> Tel: {{$item->email}} @endif
                                </td>
                                <td>
                                    <div style="width: 100px;" class="shadow-sm p-2"><img src="{{ asset($item->image_path()) }}" class="d-block w-100"></div>
                                </td>
                                <td>
                                    @foreach(array_reverse(config('laravellocalization.supportedLocales')) as $locale => $data)
                                        @if($position = $item->getTranslation('position',$locale, false))
                                            <div><strong>{{$locale }}: </strong>  {{ $position }}</div>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @forelse($item->appointments as $a)
                                        <p><b>{{ $a->weekday }}</b> {{ $a->time }}</p>
                                    @empty
                                        <p class="my-1">Mavjud emas</p>
                                    @endforelse
                                        <a class="d-inline-block mt-2" href="{{ route('appointments.list', $item->id) }}">Boshqarish</a>
                                </td>
                                <td>
                                    <div class="action">
                                        <a href="{{ route('person.form', $item->id) }}" class="text-success mx-2">
                                            <i class="lni lni-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('person.delete', $item->id) }}" method="POST">
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
                                <td colspan="6" class="text-center">Hodimlar topilmadi</td>
                            </tr>
                        @endforelse
                        <!-- end table row -->
                        </tbody>
                    </table>
                    <!-- end table -->

                    {{ $persons->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
