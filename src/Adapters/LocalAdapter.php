<?php
/**
 * @copyright https://ipaya.cn/
 */

namespace iPaya\FileSystem\Adapters;


class LocalAdapter extends Adapter
{
    /**
     * @inheritDoc
     */
    function write($filename, $contents)
    {
        return file_put_contents($filename, $contents) !== false;
    }

    /**
     * @inheritDoc
     */
    function upload($srcFilename, $destFilename)
    {
        if (is_uploaded_file($srcFilename)) {
            return move_uploaded_file($srcFilename, $destFilename);
        } else {
            return copy($srcFilename, $destFilename);
        }
    }

    /**
     * @inheritDoc
     */
    function readContents($filename)
    {
        return file_get_contents($filename);
    }

}
