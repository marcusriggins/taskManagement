<html>
    <head>
        <title>Task Management</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('assets/custom/css/task.css')}}">
        <?php 
            $projects = ["Project1", "Project2", "Project3"];
        ?>
    </head>
    <body>
        <div class="container">
            <h2 class="title">Task Management</h2>
            <div class="row">
                <div class="col-md-4">
                    <label>Create the task by click below button</label>
                    <button class="add btn btn-success" type="button" data-toggle="modal" data-target="#add-Modal"><i class="fa fa-plus"></i> Create</button>
                    <br/><br/>
                    <label>Filter the task by project</label>
                    <select class="filter form-control" id="filter">
                        <option value="all">All</option>
                        <?php $index = 0;?>
                        @foreach ($projects as $project)
                        <option value="{{++ $index}}">{{$project}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-6">
                    <ul id="task-list" class="list-group">
                        @foreach ($tasks as $task)
                        <li class="list-group-item">
                            <div class="task row" data-id="{{$task->id}}" data-name="{{$task->name}}" data-project="{{$task->project}}">
                                <div class="col-2">ID : {{$task->id}}</div>
                                <div class="col-6">
                                    <p class="no-margin">{{$task->name}}</p>
                                    <p class="no-margin" style="font-weight:bold;">{{$projects[$task->project - 1]}}</p>
                                </div>
                                <div class="col-4">
                                    <button type="button" class="edit btn btn-primary" data-toggle="modal" data-target="#edit-Modal"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="remove btn btn-danger" data-toggle="modal" data-target="#delete-Modal"><i class="fa fa-remove"></i></button>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div id="add-Modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">Add Task</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{url('add-task')}}" method="post">
                        @csrf
                    <div class="modal-body">
                        <label>Name</label>
                        <input name="name" maxlength="200" class="form-control"/><br/>

                        <label>Priority</label>
                        <select name="priority" class="form-control">
                            <option value="first">First</option>
                            <option value="last">Last</option>
                        </select>
                        <br/>

                        <label>Project</label>
                        <select name="project" class="form-control">
                            <?php $index = 0;?>
                            @foreach ($projects as $project)
                            <option value="{{++ $index}}">{{$project}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="edit-Modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">Edit Task</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{url('edit-task')}}" method="post">
                        @csrf
                    <div class="modal-body">
                        <input name="id" hidden/>
                        <label>Name</label>
                        <input name="name" maxlength="200" class="form-control"/><br/>

                        <label>Project</label>
                        <select name="project" class="form-control">
                            <?php $index = 0;?>
                            @foreach ($projects as $project)
                            <option value="{{++ $index}}">{{$project}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="delete-Modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">Delete Task</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{url('remove-task')}}" method="post">
                        @csrf
                    <div class="modal-body">
                        <input name="id" hidden/>
                        <p>Are you sure to remove this task?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Remove</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script src="{{asset('assets/plugin/jquery-3.6.1.min.js')}}"></script>
    <script src="{{asset('assets/plugin/sortable.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <script src="{{asset('assets/custom/js/task.js')}}"></script>
</html>