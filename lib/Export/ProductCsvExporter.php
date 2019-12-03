<?php
/* -----------------------------------------------------------
Copyright (c) 2019 Releva GmbH - https://www.releva.nz
Released under the MIT License (Expat)
[https://opensource.org/licenses/MIT]
--------------------------------------------------------------
*/
namespace Releva\Tracking\Core\Export;

use Releva\Tracking\Core\Export\Item\ProductExportItem;
use Releva\Tracking\Core\Export\Item\ExportItemInterface;

/**
 * Export Products Exporter (CSV format)
 *
 * Provides methods for exporting the products data.
 */
class ProductCsvExporter extends AbstractCsvExporter
{
    protected $filename = 'products';

    /**
     * @param ExportItemInterface $product
     * @return $this
     */
    public function addItem(ExportItemInterface $product) {
        if (!($product instanceof ProductExportItem)) {
            throw new \InvalidArgumentException(
                'Expected object of type '.ProductExportItem::class.', got '.get_class($product).'.',
                1574007381
            );
        }
        $row = $product->getData();
        $row['categoryIds'] = implode(',', $row['categoryIds']);
        $row['price'] = round($row['price'], 2);
        $this->csv->writeRow($row);
        return $this;
    }

}
