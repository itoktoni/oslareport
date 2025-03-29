<?php

namespace App\Services\Core;

use GeoSot\EnvEditor\Facades\EnvEditor as EnvEditor;
use Plugins\Alert;

class CreateSettingService
{
    public function save($data)
    {
        $check = false;
        try {
            EnvEditor::editKey('APP_NAME', setString($data->name));

            EnvEditor::editKey('APP_DEBUG', $data->debug_enable);
            EnvEditor::editKey('APP_COLOR', setString($data->color));
            EnvEditor::editKey('TELESCOPE_ENABLED', $data->telescope_enable);
            EnvEditor::editKey('DEBUGBAR_ENABLED', $data->debugbar_enable);

            if ($data->has('logo')) {
                $file_logo = $data->file('logo');
                $extension = $file_logo->extension();
                $name = 'logo.'.$extension;
                // $name = time().'.'.$name;

                $file_logo->storeAs('/public/', $name);
                EnvEditor::editKey('APP_LOGO', $name);
            }

            if ($data->has('background')) {
                $file_background = $data->file('background');
                $extension = $file_background->extension();
                $name = 'background.'.$extension;
                // $name = time().'.'.$name;

                $file_background->storeAs('/public/', $name);
                EnvEditor::editKey('APP_BACKGROUND', $name);
            }

            Alert::update();

        } catch (\Throwable $th) {
            Alert::error($th->getMessage());

            return $th->getMessage();
        }

        return $check;
    }
}
