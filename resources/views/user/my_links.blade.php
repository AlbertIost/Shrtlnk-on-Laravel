<x-profile.layout title="My links">
    <x-profile.sidebar/>
    <div class="main">
        <x-profile.header/>

        {{--Modal start--}}
        <div class="modal" tabindex="-1" id="modalDelete">
            <div class="modal-dialog">
                <form class="modal-content" method="post" action="{{ route('user.links.delete') }}">
                    @csrf
                    <input type="number" hidden id="inputId">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete link</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="m-0">Are you sure you want to delete the link?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger btn-delete">Delete</button>
                    </div>
                </form>
            </div>
        </div>
        {{--Modal end--}}

        <div class="content-wrap container-fluid">
            <form class="block links row" action="{{ route('user.links') }}" method="GET">
                @csrf
                <div class="wrapper-input col-lg-4 col-md-6 col-12">
                    <label class="col-12 control-label">Choose group</label>
                    <select class="form-select" name="group" id="">
                        <option>All groups</option>
                        <option value="0">Without groups</option>
                        @foreach(auth()->user()->group as $group)
                            <option value="{{ $group->id }}">{{$group->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="wrapper-input col-lg-4 col-md-6 col-12">
                    <label class="col-12 control-label">Creation date from</label>
                    <input class="form-control"  type="date" name="created_from" value="{{ isset($_GET['created_from']) ? $_GET['created_from'] : '' }}">
                </div>
                <div class="wrapper-input col-lg-4 col-md-6 col-12">
                    <label class="col-12 control-label">Creation date before</label>
                    <input class="form-control"  type="date" name="created_to" value="{{ isset($_GET['created_to']) ? $_GET['created_to'] : '' }}">
                </div>
                <div class="wrapper-input col-lg-4 col-md-6 col-6">
                    <label class="col-12 control-label">Sort by</label>
                    <select class="form-select" name="sort_by">
                        <option value="clicks">By clicks</option>
                        <option value="created_at">By creation date</option>
                    </select>
                </div>
                <div class="wrapper-input col-lg-4 col-md-6 col-6">
                    <label class="col-12 control-label">Order by</label>
                    <select class="form-select" name="order_by">
                        <option value="asc">Ascending</option>
                        <option value="desc">Descending</option>
                    </select>
                </div>
                <div class="wrapper-input col-auto d-flex align-items-end">
                    <input type="submit" value="OK" class="btn btn-primary">
                </div>
            </form>
        </div>
        <div class="content-wrap container-fluid links-list">
            <div class="row block d-flex">
                <table>
                    <thead class="table-header">
                        <tr>
                            <th class="is-active"></th>
                            <th>URL</th>
                            <th>Transitions</th>
                            <th>Date</th>
                            <th>Deactivation date</th>
                            <th>Group</th>
                            <th>Password</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($links as $link)
                            <tr>
                                <td class="is-active {{ isset($link->active_before) && \Carbon\Carbon::parse($link->active_before)->lte(\Carbon\Carbon::now()) ? 'bg-danger' : 'bg-success' }}"></td>
                                <td class="short-link">
                                    <div class="short-url"><a target="_blank" href="{{ $link->GetShortLink() }}">{{$link->GetShortLink()}}</a></div>
                                    <div class="long-url text-truncate"><span>{{ $link->link }}</span></div>
                                </td>
                                <td>
                                    <a href="">{{ $link->CountTransitions() }}</a>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($link->created_at)->format('d.m.Y') }}</td>
                                <td>{{ isset($link->active_before) ? \Carbon\Carbon::parse($link->active_before)->format('d.m.Y') : '—' }}</td>
                                <td>{{ $link->group !== null ? $link->group->name : '—' }}</td>
                                <td>{{ $link->password !== null ? '********' : '—' }}</td>
                                <td class="actions">
                                    <a data-copy-text="{{ $link->GetShortLink() }}" class="copy-btn copy is-valid btn btn-outline-primary">
                                        <x-icon.copy/>
                                        <x-icon.ok/>
                                    </a>
                                    <a class="statistic btn btn-outline-success" href="#"><x-icon.statistic/></a>
                                    <a class="edit btn btn-outline-dark" href="{{ route('user.links.edit', $link->id) }}"><x-icon.edit/></a>
                                    <a class="share btn btn-outline-dark" href="#"><x-icon.share/></a>
                                    <button type="button" class="trash btn btn-outline-danger" data-linkId="{{ $link->id }}" data-bs-toggle="modal" data-bs-target="#modalDelete"><x-icon.trash/> </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script>
        var modalDelete = document.getElementById('modalDelete')

        modalDelete.addEventListener('shown.bs.modal', function (event) {
            var button = event.relatedTarget;
            var linkId = button.getAttribute('data-linkId');
            var inputId = modalDelete.querySelector('#inputId');
            inputId.setAttribute('value', linkId);
        })
    </script>
</x-profile.layout>
