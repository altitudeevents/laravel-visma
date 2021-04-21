<?php

declare(strict_types=1);

namespace Webparking\LaravelVisma\Entities;

use Illuminate\Support\Collection;
use VoucherRow;

/**
 * Class Voucher
 *
 * @property string $VoucherDate
 * @property string $VoucherText
 * @property VoucherRow[] $Rows
 * @property string $ModifiedUtc
 * @property integer $VoucherType
 * @property string $NumberSeries
 *
 * @package Webparking\LaravelVisma\Entities
 */
class Voucher extends BaseEntity
{
    /** @var string */
    protected $endpoint = '/vouchers';

    public function index(string $fiscalYearId = ''): collection
    {
        if($fiscalYearId !== '') {
            $this->endpoint .= '/' . $fiscalYearId;
        }

        return $this->baseIndex();
    }

    public function save()
    {
        $queryParams = [];
        if(isset($this->NumberSeries)) {
            $queryParams['useDefaultVoucherSeries'] = "false";
        }
        return $this->basePost($this, $queryParams);
    }
}
