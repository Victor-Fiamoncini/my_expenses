@if ($errors->any())
    @foreach ($errors->all() as $error)
        <x-alert type="danger" message="{{ $error }}" />
    @endforeach
@endif
