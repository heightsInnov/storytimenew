
@include('layouts.header')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">content_copy</i>
                        </div>
                        <p class="card-category">Total Books</p>
                        <h3 class="card-title">{{ count($books)}}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons text-warning">date_range</i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">store</i>
                        </div>
                        <p class="card-category">Story Tellers</p>
                        <h3 class="card-title">{{ count($tellers)}}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons text-success">face</i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">info_outline</i>
                        </div>
                        <p class="card-category">Readers</p>
                        <h3 class="card-title">{{ count($readers)}}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons text-primary">local_offer</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4 pull-right"></div>
                    <div class="col-md-4 pull-right"></div>
                    <div class="col-md-4 pull-right">
                        <a class="btn btn-primary btn-round pull-right" href="{{ route("seeker_dashboard") }}">
                            <i class="material-icons">favorite</i> View All >>
                        </a>
                    </div>
                </div>
                @foreach ($paginated_stories as $story)
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <div class="card card-chart">
                    <div class="card-header card-header-success">
                        <img src="assets/img/imgtry.png" alt="Basics of Programming">
                    </div>

                    <div class="card-body">

                            <h4 class="card-title">{{ $story->title}}</h4>
                            <p class="card-category">
                                <span class="text-success"><i class="fa fa-long-arrow-up"></i> Genre </span> {{ $story->genre }}
                            </p>

                    </div>

                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">access_time</i> uploaded {{ Carbon\Carbon::parse($story->DateCreated)->format('Y-m-d') }}
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
    @endforeach
    {{ $paginated_stories->links() }}
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Story Tellers</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead class="text-primary">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Genre</th>
                                <th>Date Created</th>
                                </thead>
                            <tbody>
                                @foreach ($paginated_stories as $story)
                                    <tr>
                                        <td>{{ $story->id }}</td>
                                        <td>{{ $story->title }}</td>
                                        <td>{{ $story->genre }}</td>
                                        <td>{{ Carbon\Carbon::parse($story->DateCreated)->format('Y-m-d') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $paginated_stories->links() }}
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-header card-header-warning">
                        <h4 class="card-title">Story Seekers</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead class="text-warning">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Genre</th>
                                <th>Date Created</th>
                            </thead>
                            <tbody>
                                @foreach ($paginated_stories as $story)
                                    <tr>
                                        <td>{{ $story->id }}</td>
                                        <td>{{ $story->title }}</td>
                                        <td>{{ $story->genre }}</td>
                                        <td>{{ Carbon\Carbon::parse($story->DateCreated)->format('Y-m-d') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $paginated_stories->links() }}
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-center" id="exampleModalLongTitle">Basics of Programming</h3>
                </div>
                <div class="modal-body">
                    <p>Cras mattis consectetur purus sit amet fermentum.
                        Cras justo odio, dapibus ac facilisis in, egestas eget quam.
                        Morbi leo risus, porta ac consectetur ac, vestibulum at eros</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<footer class="">
    <div class="container">
        @include('layouts.footer')
    </div>
</footer>
</div>


