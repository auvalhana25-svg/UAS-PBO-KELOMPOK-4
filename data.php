<?php

class Data
{
    // Data Driver
    public $driver = [
        [
            "id" => "D001",
            "nama" => "Budi",
            "kendaraan" => "Motor",
            "status" => "Online"
        ],
        [
            "id" => "D002",
            "nama" => "Andi",
            "kendaraan" => "Motor",
            "status" => "Offline"
        ],
        [
            "id" => "D003",
            "nama" => "Rina",
            "kendaraan" => "Motor",
            "status" => "Online"
        ]
    ];

    // Data Order
    public $order = [
        [
            "kode" => "OR001",
            "customer" => "Sinta",
            "restoran" => "McDonald's",
            "total" => "Rp42.000"
        ],
        [
            "kode" => "OR002",
            "customer" => "Riko",
            "restoran" => "KFC",
            "total" => "Rp38.000"
        ],
        [
            "kode" => "OR003",
            "customer" => "Dinda",
            "restoran" => "Mie Gacoan",
            "total" => "Rp27.000"
        ]
    ];

    // Data Riwayat
    public $riwayat = [
        [
            "driver" => "Budi",
            "customer" => "Sinta",
            "restoran" => "McDonald's",
            "jam" => "14:30 WIB"
        ],
        [
            "driver" => "Andi",
            "customer" => "Riko",
            "restoran" => "KFC",
            "jam" => "10:15 WIB"
        ],
        [
            "driver" => "Rina",
            "customer" => "Dinda",
            "restoran" => "Mie Gacoan",
            "jam" => "08:45 WIB"
        ]
    ];
}