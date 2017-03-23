<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
    </head>
    <body>
        <h1>All Users</h1>
        @if(empty($records1))
            Nothing to show.
        @else
            @foreach($records1 as $record)
                <div>
                    <label>Name    :</label>{{ $record->getField('UserName_xt') }}<br>
                    <label>Contact : </label>{{ $record->getField('UserContact_xn') }}<br>
                    <label>Email   : </label>{{ $record->getField('UserEmail_xt') }}<br>
                    <label>Address : </label>{{ $record->getField('UserAddress_xt') }}<br>
                </div>
            @endforeach

        @endif

        <h1>All  tips</h1>
         @if(empty($records2))
            Nothing to show.
        @else
            @foreach($records2 as $record)
                <div>
                    {{ $record->getField('TipName_xt') }}
                </div>
            @endforeach

        @endif
    </body>
</html>