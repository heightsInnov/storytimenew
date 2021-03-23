@include('layouts.header')

<div class="content">
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="container-fluid">

        <div class="row">
    @foreach ($allStory as $story)
    
            <div class="col-md-3" data-toggle="modal" data-target="#{{$story->id}}">

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
            <div class="modal fade bd-example-modal-lg" id="{{$story->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title text-center" id="exampleModalLongTitle">{{$story->title}}</h3>
                        </div>
                        <div class="modal-body">
                            <p>{{$story->story}}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        
    @endforeach
    </div>

    </div>
    <footer class="">
    <div class="container">
        @include('layouts.footer')
    </div>
</footer>
</div>
