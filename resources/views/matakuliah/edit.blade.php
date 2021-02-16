@extends('layouts.app')
@section('content')
    <div class="py-3">
        <h1 class="h2">Edit Matakuliah</h1>
    </div>
    <hr>

    <form action="{{ route('matakuliahs.update',['matakuliah' => $matakuliah->id])}}" method="post">
        @method('PATCH')
        @include('matakuliah.form',['tombol' => 'Update'])
    </form>
@endsection