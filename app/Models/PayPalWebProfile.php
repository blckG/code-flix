<?php

namespace CodeFlix\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Bootstrapper\Interfaces\TableInterface;

class PayPalWebProfile extends Model implements Transformable, TableInterface
{
    use TransformableTrait;

    protected $table = 'paypal_web_profiles';

    protected $fillable = ['name', 'logo_url', 'code'];

    public function getTableHeaders()
    {
        return ['#', 'Nome', 'Logo Url'];
    }

    /**
     * Get the value for a given header. Note that this will be the value
     * passed to any callback functions that are being used.
     *
     * @param string $header
     * @return mixed
     */
    public function getValueForHeader($header)
    {
        switch ($header) {
            case '#':
                return $this->id;
            case 'Nome':
                return $this->name;
            case 'Logo Url':
                return \BootstrapperImage::thumbnail($this->logo_url, 'thumbnail');
        }
    }

}
