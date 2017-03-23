<!--

* File    : index.blade.php
* Author  : Saurabh Mehta  
* Date    : 16-Mar-2017
* Purpose : Add users   -->

<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
    </head>
    <body>
        <h1>Add users</h1>
            @foreach($records as $record)
                <div>
                    {{ $record->setField('UserName_xt', ''); }}
                    {{ $record->setField('UserContact_xn', ''); }}
                    {{ $record->setField('UserAddress_xt', ''); }}
                    {{ $record->setField('UserEmail_xt', ''); }}
                    {{ $record->setField('UserPassword_xt', ''); }}                    
                </div>
            @endforeach
    </body>
</html>