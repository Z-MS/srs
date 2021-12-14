@if ($options)
    @foreach ($options as $option)
    {{-- Change this back to value and label --}}
        <option value="{{ $option->name }}">{{ $option->name }}</option>
    @endforeach
@else
    <option value="">Select a faculty first</option>
@endif
