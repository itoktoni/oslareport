<?php

namespace Plugins;

class Alert
{
    public const create = 'buat';

    public const update = 'simpan';

    public const delete = 'hapus';

    public const failed = 'gagal';

    public const error = 'error';

    public const success = 'success';

    public const warning = 'warning';

    public const danger = 'danger';

    public const primary = 'primary';

    public static function create($data = null)
    {
        session()->put(self::success, $data ?? 'Data berhasil di '.self::create.' !');
    }

    public static function update($data = null)
    {
        session()->put(self::success, $data ?? 'Data berhasil di '.self::update.' !');
    }

    public static function delete($data = null)
    {
        session()->put(self::success, $data ?? 'Data berhasil di '.self::delete.' !');
    }

    public static function error($data = null)
    {
        session()->put(self::error, env('APP_ENV', 'local') == 'production' ? 'Data Error !' : $data.' !');
    }
}
