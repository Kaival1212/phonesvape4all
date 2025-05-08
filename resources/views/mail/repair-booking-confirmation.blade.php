@foreach($booking->repairServices as $service)
<tr>
    <td>{{ $service->name }}</td>
    <td>
        @if(is_null($service->pivot->price)) Model:
        {{ $service->pivot->model_number }} @else £{{ number_format($service->pivot->price, 2) }}
        @endif
    </td>
    <td>
        @if(!is_null($service->pivot->price)) £{{ number_format($service->pivot->discount, 2) }}
        @endif
    </td>
    <td>
        @if(!is_null($service->pivot->price)) £{{ number_format($service->pivot->total, 2) }}
        @endif
    </td>
</tr>
@endforeach
