@include('layouts.header')
<div class="content">
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-profile">
                    <div class="card-avatar">
                        <a href="javascript:;">
                            <img class="img" src="../assets/img/faces/marc.jpg" />
                        </a>
                    </div>
                    <div class="card-body">
                        <h6 class="card-category text-gray">Story Teller</h6>
                        <h4 class="card-title">{{ $user->name}}</h4>
                        <h6 class="card-title">{{ $user->location}}</h4>
                            <p class="card-description">
                                Don't be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...
                            </p>
                            <button onclick="updateclicker()" class="btn btn-primary btn-round">Update Profile</button>
                    </div>
                </div>
            </div>
            <!-- <div class="col-lg-8 col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Your Stories
                            <span class="pull-right">
                                <button rel="tooltip" title="Create Story" class="btn btn-white btn-link btn-sm pull-right"
                                        data-toggle="modal" data-target="#storymodal">
                                    <i class="material-icons">add</i>
                                </button>
                            </span>
                        </h4>

                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead class="text-primary">
                            <th>Select</th>
                            <th>Title</th>
                            <th>Genre</th>
                            <th>Date Created</th>
                            <th></th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="" checked>
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>Basics of Programming</td>
                                    <td>Technology</td>
                                    <td>20-02-2021</td>
                                    <td class="td-actions text-right">
                                        <button rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm"
                                                data-toggle="modal" data-target="#storymodal">
                                            <i class="material-icons">edit</i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                            <i class="material-icons">close</i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> -->
        </div>
        <div class="row" id="updateform" style="visibility: hidden">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Update Profile</h4>
                    </div>
                    <div class="card-body">
                                        @include('errors.list')
                                        {!! Form::model($user, ['method' => 'PATCH', 'enctype' => 'multipart/form-data', 'action' => ['App\Http\Controllers\StoryTellerController@updateProfile', $user->id]]) !!}
                                        {{ csrf_field() }}
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{ Form::label('Name', 'Name') }}
                                                        {{ Form::text('name', $user->name,  ['class' => 'form-control', 'placeholder' => 'Name','required']) }}
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{ Form::label('Email', 'Email') }}
                                                        {{ Form::email('email', $user->email,  ['class' => 'form-control', 'placeholder' => 'Email','required']) }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{ Form::label('Mobile No', 'Mobile No') }}
                                                        {{ Form::text('mobile_no', $user->mobile_no,  ['class' => 'form-control', 'placeholder' => 'Mobile No','required']) }}
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="">Gender</label>
                                                        <!-- {{ Form::select('gender', [ '' =>  'Select Gender'] + $user->pluck('gender')->toArray(), $user->gender, ['class'=> "form-control select2", 'data-init-plugin' => "select2", "required"]) }} -->
                                                        <select name="gender" id="gender" class="form-control">
                                                            <!-- <option value="{{ $user->gender }}">{{ $user->gender }}</option> -->
                                                            <option value="">Select Gender</option>
                                                            <option value="M">Male</option>
                                                            <option value="F">Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{ Form::label('Date of Birth', 'Date of Birth') }}
                                                        {{ Form::date('date_of_birth', $user->date_of_birth,  ['class' => 'form-control', 'placeholder' => 'Date of Birth','required']) }}

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{ Form::label('Location', 'Location') }}
                                                        {{ Form::text('location', $user->location,  ['class' => 'form-control', 'placeholder' => 'Location','required']) }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="fileinput fileinput-new text-center col-md-6" data-provides="fileinput">
                                                    <br/>
                                                    <br/>

                                                    <input type="file" name="profile_image"/>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{ Form::label('Writing Preference', 'Writing Preference') }}
                                                        {{ Form::text('writing_preference', $user->writing_preference,  ['class' => 'form-control', 'placeholder' => 'Writing Preference','required']) }}

                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary pull-right">Update Profile</button>
                                            <div class="clearfix"></div>
                                        </form>
                                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="storymodal" tabindex="-1" role="">
        <div class="modal-dialog modal-login" role="document">
            <div class="modal-content">
                <div class="card card-signup card-plain">
                    <div class="modal-header">
                        <div class="card-header card-header-primary text-center">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                <i class="material-icons">clear</i>
                            </button>
                            <h4 class="card-title">Story</h4>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form class="form" method="" action="">
                            <p class="description text-center">Create or Edit Story</p>
                            <div class="card-body">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Title</label>
                                        <input name="title" id="title" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Genre</label>
                                        <select name="genre" id="genre" class="form-control">
                                            <option value="0">Select Genre</option>
                                            <option value="1">Technology</option>
                                            <option value="2">Romance</option>
                                            <option value="3">History</option>
                                            <option value="4">Comedy</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Content</label>
                                        <textarea name="content" id="content" rows="5" maxlength="250" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button name="submit" type="submit" class="btn btn-primary pull-right">Create/Update</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
