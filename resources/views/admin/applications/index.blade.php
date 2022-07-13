@extends('layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Virtual murojatlar</h2>
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
                    <h6 class="mb-10">Barcha Vitual murojatlar</h6>
                </div>

                <div class="table-wrapper table-responsive">
                    <table class="table striped-table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>FIO / Tel / Email</th>
                            <th>Qabul qilingan</th>
                            <th>Mavzu</th>
                            <th>Holati / Vaqti</th>
                            <th></th>
                        </tr>
                        <!-- end table row-->
                        </thead>
                        <tbody>
                        @forelse($applications as $item)
                            <tr>
                                <td>{{ $item->getId() }}</td>
                                <td>
                                    <b>{{ $item->fullname }}</b>
                                    @if($item->phone)<br> Tel: {{$item->phone}} @endif
                                    @if($item->email)<br> Email: {{$item->email}} @endif
                                </td>
                                <td>{{ $item->created_at->format('d M-Y H:i') }}</td>
                                <td>{{ $item->subject }}</td>
                                <td>{{ $item->getStatus() }} <br> {{ $item->updated_at->format('d M-Y H:i') }} </td>
                                <td>
                                    <div class="action">
                                        <a href="{{ route('applications.show', $item->id) }}" class="text-success mx-2">
                                            <i class="lni lni-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Murojatlar topilmadi</td>
                            </tr>
                        @endforelse
                        <!-- end table row -->
                        </tbody>
                    </table>
                    <!-- end table -->

                    {{ $applications->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
