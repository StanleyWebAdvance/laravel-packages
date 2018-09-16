@extends('layout.base')

@section('content')

    <div class="container">

        <div class="row mt-5">
            <div class="col-12">
                <p class="lead text-center">Расчет стоимости перевозки ТК КИТ</p>
            </div>
        </div>

        {{--<div class="row">--}}
            {{--@include('layout.errors')--}}
        {{--</div>--}}

        <form action="{{route('calculate')}}" method="post">
            {{ csrf_field() }}
            <div class="form-row">
                <div class="form-group col-md-6">
                    <select id="city_pickup_code" name="city_pickup_code" class="form-control">
                        <option value="0">Откуда</option>
                        @forelse($cities as $city)
                        <option value="{{ $city->code }}">{{ $city->name }}</option>
                        @empty
                            <option>что-то пошло не так</option>
                        @endforelse
                    </select>

                    @if ($errors->has('city_pickup_code'))
                        <div class="alert alert-danger">
                            {{$errors->first('city_pickup_code')}}
                        </div>
                    @endif

                </div>

                <div class="form-group col-md-6">
                    <select id="city_delivery_code" name="city_delivery_code" class="form-control">
                        <option value="0">Куда</option>
                        @forelse($cities as $city)
                            <option value="{{ $city->code }}">{{ $city->name }}</option>
                        @empty
                            <option>что-то пошло не так</option>
                        @endforelse
                    </select>

                    @if ($errors->has('city_delivery_code'))
                        <div class="alert alert-danger">
                            {{$errors->first('city_delivery_code')}}
                        </div>
                    @endif

                </div>
            </div>

            <div class="form-row mt-3">
                <div class="form-group col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" name="pick_up" type="checkbox" id="pick_up">
                        <label class="form-check-label"  for="pick_up">
                            Забор груза по городу
                        </label>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" name="delivery" type="checkbox" id="delivery">
                        <label class="form-check-label" for="delivery">
                            Доставка груза по городу
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-row table-bordered position p-3 mt-3" id="position">
                <div class="form-group col-md-2">
                    <input type="text" name="count_place[]" class="form-control" placeholder="Количество мест">

                    @if ($errors->has('count_place.*'))
                        <div class="alert alert-danger">
                            {{$errors->first('count_place.*')}}
                        </div>
                    @endif

                </div>
                <div class="form-group col-md-2">
                    <input type="text" name="weight[]" class="form-control" placeholder="Масса КГ">

                    @if ($errors->has('weight.*'))
                        <div class="alert alert-danger">
                            {{$errors->first('weight.*')}}
                        </div>
                    @endif

                </div>
                <div class="form-group col-md-2">
                    <input type="text" name="height[]" class="form-control" placeholder="Высота груза">

                    @if ($errors->has('height.*'))
                        <div class="alert alert-danger">
                            {{$errors->first('height.*')}}
                        </div>
                    @endif

                </div>
                <div class="form-group col-md-2">
                    <input type="text" name="width[]" class="form-control" placeholder="Ширина груза">

                    @if ($errors->has('width.*'))
                        <div class="alert alert-danger">
                            {{$errors->first('width.*')}}
                        </div>
                    @endif

                </div>
                <div class="form-group col-md-2">
                    <input type="text" name="length[]" class="form-control" placeholder="Длинна груза">

                    @if ($errors->has('length.*'))
                        <div class="alert alert-danger">
                            {{$errors->first('length.*')}}
                        </div>
                    @endif

                </div>
                <div class="form-group text-center col-md-2">
                    <input type="hidden" class="number" value="1">
                    <button class="btn btn-success" id="add-position">Добавить</button>
                </div>
            </div>

            <div id="add-here"></div>

            <div class="form-row mt-3">
                <div class="form-group col-md-12">
                    <label for="declared_price">Стоимость груза</label>
                    <input type="number" name="declared_price" class="form-control" id="declared_price">

                    @if ($errors->has('declared_price'))
                        <div class="alert alert-danger">
                            {{$errors->first('declared_price')}}
                        </div>
                    @endif

                </div>
            </div>

            <div class="form-row mt-3">
                <div class="form-group col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" name="insurance" type="checkbox" id="insurance">
                        <label class="form-check-label"  for="insurance">
                            Страхование груза
                        </label>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <select id="insurance_agent_code" name="insurance_agent_code" class="form-control" disabled="disabled">
                        <option value="0">Выберите компанию</option>
                        @forelse($insurance as $item)
                            <option value="{{ $item->code }}">{{ $item->name }}</option>
                        @empty
                            <option>что-то пошло не так</option>
                        @endforelse
                    </select>

                    @if ($errors->has('insurance_agent_code'))
                        <div class="alert alert-danger">
                            {{$errors->first('insurance_agent_code')}}
                        </div>
                    @endif

                </div>

            </div>

            <div class="form-row mt-3">

                <div class="form-group col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" name="have_doc" type="checkbox" id="have_doc">
                        <label class="form-check-label" for="have_doc">
                            Есть документы подтверждающие стоимость груза
                        </label>
                    </div>
                </div>

            </div>

            <div class="form-row mt-3">
                <div class="form-group col-md-6">
                    <label for="currency_code">Валюта результата счета</label>
                    <select id="currency_code" name="currency_code[]" class="form-control">
                        @forelse($currencies as $currency)

                            <option value="{{ $currency->code }}"

                                    @if($currency->code == 'RUB')
                                        selected
                                    @endif

                            >{{ $currency->name }}</option>

                        @empty
                            <option>что-то пошло не так</option>
                        @endforelse
                    </select>
                </div>

                <div class="form-group col-md-6 text-right">
                    <p class="lead">Стоимость: {{ $price or '0' }} </p>
                </div>

            </div>

            <button type="submit" class="btn btn-success">Расчитать</button>

        </form>

    </div>

@endsection