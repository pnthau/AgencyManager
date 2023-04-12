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
                            </tbody>
                        </table>
                        <div class="paginator">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        const table = document.querySelector('.table');
        const paginator = document.querySelector('.paginator');
        window.onload = (event) => {
            function paginate({
                prev_page_url,
                next_page_url
            }) {
                previos = prev_page_url ?
                    `<a class="page-link" href="${prev_page_url}" aria-label="Previous">
                            <i class="fa fa-angle-left"></i>
                            <span class="sr-only">Previous</span>
                        </a>` :
                    `<a class="page-link disabled" href="" aria-label="Previous" aria-disabled="true">
                            <i class="fa fa-angle-left"></i>
                            <span class="sr-only">Previous</span>
                        </a>`;
                next = next_page_url ?
                    `<a class="page-link" href="${next_page_url}" aria-label="Next">
                            <i class="fa fa-angle-right"></i>
                            <span class="sr-only">Next</span>
                        </a>` :
                    `<a class="page-link disabled" href="" aria-label="Next" aria-disabled="true">
                            <i class="fa fa-angle-right"></i>
                            <span class="sr-only">Next</span>
                        </a>`;
                paginator.innerHTML = `
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">${previos}</li>
                        <li class="page-item">${next}</li>
                    </ul>
                </nav>`;
                const pagination = paginator.querySelectorAll('.pagination a')
                console.log(pagination);
                pagination.forEach((p) => {
                    let url = p.href;
                    p.addEventListener('click', (event) => {
                        event.preventDefault();
                        loadPosts(url)
                    })
                })
            }
            async function loadPosts(url = "") {
                const response = await fetch(url);
                const posts = await response.json();
                table.tBodies[0].innerHTML = posts.data.map(({
                    id,
                    job_title,
                    city,
                    remote,
                    is_parttime,
                    max_salary,
                    status,
                    created_at,
                    end_date
                }) => {
                    return `<tr>
                    <td>
                        <a href="#">
                            <p class="text-xs text-center text-secondary mb-0">${id}</p>
                        </a>
                    </td>
                    <td class="text-center text-truncate text-wrap">
                        <p class="text-xs font-weight-bold mb-0  text-break">${job_title}</p>
                    </td>
                    <td class="text-center text-truncate text-wrap">
                        <p class="text-xs font-weight-bold mb-0 text-break">${city}</p>
                    </td>
                    <td class="text-center">
                        <p class="text-xs font-weight-bold mb-0 text-break">${remote}</p>
                    </td>
                    <td class="text-center">
                        <p class="text-xs font-weight-bold mb-0 text-break">${is_parttime}</p>
                    </td>
                    <td class="text-center">
                        <p class="text-xs font-weight-bold mb-0 text-break">${max_salary}</p>
                    </td>
                    <td class="text-center">
                        <p class="text-xs font-weight-bold mb-0">${status}</p>
                    </td>
                    <td class="text-center  text-truncate text-wrap">
                            <p class="text-xs font-weight-bold mb-0 text-break">${end_date}</p>
                        </td>
                    <td class="text-center  text-truncate text-wrap">
                        <p class="text-xs font-weight-bold mb-0 text-break">${created_at}</p>
                    </td>
                </tr>`
                })
                paginate(posts);
            }
            loadPosts("{{ route('api.posts.index') }}");
        }
    </script>
@endsection
