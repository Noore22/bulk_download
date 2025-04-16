<x-guest-layout>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label for="email">Email Address</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="captcha">Captcha</label>
            <div>
                <span>{!! captcha_img() !!}</span>
                <button type="button" class="btn btn-sm btn-primary" id="reload-captcha">
                    Refresh
                </button>
            </div>
            <input type="text" name="captcha" class="form-control mt-2" required>
            @error('captcha')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>

    <script>
        document.getElementById('reload-captcha').addEventListener('click', function() {
            fetch('{{ route("captcha.reload") }}')
                .then(response => response.json())
                .then(data => {
                    document.querySelector("span").innerHTML = data.captcha;
                });
        });
    </script>

</x-guest-layout>
