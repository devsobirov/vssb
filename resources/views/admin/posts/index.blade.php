@extends('layouts.app')

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

    <div class="card-styles">
        <div class="card-style-3 mb-30">
            <div class="card-content">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="mb-10">Barcha yangiliklar</h6>
                    <div class="d-flex justify-content-end align-items-center">
                        <form class="d-flex align-items-center mx-3" action="{{ route('posts.index') }}">
                            <label class="px-2">Kategoriya </label>
                            <select class="dataTable-selector p-2 mx-2" name="category_id">
                                <option value="">Barchasi</option>
                                @foreach($g_categories as $c)
                                    <option @selected(request()->category_id == $c->id) value="{{ $c->id }}">{{$c->name}}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-success">Saralash</button>
                        </form>
                        <a href="{{ route('posts.create', [], false) }}" class="btn primary-btn btn-hover">Yangi kiritish</a>
                    </div>
                </div>

                <div class="table-wrapper table-responsive">
                    <table class="table striped-table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Sarlavha</th>
                            <th>Rasm</th>
                            <th>Kategoriya</th>
                            <th>Yaratilgan</th>
                            <th>Amaliyotlar</th>
                        </tr>
                        <!-- end table row-->
                        </thead>
                        <tbody>
                        @forelse($posts as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>
                                    @foreach(array_reverse(config('laravellocalization.supportedLocales')) as $locale => $data)
                                        @if($title = $item->getTranslation('title',$locale, false))
                                            <div><strong>{{$locale }}: </strong>  {{ $title }}</div>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <div style="width: 100px;" class="shadow-sm p-2"><img src="{{ asset($item->image_path()) }}" class="d-block w-100"></div>
                                </td>
                                <td>{{ $item->category->name }}</td>
                                <td>
                                    'Chop Etilgan: {{  $item->published ? ' Xa' : ' Yo\'q'}}<br>
                                    {{ $item->created_at->format('Y-m/d H:i') }}
                                </td>
                                <td>
                                    <div class="action">
                                        <a href="{{ route('posts.edit', $item->id) }}" class="text-success mx-2">
                                            <i class="lni lni-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('posts.destroy', $item->id) }}" method="POST">
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
                                <td colspan="6" class="text-center">Yangiliklar topilmadi</td>
                            </tr>
                        @endforelse
                        <!-- end table row -->
                        </tbody>
                    </table>
                    <!-- end table -->

                    {{ $posts->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
