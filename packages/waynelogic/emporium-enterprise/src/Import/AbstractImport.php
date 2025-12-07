<?php namespace Waynelogic\EmporiumEnterprise\Import;

use Exception;
use Illuminate\Support\Facades\DB;
use Throwable;
use XMLReader;
use SimpleXMLElement;
use Illuminate\Support\Facades\Storage;
abstract class AbstractImport
{
    const string NODE_NAME = '';
    public string $catalog_id;
    public string $catalog_name;

    public function __construct(
        public string $fileName
    ){}

    /**
     * @throws Exception
     * @throws Throwable
     */
    public function parse(): bool
    {
        $this->prepareVars();

        $reader = new XMLReader();
        $reader->open(Storage::path('exchange' . DIRECTORY_SEPARATOR . $this->fileName));

        // URI основного пространства имен
        $namespaceUri = 'urn:1C.ru:commerceml_3';

        DB::beginTransaction();
        while ($reader->read()) {
            // Проверяем, что текущий элемент является началом тега
            if ($reader->nodeType === XMLReader::ELEMENT && $reader->namespaceURI === $namespaceUri) {
                $localName = $reader->localName;

                switch ($localName) {
                    case 'Каталог':
                        $this->processCatalog($reader);
                        break;

                    case static::NODE_NAME:
                        $xItem = new SimpleXMLElement($reader->readOuterXML());
                        $this->processItem($xItem);
                        break;
                }
            }
        }
        $this->afterParse();
        DB::commit();

        $reader->close();

        $end_time = microtime(true);

        return true;
    }

    /**
     * @throws Exception
     */
    public function processCatalog(XMLReader $reader): void
    {
        $xData = new SimpleXMLElement($reader->readOuterXML());
        $this->catalog_id = $xData->Ид;
        $this->catalog_name = $xData->Наименование;
    }

    abstract public function processItem(SimpleXMLElement $xItem): bool;


    public function prepareVars() : void {}
    public function afterParse() : void {}
}
