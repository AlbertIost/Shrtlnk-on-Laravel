<x-profile.layout title="Cut down">
    <x-profile.sidebar/>
    <div class="main">
        <x-profile.header/>
        <div class="content-wrap container-fluid">
            <form class="links block row">
                <div class="wrapper-input col-12">
                    <div class="form-group">
                        <label class="col-12 control-label">Long link</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="wrapper-input col-12 col-md-6 col-lg 4">
                    <div class="form-group">
                        <label class="col-12 control-label">Alias</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="wrapper-input col-12 col-md-6 col-lg 4">
                    <div class="form-group">
                        <label class="col-12 control-label">Group</label>
                        <input type="text" class="form-select">
                    </div>
                </div>
                <div class="wrapper-input col-12 col-md-6 col-lg 4">
                    <div class="form-group">
                        <label class="col-12 control-label">Password</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="wrapper-input col-12 col-md-6 col-lg 4">
                    <div class="form-group">
                        <label class="col-12 control-label">Active before</label>
                        <input type="date" class="form-control">
                    </div>
                </div>
                <div class="wrapper-input col-auto d-flex align-items-end">
                    <input type="submit" value="OK" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</x-profile.layout>
