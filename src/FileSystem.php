<?php
/**
 * @copyright https://ipaya.cn/
 */

namespace iPaya\FileSystem;


use iPaya\FileSystem\Adapters\Adapter;

class FileSystem implements FileSystemInterface
{
    private $adapter;

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @inheritDoc
     */
    public function write($filename, $contents)
    {
        return $this->adapter->write($filename, $contents);
    }

    /**
     * @inheritDoc
     */
    public function upload($srcFilename, $destFilename)
    {
        return $this->adapter->upload($srcFilename, $destFilename);
    }

    /**
     * @inheritDoc
     */
    public function readContents($filename)
    {
        return $this->adapter->readContents($filename);
    }

}
