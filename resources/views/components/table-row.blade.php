@foreach($items as $item)
	<tr class="whitespace no-wrap hover:bg-gray-200">
	@foreach($fields as $field)	
        <x-table-cell :item="$item->$field"/>
		{{-- YOU CAN SEND THE innerHTML of the instance of the slot to the controller --}}
    @endforeach
	</tr>
@endforeach