<x-layout>
    <x-form :model="$model">
        <x-card>
            <x-action form="form" />

            <div class="row">
                @bind($model)
                    
                <x-form-input col="6" name="category_id" />
                <x-form-input col="6" name="category_name" />

                @endbind
            </div>

        </x-card>
    </x-form>
</x-layout>
