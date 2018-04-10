<?php
/**
 * @copyright https://ipaya.cn/
 */

namespace iPaya\FileSystem\Adapters;


class LocalAdapter extends Adapter
{
    /**
     * @var string
     */
    public $path;
    /**
     * @var bool
     */
    public $autoMkdir = true;
    /**
     * @var int
     */
    public $dirMode = 0777;

    public function __construct($path)
    {
        $this->path = rtrim($path, '/');
    }

    /**
     * Detect dir
     *
     * @param $dir
     */
    protected function detectDir($dir)
    {
        if ($this->autoMkdir && !file_exists($dir)) {
            mkdir($dir, $this->dirMode, true);
        }
    }

    /**
     * @inheritDoc
     */
    function write($filename, $contents)
    {
        $filename = $this->path . '/' . ltrim($filename, '/');

        $this->detectDir(dirname($filename));

        return file_put_contents($filename, $contents) !== false;
    }

    /**
     * @inheritDoc
     */
    function upload($srcFilename, $destFilename)
    {
        $destFilename = $this->path . '/' . ltrim($destFilename, '/');

        $this->detectDir(dirname($destFilename));

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
        $filename = $this->path . '/' . ltrim($filename, '/');

        return file_get_contents($filename);
    }

}
