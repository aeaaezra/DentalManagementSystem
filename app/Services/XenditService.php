<?php

namespace App\Services;
<?php

namespace App\Services;

use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\CreateInvoiceRequest;


class XenditService
{
    public function __construct()
    {
        Configuration::setXenditKey(
            config('xendit.secret_key')
        );
    }

    public function createInvoice($appointment)
{

}
}
