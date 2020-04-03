@extends('layout.app')

@section('content')
    <section>
        <h1 class="category-title mt-5 mb-5">Авторизация</h1>

        <div class="flex justify-center">
            <div class="w-full max-w-xs">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"  method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">E-Mail</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           id="email" type="email" name="email" value="{{ old('email') }}" placeholder="mail@mail.com">
                    @if ($errors->has('email'))
                        <p class="text-red-500 text-xs italic">{{ $errors->first('email') }}</p>
                    @endif
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Пароль
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" name="password" type="password" placeholder="******************">

                    @if ($errors->has('password'))
                        <p class="text-red-500 text-xs italic">{{ $errors->first('password') }}</p>
                    @endif
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Вход
                    </button>

                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">
                        Запомнить меня?
                    </label>
                </div>
            </form>
        </div>
        </div>
    </section>
@endsection
