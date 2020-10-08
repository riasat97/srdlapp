
<li class="active">
    <a href="{{ route('applications.index') }}"><i class="fa fa-edit"></i><span>Applications</span></a>
</li>
    @if(Auth::user()->hasRole(['super admin', 'district admin']))
    <li class="{{ Request::is('roles*') ? 'active' : '' }}">
        <a href="{{ route('roles.index') }}"><i class="fa fa-edit"></i><span>Roles</span></a>
    </li>
    @endif

<li class="{{ Request::is('permissions*') ? 'active' : '' }}">
    <a href="{{ route('permissions.index') }}"><i class="fa fa-edit"></i><span>Permissions</span></a>
</li>

<li class="{{ Request::is('references*') ? 'active' : '' }}">
    <a href="{{ route('references.index') }}"><i class="fa fa-edit"></i><span>References</span></a>
</li>

<li class="{{ Request::is('referenceDesignations*') ? 'active' : '' }}">
    <a href="{{ route('referenceDesignations.index') }}"><i class="fa fa-edit"></i><span>Reference Designations</span></a>
</li>

