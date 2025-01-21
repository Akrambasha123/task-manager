<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>

    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/fontawesome/css/all.min.css')}}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        h1 {
            font-size: 2.5rem;
            color: #4a4a4a;
        }
        .task-section {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .list-group-item {
            border: none;
            margin-bottom: 10px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }
        .list-group-item strong {
            font-size: 1.1rem;
            color: #333;
        }
        .btn {
            font-size: 0.9rem;
        }
        .dragging {
            background-color: #d1e7dd !important;
        }
        .task-section {
            background-color: #f9f9f9;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .btn-gradient {
            transition: all 0.3s ease;
        }
        .btn-gradient:hover {
            background: linear-gradient(45deg, #00b8d4, #007bff);
            transform: scale(1.05);
        }
        .task-section small {
                font-size: 0.85rem;
            }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Task Manager</h1>
        <!-- Add Task Form -->
        <div class="task-section mb-4">
            <h4 class="bg-primary text-white p-3 rounded-top">Add a New Task</h4>
            <form action="{{ route('tasks.store') }}" method="POST" class="mb-3 p-4 rounded bg-light">
                @csrf
                <div class="row g-4">
                    <div class="col-md-12">
                        <input type="text" name="title" class="form-control form-control-lg"
                            placeholder="Task Title" required style="border-radius: 8px;">
                    </div>
                    <div class="col-md-12">
                        <textarea name="description" class="form-control form-control-lg" placeholder="Task Description"
                            style="border-radius: 8px;"></textarea>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center">
                        <button type="submit" class="btn btn-gradient w-100 btn-lg"
                            style="border-radius: 8px; background: linear-gradient(45deg, #007bff, #00b8d4); color: white; border: none;">
                            <strong>Add Task</strong>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <!-- Pending Tasks -->
            <div class="col-md-6">
                <div class="task-section bg-warning rounded p-3">
                    <h5 class="text-white mb-4">Pending Tasks</h5>
                    <ul id="pendingTasks" class="list-group">
                        @foreach ($tasks->where('is_completed', false) as $task)
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 mb-3 p-4 rounded shadow-sm"
                                data-id="{{ $task->id }}"
                                style="background-color: #fff; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);">
                                <div>
                                    <strong class="text-dark fs-5">{{ $task->title }}</strong>
                                    <p class="text-muted mb-2">{{ $task->description }}</p>
                                    <small class="text-muted">Last updated: {{ $task->updated_at->format('M d, Y h:i A') }}</small>
                                </div>
                                <div class="d-flex justify-content-between align-tems-center">
                                    <button type="button" class="btn btn-warning btn-sm me-1" data-bs-toggle="modal"
                                        data-bs-target="#editTaskModal" data-id="{{ $task->id }}"
                                        data-title="{{ $task->title }}" data-description="{{ $task->description }}">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        
            <!-- Completed Tasks -->
            <div class="col-md-6">
                <div class="task-section bg-success rounded p-3">
                    <h5 class="text-white mb-4">Completed Tasks</h5>
                    <ul id="completedTasks" class="list-group">
                        @foreach ($tasks->where('is_completed', true) as $task)
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 mb-3 p-4 rounded shadow-sm"
                                data-id="{{ $task->id }}"
                                style="background-color: #fff; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);">
                                <div>
                                    <strong class="text-dark fs-5">{{ $task->title }}</strong>
                                    <p class="text-muted mb-2">{{ $task->description }}</p>
                                    <small class="text-muted">Last updated: {{ $task->updated_at->format('M d, Y h:i A') }}</small>
                                </div>
                                <div class="d-flex justify-content-between align-tems-center">
                                    <button type="button" class="btn btn-warning btn-sm me-1" data-bs-toggle="modal"
                                        data-bs-target="#editTaskModal" data-id="{{ $task->id }}"
                                        data-title="{{ $task->title }}" data-description="{{ $task->description }}">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    
        
    </div>
    <!-- Edit Task Modal -->
    <div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTaskModalLabel">Edit Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editTaskForm" action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="editTitle" class="form-label">Task Title</label>
                            <input type="text" class="form-control" id="editTitle" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="editDescription" class="form-label">Task Description</label>
                            <textarea class="form-control" id="editDescription" name="description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets/fontawesome/js/all.min.js')}}"></script>
    <script>
        const pendingTasks = document.getElementById('pendingTasks');
        const completedTasks = document.getElementById('completedTasks');
        new Sortable(pendingTasks, {
            group: 'tasks',
            animation: 150,
            ghostClass: 'dragging',
            onEnd: function(evt) {
                const order = Array.from(pendingTasks.children).map(item => item.dataset.id);
                updateOrder(order, false);
            },
            onAdd: function(evt) {
                toggleCompletion(evt.item.dataset.id, false);
            }
        });
        new Sortable(completedTasks, {
            group: 'tasks',
            animation: 150,
            ghostClass: 'dragging',
            onEnd: function(evt) {
                const order = Array.from(completedTasks.children).map(item => item.dataset.id);
                updateOrder(order, true);
            },
            onAdd: function(evt) {
                toggleCompletion(evt.item.dataset.id, true);
            }
        });
        function updateOrder(order, isCompleted) {
            fetch('{{ route('tasks.reorder') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    order,
                    is_completed: isCompleted
                })
            });
        }
        // Toggle task completion
        function toggleCompletion(taskId, isCompleted) {
            fetch(`/tasks/${taskId}/toggle-complete`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    is_completed: isCompleted
                })
            });
        }
        // edit modal with task data
        var editModal = document.getElementById('editTaskModal');
        editModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var taskId = button.getAttribute('data-id');
            var taskTitle = button.getAttribute('data-title');
            var taskDescription = button.getAttribute('data-description');
            var form = document.getElementById('editTaskForm');
            form.action = '/tasks/' + taskId;
            document.getElementById('editTitle').value = taskTitle;
            document.getElementById('editDescription').value = taskDescription;
        });
    </script>
</body>
</html>
