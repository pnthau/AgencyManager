@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Search Options</h6>
                </div>
                <div class="card-body px-4 pt-0 pb-2">
                    <form action="{{ route('users.index') }}">
                        <div class="row">
                            <div class="col-4">
                                <div class="table-responsive p-0">
                                    <div class="form-group">
                                        <label for="search">Name/Email:</label>
                                        <input id="search" type="text" class="form-control ps-3" name="keywords"
                                            value="{{ old('keywords') }}" placeholder="Type here...">
                                    </div>
                                </div>
                                <div class="table-responsive p-0">
                                    <div class="bg-white border-radius-lg d-flex mb-2">
                                        <select id="role" class="form-select form-select-lg" name="role"
                                            aria-label=".form-select-lg example">
                                            <option value="">Select a role</option>
                                            @foreach ($getAllUserRoleNames as $roleName => $role)
                                                <option value="{{ $role }}"
                                                    {{ !is_null(old('role')) && (int) old('role') === $role ? 'selected' : '' }}>
                                                    {{ $roleName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            <div class="col-4">
                                <div class="table-responsive p-0">
                                    <label for="city">City:</label>
                                    <div class="bg-white border-radius-lg d-flex mb-2">
                                        <select id="city" class="form-select form-select-lg" name="city"
                                            aria-label=".form-select-lg example">
                                            <option value="">Select a City</option>
                                            @foreach ($viewData['cities'] as $key => $city)
                                                <option value="{{ $city->name }}"
                                                    {{ old('city') === $city->name ? 'selected' : '' }}>
                                                    {{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="table-responsive p-0">
                                    <div class="bg-white border-radius-lg d-flex mb-2">
                                        <select id="company" class="form-select form-select-lg" name="company"
                                            aria-label=".form-select-lg example">
                                            <option value="">Select a company</option>
                                            @foreach ($companies as $key => $company)
                                                <option value="{{ $company->id }}"
                                                    {{ (int) old('company') === $company->id ? 'selected' : '' }}>
                                                    {{ $company->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>{{ $title }}</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase  text-center text-xxs font-weight-bolder opacity-7">
                                        #Id
                                    </th>
                                    <th class="text-uppercase text-center text-xxs font-weight-bolder opacity-7 ps-2">
                                        Name</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Role</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Company</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        City</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($viewData[$table] as $user)
                                    <tr>
                                        <td>
                                            <a href="{{ route($table . '.show') }}">
                                                <p class="text-xs text-center text-secondary mb-0">{{ $user->id }}</p>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ $user->avatar }}" class="avatar avatar-sm me-3"
                                                        alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                                                    <a href="mailto:{{ $user->email }}">
                                                        <p class="text-xs text-secondary mb-0">{{ $user->email }}</p>
                                                    </a>
                                                    <a href="tel:{{ $user->phone }}">
                                                        <p class="text-xs text-secondary mb-0">{{ $user->phone }}</p>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $user->role_name }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ optional($user->company)->name }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $user->city }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-success">Online</span>
                                        </td>
                                        <td class="align-middle">
                                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="Edit user">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                <div class="paginator paginator-search">
                                    {{ $viewData[$table]->links() }}
                                </div>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        window.onload = (event) => {
            const paginator = document.querySelector('.paginator')
            const table = document.querySelector('table')
            const search = document.querySelector('#search')
            const role = document.querySelector('#role')
            const submit = document.querySelector('#submit')
            const _token = document.querySelector('meta[name="csrf-token"]').content
            let pages = null;

            // submit.addEventListener("click", async function(event) {
            //     const url = `{{ route('users.index') }}?keyword=${search.value || ""}&role=${role.value}`;
            //     const response = await fetch(url);
            //     const users = await response.json()
            // })
        }
    </script>
@endsection
