@component('mail::message')

Order: {{$order->order_number }} <br>
<table class="table">
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>  
        @foreach ($order->products as $item)
        <tr>
             <td>{{$item->name }}</td>
             <td>{{$item->pivot->quantity }}</td>
             <td>{{$item->pivot->price }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

Total: {{$order->grand_total}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
