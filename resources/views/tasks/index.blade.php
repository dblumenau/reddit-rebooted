<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All tasks</title>
</head>
<body>
<ul>
    fadwsfasd
    @foreach($tasks as $task)
        <li>
            <a href="/tasks/{{ $task->id}}">
                {{ $task->body }}
            </a>
        </li>
    @endforeach
</ul>
</body>
</html>