<?php
/**
 * @copyright https://ipaya.cn/
 */

namespace iPaya\FileSystem\Adapters;


use OSS\Core\OssException;
use OSS\OssClient;

class OssAdapter extends Adapter
{
    /**
     * @var string
     */
    public $accessId;
    /**
     * @var string
     */
    public $accessKey;
    /**
     * @var string
     */
    public $endpoint;
    /**
     * @var string
     */
    public $bucket;
    /**
     * @var OssClient
     */
    private $_oss;

    public function __construct($accessId, $accessKey, $endpoint, $bucket)
    {
        $this->accessId = $accessId;
        $this->accessKey = $accessKey;
        $this->endpoint = $endpoint;
        $this->bucket = $bucket;
    }

    /**
     * @inheritDoc
     */
    public function write($filename, $contents)
    {
        try {
            $this->getOss()->putObject($this->bucket, $filename, $contents);
            return true;
        } catch (OssException $exception) {
            return false;
        }
    }

    /**
     * @return OssClient
     * @throws \OSS\Core\OssException
     */
    public function getOss()
    {
        if ($this->_oss == null) {
            $this->_oss = new OssClient($this->accessId, $this->accessKey, $this->endpoint);
        }
        return $this->_oss;
    }

    /**
     * @inheritDoc
     */
    public function upload($srcFilename, $destFilename)
    {
        try {
            $this->getOss()->uploadFile($this->bucket, $destFilename, $srcFilename);
            return true;
        } catch (OssException $exception) {
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function readContents($filename)
    {
        try {
            return $this->getOss()->getObject($this->bucket, $filename);
        } catch (OssException $exception) {
            return false;
        }
    }
}
