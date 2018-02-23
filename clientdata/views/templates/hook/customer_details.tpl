<div class="panel panel-sm">
<div class="panel-heading">
<i class="icon-pencil"></i>
{l s='Customer Data:' mod='clientdata'}{$customer->firstname}
</div>
<form id="clientdata" class="form-horizontal" >
<div class="form-group">
<div class="col-xs-6 col-sm-3 box-stats color2">
			{$customer->firstname} {$customer->lastname}</br>
			{l s='Last Connected : ' mod='clientdata'}<span class="alert-success">{$connect}</span></br>
			<span class="title">{l s='Date of Birth of the customer is :' mod='clientdata'}</span>
			<span class="alert-info">{$customer->birthday}</span></br>
			 {l s='Who has made:' mod='clientdata'}
			<span class="alert-warning">{$order_number} {if $order_number>1}Orders{else} Order{/if}</span>
			<br />
			{l s='With total of :' mod='clientdata'}
			<span class="alert-danger">{$paid}</span>
</div>
</div>
</form>
</div>
