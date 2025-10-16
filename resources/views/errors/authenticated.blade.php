@extends('layouts.authenticated')

@php
    $code = $code ?? 500;
    $statusTexts = \Symfony\Component\HttpFoundation\Response::$statusTexts;
    $title = $title ?? ($statusTexts[$code] ?? 'Erro inesperado');
@endphp

@section('title', "Erro {$code} - GenBook")

@section('content')
<div class="mt-40 flex flex-col items-center justify-center bg-gray-100 text-center">
    <h1 class="text-6xl font-bold text-blue-500">{{ $code }}</h1>
    <p class="text-2xl font-semibold text-gray-600 mt-4">{{ $title }}</p>
    <p class="text-gray-500 mt-2">
        {{ $message ?? 'Ocorreu um erro. Por favor, tente novamente mais tarde.' }}
    </p>

    <a href="{{ url('/') }}" 
       class="mt-6 inline-block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
        Voltar para a página inicial
    </a>
</div>
@endsection
