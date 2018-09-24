<a href="{{ url('/'.$param['routes']['base'].'/' . $item->id,$param['getT']) }}" 
    title="View "><button class="btn btn-info btn-xs">
    <i class="fa fa-eye" aria-hidden="true"></i> </button></a>
<a href="{!!  MoHandF::url($param['routes']['base'].'/'.$item->id.'/edit',$param['getT']) !!} "
class="btn btn-primary btn-xs" title="edit">
    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 
</a> 
{!!
MoHandF::delButton([
'tip'=>'del',
'link'=>MoHandF::url($param['routes']['base'].'/'.$item->id,$param['getT']),
'fa'=>'trash-o']) 
!!}
                                           