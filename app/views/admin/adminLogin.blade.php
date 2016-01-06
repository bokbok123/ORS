

{{ Form::open(array('method' => 'POST', 'id' => 'adminLogin')) }}

    {{ Form::text('user_name',null,array('class'=>'user_name', 'id'=>'user_name', 'placeholder'=>'Username')) }}<br/><br/>
    {{ Form::password('password',null,array('class'=>'password', 'id'=>'password', 'placeholder'=>'Password')) }}<br/><br/>

    {{ Form::submit('Submit',null,array('class'=>'loginSubmit', 'id'=>'loginSubmit')) }}

{{ Form::close() }}