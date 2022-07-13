@extends('layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center justify-content-between">
            <div class="title mb-30">
                <h2>{{ $g_menuHelper->getDocumentCategory($category) }} bo'limiga tegishli xujjatlar</h2>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->

    <div class="card-styles">
        <div class="card-style-3 mb-30">
            <div class="card-content">
                <form action="{{ route('documents.save') }}" method="POST" enctype="multipart/form-data"
                      class="w-100 d-flex justify-content-start align-items-center">
                    <input type="hidden" name="category" value="{{$category}}">
                    @csrf
                    @foreach(array_reverse(config('laravellocalization.supportedLocales')) as $locale => $data)
                        <div class="input-style-1 px-1">
                            <label >Hujjat nomi - {{ $locale }}</label>
                            <input required type="text" name="name[{{$locale}}]"
                                   value="{{ old('name.'.$locale) }}" placeholder="Majburiy maydon">
                        </div>
                    @endforeach
                    <div class="input-style-1 px-1">
                        <label >Fayl yuklash</label>
                        <input required type="file" name="document">
                    </div>
                    <button class="btn btn-lg btn-success">Yuklash</button>
                </form>

                <div class="table-wrapper table-responsive">
                    <table class="table striped-table">
                        <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="10%">Hajmi</th>
                            <th width="65%">Nomi / Tahrirlash</th>
                            <th width="20%"></th>
                        </tr>
                        <!-- end table row-->
                        </thead>
                        <tbody>
                        @forelse($docs as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->size}}</td>
                                <td class="w-100">
                                    <form action="{{ route('documents.save', $item->id) }}" method="POST"
                                          class="w-100 d-flex justify-content-center align-items-center">
                                        @csrf
                                        @foreach(array_reverse(config('laravellocalization.supportedLocales')) as $locale => $data)
                                        <div class="w-full">
                                            <div class="input-style-1 px-1">
                                                <label >Hujjat nomi - {{ $locale }}</label>
                                                <input required type="text" name="name[{{$locale}}]"
                                                       value="{{$item->getTranslation('name',$locale, false)}}" placeholder="Majburiy maydon">
                                            </div>
                                        </div>
                                        @endforeach
                                        <button class="btn btn-lg btn-success"><i class="lni lni-save"></i></button>
                                    </form>
                                </td>
                                <td>
                                    <div class="action">
                                        <a href="{{route('documents.download', $item->id)}}" class="btn btn-outline-primary">
                                            <i class="lni lni-download"></i>
                                        </a>
                                        <form action="{{ route('documents.delete', $item->id) }}" method="POST">
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
                                <td colspan="4" class="text-center">Hujjatlar topilmadi</td>
                            </tr>
                        @endforelse
                        <!-- end table row -->
                        </tbody>
                    </table>
                    <!-- end table -->

                    {{$docs->links()}}
                </div>

            </div>
        </div>
    </div>
@endsection
