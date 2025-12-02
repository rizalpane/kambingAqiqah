<?php

return [
    /**
     * Set to `true` if you want Midtrans SNAP to use Server Key
     * This impacts the signature / checksum generation
     */
    'isSanitized' => env('MIDTRANS_IS_SANITIZED', true),

    /**
     * Set to `true` if you want to log every incoming notifications from Midtrans
     */
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),

    /**
     * Default theme to use for Snap
     * @deprecated Midtrans SNAP API 2.1 doesn't use theme concept
     */
    'serverKey' => env('MIDTRANS_SERVER_KEY'),

    'clientKey' => env('MIDTRANS_CLIENT_KEY'),
];
