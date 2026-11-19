@extends('layouts.app')

@section('content')
<style>
    #admin .ac-sort { cursor: pointer; white-space: nowrap; user-select: none; }
    #admin .ac-sort:hover { background-color: rgba(0,0,0,.04); }
    #admin #ac-table th, #admin #ac-table td { vertical-align: middle; }
    #admin .ac-arrow { font-size: .75em; color: #888; }
</style>
<div id="admin" class="container-fluid" style="max-width: 1320px;">

    {{-- Full-width messages --}}
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible mb-4" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>

    {{-- Create access code (centered, narrow) --}}
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center">Create Access Codes</h1>
                    <p class="text-center">Create an access code users will use when taking the assessment.</p>
                    <hr>

                    <form id="create-access-code-form" method="POST" action="{{ route('create_access_code') }}">
                        @csrf
                        <div class="row">

                            <div class="col-12 col-sm-6 align-self-end">
                                <div class="form-group">
                                    <label for="name">Access Code</label>
                                    <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="name">How many times can this code be used?</label>
                                    <input type="number" class="form-control" name="uses" min="1" step="1" value="{{ old('uses') }}" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email">Owner email <small class="text-muted">(optional &mdash; who receives the results; defaults to you)</small></label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ auth()->user()->email }}">
                                </div>
                            </div>

                            <div class="col-12">
                                @if ($errors->any())
                                    <div id="errors" class="alert alert-danger mt-4" role="alert">
                                        <ul class="alert-list">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="col-12" v-show="paymentAccessCodeType">
                                <div class="d-flex justify-content-center" >
                                    <input type="submit" class="btn btn-primary" value="Generate Access Code">
                                </div>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    {{-- Access codes overview (full width) --}}
    <div class="row">
        <div class="col-12">
            <div class="card mt-4">
                <div class="card-body">
                    <h1 class="text-center">Access Codes</h1>
                    <p class="text-center">
                        All codes that have been created.
                        <small class="text-muted d-block">{{ count($tokens) }} total</small>
                    </p>
                    <hr>

                    @if (count($tokens))
                        @php
                            $codesData = $tokens->map(function ($t) {
                                $start = (int) $t->starting_uses;
                                $remaining = (int) $t->uses;
                                return [
                                    'code'       => (string) $t->title,
                                    'owner'      => (string) $t->email,
                                    'start'      => $start,
                                    'remaining'  => $remaining,
                                    'created_ts' => optional($t->created_at)->timestamp ?? 0,
                                    'created'    => optional($t->created_at)->format('M j, Y') ?? '',
                                ];
                            })->values();
                        @endphp

                        {{-- Controls: revealed by JS so they are never dead without it --}}
                        <div id="ac-controls" class="mb-3" hidden>
                            <div class="form-row align-items-end">
                                <div class="col-12 col-md-6 mb-2 mb-md-0">
                                    <label class="small mb-1" for="ac-search">Search</label>
                                    <input id="ac-search" type="search" class="form-control form-control-sm" placeholder="Search by code or owner…" autocomplete="off">
                                </div>
                                <div class="col-7 col-md-3">
                                    <label class="small mb-1" for="ac-filter">Status</label>
                                    <select id="ac-filter" class="custom-select custom-select-sm">
                                        <option value="all">All</option>
                                        <option value="active">Active (uses left)</option>
                                        <option value="used">Used up</option>
                                    </select>
                                </div>
                                <div class="col-5 col-md-3">
                                    <label class="small mb-1" for="ac-pagesize">Per page</label>
                                    <select id="ac-pagesize" class="custom-select custom-select-sm">
                                        <option value="10" selected>10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="all">All</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="ac-table" class="table table-striped table-sm mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col" class="ac-sort" data-sort-key="code" role="button" tabindex="0">Access Code <span class="ac-arrow"></span></th>
                                        <th scope="col" class="ac-sort" data-sort-key="owner" role="button" tabindex="0">Owner <span class="ac-arrow"></span></th>
                                        <th scope="col" class="ac-sort text-center" data-sort-key="start" role="button" tabindex="0">Starting <span class="ac-arrow"></span></th>
                                        <th scope="col" class="ac-sort text-center" data-sort-key="remaining" role="button" tabindex="0">Remaining <span class="ac-arrow"></span></th>
                                        <th scope="col" class="ac-sort" data-sort-key="created_ts" role="button" tabindex="0">Created <span class="ac-arrow"></span></th>
                                    </tr>
                                </thead>
                                <tbody id="ac-tbody">
                                    {{-- Server-rendered rows; JS takes over and re-renders with paging/sort/filter --}}
                                    @foreach ($tokens as $token)
                                        <tr>
                                            <td><code>{{ $token->title }}</code></td>
                                            <td>{{ $token->email }}</td>
                                            <td class="text-center">{{ $token->starting_uses }}</td>
                                            <td class="text-center">
                                                @if ((int) $token->uses > 0)
                                                    <span class="badge badge-success">{{ $token->uses }}</span>
                                                @else
                                                    <span class="badge badge-secondary">0</span>
                                                @endif
                                            </td>
                                            <td class="text-nowrap">{{ optional($token->created_at)->format('M j, Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div id="ac-noresults" class="text-center text-muted py-3" hidden>No codes match your search.</div>

                        <div id="ac-footer" class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-3" hidden>
                            <small id="ac-info" class="text-muted mb-2 mb-md-0"></small>
                            <nav aria-label="Access codes pages">
                                <ul id="ac-pagination" class="pagination pagination-sm mb-0"></ul>
                            </nav>
                        </div>

                        <script>
                            window.__ACCESS_CODES__ = @json($codesData);
                        </script>
                        <script>
                        (function () {
                            var DATA = window.__ACCESS_CODES__ || [];
                            var tbody = document.getElementById('ac-tbody');
                            if (!tbody) return;

                            var searchEl   = document.getElementById('ac-search');
                            var filterEl   = document.getElementById('ac-filter');
                            var pageSizeEl = document.getElementById('ac-pagesize');
                            var controls   = document.getElementById('ac-controls');
                            var footer     = document.getElementById('ac-footer');
                            var infoEl     = document.getElementById('ac-info');
                            var pagEl      = document.getElementById('ac-pagination');
                            var noResults  = document.getElementById('ac-noresults');
                            var heads      = Array.prototype.slice.call(document.querySelectorAll('#ac-table .ac-sort'));

                            var state = { term: '', status: 'all', sortKey: 'created_ts', sortDir: 'desc', page: 1, pageSize: 10 };

                            function norm(s) { return (s == null ? '' : String(s)).toLowerCase(); }

                            function getFiltered() {
                                var term = norm(state.term).trim();
                                return DATA.filter(function (r) {
                                    if (state.status === 'active' && !(r.remaining > 0)) return false;
                                    if (state.status === 'used' && r.remaining > 0) return false;
                                    if (term && norm(r.code).indexOf(term) === -1 && norm(r.owner).indexOf(term) === -1) return false;
                                    return true;
                                });
                            }

                            function getSorted(rows) {
                                var k = state.sortKey, dir = state.sortDir === 'asc' ? 1 : -1;
                                var numeric = (k === 'start' || k === 'remaining' || k === 'created_ts');
                                return rows.slice().sort(function (a, b) {
                                    var av = a[k], bv = b[k];
                                    if (numeric) { return ((Number(av) || 0) - (Number(bv) || 0)) * dir; }
                                    av = norm(av); bv = norm(bv);
                                    return av < bv ? -1 * dir : (av > bv ? 1 * dir : 0);
                                });
                            }

                            function badge(remaining) {
                                var span = document.createElement('span');
                                span.className = 'badge ' + (remaining > 0 ? 'badge-success' : 'badge-secondary');
                                span.textContent = remaining;
                                return span;
                            }

                            function cell(text, cls) {
                                var td = document.createElement('td');
                                if (cls) td.className = cls;
                                td.textContent = text;
                                return td;
                            }

                            function ellipsis() {
                                var li = document.createElement('li');
                                li.className = 'page-item disabled';
                                var s = document.createElement('span');
                                s.className = 'page-link';
                                s.textContent = '…';
                                li.appendChild(s);
                                return li;
                            }

                            function render() {
                                var rows = getSorted(getFiltered());
                                var total = rows.length;
                                var pageSize = state.pageSize === 'all' ? (total || 1) : state.pageSize;
                                var pages = Math.max(1, Math.ceil(total / pageSize));
                                if (state.page > pages) state.page = pages;
                                if (state.page < 1) state.page = 1;
                                var startIdx = (state.page - 1) * pageSize;
                                var pageRows = rows.slice(startIdx, startIdx + pageSize);

                                tbody.innerHTML = '';
                                pageRows.forEach(function (r) {
                                    var tr = document.createElement('tr');

                                    var tdCode = document.createElement('td');
                                    var codeEl = document.createElement('code');
                                    codeEl.textContent = r.code;
                                    tdCode.appendChild(codeEl);
                                    tr.appendChild(tdCode);

                                    tr.appendChild(cell(r.owner || ''));
                                    tr.appendChild(cell(r.start, 'text-center'));

                                    var tdRem = document.createElement('td');
                                    tdRem.className = 'text-center';
                                    tdRem.appendChild(badge(r.remaining));
                                    tr.appendChild(tdRem);

                                    tr.appendChild(cell(r.created || '', 'text-nowrap'));

                                    tbody.appendChild(tr);
                                });

                                if (noResults) noResults.hidden = total !== 0;

                                if (infoEl) {
                                    infoEl.textContent = total === 0
                                        ? 'No matching codes'
                                        : 'Showing ' + (startIdx + 1) + '–' + Math.min(startIdx + pageSize, total) + ' of ' + total;
                                }

                                if (pagEl) {
                                    pagEl.innerHTML = '';
                                    if (state.pageSize !== 'all' && pages > 1) {
                                        var mk = function (label, page, disabled, active) {
                                            var li = document.createElement('li');
                                            li.className = 'page-item' + (disabled ? ' disabled' : '') + (active ? ' active' : '');
                                            var a = document.createElement('a');
                                            a.className = 'page-link';
                                            a.href = '#';
                                            a.textContent = label;
                                            a.addEventListener('click', function (e) {
                                                e.preventDefault();
                                                if (disabled || active) return;
                                                state.page = page;
                                                render();
                                            });
                                            li.appendChild(a);
                                            return li;
                                        };
                                        pagEl.appendChild(mk('‹', state.page - 1, state.page === 1, false));
                                        var win = 2;
                                        var from = Math.max(1, state.page - win);
                                        var to = Math.min(pages, state.page + win);
                                        if (from > 1) {
                                            pagEl.appendChild(mk('1', 1, false, false));
                                            if (from > 2) pagEl.appendChild(ellipsis());
                                        }
                                        for (var p = from; p <= to; p++) {
                                            pagEl.appendChild(mk(String(p), p, false, p === state.page));
                                        }
                                        if (to < pages) {
                                            if (to < pages - 1) pagEl.appendChild(ellipsis());
                                            pagEl.appendChild(mk(String(pages), pages, false, false));
                                        }
                                        pagEl.appendChild(mk('›', state.page + 1, state.page === pages, false));
                                    }
                                }

                                heads.forEach(function (th) {
                                    var arrow = th.querySelector('.ac-arrow');
                                    if (!arrow) return;
                                    if (th.getAttribute('data-sort-key') === state.sortKey) {
                                        arrow.textContent = state.sortDir === 'asc' ? '▲' : '▼';
                                        th.setAttribute('aria-sort', state.sortDir === 'asc' ? 'ascending' : 'descending');
                                    } else {
                                        arrow.textContent = '';
                                        th.removeAttribute('aria-sort');
                                    }
                                });
                            }

                            function sortBy(k) {
                                if (state.sortKey === k) {
                                    state.sortDir = state.sortDir === 'asc' ? 'desc' : 'asc';
                                } else {
                                    state.sortKey = k;
                                    state.sortDir = (k === 'code' || k === 'owner') ? 'asc' : 'desc';
                                }
                                render();
                            }

                            if (searchEl) searchEl.addEventListener('input', function () { state.term = searchEl.value; state.page = 1; render(); });
                            if (filterEl) filterEl.addEventListener('change', function () { state.status = filterEl.value; state.page = 1; render(); });
                            if (pageSizeEl) pageSizeEl.addEventListener('change', function () {
                                state.pageSize = pageSizeEl.value === 'all' ? 'all' : parseInt(pageSizeEl.value, 10);
                                state.page = 1;
                                render();
                            });
                            heads.forEach(function (th) {
                                var k = th.getAttribute('data-sort-key');
                                th.addEventListener('click', function () { sortBy(k); });
                                th.addEventListener('keydown', function (e) {
                                    if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); sortBy(k); }
                                });
                            });

                            if (controls) controls.hidden = false;
                            if (footer) footer.hidden = false;
                            render();
                        })();
                        </script>
                    @else
                        <p class="text-center text-muted mb-0">No access codes have been created yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Change password (centered, narrow) --}}
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card mt-4">
                <div class="card-body">
                    <h1 class="text-center">Change Password</h1>
                    <hr>

                    @if (session('password_success'))
                        <div class="alert alert-success alert-dismissible mb-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{ session('password_success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('change_password') }}">
                        @csrf
                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input type="password" class="form-control" name="current_password" required>
                        </div>
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" class="form-control" name="new_password" required>
                        </div>
                        <div class="form-group">
                            <label for="new_password_confirmation">Confirm New Password</label>
                            <input type="password" class="form-control" name="new_password_confirmation" required>
                        </div>

                        @if ($errors->password->any())
                            <div class="alert alert-danger mt-3" role="alert">
                                <ul class="alert-list">
                                    @foreach ($errors->password->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="d-flex justify-content-center mt-3">
                            <input type="submit" class="btn btn-primary" value="Update Password">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
