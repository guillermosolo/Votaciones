@if (session('mensaje'))
<div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4 class="alert-heading"><i class="icon fa fa-check"></i>Mensaje del Sistema</h4>
    <ul>
    <li>{{session('mensaje')}}</li>
    </ul>
</div>  
@endif