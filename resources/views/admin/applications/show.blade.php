@extends('layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="title mb-30">
                    <h2>Virtual murojat № {{$application->getId()}}</h2>
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
                    <h6>Murojat xolatini o'zgartirish</h6>
                    <div class="d-flex justify-content-end align-items-center">
                        <form class="d-flex align-items-center mx-3" action="{{ route('applications.update', $application->id) }}" method="POST">
                            @csrf @method('PATCH')
                            <label class="px-2">Holati </label>
                            <select class="dataTable-selector p-2 mx-2" name="status" required>
                                <option value="" selected disabled>Joriy - {{ $application->getStatus() }}</option>
                                @foreach($application::STATUSES as $id => $name)
                                    <option @disabled($id =< $application->status) value="{{ $id }}">{{$name}}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-success">Saqlash</button>
                        </form>
                    </div>
                </div>

                <div class="table-wrapper table-responsive">
                    <table class="table table-bordered table-hover">
                        <tbody>
                        <tr class="bg-light text-white fw-bold"><th colspan="3" class="text-center">Murojat holati</th></tr>
                        <tr>
                            <td colspan="1">Tartib raqami </td>
                            <td colspan="2">{{ $application->getId() }}</td>
                        </tr>
                        <tr>
                            <td colspan="1">Joriy holati </td>
                            <td colspan="2">{{ $application->getStatus() }}</td>
                        </tr>
                        <tr>
                            <td colspan="1">Qabul qilingan vaqti</td>
                            <td colspan="2">{{ $application->updated_at->format('d M-Y H:i') }} }} </td>
                        </tr>
                        <tr>
                            <td colspan="1">So'ngi amaliyot vaqti</td>
                            <td colspan="2">{{ $application->updated_at->format('d M-Y H:i') }} }} </td>
                        </tr>

                        <tr class="bg-light text-white fw-bold"><th colspan="3" class="text-center">Murojatchi ma'lumotlari</th></tr>
                        <tr>
                            <td colspan="1">FIO </td>
                            <td colspan="2">{{ $application->fullname }}</td>
                        </tr>
                        <tr>
                            <td colspan="1">Tel, Email </td>
                            <td colspan="2">{{$application->phone}} @if($application->email) , Email: {{$application->email}} @endif</td>
                        </tr>
                        <tr>
                            <td colspan="1">Yashash manzili </td>
                            <td colspan="2">{{$application->address}}</td>
                        </tr>
                        <tr>
                            <td colspan="1">Passport seriyasi </td>
                            <td colspan="2">{{$application->passport ? $application->passport : '-' }}</td>
                        </tr>
                        <tr>
                            <td colspan="1">Murojatchi turi </td>
                            <td colspan="2">{{$application->applicant_type }}</td>
                        </tr>

                        <tr class="bg-light text-white fw-bold"><th colspan="3" class="text-center">Murojat ma'lumotlari</th></tr>
                        <tr>
                            <td colspan="1">Murojat mavzusi </td>
                            <td colspan="2">{{$application->subject }}</td>
                        </tr>
                        <tr>
                            <td colspan="1">Murojat matni </td>
                            <td colspan="2">{{$application->content }}</td>
                        </tr>
                        <tr>
                            <td colspan="1">Yuklangan fayllar </td>
                            <td colspan="2">
                                @if($path = $application->file)
                                    <a href="{{ asset($item->file) }}" class="btn btn-primary" download="">Yuklab olish</a>
                                @else
                                    Mavjud emas
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
