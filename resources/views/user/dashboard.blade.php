<x-profile.layout title="Dashboard">
    <x-profile.sidebar/>
    <div class="main">
        <x-profile.header/>
        <div class="content-wrap container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-6">
                    <div class="card-statistic block">
                        <div class="icon-wrapper"><x-icon.link/></div>
                        <div class="info">
                            <p class="title">Number of links</p>
                            <p class="value">
                                {{ count(auth()->user()->link) }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-6">
                    <div class="card-statistic block">
                        <div class="icon-wrapper"><x-icon.link/></div>
                        <div class="info">
                            <p class="title">Transitions today</p>
                            <p class="value">{{ auth()->user()->CountTransitionsToday() }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-6">
                    <div class="card-statistic block">
                        <div class="icon-wrapper"><x-icon.link/></div>
                        <div class="info">
                            <p class="title">Transitions in a month</p>
                            <p class="value">{{ auth()->user()->CountTransitionsInMonth() }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-6">
                    <div class="card-statistic block">
                        <div class="icon-wrapper"><x-icon.statistic/></div>
                        <div class="info">
                            <p class="title">Total transitions</p>
                            <p class="value">
                                {{ auth()->user()->CountTransitions() }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-profile.layout>
