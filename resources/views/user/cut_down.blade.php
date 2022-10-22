<x-profile.layout title="Cut down">
    <x-profile.sidebar/>
    <div class="main">
        <x-profile.header/>
        <div class="content-wrap container-fluid">
            <form class="links block row" action="{{ route('user.links.create.post') }}" method="POST">
                @csrf
                <div class="wrapper-input col-12">
                    <div class="form-group">
                        <label class="col-12 control-label">Long link</label>
                        <input type="text" class="form-control @error('link') is-invalid @enderror" name="link" >
                        @error('link')
                            <span class="invalid-feedback animated fadeInDown">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="wrapper-input col-12 col-md-6 col-lg 4">
                    <div class="form-group">
                        <label class="col-12 control-label">Alias</label>
                        <input type="text" class="form-control @error('alias') is-invalid @enderror" name="alias">
                        @error('alias')
                            <span class="invalid-feedback animated fadeInDown">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="wrapper-input col-12 col-md-6 col-lg 4">
                    <div class="form-group">
                        <label class="col-12 control-label">Group</label>
                        <select type="text" class="form-select @error('group') is-invalid @enderror" name="group">
                            <option value="no">No</option>
                            @foreach(auth()->user()->group as $group)
                                <option value="{{ $group->id }}">{{$group->name}}</option>
                            @endforeach
                        </select>
                        @error('group')
                        <span class="invalid-feedback animated fadeInDown">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="wrapper-input col-12 col-md-6 col-lg 4">
                    <div class="form-group">
                        <label class="col-12 control-label">Password</label>
                        <input type="text" class="form-control @error('password') is-invalid @enderror" name="password">
                        @error('password')
                        <span class="invalid-feedback animated fadeInDown">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="wrapper-input col-12 col-md-6 col-lg 4">
                    <div class="form-group">
                        <label class="col-12 control-label">Active before</label>
                        <input type="date" class="form-control @error('active_before') is-invalid @enderror" name="active_before">
                        @error('active_before')
                        <span class="invalid-feedback animated fadeInDown">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="wrapper-input col-auto">
                    <label class="col-12 control-label"></label>
                    <input type="submit" value="OK" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</x-profile.layout>
