<x-layout>
    <h1 class="title">Register a new account</h1>

    <div class="mx-auto max-w-screen-sm card">
        <form action="{{route('register')}}" method="post">
            @csrf
            {{-- Name --}}
            <div class="mb-4">
                <label for="name">Name</label>
                <input type="text" name="name" value="{{old("name")}}" placeholder="Name" class="input
                @error("name") ring-red-500 @enderror"/>

                @error("name")
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label for="email">email</label>
                <input type="email" name="email" value="{{old("email")}}" placeholder="email" class="input
                @error("email") ring-red-500 @enderror"/>

                @error("email")
                <p class="error">{{$message}}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="password" class="input
                @error("password") ring-red-500 @enderror"/>

                @error("password")
                <p class="error">{{$message}}</p>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="mb-4">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation"
                       class="input @error("password") ring-red-500 @enderror"
                       placeholder="confirm password"/>
            </div>

            <button class="btn">Register</button>
        </form>
    </div>
</x-layout>
