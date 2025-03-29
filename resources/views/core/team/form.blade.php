<x-layout>
    <x-form :model="$model">
        <x-card>
            <x-action form="form" />

                @bind($model)
                    <x-form-input col="4" name="team_name" />
                    <x-form-input col="4" name="team_domain" />
                    <x-form-select col="4" name="team_user_id" label="Team Lead" :options="$user" />
                    <x-form-select col="12" class="tag" multiple name="team[]" :default="$selected ?? []" label="Super Team" :options="$user" />
                @endbind

        </x-card>
    </x-form>
</x-layout>
