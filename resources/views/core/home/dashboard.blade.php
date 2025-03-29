<x-layout>

    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="font-weight-bold mb-2">3.605</h2>
                            <div>Click Through</div>
                        </div>
                        <div>
                            <span class="dashboard-pie-1" style="display: none;">2/5</span><svg class="peity" height="60" width="60"><path d="M 30.000000000000004 0 A 30 30 0 0 1 47.633557568774194 54.270509831248425 L 30 30" data-value="2" fill="rgba(21, 101, 192, 0.3)"></path><path d="M 47.633557568774194 54.270509831248425 A 30 30 0 1 1 29.999999999999993 0 L 30 30" data-value="3" fill="rgb(21, 101, 192)"></path></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="font-weight-bold mb-2">3.137</h2>
                            <div>View Through</div>
                        </div>
                        <div>
                            <span class="dashboard-pie-2" style="display: none;">4/5</span><svg class="peity" height="60" width="60"><path d="M 30.000000000000004 0 A 30 30 0 1 1 1.4683045111453907 20.729490168751582 L 30 30" data-value="4" fill="rgba(0, 200, 81, 0.3)"></path><path d="M 1.4683045111453907 20.729490168751582 A 30 30 0 0 1 29.999999999999993 0 L 30 30" data-value="1" fill="rgb(0, 200, 81)"></path></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="font-weight-bold mb-2">8.765</h2>
                            <div>Conversions</div>
                        </div>
                        <div>
                            <span class="dashboard-pie-3" style="display: none;">1/5</span><svg class="peity" height="60" width="60"><path d="M 30.000000000000004 0 A 30 30 0 0 1 58.53169548885461 20.72949016875158 L 30 30" data-value="1" fill="rgba(255, 187, 51, 0.3)"></path><path d="M 58.53169548885461 20.72949016875158 A 30 30 0 1 1 29.999999999999993 0 L 30 30" data-value="4" fill="rgb(255, 187, 51)"></path></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="font-weight-bold mb-2">68%</h2>
                            <div>Retention Rate</div>
                        </div>
                        <div>
                            <span class="dashboard-pie-4" style="display: none;">2/5</span><svg class="peity" height="60" width="60"><path d="M 30.000000000000004 0 A 30 30 0 0 1 47.633557568774194 54.270509831248425 L 30 30" data-value="2" fill="rgba(51, 181, 229, 0.3)"></path><path d="M 47.633557568774194 54.270509831248425 A 30 30 0 1 1 29.999999999999993 0 L 30 30" data-value="3" fill="rgb(51, 181, 229)"></path></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    {!! $chart->container() !!}
                </div>
            </div>
        </div>

    </div>

    @push('footer')
    <script src="{{ @asset('vendor/larapex-charts/apexcharts.js') }}"></script>
    {{ $chart->script() }}

    @endpush

</x-layout>
