<?php

/**
 * @package    Grav\Common\Media
 *
 * @copyright  Copyright (C) 2015 - 2020 Trilby Media, LLC. All rights reserved.
 * @license    MIT License; see LICENSE file for details.
 */

namespace Grav\Common\Media\Traits;

/**
 * Class implements audio object interface.
 */
trait MediaPlayerTrait
{
    /**
     * Allows to set or remove the HTML5 default controls
     *
     * @param bool $status
     * @return $this
     */
    public function controls($status = true)
    {
        if ($status) {
            $this->attributes['controls'] = true;
        } else {
            unset($this->attributes['controls']);
        }

        return $this;
    }

    /**
     * Allows to set the loop attribute
     *
     * @param bool $status
     * @return $this
     */
    public function loop($status = false)
    {
        if ($status) {
            $this->attributes['loop'] = true;
        } else {
            unset($this->attributes['loop']);
        }

        return $this;
    }

    /**
     * Allows to set the autoplay attribute
     *
     * @param bool $status
     * @return $this
     */
    public function autoplay($status = false)
    {
        if ($status) {
            $this->attributes['autoplay'] = true;
        } else {
            unset($this->attributes['autoplay']);
        }

        return $this;
    }

    /**
     * Allows to set the muted attribute
     *
     * @param bool $status
     * @return $this
     */
    public function muted($status = false)
    {
        if ($status) {
            $this->attributes['muted'] = true;
        } else {
            unset($this->attributes['muted']);
        }

        return $this;
    }

    /**
     * Allows to set the preload behaviour
     *
     * @param string|null $preload
     * @return $this
     */
    public function preload($preload = null)
    {
        $validPreloadAttrs = ['auto', 'metadata', 'none'];

        if (null === $preload) {
            unset($this->attributes['preload']);
        } elseif (\in_array($preload, $validPreloadAttrs, true)) {
            $this->attributes['preload'] = $preload;
        }

        return $this;
    }

    /**
     * Reset player.
     */
    public function resetPlayer()
    {
        $this->attributes['controls'] = true;
    }
}
