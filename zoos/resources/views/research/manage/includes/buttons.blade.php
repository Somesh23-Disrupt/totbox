<div class="clearfix hidden-print " >
    <div class="align-left">
        <a class="{!! request()->is('research/manage')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('research.manage') }}"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;Lab Detail</a>
        <a class="{!! request()->is('research/manage/add')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('research.manage.add') }}"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;New Chemical</a>
        <a class="{!! request()->is('research/manage/import')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('research.manage.import') }}"><i class="fa fa-upload" aria-hidden="true"></i>&nbsp;Bulk Import</a>
        <a class="{!! request()->is('research/manage/category')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('research.manage.category') }}"><i class="fa fa-pie-chart" aria-hidden="true"></i>&nbsp;Chemical Category</a>
    </div>
</div>
<hr class="hr-4">