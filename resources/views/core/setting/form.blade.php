<x-layout>
    <x-form :model="$model" :upload="true">
        <x-card>
            <x-action form="form" />

                @bind($model)
                    <x-form-input col="6" value="{{ env('APP_NAME') }}" label="Nama Perusahaan" name="name" />
                    <x-form-select col="2" name="debug_enable" :default="env('APP_DEBUG')" label="Debug Enable"
                        :options="$active" />
                    <x-form-select col="2" name="telescope_enable" :default="env('TELESCOPE_ENABLED')" label="Telescope"
                        :options="$active" />
                    <x-form-select col="2" name="debugbar_enable" :default="env('BREADCRUMB_ENABLED')" label="Debugbar"
                        :options="$active" />

                    <x-form-input col="2" style="height: 40px" type="color" value="{{ env('APP_COLOR') }}" label="Color" name="color" />
                    <x-form-input col="4" value="{{ env('APP_URL') }}" label="Website URL" name="url" />


                    <x-form-select col="2" name="app_auth" :default="env('APP_AUTH')" label="Login Auth"
                    :options="$active" />
                    <x-form-input col="2" value="{{ env('CSV_DELIMITER') }}" label="csv delimiter" name="csv_delimiter" />
                    <x-form-input col="2" value="{{ env('CSV_CHUNK') }}" label="csv chunk" name="csv_chunk" />

                    <x-form-upload col="3" name="logo" />
                    <div class="col-md-3">
                        <img class="img-thumbnail img-fluid"
                            src="{{ env('APP_LOGO') ? url('storage/' . env('APP_LOGO')) : url('assets/media/image/logo.png') }}"
                            alt="">
                    </div>


                    <x-form-upload col="3" name="background" />
                    <div class="col-md-3">
                        <img class="img-thumbnail img-fluid"
                            src="{{ env('APP_BACKGROUND') ? url('storage/' . env('APP_BACKGROUND')) : url('assets/media/image/logo.png') }}"
                            alt="">
                    </div>

                @endbind

        </x-card>

    </x-form>
</x-layout>
