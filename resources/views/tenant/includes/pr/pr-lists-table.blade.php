<table class="table">
    <thead>
        <tr>
            <th>PR#</th>
            <th>Summary</th>
            <th>Date</th>
            <th>Requestor</th>
            <th>Dept</th>
            <th>Currency</th>
            <th class="text-end">Amount</th>
            <th>Approval</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($prs as $pr)
        <tr>
            <td>{{ $pr->id }}</td>
            <td><a class="text-info" href="{{ route('prs.show',$pr->id) }}">{{ $pr->summary }}</a></td>
            <td><x-tenant.list.my-date :value="$pr->pr_date"/></td>
            <td>{{ $pr->requestor->name }}</td>
            <td>{{ $pr->dept->name }}</td>
            <td>{{ $pr->currency }}</td>
            <td class="text-end"><x-tenant.list.my-number :value="$pr->amount"/></td>
            <td><span class="badge {{ $pr->auth_status_badge->badge }}">{{ $pr->auth_status_badge->name}}</span></td>
            <td><span class="badge {{ $pr->status_badge->badge }}">{{ $pr->status_badge->name}}</span></td>
            <td class="table-action">
                <a href="{{ route('prs.show',$pr->id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                    <i class="align-middle" data-feather="eye"></i></a>

                <a href="{{ route('reports.pr',$pr->id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Print">
                        <i class="align-middle" data-feather="printer"></i></a>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="row pt-3">
    {{ $prs->links() }}
</div>
<!-- end pagination -->
