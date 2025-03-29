<x-layout>

    <div class="container-fluid">
        <!-- Account page navigation-->

        <div class="row">
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Profile Picture</h4>
                    </div>
                    <div class="card-body text-center">
                        <div class="container">
                            <img class="img-account-profile img-fluid rounded-circle mb-2"
                                src="{{ env('APP_LOGO') ? url('storage/' . env('APP_LOGO')) : url('assets/media/image/profile.png') }}">

                            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                            <button class="btn btn-primary" type="button">Upload new image</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <form id="form" method="POST" action="{{ route('updateProfile') }}"
                    class="form-submit needs-validation">
                    @csrf
                    <x-card label="Profile Information">

                        @bind($model)
                            <x-form-input col="6" name="name" />
                            <x-form-input col="6" name="username" />
                            <x-form-input col="6" name="phone" />
                            <x-form-input col="6" type="date" name="birthday" />
                            <x-form-input col="6" name="email" />
                            <x-form-input col="6" name="password" type="password" />
                        @endbind

                    </x-card>

                    <div class="page-action">
                        <h5 class="action-container">
                            <div class="button">
                                <div class="button button-action">
                                    <button type="submit" class="btn btn-primary">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </h5>
                    </div>

                </form>
            </div>
        </div>
    </div>

</x-layout>
