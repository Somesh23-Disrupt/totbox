<div class="clearfix hidden-print " >
    <div class="easy-link-menu align-right">
        <a class="{!! request()->is('research/manage*')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('research.manage') }}"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;Chemical Detail</a>
        <a class="{!! request()->is('research/issue-history*')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('research.issue-history') }}"><i class="fa fa-history" aria-hidden="true"></i>&nbsp;Issue History</a>
        <a class="{!! request()->is('research/member*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('research.member') }}"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;Membership</a>
        <a class="{!! request()->is('researchstudent*')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('research.student') }}"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;Students Member</a>
        <a class="{!! request()->is('research/staff*')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('research.staff') }}"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;Staffs Member</a>
        <a class="{!! request()->is('research/return-over')?'btn-success':'btn-warning' !!} btn-sm " href="{{ route('research.return-over') }}"><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;Return Over&nbsp;</a>
        <a class="{!!request()->is('research/vendor')?'btn-success':'btn-warning'!!} btn-sm " href="{{route('research.vendor')}}"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;Order Now</a>
    </div>
</div>
