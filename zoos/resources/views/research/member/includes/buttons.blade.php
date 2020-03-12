<div class="clearfix hidden-print " >
    <div class="align-left">
        <a class="{!! request()->is('research/member')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('research.member') }}"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;Member Detail</a>
        <a class="{!! request()->is('research/member/add')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('research.member.add') }}"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add Member</a>
    </div>
</div>
<hr class="hr-4">