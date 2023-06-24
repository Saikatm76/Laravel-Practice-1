@extends('layouts.app')

@section('title', 'Page Title')

@once
    @push('styles')
        <style type="text/css">
            p {
                background-color: aliceblue;
            }
        </style>
    @endpush
@endonce

@section('sidebar')
    @parent
    <p>This is appended to the master sidebar.</p>
@stop

@section('content')
    {{-- @dd($array_val); --}}
    @if ($array_val)
        @foreach ($array_val as $value)
            <p>this is contact view for {{ $value }}</p>
        @endforeach
    @endif
    <p>This is my body content.</p>
@endsection

@once
    @push('scripts')
        <script type="text/javascript">
            console.log('this is example of push and stack');
        </script>
    @endpush
@endonce
