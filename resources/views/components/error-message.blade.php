@if ($errors->has($name))
    <div class="text-danger">
        {{ $errors->first($name) }}
    </div>
@endif