@extends('layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Statik sahifalar</h2>
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
                    <h6 class="mb-10">Barcha statik sahifalar</h6>
                    <div class="d-flex justify-content-end align-items-center">
                        <form class="d-flex align-items-center mx-3" action="{{ route('pages.index') }}">
                            <label class="px-2">Menu bo'limi </label>
                            <select class="dataTable-selector p-2 mx-2" name="location">
                                <option value="">Barchasi</option>
                                @foreach(\App\Helpers\MenuHelper::pageSections() as $key => $info)
                                    <option @selected(request()->location == $key) value="{{ $key }}">{{ucfirst($key)}}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-success">Saralash</button>
                        </form>
                        <a href="{{ route('pages.form', [], false) }}" class="btn primary-btn btn-hover">Yangi kiritish</a>
                    </div>
                </div>

                <div class="table-wrapper table-responsive">
                    <table class="table striped-table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Sarlavha</th>
                            <th>Menu bo'limi</th>
                            <th>Status/ Yaratilgan</th>
                            <th></th>
                        </tr>
                        <!-- end table row-->
                        </thead>
                        <tbody>
                        @forelse($pages as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>
                                    @foreach(array_reverse(config('laravellocalization.supportedLocales')) as $locale => $data)
                                        @if($title = $item->getTranslation('title',$locale, false))
                                            <div><strong>{{$locale }}: </strong>  {{ $title }}</div>
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $item->location ? ucfirst($item->location) : '-' }}</td>
                                <td>
                                    'Chop Etilgan: {{  $item->published ? ' Xa' : ' Yo\'q'}}<br>
                                    {{ $item->created_at->format('Y-m/d H:i') }}
                                </td>
                                <td>
                                    <div class="action">
                                        <a href="{{ route('pages.form', $item->id) }}" class="text-success mx-2">
                                            <i class="lni lni-pencil-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Sahifalar topilmadi</td>
                            </tr>
                        @endforelse
                        <!-- end table row -->
                        </tbody>
                    </table>
                    <!-- end table -->

                    {{ $pages->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
