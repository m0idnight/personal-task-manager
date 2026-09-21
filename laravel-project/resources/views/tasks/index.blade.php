<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Task Manager</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: #4a293b;
            min-height: 100vh;
            background:
                radial-gradient(circle at 10% 20%, rgba(244, 177, 199, 0.35), transparent 25%),
                radial-gradient(circle at 90% 10%, rgba(255, 214, 226, 0.5), transparent 30%),
                radial-gradient(circle at 80% 80%, rgba(239, 169, 195, 0.25), transparent 25%),
                linear-gradient(135deg, #fff8fa, #fdecef 50%, #fff7f9);
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            width: 420px;
            height: 420px;
            border: 1px solid rgba(207, 115, 148, 0.18);
            border-radius: 50%;
            top: -180px;
            right: -120px;
            pointer-events: none;
        }

        body::after {
            content: "";
            position: fixed;
            width: 360px;
            height: 360px;
            border: 1px solid rgba(207, 115, 148, 0.15);
            border-radius: 50%;
            bottom: -190px;
            left: -130px;
            pointer-events: none;
        }

        .stars {
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: 0.5;
            background-image:
                radial-gradient(circle, rgba(255,255,255,0.9) 1px, transparent 1px),
                radial-gradient(circle, rgba(255,255,255,0.7) 1px, transparent 1px);
            background-size: 95px 95px, 145px 145px;
            background-position: 20px 30px, 70px 80px;
        }

        .navbar {
            height: 105px;
            background: rgba(255, 255, 255, 0.58);
            border-bottom: 1px solid rgba(218, 133, 160, 0.15);
            backdrop-filter: blur(14px);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 2;
        }

        .logo {
            font-size: 34px;
            font-weight: 700;
            color: #543246;
            letter-spacing: -1.2px;
        }

        .container {
            width: min(1060px, 90%);
            margin: 90px auto 70px;
            position: relative;
            z-index: 1;
        }

        .hero {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 30px;
            margin-bottom: 45px;
        }

        .hero-text {
            max-width: 700px;
        }

        .label {
            color: #cc668b;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 2px;
            margin-bottom: 14px;
        }

        .hero h1 {
            font-size: clamp(40px, 5vw, 58px);
            line-height: 1.05;
            letter-spacing: -2px;
            color: #402536;
            margin-bottom: 16px;
        }

        .hero p {
            color: #796573;
            font-size: 18px;
            line-height: 1.6;
        }

        .add-button {
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 55px;
            padding: 0 25px;
            border-radius: 13px;
            background: linear-gradient(135deg, #d8789b, #c95f86);
            color: white;
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            box-shadow: 0 8px 20px rgba(201, 95, 134, 0.22);
            transition: 0.2s ease;
        }

        .add-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(201, 95, 134, 0.28);
        }

        .task-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
        }

        .task-title {
            font-size: 19px;
            font-weight: 700;
            color: #533346;
        }

        .task-count {
            color: #a27486;
            font-size: 14px;
        }

        .tasks-card {
            background: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(221, 127, 157, 0.3);
            border-radius: 20px;
            padding: 12px;
            box-shadow:
                0 25px 60px rgba(190, 104, 135, 0.12),
                0 5px 20px rgba(190, 104, 135, 0.06);
            backdrop-filter: blur(18px);
        }

        .task-item {
            display: grid;
            grid-template-columns: 1fr auto auto;
            align-items: center;
            gap: 25px;
            padding: 24px;
            border-radius: 15px;
            transition: 0.2s ease;
        }

        .task-item + .task-item {
            border-top: 1px solid rgba(218, 133, 160, 0.15);
        }

        .task-item:hover {
            background: rgba(255, 241, 246, 0.65);
        }

        .task-name {
            font-size: 17px;
            font-weight: 600;
            color: #4b2c3d;
            margin-bottom: 7px;
        }

        .task-description {
            color: #8a727d;
            font-size: 14px;
            line-height: 1.5;
            max-width: 600px;
        }

        .task-date {
            color: #987986;
            font-size: 13px;
            margin-top: 8px;
        }

        .status {
            padding: 8px 14px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .status.pending {
            color: #b2637f;
            background: #fde5ed;
        }

        .status.completed {
            color: #668c78;
            background: #e4f2e9;
        }

        .actions {
            display: flex;
            gap: 9px;
        }

        .action-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 67px;
            height: 38px;
            padding: 0 13px;
            border-radius: 9px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            transition: 0.2s ease;
            cursor: pointer;
        }

        .edit-button {
            color: #bd6485;
            border: 1px solid #e1a1b7;
            background: rgba(255, 255, 255, 0.55);
        }

        .edit-button:hover {
            background: #fff0f5;
        }

        .delete-button {
            color: #bd6485;
            border: 1px solid #e7bdc9;
            background: rgba(255, 255, 255, 0.55);
        }

        .delete-button:hover {
            background: #fde8ee;
        }

        .empty-state {
            text-align: center;
            padding: 70px 25px;
        }

        .empty-state h2 {
            color: #533346;
            font-size: 22px;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #8a727d;
            font-size: 15px;
            margin-bottom: 25px;
        }

        .success-message {
            margin-bottom: 25px;
            padding: 15px 18px;
            border-radius: 12px;
            background: #e8f5ec;
            border: 1px solid #c5e5ce;
            color: #527b61;
            font-size: 14px;
        }

        @media (max-width: 800px) {
            .navbar {
                height: 90px;
            }

            .logo {
                font-size: 28px;
            }

            .container {
                margin-top: 65px;
            }

            .hero {
                flex-direction: column;
                align-items: flex-start;
            }

            .add-button {
                width: 100%;
            }

            .task-item {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .actions {
                width: 100%;
            }

            .action-button {
                flex: 1;
            }

            .status {
                width: fit-content;
            }
        }

        @media (max-width: 500px) {
            .container {
                width: 92%;
            }

            .hero h1 {
                font-size: 40px;
            }

            .hero p {
                font-size: 16px;
            }

            .tasks-card {
                padding: 7px;
            }

            .task-item {
                padding: 20px 16px;
            }

            .task-header {
                align-items: flex-end;
            }
        }
    </style>
</head>

<body>

    <div class="stars"></div>

    <nav class="navbar">
        <div class="logo">TASK MANAGER</div>
    </nav>

    <main class="container">

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <section class="hero">
            <div class="hero-text">
                <div class="label">STAY ORGANIZED</div>

                <h1>Stay focused.</h1>

                <p>
                    Keep your tasks organized, manage your deadlines,
                    and make steady progress one task at a time.
                </p>
            </div>

            <a href="/tasks/create" class="add-button">
                Add Task
            </a>
        </section>

        <div class="task-header">
            <div class="task-title">Your Tasks</div>

            <div class="task-count">
                {{ $tasks->count() }}
                {{ $tasks->count() == 1 ? 'task' : 'tasks' }}
            </div>
        </div>

        <div class="tasks-card">

            @forelse($tasks as $task)

                <div class="task-item">

                    <div>
                        <div class="task-name">
                            {{ $task->task_name }}
                        </div>

                        @if($task->description)
                            <div class="task-description">
                                {{ $task->description }}
                            </div>
                        @endif

                        @if($task->due_date)
                            <div class="task-date">
                                Due: {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
                            </div>
                        @endif
                    </div>

                    <div>
                        <span class="status {{ strtolower($task->status) }}">
                            {{ $task->status }}
                        </span>
                    </div>

                    <div class="actions">

                        <a
                            href="/tasks/{{ $task->id }}/edit"
                            class="action-button edit-button"
                        >
                            Edit
                        </a>

                        <form
                            action="/tasks/{{ $task->id }}"
                            method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this task?');"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="action-button delete-button"
                            >
                                Delete
                            </button>
                        </form>

                    </div>

                </div>

            @empty

                <div class="empty-state">

                    <h2>No tasks yet</h2>

                    <p>
                        Start by adding your first task.
                    </p>

                    <a href="/tasks/create" class="add-button">
                        Add Your First Task
                    </a>

                </div>

            @endforelse

        </div>

    </main>

</body>
</html>