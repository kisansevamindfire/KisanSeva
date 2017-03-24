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
                    {{ $record->setField('__kfn_UserType', '2'); }}
                    {{ $record->setField('UserName_xt', 'Test'); }}
                    {{ $record->setField('UserContact_xn', '1234567890'); }}
                    {{ $record->setField('UserAddress_xt', 'Mindfire'); }}
                    {{ $record->setField('UserEmail_xt', 'test@mindfire.com'); }}
                    {{ $record->setField('UserPassword_xt', 'test'); }}           
                </div>
            @endforeach
    </body>
</html>