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

    <div class="card-styles">
        <div class="card-style-3 mb-30">
            <div class="card-content">

                <h6 class="mb-10 w-100">Barcha {{\request()->trashed ? " o'chirilgan" : 'aktiv'}} davlatlar</h6>
                <div class="d-flex justify-content-end align-items-center">
                    <a href="{{ route('categories.form', [], false) }}" class="btn primary-btn btn-hover">Yangi kiritish</a>
                </div>

                <div class="table-wrapper table-responsive">
                    <table class="table striped-table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nomi</th>
                            <th>Menu bo'limi / Izoh</th>
                            <th>URL</th>
                            <th>Amaliyotlar</th>
                        </tr>
                        <!-- end table row-->
                        </thead>
                        <tbody>
                        @forelse($categories as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>
                                    <p>UZ: {{ $item->getTranslation('name', 'uz', false) }}</p>
                                    <p>RU: {{ $item->getTranslation('name', 'ru', false) }}</p>
                                <td>
                                    <p>{{ $item->location ? ucfirst($item->location) : '-' }}</p>
                                    <p>{{ $item->description }}</p>
                                </td>
                                <td>
                                    <p>{{ $item->slug }}</p>
                                </td>
                                <td>
                                    <div class="action">
                                        <a href="{{ route('categories.form', $item->id) }}" class="text-success mx-2">
                                            <i class="lni lni-pencil-alt"></i>
                                        </a>
{{--                                        <form action="{{ route('admin.countries.destroy', $item->id) }}" method="POST">--}}
{{--                                            @method('DELETE') @csrf--}}
{{--                                            <button class="text-danger mx-2" onclick="return confirm('Haqiqatdan xam {{ $item->trashed() ? 'qayta tiklashni' : "uchirishni" }} xoxlaysizmi?')">--}}
{{--                                                <i class="lni {{ $item->trashed() ? 'lni-reload' : 'lni-trash-can' }}"></i>--}}
{{--                                            </button>--}}
{{--                                        </form>--}}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Kategoriyalar topilmadi</td>
                            </tr>
                        @endforelse
                        <!-- end table row -->
                        </tbody>
                    </table>
                    <!-- end table -->

                    {{ $categories->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
