@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @include('partials.flash_messages')
                    <div class="card-header">{{ __('Создание заказа') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('orders.store') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="lastName" class="col-md-4 col-form-label text-md-end">{{ __('Фамилия') }}</label>

                                <div class="col-md-6">
                                    <input id="lastName" type="text" class="form-control @error('lastName') is-invalid @enderror" name="lastName" value="{{ old('lastName') }}"  autocomplete="lastName" autofocus>

                                    @error('lastName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="firstName" class="col-md-4 col-form-label text-md-end">{{ __('Имя') }}</label>

                                <div class="col-md-6">
                                    <input id="firstName" type="text" class="form-control @error('firstName') is-invalid @enderror" name="firstName" value="{{ old('firstName') }}"  autocomplete="firstName" autofocus>

                                    @error('firstName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="patronymic" class="col-md-4 col-form-label text-md-end">{{ __('Отечество') }}</label>

                                <div class="col-md-6">
                                    <input id="patronymic" type="text" class="form-control @error('patronymic') is-invalid @enderror" name="patronymic" value="{{ old('patronymic') }}"  autocomplete="patronymic" autofocus>

                                    @error('patronymic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="comment" class="col-md-4 col-form-label text-md-end">{{ __('Комментарий клиента') }}</label>

                                <div class="col-md-6">
                                    <input id="comment" type="text" class="form-control @error('comment') is-invalid @enderror" name="comment" value="{{ old('comment') }}"  autocomplete="comment" autofocus>

                                    @error('comment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="article" class="col-md-4 col-form-label text-md-end">{{ __('Артикул товара') }}</label>

                                <div class="col-md-6">
                                    <input id="article" type="text" class="form-control @error('article') is-invalid @enderror" name="article" value="{{ old('article') }}"  autocomplete="article" autofocus>

                                    @error('article')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="brand" class="col-md-4 col-form-label text-md-end">{{ __('Бренд товара') }}</label>

                                <div class="col-md-6">
                                    <input id="brand" type="text" class="form-control @error('brand') is-invalid @enderror" name="brand" value="{{ old('brand') }}"  autocomplete="brand" autofocus>

                                    @error('brand')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Создать') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
