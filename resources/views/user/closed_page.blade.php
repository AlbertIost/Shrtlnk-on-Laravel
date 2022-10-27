<x-layout title="Access closed">
    <div class="container">
        <div class="row">
            <div class="col-12 title">This is a closed page. Enter the password to gain access</div>
        </div>
        <form class="row" action="{{route('tryAccessToClosedPage', ['token' => $token])}}" method="POST">
            @csrf
            <div class="col-12 col-md-9 pt-3 position-relative">
                <input placeholder="Enter password" class="@error('password') is-invalid @enderror link col-12 form-control form-control-lg" id="password" name="password" type="text">
                @error('password')
                <span class="invalid-tooltip">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
            </div>
            <div class="col-12 col-md-3 pt-3">
                <input class="btn btn-lg col-12" id="send" type="submit" value="Send">
            </div>
        </form>
    </div>
</x-layout>
