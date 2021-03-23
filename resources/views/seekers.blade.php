@include('layouts.header')

<div class="content">
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    @foreach ($allStory as $story)
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
    {{ $allStory->links() }}
    <footer class="">
    <div class="container">
        @include('layouts.footer')
    </div>
</footer>
</div>
