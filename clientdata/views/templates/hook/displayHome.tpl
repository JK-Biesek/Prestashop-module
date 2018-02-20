
<div class="form-group text-center">
 <div class="col-sm-6 box-stats color3">
  <div class="kpi-content">
   <span class="title">{l s='Hi, ' mod='clientdata'}  {$customer->firstname} {$customer->lastname}
  </span>
  {l s='Your Date of Birth is: ' mod='clientdata'}<h3 class="alert-success">{$customer->birthday}</br></h3>
  {l s='And Your customer ID number is : ' mod='clientdata'} <h3 class="alert-success">{$customer->id}</h3>
  </div>
 </div>
</div>
