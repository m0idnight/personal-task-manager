<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Task - Task Manager</title>

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
            width: min(900px, 90%);
            margin: 95px auto 60px;
            position: relative;
            z-index: 1;
        }

        .intro {
            margin-bottom: 38px;
        }

        .label {
            color: #cc668b;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 2px;
            margin-bottom: 14px;
        }

        .intro h1 {
            font-size: clamp(38px, 5vw, 52px);
            line-height: 1.1;
            letter-spacing: -1.8px;
            color: #402536;
            margin-bottom: 14px;
        }

        .intro p {
            color: #796573;
            font-size: 18px;
            line-height: 1.6;
            max-width: 620px;
        }

        .form-card {
            background: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(221, 127, 157, 0.3);
            border-radius: 20px;
            padding: 40px;
            box-shadow:
                0 25px 60px rgba(190, 104, 135, 0.12),
                0 5px 20px rgba(190, 104, 135, 0.06);
            backdrop-filter: blur(18px);
        }

        .form-group {
            margin-bottom: 26px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 36px;
        }

        label {
            display: block;
            font-size: 16px;
            font-weight: 500;
            color: #533346;
            margin-bottom: 10px;
        }

        .required {
            color: #d66f93;
        }

        input,
        textarea,
        select {
            width: 100%;
            border: 1px solid #efc7d4;
            border-radius: 13px;
            background: rgba(255, 255, 255, 0.58);
            color: #4a293b;
            font-family: 'Inter', sans-serif;
            font-size: 15px;
            padding: 15px 17px;
            outline: none;
            transition: 0.2s ease;
        }

        input {
            height: 61px;
        }

        textarea {
            min-height: 125px;
            resize: vertical;
        }

        select {
            height: 61px;
            cursor: pointer;
        }

        input::placeholder,
        textarea::placeholder {
            color: #a99aa3;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: #d87d9d;
            background: rgba(255, 255, 255, 0.82);
            box-shadow: 0 0 0 4px rgba(216, 125, 157, 0.1);
        }

        .error {
            margin-top: 7px;
            color: #c64f78;
            font-size: 13px;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 18px;
            margin-top: 38px;
        }

        .btn {
            min-width: 135px;
            height: 54px;
            padding: 0 25px;
            border-radius: 13px;
            font-family: 'Inter', sans-serif;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-cancel {
            color: #c05d82;
            background: rgba(255, 255, 255, 0.55);
            border: 1.5px solid #dc91ab;
        }

        .btn-cancel:hover {
            background: #fff4f7;
            transform: translateY(-1px);
        }

        .btn-save {
            color: white;
            background: linear-gradient(135deg, #d8789b, #c95f86);
            border: none;
            box-shadow: 0 8px 20px rgba(201, 95, 134, 0.22);
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(201, 95, 134, 0.28);
        }

        @media (max-width: 700px) {
            .navbar {
                height: 90px;
            }

            .logo {
                font-size: 28px;
            }

            .container {
                margin-top: 65px;
            }

            .intro h1 {
                font-size: 38px;
            }

            .intro p {
                font-size: 16px;
            }

            .form-card {
                padding: 25px;
                border-radius: 17px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .actions {
                flex-direction: column-reverse;
            }

            .btn {
                width: 100%;
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

        <div class="intro">
            <div class="label">ADD TASK</div>

            <h1>Create a new task</h1>

            <p>
                Fill in the details below to keep your tasks organized
                and on track.
            </p>
        </div>

        <div class="form-card">

            <form action="/tasks" method="POST">

                @csrf

                <div class="form-group">
                    <label for="task_name">
                        Task Name <span class="required"></span>
                    </label>

                    <input
                        type="text"
                        id="task_name"
                        name="task_name"
                        value="{{ old('task_name') }}"
                        placeholder="Enter task name..."
                    >

                    @error('task_name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        placeholder="Add a short description (optional)..."
                    >{{ old('description') }}</textarea>

                    @error('description')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">

                    <div class="form-group">
                        <label for="due_date">
                            Due Date
                        </label>

                        <input
                            type="date"
                            id="due_date"
                            name="due_date"
                            value="{{ old('due_date') }}"
                        >

                        @error('due_date')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status">
                            Status
                        </label>

                        <select id="status" name="status">
                            <option value="Pending" {{ old('status', 'Pending') == 'Pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>
                                Completed
                            </option>
                        </select>

                        @error('status')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="actions">

                    <a href="/tasks" class="btn btn-cancel">
                        Cancel
                    </a>

                    <button type="submit" class="btn btn-save">
                        Save Task
                    </button>

                </div>

            </form>

        </div>

    </main>

</body>
</html>