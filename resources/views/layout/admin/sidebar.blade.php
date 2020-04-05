<div class="col-lg-3">
    <ul class="list-group">
        <li class="list-group-item">
            <ul class="list-unstyled">
                <li><a href="{{ route('admin.index') }}">Админпанель</a></li>
                <li><a href="{{ route('home') }}">На сайт</a></li>
            </ul>
        </li>
        <li class="list-group-item">
            <h5>Задачи</h5>
            <ul class="list-group-sublist">
                <li><a href="{{ route('admin.todo.index') }}">Все задачи</a></li>
            </ul>
        </li>
        <li class="list-group-item">
            <h5>Пользователи</h5>
            <ul class="list-group-sublist">
                <li><a href="{{ route('admin.user.index') }}">Все пользователи</a></li>
            </ul>
        </li>
    </ul>
</div>