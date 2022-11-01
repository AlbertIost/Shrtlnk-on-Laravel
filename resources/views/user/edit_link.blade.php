<x-profile.layout title="Edit link">
    <x-profile.sidebar/>
    <div class="main">
        <x-profile.header/>
        <div class="content-wrap container-fluid">
            <form class="block row links" method="POST" action="">
                @csrf
                <div class="wrapper-input col-12">
                    <div class="form-group">
                        <label class="col-12 control-label">Long link</label>
                        <input readonly disabled type="text" class="form-control " name="link" value="{{ $link->link }}">
                    </div>
                </div>
                <div class="wrapper-input col-12 col-md-6 col-lg 4">
                    <div class="form-group">
                        <label class="col-12 control-label">Alias</label>
                        <input readonly disabled type="text" class="form-control " name="alias" value="{{ $link->token }}">
                    </div>
                </div>
                <div class="wrapper-input col-12 col-md-6 col-lg 4">
                    <div class="form-group">
                        <label class="col-12 control-label">Group</label>
                        <select type="text" class="form-select @error('group') is-invalid @enderror" name="group">
                            <option value="no">No</option>
                            @foreach(auth()->user()->group as $group)
                                <option @if($group->id == $link->group_id) selected @endif value="{{ $group->id }}">{{$group->name}}</option>
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
                        <label class="col-12 control-label">Active before</label>
                        <input type="date" class="form-control @error('active_before') is-invalid @enderror" name="active_before" @if(!is_null($link->active_before)) value="{{ \Carbon\Carbon::parse($link->active_before)->toDateString() }}" @endif>
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
