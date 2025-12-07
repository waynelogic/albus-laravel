<?php

namespace Waynelogic\EmporiumEnterprise\Resources;

use Illuminate\Support\Facades\Storage;

abstract class AbstractResource
{
    const EXCHANGE_FOLDER = 'exchange';

    public function checkauth(): string
    {
        return $this->answer([
            "success",
            config('session.cookie'),
            session()->getId(),
            'timestamp='.time()
        ]);
    }

    public function init() : string
    {
        return $this->answer([
            'zip=' . $this->zip(),
            'file_limit=' . min([
                $this->toBytes(config('media-library.max_file_size')),
                $this->toBytes(ini_get('post_max_size')),
                $this->toBytes(ini_get('memory_limit')),
            ]),
            'sessid=' . session()->getId(),
            'version=3.1',
        ]);
    }

    public function file() : string
    {
        if (!Storage::exists(self::EXCHANGE_FOLDER)) {
            Storage::makeDirectory(self::EXCHANGE_FOLDER);
        }

        $path = $_GET['filename'];

        // Используем поток напрямую — безопасно для бинарных данных
        $inputStream = fopen('php://input', 'rb');
        if ($inputStream === false) {
            return $this->failure('Cannot open input stream');
        }

        $result = Storage::put(self::EXCHANGE_FOLDER . DIRECTORY_SEPARATOR . $path, $inputStream);
        fclose($inputStream);

        if (!$result) {
            return $this->failure('File write failed');
        }

        return $this->success();
    }

    public function import() : string
    {
        $fileName = $_GET['filename'];
        if (!Storage::exists(self::EXCHANGE_FOLDER . DIRECTORY_SEPARATOR . $fileName)) {
            return $this->failure('File not found');
        }
        return $this->parse($fileName);
    }

    abstract public function parse($fileName) : string;

    public function answer(array $array) : string
    {
        return implode("\n", $array);
    }

    public function success() : string
    {
        return $this->answer(['success']);
    }

    public function failure($message): string
    {
        return $this->answer(['failure: '. $message]);
    }

    private function zip(): string
    {
        return 'no';
    }

    private function toBytes(string $size): int
    {
        $size = trim($size);
        $last = strtolower($size[strlen($size) - 1]);
        $value = (int) $size;

        return match ($last) {
            'g' => $value * 1024 ** 3,
            'm' => $value * 1024 ** 2,
            'k' => $value * 1024,
            default => $value,
        };
    }
}
