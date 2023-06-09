@extends('layout.master')
@section('body-class', 'page-home')
@section('content')

<div class="modules-box">

  @hook('footer.modules.before')

  @foreach($modules as $module)
    @include($module['view_path'], $module)
  @endforeach

  @hook('footer.modules.after')

</div>

@endsection
