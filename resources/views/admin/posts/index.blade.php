@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Search Options</h6>
                </div>
                <div class="card-body px-4 pt-0 pb-2">
                    <form action="{{ route('posts.index') }}">
                        <div class="row">
                            <div class="col-4">
                                <div class="table-responsive p-0">
                                    <div class="form-group">
                                        <label for="search">Name/Email:</label>
                                        <input id="search" type="text" class="form-control ps-3" name="keywords"
                                            value="{{ old('keywords') }}" placeholder="Type here...">
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
                    <button type="button" class="btn btn-link ps-0"> <u>Add Record</u></button>
                    <label for="csv_file" class="btn btn-link user-select-auto"> <u>Import CSV</u></label>
                    <input type="file" name="importCSV" id="csv_file" class="opacity-0 position-absolute" id="csv_file"
                        accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
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
                                        Job Title</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Location</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Remoteable</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Is Partime</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Range Salary</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Is Pinned</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        End Date</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Start Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($viewData[$table] as $record)
                                    <tr>
                                        <td>
                                            <a href="#">
                                                <p class="text-xs text-center text-secondary mb-0">{{ $record->id }}</p>
                                            </a>
                                        </td>
                                        <td class="text-center text-truncate text-wrap">
                                            <p class="text-xs font-weight-bold mb-0  text-break">{{ $record->job_title }}
                                            </p>
                                        </td>
                                        <td class="text-center text-truncate text-wrap">
                                            <p class="text-xs font-weight-bold mb-0 text-break">{{ $record->city }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0 text-break">{{ $record->remote }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0 text-break">{{ $record->is_parttime }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0 text-break">{{ $record->max_salary }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $record->status }}</p>
                                        </td>
                                        <td class="text-center  text-truncate text-wrap">
                                            <p class="text-xs font-weight-bold mb-0 text-break">{{ $record->end_date }}
                                            </p>
                                        </td>
                                        <td class="text-center  text-truncate text-wrap">
                                            <p class="text-xs font-weight-bold mb-0 text-break">{{ $record->created_at }}
                                            </p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $viewData['posts']->links() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="toast" id="toast-import-CSV" data-bs-autohide="false">
            <div class="toast-header">
                <strong class="me-auto"><i class="bi-gift-fill"></i> We miss you!</strong>
                <small>10 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body">
                It's been a long time since you visited us. We've something special for you. <a href="#">Click
                    here!</a>
            </div>
        </div>
    </div>
@endsection
@section('styles')
    <style>
        .toast {
            position: absolute;
            top: 10px;
            right: 30px;
        }
    </style>
@endsection
@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const csv_file = document.getElementById("csv_file");
            const element = document.getElementById("toast-import-CSV");
            const formData = new FormData();
            csv_file.addEventListener("change", async function(event) {
                formData.append('csv_file', event.target.files[0]);
                const url = "{{ route('posts.importCSV') }}"
                const response = await fetch(url, {
                    method: 'post',
                    body: formData
                });
            });

        });
    </script>
@endsection
