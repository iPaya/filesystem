<?php
/**
 * @copyright https://ipaya.cn/
 */

namespace iPaya\FileSystem;


interface FileSystemInterface
{
    /**
     * Write contents to file.
     *
     * @param string $filename
     * @param string $contents
     * @return bool
     */
    public function write($filename, $contents);

    /**
     * Upload file
     *
     * @param string $srcFilename
     * @param string $destFilename
     * @return bool
     */
    public function upload($srcFilename, $destFilename);

    /**
     * Read file contents.
     *
     * @param string $filename
     * @return string
     */
    public function readContents($filename);
}
