@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @livewire('counter')

                    {{-- @php $count = 0; @endphp
                    @foreach (range(0, 20) as $i)
                        @foreach (range(0, 20) as $j)
                            {{ $i }} {{ $j }}
                            @php $count++; @endphp
                        @endforeach
                    @endforeach

                    {{ $count }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
