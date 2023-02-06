
<li class="{{ Request::is('dashboard*') ? 'active' : '' }}">
    <a href="{{ route('applications.dashboard') }}"><i class="fas fa-tachometer-alt"></i><span> ড্যাশবোর্ড </span></a>
</li>
<li class="{{ Request::is('admin/applications*') ? 'active' : '' }}">
    <a href="{{ route('applications.index') }}"><i class="fas fa-envelope"></i><span> ল্যাবের আবেদন</span></a>
</li>
@if(Auth::user()->hasRole(['super admin']))
<li class="{{ Request::is('admin/download*') ? 'active' : '' }}">
    <a href="{{ route('web.selected-institutions') }}"><i class="fas fa-download"></i><span> চূড়ান্ত তালিকা</span></a>
</li>
@endif
<li class="{{ Request::routeIs('users.edit') ? 'active' : '' }}">
    <a href="{{ route('users.edit',['id'=>Auth::user()->id]) }}"><i class="far fa-id-badge"></i> <span>  প্রোফাইল</span></a>
</li>
    @if(Auth::user()->hasRole(['super admin']))

<li class="{{ Request::routeIs('users*') ? 'active' : '' }}">
    <a href="{{ route('users.index') }}"><i class="fas fa-users"></i><span> ইউজার ম্যানেজমেন্ট </span></a>
</li>

<li class="{{ Request::is('admin/roles*') ? 'active' : '' }}">
    <a href="{{ route('roles.index') }}"><i class="fas fa-user-tag"></i><span> ভূমিকা নির্ধারণ</span></a>
</li>

<li class="{{ Request::is('admin/permissions*') ? 'active' : '' }}">
    <a href="{{ route('permissions.index') }}"><i class="fas fa-key"></i><span> অনুমতি প্রদান</span></a>
</li>

<li class="{{ Request::is('admin/references*') ? 'active' : '' }}">
    <a href="{{ route('references.index') }}"><i class="fas fa-th-large"></i><span> রেফারেন্স ধরণ তৈরি</span></a>
</li>

<li class="{{ Request::is('admin/referenceDesignations*') ? 'active' : '' }}">
    <a href="{{ route('referenceDesignations.index') }}"><i class="fas fa-square"></i><span> রেফারেন্সের পদবী নির্ধারণ</span></a>
</li>

<li class="{{ Request::is('notices*') ? 'active' : '' }}">
    <a href="{{ route('notice.attachments') }}"><i class="fa fa-newspaper-o"></i><span>Notices</span></a>
</li>
    @endif
<li class="{{ Request::is('admin/change-password*') ? 'active' : '' }}">
    <a href="{{ route('changePassword') }}"><i class="fas fa-lock"></i> <span> পাসওয়ার্ড পরিবর্তন</span></a>
</li>

<li class="{{ Request::is('admin/labs*') ? 'active' : '' }}">
    <a href="{{ route('labs.tickets.index') }}"><i class="fa fa-ticket"></i><span>Tickets</span></a>
</li>


