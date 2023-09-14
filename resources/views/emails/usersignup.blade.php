
@if($admin == true)
<h4>Hello Admin,Welcome Back</h4>
<p>{!!$msg!!}</p>

<p>Customer Details :</p>
<p>Username : {!!$username!!}</p>
<p>Email : {!!$email!!}</p>

@elseif($admin == false )

<h4>Dear {{ucfirst($firstname)}}, </h4>
<p>{!!$msg!!}</p>

@endif 


Thanks,<br>
{{ config('app.name') }}