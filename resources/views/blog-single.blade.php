 @extends('frontend.app')

@section('title', $blog->title . ' | MyBrand')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-6">
  <h1 class="text-3xl font-bold mb-4">{{ $blog->title }}</h1>
  <p class="text-sm text-gray-500 mb-6">📅 {{ \Carbon\Carbon::parse($blog->date)->format('F d, Y') }}</p>
  <div class="prose max-w-none">
    {{ $blog->description }}
  </div>
</div>
@endsection
